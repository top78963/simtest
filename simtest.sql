-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2014 at 09:20 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `simtest`
--
CREATE DATABASE IF NOT EXISTS `simtest` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `simtest`;

-- --------------------------------------------------------

--
-- Table structure for table `quest`
--

CREATE TABLE IF NOT EXISTS `quest` (
  `quest_id` int(11) NOT NULL AUTO_INCREMENT,
  `command` text NOT NULL COMMENT 'คำสั่ง',
  `command_image` varchar(255) NOT NULL COMMENT 'รูปภาพ',
  `requirement` text,
  `requirement_image` varchar(255) NOT NULL COMMENT 'รูปภาพ',
  `type` enum('whitebox','blackbox') NOT NULL DEFAULT 'blackbox' COMMENT 'ประเภทการ test',
  `expected_options` text NOT NULL,
  PRIMARY KEY (`quest_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='ตาราง : โจทย์' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `quest`
--

INSERT INTO `quest` (`quest_id`, `command`, `command_image`, `requirement`, `requirement_image`, `type`, `expected_options`) VALUES
(1, 'Inputs should be space-separated and the expected output is case sensitive. An example input would be ''4 4 4'' and expected output ''Equilateral''.', 'files/images/map.png', 'Inputs should be space-separated and the expected output is case sensitive. An example input would be ''4 4 4'' and expected output ''Equilateral''.\r\nInputs should be space-separated and the expected output is case sensitive. An example input would be ''4 4 4'' and expected output ''Equilateral''.\r\nInputs should be space-separated and the expected output is case sensitive. An example input would be ''4 4 4'' and expected output ''Equilateral''.\r\nInputs should be space-separated and the expected output is case sensitive. An example input would be ''4 4 4'' and expected output ''Equilateral''.\r\nInputs should be space-separated and the expected output is case sensitive. An example input would be ''4 4 4'' and expected output ''Equilateral''.\r\nInputs should be space-separated and the expected output is case sensitive. An example input would be ''4 4 4'' and expected output ''Equilateral''.', '', 'blackbox', '1,2,3,4,5,6'),
(2, 'สี่เหลี่ยม', 'files/images/map.png', NULL, '', 'blackbox', '');

-- --------------------------------------------------------

--
-- Table structure for table `quest_requirement`
--

CREATE TABLE IF NOT EXISTS `quest_requirement` (
  `req_id` int(11) NOT NULL AUTO_INCREMENT,
  `quest_id` int(11) NOT NULL,
  `req_step` varchar(50) NOT NULL,
  `req_weight` smallint(6) NOT NULL,
  `requirement` text NOT NULL COMMENT 'ความต้องการ',
  `expected_skip` varchar(10) NOT NULL,
  PRIMARY KEY (`req_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='ตาราง  : หัวข้อทดสอบในโจทย์' AUTO_INCREMENT=8 ;

--
-- Dumping data for table `quest_requirement`
--

INSERT INTO `quest_requirement` (`req_id`, `quest_id`, `req_step`, `req_weight`, `requirement`, `expected_skip`) VALUES
(1, 1, '0,2,3', 1, 'ใส่ให้ครย', '2,3,4,5,6'),
(2, 1, '1,2,3', 2, 'เป็นจำนวนเต็ม', '2,3,4'),
(3, 1, '2', 3, 'น้อยกว่า 0 ', '3,4'),
(4, 1, '3', 4, 'เป็นด้านเท่า', ''),
(5, 1, '4', 5, 'หน้าจั่ว', ''),
(6, 1, '5', 6, 'เป็นสามเหลี่ยมด้านไม่เท่า', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(36) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `username`, `password`, `fullname`, `nickname`, `active`) VALUES
(1, 'testname', '', '', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
