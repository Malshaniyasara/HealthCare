<?php
$servername = "localhost"; // Usually "localhost" in local development
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password is empty
$dbname = "dbcon"; // Replace with your actual database name

// Create connection
$db = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
