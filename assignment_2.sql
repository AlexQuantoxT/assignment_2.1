-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 07, 2021 at 08:18 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_text` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `mentor_id` int(11) NOT NULL,
  `intern_id` int(11) NOT NULL,
  `comment_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`),
  KEY `mentor_id_idx` (`mentor_id`),
  KEY `intern_id_idx` (`intern_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_text`, `mentor_id`, `intern_id`, `comment_time`) VALUES
(1, 'This is a test comment.', 1, 2, '2021-10-04 11:57:53'),
(3, 'test test test', 2, 4, '2021-10-05 14:41:01'),
(4, 'test test test', 2, 4, '2021-10-05 15:00:08'),
(5, 'test test test', 2, 5, '2021-10-05 15:20:36'),
(6, 'test test test', 2, 5, '2021-10-05 15:20:43'),
(8, 'test test test', 7, 4, '2021-10-05 16:05:59'),
(9, 'test test test', 7, 4, '2021-10-05 16:16:54'),
(10, 'TEST TEST TEST', 7, 4, '2021-10-05 16:26:59'),
(11, 'test test test', 7, 4, '2021-10-05 16:17:38'),
(12, 'THIS IS A TEST COMMENT', 7, 4, '2021-10-07 13:37:25'),
(13, 'THIS IS A TEST COMMENT', 16, 4, '2021-10-07 13:39:11'),
(15, 'asdasdasdasd', 7, 4, '2021-10-07 14:48:23'),
(16, 'asdasdasdasd', 7, 4, '2021-10-07 14:49:41'),
(17, 'asdasdasdasd', 7, 4, '2021-10-07 14:50:12'),
(18, 'asdasdasdasd', 7, 4, '2021-10-07 14:50:45'),
(19, 'asdasdasdasd', 7, 4, '2021-10-07 14:51:21'),
(20, 'AleksaTEST', 7, 4, '2021-10-07 15:51:38'),
(23, 'AleksaTEST', 1, 4, '2021-10-07 15:57:22'),
(24, 'AleksaTEST', 7, 4, '2021-10-07 15:57:27'),
(26, 'AleksaTEST', 1, 5, '2021-10-07 15:58:19'),
(27, 'AleksaTEST', 7, 4, '2021-10-07 15:59:24');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(45) NOT NULL,
  PRIMARY KEY (`group_id`),
  UNIQUE KEY `groups_name_UNIQUE` (`group_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`) VALUES
(1, 'Group Be'),
(2, 'Group Fe');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(45) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'mentor'),
(2, 'intern');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `role_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `role_id_idx` (`role_id`),
  KEY `groups_id_idx` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `lastname`, `role_id`, `group_id`) VALUES
(1, 'test', 'test', 1, 1),
(2, 'Rob', 'Stark', 1, 2),
(4, 'Julia', 'Roberts', 2, 1),
(5, 'Sem', 'Jakson', 2, 2),
(6, 'Jack', 'Jackson', 1, 2),
(7, 'pera', 'test', 1, 1),
(8, 'pera', 'test', 1, 1),
(9, 'Demarcus', 'Langosh', 1, 2),
(10, 'Ivy', 'Hagenes', 1, 1),
(11, 'Audie', 'Bosco', 2, 1),
(12, 'Enrico', 'Fay', 2, 2),
(13, 'Ross', 'Ullrich', 2, 2),
(14, 'Myles', 'Steuber', 1, 1),
(15, 'Cortney', 'Kautzer', 1, 2),
(16, 'Alysa', 'Reinger', 1, 1),
(17, 'Jalyn', 'Reichel', 1, 2),
(18, 'Arthur', 'Ruecker', 2, 1),
(19, 'Chanel', 'Roberts', 2, 1),
(20, 'Gardner', 'Kunde', 1, 1),
(21, 'Grayson', 'Schaden', 1, 2),
(22, 'Elroy', 'Rolfson', 2, 1),
(29, 'Aleksa2', 'AleksaTest', 2, 2),
(30, 'Aleksa2', 'AleksaTest', 2, 2),
(31, 'Aleksa2', 'AleksaTest', 2, 2),
(32, 'Aleksa22', 'AleksaTest', 2, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `intern_id` FOREIGN KEY (`intern_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `mentor_id` FOREIGN KEY (`mentor_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `groups_id` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
