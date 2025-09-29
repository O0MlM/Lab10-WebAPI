-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 29, 2025 at 06:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fastfashion`
--

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

CREATE TABLE `Product` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `CategoryName` varchar(50) NOT NULL,
  `Size` varchar(10) DEFAULT NULL,
  `Color` varchar(30) DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`ProductID`, `ProductName`, `CategoryName`, `Size`, `Color`, `Price`, `Stock`) VALUES
(1, 'Classic Cotton T-Shirt', 'Clothing', 'M', 'White', 299.00, 100),
(2, 'Slim Fit Jeans', 'Clothing', 'L', 'Blue', 1299.00, 85),
(3, 'Running Shoes', 'Footwear', '42', 'Black', 2499.00, 45),
(4, 'Leather Wallet', 'Accessories', NULL, 'Brown', 899.00, 120),
(5, 'Sports Watch', 'Accessories', NULL, 'Silver', 3500.00, 30),
(6, 'Polo Shirt', 'Clothing', 'XL', 'Navy Blue', 599.00, 95),
(7, 'Canvas Sneakers', 'Footwear', '40', 'White', 1899.00, 60),
(8, 'Denim Jacket', 'Clothing', 'L', 'Light Blue', 2299.00, 40),
(9, 'Backpack', 'Accessories', NULL, 'Black', 1599.00, 75),
(10, 'Baseball Cap', 'Accessories', NULL, 'Red', 399.00, 200),
(11, 'Casual Shorts', 'Clothing', 'M', 'Khaki', 699.00, 110),
(12, 'Formal Shirt', 'Clothing', 'L', 'White', 899.00, 80),
(13, 'Ankle Boots', 'Footwear', '41', 'Brown', 2799.00, 35),
(14, 'Sunglasses', 'Accessories', NULL, 'Black', 1299.00, 90),
(15, 'Hoodie', 'Clothing', 'XL', 'Gray', 1199.00, 65),
(16, 'Flip Flops', 'Footwear', '39', 'Blue', 299.00, 180),
(17, 'Belt', 'Accessories', NULL, 'Black', 499.00, 140),
(18, 'Track Pants', 'Clothing', 'M', 'Black', 799.00, 100),
(19, 'Dress Shoes', 'Footwear', '43', 'Black', 3299.00, 25),
(20, 'Scarf', 'Accessories', NULL, 'Burgundy', 599.00, 55),
(21, 'Chino Pants', 'Clothing', '32', 'Beige', 1299.00, 85),
(22, 'Leather Boots', 'Footwear', '42', 'Tan', 3999.00, 20),
(23, 'Crossbody Bag', 'Accessories', NULL, 'Olive Green', 1799.00, 45),
(24, 'Cardigan', 'Clothing', 'L', 'Charcoal', 1499.00, 50),
(25, 'Loafers', 'Footwear', '41', 'Burgundy', 2499.00, 40),
(26, 'Beanie', 'Accessories', NULL, 'Charcoal', 349.00, 160),
(27, 'Bomber Jacket', 'Clothing', 'M', 'Olive Green', 2799.00, 30),
(28, 'Espadrilles', 'Footwear', '40', 'Cream', 899.00, 70),
(29, 'Messenger Bag', 'Accessories', NULL, 'Dark Brown', 2199.00, 35),
(30, 'Henley Shirt', 'Clothing', 'L', 'Maroon', 699.00, 95),
(31, 'High-Top Sneakers', 'Footwear', '43', 'Black/White', 2299.00, 55),
(32, 'Leather Gloves', 'Accessories', NULL, 'Black', 799.00, 65),
(33, 'Puffer Vest', 'Clothing', 'XL', 'Navy', 1899.00, 42),
(34, 'Boat Shoes', 'Footwear', '42', 'Navy Blue', 1999.00, 48),
(35, 'Duffle Bag', 'Accessories', NULL, 'Gray', 2499.00, 28);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`ProductID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
