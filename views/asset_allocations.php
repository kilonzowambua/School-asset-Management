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
        <?php $page = 'Assets Allocation'; ?>
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
                                                                <h4>Assets Allocation</h4>

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
                                                                <li class="breadcrumb-item" style="float: left;"><a href="#!">Assets Allocation</a>
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
                                                                        <?php
                                                                        if ($staff_department_head == $staff_id || $staff_department_name == 'Administration') { ?>

                                                                            <table id="basic-btn" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="basic-btn_info">
                                                                                <thead>
                                                                                    <tr role="row">

                                                                                        <th class="sorting" tabindex="0" aria-controls="basic-btn" rowspan="1" colspan="1" style="width: 300.367px;" aria-label="Asset Type Name: activate to sort column ascending">Asset Tag</th>
                                                                                        <th class="sorting" tabindex="0" aria-controls="basic-btn" rowspan="1" colspan="1" style="width: 300.367px;" aria-label="Asset Type Name: activate to sort column ascending">Asset Name</th>
                                                                                        <th class="sorting" tabindex="0" aria-controls="basic-btn" rowspan="1" colspan="1" style="width: 250.367px;" aria-label="No of Assets: activate to sort column ascending">Allocated to</th>

                                                                                        <th tabindex="0" rowspan="1" colspan="1" style="width: 250.367px;" aria-label="Action: activate to sort column ascending">Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    # Read all Asset Types
                                                                                    $sql = "SELECT ast.*, dp.department_name, st.staff_first_name, st.staff_last_name, al.allocation_id,al.allocation_status 
            FROM assets AS ast
            LEFT JOIN allocations AS al ON ast.asset_id = al.allocation_asset_id 
            LEFT JOIN departments AS dp ON al.allocation_department_staff_id = dp.department_staff_id
            LEFT JOIN staffs AS st ON al.allocation_staff_id = st.staff_id
            WHERE ast.assetdispose_id IS NULL
            GROUP BY ast.asset_id
            ORDER BY ast.asset_date_of_purchase DESC";

                                                                                    $result = mysqli_query($mysqli, $sql);
                                                                                    if (mysqli_num_rows($result) > 0) {
                                                                                        while ($asset = mysqli_fetch_object($result)) {
                                                                                            $hasAllocation = $asset->allocation_id !== null;
                                                                                            $hasApproval = $asset->allocation_status == 'Approved';
                                                                                    ?>
                                                                                            <tr>
                                                                                                <td class="sorting_1"><?php echo $asset->asset_tag ?></td>
                                                                                                <td><?php echo $asset->asset_name ?></td>
                                                                                                <td>
                                                                                                    <?php if (!$hasAllocation) : ?>
                                                                                                        <span class="pcoded-badge label label-danger">Not allocated</span>
                                                                                                        <?php elseif ($hasAllocation & !$hasApproval) : ?>
                                                                                                            <span class="pcoded-badge label label-primary">Requested</span>
                                                                                                    <?php elseif ($hasAllocation && ($staff_department_head == $staff_id || $staff_department_name == 'Administration')) : ?>
                                                                                                        <span class="pcoded-badge label label-success"><?php echo $asset->department_name ?></span>
                                                                                                    <?php endif; ?>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <?php if (!$hasAllocation) : ?>
                                                                                                        <button type="button" class="btn btn-success alert-confirm m-b-10 md-trigger" data-toggle="modal" data-target="#request-<?php echo $asset->asset_id ?>">Request Allocate</button>
                                                                                                    <?php elseif ($hasAllocation & !$hasApproval) : ?>
                                                                                                        <button type="button" class="btn btn-primary alert-confirm m-b-10 md-trigger" data-toggle="modal" data-target="#approve-<?php echo $asset->asset_id ?>">Approve Allocation</button>

                                                                                                    <?php elseif ($hasAllocation & $hasApproval) : ?>
                                                                                                        <button type="button" class="btn btn-danger alert-confirm m-b-10 md-trigger" data-toggle="modal" data-target="#remove-<?php echo $asset->asset_id ?>">Remove Allocation</button>
                                                                                                    <?php endif; ?>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <!-- Allocation Request Modal -->
                                                                                            <div class="modal fade" id="request-<?php echo $asset->asset_id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                                                                <!-- Modal content goes here -->
                                                                                                <div class="modal-dialog modal-lg">
                                                                                                    <div class="modal-content">
                                                                                                        <div class="md-content">
                                                                                                            <h1 class="text-center " style="color: blue;"> <?php echo $asset->asset_tag ?><br><?php echo $asset->asset_name ?></h1>
                                                                                                            <?php
                                                                                                            $sql = "SELECT * FROM departments WHERE department_staff_id='{$staff_id}'";
                                                                                                            $result4 = mysqli_query($mysqli, $sql);
                                                                                                            if (mysqli_num_rows($result4) > 0) {
                                                                                                                while ($department = mysqli_fetch_object($result4)) {
                                                                                                            ?>
                                                                                                                    <h4 class="text-center" style="color: black;">Department Name: <?php echo $department->department_name ?></h4>
                                                                                                            <?php }
                                                                                                            } ?>
                                                                                                            <div>
                                                                                                                <form method="post">
                                                                                                                    <div class="form-group row mt-1">

                                                                                                                        <div class="col-sm-6 col-md-6  col-md-4">
                                                                                                                            <input type="text" hidden name="allocation_asset_id" value="<?php echo $asset->asset_id ?>" class="form-control">
                                                                                                                            <input type="text" hidden name="allocation_staff_id" value="<?php echo $staff_id ?>" class="form-control">
                                                                                                                        </div>

                                                                                                                    </div>
                                                                                                                    <div class="row mt-2 ">

                                                                                                                        <div class="col-6">
                                                                                                                            <button type="submit" name="request_asset" class="btn btn-primary waves-effect ">Request Asset</button>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </form>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>


                                                                    </div>
                                                                    <!-- Approve Request Modal -->
                                                                    <div class="modal fade" id="approve-<?php echo $asset->asset_id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                                        <!-- Modal content goes here -->
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="md-content">
                                                                                    <h1 class="text-center " style="color: blue;">Allocation Request</h1>
                                                                                    <?php
                                                                                            $sql = "SELECT * FROM departments AS dp 
                                                                                                            INNER JOIN staffs AS st ON dp.department_id=st.staff_department_id
                                                                                                             INNER JOIN allocations AS al ON st.staff_id=al.allocation_staff_id 
                                                                                                             INNER JOIN assets AS ast ON al.allocation_asset_id=ast.asset_id
                                                                                                             INNER JOIN asset_types AS astt ON ast.asset_type_id=astt.asset_type_id
                                                                                                            WHERE al.allocation_asset_id='{$asset->asset_id}'";
                                                                                            $result4 = mysqli_query($mysqli, $sql);
                                                                                            if (mysqli_num_rows($result4) > 0) {
                                                                                                while ($allocation = mysqli_fetch_object($result4)) {
                                                                                    ?>
                                                                                            <h4 class="text-center" style="color: black;">Asset Details: <?php echo $allocation->asset_tag ?>-<?php echo $allocation->asset_name ?></h4>
                                                                                            <h4 class="text-center" style="color: black;">Asset Type: <?php echo $allocation->asset_type_name ?></h4>
                                                                                            <h4 class="text-center" style="color: black;">Requested By: <?php echo $allocation->staff_first_name  ?> <?php echo $allocation->staff_last_name  ?></h4>
                                                                                            <h4 class="text-center" style="color: black;">Department Name: <?php echo $allocation->department_name ?></h4>
                                                                                            <?php
                                                                                                    $sql = "SELECT * FROM departments  AS dp 
                                                                                                                    INNER JOIN staffs AS sft ON dp.department_staff_id=sft.staff_id
                                                                                                                    WHERE department_id='{$allocation->department_id}'";
                                                                                                    $result5 = mysqli_query($mysqli, $sql);
                                                                                                    if (mysqli_num_rows($result5) > 0) {
                                                                                                        while ($hod = mysqli_fetch_object($result5)) {

                                                                                            ?>
                                                                                                    <h4 class="text-center" style="color: black;">Head of Department : <?php echo $hod->staff_first_name  ?> <?php echo $hod->staff_last_name  ?></h4>
                                                                                            <?php }
                                                                                                    } ?>
                                                                                            <div>
                                                                                                <form method="post">


                                                                                                    <div class="col-sm-6 col-md-6  col-md-4">
                                                                                                        <input type="text" hidden name="allocation_asset_id" value="<?php echo $asset->asset_id ?>" class="form-control">
                                                                                                        <input type="text" hidden name=" allocation_department_staff_id" value="<?php echo $staff_id ?>" class="form-control">
                                                                                                        <input type="text" hidden name="asset_allocation_id" value="<?php echo $allocation->allocation_id ?>" class="form-control">
                                                                                                    </div>
                                                                                                    <div class="form-group row ">
                                                                                                        <label for="reply" class="col-12 col-form-label">Reply:</label>
                                                                                                        <select class="col-12 form-controls " name="reply_type">
                                                                                                            <option value="">Select Reply</option>
                                                                                                            <option value="Approved">Approved</option>
                                                                                                            <option value="Cancelled">Cancelled</option>

                                                                                                        </select>
                                                                                                    </div>



                                                                                                    <div class="col-6">
                                                                                                        <button type="submit" name="reply_request" class="btn btn-primary waves-effect ">Reply Request</button>
                                                                                                    </div>
                                                                                            </div>
                                                                                            </form>
                                                                                    <?php }
                                                                                            }
                                                                                    ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <!-- Remove Allocation Modal -->
                                                                    <div class="modal fade" id="remove-<?php echo $asset->asset_id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                                        <!-- Modal content goes here -->
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="md-content">
                                                                                    <h1 class="text-center " style="color: blue;">Change Allocation Status</h1>
                                                                                    <?php
                                                                                            $sql = "SELECT * FROM departments AS dp 
                                                                                                            INNER JOIN staffs AS st ON dp.department_id=st.staff_department_id
                                                                                                             INNER JOIN allocations AS al ON st.staff_id=al.allocation_staff_id 
                                                                                                             INNER JOIN assets AS ast ON al.allocation_asset_id=ast.asset_id
                                                                                                             INNER JOIN asset_types AS astt ON ast.asset_type_id=astt.asset_type_id
                                                                                                            WHERE al.allocation_asset_id='{$asset->asset_id}'";
                                                                                            $result4 = mysqli_query($mysqli, $sql);
                                                                                            if (mysqli_num_rows($result4) > 0) {
                                                                                                while ($allocation = mysqli_fetch_object($result4)) {
                                                                                    ?>
                                                                                            <h4 class="text-center" style="color: black;">Asset Details: <?php echo $allocation->asset_tag ?>-<?php echo $allocation->asset_name ?></h4>
                                                                                            <h4 class="text-center" style="color: black;">Asset Type: <?php echo $allocation->asset_type_name ?></h4>
                                                                                            <h4 class="text-center" style="color: black;">Requested By: <?php echo $allocation->staff_first_name  ?> <?php echo $allocation->staff_last_name  ?></h4>
                                                                                            <h4 class="text-center" style="color: black;">Department Name: <?php echo $allocation->department_name ?></h4>
                                                                                            <?php
                                                                                                    $sql = "SELECT * FROM departments  AS dp 
                                                                                                                    INNER JOIN staffs AS sft ON dp.department_staff_id=sft.staff_id
                                                                                                                    WHERE department_id='{$allocation->department_id}'";
                                                                                                    $result5 = mysqli_query($mysqli, $sql);
                                                                                                    if (mysqli_num_rows($result5) > 0) {
                                                                                                        while ($hod = mysqli_fetch_object($result5)) {

                                                                                            ?>
                                                                                                    <h4 class="text-center" style="color: black;">Head of Department : <?php echo $hod->staff_first_name  ?> <?php echo $hod->staff_last_name  ?></h4>
                                                                                            <?php }
                                                                                                    } ?>
                                                                                            <div>
                                                                                                <form method="post">


                                                                                                    <div class="col-sm-6 col-md-6  col-md-4">

                                                                                                        <input type="text" hidden name="allocation_asset_id" value="<?php echo $allocation->allocation_asset_id ?>" class="form-control">
                                                                                                    </div>


                                                                                                    <div class="col-6">
                                                                                                        <button type="submit" name="dislocate_asset" class="btn btn-danger waves-effect ">Remove allocate</button>
                                                                                                    </div>
                                                                                            </div>
                                                                                            </form>
                                                                                    <?php }
                                                                                            }

                                                                                    ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            <?php
                                                                                        }
                                                                                    }
                                                            ?>
                                                            </tbody>

                                                            </table>
                                                        <?php } elseif ($staff_department_head != $staff_id && $staff_department_name != 'Administration') { ?>
                                                            <table id="basic-btn" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="basic-btn_info">
                                                                <thead>
                                                                    <tr role="row">

                                                                        <th class="sorting" tabindex="0" aria-controls="basic-btn" rowspan="1" colspan="1" style="width: 300.367px;" aria-label="Asset Type Name: activate to sort column ascending">Asset Tag</th>
                                                                        <th class="sorting" tabindex="0" aria-controls="basic-btn" rowspan="1" colspan="1" style="width: 300.367px;" aria-label="Asset Type Name: activate to sort column ascending">Asset Name</th>
                                                                        <th tabindex="0" rowspan="1" colspan="1" style="width: 250.367px;" aria-label="Action: activate to sort column ascending">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                            $sql = "SELECT ast.*, dp.department_name, st.staff_first_name, st.staff_last_name,al.allocation_staff_id , al.allocation_id,al.allocation_status 
                                                                            FROM assets AS ast
                                                                            LEFT JOIN allocations AS al ON ast.asset_id = al.allocation_asset_id 
                                                                            LEFT JOIN departments AS dp ON al.allocation_department_staff_id = dp.department_staff_id
                                                                            LEFT JOIN staffs AS st ON al.allocation_staff_id = st.staff_id
                                                                            WHERE ast.assetdispose_id IS NULL
                                                                            GROUP BY ast.asset_id
                                                                            ORDER BY ast.asset_date_of_purchase DESC";

                                                                            $result = mysqli_query($mysqli, $sql);

                                                                            if (mysqli_num_rows($result) > 0) {
                                                                                while ($asset = mysqli_fetch_object($result)) {
                                                                                    $hasAllocation = $asset->allocation_id !== null;
                                                                    ?>
                                                                            <tr>
                                                                                <td class="sorting_1"><?php echo $asset->asset_tag ?></td>
                                                                                <td><?php echo $asset->asset_name ?></td>
                                                                                <td>
                                                                                    <?php if ($hasAllocation) {
                                                                                        if ($asset->allocation_staff_id == $staff_id) {
                                                                                            echo "Your Request is Pending Approval";
                                                                                        } else {
                                                                                            echo "Not Available";
                                                                                        }
                                                                                    } else { ?>
                                                                                        <button type="button" class="btn btn-info alert-confirm m-b-10 md-trigger" data-toggle="modal" data-target="#request-<?php echo $asset->asset_id ?>">Request Allocate</button>
                                                                                    <?php } ?>
                                                                                </td>
                                                                            </tr>
                                                                            <!-- Allocation Request Modal -->
                                                                            <div class="modal fade" id="request-<?php echo $asset->asset_id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                                                <!-- Modal content goes here -->
                                                                                 
                                                                                                <!-- Modal content goes here -->
                                                                                                <div class="modal-dialog modal-lg">
                                                                                                    <div class="modal-content">
                                                                                                        <div class="md-content">
                                                                                                            <h1 class="text-center " style="color: blue;"> <?php echo $asset->asset_tag ?><br><?php echo $asset->asset_name ?></h1>
                                                                                                            <?php
                                                                                                            $sql = "SELECT * FROM departments WHERE department_staff_id='{$staff_id}'";
                                                                                                            $result4 = mysqli_query($mysqli, $sql);
                                                                                                            if (mysqli_num_rows($result4) > 0) {
                                                                                                                while ($department = mysqli_fetch_object($result4)) {
                                                                                                            ?>
                                                                                                                    <h4 class="text-center" style="color: black;">Department Name: <?php echo $department->department_name ?></h4>
                                                                                                            <?php }
                                                                                                            } ?>
                                                                                                            <div>
                                                                                                                <form method="post">
                                                                                                                    <div class="form-group row mt-1">

                                                                                                                        <div class="col-sm-6 col-md-6  col-md-4">
                                                                                                                            <input type="text" hidden name="allocation_asset_id" value="<?php echo $asset->asset_id ?>" class="form-control">
                                                                                                                            <input type="text" hidden name="allocation_staff_id" value="<?php echo $staff_id ?>" class="form-control">
                                                                                                                        </div>

                                                                                                                    </div>
                                                                                                                    <div class="row mt-2 ">

                                                                                                                        <div class="col-6">
                                                                                                                            <button type="submit" name="request_asset" class="btn btn-primary waves-effect ">Request Asset</button>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </form>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>


                                                                    </div>
                                                                            
                                                                    <?php
                                                                                }
                                                                            }
                                                                    ?>
                                                                </tbody>


                                                                </tbody>

                                                            </table>
                                                        <?php } ?>
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