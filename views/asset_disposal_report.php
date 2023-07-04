<?php
session_start();
require_once('../config/config.php');
include('../helpers/datefunction.php');
include('../helpers/reports.php');
/* Load This Page With Logged In User Session */
$staff_id = mysqli_escape_string($mysqli, $_SESSION['staff_id']);
$staff_sql = mysqli_query($mysqli, "SELECT * FROM staffs WHERE staff_id = '{$staff_id}'");
if (mysqli_num_rows($staff_sql) > 0) {
    while ($staff = mysqli_fetch_array($staff_sql)) {
        /* Global Usernames */
        $staff_first_name = $staff['staff_first_name'];
        $staff_last_name = $staff['staff_last_name'];
        $staff_department_id  = $staff['staff_department_id'];
        global $staff_first_name;
        global $$staff_last_name;
        global $staff_department_id;
?>
        <?php ?>
        <!DOCTYPE html>
        <html lang="en">
        <?php $page = 'Asset Disposal Report'; ?>
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
                                                                <h4>Asset Disposal</h4>

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
                                                                <li class="breadcrumb-item" style="float: left;"><a href="#!">Asset disposal Report</a>
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
                                                            
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h5>Asset Disposal Report</h5>

                                                                    <div class="card-header-right">
                                                                        <i class="icofont icofont-spinner-alt-5"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="card-block">

                                                                    <form method="post">
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-2 col-form-label">From </label>
                                                                            <div class="col-sm-4 col-md-6 col-lg 4">
                                                                                <input type="date" name="start" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-2 col-form-label">To </label>
                                                                            <div class="col-sm-4 col-md-6 col-lg 4">
                                                                                <input type="date" name="end" id="#dropper-radius" class="form-control">
                                                                            </div>
                                                                        </div>

                                                                        
                                                                            <div class="form-group row">
                                                                            <label class="col-sm-2 col-form-label">Select Document </label>
                                                                            <div class="col-sm-4 col-md-6 col-lg 4">
                                                                            <select name="doc_type" class="form-control form-control-default">

<option>Pdf</option>
<option>Excel</option>

</select>
                                                                            </div>
                                                                            </div>
                                                                            <div class="form-group row text-center">
                                                                            <button type="submit" name="asset_disposal_report" class="btn btn-primary btn-round align-text center">Generate</button>
                                                                            </div>
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