<?php
#Include all Nesessary Files
include('../config/codeGen.php');

#Administration
#Create Asset 
if (isset($_POST['add_asset'])) {
    #Declare Posted Variables
    $asset_id = mysqli_real_escape_string($mysqli, $ID);
    $asset_name = mysqli_real_escape_string($mysqli, $_POST['asset_name']);
    $asset_tag = mysqli_real_escape_string($mysqli, $_POST['asset_tag']);
    $asset_type_id = mysqli_real_escape_string($mysqli, $_POST['asset_type_id']);
    $asset_details = mysqli_real_escape_string($mysqli, $_POST['asset_details']);
    $asset_price = mysqli_real_escape_string($mysqli, $_POST['asset_price']);



    # Add Asset type 
    $sql = "INSERT INTO assets(asset_id, asset_name,asset_tag,asset_type_id,asset_details,asset_price) 
    VALUES ('{$asset_id}','{$asset_name}','{$asset_tag}','{$asset_type_id}','{$asset_details}','{$asset_price}')";
    $stmt = mysqli_query($mysqli, $sql);
    if ($stmt) {
        $success = "New Asset  is Added";
    } else {
        $err = "Failed! Please try again.";
    }
}

// Update Asset
if (isset($_POST['update_asset'])) {
    // Declare Posted Variables
    $asset_id = mysqli_real_escape_string($mysqli, $_POST['asset_id']);
    $asset_name = mysqli_real_escape_string($mysqli, $_POST['asset_name']);
    $asset_tag = mysqli_real_escape_string($mysqli, $_POST['asset_tag']);
    $asset_type_id = mysqli_real_escape_string($mysqli, $_POST['asset_type_id']);
    $asset_details = mysqli_real_escape_string($mysqli, $_POST['asset_details']);
    $asset_price = mysqli_real_escape_string($mysqli, $_POST['asset_price']);

    // Check if the asset is disposed or allocated
    $sql = "SELECT assetdispose_id, asset_allocation_id FROM assets WHERE asset_id = ?";
    $stmt = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt, 's', $asset_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $asset_dispose_id, $asset_allocation_id);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt); // Close the statement after fetching results

    // Check if the asset is disposed
    if (!empty($asset_dispose_id)) {
        $err = "Failed! The asset is disposed and cannot be updated.";
    }
    // Check if the asset is allocated
    elseif (!empty($asset_allocation_id)) {
        $err = "Failed! The asset is allocated and cannot be updated.";
    }
    // Update the asset
    else {
        $sql = "UPDATE assets SET asset_name=?, asset_tag=?, asset_type_id=?, asset_details=?, asset_price=? WHERE asset_id=?";
        $stmt_update = mysqli_prepare($mysqli, $sql);
        mysqli_stmt_bind_param($stmt_update, 'ssssss', $asset_name, $asset_tag, $asset_type_id, $asset_details, $asset_price, $asset_id);
        if (mysqli_stmt_execute($stmt_update)) {
            $success = "Asset is updated.";
        } else {
            $err = "Failed! Please try again.";
        }
        mysqli_stmt_close($stmt_update); // Close the statement after executing
    }
}


/// Remove Asset
if (isset($_POST['delete_asset'])) {
    // Declare Posted Variables
    $asset_id = mysqli_real_escape_string($mysqli, $_POST['asset_id']);

    // Check if the asset is disposed or allocated
    $sql = "SELECT assetdispose_id, asset_allocation_id FROM assets WHERE asset_id = ?";
    $stmt = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt, 's', $asset_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $asset_dispose_id, $asset_allocation_id);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt); // Close the statement after fetching results

    // Check if the asset is disposed
    if ($asset_dispose_id !== null) {
        $err = "Failed! The asset is already disposed.";
    }
    // Check if the asset is allocated
    elseif ($asset_allocation_id !== null) {
        $err = "Failed! The asset is already allocated.";
    }
    // Delete the asset
    else {
        $sql = "DELETE FROM assets WHERE asset_id = ?";
        $stmt_delete = mysqli_prepare($mysqli, $sql);
        mysqli_stmt_bind_param($stmt_delete, 's', $asset_id);
        if (mysqli_stmt_execute($stmt_delete)) {
            $success = "Asset is deleted.";
        } else {
            $err = "Failed! Please try again.";
        }
        mysqli_stmt_close($stmt_delete); // Close the statement after executing
    }
}

if (isset($_POST['dispose_asset'])) {
    // Escape and retrieve the posted variables
   
    $assetdispose_asset_id = mysqli_real_escape_string($mysqli, $_POST['assetdispose_asset_id']);
    $assetdispose_by_id =  $_POST['assetdispose_staff_id'];
    $assetdispose_method = mysqli_real_escape_string($mysqli, $_POST['assetdispose_method']);
    $assetdispose_reason = mysqli_real_escape_string($mysqli, $_POST['assetdispose_reason']);

    // Check if the asset is allocated
    $sql = "SELECT asset_allocation_id FROM assets WHERE asset_id = ?";
    $stmt = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt, 's', $assetdispose_asset_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $asset_allocation_id);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt); // Close the statement after fetching results

    // Insert into assetdisposes
    $sql = "INSERT INTO assetdisposes (assetdispose_asset_id, assetdispose_staff_id, assetdispose_method, assetdispose_reason) VALUES (?, ?, ?, ?)";
    $stmt_insert = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt_insert, 'ssss', $assetdispose_asset_id, $assetdispose_by_id, $assetdispose_method, $assetdispose_reason);

    if (mysqli_stmt_execute($stmt_insert)) {
        $assetdispose_id = mysqli_insert_id($mysqli); // Get the last inserted ID
        mysqli_stmt_close($stmt_insert); // Close the statement after executing

        // Update the assets
        if (empty($asset_allocation_id)) {
            $sql = "UPDATE assets SET assetdispose_id = '{$assetdispose_id}' WHERE asset_id = '{$assetdispose_asset_id}'";
            if (mysqli_query($mysqli, $sql)) {
                $success = "Asset is disposed";
            } else {
                $err = "Failed! Please try again.";
            }
        } elseif (!empty($asset_allocation_id)) {
            $sql = "UPDATE assets SET asset_allocation_id = NULL, assetdispose_id = '{$assetdispose_id}' WHERE asset_id = '{$assetdispose_asset_id}'";
            if (mysqli_query($mysqli, $sql)) {
                $success = "Asset is disposed and deallocated";
            } else {
                $err = "Failed! Please try again.";
            }
        }
    } else {
        $err = "Failed! Please try again.";
    }
} 

#Request For  Allocation
if (isset($_POST['request_asset'])) {
    $allocation_id = mysqli_real_escape_string($mysqli, $ID);
    $allocation_asset_id = mysqli_real_escape_string($mysqli, $_POST['allocation_asset_id']);
    $allocation_staff_id = mysqli_real_escape_string($mysqli, $_POST['allocation_staff_id']);
   
    // Check if allocation_asset_id exists
    $checkQuery = "SELECT * FROM allocations WHERE allocation_asset_id = '{$allocation_asset_id}'";
    $checkResult = mysqli_query($mysqli, $checkQuery);
    $assetExists = mysqli_num_rows($checkResult) > 0;
  
    if ($assetExists) {
        $err = "Asset is requested already exists. Please choose a different asset.";
    } else {
        // Add Allocation 
        $sql = "INSERT INTO allocations (allocation_id, allocation_asset_id, allocation_staff_id) 
                VALUES ('{$allocation_id}', '{$allocation_asset_id}', '{$allocation_staff_id}')";
        $stmt = mysqli_query($mysqli, $sql);
      
        if ($stmt) {
            $success = "Asset allocation requested";
        } else {
            $err = "Failed! Please try again.";
        }
    }
}

#Approve allocation Request

if (isset($_POST['reply_request'])) {
    
    $allocation_asset_id = mysqli_real_escape_string($mysqli, $_POST['allocation_asset_id']);
    $allocation_department_staff_id  =$_POST['allocation_department_staff_id'];
    $reply_type = mysqli_real_escape_string($mysqli, $_POST['reply_type']);
    $allocation_status = mysqli_real_escape_string($mysqli, 'Approved');
    $asset_allocation_id = mysqli_real_escape_string($mysqli,$_POST['asset_allocation_id']);

    #Check for Cancellation or approval
    if($reply_type=='Cancelled'){
        #Remove  the Request
        $sql = "DELETE FROM allocations WHERE allocation_asset_id='{$allocation_asset_id}'";
        $stmt1 = mysqli_query($mysqli, $sql);
      
        if ($stmt1) {
            $success = "Asset allocation request is Removed";
        } else {
            $err = "Failed! Please try again.";
        }

    }elseif($reply_type=='Approved') {
   
        #Approve  the Request
        $sql2 = "UPDATE allocations SET allocation_department_staff_id='{$allocation_department_staff_id}',allocation_status='{$allocation_status}' WHERE allocation_asset_id='{$allocation_asset_id}'";
        $stmt2 = mysqli_query($mysqli, $sql2);
      
        #Update assets
        $sql3 = "UPDATE assets SET asset_allocation_id='{$asset_allocation_id}' WHERE asset_id='{$allocation_asset_id}'";
        $stmt3 = mysqli_query($mysqli, $sql3);
        
        if ($stmt3) {
            $success = "Asset allocation request is Removed";
        } else {
            $err = "Failed! Please try again.";
        }


    }
     

   
}

#dislocate_asset
if(isset($_POST['dislocate_asset'])){
    $allocation_asset_id = mysqli_real_escape_string($mysqli, $_POST['allocation_asset_id']);

    #Update assets
    $sql1 = "UPDATE assets SET asset_allocation_id='NULL' WHERE asset_id='{$allocation_asset_id}'";
    $stmt1 = mysqli_query($mysqli, $sql1);

    #Remove  the Request
    $sql2 = "DELETE FROM allocations WHERE allocation_asset_id='{$allocation_asset_id}'";
    $stmt2 = mysqli_query($mysqli, $sql2);
  
    if ($stmt2) {
        $success = "Asset allocation request is Removed";
    } else {
        $err = "Failed! Please try again.";
    }
}

#Maintenance 
#Add Schedule
if(isset($_POST['add_maintenance'])){

    #Declare Variables
    $maintenance_asset_id = mysqli_real_escape_string($mysqli, $_POST['maintenance_asset_id']);
    $maintenance_type = mysqli_real_escape_string($mysqli, $_POST['maintenance_type']);
    $maintenance_date = mysqli_real_escape_string($mysqli, $_POST['maintenance_date']);

    // Insert into maintenance table
$sql = "INSERT INTO maintenance (maintenance_asset_id, maintenance_type, maintenance_date)
VALUES ('{$maintenance_asset_id}', '{$maintenance_type}', '{$maintenance_date}')";

$stmt = mysqli_query($mysqli, $sql);

if ($stmt) {
$success = "Maintenance scheduled";
} else {
$err = "Failed to scheduled maintenance. Please try again.";
}
    
} 

#Edit Maintenance
if(isset($_POST['update_maintenance'])){

    #Declare Variables
    $maintenance_id = mysqli_real_escape_string($mysqli, $_POST['maintenance_id']);
    $maintenance_type = mysqli_real_escape_string($mysqli, $_POST['maintenance_type']);
    $maintenance_date = mysqli_real_escape_string($mysqli, $_POST['maintenance_date']);

    // Insert into maintenance table
$sql = "UPDATE maintenance SET maintenance_type ='{$maintenance_type}',maintenance_date ='{$maintenance_date}' WHERE maintenance_id = '{$maintenance_id}'";

$stmt = mysqli_query($mysqli, $sql);

if ($stmt) {
$success = "Maintenance scheduled Updated";
} else {
$err = "Failed to scheduled maintenance. Please try again.";
}
    
} 

#Cancel Maintenance

if(isset($_POST['cancel_maintenance'])){
    #Declare Variables
    $maintenance_id = mysqli_real_escape_string($mysqli, $_POST['maintenance_id']);
    $maintenance_status = 'Cancelled';

    // Insert into maintenance table
$sql = "UPDATE maintenance SET maintenance_status ='{$maintenance_status}' WHERE maintenance_id = '{$maintenance_id}'";

$stmt = mysqli_query($mysqli, $sql);

if ($stmt) {
$success = "Maintenance scheduled Cancelled";
} else {
$err = "Failed to scheduled Cancelled. Please try again.";
}
    
} 

