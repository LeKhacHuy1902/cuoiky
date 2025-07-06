-- Active: 1751721798292@@127.0.0.1@3306@mysql
CREATE DATABASE IF NOT EXISTS cuoiky CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE cuoiky;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(500) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(500) NOT NULL UNIQUE,
    full_name VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    role ENUM('user', 'admin') DEFAULT 'user'
);

-- Services table
CREATE TABLE IF NOT EXISTS services (   
    id INT AUTO_INCREMENT PRIMARY KEY,
    name_services VARCHAR(500) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bookings table
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    bookings_date DATETIME NOT NULL,
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




