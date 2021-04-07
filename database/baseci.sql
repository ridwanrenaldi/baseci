-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 07, 2021 at 01:54 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baseci`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_name` varchar(20) DEFAULT NULL,
  `account_username` varchar(12) DEFAULT NULL,
  `account_email` varchar(250) DEFAULT NULL,
  `account_password` varchar(250) DEFAULT NULL,
  `account_isactive` tinyint(1) DEFAULT NULL,
  `account_created` timestamp NULL DEFAULT NULL,
  `account_modified` timestamp NULL DEFAULT NULL,
  `account_level` enum('root','admin','user','') DEFAULT NULL,
  `account_image` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `account_name`, `account_username`, `account_email`, `account_password`, `account_isactive`, `account_created`, `account_modified`, `account_level`, `account_image`) VALUES
(1, 'Super User', 'root', 'root@gmail.com', '$2y$08$OUvUAjIObQFUIWZkT3.mqeH0.jNTOLkyFjATVFsmgwQrJMIgKGWwe', 1, '2021-03-31 17:00:00', '2021-03-31 17:00:00', 'root', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(250) DEFAULT NULL,
  `category_description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'Telkomsel', 'Telkomsel'),
(2, 'XL Axiata', 'XL Axiata'),
(3, 'AXIS', 'AXIS'),
(4, 'Indosat', 'Indosat'),
(5, 'Smartfren', 'Smartfren'),
(6, '3 Indonesia', '3 Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `phone`
--

DROP TABLE IF EXISTS `phone`;
CREATE TABLE IF NOT EXISTS `phone` (
  `phone_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `phone_created` datetime DEFAULT NULL,
  `phone_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`phone_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phone`
--

INSERT INTO `phone` (`phone_id`, `category_id`, `phone_number`, `phone_created`, `phone_modified`) VALUES
(1, 1, '082182461928', '2021-04-05 16:05:02', '2021-04-05 16:05:02'),
(2, 1, '082171536937', '2021-04-05 16:04:59', '2021-04-05 16:04:59'),
(3, 1, '082127399912', '2021-04-05 16:04:50', '2021-04-05 16:04:50'),
(4, 2, '087765938015', '2021-04-05 16:04:41', '2021-04-05 16:04:41'),
(5, 2, '087733668219', '2021-04-05 16:05:27', '2021-04-05 16:05:27'),
(6, 2, '087791238765', '2021-04-05 16:05:41', '2021-04-05 16:05:41'),
(7, 3, '083287347193', '2021-04-05 16:06:10', '2021-04-05 16:06:10'),
(8, 3, '083292771927', '2021-04-05 16:06:21', '2021-04-05 16:06:21'),
(9, 3, '083295922295', '2021-04-05 16:06:32', '2021-04-05 16:06:32'),
(10, 4, '085687124819', '2021-04-06 21:20:05', '2021-04-06 21:20:05'),
(11, 4, '085633729821', '2021-04-06 21:20:39', '2021-04-06 21:20:39'),
(12, 4, '085688921846', '2021-04-06 21:20:50', '2021-04-06 21:20:50'),
(13, 5, '088171937294', '2021-04-06 21:21:19', '2021-04-06 21:21:19'),
(14, 5, '088181937183', '2021-04-06 21:21:30', '2021-04-06 21:21:30'),
(15, 5, '088188162871', '2021-04-06 21:21:41', '2021-04-06 21:21:41'),
(16, 6, '089877181681', '2021-04-06 21:22:31', '2021-04-06 21:22:31'),
(17, 6, '089892749102', '2021-04-06 21:22:49', '2021-04-06 21:22:49'),
(18, 1, '089838174232', '2021-04-06 21:23:25', '2021-04-06 21:23:25'),
(19, 6, '081381739634', '2021-04-07 08:00:41', '2021-04-07 08:00:41'),
(20, 6, '081384627195', '2021-04-07 07:59:36', '2021-04-07 07:59:36'),
(21, 6, '081377634568', '2021-04-07 07:59:50', '2021-04-07 07:59:50'),
(22, 6, '081387214567', '2021-04-07 08:52:47', '2021-04-07 08:52:47');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `phone`
--
ALTER TABLE `phone`
  ADD CONSTRAINT `phone_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
