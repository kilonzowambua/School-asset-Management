<?php


#Include all Nesessary Files
include('../config/config.php');
include('../config/codeGen.php');
include('../config/checklogin.php');

if($staff_department_head==$staff_id && $staff_department_name =='Administration' || $staff_department_head !=$staff_id ){
#Admin Analystics
#No of Staffs
$query = "SELECT COUNT(*)  FROM staffs WHERE staff_status='Active'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($staffs);
$stmt->fetch();
$stmt->close();

# No of Assets
$query = "SELECT COUNT(*) FROM assets WHERE assetdispose_id IS NULL";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($assets);
$stmt->fetch();
$stmt->close();


/* No of Disposal*/
$query = "SELECT COUNT(*) FROM assetdisposes";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($disposals);
$stmt->fetch();
$stmt->close();

/* Total Asset Networth*/
$query = "SELECT SUM(asset_price) AS total_networth FROM assets WHERE assetdispose_id IS NULL";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($total_networth);
$stmt->fetch();
$stmt->close();
}elseif ($staff_department_head==$staff_id && $staff_department_name !='Administration') { 
/* Managers */
#No of Staffs
$query = "SELECT COUNT(*)  FROM staffs WHERE staff_status='Active' AND staff_department_id ='{$staff_department_id}'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($staffs);
$stmt->fetch();
$stmt->close();


#Allocated assets
$query = "SELECT COUNT(*)  FROM allocations  WHERE allocation_status='Approved' AND allocation_staff_id='{$staff_id}' OR allocation_staff_id='{$staff_department_head}' OR allocation_department_staff_id='{$staff_department_head}'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($allocations);
$stmt->fetch();
$stmt->close();

/* No of Disposal*/
$query = "SELECT COUNT(*) FROM assetdisposes WHERE assetdispose_staff_id='{$staff_id}'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($disposals);
$stmt->fetch();
$stmt->close();
/* Total Asset Networth*/
$query = "SELECT SUM(ast.asset_price) AS total_networth FROM assets AS ast
INNER JOIN allocations AS al ON ast.asset_id=al.allocation_asset_id
INNER JOIN staffs AS st ON al.allocation_department_staff_id = st.staff_id
INNER JOIN departments AS dep ON st.staff_id = dep.department_staff_id
WHERE dep.department_staff_id='{$staff_department_head}' AND ast.assetdispose_id IS NULL";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($total_networth);
$stmt->fetch();
$stmt->close();
}

#STAFF
#Allocated assets
$query = "SELECT COUNT(*)  FROM allocations  WHERE allocation_status='Approved' AND allocation_staff_id='{$staff_id}'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($allocations_staff);
$stmt->fetch();
$stmt->close();

#HOD 
$query = "SELECT staff_first_name,staff_last_name  FROM staffs WHERE staff_status='Active' AND staff_id='{$staff_department_id}'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($staff_first_name,$staff_last_name);
$stmt->fetch();
$stmt->close();

