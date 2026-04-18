<?php
// Handle insert brand logic
if(isset($_POST['insert_brand'])){
    $brand_title = $_POST['brand_title'];
    
    // Check if brand already exists
    $select_query = "SELECT * FROM `brands` WHERE brand_title='$brand_title'";
    $result_select = mysqli_query($con, $select_query);
    $number = mysqli_num_rows($result_select);
    if($number > 0){
        $toast_status = 'warning';
        $toast_msg = 'This brand already exists!';
    } else {
        $insert_query = "INSERT INTO `brands` (brand_title) VALUES ('$brand_title')";
        $result = mysqli_query($con, $insert_query);
        if($result){
            $toast_status = 'success';
            $toast_msg = 'Brand has been inserted successfully!';
        } else {
            $toast_status = 'error';
            $toast_msg = 'Failed to insert brand: ' . addslashes(mysqli_error($con));
        }
    }
}

// Handle update brand logic
if(isset($_POST['update_brand'])){
    $edit_id = $_POST['edit_id'];
    $brand_title = $_POST['brand_title'];
    
    $update_query = "UPDATE `brands` SET brand_title='$brand_title' WHERE brand_id=$edit_id";
    $result_update = mysqli_query($con, $update_query);
    
    if($result_update){
        $toast_status = 'success';
        $toast_msg = 'Brand updated successfully!';
    } else {
        $toast_status = 'error';
        $toast_msg = 'Failed to update brand.';
    }
}

// Handle delete brand logic
if(isset($_GET['delete_brand'])){
    $delete_id = $_GET['delete_brand'];
    
    $delete_query = "DELETE FROM `brands` WHERE brand_id=$delete_id";
    $result_delete = mysqli_query($con, $delete_query);
    
    if($result_delete){
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'Brand deleted successfully',
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    window.location.href = 'index.php?brands';
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to delete brand'
                }).then(function() {
                    window.location.href = 'index.php?brands';
                });
            });
        </script>";
    }
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Manage <span class="text-primary">Brands</span></h2>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addBrandModal">
        <i class="fa-solid fa-plus me-2"></i> Add New Brand
    </button>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3" style="width: 10%;">ID</th>
                        <th class="py-3" style="width: 50%;">Brand Title</th>
                        <th class="py-3 text-center" style="width: 20%;">Products Count</th>
                        <th class="px-4 py-3 text-end" style="width: 20%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $get_brands = "
                            SELECT b.brand_id, b.brand_title, COUNT(p.p_id) as product_count 
                            FROM brands b 
                            LEFT JOIN products p ON b.brand_id = p.brand_id 
                            GROUP BY b.brand_id, b.brand_title
                            ORDER BY b.brand_id ASC
                        ";
                        $result = mysqli_query($con, $get_brands);
                        $number = 0;
                        while($row = mysqli_fetch_assoc($result)){
                            $brand_id = $row['brand_id'];
                            $brand_title = htmlspecialchars($row['brand_title'], ENT_QUOTES);
                            $product_count = $row['product_count'];
                            $number++;
                            
                            ?>
                            <tr>
                                <td class='px-4 text-muted'>#<?php echo $number; ?></td>
                                <td class='fw-medium'><?php echo $brand_title; ?></td>
                                <td class='text-center'>
                                    <span class='badge bg-<?php echo ($product_count > 0) ? "primary" : "secondary"; ?> rounded-pill px-3 py-2'>
                                        <?php echo $product_count; ?> <?php echo ($product_count == 1) ? "Product" : "Products"; ?>
                                    </span>
                                </td>
                                <td class='px-4 text-end'>
                                    <a href='#' data-bs-toggle='modal' data-bs-target='#editBrandModal<?php echo $brand_id; ?>' class='btn btn-sm btn-outline-secondary me-1'><i class='fa-solid fa-pen-to-square'></i></a>
                                    <a href='index.php?brands&delete_brand=<?php echo $brand_id; ?>' class='btn btn-sm btn-outline-danger' onclick="event.preventDefault(); Swal.fire({title: 'Are you sure?', text: 'Deleting this brand will permanently delete all products inside it. You won\'t be able to revert this!', icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#3085d6', confirmButtonText: 'Yes, delete it!'}).then((result) => { if (result.isConfirmed) { window.location.href = this.href; } });"><i class='fa-solid fa-trash'></i></a>
                                </td>
                            </tr>

                            <!-- Edit Modal for Brand <?php echo $brand_id; ?> -->
                            <div class="modal fade" id="editBrandModal<?php echo $brand_id; ?>" tabindex="-1" aria-hidden="true" style="text-align: left;">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header border-bottom-0 bg-light">
                                            <h5 class="modal-title fw-bold">Edit Brand</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4 pt-3">
                                            <form action="" method="POST">
                                                <input type="hidden" name="edit_id" value="<?php echo $brand_id; ?>">
                                                <div class="form-floating mb-4">
                                                    <input type="text" name="brand_title" id="e_brand_title<?php echo $brand_id; ?>" class="form-control" value="<?php echo $brand_title; ?>" required autocomplete="off">
                                                    <label for="e_brand_title<?php echo $brand_id; ?>" class="form-label">Brand title</label>
                                                </div>
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-end border-top pt-4">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <input type="submit" name="update_brand" class="btn btn-primary px-4" value="Update Brand">
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
<div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0 bg-light">
                <h5 class="modal-title fw-bold" id="addBrandModalLabel">Add New Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 pt-3">
                <form action="" method="POST">
                    <div class="form-floating mb-4">
                        <input type="text" name="brand_title" id="brand_title" class="form-control" placeholder="Enter brand title" autocomplete="off" required>
                        <label for="brand_title" class="form-label">Brand title</label>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end border-top pt-4">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" name="insert_brand" class="btn btn-primary px-4" value="Insert Brand">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
