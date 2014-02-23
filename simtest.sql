-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2014 at 02:59 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `simtest`
--

-- --------------------------------------------------------

--
-- Table structure for table `quest`
--

CREATE TABLE IF NOT EXISTS `quest` (
  `quest_id` int(11) NOT NULL AUTO_INCREMENT,
  `number` smallint(6) NOT NULL COMMENT 'เลขที่ข้อ',
  `command` text NOT NULL COMMENT 'คำสั่ง',
  `image` varchar(255) NOT NULL COMMENT 'รูปภาพ',
  `type` enum('whitebox','blackbox') NOT NULL DEFAULT 'blackbox' COMMENT 'ประเภทการ test',
  PRIMARY KEY (`quest_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='ตาราง : โจทย์' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `quest`
--

INSERT INTO `quest` (`quest_id`, `number`, `command`, `image`, `type`) VALUES
(1, 0, 'Inputs should be space-separated and the expected output is case sensitive. An example input would be ''4 4 4'' and expected output ''Equilateral''.', 'files/images/map.png', 'blackbox'),
(2, 1, 'สี่เหลี่ยม', 'files/images/map.png', 'blackbox');

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
(1, 1, '0,2,3', 1, '<b>-The Triangle program accepts three integer values as input. Each value represents a side of the triangle.</b>\r\n<br/>\r\n<b>-If the inputs are invalid (sides smaller than 0, or not integers) or if fewer than three values are provided the program outputs the message "Invalid input value(s)".</b>\r\n<br/>\r\n<b>-If all three sides of the triangle are of equal length the program will output the message "Equilateral".</b>\r\n<br/>', '2,3,4,5,6'),
(2, 1, '1,2,3', 2, '<b>If the length of the largest side is greater or equal to the sum of the lengths of the two smaller sides the program will output the message "Not a Triangle".</b>\r\n<br/>', '2,3,4'),
(3, 1, '2', 3, '<b>If all three sides of the triangle are of equal length the program will output the message "Equilateral".</b>\r\n<br/>', '3,4'),
(4, 1, '3', 4, '<b>If exactly two sides of the triangle are of equal length the program will output the message "Isosceles".</b>\r\n<br/>', ''),
(5, 1, '4', 5, '<b>If all three sides of the triangle are of different lengths the program will output the message "Scalene".</b>\r\n<br/>', ''),
(6, 1, '5', 6, '<b>  </b>\r\n<br/>', ''),
(7, 2, '6', 0, '<b>The Triangle program accepts three integer values as input. Each value represents a side of the triangle.</b>\r\n<br/>', '');

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
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `username`, `password`, `fullname`, `nickname`) VALUES
(1, 'testname', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
