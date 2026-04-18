<?php
// Pre-fetch categories and brands for efficiency in loops
$categories_array = [];
$get_cats = mysqli_query($con, "SELECT * FROM `categories`");
while($cat = mysqli_fetch_assoc($get_cats)){
    $categories_array[] = $cat;
}

$brands_array = [];
$get_brands = mysqli_query($con, "SELECT * FROM `brands`");
while($brand = mysqli_fetch_assoc($get_brands)){
    $brands_array[] = $brand;
}

// Handle insert product logic
if(isset($_POST['insert_product'])){
    $product_title = $_POST['p_title'];
    $product_description = $_POST['p_description'];
    $product_keywords = $_POST['p_keywords'];
    $product_category = $_POST['category_id'];
    $product_brand = $_POST['brand_id'];
    $product_price = $_POST['p_price'];
    $product_status = "true";

    $product_image1 = str_replace(' ', '_', $_FILES['p_image1']['name']);
    $product_image2 = str_replace(' ', '_', $_FILES['p_image2']['name']);
    $product_image3 = str_replace(' ', '_', $_FILES['p_image3']['name']);

    $temp_image1 = $_FILES['p_image1']['tmp_name'];
    $temp_image2 = $_FILES['p_image2']['tmp_name'];
    $temp_image3 = $_FILES['p_image3']['tmp_name'];

    if($product_title=='' or $product_description=='' or $product_keywords=='' or $product_category=='' or $product_brand=='' or $product_price=='' or $product_image1==''){
        $toast_status = 'warning';
        $toast_msg = 'Please fill all the required fields';
    } else {
        move_uploaded_file($temp_image1,"./product_images/$product_image1");
        if($product_image2) { move_uploaded_file($temp_image2,"./product_images/$product_image2"); }
        if($product_image3) { move_uploaded_file($temp_image3,"./product_images/$product_image3"); }

        $insert_product = "INSERT INTO `products` (p_title, p_description, p_keywords, category_id, brand_id, p_image1, p_image2, p_image3, p_price, date, status) 
        VALUES ('$product_title', '$product_description', '$product_keywords', '$product_category', '$product_brand', '$product_image1', '$product_image2', '$product_image3', '$product_price', NOW(), '$product_status')";
        
        $result_query = mysqli_query($con, $insert_product);
        if($result_query){
            $toast_status = 'success';
            $toast_msg = 'Product has been inserted successfully!';
        } else {
            $toast_status = 'error';
            $toast_msg = 'Failed to insert product: ' . addslashes(mysqli_error($con));
        }
    }
}

// Handle update product logic
if(isset($_POST['update_product'])){
    $edit_id = $_POST['edit_id'];
    $u_title = $_POST['p_title'];
    $u_description = $_POST['p_description'];
    $u_keywords = $_POST['p_keywords'];
    $u_category = $_POST['category_id'];
    $u_brand = $_POST['brand_id'];
    $u_price = $_POST['p_price'];
    
    $u_image1 = $_FILES['p_image1']['name'];
    $u_image2 = $_FILES['p_image2']['name'];
    $u_image3 = $_FILES['p_image3']['name'];
    
    $temp_image1 = $_FILES['p_image1']['tmp_name'];
    $temp_image2 = $_FILES['p_image2']['tmp_name'];
    $temp_image3 = $_FILES['p_image3']['tmp_name'];

    $update_query = "UPDATE `products` SET 
        p_title='$u_title', 
        p_description='$u_description', 
        p_keywords='$u_keywords', 
        category_id='$u_category', 
        brand_id='$u_brand', 
        p_price=$u_price";

    if($u_image1 != '') {
        $u_image1 = str_replace(' ', '_', $u_image1);
        move_uploaded_file($temp_image1, "./product_images/$u_image1");
        $update_query .= ", p_image1='$u_image1'";
    }
    if($u_image2 != '') {
        $u_image2 = str_replace(' ', '_', $u_image2);
        move_uploaded_file($temp_image2, "./product_images/$u_image2");
        $update_query .= ", p_image2='$u_image2'";
    }
    if($u_image3 != '') {
        $u_image3 = str_replace(' ', '_', $u_image3);
        move_uploaded_file($temp_image3, "./product_images/$u_image3");
        $update_query .= ", p_image3='$u_image3'";
    }

    $update_query .= " WHERE p_id=$edit_id";

    $result_update = mysqli_query($con, $update_query);

    if($result_update){
        $toast_status = 'success';
        $toast_msg = 'Product has been updated successfully!';
    } else {
        $toast_status = 'error';
        $toast_msg = 'Failed to update product: ' . addslashes(mysqli_error($con));
    }
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Manage <span class="text-primary">Products</span></h2>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addProductModal">
        <i class="fa-solid fa-plus me-2"></i> Add New Product
    </button>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="py-3">Image</th>
                        <th class="py-3">Title</th>
                        <th class="py-3">Price</th>
                        <th class="py-3">Date Added</th>
                        <th class="px-4 py-3 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $get_products = "SELECT * FROM `products` ORDER BY date DESC";
                        $result = mysqli_query($con, $get_products);
                        $number = 0;
                        while($row = mysqli_fetch_assoc($result)){
                            $product_id = $row['p_id'];
                            $product_title = htmlspecialchars($row['p_title'], ENT_QUOTES);
                            $product_description = htmlspecialchars($row['p_description'], ENT_QUOTES);
                            $product_keywords = htmlspecialchars($row['p_keywords'], ENT_QUOTES);
                            $category_id = $row['category_id'];
                            $brand_id = $row['brand_id'];
                            $product_image1 = $row['p_image1'];
                            $product_image2 = $row['p_image2'];
                            $product_image3 = $row['p_image3'];
                            $product_price = $row['p_price'];
                            $date = $row['date'];
                            $number++;
                            
                            $formatted_date = date("M d, Y", strtotime($date));
                            ?>
                            
                            <tr>
                                <td class='px-4 text-muted'>#<?php echo $number; ?></td>
                                <td>
                                    <img src='./product_images/<?php echo $product_image1; ?>' alt='<?php echo $product_title; ?>' class='rounded' style='width: 50px; height: 50px; object-fit: cover;'>
                                </td>
                                <td class='fw-medium'><?php echo $product_title; ?></td>
                                <td class='text-primary fw-bold'>$<?php echo $product_price; ?></td>
                                <td class='text-muted small'><?php echo $formatted_date; ?></td>
                                <td class='px-4 text-end'>
                                    <a href='#' data-bs-toggle='modal' data-bs-target='#editProductModal<?php echo $product_id; ?>' class='btn btn-sm btn-outline-secondary me-1'><i class='fa-solid fa-pen-to-square'></i></a>
                                    <a href='index.php?delete_product=<?php echo $product_id; ?>' class='btn btn-sm btn-outline-danger' onclick="event.preventDefault(); Swal.fire({title: 'Are you sure?', text: 'You won\'t be able to revert this!', icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#3085d6', confirmButtonText: 'Yes, delete it!'}).then((result) => { if (result.isConfirmed) { window.location.href = this.href; } });"><i class='fa-solid fa-trash'></i></a>
                                </td>
                            </tr>

                            <!-- Edit Modal for Product <?php echo $product_id; ?> -->
                            <div class="modal fade" id="editProductModal<?php echo $product_id; ?>" tabindex="-1" aria-hidden="true" style="text-align: left;">
                                <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header border-bottom-0 bg-light">
                                            <h5 class="modal-title fw-bold">Edit Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4 pt-3">
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="edit_id" value="<?php echo $product_id; ?>">
                                                
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="p_title" id="e_p_title<?php echo $product_id; ?>" class="form-control" value="<?php echo $product_title; ?>" required>
                                                    <label for="e_p_title<?php echo $product_id; ?>" class="form-label">Product title</label>
                                                </div>
                                                
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="p_description" id="e_p_description<?php echo $product_id; ?>" class="form-control" value="<?php echo $product_description; ?>" required>
                                                    <label for="e_p_description<?php echo $product_id; ?>" class="form-label">Product description</label>
                                                </div>
                                                
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="p_keywords" id="e_p_keywords<?php echo $product_id; ?>" class="form-control" value="<?php echo $product_keywords; ?>" required>
                                                    <label for="e_p_keywords<?php echo $product_id; ?>" class="form-label">Product keywords</label>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="e_category_id<?php echo $product_id; ?>" class="form-label text-muted ms-1"><small>Category</small></label>
                                                        <select name="category_id" id="e_category_id<?php echo $product_id; ?>" class="form-select border-0 bg-light py-2" required>
                                                            <?php
                                                            foreach($categories_array as $cat){
                                                                $cat_title = $cat['category_title'];
                                                                $cat_id = $cat['category_id'];
                                                                $selected = ($cat_id == $category_id) ? 'selected' : '';
                                                                echo "<option value='$cat_id' $selected>$cat_title</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="col-md-6 mb-3">
                                                        <label for="e_brand_id<?php echo $product_id; ?>" class="form-label text-muted ms-1"><small>Brand</small></label>
                                                        <select name="brand_id" id="e_brand_id<?php echo $product_id; ?>" class="form-select border-0 bg-light py-2" required>
                                                            <?php
                                                            foreach($brands_array as $brand){
                                                                $br_title = $brand['brand_title'];
                                                                $br_id = $brand['brand_id'];
                                                                $selected = ($br_id == $brand_id) ? 'selected' : '';
                                                                echo "<option value='$br_id' $selected>$br_title</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="mb-3 d-flex align-items-center gap-3">
                                                    <div class="flex-grow-1">
                                                        <label for="e_p_image1<?php echo $product_id; ?>" class="form-label">Product Image 1 (Primary)</label>
                                                        <input type="file" name="p_image1" id="e_p_image1<?php echo $product_id; ?>" class="form-control">
                                                    </div>
                                                    <?php if($product_image1 != '') { ?>
                                                        <img src="./product_images/<?php echo $product_image1; ?>" alt="Image 1" class="rounded object-fit-cover shadow-sm" style="width: 60px; height: 60px;">
                                                    <?php } ?>
                                                </div>
                                                
                                                <div class="mb-3 d-flex align-items-center gap-3">
                                                    <div class="flex-grow-1">
                                                        <label for="e_p_image2<?php echo $product_id; ?>" class="form-label">Product Image 2</label>
                                                        <input type="file" name="p_image2" id="e_p_image2<?php echo $product_id; ?>" class="form-control">
                                                    </div>
                                                    <?php if($product_image2 != '') { ?>
                                                        <img src="./product_images/<?php echo $product_image2; ?>" alt="Image 2" class="rounded object-fit-cover shadow-sm" style="width: 60px; height: 60px;">
                                                    <?php } ?>
                                                </div>
                                                
                                                <div class="mb-3 d-flex align-items-center gap-3">
                                                    <div class="flex-grow-1">
                                                        <label for="e_p_image3<?php echo $product_id; ?>" class="form-label">Product Image 3</label>
                                                        <input type="file" name="p_image3" id="e_p_image3<?php echo $product_id; ?>" class="form-control">
                                                    </div>
                                                    <?php if($product_image3 != '') { ?>
                                                        <img src="./product_images/<?php echo $product_image3; ?>" alt="Image 3" class="rounded object-fit-cover shadow-sm" style="width: 60px; height: 60px;">
                                                    <?php } ?>
                                                </div>
                                                
                                                <div class="form-floating mb-4">
                                                    <input type="number" name="p_price" id="e_p_price<?php echo $product_id; ?>" class="form-control" value="<?php echo $product_price; ?>" required>
                                                    <label for="e_p_price<?php echo $product_id; ?>" class="form-label">Product price</label>
                                                </div>
                                                
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-end border-top pt-4">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <input type="submit" name="update_product" class="btn btn-primary px-4" value="Update Product">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Dialog Component For Adding -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0 bg-light">
                <h5 class="modal-title fw-bold" id="addProductModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 pt-3">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <input type="text" name="p_title" id="p_title" class="form-control" placeholder="Enter product title" autocomplete="off" required>
                        <label for="p_title" class="form-label">Product title</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="text" name="p_description" id="p_description" class="form-control" placeholder="Enter product description" autocomplete="off" required>
                        <label for="p_description" class="form-label">Product description</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="text" name="p_keywords" id="p_keywords" class="form-control" placeholder="Enter product keywords" autocomplete="off" required>
                        <label for="p_keywords" class="form-label">Product keywords</label>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="category_id" class="form-label text-muted ms-1"><small>Category</small></label>
                            <select name="category_id" id="category_id" class="form-select border-0 bg-light py-2" required>
                                <option value="">Select a Category</option>
                                <?php
                                foreach($categories_array as $cat){
                                    echo "<option value='".$cat['category_id']."'>".$cat['category_title']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="brand_id" class="form-label text-muted ms-1"><small>Brand</small></label>
                            <select name="brand_id" id="brand_id" class="form-select border-0 bg-light py-2" required>
                                <option value="">Select a Brand</option>
                                <?php
                                foreach($brands_array as $brand){
                                    echo "<option value='".$brand['brand_id']."'>".$brand['brand_title']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="p_image1" class="form-label">Product Image 1 (Primary)</label>
                        <input type="file" name="p_image1" id="p_image1" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="p_image2" class="form-label">Product Image 2</label>
                        <input type="file" name="p_image2" id="p_image2" class="form-control">
                    </div>
                    
                    <div class="mb-3">
                        <label for="p_image3" class="form-label">Product Image 3</label>
                        <input type="file" name="p_image3" id="p_image3" class="form-control">
                    </div>
                    
                    <div class="form-floating mb-4">
                        <input type="number" name="p_price" id="p_price" class="form-control" placeholder="Enter product price" autocomplete="off" required>
                        <label for="p_price" class="form-label">Product price</label>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end border-top pt-4">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" name="insert_product" class="btn btn-primary px-4" value="Insert Product">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
