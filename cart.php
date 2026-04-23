<?php 
// Start session and include dependencies before any output for header redirects
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('config/db.php');
require_once('includes/common_functions.php');

// Ensure user is logged in
$is_logged_in = isset($_SESSION['username']);
$username = $is_logged_in ? $_SESSION['username'] : null;

// Handle actions (Must happen before any HTML output)
if ($is_logged_in && isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $product_id = intval($_GET['id']);
    $is_ajax = (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest');
    
    if ($action == 'inc') {
        $update_query = "UPDATE cart_details SET quantity = quantity + 1 WHERE product_id = $product_id AND username = '$username'";
        mysqli_query($con, $update_query);
    } else if ($action == 'dec') {
        // Check current quantity
        $check_query = "SELECT quantity FROM cart_details WHERE product_id = $product_id AND username = '$username'";
        $res = mysqli_query($con, $check_query);
        if ($row = mysqli_fetch_assoc($res)) {
            if ($row['quantity'] > 1) {
                $update_query = "UPDATE cart_details SET quantity = quantity - 1 WHERE product_id = $product_id AND username = '$username'";
                mysqli_query($con, $update_query);
            } else {
                // Remove if quantity drops below 1
                $delete_query = "DELETE FROM cart_details WHERE product_id = $product_id AND username = '$username'";
                mysqli_query($con, $delete_query);
            }
        }
    } else if ($action == 'remove') {
        $delete_query = "DELETE FROM cart_details WHERE product_id = $product_id AND username = '$username'";
        mysqli_query($con, $delete_query);
    }
    
    if ($is_ajax) {
        // Return JSON with updated numbers
        $new_qty = 0;
        $item_total = 0;
        $get_item = "SELECT c.quantity, p.p_price FROM cart_details c JOIN products p ON c.product_id = p.p_id WHERE c.product_id = $product_id AND c.username = '$username'";
        $res_item = mysqli_query($con, $get_item);
        if($row_item = mysqli_fetch_assoc($res_item)) {
            $new_qty = $row_item['quantity'];
            $item_total = $row_item['p_price'] * $new_qty;
        }

        // Calculate global totals
        $subtotal = 0;
        $get_all = "SELECT c.quantity, p.p_price FROM cart_details c JOIN products p ON c.product_id = p.p_id WHERE c.username = '$username'";
        $res_all = mysqli_query($con, $get_all);
        while($row_all = mysqli_fetch_assoc($res_all)) {
            $subtotal += ($row_all['p_price'] * $row_all['quantity']);
        }
        $tax = $subtotal * 0.08;
        $total = $subtotal + $tax;
        $cart_count = cart_item_count($con);

        echo json_encode([
            'status' => 'success',
            'new_qty' => $new_qty,
            'item_total' => number_format($item_total, 2),
            'subtotal' => number_format($subtotal, 2),
            'tax' => number_format($tax, 2),
            'total' => number_format($total, 2),
            'cart_count' => $cart_count,
            'removed' => ($new_qty == 0)
        ]);
        exit();
    }

    header("Location: cart.php");
    exit();
}

include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<main class="container py-5 min-vh-100">
    <h1 class="fw-bold mb-5">Your <span class="text-primary">Shopping Cart</span></h1>
    
    <div id="cartContent">
    <?php if(!$is_logged_in): ?>
        <div class="row justify-content-center">
            <div class="col-md-8 text-center py-5 bg-white rounded-5 shadow-sm">
                <i class="fa-solid fa-cart-shopping fa-4x text-muted mb-4 opacity-50"></i>
                <h3 class="fw-bold mb-3">Please log in to view your cart</h3>
                <p class="text-muted mb-4">You need an account to add items and checkout.</p>
                <a href="user_area/user_login.php" class="btn btn-primary btn-lg rounded-pill px-5">Log In Now</a>
            </div>
        </div>
    <?php else: 
        $select_query = "SELECT c.quantity, p.p_id, p.p_title, p.p_image1, p.p_price FROM cart_details c JOIN products p ON c.product_id = p.p_id WHERE c.username = '$username'";
        $result = mysqli_query($con, $select_query);
        $num_items = mysqli_num_rows($result);
        
        if($num_items == 0):
    ?>
        <div class="row justify-content-center">
            <div class="col-md-8 text-center py-5 bg-white rounded-5 shadow-sm">
                <i class="fa-solid fa-cart-arrow-down fa-4x text-muted mb-4 opacity-50"></i>
                <h3 class="fw-bold mb-3">Your cart is empty</h3>
                <p class="text-muted mb-4">Looks like you haven't added anything to your cart yet.</p>
                <a href="products.php" class="btn btn-primary btn-lg rounded-pill px-5 mb-2">Continue Shopping</a><br>
                <a href="user_area/profile.php?my_orders" class="btn btn-link text-muted text-decoration-none small">View My Order History</a>
            </div>
        </div>
    <?php else: ?>
    
    <div class="row g-5">
        <!-- Cart Items -->
        <div class="col-lg-8">
            <div class="bg-white rounded-5 shadow-sm p-4 h-100">
                <div class="table-responsive">
                    <table class="table table-borderless align-middle mb-0">
                        <thead>
                            <tr class="text-muted small border-bottom">
                                <th scope="col" class="pb-3 px-4">PRODUCT</th>
                                <th scope="col" class="pb-3 text-center">QUANTITY</th>
                                <th scope="col" class="pb-3 text-end">PRICE</th>
                                <th scope="col" class="pb-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $subtotal = 0;
                            while($row = mysqli_fetch_assoc($result)): 
                                $item_total = $row['p_price'] * $row['quantity'];
                                $subtotal += $item_total;
                            ?>
                            <tr class="border-bottom cart-row" id="product-row-<?php echo $row['p_id']; ?>">
                                <td class="py-4 px-4">
                                    <div class="d-flex align-items-center">
                                        <a href="product_details.php?product_id=<?php echo $row['p_id']; ?>">
                                            <img src="admin_area/product_images/<?php echo $row['p_image1']; ?>" width="80" height="60" class="rounded-3 shadow-sm me-3 object-fit-cover" alt="<?php echo htmlspecialchars($row['p_title']); ?>">
                                        </a>
                                        <a href="product_details.php?product_id=<?php echo $row['p_id']; ?>" class="text-decoration-none text-dark">
                                            <h6 class="mb-0 fw-bold"><?php echo htmlspecialchars($row['p_title']); ?></h6>
                                        </a>
                                    </div>
                                </td>
                                <td class="py-4 text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="cart.php?action=dec&id=<?php echo $row['p_id']; ?>" class="btn btn-light btn-sm rounded-circle shadow-sm px-2 text-decoration-none text-dark cart-action"><i class="fa-solid fa-minus"></i></a>
                                        <span class="mx-3 fw-bold qty-display" id="qty-<?php echo $row['p_id']; ?>"><?php echo $row['quantity']; ?></span>
                                        <a href="cart.php?action=inc&id=<?php echo $row['p_id']; ?>" class="btn btn-light btn-sm rounded-circle shadow-sm px-2 text-decoration-none text-dark cart-action"><i class="fa-solid fa-plus"></i></a>
                                    </div>
                                </td>
                                <td class="py-4 text-end">
                                    <h6 class="mb-0 fw-bold" id="item-total-<?php echo $row['p_id']; ?>">$<?php echo number_format($item_total, 2); ?></h6>
                                </td>
                                <td class="py-4 text-end">
                                    <a href="cart.php?action=remove&id=<?php echo $row['p_id']; ?>" class="btn btn-link text-danger text-decoration-none px-4 cart-action"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Summary -->
        <aside class="col-lg-4">
            <div class="bg-white rounded-5 shadow-sm p-5 sticky-top" style="top: 120px; z-index: 900;">
                <h4 class="fw-bold mb-4">Summary</h4>
                <div class="d-flex justify-content-between mb-3 text-muted small">
                    <p class="mb-0">Subtotal</p>
                    <p class="mb-0 fw-bold text-dark">$<span id="cart-subtotal"><?php echo number_format($subtotal, 2); ?></span></p>
                </div>
                <div class="d-flex justify-content-between mb-3 text-muted small">
                    <p class="mb-0">Shipping</p>
                    <p class="mb-0 fw-bold text-success">FREE</p>
                </div>
                <?php $tax = $subtotal * 0.08; ?>
                <div class="d-flex justify-content-between mb-4 text-muted small">
                    <p class="mb-0">Estimated Tax (8%)</p>
                    <p class="mb-0 fw-bold text-dark">$<span id="cart-tax"><?php echo number_format($tax, 2); ?></span></p>
                </div>
                <div class="border-top pt-4 mt-2">
                    <div class="d-flex justify-content-between mb-5 h5 fw-bold">
                        <p class="mb-0">Total</p>
                        <p class="mb-0 text-primary">$<span id="cart-total"><?php echo number_format($subtotal + $tax, 2); ?></span></p>
                    </div>
                    <div class="d-grid gap-2">
                        <a href="checkout.php" class="btn btn-primary btn-lg p-3 rounded-3 shadow text-decoration-none">Check Out Now</a>
                        <a href="user_area/profile.php?my_orders" class="btn btn-outline-secondary btn-sm p-2 rounded-3 text-decoration-none small">View Previous Orders</a>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <p class="small text-muted"><i class="fa-solid fa-lock me-1"></i> Secure Checkout</p>
                </div>
            </div>
        </aside>
    </div>
    
    <?php endif; endif; ?>
    </div>
</main>

<?php include('includes/footer.php'); ?>
