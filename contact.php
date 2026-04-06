<?php include('includes/header.php'); ?>
<?php include('includes/navbar.php'); ?>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="bg-white rounded-5 shadow-sm overflow-hidden">
                <div class="row g-0">
                    <div class="col-lg-5 bg-primary p-5 text-white d-flex flex-column justify-content-between">
                        <div>
                            <h2 class="fw-bold mb-4">Contact <span class="text-white-50">Information</span></h2>
                            <p class="mb-5 text-white-50 lead">Fill out the form and our team will get back to you within 24 hours.</p>
                            
                            <div class="d-flex align-items-center mb-4">
                                <i class="fa-solid fa-phone-volume fa-2x me-4 opacity-75"></i>
                                <div>
                                    <h6 class="mb-0 fw-bold">Phone Number</h6>
                                    <p class="mb-0">+1 (555) 000-1234</p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-4">
                                <i class="fa-solid fa-envelope-open-text fa-2x me-4 opacity-75"></i>
                                <div>
                                    <h6 class="mb-0 fw-bold">Email Address</h6>
                                    <p class="mb-0">support@modernstore.com</p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-location-dot fa-2x me-4 opacity-75"></i>
                                <div>
                                    <h6 class="mb-0 fw-bold">Main Store</h6>
                                    <p class="mb-0">123 Tech Avenue, Silicon Valley, CA</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-3 mt-5">
                            <a href="#" class="btn btn-outline-light rounded-circle p-2 px-3"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#" class="btn btn-outline-light rounded-circle p-2 px-3"><i class="fa-brands fa-twitter"></i></a>
                            <a href="#" class="btn btn-outline-light rounded-circle p-2 px-3"><i class="fa-brands fa-instagram"></i></a>
                        </div>
                    </div>
                    
                    <div class="col-lg-7 p-5">
                        <form action="" method="post" class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">First Name</label>
                                <input type="text" class="form-control border-0 bg-light p-3 rounded-3" placeholder="John">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Last Name</label>
                                <input type="text" class="form-control border-0 bg-light p-3 rounded-3" placeholder="Doe">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small">Email Address</label>
                                <input type="email" class="form-control border-0 bg-light p-3 rounded-3" placeholder="john.doe@example.com">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small">Subject</label>
                                <select class="form-select border-0 bg-light p-3 rounded-3">
                                    <option selected>General Inquiry</option>
                                    <option value="1">Order Status</option>
                                    <option value="2">Product Returns</option>
                                    <option value="3">Special Request</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small">Message</label>
                                <textarea class="form-control border-0 bg-light p-3 rounded-3" rows="4" placeholder="How can we help?"></textarea>
                            </div>
                            <div class="col-12 d-grid">
                                <button type="submit" class="btn btn-primary btn-lg p-3 rounded-3">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include('includes/footer.php'); ?>
