<?php


/* Staff Checklogin */
function staff_checklogin()
{
    if (strlen($_SESSION['staff_id']) == 0) {
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'login';
        $_SESSION['staff_id'] = '';
        header("Location: http://$host$uri/$extra");
    }
}

