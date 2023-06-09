<head>
<title>SAM-<?php echo $page;?> </title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="#">
<meta name="keywords" content="Asset Management system">
<meta name="author" content="#">

<link rel="icon" href="../public/images/favicon.ico" type="image/x-icon">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="../public/bower_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../public/assets/icon/feather/css/feather.css">

<link rel="stylesheet" type="text/css" href="../public/bower_components/pnotify/dist/pnotify.css">
<link rel="stylesheet" type="text/css" href="../public/bower_components/pnotify/dist/pnotify.brighttheme.css">
<link rel="stylesheet" type="text/css" href="../public/bower_components/pnotify/dist/pnotify.buttons.css">
<link rel="stylesheet" type="text/css" href="../public/bower_components/pnotify/dist/pnotify.history.css">
<link rel="stylesheet" type="text/css" href="../public/bower_components/pnotify/dist/pnotify.mobile.css">
<link rel="stylesheet" type="text/css" href="../public/assets/pages/pnotify/notify.css">

<link rel="stylesheet" type="text/css" href="../public/assets/icon/themify-icons/themify-icons.css">

<link rel="stylesheet" type="text/css" href="../public/assets/icon/icofont/css/icofont.css">

<link rel="stylesheet" type="text/css" href="../public/assets/icon/feather/css/feather.css">

<link rel="stylesheet" type="text/css" href="../public/assets/css/style.css">
<link rel="stylesheet" type="text/css" href="../public/assets/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" type="text/css" href="../public/assets/css/style.css">
<link rel="stylesheet" type="text/css" href="../public/assets/css/jquery.mCustomScrollbar.css">
 <!--  Alert--> 
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
     <?php
    /* Alert Sesion Via Alerts */
    if (isset($_SESSION['success'])) {
        $success = $_SESSION['success'];
        unset($_SESSION['success']);
    }
    ?>
</head>