<?php


#Include all Nesessary Files
include('../config/config.php');
include('../config/codeGen.php');
include('../config/checklogin.php');


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
