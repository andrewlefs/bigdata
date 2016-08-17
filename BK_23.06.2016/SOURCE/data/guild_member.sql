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
-- Table structure for table `guild_member`
--

CREATE TABLE IF NOT EXISTS `guild_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_guild_id` varchar(50) NOT NULL COMMENT 'id bang hội.  Dữ liệu được kết hợp từ game_id + _ + server_id + _ + mã bang trong game',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời điểm create data (now)',
  `join_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `msi_mem` varchar(30) NOT NULL COMMENT 'mobo service id của thành viên',
  `accid_mem` varchar(50) DEFAULT NULL COMMENT 'mã tài khoản game',
  `mobo_id` varchar(30) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `role_id_mem` varchar(50) DEFAULT NULL COMMENT 'mã nhân vật',
  `statussend` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`game_guild_id`,`role_id_mem`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4678780 ;

--
-- Dumping data for table `guild_member`
--

INSERT INTO `guild_member` (`id`, `game_guild_id`, `date`, `join_date`, `msi_mem`, `accid_mem`, `mobo_id`, `fullname`, `role_id_mem`, `statussend`) VALUES
(1, 'th_14_13', '2016-05-27 01:40:08', '2016-02-06 18:32:34', '1301521860313491922', '1301521860313491922', '849999954', 'KhueLukas', '2503', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
