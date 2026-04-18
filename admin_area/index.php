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
                } else if(isset($_GET['categories'])){
                    include('categories.php');
                } else if(isset($_GET['brands'])){
                    include('brands.php');
                } else {
            ?>
            <div class="container-fluid px-4 py-4">
                <h2 class="mb-4 fw-bold">Dashboard Overview</h2>
                
                <!-- Stat Cards -->
                <div class="row g-4 mb-5">
                    <!-- Products Stat -->
                    <div class="col-md-4">
                        <div class="card bg-primary text-white border-0 shadow h-100 rounded-4 overflow-hidden" style="background: linear-gradient(135deg, #0dcaf0 0%, #0d6efd 100%);">
                            <div class="card-body p-4 position-relative">
                                <div class="position-relative z-1">
                                    <h6 class="card-title text-white-50 fw-bold text-uppercase tracking-wide mb-1" style="letter-spacing: 1px;">Total Products</h6>
                                    <?php 
                                        $count_p = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as c FROM products"));
                                    ?>
                                    <h2 class="display-5 fw-bold mb-0"><?php echo $count_p['c'] ?? 0; ?></h2>
                                </div>
                                <i class="fa-solid fa-box-open fa-4x position-absolute opacity-25" style="bottom: -10px; right: 10px; transform: rotate(-15deg);"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Categories Stat -->
                    <div class="col-md-4">
                        <div class="card text-white border-0 shadow h-100 rounded-4 overflow-hidden" style="background: linear-gradient(135deg, #20c997 0%, #198754 100%);">
                            <div class="card-body p-4 position-relative">
                                <div class="position-relative z-1">
                                    <h6 class="card-title text-white-50 fw-bold text-uppercase tracking-wide mb-1" style="letter-spacing: 1px;">Categories</h6>
                                    <?php 
                                        $count_c = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as c FROM categories"));
                                    ?>
                                    <h2 class="display-5 fw-bold mb-0"><?php echo $count_c['c'] ?? 0; ?></h2>
                                </div>
                                <i class="fa-solid fa-layer-group fa-4x position-absolute opacity-25" style="bottom: -10px; right: 10px; transform: rotate(-15deg);"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Brands Stat -->
                    <div class="col-md-4">
                        <div class="card text-white border-0 shadow h-100 rounded-4 overflow-hidden" style="background: linear-gradient(135deg, #fd7e14 0%, #dc3545 100%);">
                            <div class="card-body p-4 position-relative">
                                <div class="position-relative z-1">
                                    <h6 class="card-title text-white-50 fw-bold text-uppercase tracking-wide mb-1" style="letter-spacing: 1px;">Brands</h6>
                                    <?php 
                                        $count_b = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as c FROM brands"));
                                    ?>
                                    <h2 class="display-5 fw-bold mb-0"><?php echo $count_b['c'] ?? 0; ?></h2>
                                </div>
                                <i class="fa-solid fa-tag fa-4x position-absolute opacity-25" style="bottom: -10px; right: 10px; transform: rotate(15deg);"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity & Quick Links -->
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                                <h5 class="fw-bold mb-0">Recently Added Products</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <tbody>
                                            <?php
                                            $recent_query = "SELECT p_title, p_price, p_image1, date FROM products ORDER BY p_id DESC LIMIT 5";
                                            $recent_result = mysqli_query($con, $recent_query);
                                            if(mysqli_num_rows($recent_result) > 0) {
                                                while($r = mysqli_fetch_assoc($recent_result)) {
                                                    $img = $r['p_image1'];
                                                    $title = htmlspecialchars($r['p_title']);
                                                    $price = $r['p_price'];
                                                    $date = date("M d", strtotime($r['date']));
                                                    echo "
                                                    <tr>
                                                        <td style='width: 50px;'><img src='./product_images/$img' class='rounded' style='width: 40px; height: 40px; object-fit: cover;'></td>
                                                        <td class='fw-medium'>$title</td>
                                                        <td class='text-primary fw-bold'>$$price</td>
                                                        <td class='text-muted text-end small'>$date</td>
                                                    </tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='4' class='text-center text-muted'>No products found.</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                                <h5 class="fw-bold mb-0">Quick Links</h5>
                            </div>
                            <div class="card-body p-4 d-flex flex-column gap-3">
                                <a href="index.php?products" class="btn btn-light text-start py-3 px-4 rounded-3 d-flex align-items-center justify-content-between" style="transition: all 0.2s;">
                                    <span><i class="fa-solid fa-box-open me-2 text-primary"></i> Manage Products</span>
                                    <i class="fa-solid fa-chevron-right text-muted small"></i>
                                </a>
                                <a href="index.php?categories" class="btn btn-light text-start py-3 px-4 rounded-3 d-flex align-items-center justify-content-between" style="transition: all 0.2s;">
                                    <span><i class="fa-solid fa-layer-group me-2 text-success"></i> Manage Categories</span>
                                    <i class="fa-solid fa-chevron-right text-muted small"></i>
                                </a>
                                <a href="index.php?brands" class="btn btn-light text-start py-3 px-4 rounded-3 d-flex align-items-center justify-content-between" style="transition: all 0.2s;">
                                    <span><i class="fa-solid fa-tag me-2 text-danger"></i> Manage Brands</span>
                                    <i class="fa-solid fa-chevron-right text-muted small"></i>
                                </a>
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
