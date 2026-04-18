<?php
include('config/db.php');
$res = mysqli_query($con, 'SELECT p_id, p_image1 FROM products');
while($row = mysqli_fetch_assoc($res)) {
    $img = $row['p_image1'];
    if(strpos($img, ' ') !== false) {
        $new_img = str_replace(' ', '_', $img);
        if (file_exists("admin_area/product_images/$img")) {
            rename("admin_area/product_images/$img", "admin_area/product_images/$new_img");
        }
        mysqli_query($con, "UPDATE products SET p_image1='$new_img' WHERE p_id=" . $row['p_id']);
        echo "Fixed image for product " . $row['p_id'] . "\n";
    }
}
?>
