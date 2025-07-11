-- Active: 1751721798292@@127.0.0.1@3306@mysql
CREATE DATABASE IF NOT EXISTS b18_39446707_cuoiky_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE b18_39446707_cuoiky_db;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(500) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(500) NOT NULL UNIQUE,
    full_name VARCHAR(500),
    phone VARCHAR(15),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    role ENUM('user', 'admin') DEFAULT 'user'
);

-- Services table
CREATE TABLE IF NOT EXISTS services (   
    id INT AUTO_INCREMENT PRIMARY KEY,
    name_services VARCHAR(500) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bookings table
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    bookings_date DATETIME NOT NULL,
    phone VARCHAR(15) NOT NULL,
    address VARCHAR(500) NOT NULL,
    status VARCHAR(500) DEFAULT 'ĐANG CHỜ XỬ LÝ',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_price DECIMAL(10,2) NOT NULL,
    note TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Bookings_Services table (many-to-many relationship)
CREATE TABLE IF NOT EXISTS bookings_services (
    bookings_id INT,
    services_id INT,
    services_price DECIMAL(10, 2) NOT NULL,
    PRIMARY KEY (bookings_id, services_id),
    FOREIGN KEY (bookings_id) REFERENCES bookings(id) ON DELETE CASCADE,
    FOREIGN KEY (services_id) REFERENCES services(id)
);

-- Orders table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    bookings_id INT NOT NULL,
    status VARCHAR(500) DEFAULT 'ĐANG CHỜ XỬ LÝ',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_price DECIMAL(10,2) NOT NULL,
    note TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (bookings_id) REFERENCES bookings(id) ON DELETE CASCADE
);
CREATE TABLE IF NOT EXISTS rate (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    bookings_id INT NOT NULL,
    rate INT NOT NULL CHECK (rate >= 1 AND rate <= 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (bookings_id) REFERENCES bookings(id) ON DELETE CASCADE
);

INSERT INTO services (name_services, price) VALUES
('Rửa Xe Cơ Bản', 100000),
('Vệ Sinh Nội Thất', 200000),
('Vệ Sinh Khoang Động Cơ', 300000),
('Bảo Dưỡng Cao Cấp', 500000),
('Sửa chữa theo yêu cầu (Giá sẽ tùy thuộc vào phụ tùng hoặc yêu cầu của khách)', 0);

INSERT INTO users (username, password, email, full_name, phone, role) VALUES
('admin01', '$2y$10$T7hg8VSDCudFw7btJsP16e0mcpskpxB/LxTz6L/X6LNU/LvDCGYtS', 'admin01@gmail.com', 'Admin User', '0123456789', 'admin');
