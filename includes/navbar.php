<?php $active_page = basename($_SERVER['PHP_SELF']); ?>
<nav class="navbar navbar-expand-lg glass-nav py-3">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="<?php echo $path_prefix; ?>index.php">
      <i class="fa-solid fa-shop me-2"></i> MODERN STORE
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-4">
        <li class="nav-item">
          <a class="nav-link <?php echo ($active_page == 'index.php') ? 'active' : ''; ?>" aria-current="page" href="<?php echo $path_prefix; ?>index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($active_page == 'products.php') ? 'active' : ''; ?>" href="<?php echo $path_prefix; ?>products.php">Shop</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php echo ($active_page == 'contact.php') ? 'active' : ''; ?>" href="<?php echo $path_prefix; ?>contact.php">Contact</a>
        </li>
      </ul>
      
      <div class="d-flex align-items-center">
        <form class="search-container me-3 d-none d-md-flex position-relative" action="<?php echo $path_prefix; ?>products.php" method="GET" id="searchForm">
          <i class="fa-solid fa-magnifying-glass text-muted"></i>
          <input type="text" name="search" id="searchInput" placeholder="Search products..." autocomplete="off">
          <i class="fa-solid fa-xmark text-muted ms-2" id="clearSearch" style="cursor: pointer; display: none;" title="Clear search"></i>
          <!-- Suggestions Dropdown -->
          <div id="searchSuggestions" class="position-absolute bg-white shadow rounded mt-1 w-100 start-0" style="top: 100%; z-index: 1050; display: none; max-height: 400px; overflow-y: auto; overflow-x: hidden; border: 1px solid #eee;"></div>
        </form>
        
        <a href="<?php echo $path_prefix; ?>user_area/profile.php" class="nav-link me-3 <?php echo ($active_page == 'profile.php') ? 'active' : ''; ?>" title="Profile"><i class="fa-solid fa-user"></i></a>
        <a href="<?php echo $path_prefix; ?>cart.php" class="btn btn-primary position-relative px-4">
          <i class="fa-solid fa-cart-shopping me-2"></i> Cart
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">0</span>
        </a>
      </div>
    </div>
  </div>
</nav>

<!-- Sub-Navbar / Greeting -->
<div class="bg-white border-bottom py-2">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <small class="text-muted">
        <i class="fa-solid fa-circle-user me-1"></i> 
        <?php
        if(!isset($_SESSION['username'])){
            echo "Hello, Guest! ";
            echo "<a href='".$path_prefix."user_area/user_login.php' class='text-primary fw-bold text-decoration-none ms-2'>Login / Sign Up</a>";
        } else {
            echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "! ";
            echo "<a href='".$path_prefix."user_area/logout.php' class='text-danger fw-bold text-decoration-none ms-2'>Logout</a>";
        }
        ?>
      </small>
    </div>
  </div>
</div>