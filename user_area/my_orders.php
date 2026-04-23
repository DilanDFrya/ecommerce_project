<?php
$username = $_SESSION['username'];
$get_user = "SELECT user_id FROM user_table WHERE username='$username'";
$run_user = mysqli_query($con, $get_user);
$row_user = mysqli_fetch_assoc($run_user);
$user_id = $row_user['user_id'];

$get_orders = "SELECT * FROM user_orders WHERE user_id=$user_id ORDER BY order_date DESC";
$run_orders = mysqli_query($con, $get_orders);
$num_orders = mysqli_num_rows($run_orders);
?>

<h4 class="fw-bold mb-4">Your <span class="text-primary">Order History</span></h4>

<?php if($num_orders == 0): ?>
    <div class="text-center py-5 bg-light rounded-4">
        <i class="fa-solid fa-box-open fa-3x text-muted mb-3 opacity-50"></i>
        <p class="text-muted">You haven't placed any orders yet.</p>
        <a href="../products.php" class="btn btn-primary rounded-pill px-4 mt-2">Start Shopping</a>
    </div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-borderless align-middle bg-light rounded-4 overflow-hidden">
            <thead class="bg-primary text-white">
                <tr>
                    <th class="p-3">Order ID</th>
                    <th class="p-3">Amount Due</th>
                    <th class="p-3">Total Products</th>
                    <th class="p-3">Invoice</th>
                    <th class="p-3">Date</th>
                    <th class="p-3">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while($row_orders = mysqli_fetch_assoc($run_orders)):
                    $order_id = $row_orders['order_id'];
                    $amount = $row_orders['amount_due'];
                    $invoice = $row_orders['invoice_number'];
                    $total_products = $row_orders['total_products'];
                    $date = date('d-m-Y', strtotime($row_orders['order_date']));
                    $status = $row_orders['order_status'];
                ?>
                <tr class="border-bottom">
                    <td class="p-3 fw-bold">#<?php echo $order_id; ?></td>
                    <td class="p-3">$<?php echo number_format($amount, 2); ?></td>
                    <td class="p-3"><?php echo $total_products; ?></td>
                    <td class="p-3 text-muted"><?php echo $invoice; ?></td>
                    <td class="p-3 small"><?php echo $date; ?></td>
                    <td class="p-3">
                        <span class="badge <?php echo ($status == 'Complete') ? 'bg-success' : 'bg-warning'; ?> rounded-pill px-3 py-2">
                            <?php echo ucfirst($status); ?>
                        </span>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<div class="mt-4 text-center">
    <a href="profile.php" class="btn btn-outline-primary btn-sm rounded-pill px-4">Back to Dashboard</a>
</div>
