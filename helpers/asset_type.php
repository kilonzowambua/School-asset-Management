<?php
#Include all Nesessary Files
include('../config/config.php');
include('../config/codeGen.php');

#Administration
#Create Asset Type
if (isset($_POST['add_asset_type'])) {
    #Declare Posted Variables
    $asset_type_id = mysqli_real_escape_string($mysqli, $ID);
    $asset_type_name = mysqli_real_escape_string($mysqli, $_POST['asset_type_name']);
   
    # Add Asset type 
    $sql = "INSERT INTO asset_types(asset_type_id, asset_type_name) VALUES (?,?)";
    $stmt = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt, 'ss',   $asset_type_id, $asset_type_name);
    if (mysqli_stmt_execute($stmt)) {
        $success = "New Asset type is created";
    } else {
        $err = "Failed! Please try again.";
    }
}

#Update Asset Type
if (isset($_POST['update_asset_type'])) {
    #Declare Posted Variables
    $asset_type_id = mysqli_real_escape_string($mysqli,$_POST['asset_type_id'] );
    $asset_type_name = mysqli_real_escape_string($mysqli, $_POST['asset_type_name']);
   
    # Add Asset type 
    $sql = "UPDATE  asset_types SET asset_type_name=? WHERE asset_type_id=?";
    $stmt = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt, 'ss', $asset_type_name,$asset_type_id);
    if (mysqli_stmt_execute($stmt)) {
        $success = "Asset type is Updated";
    } else {
        $err = "Failed! Please try again.";
    }
}

#Remove Asset Type
if (isset($_POST['delete_asset_type'])) {
    #Declare Posted Variables
    $asset_type_id = mysqli_real_escape_string($mysqli,$_POST['asset_type_id'] );
   
   
    # Add Asset type 
    $sql = "DELETE  FROM  asset_types  WHERE asset_type_id=?";
    $stmt = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt, 's',$asset_type_id);
    if (mysqli_stmt_execute($stmt)) {
        $success = "Asset type is Deleted";
    } else {
        $err = "Failed! Please try again.";
    }
}