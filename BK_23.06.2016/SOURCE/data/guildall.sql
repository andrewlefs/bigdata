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
-- Table structure for table `guildall`
--

CREATE TABLE IF NOT EXISTS `guildall` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL,
  `date_sendmobo` datetime DEFAULT NULL,
  `game_id` int(11) NOT NULL,
  `server_id` int(11) NOT NULL,
  `game_guild_id` varchar(50) NOT NULL,
  `game_guild_name` varchar(250) NOT NULL,
  `game_guild_create_date` datetime DEFAULT NULL,
  `role_id` varchar(150) NOT NULL,
  `role_name` varchar(150) NOT NULL,
  `leader_name` varchar(150) NOT NULL,
  `join_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `mobo_service_id` varchar(50) NOT NULL,
  `accid_mem` varchar(50) DEFAULT NULL,
  `mobo_id` varchar(50) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `statussend` int(11) NOT NULL DEFAULT '0',
  `logresult` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `checkdup` (`game_id`,`server_id`,`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=400 ;

--
-- Dumping data for table `guildall`
--

INSERT INTO `guildall` (`id`, `date`, `date_modify`, `date_sendmobo`, `game_id`, `server_id`, `game_guild_id`, `game_guild_name`, `game_guild_create_date`, `role_id`, `role_name`, `leader_name`, `join_date`, `mobo_service_id`, `accid_mem`, `mobo_id`, `fullname`, `statussend`, `logresult`) VALUES
(1, '2016-06-03 17:00:58', '2016-06-03 17:00:58', '2016-06-03 18:10:25', 130, 27, 'th_27_60', 'th_27_♥3DVIP', '2016-05-06 20:04:23', '1357', '♥King♥', '', '2016-05-07 15:18:16', '1301521872385861916', '1301521872385861916', '282293450', 'Lê Đức Huy', 2, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
