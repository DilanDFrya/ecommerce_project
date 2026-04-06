<?php include('../includes/header.php'); ?>
<?php include('../includes/navbar.php'); ?>

<div class="container py-5 my-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm p-5" style="border-radius: 30px;">
                <div class="mb-4 text-center">
                    <img src="images/phone.png" class="rounded-circle border border-primary p-1 mb-3 shadow-sm" width="120" height="120" alt="Profile">
                    <h2 class="fw-bold mb-1">User DashBoard</h2>
                    <p class="text-muted">Manage your orders and personal information</p>
                </div>
                
                <div class="row g-4 mt-2 text-start">
                    <div class="col-md-4">
                        <div class="p-4 bg-light rounded-4 text-center shadow-sm">
                            <i class="fa-solid fa-box fa-2x text-primary mb-2"></i>
                            <h5 class="mb-0">Orders</h5>
                            <small class="text-muted">View History</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 bg-light rounded-4 text-center shadow-sm">
                            <i class="fa-solid fa-heart fa-2x text-danger mb-2"></i>
                            <h5 class="mb-0">Wishlist</h5>
                            <small class="text-muted">Saved Items</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 bg-light rounded-4 text-center shadow-sm">
                            <i class="fa-solid fa-gear fa-2x text-secondary mb-2"></i>
                            <h5 class="mb-0">Settings</h5>
                            <small class="text-muted">Security</small>
                        </div>
                    </div>
                </div>
                
                <div class="d-grid gap-2 mt-5">
                    <a href="../index.php" class="btn btn-outline-primary btn-lg rounded-3">Return to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
