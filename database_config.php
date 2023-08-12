<?php
// Database configuration
$servername = "172.31.22.43";
$username = "Manas200542367";
$password = "TwdjtcnUA_";
$dbname = "Manas200542367";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
