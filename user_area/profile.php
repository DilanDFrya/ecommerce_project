<?php 
include('../includes/header.php'); 
include('../config/db.php'); 

// Check if logged in
if(!isset($_SESSION['username'])){
    $_SESSION['toast_status'] = 'warning';
    $_SESSION['toast_msg'] = 'Please login to access your profile';
    echo "<script>window.location.href='user_login.php';</script>";
    exit();
}

$current_username = $_SESSION['username'];
$user_query = "SELECT * FROM user_table WHERE username='$current_username'";
$user_result = mysqli_query($con, $user_query);
$user_data = mysqli_fetch_assoc($user_result);
$user_id = $user_data['user_id'];

// Handle profile update
if(isset($_POST['update_profile'])) {
    $new_username = mysqli_real_escape_string($con, $_POST['user_username']);
    $new_email = mysqli_real_escape_string($con, $_POST['user_email']);
    $new_address = mysqli_real_escape_string($con, $_POST['user_address']);
    $new_contact = mysqli_real_escape_string($con, $_POST['user_contact']);

    // Check if new username or email exists for OTHER users
    $check_query = "SELECT * FROM user_table WHERE (username='$new_username' OR user_email='$new_email') AND user_id != $user_id";
    $check_result = mysqli_query($con, $check_query);
    
    if(mysqli_num_rows($check_result) > 0) {
        $_SESSION['toast_status'] = 'warning';
        $_SESSION['toast_msg'] = 'Username or Email already in use by another account';
    } else {
        $update_query = "UPDATE user_table SET username='$new_username', user_email='$new_email', user_address='$new_address', user_contact='$new_contact' WHERE user_id=$user_id";
        $update_result = mysqli_query($con, $update_query);

        if($update_result) {
            $_SESSION['username'] = $new_username; // Update session if username changed
            $_SESSION['toast_status'] = 'success';
            $_SESSION['toast_msg'] = 'Profile updated successfully!';
            // Refresh page to show updated data
            echo "<script>window.location.href='profile.php';</script>";
            exit();
        } else {
            $_SESSION['toast_status'] = 'error';
            $_SESSION['toast_msg'] = 'Error updating profile';
        }
    }
}
?>
<?php include('../includes/navbar.php'); ?>

<div class="container py-5 my-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm p-5" style="border-radius: 30px;">
                <div class="mb-4 text-center">
                    <img src="<?php echo $path_prefix; ?>images/Profile.webp"
                        class="rounded-circle border border-primary p-1 mb-3 shadow-sm" width="120" height="120"
                        alt="Profile" onerror="this.src='../images/Profile.webp'">
                    <h2 class="fw-bold mb-1">
                        <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) . "'s Dashboard" : "User Dashboard"; ?>
                    </h2>
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
                
                <hr class="my-5">

                <div class="text-start">
                    <h4 class="fw-bold mb-4">Update <span class="text-primary">Profile Information</span></h4>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="user_username" class="form-label fw-bold small">Username</label>
                                <input type="text" class="form-control border-0 bg-light p-3 rounded-3" id="user_username" name="user_username" value="<?php echo htmlspecialchars($user_data['username']); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="user_email" class="form-label fw-bold small">Email Address</label>
                                <input type="email" class="form-control border-0 bg-light p-3 rounded-3" id="user_email" name="user_email" value="<?php echo htmlspecialchars($user_data['user_email']); ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="user_address" class="form-label fw-bold small">Address</label>
                            <input type="text" class="form-control border-0 bg-light p-3 rounded-3" id="user_address" name="user_address" value="<?php echo htmlspecialchars($user_data['user_address']); ?>" required>
                        </div>

                        <div class="mb-4">
                            <label for="user_contact" class="form-label fw-bold small">Contact Number</label>
                            <input type="text" class="form-control border-0 bg-light p-3 rounded-3" id="user_contact" name="user_contact" value="<?php echo htmlspecialchars($user_data['user_contact']); ?>" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" name="update_profile" class="btn btn-primary btn-lg p-3 rounded-3 font-weight-bold">Save Changes</button>
                        </div>
                    </form>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <a href="<?php echo $path_prefix; ?>index.php"
                        class="btn btn-outline-secondary btn-lg rounded-3">Return to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>