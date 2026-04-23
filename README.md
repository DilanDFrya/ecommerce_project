# Modern E-Commerce Platform

A fully functional, database-driven custom E-Commerce platform built from scratch. It features a premium public-facing storefront and a comprehensive, secure Admin Dashboard for managing inventory, categories, and brands.

## 🌟 Key Features

### 🛒 Public Storefront
- **Dynamic Landing Page (`index.php`)**: A high-converting hero section, interactive category highlights, and an automated "Latest Arrivals" product grid.
- **Product Shop (`products.php`)**: Features a sidebar for filtering by dynamic categories and brands, along with sorting functionality (Price, Newest).
- **Product Details (`product_details.php`)**: A dedicated page for deep-diving into a product, featuring an interactive multi-image gallery, full descriptions, and related products suggestions.
- **Dynamic Navigation**: Both the top Navbar and the sidebars pull their data directly from the MySQL database in real time.

### 🛡️ Admin Dashboard (`Admin_area/`)
- **Real-Time Analytics (`index.php`)**: A summary dashboard displaying total counts of Active Products, Categories, and Brands, alongside a recent activity table.
- **Full CRUD Management**: Create, Read, Update, and Delete capabilities for:
  - **Products**: Includes multi-image upload handling, custom UI dropdowns, and an instant "Quick View" modal.
  - **Categories & Brands**: Dedicated management pages with real-time product count linking.
- **Safe Deletions**: Deleting a product automatically unlinks and removes its physical image files from the server to save storage, using PHP's `unlink()`. 
- **Modern UI/UX**: Built with Bootstrap 5, FontAwesome, and SweetAlert2 for beautiful, non-intrusive confirmation dialogs.

## 💻 Tech Stack
- **Backend**: PHP 8+
- **Database**: MySQL (Relational schema with `ON DELETE CASCADE` foreign keys)
- **Frontend**: HTML5, Vanilla CSS3, JavaScript
- **Frameworks & Libraries**:
  - Bootstrap 5.3 (Layout, components, modals)
  - FontAwesome 6 (Icons)
  - SweetAlert2 (Interactive popups and alerts)

## 📁 Project Structure

```text
ecommerce_project/
│
├── config/
│   └── db.php                 # Core MySQLi database connection file
│
├── includes/                  # Reusable storefront components
│   ├── header.php             # HTML head, CSS, and CDNs
│   ├── footer.php             # Footer and JS scripts
│   ├── navbar.php             # Top navigation with dynamic dropdowns
│   └── sidebar.php            # Left sidebar for product filtering
│
├── admin_area/                # Secure Admin Panel
│   ├── index.php              # Admin Dashboard & routing hub
│   ├── products.php           # Product CRUD & View Modals
│   ├── categories.php         # Category CRUD
│   ├── brands.php             # Brand CRUD
│   ├── includes/              # Admin-specific components
│   └── product_images/        # Uploaded physical image files
│
├── index.php                  # The public landing page
├── products.php               # The main public shop / catalog
├── product_details.php        # Individual product view
└── MySQL.md                   # Complete database schema and documentation
```

## 🚀 Setup Instructions

1. **Environment Setup**: Ensure you have a local server environment like XAMPP, WAMP, or MAMP installed.
2. **Clone/Move Project**: Place the `ecommerce_project` folder inside your server's public directory (e.g., `C:\xampp\htdocs\`).
3. **Database Setup**:
   - Open phpMyAdmin (usually `http://localhost/phpmyadmin`).
   - Open the `MySQL.md` file located in the root of this project.
   - Copy the SQL commands and run them to create the `ecommerce_db` database, tables, and insert the sample seed data.
4. **Configuration**: If your local MySQL setup requires a specific password, update the connection variables in `config/db.php`.
5. **Launch**: Navigate to `http://localhost/ecommerce_project/` in your browser!