<?php
// Handle insert category logic
if(isset($_POST['insert_category'])){
    $category_title = $_POST['category_title'];
    
    // Check if category already exists
    $select_query = "SELECT * FROM `categories` WHERE category_title='$category_title'";
    $result_select = mysqli_query($con, $select_query);
    $number = mysqli_num_rows($result_select);
    if($number > 0){
        $toast_status = 'warning';
        $toast_msg = 'This category already exists!';
    } else {
        $insert_query = "INSERT INTO `categories` (category_title) VALUES ('$category_title')";
        $result = mysqli_query($con, $insert_query);
        if($result){
            $toast_status = 'success';
            $toast_msg = 'Category has been inserted successfully!';
        } else {
            $toast_status = 'error';
            $toast_msg = 'Failed to insert category: ' . addslashes(mysqli_error($con));
        }
    }
}

// Handle update category logic
if(isset($_POST['update_category'])){
    $edit_id = $_POST['edit_id'];
    $category_title = $_POST['category_title'];
    
    $update_query = "UPDATE `categories` SET category_title='$category_title' WHERE category_id=$edit_id";
    $result_update = mysqli_query($con, $update_query);
    
    if($result_update){
        $toast_status = 'success';
        $toast_msg = 'Category updated successfully!';
    } else {
        $toast_status = 'error';
        $toast_msg = 'Failed to update category.';
    }
}

// Handle delete category logic
if(isset($_GET['delete_category'])){
    $delete_id = $_GET['delete_category'];
    
    $delete_query = "DELETE FROM `categories` WHERE category_id=$delete_id";
    $result_delete = mysqli_query($con, $delete_query);
    
    if($result_delete){
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'Category deleted successfully',
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    window.location.href = 'index.php?categories';
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to delete category'
                }).then(function() {
                    window.location.href = 'index.php?categories';
                });
            });
        </script>";
    }
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Manage <span class="text-primary">Categories</span></h2>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
        <i class="fa-solid fa-plus me-2"></i> Add New Category
    </button>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3" style="width: 10%;">ID</th>
                        <th class="py-3" style="width: 50%;">Category Title</th>
                        <th class="py-3 text-center" style="width: 20%;">Products Count</th>
                        <th class="px-4 py-3 text-end" style="width: 20%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $get_categories = "
                            SELECT c.category_id, c.category_title, COUNT(p.p_id) as product_count 
                            FROM categories c 
                            LEFT JOIN products p ON c.category_id = p.category_id 
                            GROUP BY c.category_id, c.category_title
                            ORDER BY c.category_id ASC
                        ";
                        $result = mysqli_query($con, $get_categories);
                        $number = 0;
                        while($row = mysqli_fetch_assoc($result)){
                            $category_id = $row['category_id'];
                            $category_title = htmlspecialchars($row['category_title'], ENT_QUOTES);
                            $product_count = $row['product_count'];
                            $number++;
                            
                            ?>
                            <tr>
                                <td class='px-4 text-muted'>#<?php echo $number; ?></td>
                                <td class='fw-medium'><?php echo $category_title; ?></td>
                                <td class='text-center'>
                                    <span class='badge bg-<?php echo ($product_count > 0) ? "primary" : "secondary"; ?> rounded-pill px-3 py-2'>
                                        <?php echo $product_count; ?> <?php echo ($product_count == 1) ? "Product" : "Products"; ?>
                                    </span>
                                </td>
                                <td class='px-4 text-end'>
                                    <a href='#' data-bs-toggle='modal' data-bs-target='#editCategoryModal<?php echo $category_id; ?>' class='btn btn-sm btn-outline-secondary me-1'><i class='fa-solid fa-pen-to-square'></i></a>
                                    <a href='index.php?categories&delete_category=<?php echo $category_id; ?>' class='btn btn-sm btn-outline-danger' onclick="event.preventDefault(); Swal.fire({title: 'Are you sure?', text: 'Deleting this category will permanently delete all products inside it. You won\'t be able to revert this!', icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#3085d6', confirmButtonText: 'Yes, delete it!'}).then((result) => { if (result.isConfirmed) { window.location.href = this.href; } });"><i class='fa-solid fa-trash'></i></a>
                                </td>
                            </tr>

                            <!-- Edit Modal for Category <?php echo $category_id; ?> -->
                            <div class="modal fade" id="editCategoryModal<?php echo $category_id; ?>" tabindex="-1" aria-hidden="true" style="text-align: left;">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header border-bottom-0 bg-light">
                                            <h5 class="modal-title fw-bold">Edit Category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4 pt-3">
                                            <form action="" method="POST">
                                                <input type="hidden" name="edit_id" value="<?php echo $category_id; ?>">
                                                <div class="form-floating mb-4">
                                                    <input type="text" name="category_title" id="e_category_title<?php echo $category_id; ?>" class="form-control" value="<?php echo $category_title; ?>" required autocomplete="off">
                                                    <label for="e_category_title<?php echo $category_id; ?>" class="form-label">Category title</label>
                                                </div>
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-end border-top pt-4">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <input type="submit" name="update_category" class="btn btn-primary px-4" value="Update Category">
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
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0 bg-light">
                <h5 class="modal-title fw-bold" id="addCategoryModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 pt-3">
                <form action="" method="POST">
                    <div class="form-floating mb-4">
                        <input type="text" name="category_title" id="category_title" class="form-control" placeholder="Enter category title" autocomplete="off" required>
                        <label for="category_title" class="form-label">Category title</label>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end border-top pt-4">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" name="insert_category" class="btn btn-primary px-4" value="Insert Category">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
