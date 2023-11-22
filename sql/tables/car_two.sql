-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 18, 2023 at 04:00 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `billing`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_two`
--

DROP TABLE IF EXISTS `car_two`;
CREATE TABLE IF NOT EXISTS `car_two` (
  `id` int NOT NULL AUTO_INCREMENT,
  `timeslots` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `phone` varchar(256) NOT NULL,
  `vehicle` varchar(256) NOT NULL,
  `trainer` varchar(256) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(56) NOT NULL DEFAULT 'empty',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `car_two`
--

INSERT INTO `car_two` (`id`, `timeslots`, `name`, `phone`, `vehicle`, `trainer`, `start_date`, `end_date`, `status`) VALUES
(2, '7:00am to 7:30am', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(3, '7:30am to 8:00am', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(4, '8:00am to 8:30am', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(5, '8:30am to 9:00am', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(6, '9:00am to 9:30am', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(7, '9:30am to 10:00am', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(8, '10:00am to 10:30am', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(9, '10:30am to 11:00am', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(10, '11:00am to 11:30am', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(11, '11:30am to 12:00pm', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(12, '12:00pm to 12:30pm', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(13, '12:30pm to 1:00pm', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(14, '1:00pm to 1:30pm', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(15, '1:30pm to 2:00pm', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(16, '2:00pm to 2:30pm', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(17, '2:30pm to 3:00pm', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(18, '3:00pm to 3:30pm', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(19, '3:30pm to 4:00pm', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(20, '4:00pm to 4:30pm', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(21, '4:30pm to 5:00pm', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(22, '5:00pm to 5:30pm', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(23, '5:30pm to 6:00pm', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(24, '6:00pm to 6:30pm', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(25, '6:30pm to 7:00pm', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(26, '7:00pm to 7:30pm', '', '', '', '', '0000-00-00', '0000-00-00', 'empty'),
(27, '7:30pm to 8:00pm', '', '', '', '', '0000-00-00', '0000-00-00', 'empty');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;