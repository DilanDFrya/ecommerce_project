<?php 
include('../includes/header.php'); 
include('../config/db.php');

if(isset($_POST['user_register'])) {
    $user_username = mysqli_real_escape_string($con, $_POST['user_username']);
    $user_email = mysqli_real_escape_string($con, $_POST['user_email']);
    $user_password = $_POST['user_password'];
    $conf_user_password = $_POST['conf_user_password'];
    $user_address = mysqli_real_escape_string($con, $_POST['user_address']);
    $user_contact = mysqli_real_escape_string($con, $_POST['user_contact']);
    $user_ip = $_SERVER['REMOTE_ADDR'];

    $select_query = "SELECT * FROM user_table WHERE username='$user_username' OR user_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);

    if($rows_count > 0) {
        $_SESSION['toast_status'] = 'warning';
        $_SESSION['toast_msg'] = 'Username or Email already exists';
    } else if($user_password != $conf_user_password) {
        $_SESSION['toast_status'] = 'warning';
        $_SESSION['toast_msg'] = 'Passwords do not match';
    } else {
        $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
        $insert_query = "INSERT INTO user_table (username, user_email, user_password, user_address, user_contact, user_ip) VALUES ('$user_username', '$user_email', '$hash_password', '$user_address', '$user_contact', '$user_ip')";
        $sql_execute = mysqli_query($con, $insert_query);

        if($sql_execute) {
            $_SESSION['toast_status'] = 'success';
            $_SESSION['toast_msg'] = 'User registered successfully';
            header("Location: user_login.php");
            exit();
        } else {
            $_SESSION['toast_status'] = 'error';
            $_SESSION['toast_msg'] = 'Error registering user';
        }
    }
}
?>
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
                        <label for="user_address" class="form-label fw-bold small">Address</label>
                        <input type="text" class="form-control border-0 bg-light p-3 rounded-3" id="user_address" name="user_address" placeholder="Enter your address" required>
                    </div>

                    <div class="mb-3">
                        <label for="user_contact" class="form-label fw-bold small">Contact Number</label>
                        <input type="text" class="form-control border-0 bg-light p-3 rounded-3" id="user_contact" name="user_contact" placeholder="Enter your mobile number" required>
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
