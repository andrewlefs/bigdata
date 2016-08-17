-- phpMyAdmin SQL Dump
-- version 4.0.10.15
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 23, 2016 at 02:25 PM
-- Server version: 10.1.12-MariaDB
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `datawarehouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `game_id` int(11) NOT NULL COMMENT 'service_id của game lấy được từ api ',
  `accid` varchar(50) NOT NULL COMMENT 'mã tài khoản game',
  `msi` varchar(30) NOT NULL COMMENT 'mobo service id',
  `mobo_id` varchar(30) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gameid_accid` (`msi`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=106417609 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `date`, `game_id`, `accid`, `msi`, `mobo_id`, `fullname`) VALUES
(1, '2016-04-29 14:41:32', 133, '1331522060770380727', '1331522060770380727', '493815338', 'Halowin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
