<?php
// Include your config file
include('./config/db.php');

// 1. Check if the connection variable $con exists
if ($con) {
    echo "<h2 style='color: green;'>✔ PHP successfully connected to MySQL!</h2>";
} else {
    die("<h2 style='color: red;'>✘ Connection failed.</h2>");
}

// 2. Check if the specific table "products" exists in your database
$query = "SHOW TABLES LIKE 'products'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<p style='color: blue;'>✔ The 'products' table was found in the database.</p>";
} else {
    echo "<p style='color: orange;'>⚠ Connected, but the 'products' table is missing. Did you run the SQL code in Workbench?</p>";
}
?>