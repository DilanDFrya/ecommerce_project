<?php include('includes/header.php'); ?>
<?php include('includes/navbar.php'); ?>

<main class="container py-5">
    <h1 class="fw-bold mb-5">Your <span class="text-primary">Shopping Cart</span></h1>
    
    <div class="row g-5">
        <!-- Cart Items -->
        <div class="col-lg-8">
            <div class="bg-white rounded-5 shadow-sm p-4 h-100">
                <div class="table-responsive">
                    <table class="table table-borderless align-middle mb-0">
                        <thead>
                            <tr class="text-muted small border-bottom">
                                <th scope="col" class="pb-3 px-4">PRODUCT</th>
                                <th scope="col" class="pb-3 text-center">QUANTITY</th>
                                <th scope="col" class="pb-3 text-end">PRICE</th>
                                <th scope="col" class="pb-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Product 1 -->
                            <tr class="border-bottom">
                                <td class="py-4 px-4">
                                    <div class="d-flex align-items-center">
                                        <img src="images/laptop.png" width="80" height="60" class="rounded-3 shadow-sm me-3 object-fit-cover" alt="Product">
                                        <h6 class="mb-0 fw-bold">High-Performance Laptop Pro</h6>
                                    </div>
                                </td>
                                <td class="py-4 text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <button class="btn btn-light btn-sm rounded-circle shadow-sm px-2"><i class="fa-solid fa-minus"></i></button>
                                        <span class="mx-3 fw-bold">1</span>
                                        <button class="btn btn-light btn-sm rounded-circle shadow-sm px-2"><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                </td>
                                <td class="py-4 text-end">
                                    <h6 class="mb-0 fw-bold">$1,299.00</h6>
                                </td>
                                <td class="py-4 text-end">
                                    <button class="btn btn-link text-danger text-decoration-none px-4"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            <!-- Product 2 Placeholder -->
                            <tr>
                                <td class="py-4 px-4 text-center text-muted" colspan="4">
                                    <div class="py-5">
                                        <p class="mb-0">Your cart has items waiting for you</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Summary -->
        <aside class="col-lg-4">
            <div class="bg-white rounded-5 shadow-sm p-5 sticky-top" style="top: 120px; z-index: 900;">
                <h4 class="fw-bold mb-4">Summary</h4>
                <div class="d-flex justify-content-between mb-3 text-muted small">
                    <p class="mb-0">Subtotal</p>
                    <p class="mb-0 fw-bold text-dark">$1,299.00</p>
                </div>
                <div class="d-flex justify-content-between mb-3 text-muted small">
                    <p class="mb-0">Shipping</p>
                    <p class="mb-0 fw-bold text-success">FREE</p>
                </div>
                <div class="d-flex justify-content-between mb-4 text-muted small">
                    <p class="mb-0">Estimated-Tax</p>
                    <p class="mb-0 fw-bold text-dark">$103.92</p>
                </div>
                <div class="border-top pt-4 mt-2">
                    <div class="d-flex justify-content-between mb-5 h5 fw-bold">
                        <p class="mb-0">Total</p>
                        <p class="mb-0 text-primary">$1,402.92</p>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary btn-lg p-3 rounded-3 shadow">Check Out Now</button>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <p class="small text-muted"><i class="fa-solid fa-lock me-1"></i> Secure Checkout</p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include('includes/footer.php'); ?>
