<?php
session_start();
require_once('../config/config.php');

include('../helpers/datefunction.php');
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
        <?php $page = 'Home'; ?>
        <?php
        include('../helpers/analysis.php');
        include('../partials/head.php') ?>

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
<?php  
#If administration
if($staff_department_head==$staff_id && $staff_department_name =='Administration' || $staff_department_head !=$staff_id ){
?>
                 <!--Body -->
                    <div class="pcoded-main-container">
                        <div class="pcoded-wrapper">
                            <?php include('../partials/navbar.php') ?>
                            <div class="pcoded-content">
                                <div class="pcoded-inner-content">
                                    <div class="main-body">
                                        <div class="page-wrapper">
                                            <div class="page-body">
                                                <div class="row">

                                                    <div class="col-xl-3 col-md-6">
                                                        <div class="card bg-c-yellow text-white">
                                                            <div class="card-block">
                                                                <div class="row align-items-center">
                                                                    <div class="col">
                                                                        <p class="m-b-5">Total Staffs</p>
                                                                        <h4 class="m-b-0"><?php echo number_format($staffs) ?></h4>
                                                                    </div>
                                                                    <div class="col col-auto text-right">
                                                                        <i class="feather icon-users f-50 text-c-yellow"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-3 col-md-6">
                                                        <div class="card bg-c-blue text-white">
                                                            <div class="card-block">
                                                                <div class="row align-items-center">
                                                                    <div class="col">
                                                                        <p class="m-b-5">Total Assets</p>
                                                                        <h4 class="m-b-0"><?php echo number_format($assets) ?></h4>
                                                                    </div>
                                                                    <div class="col col-auto text-right">
                                                                        <i class="feather icon-tag f-50 text-c-blue"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-3 col-md-6">
                                                        <div class="card bg-c-pink text-white">
                                                            <div class="card-block">
                                                                <div class="row align-items-center">
                                                                    <div class="col">
                                                                        <p class="m-b-5">Asset Disposed</p>
                                                                        <h4 class="m-b-0"><?php echo number_format($disposals) ?></h4>
                                                                    </div>
                                                                    <div class="col col-auto text-right">
                                                                        <i class="feather icon-shield f-50 text-c-pink"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-3 col-md-6">
                                                        <div class="card bg-c-green text-white">
                                                            <div class="card-block">
                                                                <div class="row align-items-center">
                                                                    <div class="col">
                                                                        <p class="m-b-5">Total NetWorth</p>
                                                                        <h4 class="m-b-0">Ksh.<?php echo number_format($total_networth, 2) ?></h4>
                                                                    </div>
                                                                    <div class="col col-auto text-right">
                                                                        <i class="feather icon-credit-card f-50 text-c-green"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="col-xl-6 col-md-12">
                                                        <div class="card table-card">
                                                            <div class="card-header">
                                                                <h5>Recent Asset Allocation</h5>
                                                                <div class="card-header-right">
                                                                    <ul class="list-unstyled card-option">
                                                                        <li><i class="fa fa fa-wrench open-card-option"></i>
                                                                        </li>
                                                                        <li><i class="fa fa-window-maximize full-card"></i></li>
                                                                        <li><i class="fa fa-minus minimize-card"></i></li>
                                                                        <li><i class="fa fa-refresh reload-card"></i></li>
                                                                        <li><i class="fa fa-trash close-card"></i></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="card-block">
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover table-borderless">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Asset</th>
                                                                                <th>Department</th>
                                                                                <th>Date</th>
                                                                                <th>Status</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php

                                                                            # Read all Recent allocations
                                                                            $sql = "SELECT *FROM allocations AS al INNER JOIN departments AS dp ON al.allocation_request_by_id = dp.department_head_id INNER JOIN assets AS ast ON al.allocation_asset_id=ast.asset_id ORDER BY al.allocation_request_date  ASC LIMIT 5";
                                                                            $result = mysqli_query($mysqli, $sql);
                                                                            if (mysqli_num_rows($result) > 0) {
                                                                                while ($allocation = mysqli_fetch_object($result)) {

                                                                            ?>
                                                                                    <tr>

                                                                                        <td><?php echo $allocation->asset_name ?></td>
                                                                                        <td><?php echo $allocation->department_name ?></td>
                                                                                        <td><?php echo  formatDateTime($allocation->allocation_request_date) ?></td>
                                                                                        <?php if ($allocation->allocation_status == 'Approved') { ?>
                                                                                            <td><label class="label label-success">Completed</label>
                                                                                            <?php } elseif ($allocation->allocation_status == 'pending') { ?>
                                                                                            <td><label class="label label-primary">pending</label>
                                                                                            <?php } else { ?>
                                                                                            <td><label class="label label-danger">Canceled</label>
                                                                                            </td>
                                                                                        <?php } ?>
                                                                                        </td>
                                                                                    </tr>
                                                                            <?php }
                                                                            } ?>

                                                                        </tbody>
                                                                    </table>
                                                                    <div class="text-right m-r-20">
                                                                        <a href="asset_allocations" class=" b-b-primary text-primary">View all Allocation</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-md-12">
                                                        <div class="card latest-update-card">
                                                            <div class="card-header">
                                                                <h5>Recent Assets</h5>
                                                                <div class="card-header-right">
                                                                    <ul class="list-unstyled card-option">
                                                                        <li><i class="fa fa fa-wrench open-card-option"></i>
                                                                        </li>
                                                                        <li><i class="fa fa-window-maximize full-card"></i></li>
                                                                        <li><i class="fa fa-minus minimize-card"></i></li>
                                                                        <li><i class="fa fa-refresh reload-card"></i></li>
                                                                        <li><i class="fa fa-trash close-card"></i></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="card-block">
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover table-borderless">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Asset Tag</th>
                                                                                <th>Asset Name</th>
                                                                                <th>Asset Type</th>

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php

                                                                            # Read all Recent allocations
                                                                            $sql = "SELECT *FROM assets AS ast INNER JOIN asset_types AS asty ON ast.asset_type_id = asty.asset_type_id ORDER BY ast.asset_date_of_purchase  ASC LIMIT 5";
                                                                            $result = mysqli_query($mysqli, $sql);
                                                                            if (mysqli_num_rows($result) > 0) {
                                                                                while ($asset = mysqli_fetch_object($result)) {

                                                                            ?>
                                                                                    <tr>

                                                                                        <td><?php echo $asset->asset_tag; ?></td>
                                                                                        <td><?php echo $asset->asset_name; ?></td>
                                                                                        <td><?php echo  $asset->asset_type_name; ?></td>

                                                                                    </tr>
                                                                            <?php }
                                                                            } ?>

                                                                        </tbody>
                                                                    </table>
                                                                    <div class="text-right m-r-20">
                                                                        <a href="assets" class=" b-b-primary text-primary">View all Assets</a>
                                                                    </div>
                                                                </div>

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
            <!--Body -->
<?php
#Other department heads
}elseif ($staff_department_head==$staff_id && $staff_department_name !='Administration') { ?>
  <!--Body -->
  <div class="pcoded-main-container">
                        <div class="pcoded-wrapper">
                            <?php include('../partials/navbar.php') ?>
                            <div class="pcoded-content">
                                <div class="pcoded-inner-content">
                                    <div class="main-body">
                                        <div class="page-wrapper">
                                            <div class="page-body">
                                                <div class="row">

                                                    <div class="col-xl-3 col-md-6">
                                                        <div class="card bg-c-yellow text-white">
                                                            <div class="card-block">
                                                                <div class="row align-items-center">
                                                                    <div class="col">
                                                                        <p class="m-b-5">Department Staffs</p>
                                                                        <h4 class="m-b-0"><?php echo number_format($staffs) ?></h4>
                                                                    </div>
                                                                    <div class="col col-auto text-right">
                                                                        <i class="feather icon-users f-50 text-c-yellow"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-3 col-md-6">
                                                        <div class="card bg-c-blue text-white">
                                                            <div class="card-block">
                                                                <div class="row align-items-center">
                                                                    <div class="col">
                                                                        <p class="m-b-5">Total Allocated Assets</p>
                                                                        <h4 class="m-b-0"><?php echo number_format($allocations) ?></h4>
                                                                    </div>
                                                                    <div class="col col-auto text-right">
                                                                        <i class="feather icon-tag f-50 text-c-blue"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-3 col-md-6">
                                                        <div class="card bg-c-pink text-white">
                                                            <div class="card-block">
                                                                <div class="row align-items-center">
                                                                    <div class="col">
                                                                        <p class="m-b-5">Your Asset Disposal</p>
                                                                        <h4 class="m-b-0"><?php echo number_format($disposals) ?></h4>
                                                                    </div>
                                                                    <div class="col col-auto text-right">
                                                                        <i class="feather icon-shield f-50 text-c-pink"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-3 col-md-6">
                                                        <div class="card bg-c-green text-white">
                                                            <div class="card-block">
                                                                <div class="row align-items-center">
                                                                    <div class="col">
                                                                        <p class="m-b-5">Department Asset NetWorth</p>
                                                                        <h4 class="m-b-0">Ksh.<?php echo number_format($total_networth, 2) ?></h4>
                                                                    </div>
                                                                    <div class="col col-auto text-right">
                                                                        <i class="feather icon-credit-card f-50 text-c-green"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="col-xl-6 col-md-12">
                                                        <div class="card table-card">
                                                            <div class="card-header">
                                                                <h5>Recent Asset Allocation</h5>
                                                                <div class="card-header-right">
                                                                    <ul class="list-unstyled card-option">
                                                                        <li><i class="fa fa fa-wrench open-card-option"></i>
                                                                        </li>
                                                                        <li><i class="fa fa-window-maximize full-card"></i></li>
                                                                        <li><i class="fa fa-minus minimize-card"></i></li>
                                                                        <li><i class="fa fa-refresh reload-card"></i></li>
                                                                        <li><i class="fa fa-trash close-card"></i></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="card-block">
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover table-borderless">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Asset</th>
                                                                                <th>Date</th>
                                                                                <th>Status</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php

                                                                            # Read all Recent allocations
                                                                            $sql = "SELECT *FROM allocations AS al INNER JOIN departments AS dp ON al.allocation_request_by_id = dp.department_head_id INNER JOIN assets AS ast ON al.allocation_asset_id=ast.asset_id WHERE dp.department_id='{$staff_department_id}' ORDER BY al.allocation_request_date  ASC LIMIT 5";
                                                                            $result = mysqli_query($mysqli, $sql);
                                                                            if (mysqli_num_rows($result) > 0) {
                                                                                while ($allocation = mysqli_fetch_object($result)) {

                                                                            ?>
                                                                                    <tr>

                                                                                        <td><?php echo $allocation->asset_name ?></td>
                                                                                        <td><?php echo $allocation->department_name ?></td>
                                                                                        <td><?php echo  formatDateTime($allocation->allocation_request_date) ?></td>
                                                                                        <?php if ($allocation->allocation_status == 'Approved') { ?>
                                                                                            <td><label class="label label-success">Completed</label>
                                                                                            <?php } elseif ($allocation->allocation_status == 'pending') { ?>
                                                                                            <td><label class="label label-primary">pending</label>
                                                                                            <?php } else { ?>
                                                                                            <td><label class="label label-danger">Canceled</label>
                                                                                            </td>
                                                                                        <?php } ?>
                                                                                        </td>
                                                                                    </tr>
                                                                            <?php }
                                                                            } ?>

                                                                        </tbody>
                                                                    </table>
                                                                    <div class="text-right m-r-20">
                                                                        <a href="asset_allocations" class=" b-b-primary text-primary">View all Allocation</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-md-12">
                                                        <div class="card latest-update-card">
                                                            <div class="card-header">
                                                                <h5>Recent Assets</h5>
                                                                <div class="card-header-right">
                                                                    <ul class="list-unstyled card-option">
                                                                        <li><i class="fa fa fa-wrench open-card-option"></i>
                                                                        </li>
                                                                        <li><i class="fa fa-window-maximize full-card"></i></li>
                                                                        <li><i class="fa fa-minus minimize-card"></i></li>
                                                                        <li><i class="fa fa-refresh reload-card"></i></li>
                                                                        <li><i class="fa fa-trash close-card"></i></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="card-block">
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover table-borderless">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Asset Tag</th>
                                                                                <th>Asset Name</th>
                                                                                <th>Asset Type</th>

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php

                                                                            # Read all Recent allocations
                                                                            $sql = "SELECT *FROM assets AS ast INNER JOIN asset_types AS asty ON ast.asset_type_id = asty.asset_type_id ORDER BY ast.asset_date_of_purchase  ASC LIMIT 5";
                                                                            $result = mysqli_query($mysqli, $sql);
                                                                            if (mysqli_num_rows($result) > 0) {
                                                                                while ($asset = mysqli_fetch_object($result)) {

                                                                            ?>
                                                                                    <tr>

                                                                                        <td><?php echo $asset->asset_tag; ?></td>
                                                                                        <td><?php echo $asset->asset_name; ?></td>
                                                                                        <td><?php echo  $asset->asset_type_name; ?></td>

                                                                                    </tr>
                                                                            <?php }
                                                                            } ?>

                                                                        </tbody>
                                                                    </table>
                                                                    <div class="text-right m-r-20">
                                                                        <a href="assets" class=" b-b-primary text-primary">View all Assets</a>
                                                                    </div>
                                                                </div>

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
            <!--Body -->
            <?php } ?>
   
                </div>
            </div>


            <?php include('../partials/script.php') ?>
        </body>

        </html>
<?php }
} ?>