/*
Navicat MySQL Data Transfer

Source Server         : link
Source Server Version : 50722
Source Host           : localhost:3306
Source Database       : study_app

Target Server Type    : MYSQL
Target Server Version : 50722
File Encoding         : 65001

Date: 2018-06-13 22:59:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for answer_post
-- ----------------------------
DROP TABLE IF EXISTS `answer_post`;
CREATE TABLE `answer_post` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `question_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `answer_content` varchar(100) CHARACTER SET utf8 NOT NULL,
  `good_num` int(10) DEFAULT '0',
  `time` datetime(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `question` (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of answer_post
-- ----------------------------
INSERT INTO `answer_post` VALUES ('1', '3', '1', '这就是答案', '0', '2018-06-12 15:41:18.000000');
INSERT INTO `answer_post` VALUES ('2', '3', '1', '这又是一条答案', '0', '2018-06-12 15:42:36.000000');
INSERT INTO `answer_post` VALUES ('3', '3', '1', '这也是一条答案', '0', '2018-06-12 15:43:16.000000');

-- ----------------------------
-- Table structure for main_res
-- ----------------------------
DROP TABLE IF EXISTS `main_res`;
CREATE TABLE `main_res` (
  `id` int(11) NOT NULL,
  `slider_res` varchar(512) DEFAULT '' COMMENT '主页滚动图片资源，1.jpg;2.jpg;3.pg',
  `source_res` varchar(512) DEFAULT '' COMMENT '主页推荐课程资源  英语:1.jpg;软件工程:2.jpg',
  `vedio_res` varchar(512) DEFAULT '' COMMENT '主页推荐视频资源',
  `test` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of main_res
-- ----------------------------

-- ----------------------------
-- Table structure for main_slider_res
-- ----------------------------
DROP TABLE IF EXISTS `main_slider_res`;
CREATE TABLE `main_slider_res` (
  `id` int(11) NOT NULL,
  `img` varchar(64) DEFAULT '' COMMENT '图片url'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of main_slider_res
-- ----------------------------

-- ----------------------------
-- Table structure for main_source_res
-- ----------------------------
DROP TABLE IF EXISTS `main_source_res`;
CREATE TABLE `main_source_res` (
  `id` int(11) NOT NULL,
  `img` varchar(64) DEFAULT '' COMMENT '图片url',
  `title` varchar(64) DEFAULT '' COMMENT '课程名字'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of main_source_res
-- ----------------------------

-- ----------------------------
-- Table structure for main_vedio_res
-- ----------------------------
DROP TABLE IF EXISTS `main_vedio_res`;
CREATE TABLE `main_vedio_res` (
  `id` int(11) NOT NULL,
  `img` varchar(64) DEFAULT '' COMMENT '图片url',
  `title` varchar(64) DEFAULT '' COMMENT '课程名字',
  `url` varchar(256) DEFAULT '' COMMENT '视频url资源路径'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of main_vedio_res
-- ----------------------------

-- ----------------------------
-- Table structure for question_post
-- ----------------------------
DROP TABLE IF EXISTS `question_post`;
CREATE TABLE `question_post` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `theme_id` int(100) NOT NULL,
  `post_img` char(100) DEFAULT NULL,
  `post_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `post_content` varchar(300) CHARACTER SET utf8 NOT NULL,
  `post_readnum` int(100) DEFAULT NULL,
  `post_time` datetime(6) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `theme_id` (`theme_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of question_post
-- ----------------------------
INSERT INTO `question_post` VALUES ('1', '2', 'java.jpg', '123', 'java是一门怎样的语言，要怎样才能学好？', '0', '2018-06-13 15:07:18.000000', '1');
INSERT INTO `question_post` VALUES ('2', '3', 'java.jpg', 'ghj', 'C#-----', '0', '2018-06-13 15:08:46.000000', '1');
INSERT INTO `question_post` VALUES ('3', '2', 'java.jpg', '这是java的问题', 'java还能流行多久？', '0', '2018-06-19 15:12:30.000000', '1');

-- ----------------------------
-- Table structure for subjects
-- ----------------------------
DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `bank_id` int(4) NOT NULL,
  `questions_id` int(4) NOT NULL,
  `title` char(30) CHARACTER SET gbk NOT NULL,
  `type` int(1) NOT NULL,
  `itemA` varchar(30) DEFAULT NULL,
  `itemB` varchar(30) DEFAULT NULL,
  `itemC` varchar(30) DEFAULT NULL,
  `itemD` varchar(30) DEFAULT NULL,
  `answer` varchar(8) NOT NULL,
  `score` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of subjects
-- ----------------------------
INSERT INTO `subjects` VALUES ('1', '1001', '0', '软件工程基础设计', '1', 'A', 'B', 'C', 'D', 'A', '10');
INSERT INTO `subjects` VALUES ('2', '1001', '1', '软件工程进阶设计', '1', 'AA', 'BB', 'CC', 'DD', 'C', '10');
INSERT INTO `subjects` VALUES ('3', '1001', '2', '软件工程告诫设计', '1', 'AAA', 'BBB', 'CCC', 'DDD', 'B', '10');
INSERT INTO `subjects` VALUES ('4', '1001', '3', '计算机基础', '0', 'E', 'F', 'G', 'X', 'C', '10');

-- ----------------------------
-- Table structure for theme_type
-- ----------------------------
DROP TABLE IF EXISTS `theme_type`;
CREATE TABLE `theme_type` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `theme_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of theme_type
-- ----------------------------
INSERT INTO `theme_type` VALUES ('1', 'Html');
INSERT INTO `theme_type` VALUES ('2', 'java');
INSERT INTO `theme_type` VALUES ('3', 'C#');
INSERT INTO `theme_type` VALUES ('4', 'Python');
INSERT INTO `theme_type` VALUES ('5', 'JavaScript');
INSERT INTO `theme_type` VALUES ('6', 'Android');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `name` varchar(32) DEFAULT '' COMMENT '用户名（帐号）',
  `password` varchar(32) DEFAULT '' COMMENT '用户密码',
  `phone` varchar(32) DEFAULT 'empty' COMMENT '用户手机型号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'testUser1', '123456', 'empty');
INSERT INTO `user` VALUES ('2', '123456', '123456', 'empty');
INSERT INTO `user` VALUES ('3', '1234567', '1234567', 'empty');
INSERT INTO `user` VALUES ('4', '12345678', '12345678', 'empty');
INSERT INTO `user` VALUES ('5', '123456789', '12345678', 'empty');
INSERT INTO `user` VALUES ('6', '1234566', '123456', 'empty');
INSERT INTO `user` VALUES ('7', '1234565', '123456', 'empty');
