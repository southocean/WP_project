-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2015 at 05:12 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `thitracnghiem`
--
CREATE DATABASE IF NOT EXISTS `thitracnghiem` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `thitracnghiem`;

-- --------------------------------------------------------

--
-- Table structure for table `exam_questions`
--

CREATE TABLE IF NOT EXISTS `exam_questions` (
  `eqID` int(11) NOT NULL AUTO_INCREMENT,
  `testID` int(11) NOT NULL,
  `qID` int(11) NOT NULL,
  `A` int(11) NOT NULL,
  `B` int(11) NOT NULL,
  `C` int(11) NOT NULL,
  `D` int(11) NOT NULL,
  `index` int(11) NOT NULL,
  PRIMARY KEY (`eqID`),
  KEY `testID` (`testID`),
  KEY `qID` (`qID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `exam_questions`
--

INSERT INTO `exam_questions` (`eqID`, `testID`, `qID`, `A`, `B`, `C`, `D`, `index`) VALUES
(1, 1, 7, 4, 2, 1, 3, 1),
(2, 1, 6, 3, 4, 1, 2, 2),
(3, 1, 14, 3, 1, 2, 4, 3),
(4, 2, 10, 1, 2, 4, 3, 1),
(5, 2, 8, 3, 1, 2, 4, 2),
(6, 2, 6, 2, 3, 1, 4, 3),
(7, 3, 11, 2, 1, 3, 4, 1),
(8, 3, 9, 3, 1, 4, 2, 2),
(9, 3, 7, 2, 1, 4, 3, 3),
(10, 4, 12, 4, 1, 3, 2, 1),
(11, 4, 9, 3, 2, 4, 1, 2),
(12, 4, 13, 3, 1, 2, 4, 3),
(13, 5, 5, 3, 2, 1, 4, 1),
(14, 5, 8, 4, 1, 3, 2, 2),
(15, 5, 9, 3, 1, 4, 2, 3),
(16, 6, 6, 3, 4, 1, 2, 1),
(17, 6, 29, 4, 3, 1, 2, 2),
(18, 6, 9, 2, 3, 4, 1, 3),
(19, 6, 5, 2, 4, 1, 3, 4),
(20, 6, 7, 4, 3, 1, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `qID` int(11) NOT NULL AUTO_INCREMENT,
  `qStatement` text COLLATE utf8_unicode_ci,
  `qAns` int(11) NOT NULL,
  `option_1` text COLLATE utf8_unicode_ci,
  `option_2` text COLLATE utf8_unicode_ci,
  `option_3` text COLLATE utf8_unicode_ci,
  `option_4` text COLLATE utf8_unicode_ci,
  `topID` int(11) DEFAULT NULL,
  `sbID` int(11) DEFAULT NULL,
  `correctNum` int(11) DEFAULT NULL,
  `totalNum` int(11) DEFAULT NULL,
  `uID` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`qID`),
  KEY `topID` (`topID`),
  KEY `uID` (`uID`),
  KEY `sbID` (`sbID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qID`, `qStatement`, `qAns`, `option_1`, `option_2`, `option_3`, `option_4`, `topID`, `sbID`, `correctNum`, `totalNum`, `uID`, `created`, `modified`) VALUES
(4, '1 + 1 = ?', 2, '1', '2', '3', '4', 1, 6, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, '12', 1, '123', '213', '123', '123', 1, 6, 5, 5, 0, '0000-00-00 00:00:00', '2015-05-23 06:58:41'),
(6, '21312', 2, '3123123', '12312313', '123123', '12312313', 1, 6, 8, 61, 0, '0000-00-00 00:00:00', '2015-05-23 16:41:46'),
(7, '1 + 1 = ?', 2, '1', '2', '3', '4', 1, 6, 4, 62, 0, '0000-00-00 00:00:00', '2015-05-23 16:41:46'),
(8, '1', 1, '1', '1', '1', '1', 1, 6, 2, 10, 0, '0000-00-00 00:00:00', '2015-05-21 20:26:46'),
(9, '1', 2, '4', '4', '45', '5', 5, 6, 0, 2, 0, '0000-00-00 00:00:00', '2015-05-21 20:24:39'),
(10, '1', 2, '4', '4', '45', '5', 5, 1, 2, 14, 0, '0000-00-00 00:00:00', '2015-05-20 11:59:53'),
(11, '1', 1, '1', '1', '1', '1', 1, 1, 4, 4, 0, '0000-00-00 00:00:00', '2015-05-21 20:23:24'),
(12, '121e3', 4, '4545', '45', '45', 'e4324', 5, 1, 0, 2, 0, '0000-00-00 00:00:00', '2015-05-16 17:18:55'),
(13, '121e3', 4, '4545', '45', '45', 'e4324', 5, 1, 0, 1, 0, '0000-00-00 00:00:00', '2015-05-21 20:15:40'),
(14, '1', 1, '1', '1', '1', '1', 1, 1, 2, 55, 0, '0000-00-00 00:00:00', '2015-05-23 16:41:46'),
(25, 'Hưởng là ai?', 1, 'Hưởng', 'Hảo', 'Nam', 'Dũng', 0, 0, 2, 2, 1, '2015-05-05 20:32:27', '2015-05-23 06:58:39'),
(26, 'Hưởng là ai?', 1, 'Hưởng', 'Hảo', 'Nam', 'Dũng', 0, 0, 0, 0, 1, '2015-05-05 20:33:21', '2015-05-05 20:33:21'),
(27, 'Hưởng là ai?', 1, 'Hưởng', 'Hảo', 'Nam', 'Dũng', 0, 0, 0, 0, 1, '2015-05-05 20:34:50', '2015-05-05 20:34:50'),
(24, 'Hưởng là ai?', 1, 'Hưởng', 'Hảo', 'Nam', 'Dũng', 0, 0, 2, 2, 1, '2015-05-05 20:30:37', '2015-05-17 16:19:44'),
(22, 'Who you are?', 1, 'Hưởng', 'Hảo', 'Nam ', 'Dũng', 1, 8, 4, 4, 0, '2015-04-22 20:31:02', '2015-05-21 20:26:49'),
(23, 'Who you are?', 1, 'Hưởng', 'Hảo', 'Nam ', 'Dũng', 1, 8, 2, 2, 1, '2015-04-22 20:32:18', '2015-05-16 17:18:59'),
(29, 'Hưởng là ai?', 1, 'Hưởng', 'Hảo', 'Nam', 'Dũng', 2, 6, 2, 2, 1, '2015-05-05 20:36:45', '2015-05-16 17:19:02');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `sbID` int(11) NOT NULL AUTO_INCREMENT,
  `sbName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`sbID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`sbID`, `sbName`, `created`, `modified`) VALUES
(6, 'Toán', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Hóa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Lý', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Văn', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Sinh', '2015-04-13 06:46:04', '2015-04-13 06:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE IF NOT EXISTS `tests` (
  `testID` int(11) NOT NULL AUTO_INCREMENT,
  `uID` int(11) NOT NULL,
  `sbID` int(11) DEFAULT NULL,
  `testLevel` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`testID`),
  KEY `uID` (`uID`),
  KEY `sbID` (`sbID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`testID`, `uID`, `sbID`, `testLevel`, `created`, `modified`, `time`) VALUES
(1, 1, 6, 5, '2015-04-22 17:14:35', '2015-04-22 17:14:35', 1),
(2, 1, 7, 5, '2015-04-22 17:30:08', '2015-04-22 17:30:08', 10),
(3, 1, 6, 5, '2015-04-22 17:31:14', '2015-04-22 17:31:14', 3),
(4, 1, 1, 5, '2015-05-05 20:19:40', '2015-05-05 20:19:40', 5),
(5, 1, 6, 0, '2015-05-06 19:34:01', '2015-05-06 19:34:01', 40),
(6, 1, 6, 10, '2015-05-06 19:37:39', '2015-05-06 19:37:39', 20);

-- --------------------------------------------------------

--
-- Table structure for table `test_result`
--

CREATE TABLE IF NOT EXISTS `test_result` (
  `trID` int(11) NOT NULL AUTO_INCREMENT,
  `uID` int(11) NOT NULL,
  `testID` int(11) NOT NULL,
  `score` float DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`trID`),
  KEY `uID` (`uID`),
  KEY `testID` (`testID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=77 ;

--
-- Dumping data for table `test_result`
--

INSERT INTO `test_result` (`trID`, `uID`, `testID`, `score`, `created`) VALUES
(21, 1, 1, 0, '2015-05-08 18:42:33'),
(2, 1, 1, 3.33, '2015-05-05 19:57:01'),
(3, 1, 1, 3.33, '2015-05-05 19:59:51'),
(4, 1, 1, 3.33, '2015-05-05 20:06:46'),
(5, 1, 1, 3.33, '2015-05-05 20:06:50'),
(6, 1, 1, 3.33, '2015-05-05 20:06:52'),
(7, 1, 1, 3.33, '2015-05-05 20:06:53'),
(8, 1, 1, 3.33, '2015-05-05 20:10:59'),
(9, 1, 1, 0, '2015-05-06 19:04:48'),
(10, 1, 1, 0, '2015-05-06 19:10:21'),
(11, 1, 1, 0, '2015-05-07 17:11:16'),
(12, 1, 1, 3.33, '2015-05-07 17:44:24'),
(13, 1, 1, 3.33, '2015-05-07 17:46:38'),
(14, 1, 1, 3.33, '2015-05-07 17:50:31'),
(15, 1, 1, 3.33, '2015-05-07 18:17:33'),
(16, 1, 1, 3.33, '2015-05-07 18:18:33'),
(17, 1, 1, 3.33, '2015-05-07 18:19:32'),
(18, 1, 1, 3.33, '2015-05-07 18:20:30'),
(19, 1, 1, 3.33, '2015-05-07 18:21:44'),
(20, 1, 1, 3.33, '2015-05-07 18:21:57'),
(22, 1, 1, 0, '2015-05-08 18:42:58'),
(23, 0, 1, 0, '2015-05-08 19:00:08'),
(24, 1, 1, 0, '2015-05-08 19:01:02'),
(25, 1, 1, 0, '2015-05-08 19:01:47'),
(26, 1, 1, 0, '2015-05-08 19:02:06'),
(27, 1, 1, 0, '2015-05-08 19:02:58'),
(28, 1, 1, 0, '2015-05-15 17:36:20'),
(29, 1, 1, 0, '2015-05-15 17:49:49'),
(30, 1, 1, 3.33, '2015-05-15 20:08:14'),
(31, 1, 1, 0, '2015-05-15 20:08:30'),
(32, 1, 1, 0, '2015-05-15 20:20:04'),
(33, 1, 1, 0, '2015-05-15 20:21:50'),
(34, 1, 1, 0, '2015-05-15 20:21:59'),
(35, 1, 1, 0, '2015-05-15 20:25:40'),
(36, 1, 1, 0, '2015-05-15 20:46:41'),
(37, 1, 1, 0, '2015-05-15 20:49:22'),
(38, 1, 1, 0, '2015-05-17 16:20:52'),
(39, 1, 1, 0, '2015-05-17 16:21:02'),
(40, 1, 1, 0, '2015-05-18 19:28:43'),
(41, 1, 1, 0, '2015-05-18 19:31:19'),
(42, 1, 1, 0, '2015-05-18 19:32:25'),
(43, 1, 1, 0, '2015-05-18 19:33:31'),
(44, 1, 1, 0, '2015-05-18 19:35:37'),
(45, 1, 1, 0, '2015-05-18 19:45:37'),
(46, 1, 1, 3.33, '2015-05-18 19:48:20'),
(47, 1, 1, 0, '2015-05-18 19:51:21'),
(48, 1, 1, 0, '2015-05-18 19:52:46'),
(49, 1, 2, 0, '2015-05-18 20:11:49'),
(50, 1, 2, 0, '2015-05-18 20:22:12'),
(51, 1, 2, 0, '2015-05-18 20:32:37'),
(52, 1, 1, 0, '2015-05-20 10:41:59'),
(53, 1, 2, 0, '2015-05-20 11:49:14'),
(54, 1, 2, 0, '2015-05-20 11:59:53'),
(55, 2, 1, 0, '2015-05-21 19:34:01'),
(56, 2, 1, 0, '2015-05-21 19:35:26'),
(57, 2, 1, 0, '2015-05-21 19:37:48'),
(58, 2, 1, 10, '2015-05-21 19:43:12'),
(59, 2, 1, 10, '2015-05-21 19:44:31'),
(60, 2, 1, 0, '2015-05-21 19:50:55'),
(61, 2, 1, 0, '2015-05-21 19:51:57'),
(62, 2, 1, 0, '2015-05-21 19:53:39'),
(63, 2, 1, 0, '2015-05-21 19:54:12'),
(64, 2, 1, 0, '2015-05-21 19:55:48'),
(65, 2, 1, 0, '2015-05-21 19:55:58'),
(66, 2, 1, 0, '2015-05-21 19:56:36'),
(67, 2, 1, 0, '2015-05-21 19:59:29'),
(68, 2, 1, 0, '2015-05-21 20:01:44'),
(69, 2, 1, 0, '2015-05-21 20:02:55'),
(70, 2, 1, 0, '2015-05-21 20:04:26'),
(71, 2, 1, 0, '2015-05-21 20:06:04'),
(72, 2, 1, 0, '2015-05-21 20:06:27'),
(73, 2, 1, 3.33, '2015-05-21 20:07:42'),
(74, 2, 1, 3.33, '2015-05-21 20:08:58'),
(75, 2, 1, 0, '2015-05-21 20:09:15'),
(76, 1, 1, 0, '2015-05-23 16:40:45');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `topID` int(11) NOT NULL AUTO_INCREMENT,
  `topName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`topID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topID`, `topName`, `created`, `modified`) VALUES
(1, 'Hóa hữu cơ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Đại Số', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `school` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `is_banned` tinyint(4) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uID`),
  UNIQUE KEY `uID` (`uID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uID`, `username`, `email`, `password`, `birthday`, `gender`, `school`, `avatar`, `role`, `is_banned`, `active`, `created`, `modified`, `status`) VALUES
(1, 'adminad', 'nguyentienhuong2893@yahoo.com.vn', 'a70d24726bde10d95c75df8b6c22518f7e0622dd', NULL, NULL, NULL, NULL, 'teacher', 0, 1, '2015-04-21 18:55:53', '2015-04-21 18:55:53', 1),
(2, 'student', 'student@student.com', 'a70d24726bde10d95c75df8b6c22518f7e0622dd', NULL, NULL, NULL, NULL, 'student', 0, 0, '2015-05-10 05:24:46', '2015-05-10 05:24:46', 1),
(3, 'Teacher', 'nguyentienhuong93@gmail.com', 'a70d24726bde10d95c75df8b6c22518f7e0622dd', NULL, NULL, NULL, NULL, 'teacher', 0, 0, '2015-05-22 11:08:53', '2015-05-22 11:08:53', 1),
(27, 'huongxxx', 'xnguyenhuong@yopmail.com', 'a70d24726bde10d95c75df8b6c22518f7e0622dd', '1995-05-23', 1, '', NULL, 'student', 0, 0, '2015-05-23 13:05:07', '2015-05-23 13:05:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_levels`
--

CREATE TABLE IF NOT EXISTS `user_levels` (
  `ulID` int(11) NOT NULL AUTO_INCREMENT,
  `uID` int(11) NOT NULL,
  `sbID` int(11) NOT NULL,
  `correctNum` int(11) DEFAULT '0',
  `totalNum` int(11) DEFAULT '0',
  PRIMARY KEY (`ulID`),
  KEY `uID` (`uID`),
  KEY `sbID` (`sbID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `user_levels`
--

INSERT INTO `user_levels` (`ulID`, `uID`, `sbID`, `correctNum`, `totalNum`) VALUES
(13, 2, 6, 6, 8),
(15, 1, 6, 1, 10),
(14, 2, 8, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
