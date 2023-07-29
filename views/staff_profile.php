<?php
session_start();
require_once('../config/config.php');
include('../helpers/datefunction.php');
include('../helpers/staff.php');
/* Load This Page With Logged In User Session */
$staff_id = mysqli_escape_string($mysqli, $_SESSION['staff_id']);
$staff_sql = mysqli_query($mysqli, "SELECT * FROM staffs AS astf INNER JOIN departments AS dp ON astf.staff_department_id=dp.department_id
    WHERE staff_id = '{$staff_id}'");
if (mysqli_num_rows($staff_sql) > 0) {
    while ($staff = mysqli_fetch_array($staff_sql)) {
        /* Global Usernames */
        $staff_first_name = $staff['staff_first_name'];
        $staff_last_name = $staff['staff_last_name'];
        $staff_department_id  = $staff['staff_department_id'];
        $staff_department_head  = $staff['department_staff_id'];
        $staff_department_name  = $staff['department_name'];
        global $staff_first_name;
        global $$staff_last_name;
        global $staff_department_id;
        global $staff_department_head;
        global $staff_department_name;

        
      
?>
        <!DOCTYPE html>
        <html lang="en">
        <?php $page = 'Profile'; ?>
        <?php include('../partials/head.php') ?>

        <body>
            <div class="theme-loader">
                <div class="ball-scale">
                    <div class='contain'>
                        <div class="ring">
                            <div class="frame"></div>
                        </div>
                        <div class="ring">
                            <div class="frame"></div>
                        </div>
                        <div class="ring">
                            <div class="frame"></div>
                        </div>
                        <div class="ring">
                            <div class="frame"></div>
                        </div>
                        <div class="ring">
                            <div class="frame"></div>
                        </div>
                        <div class="ring">
                            <div class="frame"></div>
                        </div>
                        <div class="ring">
                            <div class="frame"></div>
                        </div>
                        <div class="ring">
                            <div class="frame"></div>
                        </div>
                        <div class="ring">
                            <div class="frame"></div>
                        </div>
                        <div class="ring">
                            <div class="frame"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="pcoded" class="pcoded">
                <div class="pcoded-overlay-box"></div>
                <div class="pcoded-container navbar-wrapper">
                    <nav class="navbar header-navbar pcoded-header">
                        <div class="navbar-wrapper">
                            <div class="navbar-logo">
                                <a class="mobile-menu" id="mobile-collapse" href="#!">
                                    <i class="feather icon-menu"></i>
                                </a>
                                <a href="dashboard.php">
                                    <h6>Asset Management</h6>
                                </a>
                                <a class="mobile-options">
                                    <i class="feather icon-more-horizontal"></i>
                                </a>
                            </div>
                            <div class="navbar-container">
                                <ul class="nav-left">

                                    <li>
                                        <a href="#!" onclick="javascript:toggleFullScreen()">
                                            <i class="feather icon-maximize full-screen"></i>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav-right">

                                    <li class="user-profile header-notification">
                                        <div class="dropdown-primary dropdown">
                                            <div class="dropdown-toggle" data-toggle="dropdown">
                                                <img src="../public/images/user-profile/default.png" class="img-radius" alt="User-Profile-Image">
                                                <span><?php echo $staff_first_name ?> <?php echo $staff_last_name ?> </span>
                                                <i class="feather icon-chevron-down"></i>
                                            </div>
                                            <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">

                                                <li>
                                                    <a href="staff_profile">
                                                        <i class="feather icon-user"></i> Profile
                                                    </a>
                                                </li>


                                                <li>
                                                    <a href="logout">
                                                        <i class="feather icon-log-out"></i> Logout
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>



                    <div class="pcoded-main-container">
                        <div class="pcoded-wrapper">
                            <?php include('../partials/navbar.php') ?>
                            <div class="pcoded-content">
                                <div class="pcoded-inner-content">
                                    <div class="main-body">
                                        <div class="page-wrapper">

                                            <div class="page-header">
                                                <div class="row align-items-end">
                                                    <div class="col-lg-8">
                                                        <div class="page-header-title">
                                                            <div class="d-inline">
                                                                <h4>User Profile</h4>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="page-header-breadcrumb">
                                                                <ul class="breadcrumb-title">
                                                                    <li class="breadcrumb-item" style="float: left;">
                                                                        <a href="dashboard"> <i class="feather icon-home"></i> </a>
                                                                    </li>
                                                                    <li class="breadcrumb-item" style="float: left;"><a href="#!">User Profile</a>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="page-body">

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="cover-profile">
                                                                <div class="profile-bg-img">
                                                                    <img class="profile-bg-img img-fluid" src="../public/assets/images/user-profile/bg-img1.jpg" alt="bg-img">
                                                                    <div class="card-block user-info">
                                                                        <div class="col-md-12">
                                                                            <div class="media-left">
                                                                                <a href="#" class="profile-image">
                                                                                    <img class="user-img img-radius" src="../public/images/user-profile/default.png" alt="user-img">
                                                                                </a>
                                                                            </div>
                                                                            <div class="media-body row">
                                                                                <div class="col-lg-12">
                                                                                    <div class="user-title">
                                                                                        <h2><?php echo $staff_first_name ?> <?php echo $staff_last_name ?> </h2>
                                                                                        <?php
                                                                                        $department_sql = mysqli_query($mysqli, "SELECT * FROM departments WHERE department_id = '{$staff_department_id}'");
                                                                                        if (mysqli_num_rows($department_sql) > 0) {
                                                                                            while ($department = mysqli_fetch_array($department_sql)) {
                                                                                                if ($department['department_staff_id'] == $staff_id) { ?>
                                                                                                    <span class="text-white">Department Head,<?php echo $department['department_name']; ?> </span>
                                                                                                <?php } else { ?>
                                                                                                    <span class="text-white">Department Member,<?php echo $department['department_name']; ?> </span>
                                                                                                <?php }

                                                                                                ?>
                                                                                    </div>
                                                                                </div>
                                                                                <div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-12">

                                                            <div class="tab-header card">
                                                                <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" data-toggle="tab" href="#personal" role="tab" aria-selected="true">Personal Info</a>
                                                                        <div class="slide"></div>
                                                                    </li>


                                                            </div>


                                                            <div class="tab-content">

                                                                <div class="tab-pane active" id="personal" role="tabpanel">

                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h5 class="card-header-text">About Me</h5>
                                                                            <button id="edit-btn" type="button" class="btn btn-sm btn-primary waves-effect waves-light f-right">
                                                                                <i class="icofont icofont-close"></i>
                                                                            </button>
                                                                        </div>
                                                                        <div class="card-block">
                                                                            <div class="view-info" style="display: none;">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="general-info">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12 col-xl-6">
                                                                                                    <div class="table-responsive">
                                                                                                        <table class="table m-0">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <th scope="row">
                                                                                                                        Staff No.
                                                                                                                    </th>
                                                                                                                    <td><?php echo $staff_no ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <th scope="row">
                                                                                                                        Full Name
                                                                                                                    </th>
                                                                                                                    <td><?php echo $staff_first_name ?> <?php echo $staff_last_name ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <th scope="row">
                                                                                                                        Department</th>
                                                                                                                    <td><?php echo $department['department_name']; ?></td>
                                                                                                                </tr>




                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="col-lg-12 col-xl-6">
                                                                                                    <div class="table-responsive">
                                                                                                        <table class="table">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <th scope="row">
                                                                                                                        Email</th>
                                                                                                                    <td><a href="mailto:<?php echo $staff_email ?>"><?php echo $staff_email ?></a>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <th scope="row">
                                                                                                                        Mobile
                                                                                                                        Number</th>
                                                                                                                    <td><?php echo $staff_phone_no ?></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <th scope="row">Status</th>
                                                                                                                    <td><?php echo $staff_status ?></td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </div>
                                                                                                </div>

                                                                                            </div>
                                                                                        </div>
                                                                                 

                                                                                    </div>

                                                                                </div>

                                                                            </div>

                                                                            <div class="edit-info">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="general-info">
                                                                                               <form  method="post">
                                                                                            <div class="form-group row">
                                                                                                <label class="col-sm-2 col-form-label">First Name</label>
                                                                                                <div class="col-sm-10">
                                                                                                    <input type="text" hidden name="staff_id" class="form-control form-control-round" value="<?php echo $staff_id ?>">
                                                                                                    <input type="text" name="staff_first_name" class="form-control form-control-round" value="<?php echo $staff_first_name ?>">
                                                                                                </div>
                                                                                            </div>
                                                                                            
                                                                                            <div class="form-group row">
                                                                                                <label class="col-sm-2 col-form-label">Last Name</label>
                                                                                                <div class="col-sm-10">
                                                                                                    <input type="text" name="staff_last_name" class="form-control form-control-round" value="<?php echo $staff_last_name ?>">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label class="col-sm-2 col-form-label">Email</label>
                                                                                                <div class="col-sm-10">
                                                                                                    <input type="text" name="staff_email" class="form-control form-control-round" value="<?php echo $staff_email ?>">
                                                                                                </div>
                                                                                            </div>
                                                                                            
                                                                                            <div class="form-group row">
                                                                                                <label class="col-sm-2 col-form-label">Phone No.</label>
                                                                                                <div class="col-sm-10">
                                                                                                    <input type="text" name="staff_phone_no" class="form-control form-control-round" value="<?php echo $staff_phone_no ?>">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label class="col-sm-2 col-form-label">Password</label>
                                                                                                <div class="col-sm-10">
                                                                                                    <input type="text" name="staff_password" class="form-control form-control-round" value="">
                                                                                                </div>
                                                                                            </div>
                                                                                       
                                                                                        <div class="text-center">
                                                                                            <button type="submit" name="update_profile" class="btn btn-primary waves-effect waves-light m-r-20">Save</button>
                                                                                            <a href="" id="edit-cancel" class="btn btn-default waves-effect">Cancel</a>
                                                                                        </div>
                                                                                        </form>
                                                                                    </div>

                                                                                    </div>
                                                                                </div>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>


                                                    <?php }
                                                                                        } ?>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div id="styleSelector">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>


            <?php include('../partials/script.php') ?>
        </body>

        </html>
<?php }
} ?>