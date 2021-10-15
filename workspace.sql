-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 14, 2021 at 05:25 PM
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
-- Database: `workspace`
--

-- --------------------------------------------------------

--
-- Table structure for table `graph`
--

DROP TABLE IF EXISTS `graph`;
CREATE TABLE IF NOT EXISTS `graph` (
  `graph` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`graph`))
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `graph`
--

INSERT INTO `graph` (`graph`) VALUES
('{\"cells\":[{\"type\":\"html.Element\",\"position\":{\"x\":335,\"y\":179},\"size\":{\"width\":100,\"height\":65},\"angle\":0,\"id\":\"e2063901-c1cf-47b6-ac27-3f527cbfc797\",\"label\":\"Switch\",\"status\":\"up\",\"image_src\":\"<div><img src =\'./icon.png\'/></div>\",\"description\":\"\",\"url\":\"\",\"notes\":\"\",\"last_changed\":\"Sun, 10 Oct 2021 13:19:40 GMT\",\"z\":1,\"attrs\":{}},{\"type\":\"standard.Link\",\"source\":{\"id\":\"d5284d0d-abb3-496d-a446-a15e1a8485ce\"},\"target\":{\"id\":\"e2063901-c1cf-47b6-ac27-3f527cbfc797\"},\"id\":\"8db829a7-ed8a-48b3-a601-892b2b13b2f4\",\"connector\":{\"name\":\"smooth\"},\"z\":2,\"vertices\":[{\"x\":286,\"y\":158}],\"attrs\":{\"line\":{\"stroke\":\"#222222\",\"strokeWidth\":3}}},{\"type\":\"html.Element\",\"position\":{\"x\":103,\"y\":215},\"size\":{\"width\":100,\"height\":65},\"angle\":0,\"id\":\"1aa7a790-6a40-40b2-bb34-58072fece123\",\"label\":\"UDP/RTP source\",\"status\":\"up\",\"image_src\":\"<div><img src =\'./icon.png\'/></div>\",\"description\":\"\",\"url\":\"\",\"notes\":\"\",\"last_changed\":\"Sun, 10 Oct 2021 13:19:51 GMT\",\"z\":3,\"attrs\":{}},{\"type\":\"html.Element\",\"position\":{\"x\":137,\"y\":72},\"size\":{\"width\":100,\"height\":65},\"angle\":0,\"id\":\"d5284d0d-abb3-496d-a446-a15e1a8485ce\",\"label\":\"UDP/RTP source\",\"status\":\"up\",\"image_src\":\"<div><img src =\'./icon.png\'/></div>\",\"description\":\"\",\"url\":\"\",\"notes\":\"\",\"last_changed\":\"Sun, 10 Oct 2021 13:19:51 GMT\",\"z\":4,\"attrs\":{}}]}');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

DROP TABLE IF EXISTS `user_table`;
CREATE TABLE IF NOT EXISTS `user_table` (
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`email`, `password`, `name`, `type`) VALUES
('admin@admin.com', '$2y$10$IF/CEYgbjn12j3.K9CS2COAAUT5bjWp44k/zAMYheT3lja8S/GwlO', 'admin', 'admin'),
('yasir2@gmail.com', '$2y$10$BgacVA0CDN4EQkhEdUYB1OshkTumXDKYQIlgp1heBtfCZB1LfQg4O', '1', 'user'),
('yasir3@gmail.com', '$2y$10$9YmGGmqf2VoGgPn.tUsRfulyxOiduiBgJkXIQqPs0fAiNQUEtcTJi', 'Yasir', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
