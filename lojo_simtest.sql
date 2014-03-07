/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50532
Source Host           : localhost:3306
Source Database       : lojo_simtest

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2014-03-07 17:15:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `quest`
-- ----------------------------
DROP TABLE IF EXISTS `quest`;
CREATE TABLE `quest` (
  `quest_id` int(11) NOT NULL AUTO_INCREMENT,
  `command` text NOT NULL COMMENT 'คำสั่ง',
  `command_image` varchar(255) NOT NULL COMMENT 'รูปภาพ',
  `requirement` text,
  `requirement_image` varchar(255) NOT NULL COMMENT 'รูปภาพ',
  `type` enum('whitebox','blackbox') NOT NULL DEFAULT 'blackbox' COMMENT 'ประเภทการ test',
  `expected_options` text NOT NULL,
  PRIMARY KEY (`quest_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='ตาราง : โจทย์';

-- ----------------------------
-- Records of quest
-- ----------------------------
INSERT INTO `quest` VALUES ('1', 'Inputs should be space-separated and the expected output is case sensitive. An example input would be \'4 4 4\' and expected output \'Equilateral\'.', 'files/images/map.png', 'Inputs should be space-separated and the expected output is case sensitive. An example input would be \'4 4 4\' and expected output \'Equilateral\'.\r\nInputs should be space-separated and the expected output is case sensitive. An example input would be \'4 4 4\' and expected output \'Equilateral\'.\r\nInputs should be space-separated and the expected output is case sensitive. An example input would be \'4 4 4\' and expected output \'Equilateral\'.\r\nInputs should be space-separated and the expected output is case sensitive. An example input would be \'4 4 4\' and expected output \'Equilateral\'.\r\nInputs should be space-separated and the expected output is case sensitive. An example input would be \'4 4 4\' and expected output \'Equilateral\'.\r\nInputs should be space-separated and the expected output is case sensitive. An example input would be \'4 4 4\' and expected output \'Equilateral\'.', '', 'blackbox', '1,2,3,4,5,6');
INSERT INTO `quest` VALUES ('2', 'สี่เหลี่ยม', 'files/images/map.png', null, '', 'blackbox', '');

-- ----------------------------
-- Table structure for `quest_requirement`
-- ----------------------------
DROP TABLE IF EXISTS `quest_requirement`;
CREATE TABLE `quest_requirement` (
  `req_id` int(11) NOT NULL AUTO_INCREMENT,
  `quest_id` int(11) NOT NULL,
  `req_step` varchar(50) NOT NULL,
  `req_weight` smallint(6) NOT NULL,
  `requirement` text NOT NULL COMMENT 'ความต้องการ',
  `expected_skip` varchar(10) NOT NULL,
  PRIMARY KEY (`req_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='ตาราง  : หัวข้อทดสอบในโจทย์';

-- ----------------------------
-- Records of quest_requirement
-- ----------------------------
INSERT INTO `quest_requirement` VALUES ('1', '1', '0,2,3', '1', 'ใส่ให้ครย', '2,3,4,5,6');
INSERT INTO `quest_requirement` VALUES ('2', '1', '1,2,3', '2', 'เป็นจำนวนเต็ม', '2,3,4');
INSERT INTO `quest_requirement` VALUES ('3', '1', '2', '3', 'น้อยกว่า 0 ', '3,4');
INSERT INTO `quest_requirement` VALUES ('4', '1', '3', '4', 'เป็นด้านเท่า', '');
INSERT INTO `quest_requirement` VALUES ('5', '1', '4', '5', 'หน้าจั่ว', '');
INSERT INTO `quest_requirement` VALUES ('6', '1', '5', '6', 'เป็นสามเหลี่ยมด้านไม่เท่า', '');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(36) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'testname', '', '', '', '0');
