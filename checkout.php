<?php 
include('includes/header.php'); 
include('includes/navbar.php'); 

// Check if logged in
if(!isset($_SESSION['username'])){
    $_SESSION['toast_status'] = 'warning';
    $_SESSION['toast_msg'] = 'Please login to checkout';
    echo "<script>window.location.href='user_area/user_login.php';</script>";
    exit();
}

$username = $_SESSION['username'];
$user_id_query = "SELECT user_id FROM user_table WHERE username='$username'";
$user_id_res = mysqli_query($con, $user_id_query);
$user_id_data = mysqli_fetch_assoc($user_id_res);
$user_id = $user_id_data['user_id'];

// Fetch cart details
$get_cart = "SELECT c.quantity, p.p_id, p.p_price FROM cart_details c JOIN products p ON c.product_id = p.p_id WHERE c.username = '$username'";
$res_cart = mysqli_query($con, $get_cart);
$num_items = mysqli_num_rows($res_cart);

if($num_items == 0) {
    echo "<script>window.location.href='index.php';</script>";
    exit();
}

// Handle Order Placement
if(isset($_POST['place_order'])) {
    $invoice_number = mt_rand();
    $status = 'pending';
    $total_amount = 0;
    $total_products = $num_items;
    
    // Calculate total amount
    mysqli_data_seek($res_cart, 0); // Reset pointer
    while($row = mysqli_fetch_assoc($res_cart)) {
        $total_amount += ($row['p_price'] * $row['quantity']);
    }
    $total_amount_with_tax = $total_amount * 1.08; // 8% tax

    // Insert into user_orders
    $insert_order = "INSERT INTO user_orders (user_id, amount_due, invoice_number, total_products, order_status) VALUES ($user_id, $total_amount_with_tax, $invoice_number, $total_products, '$status')";
    $run_order = mysqli_query($con, $insert_order);
    $order_id = mysqli_insert_id($con);

    if($run_order) {
        // Insert into order_items
        mysqli_data_seek($res_cart, 0);
        while($row = mysqli_fetch_assoc($res_cart)) {
            $p_id = $row['p_id'];
            $qty = $row['quantity'];
            $price = $row['p_price'];
            $insert_item = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ($order_id, $p_id, $qty, $price)";
            mysqli_query($con, $insert_item);
        }

        // Delete from cart
        $delete_cart = "DELETE FROM cart_details WHERE username='$username'";
        mysqli_query($con, $delete_cart);

        $_SESSION['toast_status'] = 'success';
        $_SESSION['toast_msg'] = 'Order placed successfully!';
        echo "<script>window.location.href='user_area/profile.php?my_orders';</script>";
        exit();
    }
}
?>

<main class="container py-5 my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="card border-0 shadow-lg p-5" style="border-radius: 30px;">
                <div class="mb-4">
                    <i class="fa-solid fa-circle-check fa-4x text-success mb-3"></i>
                    <h2 class="fw-bold">Confirm Your <span class="text-primary">Order</span></h2>
                    <p class="text-muted">You're just one step away from completing your purchase.</p>
                </div>
                
                <div class="bg-light p-4 rounded-4 mb-4 text-start">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Items:</span>
                        <span class="fw-bold"><?php echo $num_items; ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Payment Method:</span>
                        <span class="fw-bold">Cash on Delivery</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between h5 mb-0 fw-bold">
                        <span>Total Payable:</span>
                        <?php 
                        $total = 0;
                        mysqli_data_seek($res_cart, 0);
                        while($row = mysqli_fetch_assoc($res_cart)) {
                            $total += ($row['p_price'] * $row['quantity']);
                        }
                        ?>
                        <span class="text-primary">$<?php echo number_format($total * 1.08, 2); ?></span>
                    </div>
                </div>

                <form action="" method="post">
                    <div class="d-grid gap-3">
                        <button type="submit" name="place_order" class="btn btn-primary btn-lg p-3 rounded-3 shadow fw-bold">Confirm and Place Order</button>
                        <a href="cart.php" class="btn btn-light btn-lg p-3 rounded-3 border text-muted small">Back to Cart</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include('includes/footer.php'); ?>
