<?php 

session_start();
#Include all Nesessary Files
include('../config/config.php'); 
include('../config/codeGen.php'); 
include('../config/checklogin.php'); 


#Login 
if(isset($_POST['login'])){

    #Declare Posted Variables
    $staff_email=mysqli_real_escape_string($mysqli,$_POST['staff_email']);
    $staff_password=mysqli_real_escape_string($mysqli,$_POST['staff_password']);
# Check user existence
    $sql = "SELECT * FROM staffs WHERE staff_email = '$staff_email'";
    $result = mysqli_query($mysqli, $sql);

    if (mysqli_num_rows($result) > 0) {
        $staff = mysqli_fetch_assoc($result);
        if (password_verify($staff_password, $staff['staff_password'])) {
            
                $_SESSION['staff_id']=$staff['staff_id'];
                $_SESSION['success'] = "Login Successful";
                header('Location: dashboard');
                exit();
            }
        } else {
            $err = "Failed! Please try again.";
        }
    } else {
        $err = "Failed! Please try again.";
    }
