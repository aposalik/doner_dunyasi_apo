-- Create the database
CREATE DATABASE IF NOT EXISTS RecipeOrdering;
USE RecipeOrdering;

-- Create Users Table
CREATE TABLE IF NOT EXISTS Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Create Food Table
CREATE TABLE IF NOT EXISTS Food (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    category VARCHAR(50) NOT NULL,
    image_url TEXT NOT NULL,
    rating DECIMAL(3,2) DEFAULT 0.00
);

-- Create Orders Table
CREATE TABLE IF NOT EXISTS Orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    food_id INT NOT NULL,
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50) DEFAULT 'Pending',
    address TEXT NOT NULL,
    card_last4 VARCHAR(4) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(id),
    FOREIGN KEY (food_id) REFERENCES Food(id)
);


-- Insert Sample Data into Food Table
INSERT INTO Food (name, price, category, image_url, rating) VALUES
('Burger King Special', 9.99, 'Burger', 'assets/images/burger.jpg', 4.5),
('Classic Pepperoni Pizza', 12.99, 'Pizza', 'assets/images/pizza.jpg', 4.8),
('Chocolate Lava Cake', 6.50, 'Cake', 'assets/images/cake.jpg', 4.9),
('Chicken Kebab', 8.99, 'Kebab', 'assets/images/kebab.jpg', 4.7),
('Steamed Rice', 3.99, 'Rice', 'assets/images/rice.jpg', 4.3);
