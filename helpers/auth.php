<?php 

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
}

#Reset password

if (isset($_POST['reset_password'])) {
    // Declare Posted Variables
    $staff_no = mysqli_real_escape_string($mysqli, $_POST['staff_no']);
    $staff_email = mysqli_real_escape_string($mysqli, $_POST['staff_email']);
    $staff_password = mysqli_real_escape_string($mysqli, $_POST['staff_password']);
    $staff_confirmation_password = mysqli_real_escape_string($mysqli, $_POST['staff_confirmation_password']);

    // Check if Staff exists
    $sql = "SELECT * FROM staffs WHERE staff_email = ? AND staff_no = ?";
    $stmt = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt, 'ss', $staff_email, $staff_no);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $staff = mysqli_fetch_assoc($result);

        // Check if Password Matches
        if ($staff_password == $staff_confirmation_password) {
            // Update Password
            $staff_id = $staff['staff_id'];
            $new_password = password_hash($staff_password, PASSWORD_DEFAULT);

            // Update SQL
            $sql = "UPDATE staffs SET staff_password = ? WHERE staff_id = ?";
            $stmt = mysqli_prepare($mysqli, $sql);
            mysqli_stmt_bind_param($stmt, 'ss', $new_password, $staff_id);

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['success'] = "Reset is Successful. Proceed to Login.";
                header('Location: login');
                exit();
            } else {
                $err = "Failed to reset the password.";
            }
        } else {
            $err = "Failed! Password does not match confirmation.";
        }
    } else {
        $err = "Failed! Staff does not exist.";
    }
}
