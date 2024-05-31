CREATE DATABASE simple_store;

USE simple_store;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    image_url VARCHAR(255)
);
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    username VARCHAR(50),
    comment TEXT,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (username) REFERENCES users(username)
);
CREATE TABLE carts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
CREATE TABLE cart_items (
    cart_id INT,
    product_id INT,
    quantity INT,
    PRIMARY KEY (cart_id, product_id),
    FOREIGN KEY (cart_id) REFERENCES carts(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);
INSERT INTO products (name, description, price, stock, image_url) VALUES
('کتاب آموزش PHP', 'یک کتاب کامل برای یادگیری زبان برنامه‌نویسی PHP.', 25.99, 10, 'images/php_book.jpg'),
('کیبورد مکانیکی', 'یک کیبورد مکانیکی با نورپردازی RGB.', 89.99, 5, 'images/mechanical_keyboard.jpg'),
('هدفون بی‌سیم', 'هدفون بی‌سیم با کیفیت صدای عالی.', 59.99, 15, 'images/wireless_headphones.jpg'),
('موس گیمینگ', 'یک موس گیمینگ با دقت بالا.', 39.99, 8, 'images/gaming_mouse.jpg'),
('مانیتور 24 اینچ', 'مانیتور 24 اینچ با رزولوشن Full HD.', 129.99, 7, 'images/24inch_monitor.jpg');

