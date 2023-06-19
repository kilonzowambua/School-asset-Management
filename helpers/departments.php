<?php
#Include all Nesessary Files

include('../config/codeGen.php');

#Administration
#Create Department
if (isset($_POST['add_department'])) {
    #Declare Posted Variables
    $department_id = mysqli_real_escape_string($mysqli, $ID);
    $department_name = mysqli_real_escape_string($mysqli, $_POST['department_name']);
   
    # Add departments
    $sql = "INSERT INTO departments(department_id, department_name) VALUES (?,?)";
    $stmt = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt, 'ss',   $department_id, $department_name);
    if (mysqli_stmt_execute($stmt)) {
        $success = "New Department is created";
    } else {
        $err = "Failed! Please try again.";
    }
}
