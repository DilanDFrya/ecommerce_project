
CREATE DATABASE ecommerce_db;
USE ecommerce_db;

-- 1. Create the Categories Table
-- We create this first because 'products' will refer to it
CREATE TABLE categories (
    category_id INT(11) NOT NULL AUTO_INCREMENT,
    category_title VARCHAR(100) NOT NULL,
    PRIMARY KEY (category_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Create the Brands Table
-- We create this first because 'products' will refer to it
CREATE TABLE brands (
    brand_id INT(11) NOT NULL AUTO_INCREMENT,
    brand_title VARCHAR(100) NOT NULL,
    PRIMARY KEY (brand_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Create the Products Table
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
    p_price INT(11) NOT NULL, -- Changed to INT for easier math calculations later
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status VARCHAR(100) DEFAULT 'true',
    PRIMARY KEY (p_id),
    
    -- Defining the Foreign Keys (The Professional Way)
    CONSTRAINT fk_category FOREIGN KEY (category_id) 
        REFERENCES categories(category_id) 
        ON DELETE CASCADE ON UPDATE CASCADE,
    
    CONSTRAINT fk_brand FOREIGN KEY (brand_id) 
        REFERENCES brands(brand_id) 
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Insert Sample Data for Testing
-- This makes sure your website isn't empty when you first connect it
INSERT INTO categories (category_title) VALUES 
('Laptops'), ('Mobiles'), ('Accessories'), ('Cameras');

INSERT INTO brands (brand_title) VALUES 
('HP'), ('Apple'), ('Samsung'), ('Dell'), ('Sony');

-- Insert one sample product linked to Category 1 (Laptops) and Brand 1 (HP)
INSERT INTO products (p_title, p_description, p_keywords, category_id, brand_id, p_image1, p_image2, p_image3, p_price, status) 
VALUES 
('HP Pavilion Laptop', 'High performance laptop for students', 'hp, laptop, electronics', 1, 1, 'hp_laptop.jpg', 'hp_side.jpg', 'hp_back.jpg', 750, 'true');