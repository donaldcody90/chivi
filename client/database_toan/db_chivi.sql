-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2016 at 05:59 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_chivi`
--

-- --------------------------------------------------------

--
-- Table structure for table `vt_carts`
--

CREATE TABLE `vt_carts` (
  `cid` bigint(11) NOT NULL COMMENT 'ID của customer add cart',
  `cartdata` text CHARACTER SET utf8
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vt_carts`
--

INSERT INTO `vt_carts` (`cid`, `cartdata`) VALUES
(1, 'a:2:{i:3;a:3:{s:3:"sid";s:1:"3";s:9:"shop_name";s:6:"c shop";s:5:"items";a:1:{i:2;a:7:{s:2:"id";s:1:"2";s:5:"title";s:56:" kiểu nữ tay lỡ phối ren trắng mịn (Trắng)";s:5:"image";s:50:"static/images/0d056ae6b173ccd438bb93fccdb2786b.png";s:4:"link";s:20:"http://adsfasdf.com/";s:5:"price";s:6:"100000";s:3:"qty";s:1:"4";s:3:"sid";s:1:"3";}}}i:1;a:3:{s:3:"sid";s:1:"1";s:9:"shop_name";s:6:"a shop";s:5:"items";a:2:{i:5;a:7:{s:2:"id";s:1:"5";s:5:"title";s:61:" kiểu nữ tay lỡ phối ren trắng mịn D213 (Trắng)";s:5:"image";s:58:"static/images/3e5a0e4e76b6c0b03bb313de92de3131.220x220.jpg";s:4:"link";s:20:"http://adsfasdf.com/";s:5:"price";s:6:"100000";s:3:"qty";s:1:"1";s:3:"sid";s:1:"1";}i:1;a:7:{s:2:"id";s:1:"1";s:5:"title";s:15:"Áo sơ mi đen";s:5:"image";s:50:"static/images/2b0189262b29b2b9fca736445163efc4.jpg";s:4:"link";s:20:"http://adsfasdf.com/";s:5:"price";s:6:"100000";s:3:"qty";i:3;s:3:"sid";s:1:"1";}}}}');

-- --------------------------------------------------------

--
-- Table structure for table `vt_categories`
--

CREATE TABLE `vt_categories` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8 NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `create_date` varchar(255) CHARACTER SET utf8 NOT NULL,
  `order` int(11) NOT NULL COMMENT 'Thứ tự xắp sếp của category',
  `status` int(11) NOT NULL COMMENT 'Publish hay không',
  `icon_link` varchar(255) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vt_categories`
--

INSERT INTO `vt_categories` (`id`, `name`, `parent_id`, `create_date`, `order`, `status`, `icon_link`, `slug`) VALUES
(1, 'Quần áo nữ', 0, '2016-11-17 10:10:10', 0, 1, 'static/images/09f076f883a8ad10b63f52b126870348.gif', 'quan-ao-nu'),
(2, 'Quần áo nam', 0, '2016-11-17 10:10:10', 0, 1, 'static/images/4a962b8b3cbeacad5d70b4f0ae92c2ce.gif', 'quan-ao-nam'),
(3, 'Giày dép nữ', 0, '2016-11-17 10:10:10', 0, 1, 'static/images/9430be0a3fff99aceaf6276fa71bd719.gif', 'giay-dep-nu'),
(4, 'Giày dép nam', 0, '2016-11-17 10:10:10', 0, 1, 'static/images/def5104f32f86caa57484854e32a1bea.gif', 'giay-dep-nam'),
(5, 'Túi xách, ví da', 0, '2016-11-17 10:10:10', 0, 1, 'static/images/6ea6e6a2d41f4799699effb18d59bd40.gif', 'tui-xach-vi-da'),
(6, 'Phụ kiện - Trang sức', 0, '2016-11-17 10:10:10', 0, 1, 'static/images/41c3ed65dce090e4697b459ac23ccce4.gif', 'phu-kien-trang-suc'),
(7, 'Mẹ và bé', 0, '2016-11-17 10:10:10', 0, 1, 'static/images/28cc6069e88f2769ea269891b12969e7.gif', 'me-va-be'),
(8, 'Áo nữ', 1, '2016-11-17 10:10:10', 0, 1, '', 'ao-nu'),
(9, 'Quần nữ', 1, '2016-11-17 10:10:10', 0, 1, '', 'quan-nu'),
(10, 'Áo nam', 2, '2016-11-17 10:10:10', 0, 1, '', 'ao-nam'),
(11, 'Quần nam', 2, '2016-11-17 10:10:10', 0, 1, '', 'quan-nam'),
(12, 'Giày nữ', 3, '2016-11-17 10:10:10', 0, 1, '', 'giay-nu'),
(13, 'Giày cao gót', 3, '2016-11-17 10:10:10', 0, 1, '', 'giay-cao-got'),
(14, 'Áo sơ mi nữ', 8, '2016-11-17 10:10:10', 0, 1, '', 'ao-so-mi-nu'),
(15, 'Áo len nữ', 8, '2016-11-17 10:10:10', 0, 1, '', 'ao-len-nu'),
(16, 'Áo thun nữ', 8, '2016-11-17 10:10:10', 0, 1, '', 'ao-thun-nu'),
(17, 'Áo khoác nữ', 8, '2016-11-17 10:10:10', 0, 1, '', 'ao-khoac-nu');

-- --------------------------------------------------------

--
-- Table structure for table `vt_customers`
--

CREATE TABLE `vt_customers` (
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
-- Dumping data for table `vt_customers`
--

INSERT INTO `vt_customers` (`id`, `username`, `email`, `phone`, `address`, `uid`, `password`, `fullname`, `create_date`) VALUES
(1, 'wp_admin', 'toan@gmail.com', '0900000000', '156 cầu giấy', 123, 'e10adc3949ba59abbe56e057f20f883e', 'toan', '2016-11-17');

-- --------------------------------------------------------

--
-- Table structure for table `vt_orders`
--

CREATE TABLE `vt_orders` (
  `id` bigint(20) NOT NULL COMMENT 'ID đơn hàng',
  `invoiceid` varchar(255) CHARACTER SET latin1 NOT NULL,
  `cid` bigint(20) NOT NULL,
  `create_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `note` text CHARACTER SET utf8
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vt_orders`
--

INSERT INTO `vt_orders` (`id`, `invoiceid`, `cid`, `create_date`, `status`, `note`) VALUES
(1, 'wp_admin-2016-11-22-1', 1, '2016-11-22 04:17:17', 1, ''),
(2, 'wp_admin-2016-11-23-1', 1, '2016-11-23 04:17:17', 1, ''),
(3, 'wp_admin-2016-11-24-1', 1, '2016-11-24 04:17:17', 1, ''),
(4, 'wp_admin-2016-11-25-1', 1, '2016-11-25 04:17:17', 1, ''),
(5, 'wp_admin-2016-11-26-1', 1, '2016-11-26 04:17:17', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `vt_order_items`
--

CREATE TABLE `vt_order_items` (
  `id` bigint(20) NOT NULL,
  `oid` bigint(20) NOT NULL COMMENT 'Order ID',
  `pid` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'ID ở bảng product',
  `item_image` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `item_quantity` int(20) DEFAULT NULL,
  `item_attrs` text CHARACTER SET utf8,
  `item_note` text CHARACTER SET utf8
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vt_order_items`
--

INSERT INTO `vt_order_items` (`id`, `oid`, `pid`, `item_image`, `item_quantity`, `item_attrs`, `item_note`) VALUES
(1, 1, '1', 'static/images/2b0189262b29b2b9fca736445163efc4.jpg', 5, '', ''),
(2, 2, '4', 'static/images/2eb969493925a3a3b35f8b08cdd7255a.220x220.jpg', 10, '', ''),
(3, 3, '5', 'static/images/2b0189262b29b2b9fca736445163efc4.jpg', 50, '', ''),
(4, 4, '6', 'static/images/2eb969493925a3a3b35f8b08cdd7255a.220x220.jpg', 100, '', ''),
(5, 5, '1', 'static/images/2b0189262b29b2b9fca736445163efc4.jpg', 15, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `vt_priceranges`
--

CREATE TABLE `vt_priceranges` (
  `id` bigint(18) NOT NULL,
  `pid` bigint(18) DEFAULT NULL,
  `quantity` bigint(18) DEFAULT NULL,
  `price` float(18,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vt_priceranges`
--

INSERT INTO `vt_priceranges` (`id`, `pid`, `quantity`, `price`) VALUES
(1, 1, 1, 100000),
(2, 1, 10, 800000),
(3, 1, 20, 700000),
(4, 2, 1, 135000);

-- --------------------------------------------------------

--
-- Table structure for table `vt_products`
--

CREATE TABLE `vt_products` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` mediumtext COLLATE utf8_unicode_ci,
  `title` text COLLATE utf8_unicode_ci,
  `cn_pid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vn_price` float(18,0) DEFAULT '0',
  `cn_price` float(18,0) DEFAULT NULL,
  `from` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity_min` int(11) DEFAULT '1',
  `price_min` float(18,0) DEFAULT NULL,
  `price_max` float(18,0) DEFAULT NULL,
  `weight` float(18,0) DEFAULT '0',
  `type` int(1) DEFAULT '2',
  `is_featured` int(1) DEFAULT '0',
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `sales` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vt_products`
--

INSERT INTO `vt_products` (`id`, `cat_id`, `sid`, `link`, `title`, `cn_pid`, `vn_price`, `cn_price`, `from`, `quantity_min`, `price_min`, `price_max`, `weight`, `type`, `is_featured`, `slug`, `views`, `sales`) VALUES
(1, 14, '1', 'http://adsfasdf.com/', 'Áo sơ mi đen', '123', 100000, 20000, 'china', 1, NULL, NULL, 0, 2, 0, 'ao-so-mi-den', 0, 20),
(2, 8, '3', 'http://adsfasdf.com/', ' kiểu nữ tay lỡ phối ren trắng mịn (Trắng) 1', '123', 800000, 20000, 'china', 1, NULL, NULL, 0, 2, 0, 'kieu-nu-tay-lo-phoi-ren-trang-min-trang-1', 0, 0),
(3, 8, '1', 'http://adsfasdf.com/', ' kiểu tay lỡ phối ren trắng mịn D213 (Trắng) 2', '123', 700000, 20000, 'china', 1, NULL, NULL, 0, NULL, 0, 'kieu-tay-lo-phoi-ren-trang-min-d213-trang-2', 200, 0),
(4, 8, '1', 'http://adsfasdf.com/', ' kiểu nữ tay lỡ phối ren trắng mịn D213 (Trắng) 3', '123', 400000, 20000, 'china', 1, NULL, NULL, 0, NULL, 0, 'kieu-nu-tay-lo-phoi-ren-trang-min-d213-trang-3', 0, 10),
(5, 1, '1', 'http://adsfasdf.com/', ' kiểu nữ phối ren trắng mịn D213 (Trắng) 4', '123', 600000, 20000, 'china', 1, NULL, NULL, 0, NULL, 0, 'kieu-nu-phoi-ren-trang-min-d213-trang-4', 0, 50),
(6, 14, '1', 'http://adsfasdf.com/', ' kiểu nữ tay lỡ phối ren trắng mịn ', '123', 500000, 20000, 'china', 1, NULL, NULL, 0, NULL, 0, 'kieu-nu-tay-lo-phoi-ren-trang-min', 101, 100),
(7, 14, '1', 'http://adsfasdf.com/', ' kiểu nữ tay lỡ phối ren', '123', 300000, 20000, 'china', 1, NULL, NULL, 0, NULL, 0, 'kieu-nu-tay-lo-phoi-ren', 20, 0),
(8, 8, '1', 'http://adsfasdf.com/', ' kiểu nữ tay lỡ phối ren trắng (Trắng)', '123', 200000, 20000, 'china', 1, NULL, NULL, 0, NULL, 0, 'kieu-nu-tay-lo-phoi-ren-trang-trang', 30, 0),
(9, 14, '1', 'http://adsfasdf.com/', ' kiểu nữ tay lỡ phối ren  D213 (Trắng)', '123', 900000, 20000, 'china', 1, NULL, NULL, 0, NULL, 0, 'kieu-nu-tay-lo-phoi-ren-d213-trang', 0, 0),
(10, 14, '1', 'http://adsfasdf.com/', ' kiểu nữ tay lỡ phối ren trắng ', '123', 100000, 20000, 'china', 1, NULL, NULL, 0, NULL, 0, 'kieu-nu-tay-lo-phoi-ren-trang', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vt_product_images`
--

CREATE TABLE `vt_product_images` (
  `id` bigint(18) NOT NULL,
  `pid` bigint(18) DEFAULT NULL,
  `image_src` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `is_default` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vt_product_images`
--

INSERT INTO `vt_product_images` (`id`, `pid`, `image_src`, `title`, `alt`, `is_default`) VALUES
(1, 4, 'static/images/2b0189262b29b2b9fca736445163efc4.jpg', 'ảnh 1', 'ảnh 1', 0),
(2, 4, 'static/images/0d056ae6b173ccd438bb93fccdb2786b.png', 'ảnh 1', 'ảnh 1', 1),
(3, 4, 'static/images/0d056ae6b173ccd438bb93fccdb2786b.png', 'ảnh 1', 'ảnh 1', 0),
(4, 4, 'static/images/0d056ae6b173ccd438bb93fccdb2786b.png', 'ảnh 1', 'ảnh 1', 0),
(5, 6, 'static/images/04a235bbfde8a0a86db153c468ce3d2a.jpg', 'ảnh 1', 'ảnh 1', 1),
(6, 6, 'static/images/0d056ae6b173ccd438bb93fccdb2786b.png', 'ảnh 1', 'ảnh 1', 0),
(7, 6, 'static/images/0d056ae6b173ccd438bb93fccdb2786b.png', 'ảnh 1', 'ảnh 1', 0),
(8, 6, 'static/images/0d056ae6b173ccd438bb93fccdb2786b.png', 'ảnh 1', 'ảnh 1', 0),
(9, 8, 'static/images/2b0189262b29b2b9fca736445163efc4.jpg', 'ảnh 1', 'ảnh 1', 1),
(10, 8, 'static/images/0d056ae6b173ccd438bb93fccdb2786b.png', 'ảnh 1', 'ảnh 1', 0),
(11, 8, 'static/images/0d056ae6b173ccd438bb93fccdb2786b.png', 'ảnh 1', 'ảnh 1', 0),
(12, 8, 'static/images/0d056ae6b173ccd438bb93fccdb2786b.png', 'ảnh 1', 'ảnh 1', 0),
(13, 1, 'static/images/2b0189262b29b2b9fca736445163efc4.jpg', 'ảnh 1', 'ảnh 1', 1),
(14, 2, 'static/images/0d056ae6b173ccd438bb93fccdb2786b.png', 'ảnh 1', 'ảnh 1', 1),
(15, 3, 'static/images/2c3f4e69a44ce3f0030f7e9a78b3ebe4.jpg', 'ảnh 1', 'ảnh 1', 1),
(16, 5, 'static/images/3e5a0e4e76b6c0b03bb313de92de3131.220x220.jpg', 'ảnh 1', 'ảnh 1', 1),
(17, 7, 'static/images/2b0189262b29b2b9fca736445163efc4.jpg', 'ảnh 1', 'ảnh 1', 1),
(18, 9, 'static/images/04a235bbfde8a0a86db153c468ce3d2a.jpg', 'ảnh 1', 'ảnh 1', 1),
(19, 10, 'static/images/2b0189262b29b2b9fca736445163efc4.jpg', 'ảnh 1', 'ảnh 1', 1),
(20, 4, 'static/images/0d056ae6b173ccd438bb93fccdb2786b.png', 'ảnh 1', 'ảnh 1', 0),
(21, 4, 'static/images/0d056ae6b173ccd438bb93fccdb2786b.png', 'ảnh 1', 'ảnh 1', 0),
(22, 4, 'static/images/0d056ae6b173ccd438bb93fccdb2786b.png', 'ảnh 1', 'ảnh 1', 0),
(23, 4, 'static/images/0d056ae6b173ccd438bb93fccdb2786b.png', 'ảnh 1', 'ảnh 1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vt_product_skus`
--

CREATE TABLE `vt_product_skus` (
  `id` bigint(18) NOT NULL,
  `pid` bigint(18) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` float(18,0) DEFAULT '0',
  `quantity` bigint(18) DEFAULT '0',
  `quantity_min` bigint(18) DEFAULT '0',
  `quantity_max` bigint(18) DEFAULT '0',
  `selected` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vt_product_skus`
--

INSERT INTO `vt_product_skus` (`id`, `pid`, `name`, `price`, `quantity`, `quantity_min`, `quantity_max`, `selected`) VALUES
(1, 1, 'Xanh>M', 0, 500, 0, 0, 0),
(2, 1, 'Đỏ>M', 0, 600, 0, 0, 0),
(3, 1, 'Vàng>L', 0, 700, 0, 0, 0),
(4, 2, 'Đen', 0, 100, 0, 0, 0),
(5, 2, 'Vàng', 0, 150, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vt_product_sku_properties`
--

CREATE TABLE `vt_product_sku_properties` (
  `product_sku_id` bigint(18) NOT NULL,
  `id` bigint(18) NOT NULL COMMENT 'property_id',
  `value_id` bigint(18) NOT NULL COMMENT 'property_value_id'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vt_product_sku_properties`
--

INSERT INTO `vt_product_sku_properties` (`product_sku_id`, `id`, `value_id`) VALUES
(1, 1, 1),
(1, 2, 4),
(2, 1, 2),
(2, 2, 4),
(3, 1, 3),
(3, 2, 5),
(4, 3, 8),
(5, 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `vt_properties`
--

CREATE TABLE `vt_properties` (
  `id` bigint(18) NOT NULL,
  `pid` bigint(18) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vt_properties`
--

INSERT INTO `vt_properties` (`id`, `pid`, `name`) VALUES
(1, 1, 'Màu sắc'),
(2, 1, 'Kích cỡ'),
(3, 2, 'Màu sắc');

-- --------------------------------------------------------

--
-- Table structure for table `vt_property_values`
--

CREATE TABLE `vt_property_values` (
  `property_value_id` bigint(18) NOT NULL,
  `id` bigint(18) NOT NULL COMMENT 'property_id',
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(4) DEFAULT '0',
  `type_value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vt_property_values`
--

INSERT INTO `vt_property_values` (`property_value_id`, `id`, `value`, `type`, `type_value`) VALUES
(1, 1, 'Xanh', 0, NULL),
(2, 1, 'Đỏ', 0, NULL),
(3, 1, 'Vàng', 0, NULL),
(4, 2, 'M', 0, NULL),
(5, 2, 'L', 0, NULL),
(6, 2, 'XL', 0, NULL),
(7, 2, 'XXL', 0, NULL),
(8, 3, 'Đen', 0, NULL),
(9, 3, 'Vàng', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vt_settings`
--

CREATE TABLE `vt_settings` (
  `id` int(10) NOT NULL,
  `meta_key` varchar(255) CHARACTER SET utf8 NOT NULL,
  `meta_value` longtext CHARACTER SET utf8,
  `field_type` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `label` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vt_shops`
--

CREATE TABLE `vt_shops` (
  `id` bigint(20) NOT NULL,
  `cn_sid` text CHARACTER SET utf8 NOT NULL COMMENT 'Seller id bên site Trung Quốc',
  `name` text CHARACTER SET utf8 NOT NULL,
  `address` text CHARACTER SET utf8,
  `link` text CHARACTER SET utf8,
  `count_rate` decimal(10,0) DEFAULT NULL,
  `total_rate` decimal(10,0) DEFAULT NULL,
  `slug` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vt_shops`
--

INSERT INTO `vt_shops` (`id`, `cn_sid`, `name`, `address`, `link`, `count_rate`, `total_rate`, `slug`) VALUES
(1, '101', 'a shop', '16 thiên hiền', 'http://adasfsa.com', '5', '23', 'a-shop'),
(2, '102', 'b shop', '16 thiên hiền', 'http://adasfsa.com', '1', '5', 'b-shop'),
(3, '103', 'c shop', '16 thiên hiền', 'http://adasfsa.com', '1', '4', 'c-shop'),
(4, '104', 'd shop', '16 thiên hiền', 'http://adasfsa.com', '0', '0', 'd-shop'),
(5, '105', 'e shop', '16 thiên hiền', 'http://adasfsa.com', '0', '0', 'e-shop'),
(6, '106', 'r shop', '16 thiên hiền', 'http://adasfsa.com', '0', '0', 'r-shop'),
(7, '107', 'f shop', '16 thiên hiền', 'http://adasfsa.com', '0', '0', 'f-shop'),
(8, '108', 'g shop', '16 thiên hiền', 'http://adasfsa.com', '0', '0', 'g-shop'),
(9, '109', 'h shop', '16 thiên hiền', 'http://adasfsa.com', '0', '0', 'h-shop'),
(10, '110', 'i shop', '16 thiên hiền', 'http://adasfsa.com', '0', '0', 'i-shop');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vt_carts`
--
ALTER TABLE `vt_carts`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `vt_categories`
--
ALTER TABLE `vt_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vt_customers`
--
ALTER TABLE `vt_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vt_orders`
--
ALTER TABLE `vt_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vt_order_items`
--
ALTER TABLE `vt_order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vt_priceranges`
--
ALTER TABLE `vt_priceranges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vt_products`
--
ALTER TABLE `vt_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vt_product_images`
--
ALTER TABLE `vt_product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vt_product_skus`
--
ALTER TABLE `vt_product_skus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vt_product_sku_properties`
--
ALTER TABLE `vt_product_sku_properties`
  ADD PRIMARY KEY (`product_sku_id`,`id`,`value_id`);

--
-- Indexes for table `vt_properties`
--
ALTER TABLE `vt_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vt_property_values`
--
ALTER TABLE `vt_property_values`
  ADD PRIMARY KEY (`property_value_id`);

--
-- Indexes for table `vt_settings`
--
ALTER TABLE `vt_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vt_shops`
--
ALTER TABLE `vt_shops`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vt_categories`
--
ALTER TABLE `vt_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `vt_customers`
--
ALTER TABLE `vt_customers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vt_orders`
--
ALTER TABLE `vt_orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID đơn hàng', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `vt_order_items`
--
ALTER TABLE `vt_order_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `vt_priceranges`
--
ALTER TABLE `vt_priceranges`
  MODIFY `id` bigint(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `vt_products`
--
ALTER TABLE `vt_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `vt_product_images`
--
ALTER TABLE `vt_product_images`
  MODIFY `id` bigint(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `vt_product_skus`
--
ALTER TABLE `vt_product_skus`
  MODIFY `id` bigint(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `vt_properties`
--
ALTER TABLE `vt_properties`
  MODIFY `id` bigint(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vt_property_values`
--
ALTER TABLE `vt_property_values`
  MODIFY `property_value_id` bigint(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `vt_settings`
--
ALTER TABLE `vt_settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vt_shops`
--
ALTER TABLE `vt_shops`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
