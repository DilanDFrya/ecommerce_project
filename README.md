# Modern E-Commerce Platform

A fully functional, database-driven custom E-Commerce platform built from scratch. It features a premium public-facing storefront, a smooth AJAX-powered shopping cart, and a comprehensive, secure Admin Dashboard.

## 🌟 Key Features

### 🛒 Customer Experience
- **AJAX Shopping Cart (`cart.php`)**: A seamless, "Single Page App" feel for adding items, updating quantities, and removing products without page reloads or scroll jumps.
- **Dynamic Product Shop (`products.php`)**: Filter by categories and brands in real-time.
- **Detailed Product View (`product_details.php`)**: Interactive image galleries and related product suggestions.
- **Secure Authentication**: Robust user registration and login system with session management.
- **Personal Dashboard (`profile.php`)**: Manage personal information and view a detailed **Order History** with invoice tracking.
- **Simplified Checkout (`checkout.php`)**: A streamlined flow that calculates subtotals, taxes, and generates unique order invoices.

### 🛡️ Admin Dashboard (`Admin_area/`)
- **Real-Time Analytics**: Dashboard displaying counts of Active Products, Categories, and Brands.
- **Full CRUD Management**: Create, Read, Update, and Delete products, categories, and brands.
- **Automated Media Cleanup**: Deleting a product automatically removes its physical image files from the server.

## 💻 Tech Stack
- **Backend**: PHP 8+
- **Database**: MySQL (Relational schema with foreign key constraints)
- **Frontend**: HTML5, Vanilla CSS3, JavaScript (Fetch API for AJAX)
- **Frameworks & Libraries**:
  - Bootstrap 5.3 (Responsive Layout)
  - FontAwesome 6 (Icons)
  - SweetAlert2 (Premium notifications and confirmation dialogs)

## 📁 Project Structure

```text
ecommerce_project/
│
├── config/
│   └── db.php                 # Core MySQLi database connection
│
├── includes/                  # Reusable storefront components
│   ├── header.php             # HTML head, sessions, and global logic
│   ├── navbar.php             # Top navigation with dynamic cart badge
│   ├── footer.php             # Global scripts and AJAX handlers
│   └── common_functions.php   # Global PHP business logic
│
├── user_area/                 # Customer-facing account management
│   ├── profile.php            # User Dashboard & Profile management
│   ├── my_orders.php          # Dynamic Order History view
│   ├── user_login.php         # Secure Login
│   └── user_registration.php  # User Onboarding
│
├── cart.php                   # Interactive, AJAX-powered Shopping Cart
├── checkout.php               # Secure Checkout & Order Placement
├── index.php                  # The public landing page
├── products.php               # The main public shop / catalog
└── db.sql                     # Complete database schema for easy import
```

## 🚀 Setup Instructions

1. **Environment Setup**: Ensure you have XAMPP or a similar PHP/MySQL environment.
2. **Move Project**: Place the `ecommerce_project` folder inside `htdocs/`.
3. **Database Import**:
   - Open phpMyAdmin.
   - Import the `db.sql` file located in the project root. This will automatically create the database, all tables, and insert sample data.
4. **Launch**: Navigate to `http://localhost/ecommerce_project/` in your browser!