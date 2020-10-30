-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2020 at 09:13 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zuma007`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT '',
  `password` varchar(255) DEFAULT '',
  `temp_password` varchar(50) DEFAULT '',
  `temp_expiry` time DEFAULT '00:00:00',
  `status` int(2) NOT NULL DEFAULT 0,
  `first_name` varchar(255) DEFAULT '',
  `last_name` varchar(255) DEFAULT '',
  `email` varchar(255) DEFAULT '',
  `mobile_no` varchar(255) DEFAULT '',
  `profile_image` varchar(255) DEFAULT '',
  `dob` date DEFAULT '0000-00-00',
  `gender` varchar(255) DEFAULT '',
  `address` varchar(255) DEFAULT '',
  `state` varchar(255) DEFAULT '',
  `city` varchar(255) DEFAULT '',
  `pincode` varchar(255) DEFAULT '',
  `point` double NOT NULL DEFAULT 0,
  `is_admin` enum('1','0') DEFAULT '0',
  `created_at` datetime DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `temp_password`, `temp_expiry`, `status`, `first_name`, `last_name`, `email`, `mobile_no`, `profile_image`, `dob`, `gender`, `address`, `state`, `city`, `pincode`, `point`, `is_admin`, `created_at`, `updated_at`) VALUES
(1, 'admin', '123123', '', '15:18:02', 1, 'Ashish', 'Mavani', 'zumacorporation@gmail.com', '+91 88665 38053', '765-default-avatar.png', '2019-04-16', 'Male', '317-Rukshmani soc, Nana Varachha', 'Gujarat', 'Surat', '395006', 2, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `att_id` int(11) NOT NULL,
  `att_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`att_id`, `att_name`) VALUES
(1, 'Size'),
(2, 'Finish'),
(3, 'Load Capacity'),
(4, 'Type'),
(5, 'Item');

-- --------------------------------------------------------

--
-- Table structure for table `brand_slider`
--

CREATE TABLE `brand_slider` (
  `brand_id` int(11) NOT NULL,
  `brand_img` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT '',
  `slug` varchar(255) DEFAULT '',
  `image` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `image`) VALUES
(1, 'Drawer Runner', 'drawer-runner', '1574742764_PXL_7662.jpg'),
(2, 'Locking Solution', 'locking-solution', '1574743084_852_60-PS_03.jpg'),
(3, 'Kitchen Storage Solution', 'kitchen-storage-solution', '1575951270_PXL_7684a.jpg'),
(4, 'Hydraulic Lifter and Table Mechanism', 'hydraulic-lifter-and-table-mechanism', '1575951364_DSC_7708.jpg'),
(5, 'Hinge Series', 'hinge-series', '1575951390_DSC_7869.jpg'),
(6, 'Sliding Fitting', 'sliding-fitting', '1575951423_DSC_7860.jpg'),
(7, 'Aluminum Profile', 'aluminum-profile', '1575951449_DSC_7876.jpg'),
(8, 'Door Control Device', 'door-control-device', '1575951483_DSC_7866.jpg'),
(9, 'Glass Fitting', 'glass-fitting', '1575951518_DSC_7864.jpg'),
(10, 'Handle Collection', 'handle-collection', '1575951657_cabinetHandles1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `mobile_no` varchar(50) DEFAULT '',
  `address` varchar(255) DEFAULT '',
  `message` varchar(255) DEFAULT '',
  `type` varchar(255) DEFAULT '',
  `status` enum('pending','completed') DEFAULT 'pending',
  `created_at` datetime DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `user_id`, `product_id`, `mobile_no`, `address`, `message`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 6, '9876543210', 'Surwat', '', 'dealer', 'pending', '2019-11-29 10:17:56', '2019-11-29 10:17:56'),
(2, 4, 21, '9173072108', '22-23, Street No.3, Chitrakut Society,\r\nNari, Bhavnagar', 'Gas leak thai gayo che', 'salesman', 'completed', '2019-12-13 12:53:43', '2020-07-03 19:18:24'),
(3, 4, 55, '9173072108', '22-23, Street No.3, Chitrakut Society,\r\nNari, Bhavnagar', 'Cylinder not working ', 'salesman', 'completed', '2019-12-19 14:42:10', '2020-07-03 19:18:13'),
(4, 4, 54, '9173072108', '22-23, Street No.3, Chitrakut Society,\r\nNari, Bhavnagar', '', 'salesman', 'completed', '2019-12-19 17:50:02', '2020-07-03 19:15:16');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT '',
  `email` varchar(255) DEFAULT '',
  `message` varchar(1000) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `distributor`
--

CREATE TABLE `distributor` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT '',
  `last_name` varchar(255) DEFAULT '',
  `mobile_no` varchar(255) DEFAULT '',
  `email` varchar(255) DEFAULT '',
  `password` varchar(255) DEFAULT '',
  `temp_password` varchar(255) DEFAULT '',
  `temp_expiry` time DEFAULT '00:00:00',
  `address` varchar(255) DEFAULT '',
  `image` varchar(255) DEFAULT '',
  `aadhar_no` varchar(255) DEFAULT '',
  `stamp` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `point` varchar(255) DEFAULT '0',
  `device_token` varchar(1000) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distributor`
--

INSERT INTO `distributor` (`id`, `first_name`, `last_name`, `mobile_no`, `email`, `password`, `temp_password`, `temp_expiry`, `address`, `image`, `aadhar_no`, `stamp`, `point`, `device_token`) VALUES
(1, 'Test', 'tesss', '8460888015', 'test@gmail.com', '123456', '', '00:00:00', 'Surat', '1574758674_caterer_grey.png', '741852637114', '2019-11-26 21:27:06', '0', ''),
(2, 'Bhavin', 'mavani', '8460888016', 'bhavinpmavani@gmail.com', 'b#@vin786koa', '', '00:00:00', 'Surat', 'default_profile.png', '581162408146', '2020-03-04 18:38:22', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` enum('dealer','carpenter','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`id`, `name`, `image`, `type`) VALUES
(1, 'Test', '1575002784_Lighthouse.jpg', 'dealer');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `order_status` enum('pending','confirmed','delivered','completed','cancel') NOT NULL DEFAULT 'pending',
  `delivered_by` varchar(255) DEFAULT '',
  `lr_number` varchar(255) DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `salesman_id`, `user_id`, `user_type`, `order_status`, `delivered_by`, `lr_number`, `date`, `created_at`) VALUES
(1, 'zuma000001', 0, 2, 'dealer', 'cancel', NULL, NULL, '0000-00-00', '2019-11-29 10:16:43'),
(2, 'zuma000002', 4, 2, 'dealer', 'cancel', NULL, NULL, '0000-00-00', '2019-12-13 12:52:51'),
(3, 'zuma000003', 4, 2, 'dealer', 'pending', '', '', '0000-00-00', '2019-12-14 09:43:05'),
(4, 'zuma000004', 4, 2, 'dealer', 'pending', '', '', '0000-00-00', '2019-12-14 10:04:00'),
(5, 'zuma000005', 4, 2, 'dealer', 'pending', '', '', '0000-00-00', '2019-12-19 14:40:11'),
(6, 'zuma000006', 4, 2, 'dealer', 'pending', '', '', '0000-00-00', '2019-12-19 17:49:24'),
(7, 'zuma000007', 0, 1, 'distributor', 'confirmed', NULL, NULL, '0000-00-00', '2019-12-25 05:52:22');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `product_att` varchar(255) NOT NULL,
  `att_val` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `total` int(255) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `qty`, `product_att`, `att_val`, `price`, `total`) VALUES
(1, 1, 2, 1, '1', '22 inch', 440, 440),
(2, 1, 2, 1, '1', '20 inch', 400, 400),
(3, 2, 11, 1, '1', '36 inch', 3024, 3024),
(4, 3, 24, 1, '1', '600mm', 23700, 23700),
(5, 3, 19, 1, '3', '10 kg', 625, 625),
(6, 3, 22, 10, '3', '4 kg', 1410, 14100),
(7, 4, 25, 10, '4', 'Normal', 7340, 73400),
(8, 4, 25, 20, '4', 'Soft Close', 9167, 183340),
(9, 5, 55, 50, '1', '45mm / Rose Gold Finish', 825, 41250),
(10, 5, 55, 1000, '1', '45mm / Black Finish', 785, 785000),
(11, 5, 55, 400, '1', '45mm / Antique Finish', 775, 310000),
(12, 5, 55, 100, '1', '45mm /  SS Finish', 760, 76000),
(13, 6, 55, 10, '1', '45mm / Rose Gold Finish', 825, 8250);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `code` varchar(100) DEFAULT '',
  `name` varchar(255) DEFAULT '',
  `slug` varchar(255) NOT NULL DEFAULT '',
  `category` int(11) NOT NULL,
  `subcategory` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `about_product` longtext DEFAULT NULL,
  `attribute` int(11) NOT NULL,
  `product_image` varchar(255) DEFAULT '',
  `installation_guide_images` varchar(255) NOT NULL,
  `installation_guide_videos` varchar(255) NOT NULL,
  `is_hot` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `slug`, `category`, `subcategory`, `description`, `about_product`, `attribute`, `product_image`, `installation_guide_images`, `installation_guide_videos`, `is_hot`) VALUES
(2, 'ZDR-0102', 'Zuma Gold Black Channel', 'zuma-gold-black-channel', 1, 1, 'We offered wide range of Telescopic Drawer channel. Gold Telescopic channel provided by us can be assured of High quality and Long Term Durability. Superior Performance, Perfect finish and Longer service Life.', '{\"Size Available\":\"10 inch to 22 inch\",\"Finish\":\"Electrophoresis Black Finish\",\"Material\":\"Cold Rolled Steel\",\"Width\":\"45mm\",\"Load Capacity\":\"40 Kg Load carrying capacity\",\"Application\":\"Kitchen Basket, Wooden Drawer, Office use\",\"Testing\":\"48 Hours salted spray tested\"}', 1, '1618939055_PXL_7644.jpg', '', '', 1),
(8, 'ZDR-0201', 'Zuma Premium Drawer Channel', 'zuma-premium-drawer-channel', 1, 1, 'We provide premium range in telescopic drawer channel which is mainly use in kitchen basket, pull out trolley, cabinet drawer, office use, etc. Surface finish is 48 hours salted spray tested which means high corrosion resistance.', '{\"Finish\":\"Electroplated Zinc\",\"Material\":\"Cold Rolled Steel\",\"Width\":\"45mm\",\"Load  Capacity\":\"45 Kg Load carrying capacity\",\"Size Available\":\"08 inch - 24 inch\"}', 1, '2040333707_PXL_7644.jpg', '', '', 0),
(9, 'ZDR-0302', 'Zuma Extra Premium Drawer Channel', 'zuma-extra-premium-drawer-channel', 1, 1, 'We provide extra premium range in telescopic drawer channel which is mainly use in heavy load carrying drawer,kitchen basket, pull out trolley, cabinet drawer, office use, etc. Surface finish is 48 hours salted spray tested which means high corrosion resistance.', '{\"Size Available\":\"10 inch - 24 inch\",\"Weight\":\"80 gram\\/inch\",\"Load Capacity\":\"55 Kg Load Carrying Capacity\",\"Material \":\"High Graded Cold Rolled Steel \",\"Width \":\"45mm\",\"Finish\":\"Electrophoresis Black Finish\"}', 1, '809762332_PXL_7646.jpg', '', '', 0),
(10, 'ZDR-0401', 'Zuma SS Drawer Channel', 'zuma-ss-drawer-channel', 1, 1, 'We provide premium range in telescopic drawer channel which is mainly use in kitchen basket, Specially for wet area, pull out trolley, cabinet drawer, office use, etc. Surface finish is 48 hours salted spray tested which means high corrosion resistance', '{\"Size Available\":\"20 inch, 22 inch\",\"Weight\":\"60 gram\\/inch\",\"Load Capacity\":\"45 Kg Load Carrying Capacity\",\"Material \":\"Stainless Steel\",\"Width \":\"45mm\",\"Finish\":\"Stainless Steel Finish\"}', 1, '351675961_PXL_7648a.jpg', '', '', 0),
(11, 'ZDR-0501', 'Zuma Heavy Duty Drawer Channel', 'zuma-heavy-duty-drawer-channel', 1, 1, 'We provide premium range in telescopic drawer channel which is mainly use in heavy load carrying drawer, specially for wide cabinet, big trolley, industrial use, office use, etc. Surface finish is 48 hours salted spray tested which means high corrosion resistance', '{\"Size Available\":\"14 inch - 40 inch\",\"Weight\":\"145 gram\\/inch\",\"Load Capacity\":\"Up to 100 kg\",\"Material\":\"High Graded Cold Rolled Steel\",\"Width\":\"53mm\",\"Finish\":\"Electroplated Zinc\"}', 1, '426944354_PXL_7658.jpg', '', '', 0),
(12, 'ZDR-0601', 'Zuma Soft Close Drawer Channel', 'zuma-soft-close-drawer-channel', 1, 1, 'We provide premium range in telescopic drawer channel which is mainly use in Soft closing cabinet, Silent movement drawer, Mainly for pull out trolley, cabinet drawer, office use, etc. Surface finish is 48 hours salted spray tested which means high corrosion resistance', '{\"Size Available\":\"12 inch - 22 inch\",\"Weight\":\"70 gram\\/inch\",\"Load Capacity\":\"45 kg Load Carrying Caacityp\",\"Material\":\"High Graded Cold Rolled Steel\",\"Width\":\"45mm\",\"Finish\":\"Electroplated Zinc\"}', 1, '1587585976_PXL_7659.jpg', '', '', 0),
(13, 'ZDR-0701', 'Zuma Push Open Drawer Channel', 'zuma-push-open-drawer-channel', 1, 1, 'We provide premium range in telescopic drawer channel which is mainly use in Push open cabinet, Handle-less cabinet Drawer, Mainly for pull out trolley, cabinet drawer, office use, etc. Surface finish is 48 hours salted spray tested which means high corrosion resistance', '{\"Size Available\":\"12 inch - 22 inch\",\"Weight\":\"70 gram\\/inch\",\"Load Capacity\":\"45 kg load carrying capacity\",\"Material\":\"High Graded Cold Rolled Steel\",\"Width\":\"45mm\",\"Finish\":\"Electroplated Zinc\"}', 1, '904615482_Drawerrunner6.jpg', '', '', 1),
(14, 'ZDR-0801', 'Zuma Quadro Channel', 'zuma-quadro-channel', 1, 3, 'We provide premium range in telescopic drawer channel which is mainly use in Wardrobe drawer, Specially for soft closing cabinet, Bottom mounted drawer, etc.', '{\"Size Available\":\"16 inch - 22 inch\",\"Load Capacity\":\"40 kg Load Carrying Capacity\",\"Material\":\"High Graded Cold Rolled Steel \",\"Finish\":\"Electroplated Zinc\",\"Type \":\"Soft Closing \",\"Contraction Gap\":\"37.5mm\"}', 1, '1963821785_Drawerrunner7.jpg', '', '', 0),
(15, 'ZTS-02', 'Zuma Slim Tandem System', 'zuma-slim-tandem-system', 3, 4, 'We provide premium range in telescopic drawer channel which is mainly use in Kitchen Basket, Office use, Soft closing cabinet, Pull out trolley, cabinet drawer, etc.', '{\"Load Capacity\":\"40 Kg Load Carrying Capacity\",\"Material \":\"High Grade Cold Rolled Steel\",\"Finish \":\"Dark Gray Finished Gallery, Zinc Plated Drawer Runner\",\"Construction Gap\":\"37.5mm\",\"Size Available\":\"14 inch to 22 inch\",\"Height \":\"84mm, 116mm, 167mm, 199mm\"}', 1, '1093203539_PXL_7667.jpg', '', '', 0),
(16, 'ZHL-GP09', 'Zuma Gas Pump - 9 Inch', 'zuma-gas-pump---9-inch', 4, 10, 'Specification: Flat Characteristic with small increase, Different forces for the same dimensions, Damped fixed speed, Oil incorporated for cushioning & seal lubrication different fixing end-connection.  \r\nApplication: For easy opening of all type of cabinet doors', '{\"Load Capacity\":\"05 kg - 25 kg\",\"Material\":\"Mild Steel, Nylon\",\"Finish \":\"Silver Finished Cylinder, Crome Fnished Piston Rod\"}', 3, '1800813258_DSC_7693.jpg', '', '', 0),
(17, 'ZTS-4P', 'Zuma PVC Cutlery Organizer', 'zuma-pvc-cutlery-organizer', 3, 5, '1. Used in modular kitchen cabinets and drawers\r\n2. Cutlery items and kitchen utensils can be stored easily\r\n3. Corrosion resistance, seamless good finish, good product', '{\"Width Available\":\"400mm - 1000mm\",\"Depth Available\":\"430mm - 520mm\",\"Finish\":\"Plastic Matt Grey\",\"Material\":\"PVC Sheet\"}', 1, '1115145711_PXL_7678.jpg', '', '', 0),
(18, 'ZTS-4A', 'Zuma Aluminum Cutlery Organizer', 'zuma-aluminum-cutlery-organizer', 3, 5, 'All size will be available as per your requirements..\r\n\r\nMade with aluminum which ensure high corrosion resistance, Long life, high durability.', '{\"Width Available\":\"14 inch to 30 inch\",\"Depth available\":\"480mm, 520mm\",\"Material\":\"Aluminum Railing, PVC corner\",\"Finish\":\"Aluminum silver\"}', 1, '196509202_PXL_7679.jpg', '', '', 0),
(19, 'ZHL-GP12', 'Zuma Gas Pump - 12 Inch', 'zuma-gas-pump---12-inch', 4, 10, 'Specification: Specially design for wooden fittings, Different forces for the same dimensions, High Durability, Long life, Oil incorporated for cushioning & seal lubrication different fixing end-connection. \r\nApplication: For easy opening of all type of cabinet doors.', '{\"Load Capacity\":\"05 kg - 50 kg\",\"Material\":\"Mild Steel\",\"Finish \":\"Black Finished Cylinder, Chrome Finished Piston Rod\"}', 3, '1231396423_DSC_7700.jpg', '', '', 0),
(20, 'ZHL-GP15', 'Zuma Gas Pump - 15 Inch', 'zuma-gas-pump---15-inch', 4, 10, 'Specification: Specially design for wooden fittings, Different forces for the same dimensions, High Durability, Long life, Oil incorporated for cushioning & seal lubrication different fixing end-connection. \r\nApplication: For easy opening of all type of cabinet doors.', '{\"Load Capacity\":\"15 kg - 50 kg\",\"Material\":\"Mild Steel\",\"Finish\":\"Black Finished Cylinder, Chrome Finished Piston Rod\"}', 3, '907245811_DSC_7702.jpg', '', '', 0),
(21, 'ZHL-GP18', 'Zuma Gas Pump - 18 Inch', 'zuma-gas-pump---18-inch', 4, 10, 'Specification: Specially design for wooden fittings, Different forces for the same dimensions, High Durability, Long life, Oil incorporated for cushioning & seal lubrication different fixing end-connection. \r\n\r\n\r\nApplication: For easy opening of all type of cabinet doors', '{\"Load Capacity\":\"50 kg - 150 kg\",\"Material\":\"Mild Steel\",\"Finish \":\"Black Finished Cylinder, Chrome Finished Piston Rod\"}', 3, '1674559001_DSC_7700.jpg', '', '', 0),
(22, 'ZHL-0504', 'Zuma Cabinet Lifter', 'zuma-cabinet-lifter', 4, 10, 'Specification : Soft Closing, Adjustable Pressure, Adjustable Lift Rod Support.\r\n\r\nApplication :  For easy opening of all type of cabinet doors.', '{\"Size Available\":\"900 x 400 mm\",\"Material\":\"Mild Steel, Nylon\",\"Finish\":\"Silver Finished Body, Chrome Finished Piston Rod\"}', 3, '1441016494_4HydraulicLifter.jpg', '', '', 1),
(23, 'ZHL-0765', 'Zuma Bi-Fold System', 'zuma-bi-fold-system', 4, 10, 'Specification : Soft Closing, Aluminum Rod Length 300mm.', '{\"Load Capacity\":\"7 - 9 kg\",\"Height \":\"650 mm\",\"Material\":\"Mild Steel, Nylon\",\"Finish \":\"Silver Finished Body, Chrome Finished Piston Rod\"}', 3, '442051519_bifold.jpg', '', '', 1),
(24, 'ZTS-7101', 'Zuma Elevator Glass Basket', 'zuma-elevator-glass-basket', 3, 8, 'Specially designed elevator basket for modern kitchen.', '{\"Cabinet width\":\"600mm\",\"Minimum Height\":\"550mm\",\"Depth\":\"320mm\",\"Railing Type\":\"Glass\",\"Material\":\"Cold rolled steel, Aluminum\",\"Closing Type\":\"Soft Close\"}', 1, '1831138786_ELEVATOR.jpg', '', '', 1),
(25, 'ZHL-080112', 'Zuma Wardrobe Cloth Lifter', 'zuma-wardrobe-cloth-lifter', 4, 11, 'ABC', '{\"Cabinet Width\":\"780-1260mm\",\"Height \":\"840mm\",\"Load Capacity\":\"12 kg\",\"Rod Diameter\":\"22mm\",\"Material\":\"Steel Arm & Pole, Plastic Cover\",\"Finish\":\"Chrome Finish Rod, Grey Plastic Cover\"}', 4, '1224215506_1-500x500.jpg', '', '', 0),
(26, 'ZHL-T1450S', 'Zuma Coffee Table ~ Expandable', 'zuma-coffee-table-~-expandable', 4, 13, 'Specification : Soft Close Mechanism, Expandable Table Top, Easy to install, Long Life.', '{\"Size Available\":\"450mm\",\"Material\":\"Mild Steel\",\"Finish\":\"Black Powder Coated Body\",\"Type \":\"Expandable\"}', 4, '228581833_coffeetableexpandable.jpg', '', '', 1),
(27, 'ZHL-T21220S', 'Zuma Coffee Table - Lift Up', 'zuma-coffee-table---lift-up', 4, 13, 'Specification : Soft Close Mechanism, Lifting Height 200mm, Easy to Install, Long Life.', '{\"Size Available\":\"12 inch\",\"Material\":\"Mild Steel\",\"Finish\":\"Black Powder Coated Body\"}', 4, '915904805_liftup.jpg', '', '1591068963_videoplayback.mp4', 1),
(28, 'ZHL-T3', 'Zuma Portable Dining Table', 'zuma-portable-dining-table', 4, 13, 'Specification : Best product for space utilization, Space saving mechanism, Long life, Maintenance free, Easy to install, All in one for pot table, Computer table, Dinning table.', '{\"Load Capacity\":\"60kg, 100kg\",\"Closing  Length\":\"450mm\",\"Expandable Length\":\"1800mm\",\"Material\":\"Aluminum or Mild Steel\",\"Finish\":\"Aluminum Silver \\/ Zinc Plated Finish\"}', 3, '1013442892_errai-console-table-white-room.jpg,198082182_mesa-consola-golia-ozzio-design.jpg', '2016538326_errai-console-table-white-room.jpg', '1583210182_table to dining.mp4', 1),
(29, 'ZHL-T401', 'Zuma Folding Dining Table', 'zuma-folding-dining-table', 4, 13, 'Specification : Wall mount type, Bearing roller system, Easy to install.', '{\"Material\":\"Mild Steel and Aluminum\",\"Finish\":\"Black Powder Coated\"}', 1, '1393494403_wall-table-500x500.jpg', '', '', 0),
(30, 'ZHL-B11', 'Zuma Folding Bracket', 'zuma-folding-bracket', 4, 13, 'Specification : Wall mount type, 3 Angle Adjustment.', '{\"Size Available\":\"12 inch - 20 inch\",\"Material\":\"Mild Steel\",\"Finish\":\"Ivory Finish\"}', 1, '1762128390_wall-mounted-table-for-small-spaces-wall-mounted-tables-wall-mounted-tables-argos(1).jpg', '', '', 0),
(31, 'ZHL-B20118', 'Zuma Micro-Oven Stand', 'zuma-micro-oven-stand', 4, 13, 'Specification : High Load Capacity, Easy to install, High durability.', '{\"Size Available\":\"300mm-450mm\",\"Material\":\"Mild Steel And Aliminum\",\"Finish \":\"Powder Coated Black\"}', 1, '320844715_MicroOven.jpg', '', '', 0),
(32, 'ZHS-AH03', 'Normal Auto Hinges', 'normal-auto-hinges', 5, 14, 'Specification : Wide opening angle for easy storage in cabinet, Concealed hinges for easy installation, Nickel plated for corrosion resistance.', '{\"Size Available\":\"0\\/8\\/16 Crank\",\"Opening Angle\":\"105\\u00b0\",\"Depth of Hinge Cup\":\"11.3mm\",\"Diameter of hinge cup\":\"35mm\",\"Door Dimension\":\"3mm - 7mm\",\"Door Thickness\":\"14mm - 23mm\",\"Hinge cup material\":\"Iron with nickel plating\",\"Hinge arm material\":\"Iron with nickel plating\",\"Hinge plate material\":\"Iron with nickel plating\"}', 1, '1691137454_DSC_7810.jpg', '', '', 0),
(33, 'ZHS-AH01', 'Soft Close Auto Hinges', 'soft-close-auto-hinges', 5, 14, 'Specification : Wide opening angle for easy storage in cabinet, Concealed hinges for easy installation, Nickel plated for corrosion resistance.', '{\"Size Available\":\"0\\/8\\/16 Crank\",\"Opening Angle\":\"105\\u00b0\",\"Depth of Hinge Cup\":\"11.3mm\",\"Diameter of Hinge Cup\":\"35mm\",\"Door Dimension\":\"3mm - 7mm\",\"Door Thickness\":\"14mm - 23mm\",\"Hinge Cup Material\":\"Iron With Nickel Plating\",\"Hinge Arm Material\":\"Iron With Nickel Plating\",\"Hinge Plate Material\":\"Iron With Nickel Plating\"}', 1, '1022852282_DSC_7808.jpg', '', '', 0),
(34, 'ZHS-AH02', 'Soft Close Adjustable Hinges', 'soft-close-adjustable-hinges', 5, 14, 'Specification : Wide opening angle for easy storage in cabinet, Concealed hinges for easy installation, Nickel plated for corrosion resistance.', '{\"Size Available\":\"0\\/8\\/6\\/16 Crank\",\"Opening Angle\":\"105\\u00b0\",\"Depth of Hinge Cup\":\"11.3mm\",\"Diameter of Hinge Cup\":\"35mm\",\"Door Dimension\":\"3mm - 7mm\",\"Door Thickness\":\"14mm - 23mm\",\"Hinge Cup Material\":\"Iron With Nickel Plating\",\"Hinge Arm Material\":\"Iron With Nickel Plating\",\"Hinge Plate Material\":\"Iron With Nickel Plating\"}', 1, '2010239506_DSC_7809.jpg', '1576471827_Hinge-series.jpg', '', 0),
(35, 'ZHS-AH0390', '90 Degree Auto Hinges', '90-degree-auto-hinges', 5, 14, 'Specification : Wide opening angle for easy storage in cabinet, Concealed hinges for easy installation, Nickel plated for corrosion resistance.', '{\"Size Available\":\"90 Crank\",\"Opening Angle\":\"90\",\"Depth of Hinge Cup\":\"11.3mm\",\"Diameter of Hinge Cup\":\"35mm\",\"Door Dimension\":\"3mm - 7mm\",\"Door Thickness\":\"14mm - 23mm\",\"Hinge Cup Material\":\"Iron With Nickel Plating\",\"Hinge Arm Material\":\"Iron With Nickel Plating\",\"Hinge Plate Material\":\"Iron With Nickel Plating\"}', 1, '574069636_DSC_7811.jpg', '', '', 0),
(36, 'ZHS-AH03135', '135 Degree Auto Hinges', '135-degree-auto-hinges', 5, 14, 'Specification: Normal Closing', '{\"Size Available\":\"135 Crank\",\"Opening Angle\":\"135\\u00b0\",\"Depth of Hinge Cup\":\"11.3mm\",\"Diameter Of Hinge Cup\":\"35mm\",\"Door Dimension\":\"3mm - 7mm\",\"Door Thickness\":\"14mm - 23mm\",\"Hinge Cup Material\":\"Iron With Nickel Plating\",\"Hinge Arm Material\":\"Iron With Nickel Plating\",\"Hinge Plate Material\":\"Iron With Nickel Plating\"}', 1, '755471092_DSC_7812.jpg', '', '', 0),
(37, 'ZHS-AH03165', '165 Degree Auto Hinges', '165-degree-auto-hinges', 5, 14, 'Application : Kitchen Cabinet Door.', '{\"Size Available\":\"165 Crank\",\"Opening Angle\":\"165\\u00b0\",\"Depth of Hinge Cup\":\"11.3mm\",\"Diameter of Hinges Cup\":\"35mm\",\"Door Dimension \":\"3mm - 7mm\",\"Door Thickness\":\"14mm - 23mm\",\"Hinge Cup Material \":\"Iron With Nickel Plating\",\"Hinge Arm Material \":\"Iron With Nickel Plating\",\"Hinge Plate Material \":\"Iron With Nickel Plating\"}', 1, '1060900106_DSC_7814.jpg', '', '', 0),
(38, 'ZHS-AH04', 'SS Soft Close Auto Hinges', 'ss-soft-close-auto-hinges', 5, 14, 'Specification : Installation simple and easy to use Cabinet Hinges.', '{\"Size Available\":\"0\\/8\\/16 Crank\",\"Opening Angle\":\"105\\u00b0\",\"Depth of Hinge Cup\":\"11.3mm\",\"Diameter of Hinge Cup \":\"35mm\",\"Door Dimension\":\"3mm - 7mm\",\"Door Thickness\":\"14mm - 23mm\",\"Hinge Cup Material\":\"Stainless Steel\",\"Hinge Arm Material\":\"Stainless Steel\",\"Hinge Plate Material\":\"Stainless Steel\"}', 1, '1395572254_DSC_7815.jpg', '', '', 0),
(39, 'ZHS-AH05', '3D Soft Close Auto Hinges', '3d-soft-close-auto-hinges', 5, 14, 'This quality is specially design for 3 Dimensional adjustment.', '{\"Size Available\":\"16 Crank\",\"Opening angle\":\"105\\u00b0\",\"Depth of hinge cup\":\"11.3mm\",\"Diameter of hinge cup\":\"35mm\",\"Door (K) dimension\":\"3mm-7mm\",\"Door thickness\":\"14mm-23mm\",\"Hinge cup material\":\"Iron with nickel plating\",\"Hinge arm material\":\"Iron with nickel plating\",\"Hinge plate material\":\"Iron with nickel plating\"}', 1, '1932323619_DSC_7819.jpg', '', '', 0),
(40, 'ZHS-AH25', '25mm Thick Door Soft Close Auto Hinges', '25mm-thick-door-soft-close-auto-hinges', 5, 14, 'Specification : Installation simple and easy to use Cabinet Hinges.', '{\"Size Available\":\"0\\/8 Crack\",\"Opening Angle\":\"105\\u00b0\",\"Depth of Hinge Cup\":\"12.5mm\",\"Diameter of Hinge Cup\":\"40mm\",\"Door Dimension\":\"3mm - 7mm\",\"Door Thickness\":\"16mm - 30mm\",\"Hinge Cup Material\":\"Iron with nickel plating\",\"Hinge Arm Material\":\"Iron with nickel plating\",\"Hinge Plate Material\":\"Iron with nickel plating\"}', 1, '841362167_DSC_7818.jpg', '', '', 0),
(41, 'ZLS-LB11', 'Zume Premium Lockbody - 85mm', 'zume-premium-lockbody---85mm', 2, 15, 'Specification : 2 turn feature 3 dead bolt to ensure safety, 3mm thick forend plate, 1.5mm striking plate, Reversible latch to operate left or right side, can be fitted in door thick more than 30mm, long life standard finish.\r\n\r\n\r\nFinish : Black Powder Coated Finish', '{\"Size Available\":\"4585, 6085\",\"Finish Available \":\"SS, Antique, Black, Rose Gold\",\"Material\":\"Brass Dead Bolt & Follower, SS Forend and Striking Plate, Powder Coated Mild Steel Body.\"}', 1, '1167066392_DSC_7715.jpg', '', '', 1),
(42, 'ZLS-LB1145', 'Zuma Premium Lockbody - 45mm', 'zuma-premium-lockbody---45mm', 2, 15, 'Specification : 2 turn feature dead bolt to ensure safety, 3mm thick forend plate, 1.5mm striking plate.', '{\"Size Available\":\"4545\",\"Finish Available \":\"SS, Antique, Black, Rose Gold\",\"Material\":\"Brass Dead Bolt & Follower, SS Forend and Striking Plate, Powder Coated Mild Steel Body.\"}', 2, '54124471_premium2.jpg', '', '', 0),
(43, 'ZLS-LB12', 'Zuma Premium Baby Latch', 'zuma-premium-baby-latch-', 2, 15, 'Specification : 3mm thick forend plate, 1.5mm striking plate, Reversible latch to operate left or right side.', '{\"Size Available\":\"45mm, 60mm\",\"Finish Available\":\"SS, Antique, Black, Rose Gold\",\"Material \":\"Brass Follower, SS Forend and Striking Plate.\"}', 2, '916140988_DSC_7718.jpg', '', '', 0),
(44, 'ZLS-LB1345S', 'Zuma Premium Deadlock', 'zuma-premium-deadlock', 2, 15, 'Specification : 2 turn feature dead bolt to ensure safety, 3mm thick forend plate, 1.5mm striking plate, Closed body construction, Can be fitted in door which is thick more than 30mm.\r\n\r\nFinish : Black Powder Coated Finish.', '{\"Size Available\":\"45mm\",\"Finish Available\":\"SS Finish\",\"Material\":\"Brass Dead Bolt, SS Forend and Striking Plate, Powder Coated Mild Steel Body\"}', 1, '281672297_premium5.jpg', '', '', 0),
(45, 'ZLS-LB1104', 'Zuma Dead Lock 4 Pin', 'zuma-dead-lock-4-pin-', 2, 15, 'Specification : 3mm thick forend plate, 2.5mm striking plate, Closed body construction, Anti theft revolving 4 round bullet, Can be fitted in door which is thick more than 25mm. 5 Star Key.\r\n\r\nFinish : Black Powder Coated Finish.', '{\"Type \":\"5 Star Key\",\"Material\":\"SS Forend and Striking Plate, Powder Coated Mild Steel Body\"}', 4, '1071802911_DSC_7722.jpg', '', '', 0),
(46, 'ZLS-LB21', 'Zuma Delux Lock Body', 'zuma-delux-lock-body', 2, 15, 'Specification : 2 turn feature 3 brass dead bolt to ensure safety, 3mm thick forend plate, 1.5mm striking plate, Reversible round latch to operate left or right side, Smooth movement.', '{\"Size Available\":\"4585, 6085\",\"Finish \":\"Ivory Gray Powder Coated Finish\",\"Material\":\"Brass Dead Bolt, Latch & Follower, SS Forend and Striking Plate, Powder Coated Mild Steel Body\"}', 1, '1309899724_DSC_7716.jpg', '', '', 0),
(47, 'ZLS-LB2255S', 'Zuma Baby Latch', 'zuma-baby-latch', 2, 15, 'Specification : 3mm Thick Forend Plate, 1.5mm Striking Plate, Can be fitted in door which is thick more than 30mm, Closed body construction, Rust proof and Long Life.', '{\"Size Available\":\"55mm\",\"Finish \":\"Ivory Gray Powder Coated Finish\",\"Material\":\"SS-304 Latch & Follower, SS Forend and Striking Plate, Powder Coated Mild Steel Body.\"}', 1, '1584918607_DSC_7724.jpg', '', '', 0),
(48, 'ZLS-LB2355S', 'Zuma Delux Dead Lock', 'zuma-delux-dead-lock', 2, 15, 'Specification : 2 turn features big brass dead bolt to ensure safety, 3mm Thick Forend Plate, 1.5mm Striking Plate, Can be fitted in door which is thick more than 30mm, Closed body construction, Can be fitted in door which is thick more than 30mm.', '{\"Size Available\":\"55mm\",\"Finish\":\"Ivory Gray Powder Coated Finish\",\"Material\":\"Brass Dead Bolt, SS Forend and Striking Plate, Powder Coated Mild Steel Body\"}', 1, '1724133234_DSC_7726.jpg', '', '', 0),
(49, 'ZLS-LB41', 'Zuma Delux Roller Lock Body', 'zuma-delux-roller-lock-body', 2, 15, 'Specification :  3mm Thick Forend Plate, 2.5mm Striking Plate, 3 Brass Dead Bolt, Can be fitted in door which is thick more than 25mm, Closed body construction', '{\"Size Available\":\"4585, 6085\",\"Finish\":\"Ivory Gray Powder Coated Finish\",\"Material\":\"Brass Dead Bolt & Follower, SS Forend and Striking Plate, Powder Coated Mild Steel Body\"}', 1, '556396428_DSC_7725.jpg', '', '', 0),
(50, 'ZLS-LB31', 'Zuma Extra Security Lock Body', 'zuma-extra-security-lock-body', 2, 15, 'Specification : Ball bearing follower for smooth operation, Specially designd latch for silent closing, 2 turn feature Heavy brass dead bolt to ensure safety, 3mm thick forend plate, 1.5mm striking plate, Reversible round latch to operate left or right side.', '{\"Size Available\":\"4585, 6085\",\"Finish\":\"SS Finish\",\"Material\":\"Single Brass Dead Bolt, Nylon Strip on Latch, SS-316 Mortice Body\"}', 1, '2041081469_DSC_7727.jpg', '', '', 0),
(51, 'ZLS-PC11', 'Zuma Premium 5 Key Cylinder', 'zuma-premium-5-key-cylinder-', 2, 16, 'Specification : Brass Computerized 5 Key ensure high Security, 7 Pin mechanism to obtain wide key combination, Long Life, Maintenance Free, Can be fitted in any Euro Standard Mortice Body.', '{\"Size Available\":\"60mm, 70mm, 80 mm \",\"Finish\":\"SS Finish\",\"Material\":\"Brass Key & Core, Zinc Alloy Body & Knob\"}', 1, '1388451091_DSC_7729.jpg', '', '', 0),
(52, 'ZLS-PC21', 'Zuma Delux 5 Key Cylinder', 'zuma-delux-5-key-cylinder-', 2, 16, 'Specification : Brass Computerized 5 Key ensure high Security, 7 Pin mechanism which have 7 lateral pins, Long Life, Maintenance Free, Common /  Master Key for different size is available', '{\"Size Available\":\"60mm, 70mm, 80mm, 90mm, 100mm, 120mm\",\"Finish Available\":\"SS, CP, Antique, Black, Rose Gold\",\"Material\":\"Fully Brass Body, Core & Knob, Brass 5 Key\"}', 1, '1062122159_DSC_7730.jpg', '', '', 0),
(53, 'ZLS-PC22', 'Zuma Delux Keyless cylinder', 'zuma-delux-keyless-cylinder', 2, 16, 'Application : Specially Design for Bathroom Uses.', '{\"Size Available\":\"60mm, 70mm, 80mm\",\"Finish Available\":\"SS, CP, Antique, Black, Rose Gold\",\"Material\":\"Fully Brass Body, Core, Knob\"}', 1, '617477756_DSC_7732.jpg', '', '', 0),
(54, 'ZLS-PC23', 'Zuma Delux Half Cylinder', 'zuma-delux-half-cylinder-', 2, 16, 'Application : Specially design for Store room, Balcony, Trail rooms, etc.,', '{\"Size Available\":\"45mm, 50mm\",\"Finish Available\":\"SS, CP, Antique, Black, Rose Gold\",\"Material\":\"Fully Brass Body, Core, Knob\"}', 1, '110294502_DSC_7733.jpg', '', '', 0),
(55, 'ZLS-PC2545', 'Zuma Delux Half 5 Key Cylinder', 'zuma-delux-half-5-key-cylinder-', 2, 16, 'Specification : Brass Computerized 5 Key ensure High Security, 6 Pin mechanism which have 6 lateral pin, Can be Euro Profile Lockbody, Also used in Sliding Lockbody.', '{\"Size Available\":\"45mm\",\"Finish Available \":\"SS, Antique, Black, Rose Gold\",\"Material\":\"Fully Brass Body, Core & Brass 5 Key\"}', 1, '142683145_DSC_7838.jpg', '', '', 0),
(56, 'ZLS-ZPC24', 'Zuma Delux Side Key Cylinder', 'zuma-delux-side-key-cylinder-', 2, 16, 'Specification : Brass Computerized 5 Key ensure High Security, 7 Pin mechanism which have 7 lateral pin, Can be fitted any in euro standard mortice body, Mainly used in safety door, office / factory door.', '{\"Size Available\":\"70mm, 80mm\",\"Material\":\"Fully Brass Body, Core & Brass 5 Key\",\"Finish \":\"SS Finish\"}', 1, '482944271_2470.jpg', '', '', 0),
(57, 'ZLS-PC51', 'Zuma Security 5 Key Cylinder', 'zuma-security-5-key-cylinder-', 2, 16, 'Specification:\r\n1) 5 Brass Computerized Snack Key ensure the Extra Security,\r\n2) 10 Pin Mechanism Which have two row of five lateral Pins,\r\n3) Specially Designed Big Knob for easy operation,\r\n4) High difficulty in key combination,\r\n5) Wide range of key combination,\r\n6) Can be fitted any in euro standard mortice body', '{\"Size Available\":\"70mm, 80mm\",\"Material\":\"Fully Brass Body, Core & Brass 5 Key\",\"Finish \":\"SS Finish\"}', 1, '344089089_DSC_7734.jpg', '', '', 0),
(58, 'ZLS-DL0122', 'Zuma Drawer Lock', 'zuma-drawer-lock', 2, 17, 'Specification : \r\n1) 2 Side Lesser Key,\r\n2) Big Dead Bolt to ensure better safety,\r\n3) Easy to install,\r\n4) Smooth Movement', '{\"Size Available\":\"21mm\",\"Material\":\"Single Brass Dead Bolt, Brass Key, Zinc Alloy Body\",\"Finish\":\"CP Finish\"}', 1, '1427465373_DSC_7821.jpg', '', '', 0),
(59, 'ZLS-SL01', 'Zuma Push Lock or Center Lock', 'zuma-push-lock-or-center-lock', 2, 19, 'Specification :\r\n1) Used as Center Lock in Sliding Door\r\n2) Easy to install\r\n3) 2 Key', '{\"Size Available\":\"22mm, 32mm\",\"Material\":\"Zinc Alloy\",\"Finish\":\"CP\"}', 1, '1422923704_DSC_7835.jpg', '', '', 0),
(60, 'ZLS-SL0200', 'Zuma Popat Lock - Taiwan', 'zuma-popat-lock---taiwan', 2, 19, 'Specification :\r\n1) Used as Lock in Sliding door,\r\n2) Packed body design,\r\n3) 3 Star Key,\r\n4) 2mm Striking Plate,\r\n5) Big Latch & Body', '{\"Size Available\":\"Taiwan Big\",\"Material\":\"Mild Steel\",\"Finish\":\"Black Powder Coated Body\"}', 1, '1372945928_taiwan.jpg', '', '', 0),
(61, 'ZLS-SL0201', 'Zuma Popat Lock - Small', 'zuma-popat-lock---small', 2, 19, 'Specification : \r\n1) Used as Lock in Sliding Door\r\n2) 3 Star Key', '{\"Size Available\":\"Small\",\"Material\":\"Mild Steel\",\"Finish\":\"Black Powder Coated Body\"}', 1, '1749396010_small.jpg', '', '', 0),
(62, 'ZLS-SL0301', 'Zuma Profile Lock', 'zuma-profile-lock', 2, 19, 'Specification : \r\n1) Used as Lock in Sliding door,\r\n2) 2 Laser Key', '{\"Type \":\"Universal\",\"Material\":\"Mild Steel, Plastic\",\"Finish\":\"Black and Nickel Finish\"}', 4, '1578139210_Lockingsolution.jpg', '', '', 0),
(63, 'ZLS-CL01', 'Zuma Cylindrical Lock', 'zuma-cylindrical-lock', 2, 20, 'Specification : \r\n1) 3 Brass Computerized Key,\r\n2) 5 Pin mechanism which have 5 lateral Pins,\r\n3) Specially Designed Big Knob for easy operation, \r\n4) Wide Range of Key Combination,\r\n5) Can be Fitted 25mm to 50mm thick door', '{\"Type \":\"Key to Knob, Keyless Knob\",\"Material\":\"Stainless Steel Body, Brass Core & Brass 5 Key\",\"Finish\":\"SS Finish\"}', 4, '67699034_cylindrical.jpg', '', '', 0),
(64, 'ZSF-0101', 'Zuma Single Track Runner', 'zuma-single-track-runner', 6, 21, 'Specification :\r\n1) Smooth Bearing wheel for free movement,\r\n2) Long life,\r\n3) Easy to install,\r\n4) Maintenance free \r\n\r\nFitted in :\r\nSliding Single Track Profile - 12mm (ZSF-ST01), \r\nOnly Taklu (ZSF-STT1)', '{\"Type \":\"Single Track Runner\",\"Material\":\"Mild Steel, Nylon wheel\",\"Finish \":\"Black Finish\"}', 4, '292497213_DSC_7822.jpg', '', '', 0),
(65, 'ZSF-0102', 'Zuma Single U-Type Track Runner', 'zuma-single-u-type-track-runner', 6, 21, 'Specification :\r\n1) Smooth Bearing wheel for free movement,\r\n2) Long life,\r\n3) Easy to install,\r\n4) Maintenance free \r\n\r\nFitted In :\r\nSingle U-Type Track Profile (ZSF-ST02)', '{\"Type \":\"Single U-Type Track Runner\",\"Material\":\"Mild Steel, Nylon Wheel\",\"Finish\":\"Zinc Finish\"}', 4, '1947892281_DSC_7823.jpg', '', '', 0),
(66, 'ZSF-0202', 'Zuma Double Track Runner - Bearing', 'zuma-double-track-runner---bearing', 6, 21, 'Specification :\r\n1) Smooth Bearing wheel for free movement,\r\n2) Bearing Top Support,\r\n3) Easy to install,\r\n4) Maintenance free \r\n\r\nFitted In :\r\nDouble Track Profile (ZSF-DT03),\r\nSingle Track Profile - 23mm (ZSF-ST03)', '{\"Type\":\"Bearing\",\"Material\":\"Mild Steel, Nylon Steel\",\"Finish\":\"Black Finish\"}', 4, '555519395_DSC_7825.jpg', '', '', 0),
(67, 'ZSF-0202S', 'Zuma Double Track Runner -  Soft Close', 'zuma-double-track-runner----soft-close', 6, 21, 'Specification :\r\n1) Smooth Bearing wheel for free movement,\r\n2) Bearing Top Support,\r\n3) Easy to install,\r\n4) Maintenance free \r\n\r\nFitted In :\r\nDouble Track Profile (ZSF-DT03),\r\nSingle Track Profile - 23mm (ZSF-ST03)', '{\"Type \":\"Soft Close \",\"Material\":\"Mild Steel, Nylon Wheel\",\"Finish\":\"Black Finish\"}', 4, '1771206834_DSC_7826.jpg', '', '', 0),
(68, 'ZSF-0400', 'Zuma 4 Wheel Runner', 'zuma-4-wheel-runner-', 6, 21, 'Specification :\r\n1) Smooth Bearing Wheel For the Movement,\r\n2) SS Floor Guide,\r\n3) Load Carrying Capacity - 60 Kg\r\n4) Easy to Install\r\n\r\nFitted In :\r\nU Track Profile (ZSF-UT01)\r\nU Track Profile (ZSF-UT02)\r\nU Track Profile (ZSF-UT03)', '{\"Type\":\"4 Wheel Runner\",\"Material\":\"Stainless Steel, Nylon Wheel\",\"Finish\":\"SS Finish\"}', 4, '1909694183_DSC_7833.jpg', '', '', 0),
(69, 'ZSF-0800', 'Zuma 8 Wheel Runner', 'zuma-8-wheel-runner-', 6, 21, 'Specification : \r\n1) Smooth Bearing Wheel For the Movement,\r\n2) SS Floor Guide,\r\n3) Load Carrying Capacity - 80 Kg\r\n4) Easy to Install\r\n\r\nFitted In :\r\nU Track Profile (ZSF-UT01)\r\nU Track Profile (ZSF-UT02)\r\nU Track Profile (ZSF-UT03)', '{\"Type\":\"8 Wheel Runner\",\"Material\":\"Stainless Steel, Nylon Wheel\",\"Finish\":\"SS Finish\"}', 4, '82559567_DSC_7829.jpg', '', '', 0),
(70, 'ZSF-0403', 'Zuma 4 Wheel Soft Close Runner', 'zuma-4-wheel-soft-close-runner-', 6, 21, 'Specification :\r\n1) Soft Close System Two Side,\r\n2) Minimum Door Length,\r\n3) Easy to Install\r\n\r\nFitted In :\r\nU Track Profile (ZSF-UT01)\r\nU Track Profile (ZSF-UT02)\r\nU Track Profile (ZSF-UT03)', '{\"Type \":\"4 Wheel- 2 Way Soft Close\",\"Material\":\"Aluminum Body Nylon Wheel\",\"Finish\":\"Aluminum Silver Finish\"}', 4, '1369893598_slidingfitting.jpg', '', '', 0),
(71, 'ZSF-0803', 'Zuma 8 Wheel Soft Close Runner', 'zuma-8-wheel-soft-close-runner', 6, 21, 'Specification :\r\n1) Soft Close System Two Side,\r\n2) Minimum Door Length,\r\n3) Easy to Install\r\n\r\nFitted In :\r\nU Track Profile (ZSF-UT01)\r\nU Track Profile (ZSF-UT02)\r\nU Track Profile (ZSF-UT03)', '{\"Type \":\"8 Wheel - 2 Way Soft Close\",\"Material\":\"Aluminum Body Nylon Wheel\",\"Finish\":\"Aluminum Silver Finish\"}', 4, '119817825_slidingfitting.jpg', '', '', 0),
(72, 'ZSF-S40', 'Zuma Slim Track Runner', 'zuma-slim-track-runner', 6, 21, 'Specification :\r\n1) Soft Close Type,\r\n2) Soft Close Capacity 45 Kg,\r\n3) Runner Capacity 60 Kg,\r\n4) Can be used in Glass Shutter Sliding,\r\n5) 2 Side Soft Close\r\n\r\nFitted In :\r\nSlim Track Single (ZSF-ST04)\r\nSlim Track Double (ZSF-DT04)', '{\"Type \":\"Brush Type, Cross Type\",\"Material\":\"Mild Steel & High Grade Nylon\",\"Finish\":\"Silver Finish, Grey Finish\"}', 4, '1188897879_slidingfitting1.jpg,1150958016_slidingfitting2.jpg', '', '', 0),
(73, 'ZSF-G80', 'Zuma Glass Runner 8 Wheel', 'zuma-glass-runner-8-wheel', 6, 23, 'Specification : \r\n1) Smooth Movement,\r\n2) Tight Holding\r\n\r\nFitted In :\r\nU Track (ZSF-UT02, ZSF-UT03)', '{\"Material\":\"Aluminum Body Nylon Wheel\",\"Finish\":\"Aluminum Silver Finish\"}', 5, '646888837_DSC_7790.jpg', '', '', 0),
(74, 'ZSF-G40', 'Zuma Glass Runner 4 Wheel', 'zuma-glass-runner-4-wheel', 6, 23, 'Specification : \r\n1) Smooth Movement,\r\n2) Tight Holding\r\n\r\nFitted In :\r\nU Track (ZSF-GTS1, ZSF-GTS2, ZSF-GTD1)', '{\"Material\":\"Aluminum Body Nylon Wheel\",\"Finish\":\"Aluminum Silver Finish\"}', 5, '906474176_DSC_7789.jpg', '', '', 0),
(75, 'ZSF-G803', 'Zuma Glass Runner 8 Wheel - Soft Close', 'zuma-glass-runner-8-wheel---soft-close', 6, 23, 'Specification :\r\n1) 2-Way Soft Closing,\r\n2) Smooth Movement,\r\n3) Tight Holding\r\n\r\nFitted In,\r\nU Track (ZSF-UT02, ZSF-UT03)', '{\"Type \":\"8 Wheel - Soft Close \",\"Material\":\"Aluminum Body Nylon Wheel\",\"Finish\":\"Aluminum Silver Finish\"}', 4, '130111943_slidingfitting3.jpg', '', '', 0),
(76, 'ZSF-G403', 'Zuma Glass Runner 4 Wheel - Soft Close', 'zuma-glass-runner-4-wheel---soft-close', 6, 23, 'Specification :\r\n1) 2-Way Soft Closing,\r\n2) Smooth Movement,\r\n3) Tight Holding\r\n\r\nFitted In,\r\nU Track (ZSF-UT02, ZSF-UT03)', '{\"Type \":\"4 Wheel Set - Soft Close\",\"Material\":\"Aluminum Body Nylon Wheel\",\"Finish\":\"Aluminum Silver Finish\"}', 4, '1495529411_slidingfitting3.jpg', '', '', 0),
(77, 'ZSF-ST010', 'Zuma Single Track - 12mm', 'zuma-single-track---12mm', 6, 22, 'Application : Use in Wardrobe Sliding, Display Sliding, Etc.', '{\"Size Available\":\"8 Feet, 12 Feet\",\"Material\":\"Aluminum \",\"Finish \":\"Regular, Anodize\"}', 1, '214965168_sliding1.jpg', '', '', 0),
(78, 'ZSF-ST03', 'Zuma Single Track - 23mm', 'zuma-single-track---23mm', 6, 22, 'Application : Use in Wardrobe Sliding, Display Sliding, Etc.', '{\"Size Available\":\"8 Feet, 12 Feet\",\"Material \":\"Aluminum\",\"Finish \":\"Regular, Anodize\"}', 1, '880814086_sliding5.jpg', '', '', 0),
(79, 'ZSF-ST0212', 'Zuma Single U- Type Track', 'zuma-single-u--type-track-', 6, 22, 'Application : Use in Wardrobe Sliding, Display Sliding, Etc.', '{\"Size Available\":\"12 Feet\",\"Material\":\"Aluminum\",\"Finish\":\"Regular, Anodize\"}', 1, '1998553669_slidin.jpg', '', '', 0),
(80, 'ZSF-DT03', 'Zuma Double Track', 'zuma-double-track-', 6, 22, 'Application : Use in Wardrobe Sliding, Display Sliding, Etc.', '{\"Size Available\":\"6 Feet, 6.5 Feet, 8 Feet, 10 Feet, 12 Feet\",\"Material\":\"Aluminum\",\"Finish\":\"Regular, Anodize\"}', 1, '1782875474_sliding6.jpg', '', '', 0),
(81, 'ZSF-STT1', 'Zuma Only Taklu', 'zuma-only-taklu', 6, 22, 'Application : Use in Wardrobe Sliding, Display Sliding, Etc.', '{\"Size Available\":\"8 Feet, 12 Feet\",\"Material\":\"Aluminum\",\"Finish\":\"Regular, Anodize\"}', 1, '1321140775_sliding7.jpg', '', '', 0),
(82, 'ZSF-UT01', 'Zuma U Track or C Track', 'zuma-u-track-or-c-track', 6, 22, 'Application : Use in Wardrobe Sliding, Display Sliding, Etc.', '{\"Size Available\":\"6 Feet, 6.5 Feet, 8 Feet, 10 Feet, 12 Feet\",\"Material\":\"Aluminum\",\"Finish\":\"Regular, Anodize\"}', 1, '1157072947_sliding8.jpg', '', '', 0),
(83, 'ZSF-UT020', 'Zuma U Track Heavy', 'zuma-u-track-heavy', 6, 22, 'Application : Use in Wardrobe Sliding, Display Sliding, Etc.', '{\"Size Available\":\"6 Feet, 6.5 Feet, 8 Feet, 10 Feet, 12 Feet\",\"Material\":\"Aluminum\",\"Finish\":\"Regular, Anodize\"}', 1, '372355653_sliding9.jpg', '', '', 0),
(84, 'ZSF-ST04', 'Zuma Slim Track Single', 'zuma-slim-track-single', 6, 22, 'Application : Use in Wardrobe Sliding, Display Sliding, Etc.', '{\"Size Available\":\"6 Feet, 8 Feet, 10 Feet, 12 Feet\",\"Material\":\"Aluminum\",\"Finish\":\"Anodize\"}', 1, '365651515_slim.jpg', '', '', 0),
(85, 'ZSF-DT04', 'Zuma Slim Track Double', 'zuma-slim-track-double', 6, 22, 'Application : Use in Wardrobe Sliding, Display Sliding, Etc.', '{\"Size Available\":\"6 Feet, 8 Feet, 10 Feet, 12 Feet\",\"Material\":\"Aluminum\",\"Finish\":\"Anodize \"}', 1, '1482305179_slim1.jpg', '', '', 0),
(86, 'ZSF-GTS1', 'Zuma Glass Track Single', 'zuma-glass-track-single', 6, 24, 'Application : Use in glass sliding.', '{\"Size Available\":\"6 Feet, 8 Feet, 10 Feet, 12 Feet\",\"Material\":\"Aluminum\",\"Finish\":\"Anodize\"}', 1, '609105392_slidingfitting10.jpg', '', '', 0),
(87, 'ZSF-GTS2', 'Zuma Glass Track Single Fix', 'zuma-glass-track-single-fix', 6, 24, 'Application : Use in Glass Sliding.', '{\"Size Available\":\"6 Feet, 8 Feet, 10 Feet, 12 Feet\",\"Material\":\"Aluminum\",\"Finish\":\"Anodize\"}', 1, '45213023_slidingfitting11.jpg', '', '', 0),
(88, 'ZSF-GTD1', 'Zuma Glass Track Double', 'zuma-glass-track-double-', 6, 24, 'Application : Use in Glass Sliding.', '{\"Size Available\":\"6 Feet, 8 Feet, 10 Feet, 12 Feet\",\"Material\":\"Aluminum\",\"Finish\":\"Anodize\"}', 1, '1349415969_slidingfitting12.jpg', '', '', 0),
(89, 'ZDC-0140', 'Zuma Door Closer - 40 Kg', 'zuma-door-closer---40-kg', 8, 30, 'Specification : \r\n1) Hydraulic Closing with Two Stage Closing,\r\n2) Available in Standard Arm & Hold Open Arm,\r\n3) Can be fitted in wooden or metal frame door,\r\n4) Non handed design,\r\n5) Maximum Opening Angle 180°,\r\n6) Fully Hydraulic controlled closing speed,\r\n7) Adjustable Section of Closing speed 0° - 20°,\r\n8) Adjustable Section of Latching Speed 20° - 180°,\r\n9) Maximum Door Weight - 40 Kg,\r\n10) Maximum Door Width - 800mm', '{\"Size Available\":\"40 Kg\",\"Type\":\"Non Hold, Hold\",\"Material\":\"High Grade Aluminum\",\"Finish\":\"Aluminum Silver Finish\"}', 4, '1119357159_DoorCloser1.jpg', '', '', 0),
(90, 'ZDC-0160', 'Zuma Door Closer - 60 Kg', 'zuma-door-closer---60-kg', 8, 30, 'Specification : \r\n1) Hydraulic Closing with Two Stage Closing,\r\n2) Available in Standard Arm & Hold Open Arm,\r\n3) Can be fitted in wooden or metal frame door,\r\n4) Non handed design,\r\n5) Maximum Opening Angle 180°,\r\n6) Fully Hydraulic controlled closing speed,\r\n7) Adjustable Section of Closing speed 0° - 20°,\r\n8) Adjustable Section of Latching Speed 20° - 180°,\r\n9) Maximum Door Weight - 60 Kg,\r\n10) Maximum Door Width - 950mm', '{\"Size Available\":\"60 Kg\",\"Type \":\"Non Hold, Hold\",\"Material\":\"High Grade Aluminum\",\"Finish\":\"Aluminum Sliver Finish\"}', 4, '1911329117_DoorCloser60.jpg', '', '', 0),
(91, 'ZDC-0180', 'Zuma Door Closer - 80 Kg', 'zuma-door-closer---80-kg', 8, 30, 'Specification : \r\n1) Hydraulic Closing with Two Stage Closing,\r\n2) Available in Standard Arm & Hold Open Arm,\r\n3) Can be fitted in wooden or metal frame door,\r\n4) Non handed design,\r\n5) Maximum Opening Angle 180°,\r\n6) Fully Hydraulic controlled closing speed,\r\n7) Adjustable Section of Closing speed 0° - 20°,\r\n8) Adjustable Section of Latching Speed 20° - 180°,\r\n9) Maximum Door Weight - 80 Kg,\r\n10) Maximum Door Width - 1100mm', '{\"Size Available\":\"80 Kg\",\"Type \":\"Non Hold, Hold\",\"Material\":\"High Grade Aluminum\",\"Finish\":\"Aluminum Silver Finish\"}', 4, '1352707625_DoorCloser80.jpg', '', '', 0),
(92, 'ZDC-0380', 'Zuma Door Closer Palmet - 80 Kg', 'zuma-door-closer-palmet---80-kg', 8, 30, 'Specification : \r\n1) Hydraulic Closing with Two Stage Closing,\r\n2) Can be fitted in wooden or metal frame door,\r\n3) Non handed design,\r\n4) Maximum Opening Angle 120°,\r\n5) Adjustable Section of Closing speed 0° - 20°,\r\n6) Adjustable Section of Latching Speed 20° - 180°,\r\n7) Maximum Door Weight - 80 Kg,\r\n8) Maximum Door Width - 1100mm', '{\"Size Available\":\"80 Kg\",\"Type \":\"Hold Open \",\"Material\":\"High Grade Aluminum \",\"Finish\":\"Aluminum Silver Finish\"}', 4, '2131300322_DoorCloserpalment.jpg', '', '', 0),
(93, 'ZDC-0280', 'Zuma Conceal Door Closer - 80 Kg', 'zuma-conceal-door-closer---80-kg', 8, 30, 'Specification : \r\n1) Hydraulic Closing with Two Stage Closing,\r\n2) Can be fitted in wooden or metal frame door,\r\n3) Suitable for 35mm or more thickness of Door,\r\n4) Fully Hydraulic controlled Closing Speed,\r\n5) Pack Body to ensure Long Life,\r\n6) Adjustable Closing speed,\r\n7) Adjustable Latching Speed,\r\n8) Maximum Door Weight - 60 Kg to 80 Kg,\r\n9) Maximum Door Width - 950mm', '{\"Size Available\":\"80 Kg\",\"Type\":\"Hold Open\",\"Material\":\"High Grade Aluminum\",\"Finish\":\"Aluminum Silver Finish\"}', 4, '1494745686_DoorCloserConceal.jpg', '', '', 0),
(94, 'ZGF-FS1', 'Zuma Floor Spring', 'zuma-floor-spring-', 9, 31, 'Specification :\r\n1) Maximum Opening Angle 105 Degree,\r\n2) Door Hold Angle 90 Degree Long Life,\r\n3) Leakage Proof,\r\n4) Two Direction Opening, \r\n5) Adjustable Closing Speed,\r\n6) Latching Force', '{\"Size Available\":\"80 Kg to 100 Kg , 120 Kg to 150 Kg\",\"Material\":\"SS-304 Top Cover, MS Bottom Cover, Zinc Alloy Body\",\"Finish\":\"SS Finish, Black Body\"}', 1, '1294527372_GLASSFITTINGfloor.jpg', '', '', 0),
(95, 'ZGF-PF0101M', 'Zuma Top Patch', 'zuma-top-patch', 9, 32, 'Specification : \r\n1) 1 mm Thick SS-304 Cover Plate,\r\n2) 8 mm Thick Aluminum Inner Gasket.', '{\"Item\":\"Zuma Top Patch\",\"Material\":\"SS-304 Cover, Brass Pivot Ring, Aluminum Body\",\"Finish\":\"SS Finish\"}', 5, '2021370736_DSC_7749.jpg', '', '', 0),
(96, 'ZGF-PF0201M', 'Zuma Bottom Patch', 'zuma-bottom-patch', 9, 32, 'Specification : \r\n1) 1 mm Thick SS-304 Cover Plate,\r\n2) 8 mm Thick Aluminum Inner Gasket.', '{\"Item\":\"Zuma Bottom Patch\",\"Material\":\"SS-304 Cover, Brass Pivot Ring, Aluminum Body\",\"Finish\":\"SS Finish\"}', 5, '1728845095_DSC_7750.jpg', '', '', 0),
(97, 'ZGF-PF0301M', 'Zuma Pivot', 'zuma-pivot', 9, 32, 'Specification : 2mm thickness of Base Plate', '{\"Item\":\"Zuma Pivot\",\"Material\":\"SS-304\",\"Finish\":\"SS Finish\"}', 5, '430549261_DSC_7751.jpg', '', '', 0),
(98, 'ZGF-PF0302M', 'Zuma Overpanel Pivot Patch', 'zuma-overpanel-pivot-patch', 9, 32, 'Specification : \r\n1) 1 mm Thick SS-304 Cover Plate,\r\n2) 8 mm Thick Aluminum Inner Gasket.', '{\"Item\":\"Zuma Over Panel Pivot\",\"Material\":\"SS-304 Cover, Brass Pivot Ring, Aluminum Body\",\"Finish\":\"SS Finish\"}', 5, '259555262_DSC_7752.jpg', '', '', 0),
(99, 'ZGF-PF0303M', 'Zuma Over Panel Pivot With Plate', 'zuma-over-panel-pivot-with-plate', 9, 32, 'Specification : \r\n1) 1 mm Thick SS-304 Cover Plate,\r\n2) 8 mm Thick Aluminum Inner Gasket.', '{\"Item\":\"Zuma Over Panel Pivot With Plate\",\"Material\":\"SS-304 Cover, Brass & SS Pivot, Aluminum Body\",\"Finish\":\"SS Finish\"}', 5, '975078658_DSC_7753.jpg', '', '', 0),
(100, 'ZGF-GL0306M', 'Zuma Glass Lock Bullet 1 Side Knob - G to G', 'zuma-glass-lock-bullet-1-side-knob---g-to-g', 9, 34, 'Specification :\r\n1) 1mm Thickness of Cover Plate', '{\"Type \":\"Glass to Wall Lock\",\"Material\":\"SS-201 Cover, Brass Cylinder\",\"Finish\":\"SS Finish\"}', 4, '1905131011_DSC_7770.jpg', '', '', 0),
(101, 'ZGF-PF0304M', 'Zuma Over Panel Corner L Pivot', 'zuma-over-panel-corner-l-pivot', 9, 32, 'Specification : \r\n1) 1 mm Thick SS-304 Cover Plate,\r\n2) 8 mm Thick Aluminum Inner Gasket.', '{\"Item\":\"Zuma Over Panel Corner L Pivot\",\"Material\":\"SS-304 Cover, Brass & SS Pivot, Aluminum Body\",\"Finish\":\"SS Finish\"}', 5, '1794622390_DSC_7756.jpg', '', '', 0),
(102, 'ZGF-PF0401M', 'Zuma Corner Patch', 'zuma-corner-patch', 9, 32, 'Specification : \r\n1) 1 mm Thick SS-304 Cover Plate,\r\n2) 8 mm Thick Aluminum Inner Gasket.', '{\"Item\":\"Zuma Corner Patch\",\"Material\":\"SS-304 Cover, Aluminum Body\",\"Finish\":\"SS Finish\"}', 5, '780367431_DSC_7759.jpg', '', '', 0),
(103, 'ZGF-PF0501M', 'Zuma Patch Lock', 'zuma-patch-lock', 9, 32, 'Specification : \r\n1) 1 mm Thick SS-304 Cover Plate,\r\n2) 8 mm Thick Aluminum Inner Gasket.  \r\n3) 3 Computerized Brass Key & 60 mm Cylinder', '{\"Item\":\"Zuma Patch Lock\",\"Material\":\"SS-304 Cover, Brass Cylinder, Aluminum Body\",\"Finish\":\"SS Finish\"}', 5, '1926254090_DSC_7762.jpg', '', '', 0),
(104, 'ZGF-PF0601M', 'Zuma Strike Box', 'zuma-strike-box-', 9, 32, 'Specification : \r\n1) 1 mm Thick SS-304 Cover Plate,\r\n2) 8 mm Thick Aluminum Inner Gasket.', '{\"Material\":\"SS-304 Cover, Aluminum Body\",\"Finish\":\"SS Finish\"}', 5, '798978262_DSC_7763.jpg', '', '', 0),
(105, 'ZGF-PF0602M', 'Zuma Over Panel Strike Box L Patch', 'zuma-over-panel-strike-box-l-patch', 9, 32, 'Specification : \r\n1) 1 mm Thick SS-304 Cover Plate,\r\n2) 8 mm Thick Aluminum Inner Gasket.', '{\"Item\":\"Zuma Over Panel Strike Box L Patch\",\"Material\":\"SS-304 Cover, Aluminum Body\",\"Finish\":\"SS Finish\"}', 5, '920674081_DSC_7764.jpg', '', '', 0),
(106, 'ZGF-PV011208', 'Zuma PVC Sealing Profile - D Type', 'zuma-pvc-sealing-profile---d-type', 9, 38, 'Application : Use in Glass Protection.', '{\"Size Available\":\"8 Feet\",\"Material\":\"Virgin PVC\",\"Finish\":\"Clear Bluish Finish\"}', 1, '538815349_DSC_7839.jpg', '', '', 0),
(107, 'ZGF-PV021208', 'Zuma PVC Sealing Profile - H Type', 'zuma-pvc-sealing-profile---h-type', 9, 38, 'Application : Use in Glass Protection.', '{\"Size Available\":\"8 Feet\",\"Material\":\"Virgin\",\"Finish\":\"Clear Bluish Finish\"}', 1, '165765854_DSC_7840.jpg', '', '', 0),
(108, 'ZGF-GL0102M', 'Zuma Glass to Glass Lock', 'zuma-glass-to-glass-lock', 9, 34, 'Specification :\r\n1) 1mm Thickness of Cover Plate,\r\n2) Can be Fitted in 12mm Glass,\r\n3) 3 Computerized Brass Key,\r\n4) One side key & One side Knob,\r\n5) Long Life & Easy to Install,\r\n6) High Corrosion Resistance.', '{\"Item\":\"Glass to Glass Lock\",\"Material\":\"SS-201 Cover, Brass Cylinder\",\"Finish\":\"SS Finish\"}', 5, '1030770519_DSC_7770.jpg', '', '', 0),
(109, 'ZGF-GL0101M', 'Zuma Glass to Wood Lock', 'zuma-glass-to-wood-lock', 9, 34, 'Specification :\r\n1) 1mm Thickness of Cover Plate,\r\n2) Can be Fitted in 12mm Glass,\r\n3) 3 Computerized Brass Key,\r\n4) One side key & One side Knob,\r\n5) Long Life & Easy to Install,\r\n6) High Corrosion Resistance.', '{\"Item\":\"Zuma Glass to Wood Lock\",\"Material\":\"SS-201 Cover, Brass Cylinder\",\"Finish\":\"SS Finish\"}', 5, '1107608932_DSC_7767.jpg', '', '', 0),
(110, 'ZGF-GL0402M', 'Zuma Glass Pull Handle Lock', 'zuma-glass-pull-handle-lock', 9, 34, 'Specification :\r\n1) 35mm Diameter of Handle Rod,\r\n2) Total Length 1500mm,\r\n3) 3 Computerized Brass Key,\r\n4) Hole to Hole Length 1120mm,\r\n5) Long Life,\r\n6) Maintenance Free,\r\n7) Brass Cor Cylinder.', '{\"Item\":\"Handle Lock\",\"Size\":\"1120mm\",\"Material\":\"SS-304 Cover, Brass Cylinder\",\"Finish\":\"SS Finish\"}', 5, '1423845095_GlassHandle.jpg', '', '', 0),
(111, 'ZGF-GL0202M', 'Zuma Glss Lock 4 Way 1 Side Key and Knob - G to G', 'zuma-glss-lock-4-way-1-side-key-and-knob---g-to-g', 9, 34, 'Specification :\r\n1) 1mm Thickness of Cover Plate,\r\n2) Can be Fitted in 12mm Glass,\r\n3) 3 Computerized Brass Key,\r\n4) One side key & One side Knob,\r\n5) Big Oval Design,\r\n6) 4 Way Locking System,\r\n7) Useful as Door Lock and Sliding Lock', '{\"Type\":\"Glass to Glass Lock\",\"Material\":\"SS-201 Cover, Brass Cylinder\",\"Finish\":\"SS Finish\"}', 4, '1864622953_lock1.jpg', '', '', 0),
(112, 'ZGF-GL0201M', 'Zuma Glass Lock 4 Way 1 Side Key and Knob - G to W', 'zuma-glass-lock-4-way-1-side-key-and-knob---g-to-w', 9, 34, 'Specification :\r\n1) 1mm Thickness of Cover Plate,\r\n2) Can be Fitted in 12mm Glass,\r\n3) 3 Computerized Brass Key,\r\n4) One side key & One side Knob,\r\n5) Big Oval Design,\r\n6) 4 Way Locking System,\r\n7) Useful as Door Lock and Sliding Lock', '{\"Type\":\"Glass to Wall Lock\",\"Material\":\"SS-201 Cover, Brass Cylinder\",\"Finish\":\"SS Finish\"}', 4, '2064246158_lock2.jpg', '', '', 0),
(113, 'ZGF-GL0204M', 'Zuma Glass Lock 4 Way 1 Side Key - G to G', 'zuma-glass-lock-4-way-1-side-key---g-to-g', 9, 34, 'Specification :\r\n1) 1mm Thickness of Cover Plate,\r\n2) Can be Fitted in 12mm Glass,\r\n3) One side Knob,\r\n4) Big Oval Design,\r\n5) 4 Way Locking System,\r\n6) Useful as Door Lock and Sliding Lock.', '{\"Type \":\"Glass to Glass Lock\",\"Material\":\"SS-201 Cover, Brass Cylinder\",\"Finish \":\"SS Finish\"}', 4, '371196390_lock3.jpg', '', '', 0),
(114, 'ZGF-GL0203M', 'Zuma Glass Lock 4 Way 1 Side Key - G to W', 'zuma-glass-lock-4-way-1-side-key---g-to-w', 9, 34, 'Specification :\r\n1) 1mm Thickness of Cover Plate,\r\n2) Can be Fitted in 12mm Glass,\r\n3) One side Knob,\r\n4) Big Oval Design,\r\n5) 4 Way Locking System,\r\n6) Useful as Door Lock and Sliding Lock.', '{\"Type \":\"Glass to Wall Lock\",\"Material\":\"SS-201 Cover, Brass Cylinder\",\"Finish\":\"SS Finish\"}', 4, '1591296585_4.jpg', '', '', 0),
(115, 'ZGF-GL0206M', 'Zuma Glass Lock 4 Way 1 Side Knob - G To G', 'zuma-glass-lock-4-way-1-side-knob---g-to-g', 9, 34, 'Specification :\r\n1) 1mm Thickness of Cover Plate,\r\n2) Can be Fitted in 12mm Glass,\r\n3) 3 Computerized Brass Key,\r\n4) One side key & One side Knob,\r\n5) Big Oval Design,\r\n6) 4 Way Locking System,\r\n7) Useful as Door Lock and Sliding Lock', '{\"Type \":\"Glass to Glass Lock\",\"Material\":\"SS-201 Cover, Brass Cylinder\",\"Finish\":\"SS Finish\"}', 4, '677124929_lock6.jpg', '', '', 0),
(116, 'ZGF-GL0205M', 'Zuma Glass Lock 4 Way 1 Side Knob - G To W', 'zuma-glass-lock-4-way-1-side-knob---g-to-w', 9, 34, 'Specification :\r\n1) 1mm Thickness of Cover Plate,\r\n2) Can be Fitted in 12mm Glass,\r\n3) 3 Computerized Brass Key,\r\n4) One side key & One side Knob,\r\n5) Big Oval Design,\r\n6) 4 Way Locking System,\r\n7) Useful as Door Lock and Sliding Lock', '{\"Type \":\"Glass to Wall Lock\",\"Material\":\"SS-201 Cover, Brass Cylinder\",\"Finish\":\"SS Finish\"}', 4, '912507472_6.jpg', '', '', 0),
(117, 'ZGF-GC', 'Zuma Connector', 'zuma-connector', 9, 35, 'Application : Use for Glass Fixing.', '{\"Size Available\":\"0\\u00b0, 90\\u00b0, 135\\u00b0, 180\\u00b0\",\"Material\":\"SS-304\",\"Finish\":\"SS Finish\",\"Type \":\"G to G, G to W\"}', 1, '1189603969_DSC_7774.jpg,145080638_DSC_7773.jpg,516060395_DSC_7775.jpg,2005745731_DSC_7777.jpg,1003177244_DSC_7780.jpg,1397635849_DSC_7786.jpg', '', '', 0);
INSERT INTO `products` (`id`, `code`, `name`, `slug`, `category`, `subcategory`, `description`, `about_product`, `attribute`, `product_image`, `installation_guide_images`, `installation_guide_videos`, `is_hot`) VALUES
(118, 'ZGF-GL0306', 'Zuma Glass Lock Bullet 1 Side Knob', 'zuma-glass-lock-bullet-1-side-knob', 9, 34, 'Specification :\r\n1) 1mm Thickness of Cover Plate,\r\n2) Can be Fitted in 12mm Glass,\r\n3) One side Knob,\r\n4) Single Bullet Dead Bolt,\r\n5) Mainly used as Bathroom Lock', '{\"Type \":\"Glass to Glass Lock\",\"Material\":\"SS-201 Cover, Brass Cylinder\",\"Finish\":\"SS Finish\"}', 4, '1621646657_7.jpg', '', '', 0),
(119, 'ZGF-GL0305M', 'Zuma Glass Lock Bullet 1 Side Knob - G to W', 'zuma-glass-lock-bullet-1-side-knob---g-to-w', 9, 34, 'Specification :\r\n1) 1mm Thickness of Cover Plate,\r\n2) Can be Fitted in 12mm Glass,\r\n3) One side Knob,\r\n4) Single Bullet Dead Bolt,\r\n5) Mainly used as Bathroom Lock', '{\"Type \":\"Glass to Wall Lock\",\"Material\":\"SS-201 Cover, Brass Cylinder\",\"Finish\":\"SS Finish\"}', 4, '252664611_8.jpg', '', '', 0),
(121, 'ZGF-HPH2', 'Glass Door Handle - H', 'glass-door-handle---h', 9, 37, 'Application : Use in Glass Door.', '{\"Size Available\":\"200mm, 250mm, 300mm, 450mm, 600mm\",\"Finish\":\"Matt, Combi\",\"Material\":\"SS-304 Handle, Brass Fixing Nut\"}', 1, '2138001145_DSC_7842.jpg', '', '', 0),
(122, 'ZGF-HPO2', 'Zuma Door Handle - O', 'zuma-door-handle---o', 9, 37, 'Application :  Use in Glass Door.', '{\"Size Available\":\"200mm, 250mm, 300mm, 450mm, 600mm\",\"Finish\":\"Matt, Combi\",\"Material\":\"SS-304 Handle, Brass Fixing Nut\"}', 1, '868896391_DSC_7843.jpg', '', '', 0),
(123, 'ZGF-HPP2', 'Zuma Glass Handle - PSD', 'zuma-glass-handle---psd', 9, 37, 'Application : Use in Glass Door.', '{\"Size Available\":\"200mm, 250mm, 300mm, 450mm, 600mm\",\"Finish\":\"Matt, Combi\",\"Material\":\"SS-304 Handle, Brass Fixing Nut\"}', 1, '506314219_DSC_7845.jpg', '', '', 0),
(124, 'ZGF-HPL2', 'Zuma Glass Door Handle - L', 'zuma-glass-door-handle---l', 9, 37, 'Application : Use in Glass Door.', '{\"Size Available\":\"200mm, 250mm, 300mm, 450mm, 600mm\",\"Finish\":\"Matt, Combi\",\"Material\":\"SS-304 Handle, Brass Fixing Nut\"}', 1, '2071300305_DSC_7846.jpg', '', '', 0),
(125, 'ZGH-HPH+25', 'Zuma Glass Door Handle  - H Plus', 'zuma-glass-door-handle----h-plus', 9, 37, 'Application : Use in Glass Door.', '{\"Size Available\":\"200mm, 250mm, 300mm, 450mm, 600mm\",\"Finish\":\"Satin, Combi\",\"Material\":\"SS-304 Handle, Brass Fixing Nut\"}', 1, '1694615365_DSC_7886.jpg', '', '', 0),
(126, 'ZGF-HPP20', 'Zuma Glass Door Handle  - S', 'zuma-glass-door-handle----s', 9, 37, 'Application : Use in Glass Door.', '{\"Size Available\":\"200mm, 250mm, 300mm\",\"Finish\":\"Matt, Combi\",\"Material\":\"\\tSS-304 Handle, Brass Fixing Nut\"}', 1, '1877707231_DSC_7847.jpg', '', '', 0),
(127, 'ZGF-HSO', 'Zuma Glass Shower Handle Round', 'zuma-glass-shower-handle-round', 9, 36, 'Application : Use in Shower Door.', '{\"Size Available\":\"200mm, 250mm, 300mm, 400mm, 600mm\",\"Finish\":\"Satin, Glossy\",\"Material\":\"SS-304 Handle, Brass Fixing Nut\"}', 1, '801544996_sh1.jpg', '', '', 0),
(128, 'ZGF-HSP', 'Zuma Glass Shower Handle Square', 'zuma-glass-shower-handle-square', 9, 36, 'Application : Use in Shower Door.', '{\"Size Available\":\"200mm, 250mm\",\"Finish\":\"Satin, Combi\",\"Material\":\"SS-304 Handle, Brass Fixing Nut\"}', 1, '711230209_sh2.jpg', '', '', 0),
(129, 'ZTS-3S201', 'Zuma Swing Corner', 'zuma-swing-corner-', 3, 7, 'Application :   Specially designed Swing Corner for modern kitchen.', '{\"Cabinet \":\"900mm\",\"Height \":\"600mm - 730mm\",\"Depth\":\"475mm\",\"Closing Type\":\"Soft Close\",\"Finish\":\"White Base, Chrome Plated Boundary\",\"Open Type\":\"Left, Right\"}', 4, '1341970858_swingcorner.jpg', '', '', 0),
(130, 'ZTS-3M201', 'Zuma Magic Corner', 'zuma-magic-corner-', 3, 7, 'Application :  Specially designed Magic Corner for modern kitchen.', '{\"Cabinet\":\"900mm\",\"Height \":\"525mm - 750mm\",\"Depth\":\"480mm\",\"Closing Type\":\"Soft Close\",\"Finish\":\"White Base, Chrome Plated Boundary\",\"Opening Type\":\"Left, Right\"}', 4, '1421242843_Magiccorner.jpg', '', '', 0),
(131, 'ZTS-3M202', 'Zuma Universal Magic Corner', 'zuma-universal-magic-corner', 3, 7, 'Application : Specially designed Swing Corner for modern kitchen.', '{\"Cabinet \":\"900mm\",\"Height \":\"590mm\",\"Depth\":\"455mm\",\"Closing Type\":\"Soft Close\",\"Finish\":\"White Base, Chrome Plated Boundary\"}', 4, '1792346020_unimagiccorner.jpg', '', '', 0),
(132, 'ZTS-72400', 'Zuma Dustbin Holder', 'zuma-dustbin-holder-', 3, 8, 'Application : Application :  Specially designed Dustbin Holder for modern kitchen.', '{\"Cabinet \":\"400mm\",\"Size Capacity\":\"350mm Dia\"}', 1, '372811106_dustbin.jpg', '', '', 0),
(133, 'ZTS-81', 'Zuma Tall Unit', 'zuma-tall-unit-', 3, 40, 'Application : Specially designed Tall Unit for modern kitchen.', '{\"Cabinet\":\"400mm\",\"Height \":\"1150mm - 1950mm\",\"Depth\":\"480mm\",\"No. of Layer\":\"4, 5, 6\",\"Finish\":\"White Base, Chrome Plated Boundary\",\"Closing Type\":\"Soft Close\"}', 1, '462502850_TallUnit.jpg', '', '', 0),
(134, 'ZTS-82', 'Zuma Pantry Unit', 'zuma-pantry-unit', 3, 40, 'Application :  Specially designed Pantry Unit for modern kitchen', '{\"Cabinet\":\"450mm\",\"Height \":\"1150mm - 2150mm\",\"Depth\":\"500mm\",\"No. of  Layers \":\"4, 5, 6\",\"Finish\":\"\\tWhite Base, Chrome Plated Boundary\",\"Closing Type\":\"Soft Close\"}', 1, '1780357871_Pantryunit.jpg', '', '', 0),
(135, 'ZTS-4S2', 'Zuma SS Cutlery Organizer', 'zuma-ss-cutlery-organizer', 3, 5, 'Note : All size will be available as per your requirements.', '{\"Width Available \":\"16 inch  to 30 inch\",\"Depth Available\":\"480mm, 520mm\",\"Material\":\"Stainless Steel \",\"Finish\":\"Matt \\/ Glossy\"}', 1, '499990994_SSCutlery.jpg', '', '', 0),
(136, 'ZTS-4W20', 'Zuma Wooden Cutlery', 'zuma-wooden-cutlery-', 3, 5, 'Specification : \r\n1) Adjustable Width,\r\n2) High Durability, \r\n3) Easy to use and install', '{\"Deep\":\"485mm\",\"Width Available \":\"400mm - 600mm, 700mm - 900mm\",\"Material\":\"Wood\",\"Finish\":\"Wooden Varnished Finish\"}', 1, '1020335625_WoodenCutlery.jpg', '', '', 0),
(137, 'ZTS-5SSH', 'Zuma Tandem Inlet Saucer Holder', 'zuma-tandem-inlet-saucer-holder', 3, 6, 'Specification : Anti Slip Material Base for Long Grip, Screw to Adjustable 10mm Deep, Easy to Mount.', '{\"Deep\":\"470mm, 520mm\",\"Height \":\"100mm\",\"Material\":\"Stainless Steel\",\"Finish\":\"SS\"}', 1, '382827683_PXL_7672.jpg', '', '', 0),
(138, 'ZGF-KH0101', 'Zuma Rectangle Track', 'zuma-rectangle-track', 9, 39, 'Application : use in shower knight head accessories.', '{\"Size Available\":\"10x30 mm\",\"Material\":\"SS-304\",\"Finish\":\"Matt, Glossy\"}', 2, '305108228_rectangletrack.jpg', '', '', 0),
(139, 'ZGF-KH0102', 'Zuma Wall to Track Connector', 'zuma-wall-to-track-connector', 9, 39, 'Application : use in shower knight head accessories.', '{\"Material\":\"SS-304\",\"Finish\":\"Matt, Glossy\"}', 1, '1956707850_kh2.jpg', '', '', 0),
(140, 'ZGF-KH0103', 'Zuma Glass to Track Connector - H Clamp', 'zuma-glass-to-track-connector---h-clamp', 9, 39, 'Application : use in shower knight head accessories.', '{\"Material\":\"SS-304\",\"Finish\":\"Matt, Glossy\"}', 1, '1731719659_sh3.jpg', '', '', 0),
(141, 'ZGF-KH0104', 'Zuma Track to Track Connector', 'zuma-track-to-track-connector', 9, 39, 'Application : use in shower knight head accessories.', '{\"Material\":\"SS-304\",\"Finish\":\"Matt, Glossy\"}', 2, '77014799_kh4.jpg', '', '', 0),
(142, 'ZGF-KH0108', 'Zuma End Stopper', 'zuma-end-stopper-', 9, 39, 'Application : use in shower knight head accessories. Easily held with grub screw.', '{\"Material\":\"SS-304\",\"Finish\":\"Matt, Glossy\"}', 2, '1919726264_kh3.jpg', '', '', 0),
(143, 'ZSF-G001', 'Zuma Floor Guide', 'zuma-floor-guide-', 9, 39, 'Application : use in shower knight head accessories.', '{\"Material\":\"SS-304\",\"Finish\":\"Matt, Glossy\"}', 2, '1570490493_kh6.jpg', '', '', 0),
(144, 'ZSF-G003', 'Zuma Door Stopper - Floor Mounting', 'zuma-door-stopper---floor-mounting-', 9, 39, 'Application : use in shower knight head accessories.', '{\"Material\":\"SS-304\",\"Finish\":\"Matt, Glossy\",\"Type \":\"Half Round\"}', 2, '857590961_kh7.jpg', '', '', 0),
(145, 'ZGF-KH0105', 'Zuma Single Sliding Roller', 'zuma-single-sliding-roller', 9, 39, 'Application : use in shower knight head accessories.\r\n\r\nSpecification : Independent needle bearing.', '{\"Material\":\"SS-304\",\"Finish\":\"Matt, Glossy\"}', 2, '1485251242_kh8.jpg', '', '', 0),
(146, 'ZGF-KH0109', 'Zuma Swift Sliding Roller', 'zuma-swift-sliding-roller', 9, 39, 'Application : use in shower knight head accessories.', '{\"Material\":\"SS-304\",\"Finish\":\"Matt, Glossy\"}', 2, '1747794041_kh9.jpg', '', '', 0),
(147, 'ZGF-KH0107', 'Zuma Glass to Track Connector', 'zuma-glass-to-track-connector-', 9, 39, 'Application : use in shower knight head accessories.', '{\"Material\":\"SS-304\",\"Finish\":\"Matt, Glossy\"}', 2, '1993432786_kh10.jpg', '', '', 0),
(148, 'ZGF-KH01010', 'Zume Single Sliding Roller Full Set', 'zume-single-sliding-roller-full-set', 9, 39, 'Total Item : Wall to Track Connector = 2 Pcs, Single Sliding Roller = 2 Set, Glass to Track Connector = 2 Pcs, End Stopper = 2 Pcs, Floor Guide = 1 Pcs', '{\"Material\":\"Wall to Track Connector = 2 Pcs, Single Sliding Roller = 2 Set, Glass to Track Connector = 2 Pcs, End Stopper = 2 Pcs, Floor Guide = 1 Pcs\",\"Finish\":\"Matt, Glossy\"}', 2, '779397099_khs1.jpg', '', '', 0),
(149, 'ZGF-KH01011', 'Zuma Swift Sliding Roller Full Set', 'zuma-swift-sliding-roller-full-set-', 9, 39, 'Item : Wall to Track Connector = 2 Pcs, Swift Sliding Roller = 2 Set, Glass to Track Connector = 2 Pcs, End Stopper = 2 Pcs, Floor Guide = 1 Pcs', '{\"Material\":\"Wall to Track Connector = 2 Pcs, Swift Sliding Roller = 2 Set, Glass to Track Connector = 2 Pcs, End Stopper = 2 Pcs, Floor Guide = 1 Pcs\",\"Finish\":\"Matt, Glossy\"}', 2, '731629594_kh12.jpg', '', '', 0),
(150, 'ZGF-KH01', 'Zuma Rectangle Handle', 'zuma-rectangle-handle-', 9, 37, 'Application : Use in Glass Sliding.', '{\"Material\":\"SS-304\",\"Finish\":\"Matt, Glossy\"}', 2, '2090520148_glasshandle1.jpg', '', '', 0),
(151, 'ZGF-HK02', 'Zuma Round Handle', 'zuma-round-handle', 9, 37, 'Application : Use in Glass Sliding.', '{\"Material\":\"SS-304\",\"Finish\":\"Matt, Glossy\"}', 2, '867169950_sh15.jpg', '', '', 0),
(152, 'ZGF-HK03', 'Zuma Square Handle', 'zuma-square-handle', 9, 37, 'Application : Use in Glass Sliding.', '{\"Material\":\"SS-304\",\"Finish\":\"Matt, Glossy\"}', 2, '1333982488_sh16.jpg', '', '', 0),
(153, 'ZGF-HK04', 'Zuma Round Knob', 'zuma-round-knob', 9, 37, 'Application : Use in Glass Sliding.', '{\"Material\":\"SS-304\",\"Finish\":\"Matt, Glossy\"}', 2, '971226510_SH17.jpg', '', '', 0),
(156, 'ZSF-UT0365A', 'U Track No.3', 'u-track-no.3', 6, 22, 'Application : Use in Wooden Sliding Door.', '{\"Size Available\":\"6.5 Feet, 8 Feet, 10 Feet, 12 Feet\",\"Material\":\"Aluminum \",\"Finish\":\"Anodize\"}', 1, '773718056_u3.jpg', '', '', 0),
(157, 'ZGF-SH10902', 'Zuma Shower Hinges - W to G 90 Degree', 'zuma-shower-hinges---w-to-g-90-degree', 9, 36, 'Specification : Material SS-304.', '{\"Type\":\"Wall to Glass\",\"Material\":\"SS-304\",\"Finish\":\"Matt, Gloassy\"}', 2, '1923543868_s2.jpg', '', '', 0),
(158, 'ZGF-SH10901', 'Zuma Shower Hinges - W to G 90 Degree Fix', 'zuma-shower-hinges---w-to-g-90-degree-fix', 9, 36, 'Specification : Material SS-304', '{\"Type \":\"Wall to Glass\",\"Material\":\"SS-304\",\"Finish\":\"Matt, Glossy\"}', 2, '2146093099_s1.jpg', '', '', 0),
(159, 'ZGF-SH10903', 'Zuma Shower Hinges - W to G 90 Degree Offset', 'zuma-shower-hinges---w-to-g-90-degree-offset', 9, 36, 'Specification : Material SS-304', '{\"Type \":\"Wall to Glass\",\"Material\":\"SS-304\",\"Finish\":\"Matt, Glossy\"}', 2, '1144232410_s3.jpg', '', '', 0),
(160, 'ZGF-SH20901', 'Zuma Shower Hinges - G to G 90 Degree', 'zuma-shower-hinges---g-to-g-90-degree', 9, 36, 'Specification : Material SS-304.', '{\"Type \":\"Glass to Glass\",\"Material\":\"SS-304\",\"Finish\":\"Matt, Glossy\"}', 2, '151954429_s4.jpg', '', '', 0),
(161, 'ZGF-SH21351', 'Zuma Shower Hinges - G to G 135 Degree', 'zuma-shower-hinges---g-to-g-135-degree', 9, 36, 'Application : Use in Shower Fitting.', '{\"Type \":\"Glass to Glass\",\"Material\":\"SS-304\",\"Finish\":\"Matt, Glossy\"}', 2, '1304451300_s5.jpg', '', '', 0),
(162, 'ZGF-SH21801', 'Zuma Shower Hinges - G to G 180 Degree', 'zuma-shower-hinges---g-to-g-180-degree', 9, 36, 'Application : Use in Shower Fitting.', '{\"Type \":\"Glass to Glass\",\"Material\":\"SS-304\",\"Finish\":\"Matt, Glossy\"}', 2, '2005369067_s6.jpg', '', '', 0),
(163, 'ZAL-FP03', 'U Frameless Frame Profile - 45mm', 'u-frameless-frame-profile---45mm', 7, 28, 'Aluminum Profile', '{\"Size Available\":\"3 Meter\",\"Material\":\"Aluminum \",\"Finish Available \":\"Aluminum Silver, SS Brush, CP Brush, Rose Gold, Black\"}', 2, '1810745232_uframelessfAluminiumProfile.jpg', '', '', 0),
(164, 'ZAL-HP031', 'U Frameless Handle Profile - 45mm', 'u-frameless-handle-profile---45mm', 7, 25, 'Aluminum Profile', '{\"Size Available\":\"3 Meter \",\"Material\":\"Aluminum \",\"Finish\":\"Aluminum Silver, SS Brush, CP Brush, Rose Gold, Black\"}', 2, '750449872_uframelesshandleAluminiumProfile.jpg', '', '', 0),
(165, 'ZAL-FP01', '4MM Glass Frame Profile - 45mm', '4mm-glass-frame-profile---45mm', 7, 28, 'Aluminum Profile', '{\"Size Available\":\"3 Meter\",\"Material\":\"Aluminum \",\"Finish\":\"Aluminum Silver, SS Brush, CP Brush, CP Mirror, Rose Gold, Black\"}', 2, '270123269_4mmglassfAluminiumProfile.jpg', '', '', 0),
(166, 'ZAL-EP25', 'Edge Profile 25MM', 'edge-profile-25mm', 7, 27, 'Aluminum Edge Profile', '{\"Size Available\":\"3 meter\",\"Material\":\"Aluminum\",\"Finish\":\"Aluminum Silver, SS Brush, CP Mirror, Rose Gold, Black\"}', 2, '504749979_25mmAluminiumProfile.jpg', '', '', 0),
(167, 'ZGF-GL040', 'Zuma Glass Sliding Lock - G to G', 'zuma-glass-sliding-lock---g-to-g', 9, 34, 'Application : Glass Fitting Handle with Lock.', '{\"Material\":\"SS-304\",\"Finish\":\"SS Finish\",\"Type \":\"Glass to Glass Lock, Glass to Wall Lock\"}', 4, '492647579_GLASSFITTING.jpg', '', '', 0),
(168, 'ZAL-LP01', 'L-1 Handle Profile', 'l-1-handle-profile', 7, 25, 'Handle Profile', '{\"Size Available\":\"3 Meter\",\"Material\":\"Aluminum\",\"Finish\":\"Aluminum Silver, Rose Gold, Black, CP Brush\"}', 2, '2069425767_L-1.jpg', '', '', 0),
(169, 'ZAL-GP01', 'G Handle Profile Regular', 'g-handle-profile-regular--', 7, 25, 'Kitchen Profile Handle', NULL, 2, '480840884_AluminiumProfile.jpg', '', '', 0),
(170, 'ZSF-G802', 'Glass Runner 8 Wheel', 'glass-runner-8-wheel', 6, 23, 'Specification: Smooth Movement Tight Holding', NULL, 5, '358384111_slidingfitting.jpg', '', '', 0),
(171, 'ZSF_G401', 'Glass Runner 4 Wheel', 'glass-runner-4-wheel', 6, 23, 'Specification: Smooth Movement, Tight Holding', NULL, 5, '307151275_slidingfittingZSF_G401.jpg', '', '', 0),
(172, 'ZAL-CN4501', '45MM CONNECTOR REGULAR', '45mm-connector-regular', 7, 29, 'Master pack: 100 set\r\nper set MRP: 96/-', NULL, 5, '355226511_zumaAluminiumProfileconnector.jpg', '', '', 0),
(173, 'ZHL-BF', 'Zuma Bed Fitting 4 feet Frame only', 'zuma-bed-fitting-4-feet-frame-only', 4, 12, 'Finish : Black Powder coated Glossy Finish\r\nMaterial : Mild Steel\r\n\r\nCaution : Keep away from thinner and color,\r\nKeep away from heat,\r\n: 5mm thickness of Bed Frame,\r\n22mm, 25mm or 28mm dia of Gas pump Cylinder,\r\n10mm. 12mm or 14mm dia of Gas pump Piston rod,\r\nHigh Durability and Hardness,\r\nDifferent load capacity of gas pump for same Frame,\r\nLong Life,\r\n\r\nHeavy pneumatic gas pump,\r\nOil incorporated for cushioning & seal lubrication\r\nEasy to install,', NULL, 1, '970639211_ZumaBedFitting4feetFrameonly.jpg,1795236816_Koala.jpg', '1501784506_Penguins.jpg,132313632_Penguins.jpg', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

CREATE TABLE `product_attribute` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `att_id` int(11) DEFAULT NULL,
  `att_name` varchar(255) DEFAULT '',
  `att_value` varchar(255) DEFAULT '',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_attribute`
--

INSERT INTO `product_attribute` (`id`, `product_id`, `att_id`, `att_name`, `att_value`, `created_at`, `updated_at`) VALUES
(2, 2, 1, '10 inch', '200', '2019-11-26 04:48:02', '2019-11-26 04:48:02'),
(3, 2, 1, '12 inch', '240', '2019-11-26 04:48:02', '2019-11-26 04:48:02'),
(4, 2, 1, '14 inch', '280', '2019-11-26 04:48:02', '2019-11-26 04:48:02'),
(5, 2, 1, '16 inch', '320', '2019-11-26 04:48:02', '2019-11-26 04:48:02'),
(6, 2, 1, '18 inch', '360', '2019-11-26 04:48:02', '2019-11-26 04:48:02'),
(7, 2, 1, '20 inch', '400', '2019-11-26 04:48:02', '2019-11-26 04:48:02'),
(8, 2, 1, '22 inch', '440', '2019-11-26 04:48:02', '2019-11-26 04:48:02'),
(14, 8, 1, '08 inch', '244', '2019-12-11 06:46:40', '2019-12-11 06:46:40'),
(15, 8, 1, '10 inch', '244', '2019-12-11 06:46:40', '2019-12-11 06:46:40'),
(16, 8, 1, '12 inch', '293', '2019-12-11 06:46:40', '2019-12-11 06:46:40'),
(17, 8, 1, '14 inch', '342', '2019-12-11 06:46:40', '2019-12-11 06:46:40'),
(18, 8, 1, '16 inch', '390', '2019-12-11 06:46:40', '2019-12-11 06:46:40'),
(19, 8, 1, '18 inch', '439', '2019-12-11 06:46:40', '2019-12-11 06:46:40'),
(20, 8, 1, '20 inch', '488', '2019-12-11 06:46:40', '2019-12-11 06:46:40'),
(21, 8, 1, '22 inch', '537', '2019-12-11 06:46:40', '2019-12-11 06:46:40'),
(22, 8, 1, '24 inch', '586', '2019-12-11 06:46:40', '2019-12-11 06:46:40'),
(23, 9, 1, '10 inch', '270', '2019-12-11 07:10:41', '2019-12-11 07:10:41'),
(24, 9, 1, '12 inch ', '324', '2019-12-11 07:10:41', '2019-12-11 07:10:41'),
(25, 9, 1, '14 inch', '378', '2019-12-11 07:10:41', '2019-12-11 07:10:41'),
(26, 9, 1, '16 inch ', '432', '2019-12-11 07:10:41', '2019-12-11 07:10:41'),
(27, 9, 1, '18 inch', '486', '2019-12-11 07:10:41', '2019-12-11 07:10:41'),
(28, 9, 1, '20 inch', '540', '2019-12-11 07:10:41', '2019-12-11 07:10:41'),
(29, 9, 1, '22 inch', '594', '2019-12-11 07:10:41', '2019-12-11 07:10:41'),
(30, 9, 1, '24 inch ', '648', '2019-12-11 07:10:41', '2019-12-11 07:10:41'),
(31, 10, 1, '20 inch', '780', '2019-12-11 07:24:36', '2019-12-11 07:24:36'),
(32, 10, 1, '22 inch', '858', '2019-12-11 07:24:36', '2019-12-11 07:24:36'),
(33, 11, 1, '14 inch', '1176', '2019-12-11 07:32:46', '2019-12-11 07:32:46'),
(34, 11, 1, '16 inch', '1344', '2019-12-11 07:32:46', '2019-12-11 07:32:46'),
(35, 11, 1, '18 inch', '1512', '2019-12-11 07:32:46', '2019-12-11 07:32:46'),
(36, 11, 1, '20 inch', '1680', '2019-12-11 07:32:46', '2019-12-11 07:32:46'),
(37, 11, 1, '22 inch', '1848', '2019-12-11 07:32:46', '2019-12-11 07:32:46'),
(38, 11, 1, '24 inch', '2016', '2019-12-11 07:32:46', '2019-12-11 07:32:46'),
(39, 11, 1, '26 inch', '2184', '2019-12-11 07:32:46', '2019-12-11 07:32:46'),
(40, 11, 1, '28 inch', '2352', '2019-12-11 07:32:46', '2019-12-11 07:32:46'),
(41, 11, 1, '30 inch', '2520', '2019-12-11 07:32:46', '2019-12-11 07:32:46'),
(42, 11, 1, '32 inch', '2688', '2019-12-11 07:32:46', '2019-12-11 07:32:46'),
(43, 11, 1, '34 inch', '2856', '2019-12-11 07:32:46', '2019-12-11 07:32:46'),
(44, 11, 1, '36 inch', '3024', '2019-12-11 07:32:46', '2019-12-11 07:32:46'),
(45, 11, 1, '40 inch', '3360', '2019-12-11 07:32:46', '2019-12-11 07:32:46'),
(46, 12, 1, '12 inch', '540', '2019-12-11 07:49:35', '2019-12-11 07:49:35'),
(47, 12, 1, '14 inch', '630', '2019-12-11 07:49:35', '2019-12-11 07:49:35'),
(48, 12, 1, '16 inch ', '720', '2019-12-11 07:49:35', '2019-12-11 07:49:35'),
(49, 12, 1, '18 inch', '810', '2019-12-11 07:49:35', '2019-12-11 07:49:35'),
(50, 12, 1, '20 inch', '900', '2019-12-11 07:49:35', '2019-12-11 07:49:35'),
(51, 12, 1, '22 inch', '990', '2019-12-11 07:49:35', '2019-12-11 07:49:35'),
(52, 13, 1, '12 inch', '540', '2019-12-11 08:30:11', '2019-12-11 08:30:11'),
(53, 13, 1, '14 inch', '630', '2019-12-11 08:30:11', '2019-12-11 08:30:11'),
(54, 13, 1, '16 inch', '720', '2019-12-11 08:30:11', '2019-12-11 08:30:11'),
(55, 13, 1, '18 inch', '810', '2019-12-11 08:30:11', '2019-12-11 08:30:11'),
(56, 13, 1, '20 inch', '900', '2019-12-11 08:30:11', '2019-12-11 08:30:11'),
(57, 13, 1, '22 inch', '990', '2019-12-11 08:30:11', '2019-12-11 08:30:11'),
(58, 14, 1, '16 inch', '2333', '2019-12-11 08:38:24', '2019-12-11 08:38:24'),
(59, 14, 1, '18 inch', '2500', '2019-12-11 08:38:24', '2019-12-11 08:38:24'),
(60, 14, 1, '20 inch', '2666', '2019-12-11 08:38:24', '2019-12-11 08:38:24'),
(61, 14, 1, '22 inch', '2833', '2019-12-11 08:38:24', '2019-12-11 08:38:24'),
(62, 15, 1, '14 inch/ 84mm', '2750', '2019-12-11 09:00:36', '2019-12-11 09:00:36'),
(63, 15, 1, '14 inch/ 116mm', '3170', '2019-12-11 09:00:36', '2019-12-11 09:00:36'),
(64, 15, 1, '14 inch/ 167mm', '3650', '2019-12-11 09:00:36', '2019-12-11 09:00:36'),
(65, 15, 1, '14 inch/ 199mm', '3940', '2019-12-11 09:00:36', '2019-12-11 09:00:36'),
(66, 15, 1, '16 inch/ 84mm', '2920', '2019-12-11 09:00:36', '2019-12-11 09:00:36'),
(67, 15, 1, '16 inch/ 116mm', '3390', '2019-12-11 09:00:36', '2019-12-11 09:00:36'),
(68, 15, 1, '16 inch/ 167mm', '3870', '2019-12-11 09:00:36', '2019-12-11 09:00:36'),
(69, 15, 1, '16 inch/ 199mm', '4040', '2019-12-11 09:00:36', '2019-12-11 09:00:36'),
(70, 15, 1, '18 inch/ 84mm', '3050', '2019-12-11 09:00:36', '2019-12-11 09:00:36'),
(71, 15, 1, '18 inch/ 116mm', '3560', '2019-12-11 09:00:36', '2019-12-11 09:00:36'),
(72, 15, 1, '18 inch/ 167mm', '4040', '2019-12-11 09:00:36', '2019-12-11 09:00:36'),
(73, 15, 1, '18 inch/ 199mm', '4210', '2019-12-11 09:00:36', '2019-12-11 09:00:36'),
(74, 15, 1, '20 inch/ 84mm', '3240', '2019-12-11 09:00:37', '2019-12-11 09:00:37'),
(75, 15, 1, '20 inch/ 116mm', '3700', '2019-12-11 09:00:37', '2019-12-11 09:00:37'),
(76, 15, 1, '20 inch/ 167mm', '4160', '2019-12-11 09:00:37', '2019-12-11 09:00:37'),
(77, 15, 1, '20 inch/ 199mm', '4410', '2019-12-11 09:00:37', '2019-12-11 09:00:37'),
(78, 15, 1, '22 inch/ 84mm', '3390', '2019-12-11 09:00:37', '2019-12-11 09:00:37'),
(79, 15, 1, '22 inch/ 116mm', '3830', '2019-12-11 09:00:37', '2019-12-11 09:00:37'),
(80, 15, 1, '22 inch/ 167mm', '4410', '2019-12-11 09:00:37', '2019-12-11 09:00:37'),
(81, 15, 1, '22 inch/ 199mm', '4720', '2019-12-11 09:00:37', '2019-12-11 09:00:37'),
(82, 16, 3, '05 kg', '271', '2019-12-12 06:54:45', '2019-12-12 06:54:45'),
(83, 16, 3, '10 kg ', '271', '2019-12-12 06:54:45', '2019-12-12 06:54:45'),
(84, 16, 3, '15 kg', '271', '2019-12-12 06:54:45', '2019-12-12 06:54:45'),
(85, 16, 3, '20 kg', '271', '2019-12-12 06:54:45', '2019-12-12 06:54:45'),
(86, 16, 3, '25 kg', '271', '2019-12-12 06:54:45', '2019-12-12 06:54:45'),
(87, 17, 1, '400-450mm', '1140', '2019-12-12 11:50:17', '2019-12-12 11:50:17'),
(88, 17, 1, '490-520mm', '1575', '2019-12-12 11:50:17', '2019-12-12 11:50:17'),
(89, 17, 1, '690-800mm', '2025', '2019-12-12 11:50:17', '2019-12-12 11:50:17'),
(90, 17, 1, 'Extension 200mm', '720', '2019-12-12 11:50:17', '2019-12-12 11:50:17'),
(91, 18, 1, '480mm - 14 to 22 inch', '2100', '2019-12-13 04:09:47', '2019-12-13 04:09:47'),
(92, 18, 1, '480mm - 22 to 30 inch', '2500', '2019-12-13 04:09:47', '2019-12-13 04:09:47'),
(93, 18, 1, '520mm - 14 to 22 inch', '2100', '2019-12-13 04:09:47', '2019-12-13 04:09:47'),
(94, 18, 1, '520mm - 22 to 30 inch', '2500', '2019-12-13 04:09:47', '2019-12-13 04:09:47'),
(95, 19, 3, '05 kg', '625', '2019-12-13 04:46:26', '2019-12-13 04:46:26'),
(96, 19, 3, '10 kg', '625', '2019-12-13 04:46:26', '2019-12-13 04:46:26'),
(97, 19, 3, '15 kg', '625', '2019-12-13 04:46:26', '2019-12-13 04:46:26'),
(98, 19, 3, '20 kg', '625', '2019-12-13 04:46:26', '2019-12-13 04:46:26'),
(99, 19, 3, '25 kg', '625', '2019-12-13 04:46:26', '2019-12-13 04:46:26'),
(100, 19, 3, '30 kg', '625', '2019-12-13 04:46:26', '2019-12-13 04:46:26'),
(101, 19, 3, '35 kg', '625', '2019-12-13 04:46:26', '2019-12-13 04:46:26'),
(102, 19, 3, '45 kg', '625', '2019-12-13 04:46:26', '2019-12-13 04:46:26'),
(103, 19, 3, '50 kg', '625', '2019-12-13 04:46:26', '2019-12-13 04:46:26'),
(104, 20, 3, '15 kg', '730', '2019-12-13 07:08:45', '2019-12-13 07:08:45'),
(105, 20, 3, '20 kg', '730', '2019-12-13 07:08:45', '2019-12-13 07:08:45'),
(106, 20, 3, '25 kg', '730', '2019-12-13 07:08:45', '2019-12-13 07:08:45'),
(107, 20, 3, '30 kg', '730', '2019-12-13 07:08:45', '2019-12-13 07:08:45'),
(108, 20, 3, '35 kg', '730', '2019-12-13 07:08:45', '2019-12-13 07:08:45'),
(109, 20, 3, '40 kg', '730', '2019-12-13 07:08:45', '2019-12-13 07:08:45'),
(110, 20, 3, '45 kg', '730', '2019-12-13 07:08:45', '2019-12-13 07:08:45'),
(111, 20, 3, '50 kg', '730', '2019-12-13 07:08:45', '2019-12-13 07:08:45'),
(112, 21, 3, '50 kg', '1300', '2019-12-13 07:16:21', '2019-12-13 07:16:21'),
(113, 21, 3, '75 kg ', '1300', '2019-12-13 07:16:21', '2019-12-13 07:16:21'),
(114, 21, 3, '100 kg ', '1300', '2019-12-13 07:16:21', '2019-12-13 07:16:21'),
(115, 21, 3, '125 kg', '1300', '2019-12-13 07:16:21', '2019-12-13 07:16:21'),
(116, 21, 3, '150 kg ', '1300', '2019-12-13 07:16:21', '2019-12-13 07:16:21'),
(117, 22, 3, '4 kg', '1410', '2019-12-13 07:35:04', '2019-12-13 07:35:04'),
(118, 23, 3, '7-8 kg', '6480', '2019-12-13 07:47:48', '2019-12-13 07:47:48'),
(119, 23, 3, '8-9 kg', '6480', '2019-12-13 07:47:48', '2019-12-13 07:47:48'),
(120, 24, 1, '600mm', '23700', '2019-12-13 10:39:58', '2019-12-13 10:39:58'),
(121, 25, 4, 'Soft Close', '9167', '2019-12-14 04:31:53', '2019-12-14 04:31:53'),
(122, 25, 4, 'Normal', '7340', '2019-12-14 04:31:53', '2019-12-14 04:31:53'),
(123, 26, 4, 'Expandable', '9625', '2019-12-14 06:44:08', '2019-12-14 06:44:08'),
(124, 27, 4, 'Lift Up', '1925', '2019-12-14 07:09:37', '2019-12-14 07:09:37'),
(125, 28, 3, '60 kg', '10400', '2019-12-14 07:23:37', '2019-12-14 07:23:37'),
(126, 28, 3, '100 kg ', '24100', '2019-12-14 07:23:37', '2019-12-14 07:23:37'),
(127, 29, 1, '24 inch', '3888', '2019-12-14 07:30:10', '2019-12-14 07:30:10'),
(128, 29, 1, '30 inch', '5250', '2019-12-14 07:30:10', '2019-12-14 07:30:10'),
(129, 29, 1, '36 inch', '5833', '2019-12-14 07:30:10', '2019-12-14 07:30:10'),
(130, 29, 1, '48 inch', '7590', '2019-12-14 07:30:10', '2019-12-14 07:30:10'),
(131, 29, 1, '60 inch', '8747', '2019-12-14 07:30:10', '2019-12-14 07:30:10'),
(132, 30, 1, '12 inch', '906', '2019-12-14 07:33:51', '2019-12-14 07:33:51'),
(133, 30, 1, '16 inch', '1046', '2019-12-14 07:33:51', '2019-12-14 07:33:51'),
(134, 30, 1, '20 inch', '1248', '2019-12-14 07:33:51', '2019-12-14 07:33:51'),
(135, 31, 1, '300mm-450mm', '836', '2019-12-14 07:41:26', '2019-12-14 07:41:26'),
(136, 32, 1, '0 Crank', '85', '2019-12-14 13:46:52', '2019-12-14 13:46:52'),
(137, 32, 1, '8 Crank', '85', '2019-12-14 13:46:52', '2019-12-14 13:46:52'),
(138, 32, 1, '16 Crank', '85', '2019-12-14 13:46:52', '2019-12-14 13:46:52'),
(139, 33, 1, '0 Crank', '180', '2019-12-16 04:29:32', '2019-12-16 04:29:32'),
(140, 33, 1, '8 Crank', '180', '2019-12-16 04:29:32', '2019-12-16 04:29:32'),
(141, 33, 1, '16 Crank', '180', '2019-12-16 04:29:32', '2019-12-16 04:29:32'),
(142, 34, 1, '0 Crank', '194', '2019-12-16 04:50:27', '2019-12-16 04:50:27'),
(143, 34, 1, '8 Crank', '194', '2019-12-16 04:50:27', '2019-12-16 04:50:27'),
(144, 34, 1, '16 Crank ', '194', '2019-12-16 04:50:27', '2019-12-16 04:50:27'),
(145, 35, 1, '90 Crank', '110', '2019-12-16 06:20:22', '2019-12-16 06:20:22'),
(146, 36, 1, '135 Crank', '160', '2019-12-16 06:44:03', '2019-12-16 06:44:03'),
(147, 37, 1, '165 Crank', '290', '2019-12-16 06:54:08', '2019-12-16 06:54:08'),
(148, 38, 1, '0 Crank ', '258', '2019-12-16 07:11:36', '2019-12-16 07:11:36'),
(149, 38, 1, '8 Crank ', '258', '2019-12-16 07:11:36', '2019-12-16 07:11:36'),
(150, 38, 1, '16 Crank', '258', '2019-12-16 07:11:36', '2019-12-16 07:11:36'),
(151, 39, 1, '0 Crank', '265', '2019-12-16 07:33:52', '2019-12-16 07:33:52'),
(152, 39, 1, '8 Crank', '265', '2019-12-16 07:33:52', '2019-12-16 07:33:52'),
(153, 39, 1, '16 Crank', '265', '2019-12-16 07:33:52', '2019-12-16 07:33:52'),
(154, 40, 1, '0 Crank', '458', '2019-12-17 06:53:31', '2019-12-17 06:53:31'),
(155, 40, 1, '8 Crank', '458', '2019-12-17 06:53:31', '2019-12-17 06:53:31'),
(156, 41, 1, '4585 / SS Finish', '740', '2019-12-17 07:17:15', '2019-12-17 07:17:15'),
(157, 41, 1, '6085 / SS Finish', '915', '2019-12-17 07:17:15', '2019-12-17 07:17:15'),
(158, 41, 1, '4585 / Antique Finish', '840', '2019-12-17 07:17:15', '2019-12-17 07:17:15'),
(159, 41, 1, '6085 / Antique Finish ', '1000', '2019-12-17 07:17:15', '2019-12-17 07:17:15'),
(160, 41, 1, '4585 / Black Finish ', '875', '2019-12-17 07:17:15', '2019-12-17 07:17:15'),
(161, 41, 1, '6085 / Black Finish', '1035', '2019-12-17 07:17:15', '2019-12-17 07:17:15'),
(162, 41, 1, '4585 / Rose Gold Finish', '1005', '2019-12-17 07:17:15', '2019-12-17 07:17:15'),
(163, 41, 1, '6085 / Rose Gold Finish', '1165', '2019-12-17 07:17:15', '2019-12-17 07:17:15'),
(164, 42, 2, 'SS Finish ', '570', '2019-12-19 04:26:49', '2019-12-19 04:26:49'),
(165, 42, 2, 'Antique Finish', '670', '2019-12-19 04:26:49', '2019-12-19 04:26:49'),
(166, 42, 2, 'Black Finish', '700', '2019-12-19 04:26:49', '2019-12-19 04:26:49'),
(167, 42, 2, 'Rose Gold Finish', '830', '2019-12-19 04:26:49', '2019-12-19 04:26:49'),
(168, 43, 2, '45mm / SS Finish', '420', '2019-12-19 04:37:35', '2019-12-19 04:37:35'),
(169, 43, 2, '60mm / SS Finish ', '482', '2019-12-19 04:37:35', '2019-12-19 04:37:35'),
(170, 43, 2, '45mm / Antique Finish ', '490', '2019-12-19 04:37:35', '2019-12-19 04:37:35'),
(171, 43, 2, '45mm / Black Finish ', '520', '2019-12-19 04:37:35', '2019-12-19 04:37:35'),
(172, 43, 2, '45mm / Rose Gold Finish', '640', '2019-12-19 04:37:35', '2019-12-19 04:37:35'),
(173, 44, 1, '45mm', '705', '2019-12-19 04:47:13', '2019-12-19 04:47:13'),
(174, 45, 4, '5 Star Key ', '925', '2019-12-19 05:25:56', '2019-12-19 05:25:56'),
(175, 46, 1, '4585', '865', '2019-12-19 05:31:04', '2019-12-19 05:31:04'),
(176, 46, 1, '6085', '970', '2019-12-19 05:31:04', '2019-12-19 05:31:04'),
(177, 47, 1, '55mm', '750', '2019-12-19 06:50:22', '2019-12-19 06:50:22'),
(178, 48, 1, '55mm', '720', '2019-12-19 06:59:05', '2019-12-19 06:59:05'),
(179, 49, 1, '4585', '1050', '2019-12-19 07:04:26', '2019-12-19 07:04:26'),
(180, 49, 1, '6085', '1165', '2019-12-19 07:04:26', '2019-12-19 07:04:26'),
(181, 50, 1, '4585', '1060', '2019-12-19 07:14:55', '2019-12-19 07:14:55'),
(182, 50, 1, '6085', '1165', '2019-12-19 07:14:55', '2019-12-19 07:14:55'),
(183, 51, 1, '60mm', '650', '2019-12-19 07:25:42', '2019-12-19 07:25:42'),
(184, 51, 1, '70mm', '680', '2019-12-19 07:25:42', '2019-12-19 07:25:42'),
(185, 51, 1, '80mm', '730', '2019-12-19 07:25:42', '2019-12-19 07:25:42'),
(186, 52, 1, '60mm / SS Finish', '966', '2019-12-19 08:13:40', '2019-12-19 08:13:40'),
(187, 52, 1, '70mm / SS Finish', '1035', '2019-12-19 08:13:40', '2019-12-19 08:13:40'),
(188, 52, 1, '80mm / SS Finish', '1085', '2019-12-19 08:13:40', '2019-12-19 08:13:40'),
(189, 52, 1, '90mm / SS Finish', '1155', '2019-12-19 08:13:40', '2019-12-19 08:13:40'),
(190, 52, 1, '100mm / SS Finish', '1300', '2019-12-19 08:13:40', '2019-12-19 08:13:40'),
(191, 52, 1, '120mm / SS Finish', '1415', '2019-12-19 08:13:40', '2019-12-19 08:13:40'),
(192, 52, 1, '60mm / CP Finish', '980', '2019-12-19 08:13:40', '2019-12-19 08:13:40'),
(193, 52, 1, '70mm / CP Finish ', '1050', '2019-12-19 08:13:40', '2019-12-19 08:13:40'),
(194, 52, 1, '80mm / CP Finish', '1100', '2019-12-19 08:13:40', '2019-12-19 08:13:40'),
(195, 52, 1, '60mm / Antique', '990', '2019-12-19 08:13:40', '2019-12-19 08:13:40'),
(196, 52, 1, '70mm / Antique', '1060', '2019-12-19 08:13:40', '2019-12-19 08:13:40'),
(197, 52, 1, '80mm / Antique ', '1110', '2019-12-19 08:13:40', '2019-12-19 08:13:40'),
(198, 52, 1, '60mm / Black', '990', '2019-12-19 08:13:40', '2019-12-19 08:13:40'),
(199, 52, 1, '70mm / Black', '1060', '2019-12-19 08:13:40', '2019-12-19 08:13:40'),
(200, 52, 1, '80mm / Black', '1110', '2019-12-19 08:13:40', '2019-12-19 08:13:40'),
(201, 52, 1, '60mm / Rose Gold', '1060', '2019-12-19 08:13:40', '2019-12-19 08:13:40'),
(202, 52, 1, '70mm / Rose Gold ', '1130', '2019-12-19 08:13:40', '2019-12-19 08:13:40'),
(203, 52, 1, '80mm / Rose Gold ', '1180', '2019-12-19 08:13:40', '2019-12-19 08:13:40'),
(204, 53, 1, '60mm /  SS Finish', '795', '2019-12-19 08:53:50', '2019-12-19 08:53:50'),
(205, 53, 1, '70mm / SS Finish', '865', '2019-12-19 08:53:50', '2019-12-19 08:53:50'),
(206, 53, 1, '80mm / SS Finish', '935', '2019-12-19 08:53:50', '2019-12-19 08:53:50'),
(207, 53, 1, '60mm / CP Finish', '810', '2019-12-19 08:53:50', '2019-12-19 08:53:50'),
(208, 53, 1, '70mm / CP Finish', '880', '2019-12-19 08:53:50', '2019-12-19 08:53:50'),
(209, 53, 1, '80mm / CP Finish', '950', '2019-12-19 08:53:50', '2019-12-19 08:53:50'),
(210, 53, 1, '60mm / Antique', '820', '2019-12-19 08:53:50', '2019-12-19 08:53:50'),
(211, 53, 1, '70mm / Antique', '890', '2019-12-19 08:53:50', '2019-12-19 08:53:50'),
(212, 53, 1, '80mm / Antique', '960', '2019-12-19 08:53:50', '2019-12-19 08:53:50'),
(213, 53, 1, '60mm / Black', '820', '2019-12-19 08:53:50', '2019-12-19 08:53:50'),
(214, 53, 1, '70mm / Black', '890', '2019-12-19 08:53:50', '2019-12-19 08:53:50'),
(215, 53, 1, '80mm / Black', '960', '2019-12-19 08:53:50', '2019-12-19 08:53:50'),
(216, 53, 1, '60mm / Rose Gold', '870', '2019-12-19 08:53:50', '2019-12-19 08:53:50'),
(217, 53, 1, '70mm / Rose Gold ', '940', '2019-12-19 08:53:50', '2019-12-19 08:53:50'),
(218, 53, 1, '80mm / Rose Gold ', '1010', '2019-12-19 08:53:50', '2019-12-19 08:53:50'),
(219, 54, 1, '45mm / SS Finish', '695', '2019-12-19 09:00:27', '2019-12-19 09:00:27'),
(220, 54, 1, '50mm / SS Finish', '745', '2019-12-19 09:00:27', '2019-12-19 09:00:27'),
(221, 54, 1, '45mm / CP Finish', '710', '2019-12-19 09:00:27', '2019-12-19 09:00:27'),
(222, 54, 1, '45mm / Anique Finish', '720', '2019-12-19 09:00:27', '2019-12-19 09:00:27'),
(223, 54, 1, '45mm / Black Finish', '720', '2019-12-19 09:00:27', '2019-12-19 09:00:27'),
(224, 54, 1, '45mm / Rose Gold Finish', '770', '2019-12-19 09:00:27', '2019-12-19 09:00:27'),
(225, 55, 1, '45mm /  SS Finish', '760', '2019-12-19 09:07:02', '2019-12-19 09:07:02'),
(226, 55, 1, '45mm / Antique Finish', '775', '2019-12-19 09:07:02', '2019-12-19 09:07:02'),
(227, 55, 1, '45mm / Black Finish', '785', '2019-12-19 09:07:02', '2019-12-19 09:07:02'),
(228, 55, 1, '45mm / Rose Gold Finish', '825', '2019-12-19 09:07:02', '2019-12-19 09:07:02'),
(229, 56, 1, '70mm / SS Finish', '965', '2019-12-20 05:05:25', '2019-12-20 05:05:25'),
(230, 56, 1, '80mm / SS Finish', '1035', '2019-12-20 05:05:25', '2019-12-20 05:05:25'),
(231, 57, 1, '70mm / SS Finish', '1270', '2019-12-20 05:13:16', '2019-12-20 05:13:16'),
(232, 57, 1, '80mm / SS Finish', '1340', '2019-12-20 05:13:16', '2019-12-20 05:13:16'),
(233, 58, 1, '21mm', '248', '2019-12-20 05:58:56', '2019-12-20 05:58:56'),
(234, 59, 1, '22mm', '140', '2019-12-20 06:03:12', '2019-12-20 06:03:12'),
(235, 59, 1, '32mm', '185', '2019-12-20 06:03:12', '2019-12-20 06:03:12'),
(236, 60, 1, 'Taiwan Big', '1036', '2019-12-20 06:09:58', '2019-12-20 06:09:58'),
(237, 61, 1, 'Small', '600', '2019-12-20 06:29:42', '2019-12-20 06:29:42'),
(238, 62, 4, 'Universal', '560', '2019-12-20 07:00:26', '2019-12-20 07:00:26'),
(239, 63, 4, 'Key to Knob / SS Finish', '740', '2019-12-20 07:14:03', '2019-12-20 07:14:03'),
(240, 63, 4, 'Keyless Knob / SS Finish', '640', '2019-12-20 07:14:03', '2019-12-20 07:14:03'),
(241, 64, 4, 'Single Track Runner', '208', '2019-12-20 07:20:18', '2019-12-20 07:20:18'),
(242, 65, 4, 'Single U-Type Track Runner', '208', '2019-12-20 07:25:59', '2019-12-20 07:25:59'),
(243, 66, 4, 'Bearing', '352', '2019-12-20 07:30:25', '2019-12-20 07:30:25'),
(244, 67, 4, 'Soft Close', '815', '2019-12-20 07:35:15', '2019-12-20 07:35:15'),
(245, 68, 4, '4 Wheel Runner', '797', '2019-12-20 07:43:44', '2019-12-20 07:43:44'),
(246, 69, 4, '8 Wheel Runner ', '1289', '2019-12-20 07:47:25', '2019-12-20 07:47:25'),
(247, 70, 4, '4 Wheel- 2 Way Soft Close', '4000', '2019-12-20 07:54:17', '2019-12-20 07:54:17'),
(248, 71, 4, '8 Wheel - 2 Way Soft Close', '4370', '2019-12-20 07:57:05', '2019-12-20 07:57:05'),
(249, 72, 4, 'Brush Type', '3333', '2019-12-21 05:08:58', '2019-12-21 05:08:58'),
(250, 72, 4, 'Cross Type', '3333', '2019-12-21 05:08:58', '2019-12-21 05:08:58'),
(251, 73, 5, 'Glass Runner 8 Wheel Set - Big', '4170', '2019-12-21 05:36:26', '2019-12-21 05:36:26'),
(252, 73, 5, 'Floor Guide for Sliding Glass', '445', '2019-12-21 05:36:26', '2019-12-21 05:36:26'),
(253, 73, 5, 'Stopper - Track Mounting', '335', '2019-12-21 05:36:26', '2019-12-21 05:36:26'),
(254, 73, 5, 'Stopper - Track Mounting ', '300', '2019-12-21 05:36:26', '2019-12-21 05:36:26'),
(255, 73, 5, 'Glass Track Fixer', '385', '2019-12-21 05:36:26', '2019-12-21 05:36:26'),
(256, 74, 5, 'Glass Runner 4 Wheel Set - Big', '3630', '2019-12-21 05:51:42', '2019-12-21 05:51:42'),
(257, 74, 5, 'Floor Guide for Sliding Glass', '445', '2019-12-21 05:51:42', '2019-12-21 05:51:42'),
(258, 74, 5, 'Stopper - Track Mounting ', '335', '2019-12-21 05:51:42', '2019-12-21 05:51:42'),
(259, 74, 5, 'Stopper - Floor Mounting', '300', '2019-12-21 05:51:42', '2019-12-21 05:51:42'),
(260, 74, 5, 'Glass Track Fixer', '385', '2019-12-21 05:51:42', '2019-12-21 05:51:42'),
(261, 75, 4, 'Glass Runner 8 Wheel Set - Soft Close', '7740', '2019-12-21 06:02:57', '2019-12-21 06:07:46'),
(262, 76, 4, 'Glass Runner 4 Wheel Set - Soft Close', '7370', '2019-12-21 06:07:20', '2019-12-21 06:07:20'),
(263, 77, 1, '8 Feet / Regular ', '424', '2019-12-21 06:40:14', '2019-12-21 06:40:14'),
(264, 77, 1, '12 Feet / Regular', '636', '2019-12-21 06:40:14', '2019-12-21 06:40:14'),
(265, 77, 1, '8 Feet / Anodize', '560', '2019-12-21 06:40:14', '2019-12-21 06:40:14'),
(266, 77, 1, '12 Feet / Anodize ', '840', '2019-12-21 06:40:14', '2019-12-21 06:40:14'),
(267, 78, 1, '8 Feet / Regular', '624', '2019-12-21 06:49:18', '2019-12-21 06:49:18'),
(268, 78, 1, '12 Feet / Regular', '936', '2019-12-21 06:49:18', '2019-12-21 06:49:18'),
(269, 78, 1, '8 Feet / Anodize ', '768', '2019-12-21 06:49:18', '2019-12-21 06:49:18'),
(270, 78, 1, '12 Feet / Anodize ', '1152', '2019-12-21 06:49:18', '2019-12-21 06:49:18'),
(271, 79, 1, '12 Feet / Regular', '348', '2019-12-21 07:05:56', '2019-12-21 07:05:56'),
(272, 79, 1, '12 Feet / Anodize', '552', '2019-12-21 07:05:56', '2019-12-21 07:05:56'),
(273, 80, 1, '6 Feet / Regular', '1008', '2019-12-21 07:15:36', '2019-12-21 07:15:36'),
(274, 80, 1, '6.5 Feet / Regular', '1092', '2019-12-21 07:15:36', '2019-12-21 07:15:36'),
(275, 80, 1, '8 Feet / Regular', '1344', '2019-12-21 07:15:36', '2019-12-21 07:15:36'),
(276, 80, 1, '10 Feet / Regular', '1680', '2019-12-21 07:15:36', '2019-12-21 07:15:36'),
(277, 80, 1, '12 Feet / Regular', '2016', '2019-12-21 07:15:36', '2019-12-21 07:15:36'),
(278, 80, 1, '6 Feet / Anodize', '1110', '2019-12-21 07:15:36', '2019-12-21 07:15:36'),
(279, 80, 1, '6.5 Feet / Anodize', '1203', '2019-12-21 07:15:36', '2019-12-21 07:15:36'),
(280, 80, 1, '8 Feet / Anodize', '1480', '2019-12-21 07:15:36', '2019-12-21 07:15:36'),
(281, 80, 1, '10 Feet / Anodize', '1850', '2019-12-21 07:15:36', '2019-12-21 07:15:36'),
(282, 80, 1, '12 Feet / Anodize', '2220', '2019-12-21 07:15:36', '2019-12-21 07:15:36'),
(283, 81, 1, '8 Feet / Regular', '224', '2019-12-21 07:19:36', '2019-12-21 07:19:36'),
(284, 81, 1, '12 Feet / Regular', '336', '2019-12-21 07:19:36', '2019-12-21 07:19:36'),
(285, 81, 1, '8 Feet / Anodize ', '312', '2019-12-21 07:19:36', '2019-12-21 07:19:36'),
(286, 81, 1, '12 Feet / Anodize', '468', '2019-12-21 07:19:36', '2019-12-21 07:19:36'),
(287, 82, 1, '6 Feet / Regular', '762', '2019-12-21 07:26:49', '2019-12-21 07:26:49'),
(288, 82, 1, '6.5 Feet / Regular', '826', '2019-12-21 07:26:49', '2019-12-21 07:26:49'),
(289, 82, 1, '8 Feet / Regular', '1016', '2019-12-21 07:26:49', '2019-12-21 07:26:49'),
(290, 82, 1, '10 Feet / Regular', '1270', '2019-12-21 07:26:49', '2019-12-21 07:26:49'),
(291, 82, 1, '12 Feet / Regular', '1524', '2019-12-21 07:26:49', '2019-12-21 07:26:49'),
(292, 82, 1, '6 Feet / Anodize', '858', '2019-12-21 07:26:49', '2019-12-21 07:26:49'),
(293, 82, 1, '6.5 Feet / Anodize', '930', '2019-12-21 07:26:49', '2019-12-21 07:26:49'),
(294, 82, 1, '8 Feet / Anodize', '1144', '2019-12-21 07:26:49', '2019-12-21 07:26:49'),
(295, 82, 1, '10 Feet / Anodize', '1430', '2019-12-21 07:26:49', '2019-12-21 07:26:49'),
(296, 82, 1, '12 Feet / Anodize', '1716', '2019-12-21 07:26:49', '2019-12-21 07:26:49'),
(298, 83, 1, '6 Feet / Regular', '1062', '2019-12-21 07:35:28', '2019-12-21 07:35:28'),
(299, 83, 1, '6.5 Feet / Regular', '1151', '2019-12-21 07:35:28', '2019-12-21 07:35:28'),
(300, 83, 1, '8 Feet / Regular', '1416', '2019-12-21 07:35:28', '2019-12-21 07:35:28'),
(301, 83, 1, '10 Feet / Regular', '1770', '2019-12-21 07:35:28', '2019-12-21 07:35:28'),
(302, 83, 1, '12 Feet / Regular', '21124', '2019-12-21 07:35:28', '2019-12-21 07:35:28'),
(303, 83, 1, '6 Feet / Anodize', '1170', '2019-12-21 07:35:28', '2019-12-21 07:35:28'),
(304, 83, 1, '6.5 Feet / Anodize', '1268', '2019-12-21 07:35:28', '2019-12-21 07:35:28'),
(305, 83, 1, '8 Feet / Anodize', '1560', '2019-12-21 07:35:28', '2019-12-21 07:35:28'),
(306, 83, 1, '10 Feet / Anodize', '1950', '2019-12-21 07:35:28', '2019-12-21 07:35:28'),
(307, 83, 1, '12 Feet / Anodize', '2340', '2019-12-21 07:35:28', '2019-12-21 07:35:28'),
(308, 84, 1, '6 Feet / Anodize', '1375', '2019-12-21 07:40:21', '2019-12-21 07:40:21'),
(309, 84, 1, '8 Feet / Anodize ', '1833', '2019-12-21 07:40:21', '2019-12-21 07:40:21'),
(310, 84, 1, '10 Feet / Anodize', '2292', '2019-12-21 07:40:21', '2019-12-21 07:40:21'),
(311, 84, 1, '12 Feet / Anodize', '2750', '2019-12-21 07:40:21', '2019-12-21 07:40:21'),
(312, 85, 1, '6 Feet / Anodize ', '1375', '2019-12-21 07:46:37', '2019-12-21 07:46:37'),
(313, 85, 1, '8 Feet / Anodize', '1833', '2019-12-21 07:46:37', '2019-12-21 07:46:37'),
(314, 85, 1, '10 Feet / Anodize', '2292', '2019-12-21 07:46:37', '2019-12-21 07:46:37'),
(315, 85, 1, '12 Feet / Anodize', '2750', '2019-12-21 07:46:37', '2019-12-21 07:46:37'),
(316, 86, 1, '6 Feet', '1560', '2019-12-22 07:40:48', '2019-12-22 07:40:48'),
(317, 86, 1, '8 Feet', '2080', '2019-12-22 07:40:48', '2019-12-22 07:40:48'),
(318, 86, 1, '10 Feet ', '2600', '2019-12-22 07:40:48', '2019-12-22 07:40:48'),
(319, 86, 1, '12 Feet', '3120', '2019-12-22 07:40:48', '2019-12-22 07:40:48'),
(320, 87, 1, '6 Feet / Anodize', '1950', '2019-12-22 08:01:36', '2019-12-22 08:01:36'),
(321, 87, 1, '8 Feet / Anodize', '2600', '2019-12-22 08:01:36', '2019-12-22 08:01:36'),
(322, 87, 1, '10 Feet / Anodize', '3250', '2019-12-22 08:01:36', '2019-12-22 08:01:36'),
(323, 87, 1, '12 Feet / Anodize', '3900', '2019-12-22 08:01:36', '2019-12-22 08:01:36'),
(324, 88, 1, '6 Feet / Anodize', '2670', '2019-12-22 08:05:00', '2019-12-22 08:05:00'),
(325, 88, 1, '8 Feet / Anodize', '3560', '2019-12-22 08:05:00', '2019-12-22 08:05:00'),
(326, 88, 1, '10 Feet / Anodize', '4450', '2019-12-22 08:05:00', '2019-12-22 08:05:00'),
(327, 88, 1, '12 Feet / Anodize', '5340', '2019-12-22 08:05:00', '2019-12-22 08:05:00'),
(328, 89, 4, 'Non Hold Open', '1250', '2019-12-22 08:18:31', '2019-12-22 08:25:59'),
(329, 89, 4, 'Hold Open', '1250', '2019-12-22 08:18:31', '2019-12-22 08:26:08'),
(330, 90, 4, 'Non Hold Open', '1460', '2019-12-22 08:25:42', '2019-12-22 08:25:42'),
(331, 90, 4, 'Hold Open', '1460', '2019-12-22 08:25:42', '2019-12-22 08:25:42'),
(332, 91, 4, 'Non Hold Open', '1865', '2019-12-22 08:33:00', '2019-12-22 08:33:00'),
(333, 91, 4, 'Hold Open', '1865', '2019-12-22 08:33:00', '2019-12-22 08:33:00'),
(334, 92, 4, 'Hold Open', '2333', '2019-12-22 08:39:45', '2019-12-22 08:39:45'),
(335, 93, 4, 'Hold Open ', '3830', '2019-12-22 08:48:41', '2019-12-22 08:48:41'),
(336, 94, 1, '80 Kg to 100 Kg', '3290', '2019-12-22 09:28:26', '2019-12-22 09:28:26'),
(337, 94, 1, '120 Kg to 150 Kg', '5150', '2019-12-22 09:28:26', '2019-12-22 09:28:26'),
(338, 95, 5, 'Zuma Top Patch', '1050', '2019-12-22 09:39:51', '2019-12-22 09:39:51'),
(339, 96, 5, 'Zuma Bottom Patch', '1050', '2019-12-22 09:48:25', '2019-12-22 09:48:25'),
(340, 97, 5, 'Zuma Pivot', '220', '2019-12-22 09:55:05', '2019-12-22 09:55:05'),
(341, 98, 5, 'Zuma Over Panel Pivot', '1170', '2019-12-22 10:09:49', '2019-12-22 10:09:49'),
(342, 99, 5, 'Zuma Over Panel Pivot With Plate', '1170', '2019-12-22 10:21:39', '2019-12-22 10:21:39'),
(343, 100, 4, 'Glass to Wall Lock', '1590', '2019-12-23 05:26:59', '2019-12-23 05:26:59'),
(344, 101, 5, 'Zuma Over Panel Corner L Pivot', '1660', '2019-12-23 05:49:25', '2019-12-23 05:49:25'),
(345, 102, 5, 'Zuma Corner Patch', '985', '2019-12-23 06:07:29', '2019-12-23 06:07:29'),
(346, 103, 5, 'Zuma Patch Lock', '2240', '2019-12-23 06:17:37', '2019-12-23 06:17:37'),
(347, 104, 5, 'Zuma Strike Box', '885', '2019-12-23 06:19:49', '2019-12-23 06:19:49'),
(348, 105, 5, 'Zuma Over Panel Strike Box L Patch', '1560', '2019-12-23 06:38:50', '2019-12-23 06:38:50'),
(349, 106, 1, 'D Seal 12mm - 8 Feet', '220', '2019-12-23 06:48:51', '2019-12-23 06:48:51'),
(350, 107, 1, 'H Seal 12mm - 8 Feet ', '220', '2019-12-23 07:26:22', '2019-12-23 07:26:22'),
(351, 108, 5, 'Glass to Glass Lock', '1300', '2019-12-23 07:31:12', '2019-12-23 07:31:12'),
(352, 109, 5, 'Zuma Glass to Wood Lock', '1150', '2019-12-24 15:47:47', '2019-12-24 15:47:47'),
(353, 110, 5, 'Handle Lock', '17970', '2019-12-24 15:58:40', '2019-12-24 15:58:40'),
(354, 111, 4, 'Glass to Glass Lock', '1920', '2019-12-24 16:23:18', '2019-12-24 16:40:25'),
(355, 112, 4, 'Glass to Wall Lock', '1640', '2019-12-24 16:29:57', '2019-12-24 16:42:09'),
(356, 113, 4, 'Glass to Glass Lock', '1530', '2019-12-24 16:49:45', '2019-12-24 16:49:45'),
(357, 114, 4, 'Glass to Wall Lock', '1300', '2019-12-24 16:59:18', '2019-12-24 16:59:18'),
(358, 115, 4, 'Glass to Glass Lock', '1407', '2019-12-24 17:05:19', '2019-12-24 17:05:19'),
(359, 116, 4, 'Glass to Wall Lock', '1300', '2019-12-24 17:12:50', '2019-12-24 17:12:50'),
(360, 117, 1, '0° - G to G', '210', '2019-12-24 17:55:28', '2019-12-24 17:55:28'),
(361, 117, 1, '0° - G to W', '210', '2019-12-24 17:55:28', '2019-12-24 17:55:28'),
(362, 117, 1, '90° - G to G', '310', '2019-12-24 17:55:28', '2019-12-24 17:55:28'),
(363, 117, 1, '90° - G to W', '220', '2019-12-24 17:55:28', '2019-12-24 17:55:28'),
(364, 117, 1, '135° - G to G', '310', '2019-12-24 17:55:28', '2019-12-24 17:55:28'),
(365, 117, 1, '135° - G to W', '220', '2019-12-24 17:55:28', '2019-12-24 17:55:28'),
(366, 117, 1, '180° - G to G', '310', '2019-12-24 17:55:28', '2019-12-24 17:55:28'),
(367, 117, 1, '180° - G to W', '220', '2019-12-24 17:55:28', '2019-12-24 17:55:28'),
(368, 118, 4, 'Glass to Glass Lock', '1590', '2019-12-25 09:23:13', '2019-12-25 09:43:21'),
(369, 119, 4, 'Glass to Wall Lock', '1130', '2019-12-25 09:40:29', '2019-12-25 09:40:29'),
(384, 121, 1, '200mm / Satin', '1145', '2019-12-25 10:08:52', '2019-12-25 10:08:52'),
(385, 121, 1, '250mm / Satin', '1265', '2019-12-25 10:08:52', '2019-12-25 10:08:52'),
(386, 121, 1, '300mm / Satin', '1382', '2019-12-25 10:08:52', '2019-12-25 10:08:52'),
(387, 121, 1, '450mm / Satin', '2090', '2019-12-25 10:08:52', '2019-12-25 10:08:52'),
(388, 121, 1, '600mm / Satin', '2495', '2019-12-25 10:08:52', '2019-12-25 10:08:52'),
(389, 121, 1, '200mm / Combi', '1215', '2019-12-25 10:08:52', '2019-12-25 10:08:52'),
(390, 121, 1, '250mm / Combi', '1335', '2019-12-25 10:08:52', '2019-12-25 10:08:52'),
(391, 121, 1, '300mm / Combi', '1450', '2019-12-25 10:08:52', '2019-12-25 10:08:52'),
(392, 121, 1, '450mm / Combi', '2175', '2019-12-25 10:08:52', '2019-12-25 10:08:52'),
(393, 121, 1, '600mm / Combi', '2580', '2019-12-25 10:08:52', '2019-12-25 10:08:52'),
(395, 122, 1, '200mm / Satin', '1013', '2019-12-25 10:17:14', '2019-12-25 10:17:14'),
(396, 122, 1, '250mm / Satin', '1113', '2019-12-25 10:17:14', '2019-12-25 10:17:14'),
(397, 122, 1, '300mm / Satin ', '1213', '2019-12-25 10:17:14', '2019-12-25 10:17:14'),
(398, 122, 1, '450mm / Satin', '1855', '2019-12-25 10:17:14', '2019-12-25 10:17:14'),
(399, 122, 1, '600mm / Satin', '2260', '2019-12-25 10:17:14', '2019-12-25 10:17:14'),
(400, 122, 1, '200mm / Combi', '1080', '2019-12-25 10:17:14', '2019-12-25 10:17:14'),
(401, 122, 1, '250mm / Combi', '1180', '2019-12-25 10:17:14', '2019-12-25 10:17:14'),
(402, 122, 1, '300mm / Combi', '1315', '2019-12-25 10:17:14', '2019-12-25 10:17:14'),
(403, 122, 1, '450mm / Combi', '1940', '2019-12-25 10:17:14', '2019-12-25 10:17:14'),
(404, 122, 1, '600mm / Combi', '2345', '2019-12-25 10:17:14', '2019-12-25 10:17:14'),
(406, 123, 1, '200mm / Satin', '1550', '2019-12-25 10:29:49', '2019-12-25 10:29:49'),
(407, 123, 1, '250mm / Satin', '1720', '2019-12-25 10:29:49', '2019-12-25 10:29:49'),
(408, 123, 1, '300mm / Satin', '1890', '2019-12-25 10:29:49', '2019-12-25 10:29:49'),
(409, 123, 1, '450mm / Satin', '2765', '2019-12-25 10:29:49', '2019-12-25 10:29:49'),
(410, 123, 1, '600mm / Satin', '3420', '2019-12-25 10:29:49', '2019-12-25 10:29:49'),
(411, 123, 1, '200mm / Combi', '1618', '2019-12-25 10:29:49', '2019-12-25 10:29:49'),
(412, 123, 1, '250mm / Combi', '1787', '2019-12-25 10:29:49', '2019-12-25 10:29:49'),
(413, 123, 1, '300mm / Combi', '1955', '2019-12-25 10:29:49', '2019-12-25 10:29:49'),
(414, 123, 1, '450mm / Combi', '2850', '2019-12-25 10:29:49', '2019-12-25 10:29:49'),
(415, 123, 1, '600mm / Combi', '3505', '2019-12-25 10:29:49', '2019-12-25 10:29:49'),
(416, 124, 1, '200mm / Satin ', '1180', '2019-12-25 10:40:21', '2019-12-25 10:40:21'),
(417, 124, 1, '250mm / Satin ', '1280', '2019-12-25 10:40:21', '2019-12-25 10:40:21'),
(418, 124, 1, '300mm / Satin ', '1380', '2019-12-25 10:40:21', '2019-12-25 10:40:21'),
(419, 124, 1, '450mm / Satin ', '2125', '2019-12-25 10:40:21', '2019-12-25 10:40:21'),
(420, 124, 1, '600mm / Satin ', '2525', '2019-12-25 10:40:21', '2019-12-25 10:40:21'),
(421, 124, 1, '200mm / Combi', '1248', '2019-12-25 10:40:21', '2019-12-25 10:40:21'),
(422, 124, 1, '250mm / Combi', '1348', '2019-12-25 10:40:21', '2019-12-25 10:40:21'),
(423, 124, 1, '300mm / Combi', '1448', '2019-12-25 10:40:21', '2019-12-25 10:40:21'),
(424, 124, 1, '450mm / Combi', '2191', '2019-12-25 10:40:21', '2019-12-25 10:40:21'),
(425, 124, 1, '600mm / Combi', '2611', '2019-12-25 10:40:21', '2019-12-25 10:40:21'),
(426, 125, 1, '200mm / Satin', '1550', '2019-12-25 14:01:48', '2019-12-25 14:01:48'),
(427, 125, 1, '250mm / Satin', '1685', '2019-12-25 14:01:48', '2019-12-25 14:01:48'),
(428, 125, 1, '300mm / Satin', '1820', '2019-12-25 14:01:48', '2019-12-25 14:01:48'),
(429, 125, 1, '450mm / Satin', '2225', '2019-12-25 14:01:48', '2019-12-25 14:01:48'),
(430, 125, 1, '600mm / Satin', '2630', '2019-12-25 14:01:48', '2019-12-25 14:01:48'),
(431, 125, 1, '200mm / Combi', '1620', '2019-12-25 14:01:48', '2019-12-25 14:01:48'),
(432, 125, 1, '250mm / Combi', '1750', '2019-12-25 14:01:48', '2019-12-25 14:01:48'),
(433, 125, 1, '300mm / Combi', '1890', '2019-12-25 14:01:48', '2019-12-25 14:01:48'),
(434, 125, 1, '450mm / Combi', '2300', '2019-12-25 14:01:48', '2019-12-25 14:01:48'),
(435, 125, 1, '600mm / Combi', '2700', '2019-12-25 14:01:48', '2019-12-25 14:01:48'),
(436, 126, 1, '200mm / Satin', '1433', '2019-12-26 03:52:32', '2019-12-26 03:52:32'),
(437, 126, 1, '250mm / Satin', '1550', '2019-12-26 03:52:32', '2019-12-26 03:52:32'),
(438, 126, 1, '300mm / Satin', '1668', '2019-12-26 03:52:32', '2019-12-26 03:52:32'),
(439, 126, 1, '200mm / Combi', '1500', '2019-12-26 03:52:32', '2019-12-26 03:52:32'),
(440, 126, 1, '250mm / Combi', '1618', '2019-12-26 03:52:32', '2019-12-26 03:52:32'),
(441, 126, 1, '300mm / Combi', '1735', '2019-12-26 03:52:32', '2019-12-26 03:52:32'),
(442, 127, 1, '200mm x 400mm / Satin', '1620', '2019-12-26 04:10:10', '2019-12-26 04:10:10'),
(443, 127, 1, '250mm x 400mm / Satin', '1710', '2019-12-26 04:10:10', '2019-12-26 04:10:10'),
(444, 127, 1, '250mm x 450mm / Satin', '1880', '2019-12-26 04:10:10', '2019-12-26 04:10:10'),
(445, 127, 1, '300mm x 450mm / Satin', '2280', '2019-12-26 04:10:10', '2019-12-26 04:10:10'),
(446, 127, 1, '400mm x 600mm / Satin', '2600', '2019-12-26 04:10:10', '2019-12-26 04:10:10'),
(447, 127, 1, '200mm x 400mm / Glossy', '1810', '2019-12-26 04:10:10', '2019-12-26 04:30:17'),
(448, 127, 1, '250mm x 400mm / Glossy', '1790', '2019-12-26 04:10:10', '2019-12-26 04:30:26'),
(449, 127, 1, '250mm x 450mm / Glossy', '1980', '2019-12-26 04:10:10', '2019-12-26 04:30:35'),
(450, 127, 1, '300mm x 450mm / Glossy', '2410', '2019-12-26 04:10:10', '2019-12-26 04:30:41'),
(451, 127, 1, '400mm x 600mm / Glossy', '2760', '2019-12-26 04:10:10', '2019-12-26 04:30:48'),
(452, 128, 1, '200mm x 400mm / Satin', '1810', '2019-12-26 04:29:49', '2019-12-26 04:29:49'),
(453, 128, 1, '250mm x 400mm / Satin', '1900', '2019-12-26 04:29:49', '2019-12-26 04:29:49'),
(454, 128, 1, '200mm x 450mm / Satin', '1900', '2019-12-26 04:29:49', '2019-12-26 04:29:49'),
(455, 128, 1, '250mm x 450mm / Satin', '1980', '2019-12-26 04:29:49', '2019-12-26 04:29:49'),
(456, 128, 1, '200mm x 400mm / Glossy', '1980', '2019-12-26 04:29:49', '2019-12-26 04:29:49'),
(457, 128, 1, '250mm x 400mm / Glossy', '2070', '2019-12-26 04:29:49', '2019-12-26 04:29:49'),
(458, 128, 1, '200mm x 450mm / Glossy', '2070', '2019-12-26 04:29:49', '2019-12-26 04:29:49'),
(459, 128, 1, '250mm x 450mm / Glossy', '2150', '2019-12-26 04:29:49', '2019-12-26 04:29:49'),
(460, 129, 4, 'Left Open ', '21150', '2019-12-30 04:30:28', '2019-12-30 04:30:28'),
(461, 129, 4, 'Right Open ', '21150', '2019-12-30 04:30:28', '2019-12-30 04:30:28'),
(462, 130, 4, 'Left Opening', '31150', '2019-12-30 06:59:25', '2019-12-30 06:59:25'),
(463, 130, 4, 'Right Opening', '31150', '2019-12-30 06:59:25', '2019-12-30 06:59:25'),
(464, 131, 4, 'Soft Close ', '33700', '2019-12-30 07:10:40', '2019-12-30 07:10:40'),
(465, 132, 1, '14 liter ', '3580', '2019-12-30 07:15:55', '2019-12-30 07:15:55'),
(466, 133, 1, '4 Layer / 1150mm - 1450mm', '34050', '2019-12-30 07:24:02', '2019-12-30 07:24:02'),
(467, 133, 1, '5 Layer / 1400mm - 1700mm', '37800', '2019-12-30 07:24:02', '2019-12-30 07:24:02'),
(468, 133, 1, '6 Layer / 1650mm - 1950mm', '41550', '2019-12-30 07:24:02', '2019-12-30 07:24:02'),
(469, 134, 1, '4 Layer / 1150mm - 1450mm', '34050', '2019-12-30 07:30:25', '2019-12-30 07:30:25'),
(470, 134, 1, '5 Layer / 1250mm - 1550mm ', '37800', '2019-12-30 07:30:25', '2019-12-30 07:30:25'),
(471, 134, 1, '6 Layer / 1850mm - 2150mm', '41550', '2019-12-30 07:30:25', '2019-12-30 07:30:25'),
(472, 135, 1, '480mm / 16 inch to 22 inch', '1900', '2019-12-30 07:42:17', '2019-12-30 07:42:17'),
(473, 135, 1, '480mm / 22 inch to 30 inch', '2300', '2019-12-30 07:42:17', '2019-12-30 07:42:17'),
(474, 135, 1, '520mm / 16 inch to 22 inch', '1900', '2019-12-30 07:42:17', '2019-12-30 07:42:17'),
(475, 135, 1, '520mm / 22 inch to 30 inch', '2300', '2019-12-30 07:42:17', '2019-12-30 07:42:17'),
(476, 136, 1, '400mm - 600mm', '7030', '2019-12-30 07:47:45', '2019-12-30 07:47:45'),
(477, 136, 1, '700mm - 900mm', '9100', '2019-12-30 07:47:45', '2019-12-30 07:47:45'),
(478, 137, 1, '470mm ', '1005', '2019-12-30 07:54:59', '2019-12-30 07:54:59'),
(479, 137, 1, '520mm', '1090', '2019-12-30 07:54:59', '2019-12-30 07:54:59'),
(480, 138, 2, 'Matt', '470', '2019-12-30 14:30:09', '2019-12-30 14:30:09'),
(481, 138, 2, 'Glossy', '540', '2019-12-30 14:30:09', '2019-12-30 14:30:09'),
(482, 139, 1, 'Matt', '630', '2019-12-30 14:33:27', '2019-12-30 14:33:27'),
(483, 139, 1, 'Glossy', '730', '2019-12-30 14:33:27', '2019-12-30 14:33:27'),
(484, 140, 1, 'Matt', '800', '2019-12-30 14:37:10', '2019-12-30 14:37:10'),
(485, 140, 1, 'Glossy', '920', '2019-12-30 14:37:10', '2019-12-30 14:37:10'),
(486, 141, 2, 'Matt', '1070', '2019-12-30 14:39:08', '2019-12-30 14:39:08'),
(487, 141, 2, 'Glossy', '1200', '2019-12-30 14:39:08', '2019-12-30 14:39:08'),
(488, 142, 2, 'Matt', '770', '2019-12-30 14:45:20', '2019-12-30 14:45:20'),
(489, 142, 2, 'Glossy', '880', '2019-12-30 14:45:20', '2019-12-30 14:45:20'),
(490, 143, 2, 'Matt', '495', '2019-12-30 14:47:17', '2019-12-30 14:47:17'),
(491, 143, 2, 'Glossy', '585', '2019-12-30 14:47:17', '2019-12-30 14:47:17'),
(492, 144, 2, 'Matt', '270', '2019-12-30 14:49:21', '2019-12-30 14:49:21'),
(493, 144, 2, 'Glossy', '350', '2019-12-30 14:49:21', '2019-12-30 14:49:21'),
(494, 145, 2, 'Matt', '2950', '2019-12-30 14:52:07', '2019-12-30 14:52:07'),
(495, 145, 2, 'Glossy', '3390', '2019-12-30 14:52:07', '2019-12-30 14:52:07'),
(496, 146, 2, 'Matt', '6450', '2019-12-30 14:53:56', '2019-12-30 14:53:56'),
(497, 146, 2, 'Glossy', '7310', '2019-12-30 14:53:56', '2019-12-30 14:53:56'),
(498, 147, 2, 'Matt', '870', '2019-12-30 14:55:19', '2019-12-30 14:55:19'),
(499, 147, 2, 'Glossy', '985', '2019-12-30 14:55:19', '2019-12-30 14:55:19'),
(500, 148, 2, 'Matt', '6980', '2019-12-30 15:05:03', '2019-12-30 15:05:03'),
(501, 148, 2, 'Glossy', '8310', '2019-12-30 15:05:03', '2019-12-30 15:05:03'),
(502, 149, 2, 'Matt', '10380', '2019-12-30 15:08:13', '2019-12-30 15:08:13'),
(503, 149, 2, 'Glossy', '12060', '2019-12-30 15:08:13', '2019-12-30 15:08:13'),
(504, 150, 2, 'Matt', '1765', '2019-12-30 15:26:55', '2019-12-30 15:26:55'),
(505, 150, 2, 'Glossy', '1915', '2019-12-30 15:26:55', '2019-12-30 15:26:55'),
(506, 151, 2, 'Matt', '1150', '2019-12-31 07:45:27', '2019-12-31 07:45:27'),
(507, 151, 2, 'Glossy', '1250', '2019-12-31 07:45:27', '2019-12-31 07:45:27'),
(508, 152, 2, 'Matt', '1765', '2019-12-31 13:57:54', '2019-12-31 13:57:54'),
(509, 152, 2, 'Glossy', '1915', '2019-12-31 13:57:54', '2019-12-31 13:57:54'),
(510, 153, 2, 'Matt', '900', '2019-12-31 13:59:33', '2019-12-31 13:59:33'),
(511, 153, 2, 'Glossy', '1005', '2019-12-31 13:59:33', '2019-12-31 13:59:33'),
(514, 156, 1, '6.5 Feet', '1385', '2020-01-11 06:16:16', '2020-01-11 06:16:16'),
(515, 156, 1, '8 Feet', '1704', '2020-01-11 06:16:16', '2020-01-11 06:16:16'),
(516, 156, 1, '10 Feet', '2130', '2020-01-11 06:16:16', '2020-01-11 06:16:16'),
(517, 156, 1, '12 Feet', '2556', '2020-01-11 06:16:16', '2020-01-11 06:16:16'),
(518, 157, 2, 'Matt', '1595', '2020-01-30 04:27:32', '2020-01-30 04:27:32'),
(519, 157, 2, 'Glossy', '1860', '2020-01-30 04:27:32', '2020-01-30 04:27:32'),
(520, 158, 2, 'Matt', '1585', '2020-01-30 04:37:18', '2020-01-30 04:37:18'),
(521, 158, 2, 'Glossy', '1850', '2020-01-30 04:37:18', '2020-01-30 04:37:18'),
(522, 159, 2, 'Matt', '1595', '2020-01-30 04:42:58', '2020-01-30 04:42:58'),
(523, 159, 2, 'Glossy ', '1860', '2020-01-30 04:42:58', '2020-01-30 04:42:58'),
(524, 160, 2, 'Matt', '3260', '2020-01-30 04:52:03', '2020-01-30 04:52:03'),
(525, 160, 2, 'Glossy', '3660', '2020-01-30 04:52:03', '2020-01-30 04:52:03'),
(526, 161, 2, 'Matt', '2730', '2020-02-03 08:29:54', '2020-02-03 08:29:54'),
(527, 161, 2, 'Glossy', '3130', '2020-02-03 08:29:54', '2020-02-03 08:29:54'),
(528, 162, 2, 'Matt', '2730', '2020-02-03 08:37:25', '2020-02-03 08:37:25'),
(529, 162, 2, 'Glossy', '3130', '2020-02-03 08:37:25', '2020-02-03 08:37:25'),
(530, 163, 2, 'Aluminum Silver', '1430', '2020-02-19 04:39:51', '2020-02-19 04:39:51'),
(531, 163, 2, 'SS Brush', '1550', '2020-02-19 04:39:51', '2020-02-19 04:39:51'),
(532, 163, 2, 'CP Brush', '1930', '2020-02-19 04:39:51', '2020-02-19 04:39:51'),
(533, 163, 2, 'Rose Gold ', '2120', '2020-02-19 04:39:51', '2020-02-19 04:39:51'),
(534, 163, 2, 'Black', '1550', '2020-02-19 04:39:51', '2020-02-19 04:39:51'),
(535, 164, 2, 'Aluminum Silver', '1800', '2020-02-19 04:45:03', '2020-02-19 04:45:03'),
(536, 164, 2, 'SS Brush', '1920', '2020-02-19 04:45:03', '2020-02-19 04:45:03'),
(537, 164, 2, 'CP Brush', '2300', '2020-02-19 04:45:03', '2020-02-19 04:45:03'),
(538, 164, 2, 'Rose Gold ', '2490', '2020-02-19 04:45:03', '2020-02-19 04:45:03'),
(539, 164, 2, 'Black', '1920', '2020-02-19 04:45:03', '2020-02-19 04:45:03'),
(540, 165, 2, 'Aluminum Silver', '1500', '2020-02-19 05:21:02', '2020-02-19 05:21:02'),
(541, 165, 2, 'SS Brush', '1620', '2020-02-19 05:21:02', '2020-02-19 05:21:02'),
(542, 165, 2, 'CP Brush', '2010', '2020-02-19 05:21:02', '2020-02-19 05:21:02'),
(543, 165, 2, 'CP Mirror ', '2200', '2020-02-19 05:21:02', '2020-02-19 05:21:02'),
(544, 165, 2, 'Rose Gold ', '2200', '2020-02-19 05:21:02', '2020-02-19 05:21:02'),
(545, 165, 2, 'Black', '1620', '2020-02-19 05:21:02', '2020-02-19 05:21:02'),
(546, 166, 2, 'Aluminum Silver ', '615', '2020-02-19 06:09:28', '2020-02-19 06:09:28'),
(547, 166, 2, 'SS Brush', '730', '2020-02-19 06:09:28', '2020-02-19 06:09:28'),
(548, 166, 2, 'CP Mirror ', '925', '2020-02-19 06:09:28', '2020-02-19 06:09:28'),
(549, 166, 2, 'Rose Gold ', '925', '2020-02-19 06:09:28', '2020-02-19 06:09:28'),
(550, 166, 2, 'Black', '730', '2020-02-19 06:09:28', '2020-02-19 06:09:28'),
(551, 167, 4, 'Glass to Glass Lock', '15400', '2020-03-06 06:25:32', '2020-03-06 06:25:32'),
(552, 167, 4, 'Glass to Wall Lock', '9800', '2020-03-06 06:25:32', '2020-03-06 06:25:32'),
(553, 168, 2, 'Aluminum Silver', '1340', '2020-03-09 07:26:26', '2020-03-09 07:26:26'),
(554, 168, 2, 'SS Brush', '1380', '2020-03-09 07:26:26', '2020-03-09 07:26:26'),
(555, 168, 2, 'CP Brush', '1570', '2020-03-09 07:26:26', '2020-03-09 07:26:26'),
(556, 168, 2, 'Rose Gold', '1760', '2020-03-09 07:26:26', '2020-03-09 07:26:26'),
(557, 169, 2, 'Aluminum', '1100', '2020-03-13 08:17:38', '2020-03-13 08:17:38'),
(558, 169, 2, 'SS Brush', '1250', '2020-03-13 08:17:38', '2020-03-13 08:17:38'),
(559, 169, 2, 'CP Brush', '1640', '2020-03-13 08:17:38', '2020-03-13 08:17:38'),
(560, 169, 2, 'CP Mirror', '1830', '2020-03-13 08:17:38', '2020-03-13 08:17:38'),
(561, 169, 2, 'Rose Gold', '1830', '2020-03-13 08:17:38', '2020-03-13 08:17:38'),
(562, 169, 2, 'Black', '1250', '2020-03-13 08:17:38', '2020-03-13 08:17:38'),
(563, 170, 5, 'Glass Runner 8 Wheel Set-Big', '4170', '2020-03-14 05:02:32', '2020-03-14 05:02:32'),
(564, 170, 5, ' Floor Guide For Sliding Glass', '445', '2020-03-14 05:02:32', '2020-03-14 05:02:32'),
(565, 170, 5, 'Stopper - Track Mounting', '335', '2020-03-14 05:02:32', '2020-03-14 05:02:32'),
(566, 170, 5, 'Stopper - Flooe Mounting', '300', '2020-03-14 05:02:32', '2020-03-14 05:02:32'),
(567, 170, 5, 'Glass Track Fixer', '385', '2020-03-14 05:02:32', '2020-03-14 05:02:32'),
(568, 171, 5, 'Glass Runner 4 Wheel Set - Big', '3630', '2020-03-14 05:08:36', '2020-03-14 05:08:36'),
(569, 171, 5, 'Floor Guide For Sliding Glass', '445', '2020-03-14 05:08:37', '2020-03-14 05:08:37'),
(570, 171, 5, 'Stopper - Track Mounting', '335', '2020-03-14 05:08:37', '2020-03-14 05:08:37'),
(571, 171, 5, 'Stopper - Floor Mounting', '300', '2020-03-14 05:08:37', '2020-03-14 05:08:37'),
(572, 171, 5, 'Glass Track Fixer', '385', '2020-03-14 05:08:37', '2020-03-14 05:08:37'),
(573, 172, 5, '45MM CONNECTOR REGULAR', '96', '2020-03-16 07:02:02', '2020-03-16 07:02:02'),
(574, 173, 1, '3 Feet Frame Only - 5mm', '2745', '2020-03-16 11:17:00', '2020-03-16 11:17:00'),
(575, 173, 1, '4 Feet Frame Only - 5mm', '3187', '2020-03-16 11:17:00', '2020-03-16 11:17:00'),
(576, 173, 1, '5 Feet Frame Only - 5mm', '3695', '2020-03-16 11:17:00', '2020-03-16 11:17:00');

-- --------------------------------------------------------

--
-- Table structure for table `qrcode`
--

CREATE TABLE `qrcode` (
  `id` int(11) NOT NULL,
  `uniqueid` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `count` varchar(255) NOT NULL,
  `point` varchar(255) NOT NULL,
  `qr_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qrcode`
--

INSERT INTO `qrcode` (`id`, `uniqueid`, `product_id`, `count`, `point`, `qr_image`) VALUES
(1, '1574760605905361690', 2, '2', '100', '1574760605905361690.png'),
(2, '1574760605622783897', 2, '2', '100', '1574760605622783897.png'),
(3, '15772778031227907758', 124, '4', '4', '15772778031227907758.png'),
(4, '15772778041457944402', 124, '4', '4', '15772778041457944402.png'),
(5, '1577277804334051309', 124, '4', '4', '1577277804334051309.png'),
(6, '15772778041213071150', 124, '4', '4', '15772778041213071150.png'),
(7, '1591079572356023925', 172, '10', '.5', '1591079572356023925.png'),
(8, '15910795721313324654', 172, '10', '.5', '15910795721313324654.png'),
(9, '1591079572350257685', 172, '10', '.5', '1591079572350257685.png'),
(10, '1591079572236304080', 172, '10', '.5', '1591079572236304080.png'),
(11, '1591079573554642614', 172, '10', '.5', '1591079573554642614.png'),
(12, '15910795731963247306', 172, '10', '.5', '15910795731963247306.png'),
(13, '1591079573429339712', 172, '10', '.5', '1591079573429339712.png'),
(14, '1591079573802447711', 172, '10', '.5', '1591079573802447711.png'),
(15, '15910795731952720982', 172, '10', '.5', '15910795731952720982.png'),
(16, '15910795731251815758', 172, '10', '.5', '15910795731251815758.png'),
(17, '1593784906483494611', 173, '10', '5', '1593784906483494611.png'),
(18, '159378490616393759', 173, '10', '5', '159378490616393759.png'),
(19, '15937849061870764486', 173, '10', '5', '15937849061870764486.png'),
(20, '15937849062099659201', 173, '10', '5', '15937849062099659201.png'),
(21, '159378490675821870', 173, '10', '5', '159378490675821870.png'),
(22, '1593784906618387743', 173, '10', '5', '1593784906618387743.png'),
(23, '15937849061428419046', 173, '10', '5', '15937849061428419046.png'),
(24, '1593784906133781373', 173, '10', '5', '1593784906133781373.png'),
(25, '1593784906518731230', 173, '10', '5', '1593784906518731230.png'),
(26, '159378490755753790', 173, '10', '5', '159378490755753790.png');

-- --------------------------------------------------------

--
-- Table structure for table `qr_history`
--

CREATE TABLE `qr_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `uniqueid` varchar(255) DEFAULT '',
  `point` varchar(255) DEFAULT '',
  `qr_image` varchar(255) DEFAULT '',
  `status` varchar(255) DEFAULT '',
  `scan_date` datetime DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qr_history`
--

INSERT INTO `qr_history` (`id`, `user_id`, `product_id`, `uniqueid`, `point`, `qr_image`, `status`, `scan_date`) VALUES
(1, 3, 1, '15747606331192375256', '1000', '15747606331192375256.png', 'Success', '2019-11-26 15:01:05');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT 0,
  `rating` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `review` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `product_id`, `rating`, `name`, `designation`, `city`, `review`, `created_at`) VALUES
(1, 41, 3, 'Test', 'Test', 'Test', 'Ttttwst', '2019-12-17 12:21:08'),
(2, 0, 5, '', 'dealer', '', '', '2020-07-03 13:05:43'),
(3, 0, 4, 'Bipin', 'consumer', 'Surat', 'Hello', '2020-07-03 13:21:48');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `s_key` varchar(100) NOT NULL,
  `s_value` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `s_key`, `s_value`) VALUES
(24, 'embed_map', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3719.327881846799!2d72.86968821447029!3d21.21884288589578!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04f13ac088cd5%3A0x2f57da0d826c0a60!2sZUMA+CORPORATION!5e0!3m2!1sen!2sin!4v1566579927221!5m2!1sen!2sin\" width=\"100%\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>'),
(25, 'email', 'support@zumahardware.com'),
(26, 'mobile_no', '+91 720 306 0600'),
(27, 'address', '75,76 Mahatma Industries, Nr Kapodra, Varachha Road, Surat-395006, Gujarat, India'),
(28, 'social_facebook', 'http://www.facebook.com'),
(29, 'social_google_plus', 'http://www.google_plus.com'),
(30, 'social_twitter', 'http://www.twitter.com'),
(31, 'social_youtube', 'http://www.youtube.com'),
(32, 'name', 'Zuma Corporation'),
(33, 'privacy_policy', '<p><strong>CAN SPAM Act</strong></p>\r\n\r\n<p>The CAN-SPAM Act is a law that sets the rules for commercial email, establishes requirements for commercial messages, gives recipients the right to have emails stopped from being sent to them, and spells out tough penalties for violations.</p>\r\n\r\n<p><strong>We collect your email address in order to:</strong></p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>&bull;</strong>&nbsp;Send information, respond to inquiries, and/or other requests or questions</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>&bull;</strong>&nbsp;Process orders and to send information and updates pertaining to orders.</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>&bull;</strong>&nbsp;Send you additional information related to your product and/or service</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>&bull;</strong>&nbsp;Market to our mailing list or continue to send emails to our clients after the original transaction has occurred.</p>\r\n\r\n<p>&nbsp;</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL,
  `slider_image` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_image`) VALUES
(1, 'GLASS_FITTING.jpg'),
(2, 'Untitled-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `subcat_id` int(11) NOT NULL,
  `subcat_parentid` int(11) DEFAULT 0,
  `subcat_name` varchar(255) DEFAULT '',
  `slug` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`subcat_id`, `subcat_parentid`, `subcat_name`, `slug`) VALUES
(1, 1, 'Zuma Telescopic Drawer Channel', 'zuma-telescopic-drawer-channel'),
(3, 1, 'Zuma Quadro Channel', 'zuma-quadro-channel'),
(4, 3, 'Zuma Tandem System', 'zuma-tandem-system'),
(5, 3, 'Zuma Cutlery Organizer ', 'zuma-cutlery-organizer-'),
(6, 3, 'Zuma Tandem Inlet', 'zuma-tandem-inlet'),
(7, 3, 'Zuma Corner System', 'zuma-corner-system'),
(8, 3, 'Zuma Kitchen Storage', 'zuma-kitchen-storage'),
(10, 4, 'Zuma Lift Up System', 'zuma-lift-up-system'),
(11, 4, 'Zuma Wardrobe Lifter Series', 'zuma-wardrobe-lifter-series'),
(12, 4, 'Zuma Bed Fitting', 'zuma-bed-fitting'),
(13, 4, 'Zuma Table Mechanism', 'zuma-table-mechanism'),
(14, 5, 'Zuma Auto Hinges', 'zuma-auto-hinges'),
(15, 2, 'Zuma Mortice Lockbody', 'zuma-mortice-lockbody'),
(16, 2, 'Zuma Pin Cylinder', 'zuma-pin-cylinder'),
(17, 2, 'Zuma Drawer Lock', 'zuma-drawer-lock'),
(18, 2, 'Zuma Dead Lock', 'zuma-dead-lock'),
(19, 2, 'Zuma Sliding Lock', 'zuma-sliding-lock'),
(20, 2, 'Zuma Cylindrical Lock', 'zuma-cylindrical-lock'),
(21, 6, 'Zuma wooden Sliding Runner', 'zuma-wooden-sliding-runner'),
(22, 6, 'Zuma Wooden Sliding Track', 'zuma-wooden-sliding-track'),
(23, 6, 'Zuma Glass Sliding Runner', 'zuma-glass-sliding-runner'),
(24, 6, 'Zuma Glass Sliding Track', 'zuma-glass-sliding-track'),
(25, 7, 'Zuma Handle Profile', 'zuma-handle-profile'),
(26, 7, 'Zuma Shutter Profile', 'zuma-shutter-profile'),
(27, 7, 'Zuma Edge Profile', 'zuma-edge-profile'),
(28, 7, 'Zuma Framing Profile', 'zuma-framing-profile'),
(29, 7, 'Zuma Profile Connector', 'zuma-profile-connector'),
(30, 8, 'Zuma Door Closer', 'zuma-door-closer'),
(31, 9, 'Floor Spring', 'floor-spring'),
(32, 9, 'Patch Fitting', 'patch-fitting'),
(33, 9, 'Floor Spring Set', 'floor-spring-set'),
(34, 9, 'Glass Lock', 'glass-lock'),
(35, 9, 'Glass Connector', 'glass-connector'),
(36, 9, 'Shower Fitting', 'shower-fitting'),
(37, 9, 'Glass Handle', 'glass-handle'),
(38, 9, 'Glass Protection', 'glass-protection'),
(39, 9, 'Shower Knight Head Accessories', 'shower-knight-head-accessories'),
(40, 3, 'Zuma Pull Out ', 'zuma-pull-out-');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_history`
--

CREATE TABLE `transfer_history` (
  `id` int(11) NOT NULL,
  `from_u` varchar(11) DEFAULT '0',
  `to_u` varchar(11) DEFAULT '0',
  `point` double DEFAULT 0,
  `status` enum('credit','debit') DEFAULT 'credit',
  `transfer_date` datetime DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transfer_history`
--

INSERT INTO `transfer_history` (`id`, `from_u`, `to_u`, `point`, `status`, `transfer_date`) VALUES
(1, '0', '3', 1000, 'debit', '2019-11-26 15:01:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `distributor_id` int(11) DEFAULT 0,
  `first_name` varchar(255) DEFAULT '',
  `last_name` varchar(255) DEFAULT '',
  `mobile_no` varchar(255) DEFAULT '',
  `email` varchar(255) DEFAULT '',
  `password` varchar(255) DEFAULT '',
  `address` varchar(500) DEFAULT '',
  `image` varchar(255) DEFAULT '',
  `aadhar_no` varchar(255) DEFAULT '',
  `type` enum('dealer','carpenter','salesman') DEFAULT NULL,
  `stamp` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `point` varchar(255) NOT NULL DEFAULT '0',
  `device_token` varchar(1000) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `distributor_id`, `first_name`, `last_name`, `mobile_no`, `email`, `password`, `address`, `image`, `aadhar_no`, `type`, `stamp`, `point`, `device_token`) VALUES
(1, 1, 'Abc', 'abc', '7896543221', 'abc@gmail.com', '123456', 'Oooo', '1574758768_profile_red.png', '123456789987', 'salesman', '2019-11-26 21:29:28', '0', 'e0WQaT1ocHo:APA91bFhTzGXacTgK5_cIy-x_S5AuVg9QHpd6JQu7JMpgFtslyqdx-4GGJYDIzTGWiTTQNn9kENpTpza4IWfZLqXV8uP52Zea4oAaOgud_0yKSrFqO8w9ZInVB8Ds1quNMm36Z56xrC6'),
(2, 1, 'Dealer', 'dealer', '9876543210', 'dealer@gmail.com', '123456', 'Surwat', '1574758979_checked_green.png', '987654321213', 'dealer', '2019-11-26 21:32:59', '0', 'ckFFx-A2l0A:APA91bEX4vkTBDQr9pomlrP1doBmk5QznM3tFO7Au9i9rRpEXwKjKqJucYsdbjd-vFIcvYMcJiDJyHG-lx-92gWEBC8fcVxP1vdjqhnhnXxBxCiJfKoBCTiL90HPZofTPaLYQhOEPG5c'),
(3, 1, 'Car', 'penter', '1231231231', 'carpenter@gmail.com', '123456', ' varach', '1574759490_referral.png', '163245796534', 'carpenter', '2019-11-26 21:41:30', '1000', 'cNtLbRpdTCE:APA91bGDNNlYr1_i0F0PJAfmveuqR7NI0LR92Lsu7_DsO1OIRe6jy8gOcEh6RA5aUF_Os8u95xwUHBM5E4A3wXOG4lW_mXV2wLgsYhRqJ8-Gp_zqF8ng819v72-F855844-GpxvIA1vB'),
(4, 0, 'Fenil ', 'Bhadani', '9173072108', 'bhadanifenil@gmail.com', 'Bfenilzuma', '22-23, Street No.3, Chitrakut Society,\r\nNari, Bhavnagar', 'default_profile.png', '308532568961', 'salesman', '2019-12-13 19:42:58', '0', 'cMKHvos5YLk:APA91bE_pNaBgYu7MueoqF4FuQw26EZ1GA8DeyRmQZL4G8aA8w9vSVwcfcOpGh1zDgDyooH0g0yzteE1NFXzINDtXQVsU4UOCt4IcEH3q0qmwLwrWBQkoLCxU07PFmmogoyiM6hVyDPp'),
(6, 0, 'Ashish', 'Mavani', '8866538053', 'ashishmavani03@gmail.com', 'Ashish@007', 'Thakordwar soc', '1591074618_nikujbhai pancard.jpg', '123412341234', 'salesman', '2020-06-02 17:40:18', '0', ''),
(7, 1, 'Aaa', 'aaa', '1234567890', 'aaa@gmail.com', '123456', '1231323', 'default_profile.png', '123123123123', 'salesman', '2020-06-02 17:45:37', '0', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`att_id`);

--
-- Indexes for table `brand_slider`
--
ALTER TABLE `brand_slider`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `distributor`
--
ALTER TABLE `distributor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qrcode`
--
ALTER TABLE `qrcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qr_history`
--
ALTER TABLE `qr_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`subcat_id`),
  ADD KEY `subcat_parentid` (`subcat_parentid`);

--
-- Indexes for table `transfer_history`
--
ALTER TABLE `transfer_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brand_slider`
--
ALTER TABLE `brand_slider`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `distributor`
--
ALTER TABLE `distributor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `product_attribute`
--
ALTER TABLE `product_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=577;

--
-- AUTO_INCREMENT for table `qrcode`
--
ALTER TABLE `qrcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `qr_history`
--
ALTER TABLE `qr_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `subcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `transfer_history`
--
ALTER TABLE `transfer_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`subcat_parentid`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
