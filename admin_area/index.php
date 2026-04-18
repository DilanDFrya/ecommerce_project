<?php
include('../config/db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            background-color: #f8f9fa;
            overflow-x: hidden;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        .sidebar {
            min-height: 100vh;
            padding-top: 0;
            color: white;
        }
        .sidebar a {
            color: #8c8c9e;
            text-decoration: none;
            padding: 12px 18px;
            display: block;
            font-size: 0.95rem;
        }
        .sidebar a:hover:not(.active) {
            background-color: rgba(255,255,255,0.05);
            color: #fff !important;
            transform: translateX(4px);
        }
        .content-area {
            padding: 30px;
        }
        .form-container { 
            background: white; 
            padding: 30px; 
            border-radius: 10px; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); 
        }
    </style>
</head>
<body>
    <div class="row g-0">
        <?php include('includes/sidebar.php'); ?>
        
        <!-- Main Content -->
        <div class="col-md-10 content-area">
            <?php 
                if(isset($_GET['products'])){
                    include('products.php');
                } else if(isset($_GET['delete_product'])){
                    include('delete_product.php');
                } else {
            ?>
            <div class="container">
                <h2 class="mb-4">Dashboard Overview</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card bg-primary text-white border-0 shadow-sm h-100 round-3 p-3">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title text-white-50">Total Products</h6>
                                    <?php 
                                        $count_query = "SELECT COUNT(*) as count FROM products";
                                        $count_result = mysqli_query($con, $count_query);
                                        $count_row = mysqli_fetch_assoc($count_result);
                                    ?>
                                    <h2 class="mb-0 fw-bold"><?php echo $count_row['count'] ?? 0; ?></h2>
                                </div>
                                <i class="fa-solid fa-box-open fa-3x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php if(isset($toast_status) && isset($toast_msg)): ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        Toast.fire({
            icon: '<?php echo $toast_status; ?>',
            title: '<?php echo $toast_msg; ?>'
        });
    </script>
    <?php endif; ?>
    <script>
        // Prevent form resubmission on page refresh
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>
</html>
