-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2020 at 06:09 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `linhnd12_volio_textonphoto`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(10) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `is_pro` int(1) NOT NULL,
  `priority` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decorate_categories`
--

CREATE TABLE `decorate_categories` (
  `decorate_category_id` int(10) NOT NULL,
  `decorate_category_name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `is_pro` int(1) NOT NULL,
  `priority` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `decorate_images`
--

CREATE TABLE `decorate_images` (
  `decorate_image_id` int(10) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `decorate_category_id` int(10) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `priority` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fonts`
--

CREATE TABLE `fonts` (
  `font_id` int(10) NOT NULL,
  `font_name` varchar(255) NOT NULL,
  `font_country` varchar(255) NOT NULL,
  `font_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(10) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `category_id` int(10) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `priority` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `splashes`
--

CREATE TABLE `splashes` (
  `splash_id` int(255) NOT NULL,
  `splash_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `textborder_categories`
--

CREATE TABLE `textborder_categories` (
  `textborder_category_id` int(255) NOT NULL,
  `textborder_category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `textborder_images`
--

CREATE TABLE `textborder_images` (
  `textborder_image_id` int(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `textborder_category_id` int(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `decorate_categories`
--
ALTER TABLE `decorate_categories`
  ADD PRIMARY KEY (`decorate_category_id`);

--
-- Indexes for table `decorate_images`
--
ALTER TABLE `decorate_images`
  ADD PRIMARY KEY (`decorate_image_id`);

--
-- Indexes for table `fonts`
--
ALTER TABLE `fonts`
  ADD PRIMARY KEY (`font_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `splashes`
--
ALTER TABLE `splashes`
  ADD PRIMARY KEY (`splash_id`);

--
-- Indexes for table `textborder_categories`
--
ALTER TABLE `textborder_categories`
  ADD PRIMARY KEY (`textborder_category_id`);

--
-- Indexes for table `textborder_images`
--
ALTER TABLE `textborder_images`
  ADD PRIMARY KEY (`textborder_image_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `decorate_categories`
--
ALTER TABLE `decorate_categories`
  MODIFY `decorate_category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `decorate_images`
--
ALTER TABLE `decorate_images`
  MODIFY `decorate_image_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `fonts`
--
ALTER TABLE `fonts`
  MODIFY `font_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `splashes`
--
ALTER TABLE `splashes`
  MODIFY `splash_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `textborder_categories`
--
ALTER TABLE `textborder_categories`
  MODIFY `textborder_category_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `textborder_images`
--
ALTER TABLE `textborder_images`
  MODIFY `textborder_image_id` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
