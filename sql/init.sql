-- Create the database mybooks_db
CREATE DATABASE IF NOT EXISTS contacts;

-- Use the database mybooks_db
USE contacts;

-- Create the books table if it doesn't exist
CREATE TABLE IF NOT EXISTS contacts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  'name' VARCHAR(255) NULL,
  email VARCHAR(255) NULL,
  phone VARCHAR(255) NULL
);