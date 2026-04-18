<?php
if(isset($_GET['delete_product'])){
    $delete_id = $_GET['delete_product'];
    
    // First fetch the images to delete them from the server
    $get_product = "SELECT * FROM `products` WHERE p_id=$delete_id";
    $result_product = mysqli_query($con, $get_product);
    $row_product = mysqli_fetch_assoc($result_product);
    
    if ($row_product) {
        $p_image1 = $row_product['p_image1'];
        $p_image2 = $row_product['p_image2'];
        $p_image3 = $row_product['p_image3'];
        
        if($p_image1 != '' && file_exists("./product_images/$p_image1")){
            unlink("./product_images/$p_image1");
        }
        if($p_image2 != '' && file_exists("./product_images/$p_image2")){
            unlink("./product_images/$p_image2");
        }
        if($p_image3 != '' && file_exists("./product_images/$p_image3")){
            unlink("./product_images/$p_image3");
        }
        
        // Now delete the product from the database
        $delete_product = "DELETE FROM `products` WHERE p_id=$delete_id";
        $result_delete = mysqli_query($con, $delete_product);
        
        if($result_delete){
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Product deleted successfully',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(function() {
                        window.location.href = 'index.php?products';
                    });
                });
            </script>";
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to delete product',
                        showConfirmButton: true
                    }).then(function() {
                        window.location.href = 'index.php?products';
                    });
                });
            </script>";
        }
    }
}
?>
