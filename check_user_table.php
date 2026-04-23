<?php
include('config/db.php');
$query = "DESCRIBE user_table";
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_assoc($result)){
    print_r($row);
}
?>
