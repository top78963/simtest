-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2014 at 03:47 PM
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
-- Table structure for table `player`
--

CREATE TABLE IF NOT EXISTS `player` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`uid`, `name`) VALUES
(1, 'testname');

-- --------------------------------------------------------

--
-- Table structure for table `quest`
--

CREATE TABLE IF NOT EXISTS `quest` (
  `ques_id` int(11) NOT NULL AUTO_INCREMENT,
  `number` smallint(6) NOT NULL COMMENT 'ลำดับข้อ',
  `command` text NOT NULL,
  `requirement` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` enum('whitebox','blackbox') NOT NULL DEFAULT 'blackbox',
  PRIMARY KEY (`ques_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `quest`
--

INSERT INTO `quest` (`ques_id`, `number`, `command`, `requirement`, `image`, `type`) VALUES
(1, 0, 'Inputs should be space-separated and the expected output is case sensitive. An example input would be ''4 4 4'' and expected output ''Equilateral''.', '<ul>\r\n	<li>\r\nThe Triangle program accepts three integer values as input. Each value represents a side of the triangle.\r\n	</li>\r\n 	<li>\r\n	If all three sides of the triangle are of equal length the program will output the message "Equilateral".\r\n	</li>\r\n</ul>\r\n', 'files/images/map.png', 'blackbox'),
(2, 1, 'dcfsdfsdf', 'dfdsfsdf', 'files/images/map.png', 'blackbox');

-- --------------------------------------------------------

--
-- Table structure for table `quest_requirement`
--

CREATE TABLE IF NOT EXISTS `quest_requirement` (
  `req_id` int(11) NOT NULL AUTO_INCREMENT,
  `req_name` varchar(50) DEFAULT NULL,
  `req_cond` text,
  `req_result` varchar(50) DEFAULT NULL,
  `req_weight` smallint(6) DEFAULT NULL,
  `quest_id` int(11) NOT NULL,
  PRIMARY KEY (`req_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `quest_requirement`
--

INSERT INTO `quest_requirement` (`req_id`, `req_name`, `req_cond`, `req_result`, `req_weight`, `quest_id`) VALUES
(1, 'Triangle1', 'function cond_1($a_var) {\r\n    // check input number\r\n    if (count($a_var) != 3) {\r\n        return FALSE;\r\n    }\r\n    // check int\r\n    foreach ($a_var as $value) {\r\n        if ((int) $value != $value) {\r\n            return FALSE;\r\n        }\r\n    }\r\n\r\n    // check Less than Zero\r\n    foreach ($a_var as $value) {\r\n        if ($value <= 0) {\r\n            return FALSE;\r\n        }\r\n    }\r\n \r\n  return TRUE;\r\n\r\n}\r\n', 'Invalid input value(s)', 1, 1),
(2, 'Triangle2', 'function cond_2($a_var) {\r\n    $max = max($a_var);\r\n    $key = array_search($max, $a_var);\r\n    unset($a_var[$key]);\r\n    $sum = array_sum($a_var);\r\n//echo $sum;\r\n    if ($max >= $sum) {\r\n        return FALSE;\r\n    }\r\n    return TRUE;\r\n}', 'Not a Triangle', 2, 1),
(3, 'Triangle3', 'function cond_3($a_var) {\r\n	$temp_a= array_unique($a_var);\r\n    \r\n    if (count($temp_a)==1) {\r\n        return FALSE;\r\n    }\r\n    return TRUE;\r\n}', 'Equilateral', 3, 1),
(4, 'Triangle4', 'function cond_4($a_var) {\r\n 	$temp_a= array_unique($a_var);\r\n    \r\n    if (count($temp_a)==2) {\r\n        return FALSE;\r\n    }\r\n    return TRUE;\r\n}', 'Isosceles', 4, 1),
(5, 'Triangle5', 'function cond_5($a_var) {\r\n	$temp_a= array_unique($a_var);\r\n    \r\n    if (count($temp_a)==3) {\r\n         return FALSE;\r\n    }\r\n    return TRUE;\r\n}', 'Scalene', 5, 1),
(6, 'Triangle6', 'function cond_6($a_var) {\r\n     if (($a_var) < 200) {\r\n         return FALSE;\r\n    }\r\n   \r\n    return TRUE;\r\n}', 'Error', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `quest_score`
--

CREATE TABLE IF NOT EXISTS `quest_score` (
  `ques_id` int(11) NOT NULL AUTO_INCREMENT,
  `number` smallint(6) NOT NULL COMMENT 'ลำดับข้อ',
  `command` text NOT NULL,
  `requirement` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` enum('whitebox','blackbox') NOT NULL DEFAULT 'blackbox',
  PRIMARY KEY (`ques_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `quest_score`
--

INSERT INTO `quest_score` (`ques_id`, `number`, `command`, `requirement`, `image`, `type`) VALUES
(1, 0, 'Inputs should be space-separated and the expected output is case sensitive. An example input would be ''4 4 4'' and expected output ''Equilateral''.', '<ul>\r\n	<li>\r\nThe Triangle program accepts three integer values as input. Each value represents a side of the triangle.\r\n	</li>\r\n 	<li>\r\n	If all three sides of the triangle are of equal length the program will output the message "Equilateral".\r\n	</li>\r\n</ul>\r\n', 'files/images/map.png', 'blackbox'),
(2, 1, 'dcfsdfsdf', 'dfdsfsdf', 'files/images/map.png', 'blackbox');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
