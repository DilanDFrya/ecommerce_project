<?php
include('config/db.php');
$query = "SHOW TABLES";
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)){
    echo $row[0] . "\n";
}
?>
