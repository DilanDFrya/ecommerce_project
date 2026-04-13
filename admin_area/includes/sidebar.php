        <!-- Sidebar Component -->
        <div class="col-md-2 sidebar d-flex flex-column shadow-lg" style="background: linear-gradient(180deg, #1e1e2f 0%, #2a2a40 100%); z-index: 1000;">
            <div class="py-4 px-3 mb-3 text-center" style="border-bottom: 1px solid rgba(255,255,255,0.05); background: rgba(0,0,0,0.15);">
                <h3 class="mb-0 fw-bold" style="letter-spacing: 1px;">
                    Admin <span class="text-info">Panel</span>
                </h3>
            </div>
            
            <ul class="nav flex-column mb-auto px-3 gap-1">
                <li class="nav-item">
                    <a href="index.php" class="nav-link rounded-3 <?php if(!isset($_GET['products'])) echo 'active'; else echo 'text-secondary'; ?>" style="transition: all 0.3s; <?php if(!isset($_GET['products'])) echo 'background: rgba(13, 202, 240, 0.15); color: #0dcaf0; border-left: 4px solid #0dcaf0; font-weight: 600;'; ?>">
                        <i class="fa-solid fa-gauge-high me-3 opacity-75"></i> Dashboard
                    </a>
                </li>
                
                <h6 class="mt-4 pt-2 mb-2 px-3 text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 1px;">Manage Store</h6>
                
                <li class="nav-item">
                    <a href="index.php?products" class="nav-link rounded-3 <?php if(isset($_GET['products'])) echo 'active'; else echo 'text-secondary'; ?>" style="transition: all 0.3s; <?php if(isset($_GET['products'])) echo 'background: rgba(13, 202, 240, 0.15); color: #0dcaf0; border-left: 4px solid #0dcaf0; font-weight: 600;'; ?>">
                        <i class="fa-solid fa-box-open me-3 opacity-75"></i> Products
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link rounded-3 text-secondary" style="transition: all 0.3s;">
                        <i class="fa-solid fa-layer-group me-3 opacity-75"></i> Categories
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link rounded-3 text-secondary" style="transition: all 0.3s;">
                        <i class="fa-solid fa-tag me-3 opacity-75"></i> Brands
                    </a>
                </li>
                
                <h6 class="mt-4 pt-2 mb-2 px-3 text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 1px;">Users</h6>
                <li class="nav-item">
                    <a href="#" class="nav-link rounded-3 text-secondary" style="transition: all 0.3s;">
                        <i class="fa-solid fa-users me-3 opacity-75"></i> View Users
                    </a>
                </li>
            </ul>
            
            <div class="mt-auto px-3 pb-4 pt-3" style="border-top: 1px solid rgba(255,255,255,0.05); background: rgba(0,0,0,0.1);">
                <a href="../index.php" class="nav-link rounded-3 d-flex align-items-center justify-content-center text-warning" style="background: rgba(255, 193, 7, 0.1); transition: all 0.3s;">
                    <i class="fa-solid fa-store me-2"></i> <span class="fw-bold">View Storefront</span>
                </a>
            </div>
        </div>
