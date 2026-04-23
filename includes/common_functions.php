<?php
// Function to handle add to cart logic globally
function cart($con, $path_prefix) {
    if(isset($_GET['add_to_cart'])) {
        $product_id = $_GET['add_to_cart'];
        $is_ajax = (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest');

        if(!isset($_SESSION['username'])) {
            if($is_ajax) {
                echo json_encode(['status' => 'warning', 'msg' => 'Please log in to add items to your cart', 'redirect' => $path_prefix . 'user_area/user_login.php']);
                exit();
            }
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
            if($is_ajax) {
                echo json_encode(['status' => 'info', 'msg' => 'Item is already in your cart']);
                exit();
            }
            $_SESSION['toast_status'] = 'info';
            $_SESSION['toast_msg'] = 'Item is already in your cart';
            // Redirect back to the same page without the add_to_cart parameter
            $query_params = $_GET;
            unset($query_params['add_to_cart']);
            $redirect_url = $_SERVER['PHP_SELF'];
            if (!empty($query_params)) {
                $redirect_url .= '?' . http_build_query($query_params);
            }
            header("Location: $redirect_url");
            exit();
        } else {
            $insert_query = "INSERT INTO cart_details (product_id, username, quantity) VALUES ($product_id, '$username', 1)";
            $result_query = mysqli_query($con, $insert_query);
            
            if($is_ajax) {
                if($result_query) {
                    $count = cart_item_count($con); // Get updated count
                    echo json_encode(['status' => 'success', 'msg' => 'Item added to your cart', 'count' => $count]);
                } else {
                    echo json_encode(['status' => 'error', 'msg' => 'Error adding item to cart']);
                }
                exit();
            }

            if($result_query) {
                $_SESSION['toast_status'] = 'success';
                $_SESSION['toast_msg'] = 'Item added to your cart';
            } else {
                $_SESSION['toast_status'] = 'error';
                $_SESSION['toast_msg'] = 'Error adding item to cart';
            }
            
            // Redirect back to the same page without the add_to_cart parameter
            $query_params = $_GET;
            unset($query_params['add_to_cart']);
            $redirect_url = $_SERVER['PHP_SELF'];
            if (!empty($query_params)) {
                $redirect_url .= '?' . http_build_query($query_params);
            }
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
