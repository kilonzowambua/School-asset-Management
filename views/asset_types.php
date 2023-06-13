<?php
session_start();
require_once('../config/config.php');
include('../helpers/analysis.php');
include('../helpers/datefunction.php');
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
                                                                <h4>Basic Table Sizes</h4>
                                                                <span>lorem ipsum dolor sit amet, consectetur adipisicing
                                                                    elit</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="page-header-breadcrumb">
                                                            <ul class="breadcrumb-title">
                                                                <li class="breadcrumb-item" style="float: left;">
                                                                    <a href="../index-2.html"> <i class="feather icon-home"></i> </a>
                                                                </li>
                                                                <li class="breadcrumb-item" style="float: left;"><a href="#!">Bootstrap Table</a>
                                                                </li>
                                                                <li class="breadcrumb-item" style="float: left;"><a href="#!">Basic
                                                                        Initialization</a>
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
                                                            <div class="card-header">
                                                                <h5>Multi-Column Ordering</h5>
                                                                <span>DataTables allows ordering by multiple columns at the same
                                                                    time, which can be activated in a number of different
                                                                    ways</span>
                                                            </div>
                                                            <div class="card-block">
                                                                <div class="dt-responsive table-responsive">
                                                                    <div id="multi-colum-dt_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                                        <div class="row">
                                                                            <div class="col-xs-12 col-sm-12 col-sm-12 col-md-6">
                                                                                <div class="dataTables_length" id="multi-colum-dt_length"><label>Show <select name="multi-colum-dt_length" aria-controls="multi-colum-dt" class="form-control input-sm">
                                                                                            <option value="10">10</option>
                                                                                            <option value="25">25</option>
                                                                                            <option value="50">50</option>
                                                                                            <option value="100">100</option>
                                                                                        </select> entries</label></div>
                                                                            </div>
                                                                            <div class="col-xs-12 col-sm-12 col-md-6">
                                                                                <div id="multi-colum-dt_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="multi-colum-dt"></label></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-xs-12 col-sm-12">
                                                                                <table id="multi-colum-dt" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="multi-colum-dt_info">
                                                                                    <thead>
                                                                                        <tr role="row">
                                                                                            <th class="sorting_asc" tabindex="0" aria-controls="multi-colum-dt" rowspan="1" colspan="1" style="width: 158.817px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Name</th>
                                                                                            <th class="sorting" tabindex="0" aria-controls="multi-colum-dt" rowspan="1" colspan="1" style="width: 239.367px;" aria-label="Position: activate to sort column ascending">Position</th>
                                                                                            <th class="sorting" tabindex="0" aria-controls="multi-colum-dt" rowspan="1" colspan="1" style="width: 113.283px;" aria-label="Office: activate to sort column ascending">Office</th>
                                                                                            <th class="sorting" tabindex="0" aria-controls="multi-colum-dt" rowspan="1" colspan="1" style="width: 53.3667px;" aria-label="Age: activate to sort column ascending">Age</th>
                                                                                            <th class="sorting" tabindex="0" aria-controls="multi-colum-dt" rowspan="1" colspan="1" style="width: 115.533px;" aria-label="Start date: activate to sort column ascending">Start date</th>
                                                                                            <th class="sorting" tabindex="0" aria-controls="multi-colum-dt" rowspan="1" colspan="1" style="width: 77.8333px;" aria-label="Salary: activate to sort column ascending">Salary</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr role="row" class="odd">
                                                                                            <td class="sorting_1 sorting_2">Airi Satou</td>
                                                                                            <td>Accountant</td>
                                                                                            <td>Tokyo</td>
                                                                                            <td>33</td>
                                                                                            <td>2008/11/28</td>
                                                                                            <td>$162,700</td>
                                                                                        </tr>
                                                                                        <tr role="row" class="even">
                                                                                            <td class="sorting_1 sorting_2">Ashton Cox</td>
                                                                                            <td>Junior Technical Author</td>
                                                                                            <td>San Francisco</td>
                                                                                            <td>66</td>
                                                                                            <td>2009/01/12</td>
                                                                                            <td>$86,000</td>
                                                                                        </tr>
                                                                                        <tr role="row" class="odd">
                                                                                            <td class="sorting_1 sorting_2">Bradley Greer</td>
                                                                                            <td>Software Engineer</td>
                                                                                            <td>London</td>
                                                                                            <td>41</td>
                                                                                            <td>2012/10/13</td>
                                                                                            <td>$132,000</td>
                                                                                        </tr>
                                                                                        <tr role="row" class="even">
                                                                                            <td class="sorting_1 sorting_2">Brielle Williamson</td>
                                                                                            <td>Integration Specialist</td>
                                                                                            <td>New York</td>
                                                                                            <td>61</td>
                                                                                            <td>2012/12/02</td>
                                                                                            <td>$372,000</td>
                                                                                        </tr>
                                                                                        <tr role="row" class="odd">
                                                                                            <td class="sorting_1 sorting_2">Cedric Kelly</td>
                                                                                            <td>Senior Javascript Developer</td>
                                                                                            <td>Edinburgh</td>
                                                                                            <td>22</td>
                                                                                            <td>2012/03/29</td>
                                                                                            <td>$433,060</td>
                                                                                        </tr>
                                                                                        <tr role="row" class="even">
                                                                                            <td class="sorting_1 sorting_2">Charde Marshall</td>
                                                                                            <td>Regional Director</td>
                                                                                            <td>San Francisco</td>
                                                                                            <td>36</td>
                                                                                            <td>2008/10/16</td>
                                                                                            <td>$470,600</td>
                                                                                        </tr>
                                                                                        <tr role="row" class="odd">
                                                                                            <td class="sorting_1 sorting_2">Colleen Hurst</td>
                                                                                            <td>Javascript Developer</td>
                                                                                            <td>San Francisco</td>
                                                                                            <td>39</td>
                                                                                            <td>2009/09/15</td>
                                                                                            <td>$205,500</td>
                                                                                        </tr>
                                                                                        <tr role="row" class="even">
                                                                                            <td class="sorting_1 sorting_2">Dai Rios</td>
                                                                                            <td>Personnel Lead</td>
                                                                                            <td>Edinburgh</td>
                                                                                            <td>35</td>
                                                                                            <td>2012/09/26</td>
                                                                                            <td>$217,500</td>
                                                                                        </tr>
                                                                                        <tr role="row" class="odd">
                                                                                            <td class="sorting_1 sorting_2">Garrett Winters</td>
                                                                                            <td>Accountant</td>
                                                                                            <td>Tokyo</td>
                                                                                            <td>63</td>
                                                                                            <td>2011/07/25</td>
                                                                                            <td>$170,750</td>
                                                                                        </tr>
                                                                                        <tr role="row" class="even">
                                                                                            <td class="sorting_1 sorting_2">Gloria Little</td>
                                                                                            <td>Systems Administrator</td>
                                                                                            <td>New York</td>
                                                                                            <td>59</td>
                                                                                            <td>2009/04/10</td>
                                                                                            <td>$237,500</td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                    <tfoot>
                                                                                        <tr>
                                                                                            <th rowspan="1" colspan="1">Name</th>
                                                                                            <th rowspan="1" colspan="1">Position</th>
                                                                                            <th rowspan="1" colspan="1">Office</th>
                                                                                            <th rowspan="1" colspan="1">Age</th>
                                                                                            <th rowspan="1" colspan="1">Start date</th>
                                                                                            <th rowspan="1" colspan="1">Salary</th>
                                                                                        </tr>
                                                                                    </tfoot>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-xs-12 col-sm-12 col-md-5">
                                                                                <div class="dataTables_info" id="multi-colum-dt_info" role="status" aria-live="polite">Showing 1 to 10 of 20 entries</div>
                                                                            </div>
                                                                            <div class="col-xs-12 col-sm-12 col-md-7">
                                                                                <div class="dataTables_paginate paging_simple_numbers" id="multi-colum-dt_paginate">
                                                                                    <ul class="pagination">
                                                                                        <li class="paginate_button page-item previous disabled" id="multi-colum-dt_previous"><a href="#" aria-controls="multi-colum-dt" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                                                                                        <li class="paginate_button page-item active"><a href="#" aria-controls="multi-colum-dt" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                                                                        <li class="paginate_button page-item "><a href="#" aria-controls="multi-colum-dt" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                                                                        <li class="paginate_button page-item next" id="multi-colum-dt_next"><a href="#" aria-controls="multi-colum-dt" data-dt-idx="3" tabindex="0" class="page-link">Next</a></li>
                                                                                    </ul>
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
                    </div>
                </div>
            </div>


            <?php include('../partials/script.php') ?>
        </body>

        </html>
<?php }
} ?>