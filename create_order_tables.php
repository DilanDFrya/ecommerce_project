<?php
include('config/db.php');

// Create user_orders table
$query1 = "CREATE TABLE IF NOT EXISTS user_orders (
    order_id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    amount_due INT NOT NULL,
    invoice_number INT NOT NULL,
    total_products INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    order_status VARCHAR(255) NOT NULL,
    PRIMARY KEY (order_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// Create order_items table (to store products within each order)
$query2 = "CREATE TABLE IF NOT EXISTS order_items (
    item_id INT NOT NULL AUTO_INCREMENT,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price INT NOT NULL,
    PRIMARY KEY (item_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if (mysqli_query($con, $query1) && mysqli_query($con, $query2)) {
    echo "Order tables created successfully";
} else {
    echo "Error creating tables: " . mysqli_error($con);
}
?>
