-- Simple User Authentication Database Schema

-- Create database
CREATE DATABASE IF NOT EXISTS user_auth;
USE user_auth;

-- Create basic users table
CREATE TABLE registration (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample data (optional)
-- INSERT INTO registration (full_name, username, email, password) 
-- VALUES ('John Doe', 'johndoe', 'john@example.com', '$2y$10$example_hashed_password');