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
        $staff_department_head  = $staff['department_head_id'];
        $staff_department_name  = $staff['department_name'];
        global $staff_first_name;
        global $$staff_last_name;
        global $staff_department_id;
        global $staff_department_head;
        global $staff_department_name;

?>
        <!DOCTYPE html>
        <html lang="en">
        <?php $page = 'Staffs'; ?>
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
                                                                <h4>Staffs</h4>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="page-header-breadcrumb">
                                                            <ul class="breadcrumb-title">
                                                                <li class="breadcrumb-item" style="float: left;">
                                                                    <a href="dashboard"> <i class="feather icon-home"></i> </a>
                                                                </li>
                                                                <li class="breadcrumb-item" style="float: left;"><a href="dashboard">Home</a>
                                                                </li>
                                                                <li class="breadcrumb-item" style="float: left;"><a href="#!">Staffs</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="page-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="card">
                                                            <div class="card-header table-card-header text-right">
                                                                <?php
                                                            if ($staff_department_head == $staff_id) { ?>
                                                                <button type="button" class="btn btn-info btn-outline-info waves-effect md-trigger" data-toggle="modal" data-target=".bd-example-modal-lg">New Staff </button>
                                                                <!-- Large modal -->
                                                                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="md-content">
                                                                                <h1 class="text-center">Add New Staff</h1>
                                                                                <div>
                                                                                    <form method="post">
                                                                                        <div class="form-group row mt-1 col-12 ">
                                                                                            <label class="col-form-label">Staff First Name:</label>

                                                                                            <input type="text" name="staff_first_name" class="form-control">

                                                                                        </div>
                                                                                        <div class="form-group row mt-1 col-12  ">
                                                                                            <label class="col-form-label">Staff last Name:</label>

                                                                                            <input type="text" name="staff_last_name" class="form-control">

                                                                                        </div>

                                                                                        <div class="form-group row mt-1 col-12">
                                                                                            <label class="col-form-label">Staff Email:</label>

                                                                                            <input type="email" name="staff_email" class="form-control">

                                                                                        </div>
                                                                                        <div class="form-group row mt-1 col-12">
                                                                                            <label class="col-form-label">Staff Phone No:</label>

                                                                                            <input type="text" name="staff_phone_no" class="form-control" required>

                                                                                        </div>
                                                                                        <?php
                                                                                        if ($staff_department_name == 'Administration') { ?>
                                                                                        <div class="form-group row mt-1 col-12">
                                                                                            <label class="col-form-label">Department Name:</label>
                                                                                            <select name="staff_department_id" class="form-control">
                                                                                                <?php

                                                                                                # Read all Asset Type
                                                                                                $sql = "SELECT * FROM departments;";
                                                                                                $result3 = mysqli_query($mysqli, $sql);
                                                                                                if (mysqli_num_rows($result3) > 0) {
                                                                                                    while ($department = mysqli_fetch_object($result3)) {

                                                                                                ?>


                                                                                                        <option value="<?php echo $department->department_id ?>"><?php echo $department->department_name ?></option>


                                                                                                <?php }
                                                                                                } ?>
                                                                                            </select>
                                                                                        </div>
                                                                                        <?php }else { ?>
                                                                                           
                                                                                            <div class="form-group row mt-1 col-12">
                                                                                           
                                                                                            <input type="text" value="<?php echo $staff_department_id ?>" name="staff_department_id" class="form-control" hidden/>
                                                                                                   
                                                                                           
                                                                                        </div>  
                                                                                        <?php } ?>
                                                                                        <div class="form-group row mt-1 col-12">
                                                                                            <label class="col-form-label">Staff password:</label>

                                                                                            <input type="password" name="staff_password" class="form-control">

                                                                                        </div>

                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                            <button type="submit" name="add_staff" class="btn btn-primary">Add</button>
                                                                                        </div>
                                                                                </div>
                                                                                </form>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="md-overlay"></div>
                                                            </div>
                                                            <div class="card-block">
                                                                <div class="dt-responsive table-responsive">
                                                                    <div id="basic-btn_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                                        <div class="dt-buttons"> </div>
                                                                        <div id="basic-btn_filter" class="dataTables_filter"><label></div>
                                                                        <table id="basic-btn" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="basic-btn_info">
                                                                            <thead>
                                                                                <tr role="row">

                                                                                    <th class="sorting" tabindex="0" aria-controls="basic-btn" rowspan="1" colspan="1" style="width: 400.367px;" aria-label="Staff No: activate to sort column ascending">Staff No</th>
                                                                                    <th class="sorting" tabindex="0" aria-controls="basic-btn" rowspan="1" colspan="1" style="width: 300.367px;" aria-label="Staff Name: activate to sort column ascending">Staff Name</th>
                                                                                    <th class="sorting" tabindex="0" aria-controls="basic-btn" rowspan="1" colspan="1" style="width: 250.367px;" aria-label="Staff Email: activate to sort column ascending">Staff Email</th>
                                                                                    <th class="sorting" tabindex="0" aria-controls="basic-btn" rowspan="1" colspan="1" style="width: 250.367px;" aria-label="Department Name: activate to sort column ascending">Department Name</th>
                                                                                    <th rowspan="1" colspan="1" style="width: 250.367px;" aria-label="Action: activate to sort column ascending">Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php
                                                                           #For Admin
                                                                           if ($staff_department_name == 'Administration') {
                                                                                # Read all Staffs
                                                                                $sql = "SELECT s.staff_id, s.staff_no, s.staff_first_name, s.staff_last_name,s.staff_email,s.staff_phone_no, d.department_name FROM staffs s INNER JOIN departments d ON s.staff_department_id = d.department_id WHERE s.staff_id !='{$staff_id}'";
                                                                                $result = mysqli_query($mysqli, $sql);
                                                                                if (mysqli_num_rows($result) > 0) {
                                                                                    while ($staff = mysqli_fetch_object($result)) {
                                                                                        
                                                                                ?>
                                                                                        <tr>
                                                                                            <td class="sorting_1"><?php echo $staff->staff_no ?></td>
                                                                                            <td><?php echo $staff->staff_first_name ?> <?php echo $staff->staff_last_name ?></td>
                                                                                            <td><?php echo $staff->staff_email ?></td>
                                                                                            <td><?php echo $staff->department_name ?></td>
                                                                                            <td>
                                                                                                <button type="button" class="btn btn-info btn-outline-info waves-effect md-trigger" data-toggle="modal" data-target="#edit-<?php echo $staff->staff_id ?>">Edit</button>
                                                                                                <button type="button" class="btn btn-warning alert-confirm m-b-10 md-trigger" data-toggle="modal" data-target="#delete-<?php echo $staff->staff_id ?>">Delete</button>
                                                                                            </td>

                                                                                            <div class="modal fade" id="edit-<?php echo $staff->staff_id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                                                                <div class="modal-dialog modal-lg">
                                                                                                    <div class="modal-content">
                                                                                                        <div class="md-content">
                                                                                                            <h1 class="text-center">Edit Staff</h1>
                                                                                                            <div>
                                                                                                                <form method="post">
                                                                                                                    <div class="form-group row mt-1 col-12 ">
                                                                                                                        <label class="col-form-label">Staff First Name:</label>
                                                                                                                        <input type="text" name="staff_id" value="<?php echo $staff->staff_id ?>" class="form-control" hidden>
                                                                                                                        <input type="text" name="staff_first_name" value="<?php echo $staff->staff_first_name ?>" class="form-control">

                                                                                                                    </div>
                                                                                                                    <div class="form-group row mt-1 col-12  ">
                                                                                                                        <label class="col-form-label">Staff last Name:</label>

                                                                                                                        <input type="text" name="staff_last_name" value="<?php echo $staff->staff_last_name ?>" class="form-control">

                                                                                                                    </div>

                                                                                                                    <div class="form-group row mt-1 col-12">
                                                                                                                        <label class="col-form-label">Staff Email:</label>

                                                                                                                        <input type="email" name="staff_email" value="<?php echo $staff->staff_email ?>" class="form-control">

                                                                                                                    </div>
                                                                                                                    <div class="form-group row mt-1 col-12">
                                                                                                                        <label class="col-form-label">Staff Phone No:</label>

                                                                                                                        <input type="text" name="staff_phone_no" value="<?php echo $staff->staff_phone_no ?>" class="form-control" required>

                                                                                                                    </div>
                                                                                                                    <div class="form-group row mt-1 col-12">
                                                                                                                        <label class="col-form-label">Department Name:</label>
                                                                                                                        <select name="staff_department_id" class="form-control">
                                                                                                                            <?php

                                                                                                                            # Read all Asset Type
                                                                                                                            $sql = "SELECT * FROM departments;";
                                                                                                                            $result3 = mysqli_query($mysqli, $sql);
                                                                                                                            if (mysqli_num_rows($result3) > 0) {
                                                                                                                                while ($department = mysqli_fetch_object($result3)) {

                                                                                                                            ?>


                                                                                                                                    <option value="<?php echo $department->department_id ?>"><?php echo $department->department_name ?></option>


                                                                                                                            <?php }
                                             } ?>
                                                                                                                        </select>
                                                                                                                    </div>


                                                                                                                    <div class="modal-footer">
                                                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                                                        <button type="submit" name="update_staff" class="btn btn-primary">Save</button>
                                                                                                                    </div>
                                                                                                            </div>
                                                                                                            </form>
                                                                                                        </div>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="modal fade" id="delete-<?php echo $staff->staff_id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                                                                <div class="modal-dialog modal-lg">
                                                                                                    <div class="modal-content">
                                                                                                        <div class="md-content">
                                                                                                            <h1 class="text-center text-color:red" style="color: red;">Delete <?php echo $staff->staff_first_name ?> <?php echo $staff->staff_last_name ?> Staff</h1>
                                                                                                            <div>
                                                                                                                <form method="post">
                                                                                                                    <div class="form-group row mt-1 col-12 ">

                                                                                                                        <input type="text" name="staff_id" value="<?php echo $staff->staff_id ?>" class="form-control" hidden>

                                                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                                                        <button type="submit" name="delete_staff" class="btn btn-danger">Delete</button>
                                                                                                                    </div>

                                                                                                            </div>
                                                                                                            </form>
                                                                                                        </div>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="md-overlay"></div>
                                                                                    <?php }
                                                                                } ?>
                                                                                        </tr>
                                                                                <?php }else{
                                                                                    #HOD
                                                                                      # Read all Staffs
                                                                                $sql = "SELECT s.staff_id, s.staff_no, s.staff_first_name, s.staff_last_name,s.staff_email,s.staff_phone_no, d.department_name FROM staffs s INNER JOIN departments d ON s.staff_department_id = d.department_id WHERE s.staff_id !='{$staff_id}' AND d.department_id='{$staff_department_id}'";
                                                                                $result = mysqli_query($mysqli, $sql);
                                                                                if (mysqli_num_rows($result) > 0) {
                                                                                    while ($staff = mysqli_fetch_object($result)) {
                                                                                        
                                                                                ?>
                                                                                        <tr>
                                                                                            <td class="sorting_1"><?php echo $staff->staff_no ?></td>
                                                                                            <td><?php echo $staff->staff_first_name ?> <?php echo $staff->staff_last_name ?></td>
                                                                                            <td><?php echo $staff->staff_email ?></td>
                                                                                            <td><?php echo $staff->department_name ?></td>
                                                                                            <td>
                                                                                                <button type="button" class="btn btn-info btn-outline-info waves-effect md-trigger" data-toggle="modal" data-target="#edit-<?php echo $staff->staff_id ?>">Edit</button>
                                                                                                <button type="button" class="btn btn-warning alert-confirm m-b-10 md-trigger" data-toggle="modal" data-target="#delete-<?php echo $staff->staff_id ?>">Delete</button>
                                                                                            </td>

                                                                                            <div class="modal fade" id="edit-<?php echo $staff->staff_id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                                                                <div class="modal-dialog modal-lg">
                                                                                                    <div class="modal-content">
                                                                                                        <div class="md-content">
                                                                                                            <h1 class="text-center">Edit Staff</h1>
                                                                                                            <div>
                                                                                                                <form method="post">
                                                                                                                    <div class="form-group row mt-1 col-12 ">
                                                                                                                        <label class="col-form-label">Staff First Name:</label>
                                                                                                                        <input type="text" name="staff_id" value="<?php echo $staff->staff_id ?>" class="form-control" hidden>
                                                                                                                        <input type="text" name="staff_first_name" value="<?php echo $staff->staff_first_name ?>" class="form-control">

                                                                                                                    </div>
                                                                                                                    <div class="form-group row mt-1 col-12  ">
                                                                                                                        <label class="col-form-label">Staff last Name:</label>

                                                                                                                        <input type="text" name="staff_last_name" value="<?php echo $staff->staff_last_name ?>" class="form-control">

                                                                                                                    </div>

                                                                                                                    <div class="form-group row mt-1 col-12">
                                                                                                                        <label class="col-form-label">Staff Email:</label>

                                                                                                                        <input type="email" name="staff_email" value="<?php echo $staff->staff_email ?>" class="form-control">

                                                                                                                    </div>
                                                                                                                    <div class="form-group row mt-1 col-12">
                                                                                                                        <label class="col-form-label">Staff Phone No:</label>

                                                                                                                        <input type="text" name="staff_phone_no" value="<?php echo $staff->staff_phone_no ?>" class="form-control" required>

                                                                                                                    </div>
                                                                                                                    <div class="form-group row mt-1 col-12">
                                                                                                                        <label class="col-form-label">Department Name:</label>
                                                                                                                        <select name="staff_department_id" class="form-control">
                                                                                                                            <?php

                                                                                                                            # Read all Asset Type
                                                                                                                            $sql = "SELECT * FROM departments WHERE department_id='{$staff_department_id}';";
                                                                                                                            $result3 = mysqli_query($mysqli, $sql);
                                                                                                                            if (mysqli_num_rows($result3) > 0) {
                                                                                                                                while ($department = mysqli_fetch_object($result3)) {

                                                                                                                            ?>


                                                                                                                                    <option value="<?php echo $department->department_id ?>"><?php echo $department->department_name ?></option>


                                                                                                                            <?php }
                                             } ?>
                                                                                                                        </select>
                                                                                                                    </div>


                                                                                                                    <div class="modal-footer">
                                                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                                                        <button type="submit" name="update_staff" class="btn btn-primary">Save</button>
                                                                                                                    </div>
                                                                                                            </div>
                                                                                                            </form>
                                                                                                        </div>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="modal fade" id="delete-<?php echo $staff->staff_id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                                                                <div class="modal-dialog modal-lg">
                                                                                                    <div class="modal-content">
                                                                                                        <div class="md-content">
                                                                                                            <h1 class="text-center text-color:red" style="color: red;">Delete <?php echo $staff->staff_first_name ?> <?php echo $staff->staff_last_name ?> Staff</h1>
                                                                                                            <div>
                                                                                                                <form method="post">
                                                                                                                    <div class="form-group row mt-1 col-12 ">

                                                                                                                        <input type="text" name="staff_id" value="<?php echo $staff->staff_id ?>" class="form-control" hidden>

                                                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                                                        <button type="submit" name="delete_staff" class="btn btn-danger">Delete</button>
                                                                                                                    </div>

                                                                                                            </div>
                                                                                                            </form>
                                                                                                        </div>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="md-overlay"></div>
                                                                                    <?php }
                                                                                } ?>
                                                                                        </tr>
                                                                           <?php     }
                                                                        } ?>
                                                                            </tbody>

                                                                        </table>
                                                                        <div class="dataTables_info" id="basic-btn_info" role="status" aria-live="polite"></div>

                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
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
        <?php }} ?>