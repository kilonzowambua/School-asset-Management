<?php

declare(strict_types=1);
/*
|--------------------------------------------------------------------------------------
|  Task File
|--------------------------------------------------------------------------------------
|
| This file basically registers a new task to be executed by Crunz
| To get the list of all frequency and constraint method, you may
| go to this link: https://github.com/lavary/crunz#scheduling-frequency-and-constraints
|
*/



use Crunz\Schedule;

$scheduler = new Schedule();
$task = $scheduler->run(PHP_BINARY . ' /opt/lampp/htdocs/SAM/tasks/maintenance_script.php');
$task
    ->description('Maintenance Task')
    ->preventOverlapping()
    ->daily();
    

return $scheduler;
