<?php include('includes/header.php'); ?>
<?php include('config/db.php'); ?>
<?php include('includes/navbar.php'); ?>

<main class="container py-5">
    <div class="row">
        <!-- Sidebar Section -->
        <?php include('includes/sidebar.php'); ?>

        <!-- Main Content Area -->
        <div class="col-md-9 px-lg-4">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <div>
                    <?php if(isset($_GET['search'])): ?>
                        <h1 class="fw-bold mb-1">Search Results for <span class="text-primary">"<?php echo htmlspecialchars($_GET['search']); ?>"</span></h1>
                        <p class="text-muted mb-0">Products matching your search query</p>
                    <?php else: ?>
                        <h1 class="fw-bold mb-1">Our <span class="text-primary">Products</span></h1>
                        <p class="text-muted mb-0">Browse through our curated collection of tech devices</p>
                    <?php endif; ?>
                </div>
                
                <?php
                // Handle sorting logic
                $sort_query = "ORDER BY p_id DESC"; // Default
                $sort_title = "Newest First";
                if(isset($_GET['sort'])){
                    if($_GET['sort'] == 'price_low'){
                        $sort_query = "ORDER BY p_price ASC";
                        $sort_title = "Price: Low to High";
                    } else if($_GET['sort'] == 'price_high'){
                        $sort_query = "ORDER BY p_price DESC";
                        $sort_title = "Price: High to Low";
                    }
                }

                // Build current URL for sorting links to maintain existing filters
                $current_url = "products.php?";
                if(isset($_GET['search'])){
                    $current_url .= "search=" . urlencode($_GET['search']) . "&";
                } else if(isset($_GET['category'])){
                    $current_url .= "category=" . $_GET['category'] . "&";
                } else if(isset($_GET['brand'])){
                    $current_url .= "brand=" . $_GET['brand'] . "&";
                }
                ?>

                <div class="d-flex gap-3">
                    <?php if(isset($_GET['search']) || isset($_GET['category']) || isset($_GET['brand']) || isset($_GET['sort'])): ?>
                        <a href="products.php" class="btn btn-outline-danger px-3 py-2 rounded-3 border d-flex align-items-center">
                            <i class="fa-solid fa-xmark me-2"></i> Reset
                        </a>
                    <?php endif; ?>
                    
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle px-4 py-2 rounded-3 border d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                            Sort By: <?php echo $sort_title; ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2">
                            <li><a class="dropdown-item py-2" href="<?php echo $current_url; ?>sort=price_low">Price: Low to High</a></li>
                            <li><a class="dropdown-item py-2" href="<?php echo $current_url; ?>sort=price_high">Price: High to Low</a></li>
                            <li><a class="dropdown-item py-2" href="<?php echo $current_url; ?>sort=newest">Newest First</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <?php
                if (isset($con)) {
                    if(isset($_GET['search'])){
                        $search_query = mysqli_real_escape_string($con, $_GET['search']);
                        $select_query = "SELECT * FROM products WHERE p_title LIKE '%$search_query%' OR p_description LIKE '%$search_query%' $sort_query";
                    } else if(isset($_GET['category'])){
                        $category_id = intval($_GET['category']);
                        $select_query = "SELECT * FROM products WHERE category_id = $category_id $sort_query";
                    } else if(isset($_GET['brand'])){
                        $brand_id = intval($_GET['brand']);
                        $select_query = "SELECT * FROM products WHERE brand_id = $brand_id $sort_query";
                    } else {
                        $select_query = "SELECT * FROM products $sort_query";
                    }
                    $result_query = mysqli_query($con, $select_query);
                    if ($result_query && mysqli_num_rows($result_query) > 0) {
                        while($row = mysqli_fetch_assoc($result_query)){
                            $product_id = $row['p_id'];
                            $product_title = $row['p_title'];
                            $product_description = $row['p_description'];
                            $product_image1 = $row['p_image1'];
                            $product_price = $row['p_price'];
                            
                            echo "<div class='col-md-6 col-lg-4'>
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
            
            <!-- Pagination Placeholder -->
            <nav class="mt-5 pt-3">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled"><a class="page-link border-0 bg-light rounded-circle mx-1" href="#"><i class="fa-solid fa-chevron-left"></i></a></li>
                    <li class="page-item active"><a class="page-link border-0 rounded-circle mx-1" href="#">1</a></li>
                    <li class="page-item"><a class="page-link border-0 bg-light rounded-circle mx-1 text-dark" href="#">2</a></li>
                    <li class="page-item"><a class="page-link border-0 bg-light rounded-circle mx-1 text-dark" href="#"><i class="fa-solid fa-chevron-right"></i></a></li>
                </ul>
            </nav>
        </div>
    </div>
</main>

<?php include('includes/footer.php'); ?>
