-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2016 at 11:44 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_alitaobao`
--

-- --------------------------------------------------------

--
-- Table structure for table `vt_cart`
--

CREATE TABLE `vt_cart` (
  `cid` bigint(11) NOT NULL COMMENT 'ID của customer add cart',
  `cartdata` text CHARACTER SET utf8
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vt_category`
--

CREATE TABLE `vt_category` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8 NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `create_date` varchar(255) CHARACTER SET utf8 NOT NULL,
  `order` int(11) NOT NULL COMMENT 'Thứ tự xắp sếp của category',
  `status` int(11) NOT NULL COMMENT 'Publish hay không',
  `icon_link` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vt_category`
--

INSERT INTO `vt_category` (`id`, `name`, `parent_id`, `create_date`, `order`, `status`, `icon_link`) VALUES
(1, 'Quần áo nữ', 0, '2016-11-17 10:10:10', 0, 1, 'static/images/09f076f883a8ad10b63f52b126870348.gif'),
(2, 'Quần áo nam', 0, '2016-11-17 10:10:10', 0, 1, 'static/images/4a962b8b3cbeacad5d70b4f0ae92c2ce.gif'),
(3, 'Giày dép nữ', 0, '2016-11-17 10:10:10', 0, 1, 'static/images/9430be0a3fff99aceaf6276fa71bd719.gif'),
(4, 'Giày dép nam', 0, '2016-11-17 10:10:10', 0, 1, 'static/images/def5104f32f86caa57484854e32a1bea.gif'),
(5, 'Túi xách, ví da', 0, '2016-11-17 10:10:10', 0, 1, 'static/images/6ea6e6a2d41f4799699effb18d59bd40.gif'),
(6, 'Phụ kiện - Trang sức', 0, '2016-11-17 10:10:10', 0, 1, 'static/images/41c3ed65dce090e4697b459ac23ccce4.gif'),
(7, 'Mẹ và bé', 0, '2016-11-17 10:10:10', 0, 1, 'static/images/28cc6069e88f2769ea269891b12969e7.gif'),
(8, 'Áo nữ', 1, '2016-11-17 10:10:10', 0, 1, ''),
(9, 'Quần nữ', 1, '2016-11-17 10:10:10', 0, 1, ''),
(10, 'Áo nam', 2, '2016-11-17 10:10:10', 0, 1, ''),
(11, 'Quần nam', 2, '2016-11-17 10:10:10', 0, 1, ''),
(12, 'Giày nữ', 3, '2016-11-17 10:10:10', 0, 1, ''),
(13, 'Giày cao gót', 3, '2016-11-17 10:10:10', 0, 1, ''),
(14, 'Áo sơ mi nữ', 8, '2016-11-17 10:10:10', 0, 1, ''),
(15, 'Áo len nữ', 8, '2016-11-17 10:10:10', 0, 1, ''),
(16, 'Áo thun nữ', 8, '2016-11-17 10:10:10', 0, 1, ''),
(17, 'Áo khoác nữ', 8, '2016-11-17 10:10:10', 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `vt_customer`
--

CREATE TABLE `vt_customer` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(255) CHARACTER SET latin1 NOT NULL,
  `address` text CHARACTER SET utf8,
  `uid` int(11) DEFAULT NULL COMMENT 'id của user tư vấn',
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vt_customer`
--

INSERT INTO `vt_customer` (`id`, `username`, `email`, `phone`, `address`, `uid`, `password`, `fullname`, `create_date`) VALUES
(1, 'wp_admin', 'toan@gmail.com', '0900000000', '156 cầu giấy', 123, 'e10adc3949ba59abbe56e057f20f883e', 'toan', '2016-11-17');

-- --------------------------------------------------------

--
-- Table structure for table `vt_order`
--

CREATE TABLE `vt_order` (
  `id` bigint(20) NOT NULL COMMENT 'ID đơn hàng',
  `invoiceid` varchar(255) CHARACTER SET latin1 NOT NULL,
  `cid` bigint(20) NOT NULL,
  `create_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `note` text CHARACTER SET utf8
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vt_order_item`
--

CREATE TABLE `vt_order_item` (
  `id` bigint(20) NOT NULL,
  `oid` bigint(20) NOT NULL COMMENT 'Order ID',
  `pid` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'ID ở bảng product',
  `item_image` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `item_quantity` int(20) DEFAULT NULL,
  `item_attrs` text CHARACTER SET utf8,
  `item_note` text CHARACTER SET utf8
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vt_product`
--

CREATE TABLE `vt_product` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` mediumtext COLLATE utf8_unicode_ci,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` mediumtext COLLATE utf8_unicode_ci,
  `cn_pid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vn_price` decimal(20,0) DEFAULT '0',
  `cn_price` decimal(20,0) DEFAULT NULL,
  `from` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_table` mediumtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vt_product`
--

INSERT INTO `vt_product` (`id`, `cat_id`, `sid`, `link`, `title`, `image`, `cn_pid`, `vn_price`, `cn_price`, `from`, `price_table`) VALUES
(1, 14, '1', 'http://adsfasdf.com/', 'Áo sơ mi đen', 'static/images/2b0189262b29b2b9fca736445163efc4.jpg', '123', '100000', '20000', 'china', NULL),
(2, 14, '3', 'http://adsfasdf.com/', ' kiểu nữ tay lỡ phối ren trắng mịn (Trắng)', 'static/images/0d056ae6b173ccd438bb93fccdb2786b.png', '123', '100000', '20000', 'china', NULL),
(3, 14, '1', 'http://adsfasdf.com/', ' kiểu nữ tay lỡ phối ren trắng mịn D213 (Trắng)', 'static/images/2c3f4e69a44ce3f0030f7e9a78b3ebe4.jpg', '123', '100000', '20000', 'china', NULL),
(4, 14, '1', 'http://adsfasdf.com/', ' kiểu nữ tay lỡ phối ren trắng mịn D213 (Trắng)', 'static/images/2eb969493925a3a3b35f8b08cdd7255a.220x220.jpg', '123', '100000', '20000', 'china', NULL),
(5, 14, '1', 'http://adsfasdf.com/', ' kiểu nữ tay lỡ phối ren trắng mịn D213 (Trắng)', 'static/images/3e5a0e4e76b6c0b03bb313de92de3131.220x220.jpg', '123', '100000', '20000', 'china', NULL),
(6, 14, '1', 'http://adsfasdf.com/', ' kiểu nữ tay lỡ phối ren trắng mịn D213 (Trắng)', 'static/images/04a235bbfde8a0a86db153c468ce3d2a.jpg', '123', '100000', '20000', 'china', NULL),
(7, 14, '1', 'http://adsfasdf.com/', ' kiểu nữ tay lỡ phối ren trắng mịn D213 (Trắng)', 'static/images/2b0189262b29b2b9fca736445163efc4.jpg', '123', '100000', '20000', 'china', NULL),
(8, 14, '1', 'http://adsfasdf.com/', ' kiểu nữ tay lỡ phối ren trắng mịn D213 (Trắng)', 'static/images/2b0189262b29b2b9fca736445163efc4.jpg', '123', '100000', '20000', 'china', NULL),
(9, 14, '1', 'http://adsfasdf.com/', ' kiểu nữ tay lỡ phối ren trắng mịn D213 (Trắng)', 'static/images/2b0189262b29b2b9fca736445163efc4.jpg', '123', '100000', '20000', 'china', NULL),
(10, 14, '1', 'http://adsfasdf.com/', ' kiểu nữ tay lỡ phối ren trắng mịn D213 (Trắng)', 'static/images/2b0189262b29b2b9fca736445163efc4.jpg', '123', '100000', '20000', 'china', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vt_setting`
--

CREATE TABLE `vt_setting` (
  `id` int(10) NOT NULL,
  `meta_key` varchar(255) CHARACTER SET utf8 NOT NULL,
  `meta_value` longtext CHARACTER SET utf8,
  `field_type` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `label` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vt_shop`
--

CREATE TABLE `vt_shop` (
  `id` bigint(20) NOT NULL,
  `cn_sid` text CHARACTER SET utf8 NOT NULL COMMENT 'Seller id bên site Trung Quốc',
  `name` text CHARACTER SET utf8 NOT NULL,
  `address` text CHARACTER SET utf8,
  `link` text CHARACTER SET utf8,
  `count_rate` decimal(10,0) DEFAULT NULL,
  `total_rate` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vt_shop`
--

INSERT INTO `vt_shop` (`id`, `cn_sid`, `name`, `address`, `link`, `count_rate`, `total_rate`) VALUES
(1, '101', 'a shop', '16 thiên hiền', 'http://adasfsa.com', '5', '23'),
(2, '102', 'b shop', '16 thiên hiền', 'http://adasfsa.com', '1', '5'),
(3, '103', 'c shop', '16 thiên hiền', 'http://adasfsa.com', '1', '4'),
(4, '104', 'd shop', '16 thiên hiền', 'http://adasfsa.com', '0', '0'),
(5, '105', 'e shop', '16 thiên hiền', 'http://adasfsa.com', '0', '0'),
(6, '106', 'r shop', '16 thiên hiền', 'http://adasfsa.com', '0', '0'),
(7, '107', 'f shop', '16 thiên hiền', 'http://adasfsa.com', '0', '0'),
(8, '108', 'g shop', '16 thiên hiền', 'http://adasfsa.com', '0', '0'),
(9, '109', 'h shop', '16 thiên hiền', 'http://adasfsa.com', '0', '0'),
(10, '110', 'i shop', '16 thiên hiền', 'http://adasfsa.com', '0', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vt_cart`
--
ALTER TABLE `vt_cart`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `vt_category`
--
ALTER TABLE `vt_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vt_customer`
--
ALTER TABLE `vt_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vt_order`
--
ALTER TABLE `vt_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vt_order_item`
--
ALTER TABLE `vt_order_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vt_product`
--
ALTER TABLE `vt_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vt_setting`
--
ALTER TABLE `vt_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vt_shop`
--
ALTER TABLE `vt_shop`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vt_category`
--
ALTER TABLE `vt_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `vt_customer`
--
ALTER TABLE `vt_customer`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vt_order`
--
ALTER TABLE `vt_order`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID đơn hàng';
--
-- AUTO_INCREMENT for table `vt_order_item`
--
ALTER TABLE `vt_order_item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vt_product`
--
ALTER TABLE `vt_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `vt_setting`
--
ALTER TABLE `vt_setting`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vt_shop`
--
ALTER TABLE `vt_shop`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
