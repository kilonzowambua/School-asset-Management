<?php

#Administration
#Create Department
if (isset($_POST['add_department'])) {
    #Declare Posted Variables
    $department_id = mysqli_real_escape_string($mysqli, $ID);
    $department_name = mysqli_real_escape_string($mysqli, $_POST['department_name']);
    $department_staff_id = mysqli_real_escape_string($mysqli, $_POST['department_staff_id']);
    # Add departments
    $sql = "INSERT INTO departments(department_id, department_name ,department_staff_id) VALUES (?,?,?)";
    $stmt = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt, 'sss',   $department_id, $department_name ,$department_staff_id);
    if (mysqli_stmt_execute($stmt)) {
        $success = "New Department is created";
    } else {
        $err = "Failed! Please try again.";
    }
}


#Update Department
if (isset($_POST['update_department'])) {
    #Declare Posted Variables
    $department_id = mysqli_real_escape_string($mysqli, $_POST['department_id']);
    $department_name = mysqli_real_escape_string($mysqli, $_POST['department_name']);
    $department_staff_id = mysqli_real_escape_string($mysqli, $_POST['department_staff_id']);
    # Add Asset type 
    $sql = "UPDATE  departments SET department_name =? ,department_staff_id=? WHERE department_id=?";
    $stmt = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt, 'sss', $department_name,$department_staff_id,$department_id);
    if (mysqli_stmt_execute($stmt)) {
        $success = "Department is Updated";
    } else {
        $err = "Failed! Please try again.";
    }
}

#Remove Department
if (isset($_POST['delete_department'])) {
    #Declare Posted Variables
    $department_id = mysqli_real_escape_string($mysqli,$_POST['department_id'] );
    # Department Delete
    $sql = "DELETE  FROM  departments  WHERE department_id=?";
    $stmt = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt, 's',$department_id);
    if (mysqli_stmt_execute($stmt)) {
        $success = "Department is Removed";
    } else {
        $err = "Failed! Please try again.";
    }
}