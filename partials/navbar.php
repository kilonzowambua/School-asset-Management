<?php
#If administration
if($staff_department_head==$staff_id && $staff_department_name =='Administration' || $staff_department_head !=$staff_id ){
?>


<nav class="pcoded-navbar">
<div class="pcoded-inner-navbar main-menu">
<div class="pcoded-navigatio-lavel">Navigation</div>
<ul class="pcoded-item pcoded-left-item">
<li class="pcoded-hasmenu">
<a href="dashboard">
<span class="pcoded-micon"><i class="feather icon-home"></i></span>
<span class="pcoded-mtext">Dashboard</span>
</a>
</li>

<li class="">
<a href="assets">
<span class="pcoded-micon"><i class="feather icon-tag"></i></span>
<span class="pcoded-mtext">Assets</span>
</a>
</li>

<li class="">
<a href="asset_types">
<span class="pcoded-micon"><i class="feather icon-file"></i></span>
<span class="pcoded-mtext">Assets Types</span>
</a>
</li>


<li class="">
<a href="asset_disposal">
<span class="pcoded-micon"><i class="feather icon-trash"></i></span>
<span class="pcoded-mtext">Asset Disposal</span>
</a>
</li>
<li class="">
<a href="asset_allocations">
<span class="pcoded-micon"><i class="feather icon-sliders"></i></span>
<span class="pcoded-mtext">Asset Allocation</span>
</a>
</li>

<li class="">
<a href="asset_staffs">
<span class="pcoded-micon"><i class="feather icon-users"></i></span>
<span class="pcoded-mtext">Staffs</span>
</a>
</li>

<li class="">
<a href="asset_departments">
<span class="pcoded-micon"><i class="feather icon-anchor"></i></span>
<span class="pcoded-mtext">Departments</span>
</a>
</li>



<ul class="pcoded-item pcoded-left-item" item-border="true" item-border-style="none" subitem-border="true">
<li class="pcoded-hasmenu" dropdown-icon="style1" subitem-icon="style1">
<a href="javascript:void(0)">
<span class="pcoded-micon"><i class="feather icon-file-plus"></i></span>
<span class="pcoded-mtext">Reports</span>
</a>
<ul class="pcoded-submenu">
<li class="">
<a href="asset_report">
<span class="pcoded-mtext">Assets</span>
</a>
</li>
<li class="">
<a href="asset_type_report">
<span class="pcoded-mtext">Asset Types</span>
</a>
</li>
<li class="">
<a href="asset_disposal_report">
<span class="pcoded-mtext">Asset Disposals</span>
</a>
</li>
<li class="">
<a href="allocations_report">
<span class="pcoded-mtext">Allocations</span>
</a>
</li>
<li class="">
<a href="staff_report">
<span class="pcoded-mtext">Staffs</span>
</a>
</li>
<li class="">
<a href="department_report">
<span class="pcoded-mtext">Departments</span>
</a>
</li>
</ul>
</li>
</ul>

</nav>
<?php
#Other department heads
}elseif ($staff_department_head==$staff_id && $staff_department_name !='Administration') { ?>

<nav class="pcoded-navbar">
<div class="pcoded-inner-navbar main-menu">
<div class="pcoded-navigatio-lavel">Navigation</div>
<ul class="pcoded-item pcoded-left-item">
<li class="pcoded-hasmenu">
<a href="dashboard">
<span class="pcoded-micon"><i class="feather icon-home"></i></span>
<span class="pcoded-mtext">Dashboard</span>
</a>
</li>

<li class="">
<a href="assets">
<span class="pcoded-micon"><i class="feather icon-tag"></i></span>
<span class="pcoded-mtext">Assets</span>
</a>
</li>

<li class="">
<a href="asset_allocations">
<span class="pcoded-micon"><i class="feather icon-sliders"></i></span>
<span class="pcoded-mtext">Asset Allocation</span>
</a>
</li>

<li class="">
<a href="asset_staffs">
<span class="pcoded-micon"><i class="feather icon-users"></i></span>
<span class="pcoded-mtext">Staffs</span>
</a>
</li>



<ul class="pcoded-item pcoded-left-item" item-border="true" item-border-style="none" subitem-border="true">
<li class="pcoded-hasmenu" dropdown-icon="style1" subitem-icon="style1">
<a href="javascript:void(0)">
<span class="pcoded-micon"><i class="feather icon-file-plus"></i></span>
<span class="pcoded-mtext">Reports</span>
</a>
<ul class="pcoded-submenu">
<li class="">
<a href="asset_report">
<span class="pcoded-mtext">Assets</span>
</a>
</li>

<li class="">
<a href="allocations_report">
<span class="pcoded-mtext">Allocations</span>
</a>
</li>
<li class="">
<a href="staff_report">
<span class="pcoded-mtext">Staffs</span>
</a>
</li>

</ul>
</li>
</ul>

</nav>
<?php } ?>