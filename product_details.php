<?php include('includes/header.php'); ?>
<?php include('config/db.php'); ?>
<?php include('includes/navbar.php'); ?>

<main class="container py-5">
    <?php
    if(isset($_GET['product_id'])){
        $product_id = intval($_GET['product_id']);
        
        $get_product = "
            SELECT p.*, c.category_title, b.brand_title 
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.category_id
            LEFT JOIN brands b ON p.brand_id = b.brand_id
            WHERE p.p_id = $product_id
        ";
        $result_product = mysqli_query($con, $get_product);
        
        if($result_product && mysqli_num_rows($result_product) > 0){
            $row = mysqli_fetch_assoc($result_product);
            
            $title = htmlspecialchars($row['p_title'], ENT_QUOTES);
            $description = htmlspecialchars($row['p_description'], ENT_QUOTES);
            $price = $row['p_price'];
            $image1 = $row['p_image1'];
            $image2 = $row['p_image2'];
            $image3 = $row['p_image3'];
            $category = $row['category_title'] ?? 'Uncategorized';
            $brand = $row['brand_title'] ?? 'Unbranded';
            ?>
            
            <nav aria-label="breadcrumb" class="mb-4">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-primary">Home</a></li>
                <li class="breadcrumb-item"><a href="products.php?category=<?php echo $row['category_id']; ?>" class="text-decoration-none text-primary"><?php echo $category; ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
              </ol>
            </nav>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
                <div class="row g-0">
                    <!-- Image Gallery Column -->
                    <div class="col-lg-6 bg-light p-4 d-flex flex-column align-items-center justify-content-center">
                        <div class="mb-4 w-100 text-center">
                            <img src="admin_area/product_images/<?php echo $image1; ?>" id="mainProductImage" class="img-fluid rounded-3 shadow-sm object-fit-contain" style="max-height: 400px; width: 100%;" alt="<?php echo $title; ?>">
                        </div>
                        
                        <!-- Thumbnail Previews -->
                        <div class="d-flex gap-3 justify-content-center">
                            <div class="thumbnail-wrapper border border-2 border-primary rounded-3 p-1 cursor-pointer" onclick="changeImage('<?php echo $image1; ?>', this)">
                                <img src="admin_area/product_images/<?php echo $image1; ?>" class="rounded object-fit-cover" style="width: 70px; height: 70px; cursor: pointer;" alt="Thumbnail 1">
                            </div>
                            <?php if(!empty($image2)): ?>
                            <div class="thumbnail-wrapper border border-2 border-transparent rounded-3 p-1 cursor-pointer" onclick="changeImage('<?php echo $image2; ?>', this)">
                                <img src="admin_area/product_images/<?php echo $image2; ?>" class="rounded object-fit-cover" style="width: 70px; height: 70px; cursor: pointer;" alt="Thumbnail 2">
                            </div>
                            <?php endif; ?>
                            <?php if(!empty($image3)): ?>
                            <div class="thumbnail-wrapper border border-2 border-transparent rounded-3 p-1 cursor-pointer" onclick="changeImage('<?php echo $image3; ?>', this)">
                                <img src="admin_area/product_images/<?php echo $image3; ?>" class="rounded object-fit-cover" style="width: 70px; height: 70px; cursor: pointer;" alt="Thumbnail 3">
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Product Details Column -->
                    <div class="col-lg-6 p-5 d-flex flex-column justify-content-center">
                        <div class="d-flex gap-2 mb-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill"><i class="fa-solid fa-layer-group me-1"></i> <?php echo $category; ?></span>
                            <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill"><i class="fa-solid fa-tag me-1"></i> <?php echo $brand; ?></span>
                        </div>
                        
                        <h1 class="display-6 fw-bold mb-3"><?php echo $title; ?></h1>
                        <h2 class="text-primary fw-bold mb-4">$<?php echo $price; ?></h2>
                        
                        <div class="mb-4">
                            <h5 class="fw-bold mb-2">Description</h5>
                            <p class="text-muted lh-lg"><?php echo nl2br($description); ?></p>
                        </div>
                        
                        <div class="d-grid gap-3 d-md-flex mt-auto pt-4 border-top">
                            <a href="index.php?add_to_cart=<?php echo $product_id; ?>" class="btn btn-primary btn-lg px-5 shadow-sm rounded-pill d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-cart-plus me-2"></i> Add to Cart
                            </a>
                            <a href="products.php" class="btn btn-light btn-lg px-4 rounded-pill border d-flex align-items-center justify-content-center text-muted">
                                <i class="fa-solid fa-arrow-left me-2"></i> Back to Shop
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            <div class="mt-5 pt-4 border-top">
                <h3 class="fw-bold mb-4">Related <span class="text-primary">Products</span></h3>
                <div class="row g-4">
                    <?php
                    $category_id = $row['category_id'];
                    $related_query = "SELECT * FROM products WHERE category_id = $category_id AND p_id != $product_id ORDER BY rand() LIMIT 4";
                    $related_result = mysqli_query($con, $related_query);
                    if(mysqli_num_rows($related_result) > 0){
                        while($rel = mysqli_fetch_assoc($related_result)){
                            $r_id = $rel['p_id'];
                            $r_title = $rel['p_title'];
                            $r_price = $rel['p_price'];
                            $r_img = $rel['p_image1'];
                            echo "
                            <div class='col-md-3'>
                                <div class='card h-100 border-0 shadow-sm'>
                                    <div class='position-relative overflow-hidden'>
                                        <img src='admin_area/product_images/$r_img' class='card-img-top' alt='$r_title' style='object-fit: cover; height: 200px;'>
                                    </div>
                                    <div class='card-body p-3'>
                                        <h6 class='card-title mb-1 text-truncate'>$r_title</h6>
                                        <p class='text-primary fw-bold mb-0'>$$r_price</p>
                                    </div>
                                    <div class='card-footer bg-white border-0 p-3 pt-0'>
                                        <a href='product_details.php?product_id=$r_id' class='btn btn-sm btn-outline-primary w-100'>View Details</a>
                                    </div>
                                </div>
                            </div>
                            ";
                        }
                    } else {
                        echo "<p class='text-muted'>No related products found.</p>";
                    }
                    ?>
                </div>
            </div>

            <script>
            function changeImage(imageName, element) {
                // Update main image source
                document.getElementById('mainProductImage').src = 'admin_area/product_images/' + imageName;
                
                // Reset border classes on all thumbnails
                const thumbnails = document.querySelectorAll('.thumbnail-wrapper');
                thumbnails.forEach(thumb => {
                    thumb.classList.remove('border-primary');
                    thumb.classList.add('border-transparent');
                });
                
                // Add primary border class to clicked thumbnail
                element.classList.remove('border-transparent');
                element.classList.add('border-primary');
            }
            </script>
            <style>
            .border-transparent { border-color: transparent !important; }
            </style>
            
            <?php
        } else {
            echo "<div class='alert alert-warning'>Product not found.</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>No product specified.</div>";
    }
    ?>
</main>

<?php include('includes/footer.php'); ?>
