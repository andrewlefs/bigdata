-- phpMyAdmin SQL Dump
-- version 4.0.10.15
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 23, 2016 at 02:26 PM
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
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modify` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'update time khi có dữ liệu mới. Create data = now',
  `game_id` int(11) NOT NULL,
  `server_id` int(11) NOT NULL,
  `accid` varchar(50) NOT NULL COMMENT 'mã tài khoản game',
  `msi` varchar(30) NOT NULL,
  `mobo_id` varchar(30) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `role_id` varchar(50) NOT NULL,
  `role_name` varchar(250) DEFAULT NULL,
  `create_role_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_login_date` datetime NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gameid_serverid_roleid` (`game_id`,`server_id`,`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5507284 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `date`, `date_modify`, `game_id`, `server_id`, `accid`, `msi`, `mobo_id`, `fullname`, `role_id`, `role_name`, `create_role_date`, `last_login_date`, `level`) VALUES
(3, '2016-05-16 12:11:04', '2016-05-16 12:11:04', 133, 4, '1331522437191143356', '1331522437191143356', '473423142', 'snfjf +._', '50000001', 'ÂnChi|S5', '2016-03-14 16:14:35', '2016-03-14 16:14:36', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
