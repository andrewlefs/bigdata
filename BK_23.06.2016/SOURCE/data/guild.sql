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
-- Table structure for table `guild`
--

CREATE TABLE IF NOT EXISTS `guild` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL,
  `date_sendmobo` datetime DEFAULT NULL,
  `game_id` int(11) NOT NULL,
  `server_id` int(11) NOT NULL,
  `game_guild_id` varchar(50) NOT NULL COMMENT 'game_id + _ + server_id + _ + mã bang',
  `game_guild_name` varchar(250) NOT NULL COMMENT 'game + _ + server_id + _ + tên bang',
  `game_guild_create_date` datetime DEFAULT NULL,
  `game_guild_leader_name` varchar(250) NOT NULL,
  `msi_leader` varchar(30) NOT NULL,
  `accid_leader` varchar(50) DEFAULT NULL COMMENT 'mã tài khoản game',
  `mobo_id` varchar(30) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `role_id_leader` varchar(50) DEFAULT NULL COMMENT 'mã nhân vật',
  `logresult` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gameid_serverid_gameguidid` (`game_id`,`server_id`,`game_guild_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=298230 ;

--
-- Dumping data for table `guild`
--

INSERT INTO `guild` (`id`, `date`, `date_modify`, `date_sendmobo`, `game_id`, `server_id`, `game_guild_id`, `game_guild_name`, `game_guild_create_date`, `game_guild_leader_name`, `msi_leader`, `accid_leader`, `mobo_id`, `fullname`, `role_id_leader`, `logresult`) VALUES
(1, '2016-05-16 11:19:51', '2016-05-16 11:19:51', '2016-05-19 10:59:15', 133, 1, 'ctt_1_10000140', 'ctt_1_quandoan', '2016-04-05 14:04:30', 'ChânThiên', '1331522492607859450', '1331522492607859450', '210622847', '210622847', '10000024', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
