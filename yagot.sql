/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : yagot

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-10-16 22:10:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for addresses
-- ----------------------------
DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) DEFAULT NULL,
  `area` varchar(191) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `home_no` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `lat` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `lon` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `street` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of addresses
-- ----------------------------
INSERT INTO `addresses` VALUES ('1', '5', 'الحي', '2020-09-18 12:16:41', '2020-09-18 12:16:41', null, '1', '212121', '1212121', '9', 'الشارع');
INSERT INTO `addresses` VALUES ('2', '6', 'الحي', '2020-09-18 12:23:54', '2020-09-18 12:23:54', null, '1', '212121', '1212121', '9', 'الشارع');
INSERT INTO `addresses` VALUES ('3', '5', 'الحي', '2020-09-18 12:24:01', '2020-09-18 12:29:51', '2020-09-18 12:29:51', '1', '212121', '1212121', '9', 'الشارع');

-- ----------------------------
-- Table structure for banks
-- ----------------------------
DROP TABLE IF EXISTS `banks`;
CREATE TABLE `banks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(191) DEFAULT NULL,
  `account_no` varchar(191) DEFAULT NULL,
  `iban` varchar(191) DEFAULT NULL,
  `tax_number` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `images` varchar(191) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bank_status_ix` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of banks
-- ----------------------------
INSERT INTO `banks` VALUES ('1', 'البنك', '123485', 'SA123456789', '126', '1', '1', null, null, '2020-05-21 10:51:58', '', null);

-- ----------------------------
-- Table structure for banks_transfer
-- ----------------------------
DROP TABLE IF EXISTS `banks_transfer`;
CREATE TABLE `banks_transfer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) DEFAULT NULL,
  `account_no_from` varchar(191) DEFAULT NULL,
  `iban` varchar(191) DEFAULT NULL,
  `total_price` double(8,2) DEFAULT '0.00',
  `client_id` int(11) DEFAULT '0',
  `image` varchar(191) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mobile` varchar(30) DEFAULT NULL,
  `action_source` tinyint(4) DEFAULT '0',
  `status` int(11) DEFAULT '-1',
  `order_id` int(11) DEFAULT NULL,
  `account_no_to` varchar(191) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `currency_id` int(11) DEFAULT '1',
  `payment_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of banks_transfer
-- ----------------------------
INSERT INTO `banks_transfer` VALUES ('1', 'رائد الحلاق', '102030', null, '500.00', '9', '6QZCDgqvL.jpeg', null, '2020-09-22 00:41:25', '2020-09-22 00:41:25', null, '1', '-1', '6', '153045', '2020-09-22', '1', '1', '2');
INSERT INTO `banks_transfer` VALUES ('2', 'رائد الحلاق', '102030', null, '500.00', '9', '7kra6Olw3.jpg', null, '2020-09-28 12:07:35', '2020-09-28 12:07:35', null, '1', '-1', '7', '153045', '2020-09-28', '1', '1', '2');
INSERT INTO `banks_transfer` VALUES ('3', 'رائد الحلاق', '102030', null, '500.00', '9', '8D24w3CW0.jpg', null, '2020-09-28 12:13:06', '2020-09-28 12:13:06', null, '1', '-1', '8', '153045', '2020-09-28', '1', '1', '2');
INSERT INTO `banks_transfer` VALUES ('4', 'رائد الحلاق', '102030', null, '50.00', '9', '1Px6PqOUN.jpg', null, '2020-10-11 22:29:54', '2020-10-11 22:29:54', null, '2', '-1', '1', '153045', '2020-10-11', '1', '1', '2');

-- ----------------------------
-- Table structure for clients
-- ----------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mobile` varchar(30) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `country_code` varchar(191) NOT NULL DEFAULT '966',
  `email` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `zone_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `user_id` int(11) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `token_reset_password` text,
  `date_token_reset_password` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `fcm_token` varchar(500) DEFAULT NULL,
  `os` varchar(255) DEFAULT NULL,
  `company_name` varchar(191) DEFAULT NULL,
  `commercial_no` varchar(30) DEFAULT NULL,
  `lat` varchar(30) DEFAULT NULL,
  `lon` varchar(30) DEFAULT NULL,
  `area` varchar(191) DEFAULT NULL,
  `street` varchar(191) DEFAULT NULL,
  `office_no` varchar(30) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `subscription_id` int(11) DEFAULT NULL,
  `start_subscription` datetime DEFAULT NULL,
  `end_subscription` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clients_zone_fk` (`zone_id`) USING BTREE,
  KEY `clients_user_fk` (`user_id`),
  KEY `clients_city_fk` (`city_id`),
  CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `zones` (`id`),
  CONSTRAINT `clients_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `clients_ibfk_3` FOREIGN KEY (`zone_id`) REFERENCES `zones` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of clients
-- ----------------------------
INSERT INTO `clients` VALUES ('9', '505050050', 'Raed Alhallaq', '966', 'raedalhallaq@gmail.com', 'profile_91600293236.png', '5', null, '$2y$10$4yjkmMQVKspwngLqeXQAOObFVB9vptCqVRX6vJPxUN2lGTofqDe5W', '2', '1', null, null, '2020-09-17 00:12:21', '2020-10-16 21:46:59', null, null, '2020-10-16 21:46:59', '1111111111111', 'andriod', 'اسم الشركة', '15150', '1.333', '1.2222', 'اسم الحي', 'اسم الشاع', '50505', '1', '1', '2020-10-11 22:29:54', '2020-10-15 22:29:54');
INSERT INTO `clients` VALUES ('10', '5005001', 'احمد محمد', '966', 'ahmed@gmail.com', '', '13', null, '$2y$10$iKNDYD7luPngybqXDg8OJOgmkk3u9p9NqoDXdqRzSCfB5wN4lCwt.', '1', '1', null, null, '2020-09-17 00:12:21', '2020-10-11 23:08:15', 'e2982bdef7b108393f3c3b8ffb30a0e76b996165701b03b67c95bcc20d59dc43', '2020-10-06 00:48:19', '2020-10-11 23:08:15', '1111111111111', 'andriod', '', '', '', '', '', '', '', '1', null, null, null);

-- ----------------------------
-- Table structure for company
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(191) CHARACTER SET utf8 DEFAULT NULL,
  `name_en` varchar(191) CHARACTER SET utf8 DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `tracking_url` varchar(250) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `can_cash` tinyint(4) DEFAULT '0',
  `cash_value` double DEFAULT '0',
  `billing_national_address` varchar(250) DEFAULT NULL,
  `billing_building_number` varchar(250) DEFAULT NULL,
  `billing_postalcode_number` varchar(250) DEFAULT NULL,
  `billing_unit_number` varchar(250) DEFAULT NULL,
  `billing_extra_number` varchar(250) DEFAULT NULL,
  `country_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of company
-- ----------------------------
INSERT INTO `company` VALUES ('1', ' 1 شركة شحن', 'Company1', '1.png', null, null, null, null, null, '1', '0', '0', null, null, null, null, null, '1');
INSERT INTO `company` VALUES ('2', 'شركة شحن 2', 'Company2', '1.png', null, null, null, null, null, '1', '0', '0', null, null, null, null, null, '1');

-- ----------------------------
-- Table structure for countries
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of countries
-- ----------------------------

-- ----------------------------
-- Table structure for favorites
-- ----------------------------
DROP TABLE IF EXISTS `favorites`;
CREATE TABLE `favorites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `favorite_id` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `type` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `favorites_clients_fk` (`client_id`),
  KEY `favorites_favorite_id_fk` (`favorite_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of favorites
-- ----------------------------
INSERT INTO `favorites` VALUES ('6', '2020-09-17', '20', '9', '2', null, '2020-09-17 00:57:02', '2020-09-17 00:57:02');

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `admin_view` tinyint(4) DEFAULT NULL,
  `response_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `country_code` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of messages
-- ----------------------------
INSERT INTO `messages` VALUES ('20', 'رائد ياسر الحلاق', 'raedalhallaq97@gmail.com', '0594488606', 'محتوى الرسالة  محتوى الرسالة  محتوى الرسالة محتوى الرسالة محتوى الرسالة', '1', null, null, null, '2020-01-04 11:44:53', '2020-01-04 13:55:28', null, null);
INSERT INTO `messages` VALUES ('22', 'رائد', 'raedalhallaq97@gmail.com', '059448606', 'محتوى الرسالة  محتوى الرسالة  محتوى الرسالة محتوى الرسالة محتوى الرسالة', '0', null, null, null, '2020-01-04 11:57:54', '2020-01-04 11:57:54', null, null);
INSERT INTO `messages` VALUES ('23', 'الاسم', 'test@t.com', '505050050', 'محتوى', null, null, null, null, '2020-10-12 00:16:27', '2020-10-12 00:16:27', null, '565');

-- ----------------------------
-- Table structure for mobile_notification
-- ----------------------------
DROP TABLE IF EXISTS `mobile_notification`;
CREATE TABLE `mobile_notification` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `read_at` datetime DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mobile_clients_fk` (`client_id`),
  KEY `mobile_party_fk` (`product_id`),
  CONSTRAINT `mobile_notification_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `mobile_notification_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mobile_notification
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------
INSERT INTO `model_has_permissions` VALUES ('1', 'App\\Models\\User', '4');
INSERT INTO `model_has_permissions` VALUES ('2', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('2', 'App\\Models\\User', '4');
INSERT INTO `model_has_permissions` VALUES ('3', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('3', 'App\\Models\\User', '4');
INSERT INTO `model_has_permissions` VALUES ('4', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('4', 'App\\Models\\User', '4');
INSERT INTO `model_has_permissions` VALUES ('5', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('5', 'App\\Models\\User', '4');
INSERT INTO `model_has_permissions` VALUES ('6', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('6', 'App\\Models\\User', '4');
INSERT INTO `model_has_permissions` VALUES ('7', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('7', 'App\\Models\\User', '4');
INSERT INTO `model_has_permissions` VALUES ('8', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('8', 'App\\Models\\User', '4');
INSERT INTO `model_has_permissions` VALUES ('9', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('9', 'App\\Models\\User', '4');
INSERT INTO `model_has_permissions` VALUES ('10', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('10', 'App\\Models\\User', '4');
INSERT INTO `model_has_permissions` VALUES ('11', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('11', 'App\\Models\\User', '4');
INSERT INTO `model_has_permissions` VALUES ('12', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('12', 'App\\Models\\User', '4');
INSERT INTO `model_has_permissions` VALUES ('13', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('13', 'App\\Models\\User', '4');
INSERT INTO `model_has_permissions` VALUES ('14', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('14', 'App\\Models\\User', '4');
INSERT INTO `model_has_permissions` VALUES ('15', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('15', 'App\\Models\\User', '4');
INSERT INTO `model_has_permissions` VALUES ('16', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('16', 'App\\Models\\User', '4');
INSERT INTO `model_has_permissions` VALUES ('17', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('18', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('19', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('20', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('21', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('22', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('23', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('24', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('25', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('26', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('27', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('41', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('43', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('61', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('62', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('63', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('64', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('65', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('66', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('75', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('76', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('77', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('78', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('79', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('80', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('109', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('110', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('111', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('112', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('113', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('114', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('115', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('116', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('117', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('118', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('119', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('120', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('144', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('145', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('146', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('147', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('148', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('149', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('162', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('163', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('164', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('165', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('166', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('167', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('168', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('169', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('170', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('171', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('172', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('173', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('174', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('175', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('176', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('177', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('178', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('179', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('180', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('181', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('182', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('183', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('184', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('185', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('186', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('187', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('188', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('189', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('190', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('191', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('192', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('193', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('194', 'App\\Models\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('195', 'App\\Models\\User', '1');

-- ----------------------------
-- Table structure for movements
-- ----------------------------
DROP TABLE IF EXISTS `movements`;
CREATE TABLE `movements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payment_type` tinyint(4) DEFAULT '0',
  `depit` double DEFAULT '0',
  `total_price` double DEFAULT '0',
  `action_source` tinyint(4) DEFAULT '0',
  `client_id` int(11) DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `statement` varchar(300) DEFAULT NULL,
  `currency_id` tinyint(4) DEFAULT '1',
  `move_no` int(11) DEFAULT '0',
  `transfer_id` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT '0',
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `movments_account_id_ix` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of movements
-- ----------------------------

-- ----------------------------
-- Table structure for notifications
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int(11) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`),
  KEY `notifications_users_fk` (`notifiable_id`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`notifiable_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of notifications
-- ----------------------------

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(30) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `currency_id` int(11) DEFAULT '1',
  `delivery` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('6', '01220920', '500', '9', '1', '2020-09-22 00:41:25', '2020-09-22 00:41:25', null, '1', '1', '2', '2020-09-22', '1', '2');
INSERT INTO `orders` VALUES ('7', '01280920', '520', '9', '1', '2020-09-28 12:07:33', '2020-09-28 12:07:33', null, '1', '1', '2', '2020-09-28', '1', '2');
INSERT INTO `orders` VALUES ('8', '02280920', '520', '9', '1', '2020-09-28 12:13:06', '2020-09-28 12:13:06', null, '1', '1', '2', '2020-09-28', '1', '2');

-- ----------------------------
-- Table structure for orders_log
-- ----------------------------
DROP TABLE IF EXISTS `orders_log`;
CREATE TABLE `orders_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(30) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of orders_log
-- ----------------------------
INSERT INTO `orders_log` VALUES ('6', '6', '9', '2020-09-22', '1', '2020-09-22 00:41:25', '2020-09-22 00:41:25', null, null);
INSERT INTO `orders_log` VALUES ('7', '6', '9', '2020-09-22', '2', '2020-09-22 00:41:25', '2020-09-22 00:41:25', null, null);
INSERT INTO `orders_log` VALUES ('8', '6', '9', '2020-09-22', '3', '2020-09-22 00:41:25', '2020-09-22 00:41:25', null, null);
INSERT INTO `orders_log` VALUES ('9', '6', '9', '2020-09-22', '4', '2020-09-22 00:41:25', '2020-09-22 00:41:25', null, null);
INSERT INTO `orders_log` VALUES ('10', '7', '9', '2020-09-28', '1', '2020-09-28 12:07:34', '2020-09-28 12:07:34', null, null);
INSERT INTO `orders_log` VALUES ('11', '8', '9', '2020-09-28', '1', '2020-09-28 12:13:06', '2020-09-28 12:13:06', null, null);

-- ----------------------------
-- Table structure for order_details
-- ----------------------------
DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of order_details
-- ----------------------------
INSERT INTO `order_details` VALUES ('6', '6', '18', '500', '2020-09-22 00:41:25', '2020-09-22 00:41:25', null, '1');
INSERT INTO `order_details` VALUES ('7', '7', '18', '500', '2020-09-28 12:07:33', '2020-09-28 12:07:33', null, '1');
INSERT INTO `order_details` VALUES ('8', '7', '-1', '20', '2020-09-28 12:07:34', '2020-09-28 12:07:34', null, '2');
INSERT INTO `order_details` VALUES ('9', '8', '18', '500', '2020-09-28 12:13:06', '2020-09-28 12:13:06', null, '1');
INSERT INTO `order_details` VALUES ('10', '8', '-1', '20', '2020-09-28 12:13:06', '2020-09-28 12:13:06', null, '2');

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `platform` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_token` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=457 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------
INSERT INTO `personal_access_tokens` VALUES ('454', 'App\\Models\\Clients', '10', '5005001', '454|4gH3odso3vYhEDWJXAwnrdKdpB5RHXIBSDhfXuBmAAftFCYgbS93t79vhGaiaoPtV36noxhNQ81jelkU', '[\"*\"]', null, '2020-10-06 00:50:52', '2020-10-06 00:50:52', 'andriod', '1111111111111', '127.0.0.1');
INSERT INTO `personal_access_tokens` VALUES ('456', 'App\\Models\\Clients', '9', '505050050', '456|1bTfD0vjbEVRPa2w6I0HlrraGkNimN7y3t8NPS0zfK7WvJFvhR72imDMgSDjuZkiDtYePrlmwMqAxa2V', '[\"*\"]', null, '2020-10-16 21:47:00', '2020-10-16 21:47:00', 'andriod', '1111111111111', '127.0.0.1');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `price` float(11,0) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `details` text,
  `client_id` int(11) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `notes` text,
  `image` varchar(255) DEFAULT NULL,
  `currency_id` tinyint(4) DEFAULT '1',
  `certified` tinyint(4) DEFAULT '-1',
  `order` tinyint(4) DEFAULT '-1',
  `city_id` int(11) DEFAULT NULL,
  `view_no` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `party_city_fk` (`price`),
  KEY `party_clients_fk` (`client_id`),
  CONSTRAINT `products_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('18', 'اسم المنتج 1', '550', '2', 'تفاصيل المنتج 1', '9', null, '2020-09-17 00:26:50', '2020-09-28 12:07:33', '3', null, 'main_image_LGVxFj1Y.jpeg', '1', '-1', '-1', '5', '2');
INSERT INTO `products` VALUES ('19', 'اسم المنتج', '500', '1', 'تفاصيل المنتج', '9', null, '2020-09-17 00:27:22', '2020-09-17 00:27:22', '2', null, 'main_image_LGVxFj1Y.jpeg', '1', '1', '-1', '5', '2');
INSERT INTO `products` VALUES ('20', 'اسم المنتج', '500', '1', 'تفاصيل المنتج', '9', null, '2020-09-17 00:27:44', '2020-09-17 00:27:44', '3', null, 'main_image_LGVxFj1Y.jpeg', '1', '-1', '-1', '5', '2');
INSERT INTO `products` VALUES ('21', 'اسم المنتج', '500', '1', 'تفاصيل المنتج', '9', null, '2020-09-17 00:27:55', '2020-09-17 00:27:55', '1', null, 'main_image_LGVxFj1Y.jpeg', '1', '-1', '-1', '5', '2');
INSERT INTO `products` VALUES ('22', 'اسم المنتج', '500', '1', 'تفاصيل المنتج', '9', null, '2020-09-17 00:28:16', '2020-09-17 00:28:16', '1', null, 'main_image_LGVxFj1Y.jpeg', '1', '-1', '-1', '5', '500');
INSERT INTO `products` VALUES ('23', 'اسم المنتج', '500', '1', 'تفاصيل المنتج', '9', '2020-09-17 00:36:33', '2020-09-17 00:28:36', '2020-09-17 00:36:33', '1', null, 'main_image_LGVxFj1Y.jpeg', '1', '-1', '-1', '5', '2');
INSERT INTO `products` VALUES ('24', 'اسم المنتج', '500', '1', 'تفاصيل المنتج', '10', null, '2020-10-06 00:51:26', '2020-10-06 00:51:26', '1', null, 'main_image_AjzxacrS.jpg', '1', '-1', '-1', '5', '800');
INSERT INTO `products` VALUES ('25', 'اسم المنتج', '500', '1', 'تفاصيل المنتج', '10', null, '2020-10-06 00:54:34', '2020-10-06 00:54:34', '1', null, 'main_image_6L8sBft3.jpg', '1', '-1', '-1', '5', '2');
INSERT INTO `products` VALUES ('26', 'اسم المنتج', '500', '1', 'تفاصيل المنتج', '10', null, '2020-10-11 23:07:15', '2020-10-11 23:07:15', '1', null, 'main_image_LGSEa6Dq.jpg', '1', '1', '-1', '5', '2');
INSERT INTO `products` VALUES ('27', 'اسم المنتج 1000', '500', '2', 'تفاصيل المنتج', '9', null, '2020-10-11 23:09:59', '2020-10-11 23:09:59', '1', null, 'main_image_9fsblx0I.jpg', '1', '1', '1', '5', '1000');
INSERT INTO `products` VALUES ('28', 'اسم المنتج', '500', '1', 'تفاصيل المنتج', '9', null, '2020-10-11 23:12:02', '2020-10-11 23:12:02', '1', null, 'main_image_GopTNFNk.jpg', '1', '-1', '1', '5', '2');

-- ----------------------------
-- Table structure for products_attachment
-- ----------------------------
DROP TABLE IF EXISTS `products_attachment`;
CREATE TABLE `products_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `attachment` varchar(191) NOT NULL,
  `client_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=308 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of products_attachment
-- ----------------------------
INSERT INTO `products_attachment` VALUES ('283', '18', 'main_image_LGVxFj1Y.jpeg', '9', '1', null, '2020-09-17 00:26:50', '2020-09-17 00:26:50');
INSERT INTO `products_attachment` VALUES ('284', '18', 'pic_1XYyRHY4N.jpg', '9', '1', null, '2020-09-17 00:26:50', '2020-09-17 00:26:50');
INSERT INTO `products_attachment` VALUES ('286', '18', 'main_image_UhA4GKB2.jpeg', '9', '1', '2020-09-17 00:32:28', '2020-09-17 00:27:22', '2020-09-17 00:32:28');
INSERT INTO `products_attachment` VALUES ('287', '18', 'pic_1msyD8tgh.jpg', '9', '1', '2020-09-17 00:32:28', '2020-09-17 00:27:22', '2020-09-17 00:32:28');
INSERT INTO `products_attachment` VALUES ('289', '20', 'main_image_ludIqjZK.jpeg', '9', '1', null, '2020-09-17 00:27:45', '2020-09-17 00:27:45');
INSERT INTO `products_attachment` VALUES ('290', '20', 'pic_11Fy5efTn.jpg', '9', '1', null, '2020-09-17 00:27:45', '2020-09-17 00:27:45');
INSERT INTO `products_attachment` VALUES ('291', '20', 'pic_2ctgp1YRn.png', '9', '2', null, '2020-09-17 00:27:45', '2020-09-17 00:27:45');
INSERT INTO `products_attachment` VALUES ('292', '21', 'main_image_0JMjpYKm.jpeg', '9', '1', null, '2020-09-17 00:27:55', '2020-09-17 00:27:55');
INSERT INTO `products_attachment` VALUES ('293', '22', 'main_image_X4YNjxC7.jpeg', '9', '1', null, '2020-09-17 00:28:16', '2020-09-17 00:28:16');
INSERT INTO `products_attachment` VALUES ('294', '22', 'pic_1VYv8T9Pm.jpg', '9', '1', null, '2020-09-17 00:28:16', '2020-09-17 00:28:16');
INSERT INTO `products_attachment` VALUES ('295', '22', 'pic_2Ezcrogur.png', '9', '2', null, '2020-09-17 00:28:16', '2020-09-17 00:28:16');
INSERT INTO `products_attachment` VALUES ('296', '23', 'main_image_LkhRcQlI.jpeg', '9', '1', '2020-09-17 00:36:33', '2020-09-17 00:28:36', '2020-09-17 00:36:33');
INSERT INTO `products_attachment` VALUES ('297', '23', 'pic_1IJmssJdq.jpg', '9', '1', '2020-09-17 00:36:33', '2020-09-17 00:28:36', '2020-09-17 00:36:33');
INSERT INTO `products_attachment` VALUES ('298', '23', 'pic_2tOY8bx5Y.png', '9', '2', '2020-09-17 00:36:33', '2020-09-17 00:28:36', '2020-09-17 00:36:33');
INSERT INTO `products_attachment` VALUES ('299', '18', 'pic_14amJMRpw.png', '9', '1', null, '2020-09-17 00:33:07', '2020-09-17 00:33:07');
INSERT INTO `products_attachment` VALUES ('301', '18', 'pic_1jgG7I16e.png', '9', '1', null, '2020-09-17 00:34:16', '2020-09-17 00:34:16');
INSERT INTO `products_attachment` VALUES ('302', '18', 'pic_2TNRsJToj.jpg', '9', '2', null, '2020-09-17 00:34:16', '2020-09-17 00:34:16');
INSERT INTO `products_attachment` VALUES ('303', '24', 'main_image_AjzxacrS.jpg', '10', '1', null, '2020-10-06 00:51:26', '2020-10-06 00:51:26');
INSERT INTO `products_attachment` VALUES ('304', '25', 'main_image_6L8sBft3.jpg', '10', '1', null, '2020-10-06 00:54:34', '2020-10-06 00:54:34');
INSERT INTO `products_attachment` VALUES ('305', '26', 'main_image_LGSEa6Dq.jpg', '10', '1', null, '2020-10-11 23:07:15', '2020-10-11 23:07:15');
INSERT INTO `products_attachment` VALUES ('306', '27', 'main_image_9fsblx0I.jpg', '9', '1', null, '2020-10-11 23:09:59', '2020-10-11 23:09:59');
INSERT INTO `products_attachment` VALUES ('307', '28', 'main_image_GopTNFNk.jpg', '9', '1', null, '2020-10-11 23:12:02', '2020-10-11 23:12:02');

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title_ar` varchar(191) DEFAULT NULL,
  `description_ar` longtext,
  `logo` varchar(191) DEFAULT NULL,
  `mobile` int(11) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ios` varchar(255) DEFAULT NULL,
  `andriod` varchar(255) DEFAULT NULL,
  `title_en` varchar(191) DEFAULT NULL,
  `description_en` varchar(255) DEFAULT NULL,
  `site_commission` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `settings_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES ('1', null, null, null, null, null, '0', null, null, null, null, null, null, null, '0.07');

-- ----------------------------
-- Table structure for shipping_company_cities
-- ----------------------------
DROP TABLE IF EXISTS `shipping_company_cities`;
CREATE TABLE `shipping_company_cities` (
  `id` bigint(20) unsigned NOT NULL,
  `shipping_company_country_id` bigint(20) unsigned NOT NULL,
  `city_id` bigint(20) unsigned NOT NULL,
  `cash` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shipping_company_cities
-- ----------------------------
INSERT INTO `shipping_company_cities` VALUES ('34', '14', '5', '1', '2020-09-09 13:15:23', '2020-09-09 13:15:23');
INSERT INTO `shipping_company_cities` VALUES ('35', '14', '4', '1', '2020-09-09 13:15:23', '2020-09-09 13:15:23');
INSERT INTO `shipping_company_cities` VALUES ('36', '14', '5', '1', '2020-09-09 13:15:23', '2020-09-09 13:15:23');
INSERT INTO `shipping_company_cities` VALUES ('37', '14', '6', '1', '2020-09-09 13:15:23', '2020-09-09 13:15:23');
INSERT INTO `shipping_company_cities` VALUES ('38', '14', '7', '1', '2020-09-09 13:15:23', '2020-09-09 13:15:23');
INSERT INTO `shipping_company_cities` VALUES ('39', '14', '8', '1', '2020-09-09 13:15:23', '2020-09-09 13:15:23');
INSERT INTO `shipping_company_cities` VALUES ('40', '14', '9', '1', '2020-09-09 13:15:23', '2020-09-09 13:15:23');

-- ----------------------------
-- Table structure for shipping_company_countries
-- ----------------------------
DROP TABLE IF EXISTS `shipping_company_countries`;
CREATE TABLE `shipping_company_countries` (
  `id` bigint(20) unsigned NOT NULL,
  `shipping_company_id` bigint(20) unsigned NOT NULL,
  `country_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shipping_company_countries
-- ----------------------------
INSERT INTO `shipping_company_countries` VALUES ('1', '1', '1', '2020-09-09 11:14:54', null);

-- ----------------------------
-- Table structure for shipping_company_prices
-- ----------------------------
DROP TABLE IF EXISTS `shipping_company_prices`;
CREATE TABLE `shipping_company_prices` (
  `id` bigint(20) unsigned NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `price` double NOT NULL,
  `type` varchar(50) NOT NULL,
  `name_ar` varchar(250) DEFAULT NULL,
  `name_en` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shipping_company_prices
-- ----------------------------
INSERT INTO `shipping_company_prices` VALUES ('109', '0', '10000', '20', 'fixed', 'الشحن', 'الشحن', '2020-09-09 13:15:23', '2020-09-09 13:15:23', '1', '5', '1');
INSERT INTO `shipping_company_prices` VALUES ('110', '0', '10000', '0.2', 'pct', 'الشحن', 'الشحن', '2020-09-09 13:15:23', '2020-09-09 13:15:23', '1', '6', '1');

-- ----------------------------
-- Table structure for slider
-- ----------------------------
DROP TABLE IF EXISTS `slider`;
CREATE TABLE `slider` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(191) NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `details` longtext,
  `status` tinyint(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `reference_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of slider
-- ----------------------------
INSERT INTO `slider` VALUES ('1', 'main_image_5NkdreuW.jpg', null, null, '1', '1', null, null, null, null, '2', '18');
INSERT INTO `slider` VALUES ('2', 'main_image_5NkdreuW.jpg', null, null, '1', '1', null, null, null, null, '3', '1');
INSERT INTO `slider` VALUES ('3', 'main_image_5NkdreuW.jpg', null, null, '1', '1', null, null, null, 'http://fb.com/', '1', null);

-- ----------------------------
-- Table structure for social
-- ----------------------------
DROP TABLE IF EXISTS `social`;
CREATE TABLE `social` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(191) NOT NULL,
  `title_ar` varchar(191) DEFAULT NULL,
  `title_en` varchar(191) DEFAULT NULL,
  `class_icon` varchar(191) DEFAULT NULL,
  `icon` varchar(191) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `color` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of social
-- ----------------------------
INSERT INTO `social` VALUES ('1', 'https://www.facebook.com/', null, null, 'fa-facebook-f', 'f09a', '1', '1', null, '2020-05-27 07:52:46', '#16537e');
INSERT INTO `social` VALUES ('2', 'https://twitter.com/', '', '', 'fa-twitter', 'f099', '1', '1', null, '2020-05-27 07:52:51', '#6fa8dc');
INSERT INTO `social` VALUES ('3', 'https://www.youtube.com/', null, null, 'fa-youtube', 'f167', '1', '1', null, '2020-05-27 07:52:58', 'red');

-- ----------------------------
-- Table structure for static_page
-- ----------------------------
DROP TABLE IF EXISTS `static_page`;
CREATE TABLE `static_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `photo` varchar(191) DEFAULT NULL,
  `title_ar` varchar(191) DEFAULT NULL,
  `details_ar` text,
  `slug` varchar(191) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `delete_flag` tinyint(4) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `details_en` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of static_page
-- ----------------------------
INSERT INTO `static_page` VALUES ('1', null, 'سياسة استخدام الشركات', 'سياسة استخدام الشركات', 'terms-company', '1', '1', '1', null, null, '0000-00-00 00:00:00', 'terms', 'terms');
INSERT INTO `static_page` VALUES ('2', null, 'سياسة الخصوصية', 'سياسة الخصوصية', 'policy-privacy', '1', '1', '1', null, null, '0000-00-00 00:00:00', 'policy-privacy', 'policy-privacy');
INSERT INTO `static_page` VALUES ('3', null, 'حول التطبيق', 'حول التطبيق', 'about-us', '1', '1', '1', null, null, '0000-00-00 00:00:00', 'about', 'about');
INSERT INTO `static_page` VALUES ('4', null, 'سياسة استخدام الهاوي', 'سياسة استخدام الهاوي', 'terms-ohbbyist', '1', '1', '1', null, null, '0000-00-00 00:00:00', 'سياسة استخدام الهاوي', 'سياسة استخدام الهاوي');
INSERT INTO `static_page` VALUES ('5', null, 'معاهدة الياقوت', 'بسم الله الرحمن الرحيم قال تعالى:\"وافوا بعهد الله إذا عاهدتم ولا تنقضوا الأيمان بعد توكيدها وقد جعلتم الله عليكم كفيلا إن الله يعلم ما تعلمون\" ', 'alqism', '1', '1', '1', null, null, null, 'معاهدة الياقوت', 'بسم الله الرحمن الرحيم قال تعالى:\"وافوا بعهد الله إذا عاهدتم ولا تنقضوا الأيمان بعد توكيدها وقد جعلتم الله عليكم كفيلا إن الله يعلم ما تعلمون\" ');

-- ----------------------------
-- Table structure for subscriptions
-- ----------------------------
DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(191) CHARACTER SET utf8 DEFAULT NULL,
  `price` float DEFAULT NULL,
  `currency_id` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `number_days` int(11) DEFAULT NULL,
  `number_products` int(11) DEFAULT NULL,
  `name_en` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of subscriptions
-- ----------------------------
INSERT INTO `subscriptions` VALUES ('1', 'الباقة الذهبية', '50', '1', null, null, null, '4', '4', 'subsciptions');

-- ----------------------------
-- Table structure for subscription_features
-- ----------------------------
DROP TABLE IF EXISTS `subscription_features`;
CREATE TABLE `subscription_features` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subscription_id` int(11) DEFAULT NULL,
  `feature_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of subscription_features
-- ----------------------------
INSERT INTO `subscription_features` VALUES ('1', '1', '1', null, null);
INSERT INTO `subscription_features` VALUES ('2', '1', '2', null, null);
INSERT INTO `subscription_features` VALUES ('3', '1', '3', null, null);
INSERT INTO `subscription_features` VALUES ('4', '1', '4', null, null);
INSERT INTO `subscription_features` VALUES ('5', '1', '5', null, null);

-- ----------------------------
-- Table structure for system_constants
-- ----------------------------
DROP TABLE IF EXISTS `system_constants`;
CREATE TABLE `system_constants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(191) NOT NULL,
  `value` int(11) NOT NULL,
  `notes` varchar(191) DEFAULT NULL,
  `type` varchar(191) NOT NULL,
  `order` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name_en` varchar(191) DEFAULT NULL,
  `value2` int(11) DEFAULT NULL,
  `value3` varchar(30) DEFAULT NULL,
  `details_ar` text,
  `details_en` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=485 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_constants
-- ----------------------------
INSERT INTO `system_constants` VALUES ('4', 'مقدمة الدولة', '1', 'country_code', 'system_constants', '1', '1', null, null, null, null, null, 'Country Code', null, 'country_code', null, null);
INSERT INTO `system_constants` VALUES ('5', 'الدولة', '2', 'country', 'system_constants', '2', '1', null, null, null, null, null, 'Country', null, 'country', null, null);
INSERT INTO `system_constants` VALUES ('6', 'أحجار كريمة', '1', null, 'category', '1', '1', 'main_image_LkhRcQlI.jpeg', null, null, null, null, null, null, null, 'تفاصيل عن التصنيف', 'تفاصيل عن التصنيف');
INSERT INTO `system_constants` VALUES ('7', 'مجوهرات وألماس', '2', null, 'category', '2', '1', 'main_image_LkhRcQlI.jpeg', null, null, null, null, null, null, null, 'تفاصيل عن التصنيف', 'تفاصيل عن التصنيف');
INSERT INTO `system_constants` VALUES ('8', 'تحف اكسسوارات', '3', null, 'category', '3', '1', 'main_image_LkhRcQlI.jpeg', null, null, null, null, null, null, null, 'تفاصيل عن التصنيف', 'تفاصيل عن التصنيف');
INSERT INTO `system_constants` VALUES ('9', 'منتجات أخرى', '4', null, 'category', '4', '1', 'main_image_LkhRcQlI.jpeg', null, null, null, null, null, null, null, 'تفاصيل عن التصنيف', 'تفاصيل عن التصنيف');
INSERT INTO `system_constants` VALUES ('10', ' الأقسام', '3', 'category', 'system_constants', '3', '1', null, null, null, null, null, 'Category', null, 'category', null, null);
INSERT INTO `system_constants` VALUES ('11', 'هاوي', '1', null, 'type', '1', '1', null, null, null, null, null, null, null, null, null, null);
INSERT INTO `system_constants` VALUES ('12', 'شركة', '2', null, 'type', '2', '1', null, null, null, null, null, null, null, null, null, null);
INSERT INTO `system_constants` VALUES ('13', 'نوع العميل', '4', 'type', 'system_constants', '4', '1', null, null, null, null, null, 'Client Type', null, 'type', null, null);
INSERT INTO `system_constants` VALUES ('14', 'ريال', '1', null, 'currency', '1', '1', null, null, null, null, null, null, null, null, null, null);
INSERT INTO `system_constants` VALUES ('15', 'العملة', '5', 'currency', 'system_constants', '5', '1', null, null, null, null, null, 'Currency', null, 'currency', null, null);
INSERT INTO `system_constants` VALUES ('16', 'البطاقة الائتمانية', '1', null, 'payment_type', '1', '1', null, null, null, null, null, null, null, null, null, null);
INSERT INTO `system_constants` VALUES ('17', 'تحويل بنكي', '2', null, 'payment_type', '2', '1', null, null, null, null, null, null, null, null, null, null);
INSERT INTO `system_constants` VALUES ('18', 'الدفع نقدا', '3', null, 'payment_type', '3', '1', null, null, null, null, null, null, null, null, null, null);
INSERT INTO `system_constants` VALUES ('19', 'طرق الدفع', '6', 'payment_type', 'system_constants', '6', '1', null, null, null, null, null, 'Payment Type', null, 'payment_type', null, null);
INSERT INTO `system_constants` VALUES ('35', 'الباقات', '1', null, 'action_source', '1', '1', null, null, null, null, null, null, null, null, null, null);
INSERT INTO `system_constants` VALUES ('36', 'المنتجات', '2', null, 'action_source', '2', '1', null, null, null, null, null, null, null, null, null, null);
INSERT INTO `system_constants` VALUES ('37', 'مصدر الحركة', '7', 'action_source', 'system_constants', '7', '1', null, null, null, null, null, 'Action Source', null, 'action_source', null, null);
INSERT INTO `system_constants` VALUES ('38', 'تم الطلب', '1', null, 'order_status', '1', '1', null, null, null, null, null, null, null, null, null, null);
INSERT INTO `system_constants` VALUES ('39', 'قيد التنفيذ', '2', null, 'order_status', '2', '1', null, null, null, null, null, null, null, null, null, null);
INSERT INTO `system_constants` VALUES ('40', 'تم الشحن', '3', null, 'order_status', '3', '1', null, null, null, null, null, null, null, null, null, null);
INSERT INTO `system_constants` VALUES ('41', 'تم التسليم', '4', null, 'order_status', '4', '1', null, null, null, null, null, null, null, null, null, null);
INSERT INTO `system_constants` VALUES ('42', 'تم الرفض', '5', null, 'order_status', '5', '1', null, null, null, null, null, null, null, null, null, null);
INSERT INTO `system_constants` VALUES ('43', 'تم إلغاء', '6', null, 'order_status', '6', '1', null, null, null, null, null, null, null, null, null, null);
INSERT INTO `system_constants` VALUES ('241', 'فلسطين', '231', null, 'Country', '0', '1', null, null, null, null, null, 'Palestinian Territory', '970', 'PS', null, null);
INSERT INTO `system_constants` VALUES ('242', 'زمبابوي', '230', null, 'Country', '0', '1', null, null, null, null, null, 'Zimbabwe', '263', 'ZW', null, null);
INSERT INTO `system_constants` VALUES ('243', 'زامبيا', '229', null, 'Country', '0', '1', null, null, null, null, null, 'Zambia', '260', 'ZM', null, null);
INSERT INTO `system_constants` VALUES ('244', 'جنوب أفريقيا', '228', null, 'Country', '0', '1', null, null, null, null, null, 'South africa', '27', 'ZA', null, null);
INSERT INTO `system_constants` VALUES ('245', 'مايوت', '227', null, 'Country', '0', '1', null, null, null, null, null, 'Mayotte', '262', 'YT', null, null);
INSERT INTO `system_constants` VALUES ('246', 'اليمن', '226', null, 'Country', '0', '1', null, null, null, null, null, 'Yemen', '967', 'YE', null, null);
INSERT INTO `system_constants` VALUES ('247', '', '225', null, 'Country', '0', '1', null, null, null, null, null, 'Kosovo', '381', 'XK', null, null);
INSERT INTO `system_constants` VALUES ('248', 'ساموا', '224', null, 'Country', '0', '1', null, null, null, null, null, 'Samoa', '685', 'WS', null, null);
INSERT INTO `system_constants` VALUES ('249', 'والس وفوتونا', '223', null, 'Country', '0', '1', null, null, null, null, null, 'Wallis and futuna', '681', 'WF', null, null);
INSERT INTO `system_constants` VALUES ('250', 'فانواتو', '222', null, 'Country', '0', '1', null, null, null, null, null, 'Vanuatu', '678', 'VU', null, null);
INSERT INTO `system_constants` VALUES ('251', 'فيتنام', '221', null, 'Country', '0', '1', null, null, null, null, null, 'Viet nam', '84', 'VN', null, null);
INSERT INTO `system_constants` VALUES ('252', '', '220', null, 'Country', '0', '1', null, null, null, null, null, 'Virgin islands, u.s.', '1340', 'VI', null, null);
INSERT INTO `system_constants` VALUES ('253', '', '219', null, 'Country', '0', '1', null, null, null, null, null, 'Virgin islands, british', '1284', 'VG', null, null);
INSERT INTO `system_constants` VALUES ('254', 'فنزويلا', '218', null, 'Country', '0', '1', null, null, null, null, null, 'Venezuela', '58', 'VE', null, null);
INSERT INTO `system_constants` VALUES ('255', 'سانت فنسنت وجزر غرينادين', '217', null, 'Country', '0', '1', null, null, null, null, null, 'Saint vincent and the grenadines', '1784', 'VC', null, null);
INSERT INTO `system_constants` VALUES ('256', 'دولة مدينة الفاتيكان', '216', null, 'Country', '0', '1', null, null, null, null, null, 'Holy see (vatican city state)', '39', 'VA', null, null);
INSERT INTO `system_constants` VALUES ('257', 'أوزباكستان', '215', null, 'Country', '0', '1', null, null, null, null, null, 'Uzbekistan', '998', 'UZ', null, null);
INSERT INTO `system_constants` VALUES ('258', 'أورغواي', '214', null, 'Country', '0', '1', null, null, null, null, null, 'Uruguay', '598', 'UY', null, null);
INSERT INTO `system_constants` VALUES ('259', 'الولايات المتحدة', '213', null, 'Country', '0', '1', null, null, null, null, null, 'United states', '1', 'US', null, null);
INSERT INTO `system_constants` VALUES ('260', 'أوغندا', '212', null, 'Country', '0', '1', null, null, null, null, null, 'Uganda', '256', 'UG', null, null);
INSERT INTO `system_constants` VALUES ('261', 'أوكرانيا', '211', null, 'Country', '0', '1', null, null, null, null, null, 'Ukraine', '380', 'UA', null, null);
INSERT INTO `system_constants` VALUES ('262', 'تنزانيا', '210', null, 'Country', '0', '1', null, null, null, null, null, 'Tanzania, united republic of', '255', 'TZ', null, null);
INSERT INTO `system_constants` VALUES ('263', 'تايوان', '209', null, 'Country', '0', '1', null, null, null, null, null, 'Taiwan, province of china', '886', 'TW', null, null);
INSERT INTO `system_constants` VALUES ('264', 'توفالو', '208', null, 'Country', '0', '1', null, null, null, null, null, 'Tuvalu', '688', 'TV', null, null);
INSERT INTO `system_constants` VALUES ('265', 'ترينيداد وتوباغو', '207', null, 'Country', '0', '1', null, null, null, null, null, 'Trinidad and tobago', '1868', 'TT', null, null);
INSERT INTO `system_constants` VALUES ('266', 'تركيا', '206', null, 'Country', '0', '1', null, null, null, null, null, 'Turkey', '90', 'TR', null, null);
INSERT INTO `system_constants` VALUES ('267', 'تونغا', '205', null, 'Country', '0', '1', null, null, null, null, null, 'Tonga', '676', 'TO', null, null);
INSERT INTO `system_constants` VALUES ('268', 'تونس', '204', null, 'Country', '0', '1', null, null, null, null, null, 'Tunisia', '216', 'TN', null, null);
INSERT INTO `system_constants` VALUES ('269', 'تركمانستان', '203', null, 'Country', '0', '1', null, null, null, null, null, 'Turkmenistan', '993', 'TM', null, null);
INSERT INTO `system_constants` VALUES ('270', 'تيمور الشرقية', '202', null, 'Country', '0', '1', null, null, null, null, null, 'Timor-leste', '670', 'TL', null, null);
INSERT INTO `system_constants` VALUES ('271', '', '201', null, 'Country', '0', '1', null, null, null, null, null, 'Tokelau', '690', 'TK', null, null);
INSERT INTO `system_constants` VALUES ('272', 'طاجيكستان', '200', null, 'Country', '0', '1', null, null, null, null, null, 'Tajikistan', '992', 'TJ', null, null);
INSERT INTO `system_constants` VALUES ('273', 'تايلندا', '199', null, 'Country', '0', '1', null, null, null, null, null, 'Thailand', '66', 'TH', null, null);
INSERT INTO `system_constants` VALUES ('274', 'توغو', '198', null, 'Country', '0', '1', null, null, null, null, null, 'Togo', '228', 'TG', null, null);
INSERT INTO `system_constants` VALUES ('275', 'تشاد', '197', null, 'Country', '0', '1', null, null, null, null, null, 'Chad', '235', 'TD', null, null);
INSERT INTO `system_constants` VALUES ('276', '', '196', null, 'Country', '0', '1', null, null, null, null, null, 'Turks and caicos islands', '1649', 'TC', null, null);
INSERT INTO `system_constants` VALUES ('277', 'سوازيلند', '195', null, 'Country', '0', '1', null, null, null, null, null, 'Swaziland', '268', 'SZ', null, null);
INSERT INTO `system_constants` VALUES ('278', 'سوريا', '194', null, 'Country', '0', '1', null, null, null, null, null, 'Syrian arab republic', '963', 'SY', null, null);
INSERT INTO `system_constants` VALUES ('279', 'إلسلفادور', '193', null, 'Country', '0', '1', null, null, null, null, null, 'El salvador', '503', 'SV', null, null);
INSERT INTO `system_constants` VALUES ('280', 'ساو تومي وبرينسيبي', '192', null, 'Country', '0', '1', null, null, null, null, null, 'Sao tome and principe', '239', 'ST', null, null);
INSERT INTO `system_constants` VALUES ('281', 'سورينام', '191', null, 'Country', '0', '1', null, null, null, null, null, 'Suriname', '597', 'SR', null, null);
INSERT INTO `system_constants` VALUES ('282', 'الصومال', '190', null, 'Country', '0', '1', null, null, null, null, null, 'Somalia', '252', 'SO', null, null);
INSERT INTO `system_constants` VALUES ('283', 'السنغال', '189', null, 'Country', '0', '1', null, null, null, null, null, 'Senegal', '221', 'SN', null, null);
INSERT INTO `system_constants` VALUES ('284', 'سان مارينو', '188', null, 'Country', '0', '1', null, null, null, null, null, 'San marino', '378', 'SM', null, null);
INSERT INTO `system_constants` VALUES ('285', 'سيراليون', '187', null, 'Country', '0', '1', null, null, null, null, null, 'Sierra leone', '232', 'SL', null, null);
INSERT INTO `system_constants` VALUES ('286', 'سلوفاكيا', '186', null, 'Country', '0', '1', null, null, null, null, null, 'Slovakia', '421', 'SK', null, null);
INSERT INTO `system_constants` VALUES ('287', 'سلوفينيا', '185', null, 'Country', '0', '1', null, null, null, null, null, 'Slovenia', '386', 'SI', null, null);
INSERT INTO `system_constants` VALUES ('288', '', '184', null, 'Country', '0', '1', null, null, null, null, null, 'Saint helena', '290', 'SH', null, null);
INSERT INTO `system_constants` VALUES ('289', 'سنغافورة', '183', null, 'Country', '0', '1', null, null, null, null, null, 'Singapore', '65', 'SG', null, null);
INSERT INTO `system_constants` VALUES ('290', 'السويد', '182', null, 'Country', '0', '1', null, null, null, null, null, 'Sweden', '46', 'SE', null, null);
INSERT INTO `system_constants` VALUES ('291', 'السودان', '181', null, 'Country', '0', '1', null, null, null, null, null, 'Sudan', '249', 'SD', null, null);
INSERT INTO `system_constants` VALUES ('292', 'سيشيل', '180', null, 'Country', '0', '1', null, null, null, null, null, 'Seychelles', '248', 'SC', null, null);
INSERT INTO `system_constants` VALUES ('293', 'جزر سليمان', '179', null, 'Country', '0', '0', null, null, null, null, '2019-12-29 17:39:06', 'Solomon islands', '677', 'SB', null, null);
INSERT INTO `system_constants` VALUES ('294', 'رواندا', '178', null, 'Country', '0', '1', null, null, null, null, null, 'Rwanda', '250', 'RW', null, null);
INSERT INTO `system_constants` VALUES ('295', 'روسيا', '177', null, 'Country', '0', '1', null, null, null, null, null, 'Russian federation', '7', 'RU', null, null);
INSERT INTO `system_constants` VALUES ('296', 'جمهورية صربيا', '176', null, 'Country', '0', '1', null, null, null, null, null, 'Serbia', '381', 'RS', null, null);
INSERT INTO `system_constants` VALUES ('297', 'رومانيا', '175', null, 'Country', '0', '1', null, null, null, null, null, 'Romania', '40', 'RO', null, null);
INSERT INTO `system_constants` VALUES ('298', 'قطر', '174', null, 'Country', '0', '1', null, null, null, null, null, 'Qatar', '974', 'QA', null, null);
INSERT INTO `system_constants` VALUES ('299', 'باراغواي', '173', null, 'Country', '0', '1', null, null, null, null, null, 'Paraguay', '595', 'PY', null, null);
INSERT INTO `system_constants` VALUES ('300', 'بالاو', '172', null, 'Country', '0', '1', null, null, null, null, null, 'Palau', '680', 'PW', null, null);
INSERT INTO `system_constants` VALUES ('301', 'البرتغال', '171', null, 'Country', '0', '1', null, null, null, null, null, 'Portugal', '351', 'PT', null, null);
INSERT INTO `system_constants` VALUES ('302', 'بورتوريكو', '170', null, 'Country', '0', '1', null, null, null, null, null, 'Puerto rico', '1', 'PR', null, null);
INSERT INTO `system_constants` VALUES ('303', '', '169', null, 'Country', '0', '1', null, null, null, null, null, 'Pitcairn', '870', 'PN', null, null);
INSERT INTO `system_constants` VALUES ('304', '', '168', null, 'Country', '0', '1', null, null, null, null, null, 'Saint pierre and miquelon', '508', 'PM', null, null);
INSERT INTO `system_constants` VALUES ('305', 'بولندا', '167', null, 'Country', '0', '1', null, null, null, null, null, 'Poland', '48', 'PL', null, null);
INSERT INTO `system_constants` VALUES ('306', 'باكستان', '166', null, 'Country', '0', '1', null, null, null, null, null, 'Pakistan', '92', 'PK', null, null);
INSERT INTO `system_constants` VALUES ('307', 'الفليبين', '165', null, 'Country', '0', '1', null, null, null, null, null, 'Philippines', '63', 'PH', null, null);
INSERT INTO `system_constants` VALUES ('308', 'بابوا غينيا الجديدة', '164', null, 'Country', '0', '1', null, null, null, null, null, 'Papua new guinea', '675', 'PG', null, null);
INSERT INTO `system_constants` VALUES ('309', 'بولينيزيا الفرنسية', '163', null, 'Country', '0', '1', null, null, null, null, null, 'French polynesia', '689', 'PF', null, null);
INSERT INTO `system_constants` VALUES ('310', 'بيرو', '162', null, 'Country', '0', '1', null, null, null, null, null, 'Peru', '51', 'PE', null, null);
INSERT INTO `system_constants` VALUES ('311', 'بنما', '161', null, 'Country', '0', '1', null, null, null, null, null, 'Panama', '507', 'PA', null, null);
INSERT INTO `system_constants` VALUES ('312', 'عُمان', '160', null, 'Country', '0', '1', null, null, null, null, null, 'Oman', '968', 'OM', null, null);
INSERT INTO `system_constants` VALUES ('313', 'نيوزيلندا', '159', null, 'Country', '0', '1', null, null, null, null, null, 'New zealand', '64', 'NZ', null, null);
INSERT INTO `system_constants` VALUES ('314', 'نييوي', '158', null, 'Country', '0', '1', null, null, null, null, null, 'Niue', '683', 'NU', null, null);
INSERT INTO `system_constants` VALUES ('315', 'ناورو', '157', null, 'Country', '0', '1', null, null, null, null, null, 'Nauru', '674', 'NR', null, null);
INSERT INTO `system_constants` VALUES ('316', 'نيبال', '156', null, 'Country', '0', '1', null, null, null, null, null, 'Nepal', '977', 'NP', null, null);
INSERT INTO `system_constants` VALUES ('317', 'النرويج', '155', null, 'Country', '0', '1', null, null, null, null, null, 'Norway', '47', 'NO', null, null);
INSERT INTO `system_constants` VALUES ('318', 'هولندا', '154', null, 'Country', '0', '1', null, null, null, null, null, 'Netherlands', '31', 'NL', null, null);
INSERT INTO `system_constants` VALUES ('319', 'نيكاراجوا', '153', null, 'Country', '0', '1', null, null, null, null, null, 'Nicaragua', '505', 'NI', null, null);
INSERT INTO `system_constants` VALUES ('320', 'نيجيريا', '152', null, 'Country', '0', '1', null, null, null, null, null, 'Nigeria', '234', 'NG', null, null);
INSERT INTO `system_constants` VALUES ('321', 'النيجر', '151', null, 'Country', '0', '1', null, null, null, null, null, 'Niger', '227', 'NE', null, null);
INSERT INTO `system_constants` VALUES ('322', 'كاليدونيا الجديدة', '150', null, 'Country', '0', '1', null, null, null, null, null, 'New caledonia', '687', 'NC', null, null);
INSERT INTO `system_constants` VALUES ('323', 'ناميبيا', '149', null, 'Country', '0', '1', null, null, null, null, null, 'Namibia', '264', 'NA', null, null);
INSERT INTO `system_constants` VALUES ('324', 'موزمبيق', '148', null, 'Country', '0', '1', null, null, null, null, null, 'Mozambique', '258', 'MZ', null, null);
INSERT INTO `system_constants` VALUES ('325', 'ماليزيا', '147', null, 'Country', '0', '1', null, null, null, null, null, 'Malaysia', '60', 'MY', null, null);
INSERT INTO `system_constants` VALUES ('326', 'المكسيك', '146', null, 'Country', '0', '1', null, null, null, null, null, 'Mexico', '52', 'MX', null, null);
INSERT INTO `system_constants` VALUES ('327', 'مالاوي', '145', null, 'Country', '0', '1', null, null, null, null, null, 'Malawi', '265', 'MW', null, null);
INSERT INTO `system_constants` VALUES ('328', 'المالديف', '144', null, 'Country', '0', '1', null, null, null, null, null, 'Maldives', '960', 'MV', null, null);
INSERT INTO `system_constants` VALUES ('329', 'موريشيوس', '143', null, 'Country', '0', '1', null, null, null, null, null, 'Mauritius', '230', 'MU', null, null);
INSERT INTO `system_constants` VALUES ('330', 'مالطا', '142', null, 'Country', '0', '1', null, null, null, null, null, 'Malta', '356', 'MT', null, null);
INSERT INTO `system_constants` VALUES ('331', 'مونتسيرات', '141', null, 'Country', '0', '1', null, null, null, null, null, 'Montserrat', '1664', 'MS', null, null);
INSERT INTO `system_constants` VALUES ('332', 'موريتانيا', '140', null, 'Country', '0', '1', null, null, null, null, null, 'Mauritania', '222', 'MR', null, null);
INSERT INTO `system_constants` VALUES ('333', 'جزر ماريانا الشمالية', '139', null, 'Country', '0', '1', null, null, null, null, null, 'Northern mariana islands', '1670', 'MP', null, null);
INSERT INTO `system_constants` VALUES ('334', 'ماكاو', '138', null, 'Country', '0', '1', null, null, null, null, null, 'Macau', '853', 'MO', null, null);
INSERT INTO `system_constants` VALUES ('335', 'منغوليا', '137', null, 'Country', '0', '1', null, null, null, null, null, 'Mongolia', '976', 'MN', null, null);
INSERT INTO `system_constants` VALUES ('336', 'ميانمار', '136', null, 'Country', '0', '1', null, null, null, null, null, 'Myanmar', '95', 'MM', null, null);
INSERT INTO `system_constants` VALUES ('337', 'مالي', '135', null, 'Country', '0', '1', null, null, null, null, null, 'Mali', '223', 'ML', null, null);
INSERT INTO `system_constants` VALUES ('338', 'جمهورية مقدونيا', '134', null, 'Country', '0', '1', null, null, null, null, null, 'Macedonia, the former yugoslav republic of', '389', 'MK', null, null);
INSERT INTO `system_constants` VALUES ('339', 'جزر مارشال', '133', null, 'Country', '0', '1', null, null, null, null, null, 'Marshall islands', '692', 'MH', null, null);
INSERT INTO `system_constants` VALUES ('340', 'مدغشقر', '132', null, 'Country', '0', '1', null, null, null, null, null, 'Madagascar', '261', 'MG', null, null);
INSERT INTO `system_constants` VALUES ('341', '', '131', null, 'Country', '0', '1', null, null, null, null, null, 'Saint martin', '1599', 'MF', null, null);
INSERT INTO `system_constants` VALUES ('342', 'الجبل الأسود', '130', null, 'Country', '0', '1', null, null, null, null, null, 'Montenegro', '382', 'ME', null, null);
INSERT INTO `system_constants` VALUES ('343', 'مولدافيا', '129', null, 'Country', '0', '1', null, null, null, null, null, 'Moldova, republic of', '373', 'MD', null, null);
INSERT INTO `system_constants` VALUES ('344', 'موناكو', '128', null, 'Country', '0', '1', null, null, null, null, null, 'Monaco', '377', 'MC', null, null);
INSERT INTO `system_constants` VALUES ('345', 'المغرب', '127', null, 'Country', '0', '1', null, null, null, null, null, 'Morocco', '212', 'MA', null, null);
INSERT INTO `system_constants` VALUES ('346', 'ليبيا', '126', null, 'Country', '0', '1', null, null, null, null, null, 'Libyan arab jamahiriya', '218', 'LY', null, null);
INSERT INTO `system_constants` VALUES ('347', 'لاتفيا', '125', null, 'Country', '0', '1', null, null, null, null, null, 'Latvia', '371', 'LV', null, null);
INSERT INTO `system_constants` VALUES ('348', 'لوكسمبورغ', '124', null, 'Country', '0', '1', null, null, null, null, null, 'Luxembourg', '352', 'LU', null, null);
INSERT INTO `system_constants` VALUES ('349', 'لتوانيا', '123', null, 'Country', '0', '1', null, null, null, null, null, 'Lithuania', '370', 'LT', null, null);
INSERT INTO `system_constants` VALUES ('350', 'ليسوتو', '122', null, 'Country', '0', '1', null, null, null, null, null, 'Lesotho', '266', 'LS', null, null);
INSERT INTO `system_constants` VALUES ('351', 'ليبيريا', '121', null, 'Country', '0', '1', null, null, null, null, null, 'Liberia', '231', 'LR', null, null);
INSERT INTO `system_constants` VALUES ('352', 'سريلانكا', '120', null, 'Country', '0', '1', null, null, null, null, null, 'Sri lanka', '94', 'LK', null, null);
INSERT INTO `system_constants` VALUES ('353', 'ليختنشتين', '119', null, 'Country', '0', '1', null, null, null, null, null, 'Liechtenstein', '423', 'LI', null, null);
INSERT INTO `system_constants` VALUES ('354', 'سانت لوسيا', '118', null, 'Country', '0', '1', null, null, null, null, null, 'Saint lucia', '1758', 'LC', null, null);
INSERT INTO `system_constants` VALUES ('355', 'لبنان', '117', null, 'Country', '0', '0', null, null, null, null, '2019-12-29 17:38:59', 'Lebanon', '961', 'LB', null, null);
INSERT INTO `system_constants` VALUES ('356', 'لاوس', '116', null, 'Country', '0', '1', null, null, null, null, null, 'Lao peoples democratic republic', '856', 'LA', null, null);
INSERT INTO `system_constants` VALUES ('357', 'كازاخستان', '115', null, 'Country', '0', '1', null, null, null, null, null, 'Kazakstan', '7', 'KZ', null, null);
INSERT INTO `system_constants` VALUES ('358', '', '114', null, 'Country', '0', '0', null, null, null, null, '2019-12-29 17:39:07', 'Cayman islands', '1345', 'KY', null, null);
INSERT INTO `system_constants` VALUES ('359', 'الكويت', '113', null, 'Country', '0', '1', null, null, null, null, null, 'Kuwait', '965', 'KW', null, null);
INSERT INTO `system_constants` VALUES ('360', 'كوريا الجنوبية', '112', null, 'Country', '0', '1', null, null, null, null, null, 'Korea republic of', '82', 'KR', null, null);
INSERT INTO `system_constants` VALUES ('361', 'كوريا الشمالية', '111', null, 'Country', '0', '1', null, null, null, null, null, 'Korea democratic peoples republic of', '850', 'KP', null, null);
INSERT INTO `system_constants` VALUES ('362', 'سانت كيتس ونيفس', '110', null, 'Country', '0', '1', null, null, null, null, null, 'Saint kitts and nevis', '1869', 'KN', null, null);
INSERT INTO `system_constants` VALUES ('363', 'جزر القمر', '109', null, 'Country', '0', '1', null, null, null, null, null, 'Comoros', '269', 'KM', null, null);
INSERT INTO `system_constants` VALUES ('364', 'كيريباتي', '108', null, 'Country', '0', '1', null, null, null, null, null, 'Kiribati', '686', 'KI', null, null);
INSERT INTO `system_constants` VALUES ('365', 'كمبوديا', '107', null, 'Country', '0', '1', null, null, null, null, null, 'Cambodia', '855', 'KH', null, null);
INSERT INTO `system_constants` VALUES ('366', 'قيرغيزستان', '106', null, 'Country', '0', '1', null, null, null, null, null, 'Kyrgyzstan', '996', 'KG', null, null);
INSERT INTO `system_constants` VALUES ('367', 'كينيا', '105', null, 'Country', '0', '1', null, null, null, null, null, 'Kenya', '254', 'KE', null, null);
INSERT INTO `system_constants` VALUES ('368', 'اليابان', '104', null, 'Country', '0', '1', null, null, null, null, null, 'Japan', '81', 'JP', null, null);
INSERT INTO `system_constants` VALUES ('369', 'الأردن', '103', null, 'Country', '0', '1', null, null, null, null, null, 'Jordan', '962', 'JO', null, null);
INSERT INTO `system_constants` VALUES ('370', 'جمايكا', '102', null, 'Country', '0', '1', null, null, null, null, null, 'Jamaica', '1876', 'JM', null, null);
INSERT INTO `system_constants` VALUES ('371', 'إيطاليا', '101', null, 'Country', '0', '1', null, null, null, null, null, 'Italy', '39', 'IT', null, null);
INSERT INTO `system_constants` VALUES ('372', 'آيسلندا', '100', null, 'Country', '0', '1', null, null, null, null, null, 'Iceland', '354', 'IS', null, null);
INSERT INTO `system_constants` VALUES ('373', 'إيران', '99', null, 'Country', '0', '1', null, null, null, null, null, 'Iran, islamic republic of', '98', 'IR', null, null);
INSERT INTO `system_constants` VALUES ('374', 'العراق', '98', null, 'Country', '0', '1', null, null, null, null, null, 'Iraq', '964', 'IQ', null, null);
INSERT INTO `system_constants` VALUES ('375', 'الهند', '97', null, 'Country', '0', '1', null, null, null, null, null, 'India', '91', 'IN', null, null);
INSERT INTO `system_constants` VALUES ('376', '', '96', null, 'Country', '0', '1', null, null, null, null, null, 'Isle of man', '44', 'IM', null, null);
INSERT INTO `system_constants` VALUES ('377', 'إسرائيل', '95', null, 'Country', '0', '1', null, null, null, null, null, 'Israel', '972', 'IL', null, null);
INSERT INTO `system_constants` VALUES ('378', 'جمهورية أيرلندا', '94', null, 'Country', '0', '1', null, null, null, null, null, 'Ireland', '353', 'IE', null, null);
INSERT INTO `system_constants` VALUES ('379', 'أندونيسيا', '93', null, 'Country', '0', '1', null, null, null, null, null, 'Indonesia', '62', 'ID', null, null);
INSERT INTO `system_constants` VALUES ('380', 'المجر', '92', null, 'Country', '0', '1', null, null, null, null, null, 'Hungary', '36', 'HU', null, null);
INSERT INTO `system_constants` VALUES ('381', 'هايتي', '91', null, 'Country', '0', '1', null, null, null, null, null, 'Haiti', '509', 'HT', null, null);
INSERT INTO `system_constants` VALUES ('382', 'كرواتيا', '90', null, 'Country', '0', '1', null, null, null, null, null, 'Croatia', '385', 'HR', null, null);
INSERT INTO `system_constants` VALUES ('383', 'هندوراس', '89', null, 'Country', '0', '1', null, null, null, null, null, 'Honduras', '504', 'HN', null, null);
INSERT INTO `system_constants` VALUES ('384', 'هونغ كونغ', '88', null, 'Country', '0', '1', null, null, null, null, null, 'Hong kong', '852', 'HK', null, null);
INSERT INTO `system_constants` VALUES ('385', 'غيانا', '87', null, 'Country', '0', '1', null, null, null, null, null, 'Guyana', '592', 'GY', null, null);
INSERT INTO `system_constants` VALUES ('386', 'غينيا-بيساو', '86', null, 'Country', '0', '1', null, null, null, null, null, 'Guinea-bissau', '245', 'GW', null, null);
INSERT INTO `system_constants` VALUES ('387', 'جوام', '85', null, 'Country', '0', '1', null, null, null, null, null, 'Guam', '1671', 'GU', null, null);
INSERT INTO `system_constants` VALUES ('388', 'غواتيمال', '84', null, 'Country', '0', '1', null, null, null, null, null, 'Guatemala', '502', 'GT', null, null);
INSERT INTO `system_constants` VALUES ('389', 'اليونان', '83', null, 'Country', '0', '1', null, null, null, null, null, 'Greece', '30', 'GR', null, null);
INSERT INTO `system_constants` VALUES ('390', 'غينيا الاستوائي', '82', null, 'Country', '0', '1', null, null, null, null, null, 'Equatorial guinea', '240', 'GQ', null, null);
INSERT INTO `system_constants` VALUES ('391', 'غينيا', '81', null, 'Country', '0', '1', null, null, null, null, null, 'Guinea', '224', 'GN', null, null);
INSERT INTO `system_constants` VALUES ('392', 'غامبيا', '80', null, 'Country', '0', '1', null, null, null, null, null, 'Gambia', '220', 'GM', null, null);
INSERT INTO `system_constants` VALUES ('393', '', '79', null, 'Country', '0', '1', null, null, null, null, null, 'Greenland', '299', 'GL', null, null);
INSERT INTO `system_constants` VALUES ('394', '', '78', null, 'Country', '0', '1', null, null, null, null, null, 'Gibraltar', '350', 'GI', null, null);
INSERT INTO `system_constants` VALUES ('395', 'غانا', '77', null, 'Country', '0', '1', null, null, null, null, null, 'Ghana', '233', 'GH', null, null);
INSERT INTO `system_constants` VALUES ('396', 'جيورجيا', '76', null, 'Country', '0', '1', null, null, null, null, null, 'Georgia', '995', 'GE', null, null);
INSERT INTO `system_constants` VALUES ('397', 'غرينادا', '75', null, 'Country', '0', '1', null, null, null, null, null, 'Grenada', '1473', 'GD', null, null);
INSERT INTO `system_constants` VALUES ('398', 'المملكة المتحدة', '74', null, 'Country', '0', '1', null, null, null, null, null, 'United kingdom', '44', 'GB', null, null);
INSERT INTO `system_constants` VALUES ('399', 'الغابون', '73', null, 'Country', '0', '1', null, null, null, null, null, 'Gabon', '241', 'GA', null, null);
INSERT INTO `system_constants` VALUES ('400', 'فرنسا', '72', null, 'Country', '0', '1', null, null, null, null, null, 'France', '33', 'FR', null, null);
INSERT INTO `system_constants` VALUES ('401', 'جزر فارو', '71', null, 'Country', '0', '1', null, null, null, null, null, 'Faroe islands', '298', 'FO', null, null);
INSERT INTO `system_constants` VALUES ('402', 'ولايات ميكرونيسيا المتحدة', '70', null, 'Country', '0', '1', null, null, null, null, null, 'Micronesia, federated states of', '691', 'FM', null, null);
INSERT INTO `system_constants` VALUES ('403', 'جزر فوكلاند', '69', null, 'Country', '0', '1', null, null, null, null, null, 'Falkland islands (malvinas)', '500', 'FK', null, null);
INSERT INTO `system_constants` VALUES ('404', 'فيجي', '68', null, 'Country', '0', '1', null, null, null, null, null, 'Fiji', '679', 'FJ', null, null);
INSERT INTO `system_constants` VALUES ('405', 'فنلندا', '67', null, 'Country', '0', '1', null, null, null, null, null, 'Finland', '358', 'FI', null, null);
INSERT INTO `system_constants` VALUES ('406', 'أثيوبيا', '66', null, 'Country', '0', '1', null, null, null, null, null, 'Ethiopia', '251', 'ET', null, null);
INSERT INTO `system_constants` VALUES ('407', 'إسبانيا', '65', null, 'Country', '0', '1', null, null, null, null, null, 'Spain', '34', 'ES', null, null);
INSERT INTO `system_constants` VALUES ('408', 'إريتريا', '64', null, 'Country', '0', '1', null, null, null, null, null, 'Eritrea', '291', 'ER', null, null);
INSERT INTO `system_constants` VALUES ('409', 'مصر', '63', null, 'Country', '0', '1', null, null, null, null, null, 'Egypt', '20', 'EG', null, null);
INSERT INTO `system_constants` VALUES ('410', 'استونيا', '62', null, 'Country', '0', '1', null, null, null, null, null, 'Estonia', '372', 'EE', null, null);
INSERT INTO `system_constants` VALUES ('411', 'إكوادور', '61', null, 'Country', '0', '1', null, null, null, null, null, 'Ecuador', '593', 'EC', null, null);
INSERT INTO `system_constants` VALUES ('412', 'الجزائر', '60', null, 'Country', '0', '1', null, null, null, null, null, 'Algeria', '213', 'DZ', null, null);
INSERT INTO `system_constants` VALUES ('413', 'الجمهورية الدومينيكية', '59', null, 'Country', '0', '1', null, null, null, null, null, 'Dominican republic', '1809', 'DO', null, null);
INSERT INTO `system_constants` VALUES ('414', 'دومينيكا', '58', null, 'Country', '0', '1', null, null, null, null, null, 'Dominica', '1767', 'DM', null, null);
INSERT INTO `system_constants` VALUES ('415', 'الدانمارك', '57', null, 'Country', '0', '1', null, null, null, null, null, 'Denmark', '45', 'DK', null, null);
INSERT INTO `system_constants` VALUES ('416', 'جيبوتي', '56', null, 'Country', '0', '1', null, null, null, null, null, 'Djibouti', '253', 'DJ', null, null);
INSERT INTO `system_constants` VALUES ('417', 'ألمانيا', '55', null, 'Country', '0', '1', null, null, null, null, null, 'Germany', '49', 'DE', null, null);
INSERT INTO `system_constants` VALUES ('418', 'الجمهورية التشيكية', '54', null, 'Country', '0', '1', null, null, null, null, null, 'Czech republic', '420', 'CZ', null, null);
INSERT INTO `system_constants` VALUES ('419', 'قبرص', '53', null, 'Country', '0', '1', null, null, null, null, null, 'Cyprus', '357', 'CY', null, null);
INSERT INTO `system_constants` VALUES ('420', '', '52', null, 'Country', '0', '1', null, null, null, null, null, 'Christmas island', '61', 'CX', null, null);
INSERT INTO `system_constants` VALUES ('421', 'الرأس الأخضر', '51', null, 'Country', '0', '1', null, null, null, null, null, 'Cape verde', '238', 'CV', null, null);
INSERT INTO `system_constants` VALUES ('422', 'كوبا', '50', null, 'Country', '0', '1', null, null, null, null, null, 'Cuba', '53', 'CU', null, null);
INSERT INTO `system_constants` VALUES ('423', 'كوستاريكا', '49', null, 'Country', '0', '1', null, null, null, null, null, 'Costa rica', '506', 'CR', null, null);
INSERT INTO `system_constants` VALUES ('424', 'كولومبيا', '48', null, 'Country', '0', '1', null, null, null, null, null, 'Colombia', '57', 'CO', null, null);
INSERT INTO `system_constants` VALUES ('425', 'جمهورية الصين الشعبية', '47', null, 'Country', '0', '1', null, null, null, null, null, 'China', '86', 'CN', null, null);
INSERT INTO `system_constants` VALUES ('426', 'كاميرون', '46', null, 'Country', '0', '1', null, null, null, null, null, 'Cameroon', '237', 'CM', null, null);
INSERT INTO `system_constants` VALUES ('427', 'شيلي', '45', null, 'Country', '0', '1', null, null, null, null, null, 'Chile', '56', 'CL', null, null);
INSERT INTO `system_constants` VALUES ('428', 'جزر كوك', '44', null, 'Country', '0', '1', null, null, null, null, null, 'Cook islands', '682', 'CK', null, null);
INSERT INTO `system_constants` VALUES ('429', 'ساحل العاج', '43', null, 'Country', '0', '1', null, null, null, null, null, 'Cote d ivoire', '225', 'CI', null, null);
INSERT INTO `system_constants` VALUES ('430', 'سويسرا', '42', null, 'Country', '0', '1', null, null, null, null, null, 'Switzerland', '41', 'CH', null, null);
INSERT INTO `system_constants` VALUES ('431', 'جمهورية الكونغو الديمقراطية', '41', null, 'Country', '0', '1', null, null, null, null, null, 'Congo', '242', 'CG', null, null);
INSERT INTO `system_constants` VALUES ('432', 'جمهورية أفريقيا الوسطى', '40', null, 'Country', '0', '1', null, null, null, null, null, 'Central african republic', '236', 'CF', null, null);
INSERT INTO `system_constants` VALUES ('433', '', '39', null, 'Country', '0', '1', null, null, null, null, null, 'Congo, the democratic republic of the', '243', 'CD', null, null);
INSERT INTO `system_constants` VALUES ('434', '', '38', null, 'Country', '0', '1', null, null, null, null, null, 'Cocos (keeling) islands', '61', 'CC', null, null);
INSERT INTO `system_constants` VALUES ('435', 'كندا', '37', null, 'Country', '0', '1', null, null, null, null, null, 'Canada', '1', 'CA', null, null);
INSERT INTO `system_constants` VALUES ('436', 'بيليز', '36', null, 'Country', '0', '1', null, null, null, null, null, 'Belize', '501', 'BZ', null, null);
INSERT INTO `system_constants` VALUES ('437', 'روسيا البيضاء', '35', null, 'Country', '0', '1', null, null, null, null, null, 'Belarus', '375', 'BY', null, null);
INSERT INTO `system_constants` VALUES ('438', 'بوتسوانا', '34', null, 'Country', '0', '1', null, null, null, null, null, 'Botswana', '267', 'BW', null, null);
INSERT INTO `system_constants` VALUES ('439', 'بوتان', '33', null, 'Country', '0', '1', null, null, null, null, null, 'Bhutan', '975', 'BT', null, null);
INSERT INTO `system_constants` VALUES ('440', 'الباهاماس', '32', null, 'Country', '0', '1', null, null, null, null, null, 'Bahamas', '1242', 'BS', null, null);
INSERT INTO `system_constants` VALUES ('441', 'البرازيل', '31', null, 'Country', '0', '1', null, null, null, null, null, 'Brazil', '55', 'BR', null, null);
INSERT INTO `system_constants` VALUES ('442', 'بوليفيا', '30', null, 'Country', '0', '1', null, null, null, null, null, 'Bolivia', '591', 'BO', null, null);
INSERT INTO `system_constants` VALUES ('443', 'بروني', '29', null, 'Country', '0', '1', null, null, null, null, null, 'Brunei darussalam', '673', 'BN', null, null);
INSERT INTO `system_constants` VALUES ('444', 'جزر برمود', '28', null, 'Country', '0', '1', null, null, null, null, null, 'Bermuda', '1441', 'BM', null, null);
INSERT INTO `system_constants` VALUES ('445', '', '27', null, 'Country', '0', '0', null, null, null, null, '2019-12-29 17:39:02', 'Saint barthelemy', '590', 'BL', null, null);
INSERT INTO `system_constants` VALUES ('446', 'بنين', '26', null, 'Country', '0', '1', null, null, null, null, null, 'Benin', '229', 'BJ', null, null);
INSERT INTO `system_constants` VALUES ('447', 'بوروندي', '25', null, 'Country', '0', '1', null, null, null, null, null, 'Burundi', '257', 'BI', null, null);
INSERT INTO `system_constants` VALUES ('448', 'البحرين', '24', null, 'Country', '0', '1', null, null, null, null, null, 'Bahrain', '973', 'BH', null, null);
INSERT INTO `system_constants` VALUES ('449', 'بلغاريا', '23', null, 'Country', '0', '1', null, null, null, null, null, 'Bulgaria', '359', 'BG', null, null);
INSERT INTO `system_constants` VALUES ('450', 'بوركينا فاسو', '22', null, 'Country', '0', '1', null, null, null, null, null, 'Burkina faso', '226', 'BF', null, null);
INSERT INTO `system_constants` VALUES ('451', 'بلجيكا', '21', null, 'Country', '0', '1', null, null, null, null, null, 'Belgium', '32', 'BE', null, null);
INSERT INTO `system_constants` VALUES ('452', 'بنغلاديش', '20', null, 'Country', '0', '1', null, null, null, null, null, 'Bangladesh', '880', 'BD', null, null);
INSERT INTO `system_constants` VALUES ('453', 'بربادوس', '19', null, 'Country', '0', '1', null, null, null, null, null, 'Barbados', '1246', 'BB', null, null);
INSERT INTO `system_constants` VALUES ('454', 'البوسنة و الهرسك', '18', null, 'Country', '0', '1', null, null, null, null, null, 'Bosnia and herzegovina', '387', 'BA', null, null);
INSERT INTO `system_constants` VALUES ('455', 'أذربيجان', '17', null, 'Country', '0', '1', null, null, null, null, null, 'Azerbaijan', '994', 'AZ', null, null);
INSERT INTO `system_constants` VALUES ('456', 'أروبا', '16', null, 'Country', '0', '1', null, null, null, null, null, 'Aruba', '297', 'AW', null, null);
INSERT INTO `system_constants` VALUES ('457', 'أستراليا', '15', null, 'Country', '0', '1', null, null, null, null, null, 'Australia', '61', 'AU', null, null);
INSERT INTO `system_constants` VALUES ('458', 'النمسا', '14', null, 'Country', '0', '1', null, null, null, null, null, 'Austria', '43', 'AT', null, null);
INSERT INTO `system_constants` VALUES ('459', '', '13', null, 'Country', '0', '1', null, null, null, null, null, 'American samoa', '1684', 'AS', null, null);
INSERT INTO `system_constants` VALUES ('460', 'الأرجنتين', '12', null, 'Country', '0', '1', null, null, null, null, null, 'Argentina', '54', 'AR', null, null);
INSERT INTO `system_constants` VALUES ('461', '', '11', null, 'Country', '0', '0', null, null, null, null, '2019-12-29 17:39:04', 'Antarctica', '672', 'AQ', null, null);
INSERT INTO `system_constants` VALUES ('462', 'أنغولا', '10', null, 'Country', '0', '1', null, null, null, null, null, 'Angola', '244', 'AO', null, null);
INSERT INTO `system_constants` VALUES ('463', 'جزر الأنتيل الهولندي', '9', null, 'Country', '0', '0', null, null, null, null, '2019-12-29 17:39:09', 'Netherlands antilles', '599', 'AN', null, null);
INSERT INTO `system_constants` VALUES ('464', 'أرمينيا', '8', null, 'Country', '0', '1', null, null, null, null, null, 'Armenia', '374', 'AM', null, null);
INSERT INTO `system_constants` VALUES ('465', 'ألبانيا', '7', null, 'Country', '0', '1', null, null, null, null, null, 'Albania', '355', 'AL', null, null);
INSERT INTO `system_constants` VALUES ('466', 'أنغويلا', '6', null, 'Country', '0', '1', null, null, null, null, null, 'Anguilla', '1264', 'AI', null, null);
INSERT INTO `system_constants` VALUES ('467', 'أنتيغوا وبربودا', '5', null, 'Country', '0', '1', null, null, null, null, null, 'Antigua and barbuda', '1268', 'AG', null, null);
INSERT INTO `system_constants` VALUES ('468', 'أفغانستان', '4', null, 'Country', '0', '1', null, null, null, null, null, 'Afghanistan', '93', 'AF', null, null);
INSERT INTO `system_constants` VALUES ('469', 'الإمارات العربية المتحدة', '3', null, 'Country', '0', '1', null, null, null, null, null, 'United arab emirates', '971', 'AE', null, null);
INSERT INTO `system_constants` VALUES ('470', 'أندورا', '2', null, 'Country', '0', '1', null, null, null, null, null, 'Andorra', '376', 'AD', null, null);
INSERT INTO `system_constants` VALUES ('471', 'المملكة العربية السعودية', '232', null, 'Country', '1', '1', null, null, null, null, null, 'Saudi Arabia', '966', 'SA', null, null);
INSERT INTO `system_constants` VALUES ('472', 'مفعلة', '1', null, 'product_status', '1', '1', null, null, null, null, null, 'Activated', null, null, null, null);
INSERT INTO `system_constants` VALUES ('473', 'معلقة', '2', null, 'product_status', '2', '1', null, null, null, null, null, 'Pending', null, null, null, null);
INSERT INTO `system_constants` VALUES ('474', 'مقفلة', '3', null, 'product_status', '3', '1', null, null, null, null, null, 'Closed', null, null, null, null);
INSERT INTO `system_constants` VALUES ('478', 'تسليم يدوي', '1', null, 'delivery', '1', '1', null, null, null, null, null, null, null, null, null, null);
INSERT INTO `system_constants` VALUES ('479', 'عبر شركة', '2', null, 'delivery', '2', '1', null, null, null, null, null, null, null, null, null, null);
INSERT INTO `system_constants` VALUES ('480', 'اظهار الاعلان لعدد ايام محددة في السلايدر الرئيسي', '1', null, 'subscriptions', '1', '1', null, null, null, null, null, null, null, null, null, null);
INSERT INTO `system_constants` VALUES ('481', 'عدد الاعلانات المتاحة لشركة', '2', null, 'subscriptions', '2', '1', null, null, null, null, null, 'اظهار الاعلان لعدد ايام محددة في السلايدر الرئيسي', null, null, null, null);
INSERT INTO `system_constants` VALUES ('482', 'مدة كل باقة بالايام', '3', null, 'subscriptions', '3', '1', null, null, null, null, null, 'عدد الاعلانات المتاحة لشركة', null, null, null, null);
INSERT INTO `system_constants` VALUES ('483', 'العلامة الزرقاء التوثيق', '4', null, 'subscriptions', '4', '1', null, null, null, null, null, 'مدة كل باقة بالايام', null, null, null, null);
INSERT INTO `system_constants` VALUES ('484', 'اظهار المنتج في نتائج البحث الاولى', '5', null, 'subscriptions', '5', '1', null, null, null, null, null, 'العلامة الزرقاء التوثيق', null, null, null, null);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(191) NOT NULL,
  `fullname` varchar(191) NOT NULL,
  `mobile` varchar(30) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_users_fk` (`user_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------

-- ----------------------------
-- Table structure for zones
-- ----------------------------
DROP TABLE IF EXISTS `zones`;
CREATE TABLE `zones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `country_id` int(11) DEFAULT '1',
  `notes` varchar(255) DEFAULT NULL,
  `name_en` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `zones_parent_fk` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zones
-- ----------------------------
INSERT INTO `zones` VALUES ('5', 'المنطقة الشرقية', null, '1', '1', null, null, null, '1', null, null);
INSERT INTO `zones` VALUES ('13', 'منطقة عسير', null, '1', '1', '2020-08-06 11:46:24', '2020-08-31 00:32:10', null, '1', null, null);
INSERT INTO `zones` VALUES ('14', 'خميس مشيط', '13', '1', '1', '2020-08-06 11:47:11', '2020-08-06 11:47:11', null, '1', null, null);
INSERT INTO `zones` VALUES ('15', 'منطقة الرياض', null, '1', '1', '2020-08-30 09:27:19', '2020-08-30 09:27:19', null, '1', null, null);
INSERT INTO `zones` VALUES ('16', 'الرياض', '15', '1', '1', '2020-08-30 09:28:29', '2020-08-30 09:28:29', null, '1', null, null);
INSERT INTO `zones` VALUES ('17', 'الدرعية', '15', '1', '1', '2020-08-30 09:29:17', '2020-08-30 09:29:17', null, '1', null, null);
INSERT INTO `zones` VALUES ('18', 'الخرج', '15', '1', '1', '2020-08-30 09:29:45', '2020-08-30 09:29:45', null, '1', null, null);
INSERT INTO `zones` VALUES ('19', 'الدوادمي', '15', '1', '1', '2020-08-30 09:30:21', '2020-08-30 09:30:21', null, '1', null, null);
INSERT INTO `zones` VALUES ('20', 'المجمعة', '15', '1', '1', '2020-08-30 09:31:03', '2020-08-30 09:31:03', null, '1', null, null);
INSERT INTO `zones` VALUES ('21', 'القويعية', '15', '1', '1', '2020-08-30 09:31:32', '2020-08-30 09:31:32', null, '1', null, null);
INSERT INTO `zones` VALUES ('22', 'وادي الدواسر', '15', '1', '1', '2020-08-30 09:32:06', '2020-08-30 09:32:06', null, '1', null, null);
INSERT INTO `zones` VALUES ('23', 'الأفلاج', '15', '1', '1', '2020-08-30 09:32:54', '2020-08-30 09:32:54', null, '1', null, null);
INSERT INTO `zones` VALUES ('24', 'الزلفي', '15', '1', '1', '2020-08-30 09:33:17', '2020-08-30 09:33:17', null, '1', null, null);
INSERT INTO `zones` VALUES ('25', 'شقراء', '15', '1', '1', '2020-08-30 09:33:49', '2020-08-30 09:33:49', null, '1', null, null);
INSERT INTO `zones` VALUES ('26', 'حوطة بني تميم', '15', '1', '1', '2020-08-30 09:34:18', '2020-08-30 09:34:18', null, '1', null, null);
INSERT INTO `zones` VALUES ('27', 'عفيف', '15', '1', '1', '2020-08-30 09:34:43', '2020-08-30 09:34:43', null, '1', null, null);
INSERT INTO `zones` VALUES ('28', 'السليل', '15', '1', '1', '2020-08-30 09:35:15', '2020-08-30 09:35:15', null, '1', null, null);
INSERT INTO `zones` VALUES ('29', 'ضرماء', '15', '1', '1', '2020-08-30 09:35:43', '2020-08-30 09:35:43', null, '1', null, null);
INSERT INTO `zones` VALUES ('30', 'المزاحمية', '15', '1', '1', '2020-08-30 09:36:09', '2020-08-30 09:36:09', null, '1', null, null);
INSERT INTO `zones` VALUES ('31', 'رماح', '15', '1', '1', '2020-08-30 09:36:33', '2020-08-30 09:36:33', null, '1', null, null);
INSERT INTO `zones` VALUES ('32', 'ثادق', '15', '1', '1', '2020-08-30 09:37:04', '2020-08-30 09:37:04', null, '1', null, null);
INSERT INTO `zones` VALUES ('33', 'حريملاء', '15', '1', '1', '2020-08-30 09:37:24', '2020-08-30 09:37:24', null, '1', null, null);
INSERT INTO `zones` VALUES ('34', 'الحريق', '15', '1', '1', '2020-08-30 09:37:41', '2020-08-30 09:37:41', null, '1', null, null);
INSERT INTO `zones` VALUES ('35', 'الغاط', '15', '1', '1', '2020-08-30 09:38:23', '2020-08-30 09:38:23', null, '1', null, null);
INSERT INTO `zones` VALUES ('36', 'مرات', '15', '1', '1', '2020-08-30 09:38:52', '2020-08-30 09:38:52', null, '1', null, null);
INSERT INTO `zones` VALUES ('37', 'الدلم', '15', '1', '1', '2020-08-30 09:39:16', '2020-08-30 09:39:16', null, '1', null, null);
INSERT INTO `zones` VALUES ('38', 'الرين', '15', '1', '1', '2020-08-30 09:39:40', '2020-08-30 09:39:40', null, '1', null, null);
INSERT INTO `zones` VALUES ('39', 'مكة المكرمة', null, '1', '1', '2020-08-30 10:41:14', '2020-08-30 10:41:14', null, '1', null, null);
INSERT INTO `zones` VALUES ('40', 'مكة', '39', '1', '1', '2020-08-30 10:42:17', '2020-08-30 10:42:17', null, '1', null, null);
INSERT INTO `zones` VALUES ('41', 'جده', '39', '1', '1', '2020-08-30 10:42:39', '2020-08-30 10:42:39', null, '1', null, null);
INSERT INTO `zones` VALUES ('42', 'الطائف', '39', '1', '1', '2020-08-30 10:43:02', '2020-08-30 10:43:02', null, '1', null, null);
INSERT INTO `zones` VALUES ('43', 'رابغ', '39', '1', '1', '2020-08-30 10:43:35', '2020-08-30 10:43:35', null, '1', null, null);
INSERT INTO `zones` VALUES ('44', 'الليث', '39', '1', '1', '2020-08-30 10:43:53', '2020-08-30 10:43:53', null, '1', null, null);
INSERT INTO `zones` VALUES ('45', 'القنفذة', '39', '1', '1', '2020-08-30 10:44:13', '2020-08-30 10:44:13', null, '1', null, null);
INSERT INTO `zones` VALUES ('46', 'الجموم', '39', '1', '1', '2020-08-30 10:44:40', '2020-08-30 10:44:40', null, '1', null, null);
INSERT INTO `zones` VALUES ('47', 'خليص', '39', '1', '1', '2020-08-30 10:44:54', '2020-08-30 10:44:54', null, '1', null, null);
INSERT INTO `zones` VALUES ('48', 'الخرمه', '39', '1', '1', '2020-08-30 10:45:22', '2020-08-30 10:46:04', null, '1', null, null);
INSERT INTO `zones` VALUES ('49', 'رنية', '39', '1', '1', '2020-08-30 10:45:40', '2020-08-30 10:45:40', null, '1', null, null);
INSERT INTO `zones` VALUES ('50', 'تربة', '39', '1', '1', '2020-08-30 10:45:54', '2020-08-30 10:45:54', null, '1', null, null);
INSERT INTO `zones` VALUES ('51', 'الكامل', '39', '1', '1', '2020-08-30 10:46:27', '2020-08-30 10:46:27', null, '1', null, null);
INSERT INTO `zones` VALUES ('52', 'أضم', '39', '1', '1', '2020-08-31 00:11:53', '2020-08-31 00:11:53', null, '1', null, null);
INSERT INTO `zones` VALUES ('53', 'العرضيات', '39', '1', '1', '2020-08-31 00:12:27', '2020-08-31 00:12:27', null, '1', null, null);
INSERT INTO `zones` VALUES ('54', 'المويه', '39', '1', '1', '2020-08-31 00:12:55', '2020-08-31 00:12:55', null, '1', null, null);
INSERT INTO `zones` VALUES ('55', 'ميسان', '39', '1', '1', '2020-08-31 00:13:33', '2020-08-31 00:13:33', null, '1', null, null);
INSERT INTO `zones` VALUES ('56', 'بحره', '39', '1', '1', '2020-08-31 00:14:06', '2020-08-31 00:14:06', null, '1', null, null);
INSERT INTO `zones` VALUES ('57', 'المدينة المنورة', null, '1', '1', '2020-08-31 00:15:51', '2020-08-31 00:15:51', null, '1', null, null);
INSERT INTO `zones` VALUES ('58', 'المدينة المنورة', '57', '1', '1', '2020-08-31 00:16:57', '2020-08-31 00:16:57', null, '1', null, null);
INSERT INTO `zones` VALUES ('59', 'ينبع', '57', '1', '1', '2020-08-31 00:17:39', '2020-08-31 00:17:39', null, '1', null, null);
INSERT INTO `zones` VALUES ('60', 'العلا', '57', '1', '1', '2020-08-31 00:18:27', '2020-08-31 00:18:27', null, '1', null, null);
INSERT INTO `zones` VALUES ('61', 'مهد الذهب', '57', '1', '1', '2020-08-31 00:19:26', '2020-08-31 00:19:26', null, '1', null, null);
INSERT INTO `zones` VALUES ('62', 'الحناكية', '57', '1', '1', '2020-08-31 00:19:49', '2020-08-31 00:19:49', null, '1', null, null);
INSERT INTO `zones` VALUES ('63', 'وادي الفرع', '57', '1', '1', '2020-08-31 00:20:32', '2020-08-31 00:20:32', null, '1', null, null);
INSERT INTO `zones` VALUES ('64', 'العيص', '57', '1', '1', '2020-08-31 00:20:57', '2020-08-31 00:20:57', null, '1', null, null);
INSERT INTO `zones` VALUES ('65', 'بدر', '57', '1', '1', '2020-08-31 00:21:36', '2020-08-31 00:21:36', null, '1', null, null);
INSERT INTO `zones` VALUES ('66', 'خيبر', '57', '1', '1', '2020-08-31 00:22:03', '2020-08-31 00:22:03', null, '1', null, null);
INSERT INTO `zones` VALUES ('67', 'الدمام', '5', '1', '1', '2020-08-31 00:24:50', '2020-08-31 00:24:50', null, '1', null, null);
INSERT INTO `zones` VALUES ('68', 'الأحساء', '5', '1', '1', '2020-08-31 00:25:34', '2020-08-31 00:25:34', null, '1', null, null);
INSERT INTO `zones` VALUES ('69', 'بقيق', '5', '1', '1', '2020-08-31 00:26:02', '2020-08-31 00:26:02', null, '1', null, null);
INSERT INTO `zones` VALUES ('70', 'الجبيل', '5', '1', '1', '2020-08-31 00:26:37', '2020-08-31 00:26:37', null, '1', null, null);
INSERT INTO `zones` VALUES ('71', 'حفر الباطن', '5', '1', '1', '2020-08-31 00:27:07', '2020-08-31 00:27:07', null, '1', null, null);
INSERT INTO `zones` VALUES ('72', 'الخبر', '5', '1', '1', '2020-08-31 00:27:27', '2020-08-31 00:27:27', null, '1', null, null);
INSERT INTO `zones` VALUES ('73', 'الخفجي', '5', '1', '1', '2020-08-31 00:27:58', '2020-08-31 00:27:58', null, '1', null, null);
INSERT INTO `zones` VALUES ('74', 'رأس تنورة', '5', '1', '1', '2020-08-31 00:28:33', '2020-08-31 00:28:33', null, '1', null, null);
INSERT INTO `zones` VALUES ('75', 'العديد', '5', '1', '1', '2020-08-31 00:29:04', '2020-08-31 00:29:04', null, '1', null, null);
INSERT INTO `zones` VALUES ('76', 'قرية العليا', '5', '1', '1', '2020-08-31 00:29:30', '2020-08-31 00:29:30', null, '1', null, null);
INSERT INTO `zones` VALUES ('77', 'القطيف', '5', '1', '1', '2020-08-31 00:29:57', '2020-08-31 00:29:57', null, '1', null, null);
INSERT INTO `zones` VALUES ('78', 'النعيريه', '5', '1', '1', '2020-08-31 00:30:18', '2020-08-31 00:30:18', null, '1', null, null);
INSERT INTO `zones` VALUES ('79', 'أبها', '13', '1', '1', '2020-08-31 00:33:43', '2020-08-31 00:33:43', null, '1', null, null);
INSERT INTO `zones` VALUES ('80', 'أحد رفيده', '13', '1', '1', '2020-08-31 00:34:29', '2020-08-31 00:34:29', null, '1', null, null);
INSERT INTO `zones` VALUES ('81', 'سراة عبيده', '13', '1', '1', '2020-08-31 00:36:09', '2020-08-31 00:36:09', null, '1', null, null);
INSERT INTO `zones` VALUES ('82', 'ظهران الجنوب', '13', '1', '1', '2020-08-31 00:36:45', '2020-08-31 00:36:45', null, '1', null, null);
INSERT INTO `zones` VALUES ('83', 'النماص', '13', '1', '1', '2020-08-31 00:37:28', '2020-08-31 00:37:28', null, '1', null, null);
INSERT INTO `zones` VALUES ('84', 'بيشة', '13', '1', '1', '2020-08-31 00:38:17', '2020-08-31 00:38:17', null, '1', null, null);
INSERT INTO `zones` VALUES ('86', 'رجال ألمع', '13', '1', '1', '2020-08-31 00:39:40', '2020-08-31 00:39:40', null, '1', null, null);
INSERT INTO `zones` VALUES ('87', 'محايل عسير', '13', '1', '1', '2020-08-31 00:40:02', '2020-08-31 00:40:02', null, '1', null, null);
INSERT INTO `zones` VALUES ('88', 'بارق', '13', '1', '1', '2020-08-31 00:40:17', '2020-08-31 00:40:17', null, '1', null, null);
INSERT INTO `zones` VALUES ('89', 'المجاردة', '13', '1', '1', '2020-08-31 00:40:51', '2020-08-31 00:40:51', null, '1', null, null);
INSERT INTO `zones` VALUES ('90', 'بلقرن', '13', '1', '1', '2020-08-31 00:41:35', '2020-08-31 00:57:04', null, '1', null, null);
INSERT INTO `zones` VALUES ('91', 'تثليث', '13', '1', '1', '2020-08-31 00:43:06', '2020-08-31 00:43:06', null, '1', null, null);
INSERT INTO `zones` VALUES ('92', 'الأمواه', '13', '1', '1', '2020-08-31 00:43:29', '2020-08-31 00:43:29', null, '1', null, null);
INSERT INTO `zones` VALUES ('93', 'طريب', '13', '1', '1', '2020-08-31 00:44:15', '2020-08-31 00:44:15', null, '1', null, null);
INSERT INTO `zones` VALUES ('94', 'تنومه', '13', '1', '1', '2020-08-31 00:44:38', '2020-08-31 00:44:38', null, '1', null, null);
INSERT INTO `zones` VALUES ('95', 'الحرجة', '13', '1', '1', '2020-08-31 00:45:00', '2020-08-31 00:45:00', null, '1', null, null);
INSERT INTO `zones` VALUES ('96', 'البرك', '13', '1', '1', '2020-08-31 00:45:45', '2020-08-31 00:45:45', null, '1', null, null);
INSERT INTO `zones` VALUES ('97', 'الحريضه', '13', '1', '1', '2020-08-31 00:46:32', '2020-08-31 00:46:32', null, '1', null, null);
INSERT INTO `zones` VALUES ('98', 'القحمة', '13', '1', '1', '2020-08-31 00:47:17', '2020-08-31 00:47:17', null, '1', null, null);
INSERT INTO `zones` VALUES ('99', 'العرين', '13', '1', '1', '2020-08-31 00:48:04', '2020-08-31 00:48:04', null, '1', null, null);
INSERT INTO `zones` VALUES ('100', 'الحفاير والشيق', '13', '1', '1', '2020-08-31 00:59:17', '2020-08-31 00:59:17', null, '1', null, null);
INSERT INTO `zones` VALUES ('101', 'خيبر الجنوب', '13', '1', '1', '2020-08-31 00:59:43', '2020-08-31 00:59:43', null, '1', null, null);
INSERT INTO `zones` VALUES ('102', 'وادي بن هشبل', '13', '1', '1', '2020-08-31 01:00:06', '2020-08-31 01:00:06', null, '1', null, null);
INSERT INTO `zones` VALUES ('105', 'الجوه', '13', '1', '1', '2020-08-31 01:02:33', '2020-08-31 01:02:33', null, '1', null, null);
INSERT INTO `zones` VALUES ('106', 'الفرشة', '13', '1', '1', '2020-08-31 01:02:51', '2020-08-31 02:36:11', null, '1', null, null);
INSERT INTO `zones` VALUES ('107', 'الربوعه', '13', '1', '1', '2020-08-31 01:03:23', '2020-08-31 01:03:23', null, '1', null, null);
INSERT INTO `zones` VALUES ('108', 'وادي الحياه', '13', '1', '1', '2020-08-31 01:04:26', '2020-08-31 01:04:26', null, '1', null, null);
INSERT INTO `zones` VALUES ('109', 'بحر بو سكينه', '13', '1', '1', '2020-08-31 01:06:10', '2020-08-31 01:06:10', null, '1', null, null);
INSERT INTO `zones` VALUES ('110', 'عشيرة - الطايف', '39', '1', '1', '2020-08-31 01:07:40', '2020-08-31 01:07:40', null, '1', null, null);
INSERT INTO `zones` VALUES ('111', 'مربه', '13', '1', '1', '2020-08-31 01:08:08', '2020-08-31 01:08:08', null, '1', null, null);
INSERT INTO `zones` VALUES ('112', 'العيون', '5', '1', '1', '2020-08-31 01:12:26', '2020-08-31 01:12:26', null, '1', null, null);
INSERT INTO `zones` VALUES ('113', 'القيصومه', '5', '1', '1', '2020-08-31 01:13:30', '2020-08-31 01:13:30', null, '1', null, null);
INSERT INTO `zones` VALUES ('114', 'الهفوف', '5', '1', '1', '2020-08-31 01:14:07', '2020-08-31 01:14:07', null, '1', null, null);
INSERT INTO `zones` VALUES ('115', 'سيهات', '5', '1', '1', '2020-08-31 01:15:01', '2020-08-31 01:15:01', null, '1', null, null);
INSERT INTO `zones` VALUES ('117', 'منطقة نجران', null, '1', '1', '2020-08-31 04:39:47', '2020-08-31 04:39:47', null, '1', null, null);
INSERT INTO `zones` VALUES ('118', 'نجران', '117', '1', '1', '2020-08-31 04:40:09', '2020-08-31 04:40:09', null, '1', null, null);
INSERT INTO `zones` VALUES ('119', 'شروره', '117', '1', '1', '2020-08-31 04:40:51', '2020-08-31 04:40:51', null, '1', null, null);
INSERT INTO `zones` VALUES ('120', 'بدر الجنوب', '117', '1', '1', '2020-08-31 04:41:29', '2020-08-31 04:41:29', null, '1', null, null);
INSERT INTO `zones` VALUES ('121', 'ثار', '117', '1', '1', '2020-08-31 04:41:46', '2020-08-31 04:41:46', null, '1', null, null);
INSERT INTO `zones` VALUES ('122', 'حبونا', '117', '1', '1', '2020-08-31 04:42:11', '2020-08-31 04:42:11', null, '1', null, null);
INSERT INTO `zones` VALUES ('123', 'خباش', '117', '1', '1', '2020-08-31 04:42:25', '2020-08-31 04:42:25', null, '1', null, null);
INSERT INTO `zones` VALUES ('124', 'يدمه', '117', '1', '1', '2020-08-31 04:42:44', '2020-08-31 04:42:44', null, '1', null, null);
INSERT INTO `zones` VALUES ('125', 'الخرخير', '117', '1', '1', '2020-08-31 04:43:07', '2020-08-31 04:43:07', null, '1', null, null);
INSERT INTO `zones` VALUES ('126', 'الوديعه', '117', '1', '1', '2020-08-31 04:43:23', '2020-08-31 04:43:23', null, '1', null, null);
INSERT INTO `zones` VALUES ('127', 'منطقة جازان', null, '1', '1', '2020-08-31 04:57:06', '2020-08-31 04:57:06', null, '1', null, null);
INSERT INTO `zones` VALUES ('128', 'جازان', '127', '1', '1', '2020-08-31 04:57:27', '2020-08-31 04:57:27', null, '1', null, null);
INSERT INTO `zones` VALUES ('129', 'صبيا', '127', '1', '1', '2020-08-31 04:58:03', '2020-08-31 04:58:03', null, '1', null, null);
INSERT INTO `zones` VALUES ('130', 'بيش', '127', '1', '1', '2020-08-31 04:58:21', '2020-08-31 04:58:21', null, '1', null, null);
INSERT INTO `zones` VALUES ('131', 'أحد المسارحة', '127', '1', '1', '2020-08-31 04:58:47', '2020-08-31 04:58:47', null, '1', null, null);
INSERT INTO `zones` VALUES ('132', 'الدرب', '127', '1', '1', '2020-08-31 04:59:05', '2020-08-31 04:59:05', null, '1', null, null);
INSERT INTO `zones` VALUES ('133', 'الدائر', '127', '1', '1', '2020-08-31 04:59:40', '2020-08-31 04:59:40', null, '1', null, null);
INSERT INTO `zones` VALUES ('134', 'صامطه', '127', '1', '1', '2020-08-31 05:00:03', '2020-08-31 05:00:39', null, '1', null, null);
INSERT INTO `zones` VALUES ('135', 'أبو عريش', '127', '1', '1', '2020-08-31 05:00:23', '2020-08-31 05:00:23', null, '1', null, null);
INSERT INTO `zones` VALUES ('136', 'الحرث', '127', '1', '1', '2020-08-31 05:01:08', '2020-08-31 05:01:08', null, '1', null, null);
INSERT INTO `zones` VALUES ('137', 'الريث', '127', '1', '1', '2020-08-31 05:01:36', '2020-08-31 05:01:36', null, '1', null, null);
INSERT INTO `zones` VALUES ('138', 'الطوال', '127', '1', '1', '2020-08-31 05:02:03', '2020-08-31 05:02:03', null, '1', null, null);
INSERT INTO `zones` VALUES ('139', 'العارضه', '127', '1', '1', '2020-08-31 05:02:17', '2020-08-31 05:02:17', null, '1', null, null);
INSERT INTO `zones` VALUES ('140', 'العيدابي', '127', '1', '1', '2020-08-31 05:02:37', '2020-08-31 05:02:37', null, '1', null, null);
INSERT INTO `zones` VALUES ('141', 'ضمد', '127', '1', '1', '2020-08-31 05:03:13', '2020-08-31 05:03:13', null, '1', null, null);
INSERT INTO `zones` VALUES ('142', 'هروب', '127', '1', '1', '2020-08-31 05:03:26', '2020-08-31 05:03:26', null, '1', null, null);
INSERT INTO `zones` VALUES ('143', 'فرسان', '127', '1', '1', '2020-08-31 05:04:13', '2020-08-31 05:04:13', null, '1', null, null);
INSERT INTO `zones` VALUES ('144', 'فيفا', '127', '1', '1', '2020-08-31 05:05:39', '2020-08-31 05:05:39', null, '1', null, null);
INSERT INTO `zones` VALUES ('145', 'منطقة القصيم', null, '1', '1', '2020-08-31 11:44:40', '2020-08-31 11:44:40', null, '1', null, null);
INSERT INTO `zones` VALUES ('146', 'بريده', '145', '1', '1', '2020-08-31 11:47:05', '2020-08-31 11:47:05', null, '1', null, null);
INSERT INTO `zones` VALUES ('147', 'عنيزه', '145', '1', '1', '2020-08-31 11:47:31', '2020-08-31 11:47:31', null, '1', null, null);
INSERT INTO `zones` VALUES ('148', 'الرس', '145', '1', '1', '2020-08-31 11:47:47', '2020-08-31 11:47:47', null, '1', null, null);
INSERT INTO `zones` VALUES ('149', 'المذنب', '145', '1', '1', '2020-08-31 11:51:28', '2020-08-31 11:51:28', null, '1', null, null);
INSERT INTO `zones` VALUES ('150', 'البكيريه', '145', '1', '1', '2020-08-31 11:51:47', '2020-08-31 11:51:47', null, '1', null, null);
INSERT INTO `zones` VALUES ('151', 'البدائع', '145', '1', '1', '2020-08-31 11:52:03', '2020-08-31 11:52:03', null, '1', null, null);
INSERT INTO `zones` VALUES ('152', 'الأسياح', '145', '1', '1', '2020-08-31 11:53:43', '2020-08-31 11:53:43', null, '1', null, null);
INSERT INTO `zones` VALUES ('153', 'النبهانية', '145', '1', '1', '2020-08-31 11:57:01', '2020-08-31 11:57:01', null, '1', null, null);
INSERT INTO `zones` VALUES ('154', 'عيون الجواء', '145', '1', '1', '2020-08-31 11:57:48', '2020-08-31 11:57:48', null, '1', null, null);
INSERT INTO `zones` VALUES ('155', 'الشماسية', '145', '1', '1', '2020-08-31 12:01:15', '2020-08-31 12:01:15', null, '1', null, null);
INSERT INTO `zones` VALUES ('156', 'رياض الخبراء', '145', '1', '1', '2020-08-31 12:02:28', '2020-08-31 12:02:28', null, '1', null, null);
INSERT INTO `zones` VALUES ('157', 'عقلة الصقور', '145', '1', '1', '2020-08-31 12:03:49', '2020-08-31 12:03:49', null, '1', null, null);
INSERT INTO `zones` VALUES ('158', 'ضرية', '145', '1', '1', '2020-08-31 12:05:58', '2020-08-31 12:05:58', null, '1', null, null);
INSERT INTO `zones` VALUES ('159', 'منطقة حائل', null, '1', '1', '2020-08-31 12:13:08', '2020-08-31 12:13:08', null, '1', null, null);
INSERT INTO `zones` VALUES ('160', 'حائل', '159', '1', '1', '2020-08-31 12:14:07', '2020-08-31 12:14:07', null, '1', null, null);
INSERT INTO `zones` VALUES ('161', 'الحائط', '159', '1', '1', '2020-08-31 12:14:51', '2020-08-31 12:14:51', null, '1', null, null);
INSERT INTO `zones` VALUES ('162', 'بقعاء', '159', '1', '1', '2020-08-31 12:15:44', '2020-08-31 12:15:44', null, '1', null, null);
INSERT INTO `zones` VALUES ('163', 'الشنان', '159', '1', '1', '2020-08-31 12:17:23', '2020-08-31 12:17:23', null, '1', null, null);
INSERT INTO `zones` VALUES ('164', 'الحليفة', '159', '1', '1', '2020-08-31 12:26:15', '2020-08-31 12:26:15', null, '1', null, null);
INSERT INTO `zones` VALUES ('165', 'الغزالة', '159', '1', '1', '2020-08-31 12:27:01', '2020-08-31 12:27:01', null, '1', null, null);
INSERT INTO `zones` VALUES ('166', 'الشملي', '159', '1', '1', '2020-08-31 12:34:22', '2020-08-31 12:34:22', null, '1', null, null);
INSERT INTO `zones` VALUES ('167', 'منطقة الباحة', null, '1', '1', '2020-08-31 12:35:55', '2020-08-31 13:22:56', null, '1', null, null);
INSERT INTO `zones` VALUES ('168', 'الباحة', '167', '1', '1', '2020-08-31 12:36:58', '2020-08-31 12:36:58', null, '1', null, null);
INSERT INTO `zones` VALUES ('169', 'بلجرشي', '167', '1', '1', '2020-08-31 12:37:24', '2020-08-31 12:37:24', null, '1', null, null);
INSERT INTO `zones` VALUES ('170', 'المندق', '167', '1', '1', '2020-08-31 12:38:24', '2020-08-31 12:38:24', null, '1', null, null);
INSERT INTO `zones` VALUES ('171', 'المخواة', '167', '1', '1', '2020-08-31 12:39:03', '2020-08-31 12:39:03', null, '1', null, null);
INSERT INTO `zones` VALUES ('172', 'قلوة', '167', '1', '1', '2020-08-31 12:40:54', '2020-08-31 12:40:54', null, '1', null, null);
INSERT INTO `zones` VALUES ('173', 'العقيق', '167', '1', '1', '2020-08-31 12:41:53', '2020-08-31 12:41:53', null, '1', null, null);
INSERT INTO `zones` VALUES ('174', 'القرى', '167', '1', '1', '2020-08-31 12:45:47', '2020-08-31 12:45:47', null, '1', null, null);
INSERT INTO `zones` VALUES ('175', 'الحجرة', '167', '1', '1', '2020-08-31 12:47:40', '2020-08-31 12:47:40', null, '1', null, null);
INSERT INTO `zones` VALUES ('176', 'غامد الزناد', '167', '1', '1', '2020-08-31 12:51:59', '2020-08-31 12:51:59', null, '1', null, null);
INSERT INTO `zones` VALUES ('177', 'بني حسن', '167', '1', '1', '2020-08-31 12:52:46', '2020-08-31 12:52:46', null, '1', null, null);
INSERT INTO `zones` VALUES ('178', 'منطقة الجوف', null, '1', '1', '2020-08-31 12:55:36', '2020-08-31 12:55:36', null, '1', null, null);
INSERT INTO `zones` VALUES ('179', 'الجوف', '178', '1', '1', '2020-08-31 12:56:02', '2020-08-31 12:56:02', null, '1', null, null);
INSERT INTO `zones` VALUES ('180', 'سكاكا', '178', '1', '1', '2020-08-31 12:56:15', '2020-08-31 12:56:15', null, '1', null, null);
INSERT INTO `zones` VALUES ('181', 'القريات', '178', '1', '1', '2020-08-31 12:56:45', '2020-08-31 12:56:45', null, '1', null, null);
INSERT INTO `zones` VALUES ('182', 'دومة الجندل', '178', '1', '1', '2020-08-31 12:57:29', '2020-08-31 12:57:29', null, '1', null, null);
INSERT INTO `zones` VALUES ('183', 'طبرجل', '178', '1', '1', '2020-08-31 13:01:21', '2020-08-31 13:01:21', null, '1', null, null);
INSERT INTO `zones` VALUES ('184', 'الحدود الشمالية', null, '1', '1', '2020-08-31 13:03:25', '2020-08-31 13:03:25', null, '1', null, null);
INSERT INTO `zones` VALUES ('185', 'عرعر', '184', '1', '1', '2020-08-31 13:05:20', '2020-08-31 13:05:20', null, '1', null, null);
INSERT INTO `zones` VALUES ('186', 'رفحاء', '184', '1', '1', '2020-08-31 13:05:41', '2020-08-31 13:05:41', null, '1', null, null);
INSERT INTO `zones` VALUES ('187', 'طريف', '184', '1', '1', '2020-08-31 13:06:00', '2020-08-31 13:06:00', null, '1', null, null);
INSERT INTO `zones` VALUES ('188', 'منطقة تبوك', null, '1', '1', '2020-08-31 13:07:12', '2020-08-31 13:07:46', null, '1', null, null);
INSERT INTO `zones` VALUES ('189', 'تبوك', '188', '1', '1', '2020-08-31 13:07:32', '2020-08-31 13:07:32', null, '1', null, null);
INSERT INTO `zones` VALUES ('190', 'الوجه', '188', '1', '1', '2020-08-31 13:08:22', '2020-08-31 13:08:22', null, '1', null, null);
INSERT INTO `zones` VALUES ('191', 'ضباء', '188', '1', '1', '2020-08-31 13:08:44', '2020-08-31 13:08:44', null, '1', null, null);
INSERT INTO `zones` VALUES ('192', 'أملج', '188', '1', '1', '2020-08-31 13:09:28', '2020-08-31 13:09:28', null, '1', null, null);
INSERT INTO `zones` VALUES ('193', 'حقل', '188', '1', '1', '2020-08-31 13:09:51', '2020-08-31 13:09:51', null, '1', null, null);
INSERT INTO `zones` VALUES ('194', 'تيماء', '188', '1', '1', '2020-08-31 13:10:21', '2020-08-31 13:10:21', null, '1', null, null);
INSERT INTO `zones` VALUES ('195', 'البدع', '188', '1', '1', '2020-08-31 13:11:17', '2020-08-31 13:11:17', null, '1', null, null);
