-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 10, 2024 at 05:48 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user-registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `architects`
--

DROP TABLE IF EXISTS `architects`;
CREATE TABLE IF NOT EXISTS `architects` (
  `ArchitectID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `ProjectCategory` varchar(255) DEFAULT NULL,
  `WorkedWith` varchar(255) DEFAULT NULL,
  `ProfileImage` varchar(255) DEFAULT NULL,
  `reviews` int DEFAULT '0',
  PRIMARY KEY (`ArchitectID`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `architects`
--

INSERT INTO `architects` (`ArchitectID`, `Name`, `ProjectCategory`, `WorkedWith`, `ProfileImage`, `reviews`) VALUES
(10, 'Harry Potter', 'Residential', 'Grace Hopper', 'images/profiles/profile10.jpg', 5),
(7, 'Eve Black', 'Residential', 'David Green', 'images/profiles/profile7.jpg', 1),
(6, 'David Green', 'Industrial', 'Carol White', 'images/profiles/profile6.jpg', 1),
(4, 'Bob Brown', 'Residential', 'Alice Johnson', 'images/profiles/profile4.jpg', 5),
(2, 'Jane Smith', 'Commercial', 'Alice Johnson', 'images/profiles/profile2.jpg', 0),
(1, 'John Doe', 'Residential', 'Jane Smith', 'images/profiles/profile1.jpg', 0),
(11, 'Irene Adler', 'Commercial', 'Harry Potter', 'images/profiles/profile11.jpg', 5),
(13, 'Kevin Bacon', 'Residential', 'Jason Bourne', 'images/profiles/profile13.jpg', 0),
(12, 'Jason Bourne', 'Industrial', 'Irene Adler', 'images/profiles/profile12.jpg', 0),
(14, 'Laura Croft', 'Commercial', 'Kevin Bacon', 'images/profiles/profile14.jpg', 0),
(16, 'Ned Stark', 'Residential', 'Mona Lisa', 'images/profiles/profile16.jpg', 0),
(18, 'Peter Parker', 'Industrial', 'Olivia Pope', 'images/profiles/profile18.jpg', 0),
(17, 'Olivia Pope', 'Commercial', 'Ned Stark', 'images/profiles/profile17.jpg', 0),
(58, 'EYA TAGHOUTI', 'foolin', 'everybody', 'images/default_profile.jpg', 1),
(20, 'Rachel Green', 'Commercial', 'Quentin Tarantino', 'images/profiles/profile20.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `commentsection`
--

DROP TABLE IF EXISTS `commentsection`;
CREATE TABLE IF NOT EXISTS `commentsection` (
  `Comments` varchar(1000) DEFAULT NULL,
  `ArchitectID` int DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `time_added` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ArchitectID` (`ArchitectID`),
  KEY `fk_userName` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `commentsection`
--

INSERT INTO `commentsection` (`Comments`, `ArchitectID`, `id`, `username`, `time_added`) VALUES
('hii', 1, 50, 'yassine', '2024-04-24 08:59:02'),
('hlloo\r\n', 1, 51, 'Houssain', '2024-04-24 11:41:12'),
('COOL WORK', 4, 58, 'hoss', '2024-05-09 16:15:00'),
('great work!! ', 1, 56, 'taghouti', '2024-04-30 08:29:49'),
('yoo', 1, 48, 'yassine', '2024-04-24 08:57:48'),
('yoo', 1, 45, 'admin', '2024-04-23 00:18:22'),
('i love your workk >_<\r\n', 1, 30, 'Houssain', '2024-04-22 23:52:10'),
('hiii\r\n', 1, 29, 'Houssain', '2024-04-22 23:51:55'),
('hiii', 20, 27, 'Houssain', '2024-04-22 21:40:42'),
('how are youu', 20, 28, 'Houssain', '2024-04-22 21:40:48'),
('hrll', 22, 53, 'admin', '2024-04-25 20:45:17'),
('hrll', 22, 54, 'admin', '2024-04-25 20:46:57');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `ProjectName` varchar(200) DEFAULT NULL,
  `ProjectImage` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Category` varchar(200) DEFAULT NULL,
  `architectid` int DEFAULT NULL,
  `ProjectId` int NOT NULL AUTO_INCREMENT,
  `reviews` int DEFAULT '0',
  PRIMARY KEY (`ProjectId`),
  KEY `architectid` (`architectid`)
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`ProjectName`, `ProjectImage`, `Category`, `architectid`, `ProjectId`, `reviews`) VALUES
('Project006', '006.jpeg', 'Commercial', 10, 4, 5),
('Project005', '005.jpeg', 'Commercial', 4, 5, 0),
('Project003', '003.jpeg', 'Industrial', 11, 7, 0),
('Project001', '001.jpeg', 'Industrial', 16, 9, 1),
('Project019', '019.jpeg', 'Commercial', 14, 11, 0),
('Project018', '018.jpeg', 'Residential', 20, 12, 4),
('Project014', '014.jpeg', 'Industrial', 2, 16, 1),
('Project013', '013.jpeg', 'Industrial', 12, 17, 0),
('Project011', '011.jpeg', 'Commercial', 6, 19, 0),
('Project029', '029.jpeg', 'Residential', 2, 21, 0),
('Project028', '028.jpeg', 'Commercial', 13, 22, 0),
('Project025', '025.jpeg', 'Commercial', 14, 25, 0),
('Project024', '024.jpeg', 'Residential', 1, 26, 0),
('Project023', '023.jpeg', 'Commercial', 17, 27, 5),
('Project022', '022.jpeg', 'Residential', 16, 28, 0),
('Project021', '021.jpeg', 'Industrial', 13, 29, 0),
('Project040', '040.jpeg', 'Industrial', 20, 30, 0),
('Project039', '039.jpeg', 'Commercial', 4, 31, 0),
('Project038', '038.jpeg', 'Industrial', 7, 32, 0),
('Project037', '037.jpeg', 'Industrial', 13, 33, 0),
('Project035', '035.jpeg', 'Industrial', 6, 35, 0),
('Project034', '034.jpeg', 'Commercial', 4, 36, 5),
('Project033', '033.jpeg', 'Industrial', 20, 37, 0),
('Project049', '049.jpeg', 'Commercial', 4, 41, 0),
('Project047', '047.jpeg', 'Residential', 7, 43, 0),
('Project045', '045.jpeg', 'Residential', 14, 45, 0),
('Project044', '044.jpeg', 'Residential', 12, 46, 0),
('Project060', '060.jpeg', 'Commercial', 16, 50, 0),
('Project059', '059.jpeg', 'Commercial', 12, 51, 0),
('Project055', '055.jpeg', 'Commercial', 10, 55, 0),
('Project054', '054.jpeg', 'Industrial', 2, 56, 0),
('Project053', '053.jpeg', 'Residential', 2, 57, 0),
('Project052', '052.jpeg', 'Commercial', 20, 58, 0),
('Project051', '051.jpeg', 'Industrial', 17, 59, 0),
('Project070', '070.jpeg', 'Residential', 17, 60, 0),
('Project069', '069.jpeg', 'Commercial', 12, 61, 0),
('Project068', '068.jpeg', 'Commercial', 10, 62, 0),
('Project064', '064.jpeg', 'Commercial', 14, 66, 0),
('Project080', '080.jpeg', 'Industrial', 10, 70, 0),
('Project079', '079.jpeg', 'Commercial', 11, 71, 0),
('Project077', '077.jpeg', 'Industrial', 2, 73, 0),
('Project076', '076.jpeg', 'Industrial', 17, 74, 0),
('Project074', '074.jpeg', 'Commercial', 4, 76, 0),
('Project073', '073.jpeg', 'Residential', 1, 77, 0),
('Project072', '072.jpeg', 'Residential', 7, 78, 0),
('Project071', '071.jpeg', 'Industrial', 14, 79, 0),
('Project088', '088.jpeg', 'Commercial', 11, 82, 5),
('Project086', '086.jpeg', 'Commercial', 13, 84, 0),
('Project085', '085.jpeg', 'Industrial', 17, 85, 0),
('Project084', '084.jpeg', 'Residential', 12, 86, 0),
('Project100', '100.jpeg', 'Commercial', 10, 90, 0),
('Project099', '099.jpeg', 'Industrial', 2, 91, 0),
('Project098', '098.jpeg', 'Residential', 12, 92, 0),
('Project096', '096.jpeg', 'Residential', 11, 94, 0),
('Project095', '095.jpeg', 'Residential', 17, 95, 0),
('Project094', '094.jpeg', 'Residential', 17, 96, 0),
('Project093', '093.jpeg', 'Commercial', 6, 97, 0),
('Project092', '092.jpeg', 'Commercial', 2, 98, 0),
('Project091', '091.jpeg', 'Residential', 7, 99, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `mail` varchar(30) DEFAULT NULL,
  `userid` int NOT NULL AUTO_INCREMENT,
  `telephone` int DEFAULT NULL,
  `image` varchar(400) DEFAULT 'default_profile.jpg',
  `company` varchar(100) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `mail`, `userid`, `telephone`, `image`, `company`, `address`) VALUES
('yassine', 'yassine', 'yassine@gmail.com', 12, 98652315, 'images/profile_picture/438238488_340863568603688_3598359885118235705_n.jpg', 'Empty', 'Empty'),
('houssaina', 'darkhou', 'houssaina@gmail.com', 11, 27286244, 'default_profile.jpg', 'Empty', 'Empty'),
('yasmine', 'houssain', 'yasmine@gmail.com', 10, 28627288, 'default_profile.jpg', 'Empty', 'Empty'),
('admin', 'admin', 'admin@gmail.com', 9, 27286244, 'images/default_profile.jpg', 'Empty', 'Empty'),
('hoss', 'darkhou', 'houssainalouani123@gmail.com', 7, 27286244, 'images/Profile_picture/houssain.jpg', 'Empty', 'Empty'),
('taghouti', '123', 'taghouti@gmail.com', 15, 123, 'default_profile.jpg', 'Empty', 'Empty'),
('dda', 'dad', 'dad@gmail.com', 13, 27286244, 'default_profile.jpg', 'Empty', 'Empty'),
('ahmed1', 'ahmed', 'ahmed@gmail.com', 14, 27286344, 'default_profile.jpg', 'Empty', 'Empty');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
