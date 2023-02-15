<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "fintech_db";

// Create connection
$link = mysqli_connect($servername, $username, $password, $db_name);

// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
