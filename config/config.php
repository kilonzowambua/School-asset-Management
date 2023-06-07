<?php
// Create a connection
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'sam';

$mysqli = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}