-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2023 at 10:01 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopcart`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_address` text COLLATE utf8_unicode_ci NOT NULL,
  `order_phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` int(11) NOT NULL,
  `order_detail_amount` int(4) NOT NULL,
  `order_detail_price` decimal(10,2) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(11) NOT NULL,
  `p_code` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p_price` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `p_code`, `p_name`, `p_title`, `p_img`, `p_price`, `created_at`, `updated_at`) VALUES
(1, 'sclass1', 'sClass1 FullCourse PHP MySQLi Bootstrap4', 'สอนเขียนเว็บไซต์ด้วยตัวเองตั้งแต่ 0 - 100 ด้วยพื้นฐาน HTML CSS Bootstrap4 PHP MySQLi \n\n', 'https://appzstory.dev/_nuxt/img/sclass1.abd0c97.jpg', '5900.00', '2022-01-08 18:34:16', '2022-01-08 18:34:19'),
(2, 'sclass2', 'sClass2 Weblog Bootstrap5 + Vuejs SFC + PHP OOP\n', 'จำลองการเป็น Freelance รับงานทำระบบจริงๆ ทั้งงานเอกสาร \n\n', 'https://appzstory.dev/_nuxt/img/sclass2.b99e196.jpg', '6500.00', '2022-01-08 18:34:16', '2022-01-08 18:34:16'),
(3, 'sclass3', 'sClass3 Shopping Cart PHP MySQL Bootstrap5', 'สอนการทำเว็บไซต์ Shopping Cart ด้วยพื้นฐาน PHP PDO', 'https://appzstory.dev/_nuxt/img/login-admin.a0f2abf.jpg', '7500.00', '2022-01-08 18:34:16', '2022-01-08 18:34:16'),
(4, 'basiccourse1', 'PHP Ajax Basic REST API (BasicCourse1)', 'สอนเขียน REST API เชื่อมต่อฐานข้อมูลด้วย PHP PDO และขึ้นโครงสร้าง API ด้วย PHP OOP', 'https://appzstory.dev/_nuxt/img/basic1_main.a6874a9.jpg', '3900.00', '2022-01-08 13:10:30', '2022-01-08 13:10:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`),
  ADD UNIQUE KEY `product_code` (`p_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
