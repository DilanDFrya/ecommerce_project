<?php
include('config/db.php');

if(isset($_GET['q'])) {
    $q = mysqli_real_escape_string($con, $_GET['q']);
    $query = "SELECT p_id, p_title, p_image1, p_price FROM products WHERE p_title LIKE '%$q%' OR p_description LIKE '%$q%' LIMIT 5";
    $result = mysqli_query($con, $query);
    
    $suggestions = [];
    if($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $suggestions[] = [
                'id' => $row['p_id'],
                'title' => $row['p_title'],
                'image' => $row['p_image1'],
                'price' => $row['p_price']
            ];
        }
    }
    
    echo json_encode($suggestions);
}
?>
