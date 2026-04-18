-- Create the Database
CREATE DATABASE IF NOT EXISTS ecommerce_db;
USE ecommerce_db;

-- Create the Products Table
CREATE TABLE IF NOT EXISTS products (
    p_id INT(11) NOT NULL AUTO_INCREMENT,
    p_title VARCHAR(100) NOT NULL,
    p_description VARCHAR(255) NOT NULL,
    p_keywords VARCHAR(255) NOT NULL,
    category_id INT(11) NOT NULL,
    brand_id INT(11) NOT NULL,
    p_image1 VARCHAR(255) NOT NULL,
    p_image2 VARCHAR(255) NOT NULL,
    p_image3 VARCHAR(255) NOT NULL,
    p_price VARCHAR(100) NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status VARCHAR(100) NOT NULL,
    PRIMARY KEY (p_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

