-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 19, 2021 at 09:32 AM
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
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `group_id` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `graph` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`graph`)),
  PRIMARY KEY (`group_id`,`email`),
  KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `email`, `graph`) VALUES
('Group 1', 'admin@admin.com', '{\"cells\":[{\"type\":\"html.Element\",\"position\":{\"x\":177,\"y\":168},\"size\":{\"width\":130,\"height\":75},\"angle\":0,\"id\":\"3d14c0f8-d82a-4a7e-8b23-cc446c28d347\",\"label\":\"My elem\",\"status\":\"down\",\"image_src\":\"<div><img src =\'./icon.png\'/></div>\",\"description\":\"my description\",\"url\":\"myurl\",\"notes\":\"new notes\",\"last_changed\":\"Sat, 16 Oct 2021 17:46:56 GMT\",\"z\":1,\"attrs\":{}},{\"type\":\"html.Element\",\"position\":{\"x\":676,\"y\":65},\"size\":{\"width\":130,\"height\":75},\"angle\":0,\"id\":\"dfcea2bb-e46f-4302-97da-b84842c78985\",\"label\":\"my elem 2\",\"status\":\"up\",\"image_src\":\"<div><img src =\'./icon.png\'/></div>\",\"description\":\"my description 2\",\"url\":\"myurl 2\",\"notes\":\"new notes\",\"last_changed\":\"Sat, 16 Oct 2021 17:47:42 GMT\",\"z\":2,\"attrs\":{}},{\"type\":\"standard.Link\",\"source\":{\"id\":\"3d14c0f8-d82a-4a7e-8b23-cc446c28d347\"},\"target\":{\"id\":\"dfcea2bb-e46f-4302-97da-b84842c78985\"},\"id\":\"122494be-3462-422a-9413-b11562f85e9b\",\"connector\":{\"name\":\"smooth\"},\"z\":3,\"vertices\":[{\"x\":491.5,\"y\":154}],\"attrs\":{\"line\":{\"stroke\":\"#222222\",\"strokeWidth\":3}}}]}'),
('test', 'yasir2@gmail.com', '{\"cells\":[{\"type\":\"html.Element\",\"position\":{\"x\":135,\"y\":129},\"size\":{\"width\":130,\"height\":75},\"angle\":0,\"id\":\"b7d607fa-6891-48d6-b05d-57350118acdb\",\"label\":\"Label\",\"status\":\"up\",\"image_src\":\"<div><img src =\'./icon.png\'/></div>\",\"last_changed\":\"Sun, 17 Oct 2021 16:45:44 GMT\",\"color\":\"#00ffbf\",\"z\":1,\"attrs\":{}},{\"type\":\"html.Element\",\"position\":{\"x\":593,\"y\":119},\"size\":{\"width\":130,\"height\":75},\"angle\":0,\"id\":\"ae2a4cb0-c594-42f0-8de8-fb9a6af17510\",\"label\":\"Label\",\"status\":\"up\",\"image_src\":\"<div><img src =\'./icon.png\'/></div>\",\"last_changed\":\"Sun, 17 Oct 2021 16:45:50 GMT\",\"color\":\"#ff0000\",\"z\":2,\"attrs\":{}},{\"type\":\"html.Element\",\"position\":{\"x\":342,\"y\":287},\"size\":{\"width\":130,\"height\":75},\"angle\":0,\"id\":\"fcd6b0a9-54b0-4d92-8f06-b2e67dfb7da3\",\"label\":\"Label\",\"status\":\"up\",\"image_src\":\"<div><img src =\'./icon.png\'/></div>\",\"last_changed\":\"Sun, 17 Oct 2021 16:46:01 GMT\",\"color\":\"#000000\",\"z\":3,\"attrs\":{}},{\"type\":\"html.Element\",\"position\":{\"x\":351,\"y\":121},\"size\":{\"width\":130,\"height\":75},\"angle\":0,\"id\":\"7b76f5de-87ff-47f2-8858-3bcb761469fa\",\"label\":\"Label\",\"status\":\"down\",\"image_src\":\"<div><img src =\'./icon.png\'/></div>\",\"description\":\"\",\"url\":\"\",\"notes\":\"\",\"last_changed\":\"Sun, 17 Oct 2021 19:30:39 GMT\",\"color\":\"#dc3545\",\"z\":4,\"attrs\":{}},{\"type\":\"standard.Link\",\"source\":{\"id\":\"fcd6b0a9-54b0-4d92-8f06-b2e67dfb7da3\"},\"target\":{\"id\":\"ae2a4cb0-c594-42f0-8de8-fb9a6af17510\"},\"id\":\"ccdea01a-2d66-4b29-ab6d-309a6856de1b\",\"connector\":{\"name\":\"smooth\"},\"z\":5,\"vertices\":[{\"x\":532.5,\"y\":240.5}],\"attrs\":{\"line\":{\"stroke\":\"#222222\",\"strokeWidth\":3}}},{\"type\":\"standard.Link\",\"source\":{\"id\":\"b7d607fa-6891-48d6-b05d-57350118acdb\"},\"target\":{\"id\":\"fcd6b0a9-54b0-4d92-8f06-b2e67dfb7da3\"},\"id\":\"f5e83c90-6e80-4275-9eb7-c258b3e12605\",\"connector\":{\"name\":\"smooth\"},\"z\":6,\"vertices\":[{\"x\":303.5,\"y\":245.5}],\"attrs\":{\"line\":{\"stroke\":\"#222222\",\"strokeWidth\":3}}},{\"type\":\"standard.Link\",\"source\":{\"id\":\"7b76f5de-87ff-47f2-8858-3bcb761469fa\"},\"target\":{\"id\":\"ae2a4cb0-c594-42f0-8de8-fb9a6af17510\"},\"id\":\"b27bb492-734d-47a8-89bd-a21213f90b92\",\"connector\":{\"name\":\"smooth\"},\"z\":7,\"vertices\":[{\"x\":537,\"y\":157.5}],\"attrs\":{\"line\":{\"stroke\":\"#222222\",\"strokeWidth\":3}}},{\"type\":\"standard.Link\",\"source\":{\"id\":\"b7d607fa-6891-48d6-b05d-57350118acdb\"},\"target\":{\"id\":\"7b76f5de-87ff-47f2-8858-3bcb761469fa\"},\"id\":\"f63cbc04-f421-4724-a383-a48a50442f9d\",\"connector\":{\"name\":\"smooth\"},\"z\":8,\"vertices\":[{\"x\":308,\"y\":162.5}],\"attrs\":{\"line\":{\"stroke\":\"#222222\",\"strokeWidth\":3}}},{\"type\":\"html.Element\",\"position\":{\"x\":621,\"y\":280},\"size\":{\"width\":130,\"height\":75},\"angle\":0,\"id\":\"ab760dea-70fe-49ae-a007-1a33830d130f\",\"label\":\"Label\",\"status\":\"up\",\"image_src\":\"<div><img src =\'./icon.png\'/></div>\",\"last_changed\":\"Sun, 17 Oct 2021 19:31:04 GMT\",\"color\":\"#fff700\",\"z\":9,\"attrs\":{}},{\"type\":\"standard.Link\",\"source\":{\"id\":\"fcd6b0a9-54b0-4d92-8f06-b2e67dfb7da3\"},\"target\":{\"id\":\"ab760dea-70fe-49ae-a007-1a33830d130f\"},\"id\":\"7c48f9e7-dbf6-4f4f-b3f5-e88ecb4fc755\",\"connector\":{\"name\":\"smooth\"},\"z\":10,\"vertices\":[{\"x\":546.5,\"y\":321}],\"attrs\":{\"line\":{\"stroke\":\"#222222\",\"strokeWidth\":3}}}]}');

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
