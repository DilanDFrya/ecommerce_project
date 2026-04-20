<?php 
include('../includes/header.php'); 
include('../config/db.php');

if(isset($_POST['user_login'])) {
    $user_username = mysqli_real_escape_string($con, $_POST['user_username']);
    $user_password = $_POST['user_password'];

    $select_query = "SELECT * FROM user_table WHERE username='$user_username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);

    if($row_count > 0) {
        if(password_verify($user_password, $row_data['user_password'])) {
            $_SESSION['username'] = $user_username;
            $_SESSION['toast_status'] = 'success';
            $_SESSION['toast_msg'] = 'Login successful';
            header("Location: ../index.php");
            exit();
        } else {
            $_SESSION['toast_status'] = 'error';
            $_SESSION['toast_msg'] = 'Invalid Credentials';
        }
    } else {
        $_SESSION['toast_status'] = 'error';
        $_SESSION['toast_msg'] = 'Invalid Credentials';
    }
}
?>
<?php include('../includes/navbar.php'); ?>

<div class="container py-5 my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm p-4 p-md-5" style="border-radius: 30px;">
                <div class="text-center mb-4">
                    <h2 class="fw-bold">Welcome <span class="text-primary">Back</span></h2>
                    <p class="text-muted">Login to your account to continue shopping</p>
                </div>
                
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="user_username" class="form-label fw-bold small">Username</label>
                        <input type="text" class="form-control border-0 bg-light p-3 rounded-3" id="user_username" name="user_username" placeholder="Enter your username" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="user_password" class="form-label fw-bold small">Password</label>
                        <input type="password" class="form-control border-0 bg-light p-3 rounded-3" id="user_password" name="user_password" placeholder="Enter your password" required>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="remember_me">
                            <label class="form-check-label small text-muted" for="remember_me">Remember me</label>
                        </div>
                        <a href="#" class="small text-primary text-decoration-none fw-bold">Forgot password?</a>
                    </div>
                    
                    <div class="d-grid gap-2 mb-4">
                        <button type="submit" name="user_login" class="btn btn-primary btn-lg p-3 rounded-3 font-weight-bold">Login</button>
                    </div>
                    
                    <div class="text-center">
                        <p class="small text-muted mb-0">Don't have an account? <a href="user_registration.php" class="text-primary fw-bold text-decoration-none">Register Here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
