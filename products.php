<?php include('includes/header.php'); ?>
<?php include('includes/navbar.php'); ?>

<main class="container py-5">
    <div class="row">
        <!-- Sidebar Section -->
        <?php include('includes/sidebar.php'); ?>

        <!-- Main Content Area -->
        <div class="col-md-9 px-lg-4">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <div>
                    <h1 class="fw-bold mb-1">Our <span class="text-primary">Products</span></h1>
                    <p class="text-muted mb-0">Browse through our curated collection of tech devices</p>
                </div>
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle px-4 py-2 rounded-3 border" type="button" data-bs-toggle="dropdown">
                        Sort By: Default
                    </button>
                    <ul class="dropdown-menu border-0 shadow-sm">
                        <li><a class="dropdown-item" href="#">Price: Low to High</a></li>
                        <li><a class="dropdown-item" href="#">Price: High to Low</a></li>
                        <li><a class="dropdown-item" href="#">Newest First</a></li>
                    </ul>
                </div>
            </div>

            <div class="row g-4">
                <!-- Product 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="position-relative overflow-hidden">
                            <img src="images/laptop.png" class="card-img-top" alt="Product">
                            <div class="position-absolute top-0 end-0 p-3">
                                <span class="badge bg-white text-dark shadow-sm px-3 py-2">-20% OFF</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title mb-1 text-truncate">High-Performance Laptop Pro</h5>
                            <p class="text-muted small mb-3">Professional Series | 16GB RAM</p>
                            <div class="d-flex align-items-center mb-4">
                                <h4 class="text-primary mb-0">$1,299</h4>
                                <small class="text-muted text-decoration-line-through ms-2">$1,599</small>
                            </div>
                            <div class="d-grid gap-2">
                                <a href="#" class="btn btn-primary"><i class="fa-solid fa-cart-plus me-2"></i> Add to cart</a>
                                <a href="#" class="btn btn-light text-muted small">Quick View</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-lg">
                        <div class="position-relative overflow-hidden">
                            <img src="images/laptop2.png" class="card-img-top" alt="Product">
                            <div class="position-absolute top-0 end-0 p-3">
                                <span class="badge bg-primary px-3 py-2">NEW</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title mb-1 text-truncate">Sleek Ultrabook Air</h5>
                            <p class="text-muted small mb-3">Ultra-thin | 12-hour Battery</p>
                            <div class="d-flex align-items-center mb-4">
                                <h4 class="text-primary mb-0">$999</h4>
                            </div>
                            <div class="d-grid gap-2">
                                <a href="#" class="btn btn-primary"><i class="fa-solid fa-cart-plus me-2"></i> Add to cart</a>
                                <a href="#" class="btn btn-light text-muted small">Quick View</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="position-relative overflow-hidden">
                            <img src="images/phone.png" class="card-img-top" alt="Product">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title mb-1 text-truncate">Phone X Max Pro</h5>
                            <p class="text-muted small mb-3">4K Camera | 5G Network</p>
                            <div class="d-flex align-items-center mb-4">
                                <h4 class="text-primary mb-0">$899</h4>
                            </div>
                            <div class="d-grid gap-2">
                                <a href="#" class="btn btn-primary"><i class="fa-solid fa-cart-plus me-2"></i> Add to cart</a>
                                <a href="#" class="btn btn-light text-muted small">Quick View</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product 4 Placeholder -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="position-relative overflow-hidden">
                            <img src="images/laptop.png" class="card-img-top" alt="Product">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title mb-1 text-truncate">Business Laptop Core</h5>
                            <p class="text-muted small mb-3">Intel i7 | 512GB SSD</p>
                            <div class="d-flex align-items-center mb-4">
                                <h4 class="text-primary mb-0">$1,149</h4>
                            </div>
                            <div class="d-grid gap-2">
                                <a href="#" class="btn btn-primary"><i class="fa-solid fa-cart-plus me-2"></i> Add to cart</a>
                                <a href="#" class="btn btn-light text-muted small">Quick View</a>
                            </div>
                        </div>
                    </div>
                </div>
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
