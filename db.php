<?php
$dbHost = '';
$dbName = 'practice';
$dbUser = 'root';
$dbPass = '';

// Create a database connection
$con = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>