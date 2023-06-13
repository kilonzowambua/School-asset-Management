<?php
session_start();
require_once('../config/config.php');
include('../helpers/analysis.php');
include('../helpers/datefunction.php');
include('../helpers/asset_type.php');
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
        <!DOCTYPE html>
        <html lang="en">
        <?php $page = 'Asset Type'; ?>
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
                                                                <h4>Asset Types</h4>

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
                                                                <li class="breadcrumb-item" style="float: left;"><a href="#!">Asset Types</a>
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
                                                                <button type="button" class="btn btn-info btn-outline-info waves-effect md-trigger" data-modal="modal-12">New Asset type</button>
                                                                <div class="md-modal md-effect-12" id="modal-12">
                                                                    <div class="md-content">
                                                                        <h1 class="text-center">Add New Asset Type</h1>
                                                                        <div>
                                                                            <form method="post">
                                                                                <div class="form-group row mt-1">
                                                                                    <label class="col-sm-12 col-md-6  col-md-4  col-form-label">Asset Type Name:</label>
                                                                                    <div class="col-sm-12 col-md-6  col-md-4">
                                                                                        <input type="text" name="asset_type_name" class="form-control">
                                                                                    </div>

                                                                                </div>

                                                                                <div class="row mt-2 ">
                                                                                    <div class="col-6 text-center">
                                                                                        <button type="button" class="btn btn-danger waves-effect md-close">Close</button>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <button type="submit" name="add_asset_type" class="btn btn-primary waves-effect ">Add</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
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

                                                                                    <th class="sorting" tabindex="0" aria-controls="basic-btn" rowspan="1" colspan="1" style="width: 300.367px;" aria-label="Asset Type Name: activate to sort column ascending">Asset Type Name</th>
                                                                                    <th class="sorting" tabindex="0" aria-controls="basic-btn" rowspan="1" colspan="1" style="width: 250.367px;" aria-label="No of Assets: activate to sort column ascending">No of Assets</th>
                                                                                    <th tabindex="0" aria-controls="basic-btn" rowspan="1" colspan="1" style="width: 250.367px;" aria-label="Action: activate to sort column ascending">Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php

                                                                                # Read all Asset Type
                                                                                $sql = "SELECT a_t.asset_type_id,COUNT(a_s.asset_id) AS total_assets,a_t.asset_type_name FROM asset_types AS a_t 
                                                                                INNER JOIN assets AS a_s ON a_t.asset_type_id=a_s.asset_type_id";
                                                                                $result = mysqli_query($mysqli, $sql);
                                                                                if (mysqli_num_rows($result) > 0) {
                                                                                    while ($asset_type = mysqli_fetch_object($result)) {
                                                                                ?>

                                                                                        <tr role="row" class="odd">
                                                                                            <td class="sorting_1"><?php echo $asset_type->asset_type_name ?></td>
                                                                                            <td><?php echo number_format($asset_type->total_assets, 0) ?></td>
                                                                                            <td>
                                                                                                <button type="button" class="btn btn-primary btn-outline-primary waves-effect md-trigger" data-modal="edit-<?php echo $asset_type->asset_type_id ?>">Edit</button>
                                                                                                <button type="button" class="btn btn-warning alert-confirm m-b-10 md-trigger" data-modal="delete-<?php echo $asset_type->asset_type_id ?>">Delete</button>
                                                                                                <div class="md-modal md-effect-12" id="edit-<?php echo $asset_type->asset_type_id ?>">
                                                                                                    <div class="md-content">
                                                                                                        <h1 class="text-center">Edit - <?php echo $asset_type->asset_type_name ?></h1>
                                                                                                        <div>
                                                                                                            <form method="post">
                                                                                                                <div class="form-group row mt-1">
                                                                                                                    <label class="col-sm-12 col-md-6  col-md-4  col-form-label">Asset Type Name:</label>
                                                                                                                    <div class="col-sm-12 col-md-6  col-md-4">
                                                                                                                        <input type="text" hidden name="asset_type_id" value="<?php echo $asset_type->asset_type_id ?>" class="form-control">
                                                                                                                        <input type="text" name="asset_type_name" value="<?php echo $asset_type->asset_type_name ?>" class="form-control">
                                                                                                                    </div>

                                                                                                                </div>

                                                                                                                <div class="row mt-2 ">
                                                                                                                    <div class="col-6 text-center">
                                                                                                                        <button type="button" class="btn btn-danger waves-effect md-close">Close</button>
                                                                                                                    </div>
                                                                                                                    <div class="col-6">
                                                                                                                        <button type="submit" name="update_asset_type" class="btn btn-primary waves-effect ">Update</button>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </form>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="md-modal md-effect-12" id="delete-<?php echo $asset_type->asset_type_id ?>">
                                                                                                    <div class="md-content">
                                                                                                        <h1 class="text-danger">Delete - <?php echo $asset_type->asset_type_name ?></h1>
                                                                                                        <div>
                                                                                                            <form method="post">
                                                                                                                <div class="form-group row mt-1">
                                                                                                                   
                                                                                                                    <div class="col-sm-12 col-md-6  col-md-4">
                                                                                                                        <input type="text" hidden name="asset_type_id" value="<?php echo $asset_type->asset_type_id ?>" class="form-control">
                                                                                                                    </div>

                                                                                                                </div>

                                                                                                                <div class="row mt-2 ">
                                                                                                                    <div class="col-6 text-center">
                                                                                                                        <button type="button" class="btn btn-danger waves-effect md-close">Close</button>
                                                                                                                    </div>
                                                                                                                    <div class="col-6">
                                                                                                                        <button type="submit" name="delete_asset_type" class="btn btn-primary waves-effect ">Delete</button>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </form>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="md-overlay"></div>
                                                                                            </td>
                                                                                        </tr>
                                                                                <?php }
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
                </div>
            </div>


            <?php include('../partials/script.php') ?>
        </body>

        </html>
<?php }
}
?>