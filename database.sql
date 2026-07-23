CREATE DATABASE IF NOT EXISTS sads_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sads_db;

-- جدول المستخدمين والمنظمات
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    organization VARCHAR(150) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- جدول طلبات الاحتياج الإغاثي
CREATE TABLE IF NOT EXISTS aid_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    state_name VARCHAR(100) NOT NULL,
    aid_type VARCHAR(100) NOT NULL,
    priority ENUM('high', 'medium', 'low') DEFAULT 'medium',
    families_count INT NOT NULL,
    contact_info VARCHAR(100) NOT NULL,
    details TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- جدول رسائل التواصل
CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    subject_type VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;