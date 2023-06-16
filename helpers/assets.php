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
    $sql = "SELECT asset_dispose_id, asset_allocation_id FROM assets WHERE asset_id = ?";
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
    $sql = "SELECT asset_dispose_id, asset_allocation_id FROM assets WHERE asset_id = ?";
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


