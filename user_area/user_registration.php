<?php include('../includes/header.php'); ?>
<!-- Custom paths for includes inside a subdirectory -->
<?php 
    // Fix paths for nested folder
    include('../includes/navbar.php'); 
?>

<div class="container py-5 my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 p-md-5" style="border-radius: 30px;">
                <div class="text-center mb-4">
                    <h2 class="fw-bold">Create an <span class="text-primary">Account</span></h2>
                    <p class="text-muted">Join our community today</p>
                </div>
                
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="user_username" class="form-label fw-bold small">Username</label>
                        <input type="text" class="form-control border-0 bg-light p-3 rounded-3" id="user_username" name="user_username" placeholder="Enter your username" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="user_email" class="form-label fw-bold small">Email Address</label>
                        <input type="email" class="form-control border-0 bg-light p-3 rounded-3" id="user_email" name="user_email" placeholder="Enter your email" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="user_image" class="form-label fw-bold small">Profile Image</label>
                        <input type="file" class="form-control border-0 bg-light p-3 rounded-3" id="user_image" name="user_image" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="user_password" class="form-label fw-bold small">Password</label>
                        <input type="password" class="form-control border-0 bg-light p-3 rounded-3" id="user_password" name="user_password" placeholder="Create a password" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="conf_user_password" class="form-label fw-bold small">Confirm Password</label>
                        <input type="password" class="form-control border-0 bg-light p-3 rounded-3" id="conf_user_password" name="conf_user_password" placeholder="Repeat your password" required>
                    </div>
                    
                    <div class="d-grid gap-2 mb-4">
                        <button type="submit" name="user_register" class="btn btn-primary btn-lg p-3 rounded-3 font-weight-bold">Register Now</button>
                    </div>
                    
                    <div class="text-center">
                        <p class="small text-muted mb-0">Already have an account? <a href="user_login.php" class="text-primary fw-bold text-decoration-none">Login Here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
