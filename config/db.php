<?php
// Database credentials
$host = "localhost";
$username = "root";
$password = "Dil@n#183"; // Default XAMPP password is empty
$dbname = "ecommerce_db";

// Create connection
$con = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Success message (optional, usually commented out in production)
// echo "Connected successfully!";
?>