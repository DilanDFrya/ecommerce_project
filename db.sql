-- E-Commerce Database Schema
-- Created for Modern Store Project
-- Includes tables for Categories, Brands, Products, Users, Cart, and Orders

DROP DATABASE IF EXISTS ecommerce_db;
CREATE DATABASE ecommerce_db;
USE ecommerce_db;

CREATE TABLE categories (
    category_id INT(11) NOT NULL AUTO_INCREMENT,
    category_title VARCHAR(100) NOT NULL,
    PRIMARY KEY (category_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE brands (
    brand_id INT(11) NOT NULL AUTO_INCREMENT,
    brand_title VARCHAR(100) NOT NULL,
    PRIMARY KEY (brand_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE products (
    p_id INT(11) NOT NULL AUTO_INCREMENT,
    p_title VARCHAR(100) NOT NULL,
    p_description VARCHAR(255) NOT NULL,
    p_keywords VARCHAR(255) NOT NULL,
    category_id INT(11) NOT NULL,
    brand_id INT(11) NOT NULL,
    p_image1 VARCHAR(255) NOT NULL,
    p_image2 VARCHAR(255) NOT NULL,
    p_image3 VARCHAR(255) NOT NULL,
    p_price INT(11) NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status VARCHAR(100) DEFAULT 'true',
    PRIMARY KEY (p_id),
    CONSTRAINT fk_category FOREIGN KEY (category_id) 
        REFERENCES categories(category_id) 
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_brand FOREIGN KEY (brand_id) 
        REFERENCES brands(brand_id) 
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO categories (category_title) VALUES 
('Laptops'), ('Mobiles'), ('Accessories'), ('Cameras');

INSERT INTO brands (brand_title) VALUES 
('HP'), ('Apple'), ('Samsung'), ('Dell'), ('Sony');

INSERT INTO products (p_title, p_description, p_keywords, category_id, brand_id, p_image1, p_image2, p_image3, p_price, status) 
VALUES 
('HP Pavilion Laptop', 'High performance laptop for students', 'hp, laptop, electronics', 1, 1, 'hp_laptop.jpg', 'hp_side.jpg', 'hp_back.jpg', 750, 'true');

CREATE TABLE IF NOT EXISTS user_table (
    user_id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,
    user_email VARCHAR(100) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    user_address VARCHAR(255) NOT NULL,
    user_contact VARCHAR(20) NOT NULL,
    user_ip VARCHAR(100) NOT NULL,
    PRIMARY KEY (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cart_details (
  product_id INT(11) NOT NULL,
  username VARCHAR(100) NOT NULL,
  quantity INT(11) NOT NULL,
  PRIMARY KEY (product_id, username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS user_orders (
  order_id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) NOT NULL,
  amount_due INT(11) NOT NULL,
  invoice_number INT(11) NOT NULL,
  total_products INT(11) NOT NULL,
  order_date TIMESTAMP NOT NULL DEFAULT current_timestamp(),
  order_status VARCHAR(255) NOT NULL,
  PRIMARY KEY (order_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS order_items (
  item_id INT(11) NOT NULL AUTO_INCREMENT,
  order_id INT(11) NOT NULL,
  product_id INT(11) NOT NULL,
  quantity INT(11) NOT NULL,
  price INT(11) NOT NULL,
  PRIMARY KEY (item_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;