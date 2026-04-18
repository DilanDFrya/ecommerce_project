<?php
include('config/db.php');
$res = mysqli_query($con, 'SELECT * FROM products');
echo 'Rows: ' . mysqli_num_rows($res) . "\n";
while($row = mysqli_fetch_assoc($res)) {
    print_r($row);
}
if(mysqli_error($con)) echo "Error: " . mysqli_error($con);
?>
