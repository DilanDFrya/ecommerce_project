<?php include('includes/header.php'); ?>
<?php include('config/db.php'); ?>
<?php include('includes/navbar.php'); ?>

<main class="container py-5">
    <div class="row">
        <!-- Sidebar Section -->
        <?php include('includes/sidebar.php'); ?>

        <!-- Main Content Area -->
        <div class="col-md-9">
            <!-- Featured Products -->
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <h2 class="mb-1">Featured <span class="text-primary">Products</span></h2>
                    <p class="text-muted mb-0">Handpicked items just for you</p>
                </div>
                <a href="#" class="text-primary text-decoration-none fw-bold">View All <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>

            <div class="row">
                <?php
                if (isset($con)) {
                    $select_query = "SELECT * FROM products ORDER BY rand() LIMIT 0,6";
                    $result_query = mysqli_query($con, $select_query);
                    if ($result_query && mysqli_num_rows($result_query) > 0) {
                        while($row = mysqli_fetch_assoc($result_query)){
                            $product_id = $row['p_id'];
                            $product_title = $row['p_title'];
                            $product_description = $row['p_description'];
                            $product_image1 = $row['p_image1'];
                            $product_price = $row['p_price'];
                            
                            echo "<div class='col-md-4 mb-4'>
                                <div class='card h-100'>
                                    <div class='position-relative overflow-hidden'>
                                        <img src='admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title' style='object-fit: cover; height: 250px;'>
                                    </div>
                                    <div class='card-body'>
                                        <h5 class='card-title mb-1 text-truncate'>$product_title</h5>
                                        <p class='text-muted small mb-3 text-truncate'>$product_description</p>
                                        <div class='d-flex align-items-center mb-4'>
                                            <h4 class='text-primary mb-0'>$$product_price</h4>
                                        </div>
                                        <div class='d-grid gap-2'>
                                            <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'><i class='fa-solid fa-cart-plus me-2'></i> Add to cart</a>
                                            <a href='product_details.php?product_id=$product_id' class='btn btn-light text-muted small'>Quick View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                        }
                    } else {
                        echo "<div class='col-12'><h4 class='text-danger'>No products available</h4></div>";
                    }
                } else {
                    echo "<div class='col-12'><h4 class='text-danger'>Database connection failed</h4></div>";
                }
                ?>
            </div>
        </div>
    </div>
</main>

<?php include('includes/footer.php'); ?>