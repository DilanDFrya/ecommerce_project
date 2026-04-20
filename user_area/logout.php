<?php
session_start();
session_unset();
session_destroy();
session_start();
$_SESSION['toast_status'] = 'success';
$_SESSION['toast_msg'] = 'You have logged out successfully';
header("Location: ../index.php");
exit();
?>
