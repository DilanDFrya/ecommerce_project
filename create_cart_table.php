<?php
include('config/db.php');
$query = "CREATE TABLE IF NOT EXISTS cart_details (
    product_id INT NOT NULL,
    username VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    PRIMARY KEY (product_id, username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if (mysqli_query($con, $query)) {
    echo "Table cart_details created successfully";
} else {
    echo "Error creating table: " . mysqli_error($con);
}
?>
