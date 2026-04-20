<?php 
  if(session_status() === PHP_SESSION_NONE) {
      session_start();
  }
  // Dynamic path detection to handle subdirectories (like user_area/)
  $is_user_area = (basename(dirname($_SERVER['PHP_SELF'])) == 'user_area');
  $path_prefix = ($is_user_area) ? '../' : './';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern E-Commerce | Premium Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $path_prefix; ?>css/style.css">
</head>
<body>