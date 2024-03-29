<?php
session_start();
require_once('../config/config.php');
include('../helpers/datefunction.php');
include('../helpers/assets.php');
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
        <?php ?>
        <!DOCTYPE html>
        <html lang="en">
        <?php $page = 'Assets Disposal'; ?>
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
                                                                <h4>Assets Disposal</h4>

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
                                                                                    <th class="sorting" tabindex="0" aria-controls="basic-btn" rowspan="1" colspan="1" style="width: 250.367px;" aria-label="No of Assets: activate to sort column ascending">Status</th>

                                                                                    <th tabindex="0" rowspan="1" colspan="1" style="width: 250.367px;" aria-label="Action: activate to sort column ascending">Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php

                                                                                # Read all Asset Typ
                                                                                $sql = "SELECT * FROM assets AS ast 
                                                                                ORDER BY asset_date_of_purchase DESC";
                                                                                $result = mysqli_query($mysqli, $sql);
                                                                                if (mysqli_num_rows($result) > 0) {
                                                                                    while ($asset = mysqli_fetch_object($result)) {
                                                                                ?>
                                                                                        <tr>
                                                                                            <td class="sorting_1"><?php echo $asset->asset_tag ?></td>
                                                                                            <td><?php echo $asset->asset_name ?></td>
                                                                                            <td><?php if ($asset->assetdispose_id == '') { ?>
                                                                                                    <span class="pcoded-badge label label-info">Avaliable</span>
                                                                                                <?php } elseif ($asset->assetdispose_id != '') { ?>
                                                                                                    <span class="pcoded-badge label label-danger">Disposed</span>

                                                                                                <?php } ?>
                                                                                            </td>

                                                                                            <td>
                                                                                                <?php if ($asset->assetdispose_id == '') { ?>
                                                                                                    <button type="button" class="btn btn-warning alert-confirm m-b-10 md-trigger" data-toggle="modal" data-target="#dispose-<?php echo $asset->asset_id ?>">Dispose </button>
                                                                                                <?php } elseif ($asset->assetdispose_id != '') { ?>
                                                                                                    <button type="button" class="btn btn-info btn-outline-info waves-effect md-trigger" data-toggle="modal" data-target="#view-<?php echo $asset->asset_id ?>">View</button>
                                                                                                <?php } ?>
                                                                                            </td>
                                                                                            <div class="modal fade" id="dispose-<?php echo $asset->asset_id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                                                                <div class="modal-dialog modal-lg">
                                                                                                    <div class="modal-content">
                                                                                                        <div class="md-content">
                                                                                                            <h1 class="text-center " style="color: red;">Dispose <?php echo $asset->asset_tag ?>-<?php echo $asset->asset_name ?></h1>
                                                                                                            <div>
                                                                                                                <form method="post">
                                                                                                                    <div class="form-group row mt-1">

                                                                                                                        <div class="col-sm-6 col-md-6  col-md-4">
                                                                                                                            <input type="text" hidden name="assetdispose_asset_id" value="<?php echo $asset->asset_id ?>" class="form-control">
                                                                                                                            <input type="text" hidden name="assetdispose_staff_id" value="<?php echo $staff_id ?>" class="form-control">
                                                                                                                        </div>

                                                                                                                    </div>


                                                                                                                    <div class="form-group row mt-1">
                                                                                                                        <label class="col-12 col-form-label">Method:</label>

                                                                                                                        <select name="assetdispose_method" class="form-control">

                                                                                                                            <option selected>Resale</option>
                                                                                                                            <option>Recycle</option>
                                                                                                                            <option>Donate</option>
                                                                                                                        </select>


                                                                                                                    </div>
                                                                                                                    <div class="form-group row ">
                                                                                                                        <label class="col-12 col-form-label">Reason:</label>

                                                                                                                        <textarea rows="5" cols="5" class="form-control" name="assetdispose_reason" placeholder="Enter Here"></textarea>


                                                                                                                    </div>


                                                                                                                    <div class="row mt-2 ">

                                                                                                                        <div class="col-6">
                                                                                                                            <button type="submit" name="dispose_asset" class="btn btn-primary waves-effect ">Dispose</button>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </form>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                                <div class="modal fade" id="view-<?php echo $asset->asset_id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                                                                    <div class="modal-dialog modal-lg">
                                                                                                        <div class="modal-content">
                                                                                                            <div class="md-content">
                                                                                                                <h1 class="text-center">View <?php echo $asset->asset_name ?></h1>
                                                                                                               
                                                                                                                    <form method="post">
                                                                                                                        <div class="form-group col-12">
                                                                                                                            <label class="col-form-label">Asset Name:</label>

                                                                                                                            <input type="text" value="<?php echo $asset->asset_name ?>" readonly class="form-control">


                                                                                                                        </div>
                                                                                                                        <div class="form-group col-12">
                                                                                                                            <label class="col-form-label">Asset Tag:</label>

                                                                                                                            <input type="text" value="<?php echo $asset->asset_tag ?>" readonly class="form-control">

                                                                                                                        </div>

                                                                                                                        <div class="form-group col-12">
                                                                                                                            <label class="col-form-label">Asset Type:</label>


                                                                                                                            <?php

                                                                                                                            # Read all Asset Type
                                                                                                                            $sql = "SELECT * FROM asset_types WHERE asset_type_id='{$asset->asset_type_id}'";
                                                                                                                            $result3 = mysqli_query($mysqli, $sql);
                                                                                                                            if (mysqli_num_rows($result3) > 0) {
                                                                                                                                while ($asset_type = mysqli_fetch_object($result3)) {
                                                                                                                            ?>
                                                                                                                                    <input type="text" value="<?php echo $asset_type->asset_type_name ?>" class="form-control" readonly>
                                                                                                                            <?php }
                                                                                                                            }
                                                                                                                            ?>

                                                                                                                        </div>
                                                                                                               
                                                                                                                <?php
                                                                                                                # Read all Asset Dispose
                                                                                                                $sql = "SELECT * FROM assetdisposes WHERE assetdispose_asset_id='{$asset->asset_id}' LIMIT 1";
                                                                                                                $result4 = mysqli_query($mysqli, $sql);
                                                                                                                if (mysqli_num_rows($result4) > 0) {
                                                                                                                    while ($asset_dispose = mysqli_fetch_object($result4)) {
                                                                                                                ?>
                                                                                                                        <div class="form-group col-12">
                                                                                                                            <label class="col-form-label">Asset Dispose Method:</label>

                                                                                                                            <input type="text" value="<?php echo $asset_dispose->assetdispose_method ?>" readonly class="form-control">


                                                                                                                        </div>
                                                                                                                        <div class="form-group col-12">
                                                                                                                            <label class="col-form-label">Asset Dispose Description:</label>

                                                                                                                            <textarea rows="5" cols="5" class="form-control" readonly><?php echo $asset_dispose->assetdispose_reason ?></textarea>


                                                                                                                        </div>
                                                                                                                        <div class="form-group col-12">
                                                                                                                            <label class="col-form-label">Asset Dispose Date:</label>

                                                                                                                            <input type="text" readonly value="<?php echo formatDateTime($asset_dispose->assetdispose_date) ?>" class="form-control">


                                                                                                                        </div>
                                                                                                                        <div class="form-group col-12">
                                                                                                                            <label class="col-form-label">Asset Disposed By:</label>

                                                                                                                            <?php

                                                                                                                            # Read all Asset Type
                                                                                                                            $sql = "SELECT * FROM staffs WHERE staff_id='{$asset_dispose->assetdispose_staff_id}'";
                                                                                                                            $result5 = mysqli_query($mysqli, $sql);
                                                                                                                            if (mysqli_num_rows($result5) > 0) {
                                                                                                                                while ($staff = mysqli_fetch_object($result5)) {
                                                                                                                            ?>
                                                                                                                                    <input type="text" readonly value="<?php echo $staff->staff_first_name ?>  <?php echo $staff->staff_last_name ?>" class="form-control">
                                                                                                                            <?php }
                                                                                                                            } ?>

                                                                                                                        </div>
                                                                                                                <?php }
                                                                                                                } ?>
                                                                                                                
                                                                                                            <?php }
                                                                                                    } ?>
                                                                                                               
                                                                                                                </form>
                                                                                                          
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                              

                                                                                        </tr>

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
} ?>