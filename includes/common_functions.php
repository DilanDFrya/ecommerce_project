<?php
// Function to handle add to cart logic globally
function cart($con, $path_prefix) {
    if(isset($_GET['add_to_cart'])) {
        $product_id = $_GET['add_to_cart'];

        if(!isset($_SESSION['username'])) {
            $_SESSION['toast_status'] = 'warning';
            $_SESSION['toast_msg'] = 'Please log in to add items to your cart';
            header("Location: ".$path_prefix."user_area/user_login.php");
            exit();
        }

        $username = $_SESSION['username'];
        $select_query = "SELECT * FROM cart_details WHERE product_id = $product_id AND username = '$username'";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);

        if($num_of_rows > 0) {
            $_SESSION['toast_status'] = 'info';
            $_SESSION['toast_msg'] = 'Item is already in your cart';
            // Redirect back to the same page without the add_to_cart parameter
            $url_parts = parse_url($_SERVER['REQUEST_URI']);
            parse_str($url_parts['query'] ?? '', $query_params);
            unset($query_params['add_to_cart']);
            $redirect_url = $url_parts['path'] . (!empty($query_params) ? '?' . http_build_query($query_params) : '');
            header("Location: $redirect_url");
            exit();
        } else {
            $insert_query = "INSERT INTO cart_details (product_id, username, quantity) VALUES ($product_id, '$username', 1)";
            $result_query = mysqli_query($con, $insert_query);
            
            if($result_query) {
                $_SESSION['toast_status'] = 'success';
                $_SESSION['toast_msg'] = 'Item added to your cart';
            } else {
                $_SESSION['toast_status'] = 'error';
                $_SESSION['toast_msg'] = 'Error adding item to cart';
            }
            
            // Redirect back to the same page without the add_to_cart parameter
            $url_parts = parse_url($_SERVER['REQUEST_URI']);
            parse_str($url_parts['query'] ?? '', $query_params);
            unset($query_params['add_to_cart']);
            $redirect_url = $url_parts['path'] . (!empty($query_params) ? '?' . http_build_query($query_params) : '');
            header("Location: $redirect_url");
            exit();
        }
    }
}

// Function to get the number of items in the cart
function cart_item_count($con) {
    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $select_query = "SELECT * FROM cart_details WHERE username = '$username'";
        $result_query = mysqli_query($con, $select_query);
        return mysqli_num_rows($result_query);
    }
    return 0;
}

// Function to check if a product is in the cart
function is_product_in_cart($con, $product_id) {
    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $select_query = "SELECT * FROM cart_details WHERE product_id = $product_id AND username = '$username'";
        $result_query = mysqli_query($con, $select_query);
        return mysqli_num_rows($result_query) > 0;
    }
    return false;
}
?>
