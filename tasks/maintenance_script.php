<?php

// Connect to the database
$dbuser = "root"; /* Database Username */
$dbpass = ""; /* Database Username Password */
$host = "127.0.0.1"; /* Database Host */
$db = "sam";  /* Database Name */
$mysqli = new mysqli($host, $dbuser, $dbpass, $db); /* Connection Function */

// Check for connection errors
if ($mysqli->connect_errno) {
    die('Failed to connect to MySQL: ' . $mysqli->connect_error);
}

// Get tomorrow's date
$tomorrowDate = date('Y-m-d', strtotime('+1 day'));

// Update maintenance status for tomorrow's date
$sql = "UPDATE maintenance SET maintenance_status = 'Completed' WHERE maintenance_date = '{$tomorrowDate}' AND maintenance_status !='Cancelled'";

if ($mysqli->query($sql)) {
    echo "Maintenance status updated successfully.";
} else {
    echo "Error updating maintenance status: " . $mysqli->error;
}

// Close the database connection
$mysqli->close();
