<aside class="col-md-3">
    <!-- Brands Section -->
    <div class="sidebar-card">
        <h5 class="sidebar-title"><i class="fa-solid fa-truck-fast me-2"></i> Delivery Brands</h5>
        <div class="list-group list-group-flush">
            <?php
            if(isset($con)){
                $select_brands = "SELECT * FROM `brands`";
                $result_brands = mysqli_query($con, $select_brands);
                while($row_data = mysqli_fetch_assoc($result_brands)){
                    $brand_title = $row_data['brand_title'];
                    $brand_id = $row_data['brand_id'];
                    echo "<a href='products.php?brand=$brand_id' class='list-group-item list-group-item-action'>
                            <i class='fa-solid fa-chevron-right me-2 opacity-50 small'></i> $brand_title
                        </a>";
                }
            }
            ?>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="sidebar-card">
        <h5 class="sidebar-title"><i class="fa-solid fa-layer-group me-2"></i> Categories</h5>
        <div class="list-group list-group-flush">
            <?php
            if(isset($con)){
                $select_categories = "SELECT * FROM `categories`";
                $result_categories = mysqli_query($con, $select_categories);
                while($row_data = mysqli_fetch_assoc($result_categories)){
                    $category_title = $row_data['category_title'];
                    $category_id = $row_data['category_id'];
                    echo "<a href='products.php?category=$category_id' class='list-group-item list-group-item-action'>
                            <i class='fa-solid fa-chevron-right me-2 opacity-50 small'></i> $category_title
                        </a>";
                }
            }
            ?>
        </div>
    </div>
</aside>
