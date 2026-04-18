<?php include('includes/header.php'); ?>
<?php include('config/db.php'); ?>
<?php include('includes/navbar.php'); ?>

<!-- Hero Section -->
<section class="position-relative bg-dark text-white overflow-hidden py-5 mb-5" style="background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%); min-height: 500px; display: flex; align-items: center;">
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-25" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    <div class="container position-relative z-1">
        <div class="row align-items-center">
            <div class="col-lg-7 py-5">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-3 fw-bold tracking-wide text-uppercase" style="letter-spacing: 2px;">Welcome to Modern Store</span>
                <h1 class="display-3 fw-bold mb-4" style="line-height: 1.2;">Elevate Your Tech Experience</h1>
                <p class="lead mb-5 opacity-75" style="max-width: 600px;">Discover the latest premium devices, accessories, and cutting-edge technology curated just for you. Quality guaranteed.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="products.php" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-lg fw-bold"><i class="fa-solid fa-cart-shopping me-2"></i> Shop Now</a>
                    <a href="#categories" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill fw-bold">Explore Categories</a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block text-center">
                <i class="fa-solid fa-layer-group opacity-25" style="font-size: 15rem; transform: rotate(-15deg);"></i>
            </div>
        </div>
    </div>
</section>

<!-- Category Highlights Section -->
<section id="categories" class="container mb-5 pb-4">
    <div class="text-center mb-5">
        <h2 class="fw-bold mb-2">Browse <span class="text-primary">Categories</span></h2>
        <p class="text-muted">Find exactly what you're looking for</p>
    </div>
    
    <div class="row g-4 justify-content-center">
        <?php
        if(isset($con)){
            $get_cats = "SELECT * FROM `categories` LIMIT 6";
            $res_cats = mysqli_query($con, $get_cats);
            
            $icons = ['fa-laptop', 'fa-mobile-screen-button', 'fa-camera', 'fa-headphones', 'fa-gamepad', 'fa-tv'];
            $i = 0;
            
            while($row_cat = mysqli_fetch_assoc($res_cats)){
                $cat_title = $row_cat['category_title'];
                $cat_id = $row_cat['category_id'];
                $icon = $icons[$i % count($icons)];
                $i++;
                
                echo "
                <div class='col-6 col-md-4 col-lg-2'>
                    <a href='products.php?category=$cat_id' class='text-decoration-none'>
                        <div class='card border-0 shadow-sm h-100 rounded-4 text-center p-4' style='transition: all 0.3s; cursor: pointer;' onmouseover='this.classList.add(\"shadow\")' onmouseout='this.classList.remove(\"shadow\")'>
                            <div class='mb-3 text-primary'>
                                <i class='fa-solid $icon fa-2x'></i>
                            </div>
                            <h6 class='text-dark fw-bold mb-0'>$cat_title</h6>
                        </div>
                    </a>
                </div>
                ";
            }
        }
        ?>
    </div>
</section>

<!-- Latest Arrivals Section -->
<section class="bg-light py-5 mb-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <h2 class="fw-bold mb-1">Latest <span class="text-primary">Arrivals</span></h2>
                <p class="text-muted mb-0">Our newest premium products</p>
            </div>
            <a href="products.php" class="btn btn-outline-primary rounded-pill px-4">View All <i class="fa-solid fa-arrow-right ms-2"></i></a>
        </div>
        
        <div class="row g-4">
            <?php
            if (isset($con)) {
                $select_query = "SELECT * FROM products ORDER BY date DESC LIMIT 4";
                $result_query = mysqli_query($con, $select_query);
                if ($result_query && mysqli_num_rows($result_query) > 0) {
                    while($row = mysqli_fetch_assoc($result_query)){
                        $product_id = $row['p_id'];
                        $product_title = $row['p_title'];
                        $product_description = $row['p_description'];
                        $product_image1 = $row['p_image1'];
                        $product_price = $row['p_price'];
                        
                        echo "<div class='col-md-6 col-lg-3'>
                            <div class='card h-100 border-0 shadow-sm rounded-4 overflow-hidden'>
                                <div class='position-relative overflow-hidden bg-white d-flex align-items-center justify-content-center' style='height: 250px; padding: 15px;'>
                                    <img src='admin_area/product_images/$product_image1' class='img-fluid' alt='$product_title' style='max-height: 100%; object-fit: contain; transition: transform 0.5s;' onmouseover='this.style.transform=\"scale(1.1)\"' onmouseout='this.style.transform=\"scale(1)\"'>
                                    <span class='position-absolute top-0 start-0 m-3 badge bg-danger rounded-pill px-3 py-2 shadow-sm'>NEW</span>
                                </div>
                                <div class='card-body p-4'>
                                    <h5 class='card-title mb-2 fw-bold text-truncate'>$product_title</h5>
                                    <p class='text-muted small mb-3 text-truncate'>$product_description</p>
                                    <h4 class='text-primary fw-bold mb-4'>$$product_price</h4>
                                    <div class='d-grid gap-2'>
                                        <a href='index.php?add_to_cart=$product_id' class='btn btn-primary rounded-pill'><i class='fa-solid fa-cart-plus me-2'></i> Add to cart</a>
                                        <a href='product_details.php?product_id=$product_id' class='btn btn-light rounded-pill text-muted small border'>View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    }
                } else {
                    echo "<div class='col-12'><h4 class='text-danger text-center'>No products available</h4></div>";
                }
            }
            ?>
        </div>
    </div>
</section>

<!-- Features / Perks Section -->
<section class="container mb-5">
    <div class="card border-0 text-white shadow-lg rounded-4 overflow-hidden" style="background: linear-gradient(135deg, #0dcaf0 0%, #0d6efd 100%);">
        <div class="card-body p-5">
            <div class="row g-4 text-center">
                <div class="col-md-3 border-end border-white border-opacity-25">
                    <i class="fa-solid fa-truck-fast fa-2x mb-3 opacity-75"></i>
                    <h5 class="fw-bold mb-2">Free Shipping</h5>
                    <p class="small opacity-75 mb-0">On all orders over $100</p>
                </div>
                <div class="col-md-3 border-end border-white border-opacity-25">
                    <i class="fa-solid fa-shield-halved fa-2x mb-3 opacity-75"></i>
                    <h5 class="fw-bold mb-2">Secure Payments</h5>
                    <p class="small opacity-75 mb-0">100% safe & encrypted</p>
                </div>
                <div class="col-md-3 border-end border-white border-opacity-25">
                    <i class="fa-solid fa-arrow-rotate-left fa-2x mb-3 opacity-75"></i>
                    <h5 class="fw-bold mb-2">Easy Returns</h5>
                    <p class="small opacity-75 mb-0">30-day return policy</p>
                </div>
                <div class="col-md-3">
                    <i class="fa-solid fa-headset fa-2x mb-3 opacity-75"></i>
                    <h5 class="fw-bold mb-2">24/7 Support</h5>
                    <p class="small opacity-75 mb-0">We are always here to help</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('includes/footer.php'); ?>