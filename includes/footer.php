<footer class="bg-white border-top py-5 mt-5">
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <h5 class="fw-bold mb-4 text-primary"><i class="fa-solid fa-shop me-2"></i> MODERN STORE</h5>
                <p class="text-muted small pe-lg-5">The ultimate destination for the latest in technology and lifestyle products. We pride ourselves on offering products that combine performance, style, and reliability.</p>
                <div class="d-flex gap-3 mt-4">
                    <a href="#" class="text-muted"><i class="fa-brands fa-facebook fa-xl"></i></a>
                    <a href="#" class="text-muted"><i class="fa-brands fa-twitter fa-xl"></i></a>
                    <a href="#" class="text-muted"><i class="fa-brands fa-instagram fa-xl"></i></a>
                    <a href="#" class="text-muted"><i class="fa-brands fa-linkedin fa-xl"></i></a>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 mb-4">
                <h6 class="fw-bold mb-4">Shop</h6>
                <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
                    <li><a href="#" class="footer-link small">Laptops</a></li>
                    <li><a href="#" class="footer-link small">Smartphones</a></li>
                    <li><a href="#" class="footer-link small">Accessories</a></li>
                    <li><a href="#" class="footer-link small">Tablets</a></li>
                </ul>
            </div>
            
            <div class="col-lg-3 col-md-4 mb-4">
                <h6 class="fw-bold mb-4">Company</h6>
                <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
                    <li><a href="#" class="footer-link small">About Us</a></li>
                    <li><a href="#" class="footer-link small">Careers</a></li>
                    <li><a href="#" class="footer-link small">Contact</a></li>
                    <li><a href="#" class="footer-link small">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
        
        <div class="border-top mt-5 pt-4 d-flex flex-wrap justify-content-between align-items-center">
            <p class="text-muted small mb-0">&copy; 2026 Modern Store. Built for the future.</p>
            <div class="d-flex gap-3">
                <i class="fa-brands fa-cc-visa fa-2x text-muted"></i>
                <i class="fa-brands fa-cc-mastercard fa-2x text-muted"></i>
                <i class="fa-brands fa-cc-paypal fa-2x text-muted"></i>
                <i class="fa-brands fa-cc-apple-pay fa-2x text-muted"></i>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php if(isset($_SESSION['toast_msg']) && isset($_SESSION['toast_status'])): ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        Toast.fire({
            icon: '<?php echo $_SESSION['toast_status']; ?>',
            title: '<?php echo $_SESSION['toast_msg']; ?>'
        });
    });
    </script>
<?php 
    unset($_SESSION['toast_msg']);
    unset($_SESSION['toast_status']);
endif; 
?>

<!-- Live Search Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchSuggestions = document.getElementById('searchSuggestions');
    const clearSearch = document.getElementById('clearSearch');
    let debounceTimer;

    if (searchInput && searchSuggestions) {
        if (clearSearch) {
            clearSearch.addEventListener('click', function() {
                searchInput.value = '';
                this.style.display = 'none';
                searchSuggestions.style.display = 'none';
                searchInput.focus();
            });
        }

        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            const query = this.value.trim();

            if (clearSearch) {
                clearSearch.style.display = query.length > 0 ? 'block' : 'none';
            }

            if (query.length < 2) {
                searchSuggestions.style.display = 'none';
                return;
            }

            debounceTimer = setTimeout(() => {
                fetch(`<?php echo isset($path_prefix) ? $path_prefix : ''; ?>search_suggestions.php?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        searchSuggestions.innerHTML = '';
                        if (data.length > 0) {
                            let html = '<ul class="list-group list-group-flush m-0">';
                            data.forEach(item => {
                                html += `
                                    <li class="list-group-item list-group-item-action d-flex align-items-center p-2">
                                        <a href="<?php echo isset($path_prefix) ? $path_prefix : ''; ?>product_details.php?product_id=${item.id}" class="text-decoration-none text-dark d-flex align-items-center w-100">
                                            <img src="<?php echo isset($path_prefix) ? $path_prefix : ''; ?>admin_area/product_images/${item.image}" alt="${item.title}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;" class="me-3">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <div class="fw-bold small text-truncate">${item.title}</div>
                                                <div class="text-primary small fw-bold">$${item.price}</div>
                                            </div>
                                        </a>
                                    </li>
                                `;
                            });
                            html += '</ul>';
                            
                            html += `
                                <div class="p-2 border-top bg-light text-center">
                                    <a href="<?php echo isset($path_prefix) ? $path_prefix : ''; ?>products.php?search=${encodeURIComponent(query)}" class="small text-primary text-decoration-none fw-bold">See all results</a>
                                </div>
                            `;
                            
                            searchSuggestions.innerHTML = html;
                            searchSuggestions.style.display = 'block';
                        } else {
                            searchSuggestions.innerHTML = '<div class="p-3 text-muted small text-center">No products found</div>';
                            searchSuggestions.style.display = 'block';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching suggestions:', error);
                    });
            }, 300);
        });

        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchSuggestions.contains(e.target)) {
                searchSuggestions.style.display = 'none';
            }
        });
        
        searchInput.addEventListener('focus', function() {
            if (this.value.trim().length >= 2 && searchSuggestions.innerHTML !== '') {
                searchSuggestions.style.display = 'block';
            }
        });
    }
});
// AJAX Add to Cart Logic
document.addEventListener('click', function(e) {
    const addToCartBtn = e.target.closest('a[href*="add_to_cart="]');
    if (addToCartBtn) {
        // Check if it's already in cart (has btn-success class)
        if (addToCartBtn.classList.contains('btn-success')) {
            return; // Normal navigation to cart.php
        }

        e.preventDefault();
        const url = addToCartBtn.getAttribute('href');

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Update Navbar Cart Count
            const cartBadge = document.getElementById('cartCountBadge');
            if (cartBadge && data.count !== undefined) {
                cartBadge.innerText = data.count;
            }

            // Show Toast
            const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });

            Toast.fire({
                icon: data.status,
                title: data.msg
            });

            // If success or info (already in cart), update button UI
            if (data.status === 'success' || data.status === 'info') {
                addToCartBtn.classList.remove('btn-primary');
                addToCartBtn.classList.add('btn-success');
                addToCartBtn.innerHTML = '<i class="fa-solid fa-check me-2"></i> Already in cart';
                addToCartBtn.setAttribute('href', 'cart.php');
            }

            // Handle redirect if not logged in
            if (data.redirect) {
                window.location.href = data.redirect;
            }
        })
        .catch(error => {
            console.error('Error adding to cart:', error);
            // Fallback: normal navigation if AJAX fails
            window.location.href = url;
        });
    }
});
// AJAX Cart Management Logic (for cart.php)
document.addEventListener('click', function(e) {
    const cartActionBtn = e.target.closest('.cart-action');
    if (cartActionBtn) {
        e.preventDefault();
        const url = cartActionBtn.getAttribute('href');
        const urlParts = url.split('?');
        if (urlParts.length < 2) return;
        
        const urlParams = new URLSearchParams(urlParts[1]);
        const productId = urlParams.get('id');
        const action = urlParams.get('action');

        // Function to perform the actual update
        const performUpdate = () => {
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Update Navbar Cart Count
                    const cartBadge = document.getElementById('cartCountBadge');
                    if (cartBadge) cartBadge.innerText = data.cart_count;

                    if (data.removed) {
                        // Remove the row from the table
                        const row = document.getElementById(`product-row-${productId}`);
                        if (row) {
                            row.style.opacity = '0';
                            setTimeout(() => {
                                row.remove();
                                if (data.cart_count == 0) {
                                    location.reload();
                                }
                            }, 300);
                        }
                    } else {
                        // Update Quantity and Row Total
                        const qtyDisplay = document.getElementById(`qty-${productId}`);
                        const itemTotal = document.getElementById(`item-total-${productId}`);
                        if (qtyDisplay) qtyDisplay.innerText = data.new_qty;
                        if (itemTotal) itemTotal.innerText = `$${data.item_total}`;
                    }

                    // Update Summary Totals
                    const subtotalDisp = document.getElementById('cart-subtotal');
                    const taxDisp = document.getElementById('cart-tax');
                    const totalDisp = document.getElementById('cart-total');
                    
                    if (subtotalDisp) subtotalDisp.innerText = data.subtotal;
                    if (taxDisp) taxDisp.innerText = data.tax;
                    if (totalDisp) totalDisp.innerText = data.total;
                }
            })
            .catch(error => {
                console.error('Error managing cart:', error);
                window.location.href = url;
            });
        };

        // Show confirmation for delete action
        if (action === 'remove') {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to remove this item from your cart?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    performUpdate();
                }
            });
        } else {
            // Non-delete actions (inc/dec) proceed immediately
            performUpdate();
        }
    }
});
</script>
</body>
</html>
