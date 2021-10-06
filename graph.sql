-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 06, 2021 at 07:27 PM
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
('{\"cells\":[{\"type\":\"html.Element\",\"position\":{\"x\":349,\"y\":228},\"size\":{\"width\":100,\"height\":50},\"angle\":0,\"id\":\"423a13d8-c431-4b20-95eb-58e5374232dd\",\"label\":\"label\",\"select\":\"box\",\"image_src\":\"<div><img src =\'./icon.png\'/></div>\",\"z\":1,\"attrs\":{}},{\"type\":\"html.Element\",\"position\":{\"x\":303,\"y\":44},\"size\":{\"width\":100,\"height\":50},\"angle\":0,\"id\":\"846e7b27-8ebb-4a59-944a-74985301d86b\",\"label\":\"label\",\"select\":\"box\",\"image_src\":\"<div><img src =\'./icon.png\'/></div>\",\"z\":2,\"attrs\":{}},{\"type\":\"html.Element\",\"position\":{\"x\":97,\"y\":154},\"size\":{\"width\":100,\"height\":50},\"angle\":0,\"id\":\"044e9e4b-a1d4-40f4-9db5-f444e9f2845d\",\"label\":\"label\",\"select\":\"box\",\"image_src\":\"<div><img src =\'./icon.png\'/></div>\",\"z\":3,\"attrs\":{}},{\"type\":\"standard.Link\",\"source\":{\"id\":\"044e9e4b-a1d4-40f4-9db5-f444e9f2845d\"},\"target\":{\"id\":\"846e7b27-8ebb-4a59-944a-74985301d86b\"},\"id\":\"e9acc243-d484-4428-9875-91a408818d81\",\"connector\":{\"name\":\"smooth\"},\"z\":4,\"vertices\":[{\"x\":250,\"y\":124}],\"attrs\":{\"line\":{\"stroke\":\"#222222\",\"strokeWidth\":3}}},{\"type\":\"standard.Link\",\"source\":{\"id\":\"846e7b27-8ebb-4a59-944a-74985301d86b\"},\"target\":{\"id\":\"423a13d8-c431-4b20-95eb-58e5374232dd\"},\"id\":\"b68e78b7-90cf-40e1-a98f-b00b887c249a\",\"connector\":{\"name\":\"smooth\"},\"z\":5,\"vertices\":[{\"x\":376,\"y\":161}],\"attrs\":{\"line\":{\"stroke\":\"#222222\",\"strokeWidth\":3}}},{\"type\":\"standard.Link\",\"source\":{\"id\":\"423a13d8-c431-4b20-95eb-58e5374232dd\"},\"target\":{\"id\":\"044e9e4b-a1d4-40f4-9db5-f444e9f2845d\"},\"id\":\"d7dce7c4-032f-4048-ba2e-784ddaa9fe2a\",\"connector\":{\"name\":\"smooth\"},\"z\":6,\"vertices\":[{\"x\":273,\"y\":216}],\"attrs\":{\"line\":{\"stroke\":\"#222222\",\"strokeWidth\":3}}}]}');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
