<?php
session_start();
require_once('../config/config.php');
include('../helpers/datefunction.php');
include('../helpers/assets.php');
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
        <?php $page = 'Assets'; ?>
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
                                                                <h4>Assets</h4>

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
                                                                <li class="breadcrumb-item" style="float: left;"><a href="#!">Assets</a>
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
                                                               <button type="button" class="btn btn-info btn-outline-info waves-effect md-trigger" data-toggle="modal" data-target=".bd-example-modal-lg">Add New Asset </button>
                                                                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="md-content">
                                                                                <h1 class="text-center">Add New Asset</h1>
                                                                                <div>
                                                                                    <form method="post">
                                                                                        <div class="form-group row mt-1">
                                                                                            <label class="col-form-label">Asset Name:</label>

                                                                                            <input type="text" name="asset_name" class="form-control">


                                                                                        </div>

                                                                                        <div class="form-group row mt-1">
                                                                                            <label class="col-form-label">Asset Tag:</label>

                                                                                            <input type="text" name="asset_tag" value="<?php echo $tag_no ?>" class="form-control" readonly>


                                                                                        </div>
                                                                                        <div class="form-group row mt-1">
                                                                                            <label class="col-form-label">Asset Type:</label>

                                                                                            <select name="asset_type_id" class="form-control">
                                                                                                <?php

                                                                                                # Read all Asset Type
                                                                                                $sql = "SELECT * FROM asset_types";
                                                                                                $result3 = mysqli_query($mysqli, $sql);
                                                                                                if (mysqli_num_rows($result3) > 0) {
                                                                                                    while ($asset_type = mysqli_fetch_object($result3)) {
                                                                                                ?>
                                                                                                        <option value="<?php echo $asset_type->asset_type_id ?>"><?php echo $asset_type->asset_type_name ?></option>
                                                                                                <?php }
                                                                                                }
                                                                                                ?>
                                                                                            </select>
                                                                                        </div>


                                                                                        <div class="form-group row mt-1">
                                                                                            <label class="col-form-label">Asset Description:</label>

                                                                                            <textarea rows="5" cols="5" class="form-control" name="asset_details" placeholder="Enter Here"></textarea>


                                                                                        </div>
                                                                                        <div class="form-group row mt-1">
                                                                                            <label class="col-form-label">Asset price:</label>

                                                                                            <input type="text" name="asset_price" class="form-control">
                                                                                        </div>

                                                                                </div>

                                                                                <div class="row mt-2 ">
                                                                                    <div class="col-6 text-center">
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <button type="submit" name="add_asset" class="btn btn-primary waves-effect ">Add</button>
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

                                                                                    <th class="sorting" tabindex="0" aria-controls="basic-btn" rowspan="1" colspan="1" style="width: 300.367px;" aria-label="Asset Type Name: activate to sort column ascending">Asset Tag</th>
                                                                                    <th class="sorting" tabindex="0" aria-controls="basic-btn" rowspan="1" colspan="1" style="width: 300.367px;" aria-label="Asset Type Name: activate to sort column ascending">Asset Name</th>
                                                                                    <th class="sorting" tabindex="0" aria-controls="basic-btn" rowspan="1" colspan="1" style="width: 250.367px;" aria-label="No of Assets: activate to sort column ascending">Date Of Puchase</th>
                                                                                    <th class="sorting" tabindex="0" aria-controls="basic-btn" rowspan="1" colspan="1" style="width: 250.367px;" aria-label="No of Assets: activate to sort column ascending">Cost</th>
                                                                                    <th tabindex="0" rowspan="1" colspan="1" style="width: 250.367px;" aria-label="Action: activate to sort column ascending">Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php

                                                                                # Read all Asset Type
                                                                                $sql = "SELECT * FROM `assets` ORDER BY `assets`.`asset_date_of_purchase` DESC ";
                                                                                $result = mysqli_query($mysqli, $sql);
                                                                                if (mysqli_num_rows($result) > 0) {
                                                                                    while ($asset = mysqli_fetch_object($result)) {
                                                                                ?>
                                                                                        <tr>
                                                                                            <td class="sorting_1"><?php echo $asset->asset_tag ?></td>
                                                                                            <td><?php echo $asset->asset_name ?></td>
                                                                                            <td><?php echo formatDateTime($asset->asset_date_of_purchase) ?></td>
                                                                                            <td>Ksh . <?php echo $asset->asset_price ?></td>
                                                                                            <td>
                                                                                                <button type="button" class="btn btn-info btn-outline-info waves-effect md-trigger" data-toggle="modal" data-target="#edit-<?php echo $asset->asset_id ?>">Edit</button>
                                                                                                <button type="button" class="btn btn-warning alert-confirm m-b-10 md-trigger" data-toggle="modal" data-target="#delete-<?php echo $asset->asset_id ?>">Delete</button>
                                                                                            </td>

                                                                                            <div class="modal fade" id="edit-<?php echo $asset->asset_id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                                                                <div class="modal-dialog modal-lg">
                                                                                                    <div class="modal-content">
                                                                                                        <div class="md-content">
                                                                                                            <h1 class="text-center">Edit Asset</h1>
                                                                                                            <div>
                                                                                                                <form method="post">
                                                                                                                    <div class="form-group">
                                                                                                                        <label class="">Asset Name:</label>

                                                                                                                        <input type="text" hidden name="asset_id" value="<?php echo $asset->asset_id ?>" class="form-control">
                                                                                                                        <input type="text" name="asset_name" value="<?php echo $asset->asset_name ?>" class="form-control">


                                                                                                                    </div>

                                                                                                                    <div class="form-group  ">
                                                                                                                        <label class="col-12  col-form-label">Asset Tag:</label>

                                                                                                                        <input type="text" name="asset_tag" value="<?php echo $asset->asset_tag ?>" class="form-control" readonly>


                                                                                                                    </div>
                                                                                                                    <div class="form-group row ">
                                                                                                                        <label class="col-12  col-form-label">Asset Type:</label>

                                                                                                                        <select name="asset_type_id" class="form-control">


                                                                                                                            <?php

                                                                                                                            # Read all Asset Type
                                                                                                                            $sql = "SELECT * FROM asset_types";
                                                                                                                            $result2 = mysqli_query($mysqli, $sql);
                                                                                                                            if (mysqli_num_rows($result2) > 0) {
                                                                                                                                while ($asset_type = mysqli_fetch_object($result2)) {
                                                                                                                            ?>
                                                                                                                                    <option value="<?php echo $asset_type->asset_type_id ?>"><?php echo $asset_type->asset_type_name ?></option>
                                                                                                                            <?php }
                                                                                                                            } ?>
                                                                                                                        </select>
                                                                                                                    </div>

                                                                                                            </div>
                                                                                                            <div class="form-group ">
                                                                                                                <label class="col-12">Asset Description:</label>

                                                                                                                <textarea rows="5" cols="5" class="form-control" name="asset_details" placeholder="<?php echo $asset->asset_details ?>"></textarea>


                                                                                                            </div>
                                                                                                            <div class="form-group row ">
                                                                                                                <label class="col-12  col-form-label">Asset price:</label>

                                                                                                                <input type="text" name="asset_price" value="<?php echo $asset->asset_price ?>" class="form-control">


                                                                                                            </div>

                                                                                                            <div class="row ">
                                                                                                                <div class="col-6 text-center">
                                                                                                                    <button type="button" class="btn btn-danger waves-effect md-close">Close</button>
                                                                                                                </div>
                                                                                                                <div class="col-6">
                                                                                                                    <button type="submit" name="update_asset" class="btn btn-primary waves-effect ">Update</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            </form>
                                                                                                        </div>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="modal fade" id="delete-<?php echo $asset->asset_id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                                                                <div class="modal-dialog modal-lg">
                                                                                                    <div class="modal-content">
                                                                                                        <div class="md-content">
                                                                                                            <h1 class="text-center text-color:red" style="color: red;">Delete <?php echo $asset->asset_name ?></h1>
                                                                                                            <div>
                                                                                                                <form method="post">
                                                                                                                    <div class="form-group row mt-1 col-12 ">

                                                                                                                        <input type="text" hidden name="asset_id" value="<?php echo $asset->asset_id ?>" class="form-control">

                                                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                                                        <div class="col-6">
                                                                                                                            <button type="submit" name="delete_asset" class="btn btn-danger waves-effect ">Delete</button>
                                                                                                                        </div>
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