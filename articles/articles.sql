/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50625
Source Host           : 127.0.0.1:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2015-11-13 14:46:32
*/
use test;
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for articles
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `excerpt` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `articles_user_id_foreign` (`user_id`),
  CONSTRAINT `articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of articles
-- ----------------------------
INSERT INTO `articles` VALUES ('1', '1', 'articles by whc', 'updated', '2015-08-24 08:18:26', '2015-08-24 08:18:26', '2015-08-24 08:18:26', null);
INSERT INTO `articles` VALUES ('2', '1', 'test', 'testtag', '2015-08-24 08:52:55', '2015-08-24 08:52:55', '2015-08-24 08:52:55', null);
INSERT INTO `articles` VALUES ('3', '1', 'no tag', 'no tag', '2015-08-24 09:03:12', '2015-08-24 09:03:12', '2015-08-24 09:03:12', null);
INSERT INTO `articles` VALUES ('4', '1', 'www', 'www', '2015-08-24 09:14:03', '2015-08-27 08:53:20', '2015-08-27 00:00:00', null);
INSERT INTO `articles` VALUES ('5', '1', 'hleo', 'hhhle', '2015-08-27 03:36:24', '2015-11-13 06:47:51', '2015-12-28 08:46:21', null);
