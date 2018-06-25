/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : 1

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-06-25 01:41:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for shop_address
-- ----------------------------
DROP TABLE IF EXISTS `shop_address`;
CREATE TABLE `shop_address` (
  `addressid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(32) NOT NULL DEFAULT '',
  `lastname` varchar(32) NOT NULL DEFAULT '',
  `address` text,
  `postcode` char(6) NOT NULL DEFAULT '',
  `telephone` char(11) NOT NULL DEFAULT '',
  `userid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`addressid`),
  KEY `shop_address_userid` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_address
-- ----------------------------
INSERT INTO `shop_address` VALUES ('17', '张', 'asd', '北京市朝阳区酒仙路北路', '100000', '13888888888', '9', '1513430333');
INSERT INTO `shop_address` VALUES ('18', '123123', '1231231', '12312312123213123', '123213', '123213123', '1', '1513752884');
INSERT INTO `shop_address` VALUES ('20', 'asd', 'asd', 'asdasd', 'asd', 'asd', '5', '1513936237');

-- ----------------------------
-- Table structure for shop_admin
-- ----------------------------
DROP TABLE IF EXISTS `shop_admin`;
CREATE TABLE `shop_admin` (
  `adminid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `adminuser` varchar(32) NOT NULL DEFAULT '' COMMENT '管理员账户',
  `adminpass` char(64) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `adminemail` varchar(50) NOT NULL DEFAULT '' COMMENT '管理员电子邮箱',
  `logintime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登陆时间',
  `loginip` bigint(20) NOT NULL DEFAULT '0' COMMENT '登陆ip',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`adminid`),
  UNIQUE KEY `shop_admin_adminuser_adminpass` (`adminuser`,`adminpass`),
  UNIQUE KEY `shop_admin_adminuser_adminemail` (`adminuser`,`adminemail`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of shop_admin
-- ----------------------------
INSERT INTO `shop_admin` VALUES ('1', 'guaosi', '$2y$13$0xjckSmd7EY3Qc6N6EIZJ.ef6aBXL/O2tJLv2cWydk7Jk5LkxdCIq', 'guaosi@vip.qq.com', '1516002422', '2364764079', '1503064848');

-- ----------------------------
-- Table structure for shop_auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `shop_auth_assignment`;
CREATE TABLE `shop_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `shop_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `shop_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of shop_auth_assignment
-- ----------------------------
INSERT INTO `shop_auth_assignment` VALUES ('admin', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('brand/*', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('brand/add', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('brand/brands', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('brand/del', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('brand/mod', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('brand/removepic', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('category/*', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('category/add', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('category/cates', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('category/changetree', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('category/del', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('category/deltree', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('category/gettree', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('category/mod', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('category/rename', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('comment/*', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('comment/comments', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('comment/del', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('common/*', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('default', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('default/*', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('default/index', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('manage/*', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('manage/assign', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('manage/changeemail', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('manage/changepass', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('manage/del', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('manage/mailchangepass', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('manage/managers', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('manage/reg', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('order/*', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('order/changeexpress', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('order/detail', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('order/list', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('order/send', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('product/*', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('product/add', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('product/change', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('product/del', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('product/mod', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('product/products', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('product/removepic', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('public/*', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('public/login', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('public/logout', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('public/seekpassword', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('rbac/*', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('rbac/assignitem', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('rbac/createrole', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('rbac/createrule', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('rbac/roles', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('user/*', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('user/del', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('user/reg', '1', '1513414070');
INSERT INTO `shop_auth_assignment` VALUES ('user/users', '1', '1513414070');

-- ----------------------------
-- Table structure for shop_auth_item
-- ----------------------------
DROP TABLE IF EXISTS `shop_auth_item`;
CREATE TABLE `shop_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `shop_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `shop_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of shop_auth_item
-- ----------------------------
INSERT INTO `shop_auth_item` VALUES ('admin', '1', '超级管理员', null, null, '1504169578', '1504169578');
INSERT INTO `shop_auth_item` VALUES ('brand/*', '2', 'brand/*', null, null, '1513091812', '1513091812');
INSERT INTO `shop_auth_item` VALUES ('brand/add', '2', 'brand/add', null, null, '1513091812', '1513091812');
INSERT INTO `shop_auth_item` VALUES ('brand/brands', '2', 'brand/brands', null, null, '1513091812', '1513091812');
INSERT INTO `shop_auth_item` VALUES ('brand/del', '2', 'brand/del', null, null, '1513091812', '1513091812');
INSERT INTO `shop_auth_item` VALUES ('brand/mod', '2', 'brand/mod', null, null, '1513091812', '1513091812');
INSERT INTO `shop_auth_item` VALUES ('brand/removepic', '2', 'brand/removepic', null, null, '1513091812', '1513091812');
INSERT INTO `shop_auth_item` VALUES ('category/*', '2', 'category/*', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('category/add', '2', 'category/add', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('category/cates', '2', 'category/cates', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('category/changetree', '2', 'category/changetree', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('category/del', '2', 'category/del', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('category/deltree', '2', 'category/deltree', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('category/gettree', '2', 'category/gettree', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('category/mod', '2', 'category/mod', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('category/rename', '2', 'category/rename', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('comment/*', '2', 'comment/*', null, null, '1513414043', '1513414043');
INSERT INTO `shop_auth_item` VALUES ('comment/comments', '2', 'comment/comments', null, null, '1513414043', '1513414043');
INSERT INTO `shop_auth_item` VALUES ('comment/del', '2', 'comment/del', null, null, '1513414043', '1513414043');
INSERT INTO `shop_auth_item` VALUES ('common/*', '2', 'common/*', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('default', '1', '游客', null, null, '1504455733', '1504455733');
INSERT INTO `shop_auth_item` VALUES ('default/*', '2', 'default/*', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('default/index', '2', 'default/index', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('manage/*', '2', 'manage/*', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('manage/assign', '2', 'manage/assign', null, null, '1512969618', '1512969618');
INSERT INTO `shop_auth_item` VALUES ('manage/changeemail', '2', 'manage/changeemail', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('manage/changepass', '2', 'manage/changepass', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('manage/del', '2', 'manage/del', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('manage/mailchangepass', '2', 'manage/mailchangepass', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('manage/managers', '2', 'manage/managers', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('manage/reg', '2', 'manage/reg', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('Manager', '1', '商品管理员', null, null, '1504408634', '1504408634');
INSERT INTO `shop_auth_item` VALUES ('order/*', '2', 'order/*', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('order/changeexpress', '2', 'order/changeexpress', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('order/detail', '2', 'order/detail', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('order/list', '2', 'order/list', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('order/send', '2', 'order/send', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('product/*', '2', 'product/*', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('product/add', '2', 'product/add', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('product/change', '2', 'product/change', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('product/del', '2', 'product/del', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('product/mod', '2', 'product/mod', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('product/products', '2', 'product/products', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('product/removepic', '2', 'product/removepic', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('public/*', '2', 'public/*', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('public/login', '2', 'public/login', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('public/logout', '2', 'public/logout', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('public/seekpassword', '2', 'public/seekpassword', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('rbac/*', '2', 'rbac/*', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('rbac/assignitem', '2', 'rbac/assignitem', null, null, '1512969618', '1512969618');
INSERT INTO `shop_auth_item` VALUES ('rbac/createrole', '2', 'rbac/createrole', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('rbac/createrule', '2', 'rbac/createrule', null, null, '1512969618', '1512969618');
INSERT INTO `shop_auth_item` VALUES ('rbac/roles', '2', 'rbac/roles', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('test', '1', '测试状元', 'isAuthor', null, '1504449387', '1504449387');
INSERT INTO `shop_auth_item` VALUES ('user/*', '2', 'user/*', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('user/del', '2', 'user/del', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('user/reg', '2', 'user/reg', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('user/users', '2', 'user/users', null, null, '1504415553', '1504415553');
INSERT INTO `shop_auth_item` VALUES ('zs', '1', '张三', null, null, '1513440019', '1513440019');

-- ----------------------------
-- Table structure for shop_auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `shop_auth_item_child`;
CREATE TABLE `shop_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `shop_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `shop_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `shop_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `shop_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of shop_auth_item_child
-- ----------------------------
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'brand/*');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'brand/add');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'brand/brands');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'brand/del');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'brand/mod');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'brand/removepic');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'category/*');
INSERT INTO `shop_auth_item_child` VALUES ('Manager', 'category/*');
INSERT INTO `shop_auth_item_child` VALUES ('test', 'category/*');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'category/add');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'category/cates');
INSERT INTO `shop_auth_item_child` VALUES ('Manager', 'category/cates');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'category/changetree');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'category/del');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'category/deltree');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'category/gettree');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'category/mod');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'category/rename');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'common/*');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'default/*');
INSERT INTO `shop_auth_item_child` VALUES ('Manager', 'default/*');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'default/index');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'manage/*');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'manage/changeemail');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'manage/changepass');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'manage/del');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'manage/mailchangepass');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'manage/managers');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'manage/reg');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'Manager');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'order/*');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'order/changeexpress');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'order/detail');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'order/list');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'order/send');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'product/*');
INSERT INTO `shop_auth_item_child` VALUES ('Manager', 'product/*');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'product/add');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'product/change');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'product/del');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'product/mod');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'product/products');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'product/removepic');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'public/*');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'public/login');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'public/logout');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'public/seekpassword');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'rbac/*');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'rbac/assignitem');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'rbac/createrole');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'rbac/createrule');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'rbac/roles');
INSERT INTO `shop_auth_item_child` VALUES ('default', 'test');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'user/*');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'user/del');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'user/reg');
INSERT INTO `shop_auth_item_child` VALUES ('admin', 'user/users');

-- ----------------------------
-- Table structure for shop_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `shop_auth_rule`;
CREATE TABLE `shop_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of shop_auth_rule
-- ----------------------------
INSERT INTO `shop_auth_rule` VALUES ('isAuthor', 0x4F3A32313A226170705C6D6F64656C735C417574686F7252756C65223A333A7B733A343A226E616D65223B733A383A226973417574686F72223B733A393A22637265617465644174223B693A313530343434393138333B733A393A22757064617465644174223B693A313530343434393138333B7D, '1504449183', '1504449183');

-- ----------------------------
-- Table structure for shop_brand
-- ----------------------------
DROP TABLE IF EXISTS `shop_brand`;
CREATE TABLE `shop_brand` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `brandimg` varchar(255) NOT NULL COMMENT '品牌图标',
  `isshow` tinyint(8) unsigned NOT NULL DEFAULT '1' COMMENT '是否在首页显示',
  `createtime` int(11) unsigned NOT NULL,
  `updatetime` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of shop_brand
-- ----------------------------
INSERT INTO `shop_brand` VALUES ('1', '小米', 'shopyiip.guaosi.com.cn/5a2ffd0255f3f', '1', '1513091732', '1513094402');
INSERT INTO `shop_brand` VALUES ('2', '荣耀', 'shopyiip.guaosi.com.cn/5a2ffd1ebbe40', '1', '1513094430', '1513094430');
INSERT INTO `shop_brand` VALUES ('3', '魅族', 'shopyiip.guaosi.com.cn/5a2ffd276bd2d', '1', '1513094439', '1513094439');
INSERT INTO `shop_brand` VALUES ('6', '森马', 'shopyiip.guaosi.com.cn/5a5b2cba9180e', '1', '1515924666', '1515924666');

-- ----------------------------
-- Table structure for shop_cart
-- ----------------------------
DROP TABLE IF EXISTS `shop_cart`;
CREATE TABLE `shop_cart` (
  `cartid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `productid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `productnum` int(10) unsigned NOT NULL DEFAULT '0',
  `userid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cartid`),
  KEY `shop_cart_productid` (`productid`),
  KEY `shop_cart_userid` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_cart
-- ----------------------------
INSERT INTO `shop_cart` VALUES ('9', '21', '1', '17', '1504619883', '1504619883');
INSERT INTO `shop_cart` VALUES ('10', '22', '1', '17', '1504619887', '1504619887');
INSERT INTO `shop_cart` VALUES ('30', '38', '1', '5', '1513935822', '1513935822');

-- ----------------------------
-- Table structure for shop_category
-- ----------------------------
DROP TABLE IF EXISTS `shop_category`;
CREATE TABLE `shop_category` (
  `cateid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL DEFAULT '',
  `parentid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `adminid` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cateid`),
  KEY `shop_category_parentid` (`parentid`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_category
-- ----------------------------
INSERT INTO `shop_category` VALUES ('1', '服装', '0', '0', '0');
INSERT INTO `shop_category` VALUES ('3', '上衣', '1', '0', '0');
INSERT INTO `shop_category` VALUES ('4', '裤子', '1', '0', '0');
INSERT INTO `shop_category` VALUES ('6', '长袖', '3', '0', '0');
INSERT INTO `shop_category` VALUES ('7', '短袖', '3', '0', '0');
INSERT INTO `shop_category` VALUES ('12', '电子产品', '0', '0', '0');
INSERT INTO `shop_category` VALUES ('13', '手机', '12', '0', '0');
INSERT INTO `shop_category` VALUES ('14', '女装', '1', '0', '0');
INSERT INTO `shop_category` VALUES ('15', '男装', '1', '0', '0');
INSERT INTO `shop_category` VALUES ('16', '童装', '1', '0', '0');
INSERT INTO `shop_category` VALUES ('17', '内衣', '1', '0', '0');
INSERT INTO `shop_category` VALUES ('18', '手机配件', '12', '0', '0');
INSERT INTO `shop_category` VALUES ('19', '运营商', '12', '0', '0');
INSERT INTO `shop_category` VALUES ('20', '数码配件', '12', '0', '0');
INSERT INTO `shop_category` VALUES ('21', '影音娱乐', '12', '0', '0');
INSERT INTO `shop_category` VALUES ('22', '电子教育', '12', '0', '0');
INSERT INTO `shop_category` VALUES ('23', '家居、家具、家装、厨具', '0', '0', '0');
INSERT INTO `shop_category` VALUES ('24', '个护化妆', '0', '0', '0');
INSERT INTO `shop_category` VALUES ('25', '运动户外', '0', '0', '0');
INSERT INTO `shop_category` VALUES ('26', '汽车、汽车用品', '0', '0', '0');
INSERT INTO `shop_category` VALUES ('27', '母婴、玩具乐器', '0', '0', '0');
INSERT INTO `shop_category` VALUES ('28', '营养保健', '0', '0', '0');
INSERT INTO `shop_category` VALUES ('29', '食品、酒类、生鲜、特产', '0', '0', '0');
INSERT INTO `shop_category` VALUES ('30', '图书、音像、电子书', '0', '0', '0');
INSERT INTO `shop_category` VALUES ('31', '彩票、旅行、充值、票务', '0', '0', '0');
INSERT INTO `shop_category` VALUES ('32', '家居', '23', '0', '0');
INSERT INTO `shop_category` VALUES ('33', '家具', '23', '0', '0');
INSERT INTO `shop_category` VALUES ('34', '家装', '23', '0', '0');
INSERT INTO `shop_category` VALUES ('35', '厨具	', '23', '0', '0');
INSERT INTO `shop_category` VALUES ('36', '面部护肤', '24', '0', '0');
INSERT INTO `shop_category` VALUES ('37', '口腔护理', '24', '0', '0');
INSERT INTO `shop_category` VALUES ('38', '洗发护发', '24', '0', '0');
INSERT INTO `shop_category` VALUES ('39', '身体护理', '24', '0', '0');
INSERT INTO `shop_category` VALUES ('40', '彩妆香氛', '24', '0', '0');
INSERT INTO `shop_category` VALUES ('41', '女性护理', '24', '0', '0');
INSERT INTO `shop_category` VALUES ('42', '清洁洗护', '24', '0', '0');
INSERT INTO `shop_category` VALUES ('43', '生活用纸', '24', '0', '0');
INSERT INTO `shop_category` VALUES ('44', '宠物生活', '24', '0', '0');
INSERT INTO `shop_category` VALUES ('45', '运动鞋', '25', '0', '0');
INSERT INTO `shop_category` VALUES ('46', '运动服饰', '25', '0', '0');
INSERT INTO `shop_category` VALUES ('47', '健身训练', '25', '0', '0');
INSERT INTO `shop_category` VALUES ('48', '户外鞋服', '25', '0', '0');
INSERT INTO `shop_category` VALUES ('49', '户外装备', '25', '0', '0');
INSERT INTO `shop_category` VALUES ('50', '骑行/垂钓', '25', '0', '0');
INSERT INTO `shop_category` VALUES ('51', '体育用品', '25', '0', '0');
INSERT INTO `shop_category` VALUES ('52', '游泳用品', '25', '0', '0');
INSERT INTO `shop_category` VALUES ('53', '系统养护', '26', '0', '0');
INSERT INTO `shop_category` VALUES ('54', '电子/电器', '26', '0', '0');
INSERT INTO `shop_category` VALUES ('55', '汽车影音充气泵', '26', '0', '0');
INSERT INTO `shop_category` VALUES ('56', '清洁美容', '26', '0', '0');
INSERT INTO `shop_category` VALUES ('57', '坐垫/脚垫', '26', '0', '0');
INSERT INTO `shop_category` VALUES ('58', '内饰精品', '26', '0', '0');
INSERT INTO `shop_category` VALUES ('59', '汽车配件', '26', '0', '0');
INSERT INTO `shop_category` VALUES ('60', '安全自驾', '26', '0', '0');
INSERT INTO `shop_category` VALUES ('61', '汽车服务', '26', '0', '0');
INSERT INTO `shop_category` VALUES ('62', '奶粉', '27', '0', '0');
INSERT INTO `shop_category` VALUES ('63', '尿裤湿巾', '27', '0', '0');
INSERT INTO `shop_category` VALUES ('64', '营养辅食', '27', '0', '0');
INSERT INTO `shop_category` VALUES ('65', '喂养用品', '27', '0', '0');
INSERT INTO `shop_category` VALUES ('66', '孕婴洗护', '27', '0', '0');
INSERT INTO `shop_category` VALUES ('67', '服饰寝居', '27', '0', '0');
INSERT INTO `shop_category` VALUES ('68', '童车童床', '27', '0', '0');
INSERT INTO `shop_category` VALUES ('69', '儿童玩具', '27', '0', '0');
INSERT INTO `shop_category` VALUES ('70', '孕妈专区', '27', '0', '0');
INSERT INTO `shop_category` VALUES ('71', '饮料冲乳', '29', '0', '0');
INSERT INTO `shop_category` VALUES ('72', '进口食品', '29', '0', '0');
INSERT INTO `shop_category` VALUES ('73', '生鲜食品', '29', '0', '0');
INSERT INTO `shop_category` VALUES ('74', '中外名酒', '29', '0', '0');
INSERT INTO `shop_category` VALUES ('75', '休闲食品', '29', '0', '0');
INSERT INTO `shop_category` VALUES ('76', '粮油调味', '29', '0', '0');
INSERT INTO `shop_category` VALUES ('77', '营养保健', '29', '0', '0');
INSERT INTO `shop_category` VALUES ('78', '中华特色馆', '29', '0', '0');
INSERT INTO `shop_category` VALUES ('79', '少儿频道', '30', '0', '0');
INSERT INTO `shop_category` VALUES ('80', '漫卡通', '30', '0', '0');
INSERT INTO `shop_category` VALUES ('81', '文学艺术', '30', '0', '0');
INSERT INTO `shop_category` VALUES ('82', '人文社科', '30', '0', '0');
INSERT INTO `shop_category` VALUES ('83', '音像', '30', '0', '0');
INSERT INTO `shop_category` VALUES ('84', '期刊杂志', '30', '0', '0');
INSERT INTO `shop_category` VALUES ('85', '经管励志', '30', '0', '0');
INSERT INTO `shop_category` VALUES ('86', '健康生活', '30', '0', '0');
INSERT INTO `shop_category` VALUES ('87', '教育科技', '30', '0', '0');
INSERT INTO `shop_category` VALUES ('88', '电子书', '30', '0', '0');
INSERT INTO `shop_category` VALUES ('89', '金融', '31', '0', '0');
INSERT INTO `shop_category` VALUES ('90', '投资理财', '31', '0', '0');
INSERT INTO `shop_category` VALUES ('91', '众筹', '31', '0', '0');
INSERT INTO `shop_category` VALUES ('92', '保险', '31', '0', '0');
INSERT INTO `shop_category` VALUES ('93', '易付宝', '31', '0', '0');
INSERT INTO `shop_category` VALUES ('94', '旅行', '31', '0', '0');
INSERT INTO `shop_category` VALUES ('95', '时尚男鞋', '28', '0', '0');
INSERT INTO `shop_category` VALUES ('96', '女鞋', '28', '0', '0');
INSERT INTO `shop_category` VALUES ('97', '时尚女包', '28', '0', '0');
INSERT INTO `shop_category` VALUES ('98', '精品男包', '28', '0', '0');
INSERT INTO `shop_category` VALUES ('99', '功能箱包', '28', '0', '0');
INSERT INTO `shop_category` VALUES ('100', '钟表眼镜', '28', '0', '0');
INSERT INTO `shop_category` VALUES ('101', '珠宝饰品', '28', '0', '0');
INSERT INTO `shop_category` VALUES ('102', '礼品乐器', '28', '0', '0');

-- ----------------------------
-- Table structure for shop_comment
-- ----------------------------
DROP TABLE IF EXISTS `shop_comment`;
CREATE TABLE `shop_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(655) NOT NULL DEFAULT '',
  `user_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `score` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of shop_comment
-- ----------------------------
INSERT INTO `shop_comment` VALUES ('1', '这儿测试评论', '1', '34', '0', '4');
INSERT INTO `shop_comment` VALUES ('2', '再增加一条', '1', '24', '1513268007', '5');
INSERT INTO `shop_comment` VALUES ('3', '阿萨德', '1', '24', '1513351951', '2');
INSERT INTO `shop_comment` VALUES ('4', '阿萨德', '1', '24', '1513352373', '4');
INSERT INTO `shop_comment` VALUES ('5', '请问', '1', '24', '1513354052', '3');
INSERT INTO `shop_comment` VALUES ('6', '请问', '1', '24', '1513354194', '3');
INSERT INTO `shop_comment` VALUES ('8', '请问', '1', '24', '1513354705', '3');
INSERT INTO `shop_comment` VALUES ('9', '张三', '1', '20', '1513355274', '5');

-- ----------------------------
-- Table structure for shop_migration
-- ----------------------------
DROP TABLE IF EXISTS `shop_migration`;
CREATE TABLE `shop_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of shop_migration
-- ----------------------------
INSERT INTO `shop_migration` VALUES ('m000000_000000_base', '1504161738');
INSERT INTO `shop_migration` VALUES ('m140506_102106_rbac_init', '1504161741');

-- ----------------------------
-- Table structure for shop_order
-- ----------------------------
DROP TABLE IF EXISTS `shop_order`;
CREATE TABLE `shop_order` (
  `orderid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_no` varchar(20) NOT NULL COMMENT '订单号',
  `userid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `receiver` varchar(30) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `telephone` char(11) NOT NULL DEFAULT '',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` int(10) unsigned NOT NULL DEFAULT '0',
  `expressid` int(10) unsigned NOT NULL DEFAULT '0',
  `expressno` varchar(50) NOT NULL DEFAULT '',
  `tradeno` varchar(100) NOT NULL DEFAULT '',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isdelete` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`orderid`),
  KEY `shop_order_userid` (`userid`),
  KEY `shop_order_addressid` (`address`),
  KEY `shop_order_expressid` (`expressid`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_order
-- ----------------------------
INSERT INTO `shop_order` VALUES ('15', 'A825917895302278', '9', '张三', '北京市朝阳区酒仙路酒仙一号', '13888888888', '8818.24', '301', '1', '', '', '1503591789', '2017-12-16 21:05:17', '0');
INSERT INTO `shop_order` VALUES ('16', 'A825919040629274', '9', '张三', '北京市朝阳区酒仙路酒仙一号', '13888888888', '8818.24', '220', '1', '', '2017082521001004870200157083', '1503591904', '2018-06-25 01:29:34', '0');
INSERT INTO `shop_order` VALUES ('20', 'A825920198776978', '9', '张三', '北京市朝阳区酒仙路酒仙一号', '13888888888', '8818.24', '202', '1', '', '2017082521001004870200156992', '1503592019', '2017-08-25 21:39:28', '0');
INSERT INTO `shop_order` VALUES ('21', 'A825921079404587', '9', '张三', '北京市朝阳区酒仙路酒仙一号', '13888888888', '5015.00', '0', '1', '', '', '1503592107', '2017-08-25 21:39:29', '0');
INSERT INTO `shop_order` VALUES ('22', 'A825921890523461', '9', '张三', '北京市朝阳区酒仙路酒仙一号', '13888888888', '11517.80', '0', '1', '', '', '1503592189', '2017-08-25 21:39:29', '0');
INSERT INTO `shop_order` VALUES ('24', 'A825496287055719', '9', '张三', '北京市朝阳区酒仙路酒仙一号', '13888888888', '1020.00', '0', '1', '', '', '1503649628', '2017-08-25 21:39:30', '0');
INSERT INTO `shop_order` VALUES ('25', 'A825502700067610', '9', '张三', '北京市朝阳区酒仙路酒仙一号', '13888888888', '1020.00', '260', '1', '', '2017082521001004870200156993', '1503650270', '2017-08-28 21:07:54', '0');
INSERT INTO `shop_order` VALUES ('26', 'A825536179895694', '9', '张三', '北京市朝阳区酒仙路酒仙一号', '13888888888', '17112.68', '202', '1', '', '2017082521001004870200157090', '1503653617', '2017-08-25 21:39:31', '0');
INSERT INTO `shop_order` VALUES ('27', 'A825573951863895', '9', '张三', '北京市朝阳区酒仙路酒仙一号', '13888888888', '6017.00', '202', '1', '', '2017082521001004870200156990', '1503657395', '2017-08-25 21:39:32', '0');
INSERT INTO `shop_order` VALUES ('28', 'A825584181270764', '9', '张三', '北京市朝阳区酒仙路酒仙一号', '13888888888', '1020.00', '202', '1', '', '2017082521001004870200156991', '1503658418', '2017-08-25 21:39:33', '0');
INSERT INTO `shop_order` VALUES ('29', 'A825690998495874', '9', '张三丰', '北京市朝阳区酒仙路北路', '13888888888', '1719.56', '202', '1', '', '2017082521001004870200156994', '1503669099', '2017-08-25 21:52:08', '0');
INSERT INTO `shop_order` VALUES ('31', 'A826298529613288', '9', '张三丰', '北京市朝阳区酒仙路北路', '13888888888', '5020.00', '301', '1', '', '', '1503729852', '2017-12-16 21:04:43', '0');
INSERT INTO `shop_order` VALUES ('32', 'A831509727151454', '9', '李四', '北京市朝阳区酒仙路北路', '13888888888', '1020.00', '301', '1', '', '2017090621001004870200160793', '1504150972', '2017-12-16 21:17:16', '0');
INSERT INTO `shop_order` VALUES ('33', 'A906276107172854', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '1352.00', '301', '1', '', '2017090621001004870200160640', '1504627610', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('34', 'A906276884030920', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '686.00', '202', '1', '', '2017090621001004870200160522', '1504627688', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('36', 'A906302130036375', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '686.00', '202', '1', '', '2017090621001004870200160641', '1504630213', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('37', 'A906302849228720', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '686.00', '202', '1', '', '2017090621001004870200160642', '1504630284', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('38', 'A906303949597033', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '6083.12', '202', '1', '', '2017090621001004870200160643', '1504630394', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('39', 'A906655256218658', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '202', '1', '', '2017090621001004870200160555', '1504665525', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('40', 'A906677386168889', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '3419.12', '202', '1', '', '2017090621001004870200160556', '1504667738', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('41', 'A906681386532803', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '3419.12', '202', '1', '', '2017090621001004870200160692', '1504668138', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('42', 'A906683661789345', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '3419.12', '0', '1', '', '', '1504668366', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('43', 'A906686353615742', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '202', '1', '', '2017090621001004870200160693', '1504668635', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('44', 'A906689074317842', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '0', '1', '', '2017090621001004870200160558', '1504668907', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('45', 'A906692180535485', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '0', '1', '', '', '1504669218', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('46', 'A906694389411348', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '202', '1', '', '2017090621001004870200160559', '1504669438', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('47', 'A906695888055440', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '202', '1', '', '2017090621001004870200160561', '1504669588', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('48', 'A906014651696514', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '686.00', '202', '1', '', '2017090621001004870200160722', '1504701465', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('49', 'A906055807708887', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '1719.56', '202', '1', '', '2017090621001004870200160723', '1504705580', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('50', 'A906057529525141', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '686.00', '202', '1', '', '2017090621001004870200160794', '1504705752', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('51', 'A906058777606721', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '686.00', '202', '1', '', '2017090621001004870200160795', '1504705877', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('52', 'A906062134405047', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '2018.00', '202', '1', '', '2017090621001004870200160724', '1504706213', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('53', 'A906065724011584', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '686.00', '202', '1', '', '2017090621001004870200160796', '1504706572', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('54', 'A906066420632857', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '686.00', '202', '1', '', '2017090621001004870200160725', '1504706642', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('56', 'A911178102404851', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '101', '1', '', '', '1505117810', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('59', 'A911192409875170', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '10217.36', '101', '1', '', '', '1505119240', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('61', 'A911222193720097', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '1719.56', '301', '1', '', '', '1505122219', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('62', 'A911224190008996', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '1719.56', '101', '1', '', '', '1505122419', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('63', 'A911224994401359', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '1719.56', '101', '1', '', '', '1505122499', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('64', 'A911225466232547', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '1719.56', '101', '1', '', '', '1505122546', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('65', 'A911226156690706', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '1719.56', '101', '1', '', '', '1505122615', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('66', 'A911226833559443', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '3419.12', '101', '1', '', '', '1505122683', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('67', 'A911404766869248', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '6818.24', '101', '1', '', '', '1505140476', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('68', 'A911411135419380', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '101', '1', '', '', '1505141113', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('69', 'A911412851707063', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '101', '1', '', '', '1505141285', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('70', 'A911413236157988', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '101', '1', '', '', '1505141323', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('71', 'A911415242150428', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '101', '1', '', '', '1505141524', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('72', 'A911416245021579', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '101', '1', '', '', '1505141624', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('73', 'A911416637500238', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '101', '1', '', '', '1505141663', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('74', 'A911417126028668', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '101', '1', '', '', '1505141712', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('75', 'A911420646768824', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '101', '1', '', '', '1505142064', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('76', 'A911421681544963', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '260', '1', '3912885937071', '2017091121001004870200161453', '1505142168', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('77', 'A911425353429959', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '101', '1', '', '', '1505142535', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('78', 'A911425729453055', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '101', '1', '', '', '1505142572', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('79', 'A911428252325769', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '10217.36', '260', '1', '', '', '1505142825', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('80', 'A911429029980093', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '3419.12', '101', '1', '', '', '1505142902', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('81', 'A911430744362236', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '260', '1', '', '', '1505143074', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('82', 'A911432453375927', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '101', '1', '', '', '1505143245', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('83', 'A911435403325935', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '8517.80', '101', '1', '', '', '1505143540', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('84', 'A911437509598034', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '101', '1', '', '', '1505143750', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('85', 'A911438576919690', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '101', '1', '', '', '1505143857', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('86', 'A911439226592330', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '101', '1', '', '', '1505143922', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('87', 'A911440066142510', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '6818.24', '101', '1', '', '', '1505144006', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('88', 'A911440973000319', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '101', '1', '', '', '1505144097', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('89', 'A911442492060410', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '1719.56', '101', '1', '', '', '1505144249', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('90', 'A911448712968778', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '101', '1', '', '', '1505144871', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('91', 'A911451079587375', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '1719.56', '301', '1', '', '', '1505145107', '2018-06-25 01:29:18', '1');
INSERT INTO `shop_order` VALUES ('92', 'A911454124325850', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '101', '1', '', '', '1505145412', '2018-06-25 01:29:18', '1');
INSERT INTO `shop_order` VALUES ('93', 'A913883599743017', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '3419.12', '301', '1', '', '2017091321001004870200161866', '1505288359', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('94', 'A913884952348241', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '3419.12', '301', '1', '', '2017091321001004870200162035', '1505288495', '2018-06-25 01:29:18', '1');
INSERT INTO `shop_order` VALUES ('95', 'A913886727574104', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '301', '1', '', '2017091321001004870200162036', '1505288672', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('96', 'A913901311381950', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '101', '1', '', '', '1505290131', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('97', 'A913901876150373', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '202', '1', '', '2017091321001004870200162104', '1505290187', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('98', 'A913903563959258', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '5118.68', '202', '1', '', '2017091321001004870200162105', '1505290356', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('99', 'A913906134703709', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '6818.24', '202', '1', '', '2017091321001004870200162039', '1505290613', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('100', 'A913909442665422', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '3419.12', '201', '1', '', '2017091321001004870200162040', '1505290944', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('101', 'A913919116809057', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '3419.12', '202', '1', '', '2017091321001004870200162041', '1505291911', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('102', 'A913923079575379', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '3419.12', '101', '1', '', '', '1505292307', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('103', 'A913926103014964', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '3411.12', '101', '0', '', '', '1505292610', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('104', 'A913926620808244', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '3411.12', '202', '0', '', '2017091321001004870200162043', '1505292662', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('105', 'AC10929247841815', '9', '李四', '北京市朝阳区酒仙路北路', '13888888888', '1012.00', '101', '0', '', '', '1512892924', '2017-12-10 16:02:14', '0');
INSERT INTO `shop_order` VALUES ('106', 'AC10930863939726', '9', '张三丰', '北京市朝阳区酒仙路北路', '13888888888', '678.00', '101', '0', '', '', '1512893086', '2017-12-16 21:16:55', '1');
INSERT INTO `shop_order` VALUES ('107', 'AC16301407687040', '9', '张asd', '北京市朝阳区酒仙路北路', '13888888888', '1011.00', '301', '0', '', '', '1513430140', '2017-12-16 21:16:42', '1');
INSERT INTO `shop_order` VALUES ('108', 'AC16303608808802', '9', '张asd', '北京市朝阳区酒仙路北路', '13888888888', '1011.00', '301', '0', '', '', '1513430360', '2017-12-16 21:23:52', '0');
INSERT INTO `shop_order` VALUES ('109', 'AC16311298885137', '9', '张asd', '北京市朝阳区酒仙路北路', '13888888888', '1011.00', '0', '0', '', '', '1513431129', '2017-12-16 21:32:09', '0');
INSERT INTO `shop_order` VALUES ('110', 'AC16312373031335', '9', '张asd', '北京市朝阳区酒仙路北路', '13888888888', '1011.00', '301', '0', '', '', '1513431237', '2017-12-16 21:34:06', '0');
INSERT INTO `shop_order` VALUES ('111', 'AC16317039111899', '9', '张asd', '北京市朝阳区酒仙路北路', '13888888888', '1011.00', '301', '0', '', '', '1513431703', '2017-12-16 21:41:49', '0');
INSERT INTO `shop_order` VALUES ('112', 'AC16318046337999', '9', '张asd', '北京市朝阳区酒仙路北路', '13888888888', '1011.00', '202', '0', '', '2017121621001004870200187430', '1513431804', '2017-12-16 22:04:22', '0');
INSERT INTO `shop_order` VALUES ('113', 'AC16320436339513', '9', '张asd', '北京市朝阳区酒仙路北路', '13888888888', '1011.00', '301', '0', '', '', '1513432043', '2017-12-16 21:57:19', '1');
INSERT INTO `shop_order` VALUES ('114', 'AC16321543876809', '9', '张asd', '北京市朝阳区酒仙路北路', '13888888888', '1011.00', '301', '0', '', '', '1513432154', '2017-12-16 21:57:16', '1');
INSERT INTO `shop_order` VALUES ('115', 'AC19705952185029', '1', '赵四', '芗城区例如：酒仙桥北路', '13888888888', '3511.00', '0', '0', '', '', '1513670595', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('116', 'AC20528930793742', '1', '1231231231231', '12312312123213123', '13888888888', '7782.00', '202', '0', '', '2017122021001004870200188753', '1513752893', '2018-06-25 01:29:18', '0');
INSERT INTO `shop_order` VALUES ('117', 'B114238922070604', '9', '张asd', '北京市朝阳区酒仙路北路', '13888888888', '2480.00', '202', '0', '', '2018011421001004870200199114', '1515923892', '2018-01-14 17:58:58', '0');
INSERT INTO `shop_order` VALUES ('118', 'B114268199275191', '9', '张asd', '北京市朝阳区酒仙路北路', '13888888888', '82.00', '0', '0', '', '', '1515926819', '2018-01-14 18:46:59', '0');
INSERT INTO `shop_order` VALUES ('119', 'B114271696433478', '9', '张asd', '北京市朝阳区酒仙路北路', '13888888888', '82.00', '101', '0', '', '', '1515927169', '2018-01-14 18:52:59', '0');
INSERT INTO `shop_order` VALUES ('120', 'B114272594705308', '9', '张asd', '北京市朝阳区酒仙路北路', '13888888888', '140.00', '101', '0', '', '', '1515927259', '2018-01-14 18:54:29', '0');
INSERT INTO `shop_order` VALUES ('121', 'B114274308723608', '9', '张asd', '北京市朝阳区酒仙路北路', '13888888888', '140.00', '101', '0', '', '', '1515927430', '2018-01-14 19:27:11', '0');
INSERT INTO `shop_order` VALUES ('122', 'B115957085844652', '9', '张asd', '北京市朝阳区酒仙路北路', '13888888888', '652.00', '202', '0', '', '2018011521001004870200199304', '1515995708', '2018-01-15 13:55:44', '0');
INSERT INTO `shop_order` VALUES ('123', 'B115022521849597', '9', '张asd', '北京市朝阳区酒仙路北路', '13888888888', '8395.00', '220', '0', '3912885937071', '2018011521001004870200199141', '1516002252', '2018-01-15 15:47:46', '0');

-- ----------------------------
-- Table structure for shop_order_detail
-- ----------------------------
DROP TABLE IF EXISTS `shop_order_detail`;
CREATE TABLE `shop_order_detail` (
  `detailid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `productid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL DEFAULT '',
  `cover` varchar(200) NOT NULL DEFAULT '',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `productnum` int(10) unsigned NOT NULL DEFAULT '0',
  `orderid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`detailid`),
  KEY `shop_order_detail_productid` (`productid`),
  KEY `shop_order_detail_orderid` (`orderid`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_order_detail
-- ----------------------------
INSERT INTO `shop_order_detail` VALUES ('1', '14', '一加5', 'shopyiip.guaosi.com.cn/599cef03ef7c0', '999.00', '7', '1', '1503590259');
INSERT INTO `shop_order_detail` VALUES ('3', '16', '华为p10plus', 'shopyiip.guaosi.com.cn/599cefbf06202', '1000.00', '3', '14', '1503591667');
INSERT INTO `shop_order_detail` VALUES ('4', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '4', '15', '1503591789');
INSERT INTO `shop_order_detail` VALUES ('5', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '4', '16', '1503591904');
INSERT INTO `shop_order_detail` VALUES ('10', '16', '华为p10plus', 'shopyiip.guaosi.com.cn/599cefbf06202', '1000.00', '2', '19', '1503591994');
INSERT INTO `shop_order_detail` VALUES ('11', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '4', '19', '1503591994');
INSERT INTO `shop_order_detail` VALUES ('12', '16', '华为p10plus', 'shopyiip.guaosi.com.cn/599cefbf06202', '1000.00', '2', '20', '1503592019');
INSERT INTO `shop_order_detail` VALUES ('13', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '4', '20', '1503592019');
INSERT INTO `shop_order_detail` VALUES ('14', '14', '一加5', 'shopyiip.guaosi.com.cn/599cef03ef7c0', '999.00', '5', '21', '1503592107');
INSERT INTO `shop_order_detail` VALUES ('15', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '5', '22', '1503592189');
INSERT INTO `shop_order_detail` VALUES ('16', '15', 'vivo-x9s', 'shopyiip.guaosi.com.cn/599cef5f79884', '1000.00', '3', '22', '1503592189');
INSERT INTO `shop_order_detail` VALUES ('18', '16', '华为p10plus', 'shopyiip.guaosi.com.cn/599cefbf06202', '1000.00', '1', '24', '1503649628');
INSERT INTO `shop_order_detail` VALUES ('19', '16', '华为p10plus', 'shopyiip.guaosi.com.cn/599cefbf06202', '1000.00', '1', '25', '1503650270');
INSERT INTO `shop_order_detail` VALUES ('20', '16', '华为p10plus', 'shopyiip.guaosi.com.cn/599cefbf06202', '1000.00', '3', '26', '1503653617');
INSERT INTO `shop_order_detail` VALUES ('21', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '26', '1503653617');
INSERT INTO `shop_order_detail` VALUES ('22', '15', 'vivo-x9s', 'shopyiip.guaosi.com.cn/599cef5f79884', '1000.00', '3', '26', '1503653618');
INSERT INTO `shop_order_detail` VALUES ('23', '14', '一加5', 'shopyiip.guaosi.com.cn/599cef03ef7c0', '999.00', '6', '26', '1503653618');
INSERT INTO `shop_order_detail` VALUES ('24', '15', 'vivo-x9s', 'shopyiip.guaosi.com.cn/599cef5f79884', '1000.00', '3', '27', '1503657395');
INSERT INTO `shop_order_detail` VALUES ('25', '14', '一加5', 'shopyiip.guaosi.com.cn/599cef03ef7c0', '999.00', '3', '27', '1503657395');
INSERT INTO `shop_order_detail` VALUES ('26', '15', 'vivo-x9s', 'shopyiip.guaosi.com.cn/599cef5f79884', '1000.00', '1', '28', '1503658418');
INSERT INTO `shop_order_detail` VALUES ('27', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '1', '29', '1503669099');
INSERT INTO `shop_order_detail` VALUES ('30', '17', '三星盖乐世S8|S8+', 'shopyiip.guaosi.com.cn/599d3636149dd', '5000.00', '1', '31', '1503729852');
INSERT INTO `shop_order_detail` VALUES ('31', '16', '华为p10plus', 'shopyiip.guaosi.com.cn/599cefbf06202', '1000.00', '1', '32', '1504150972');
INSERT INTO `shop_order_detail` VALUES ('32', '22', '测试一下是', 'shopyiip.guaosi.com.cn/59aeab0aebe4c', '666.00', '2', '33', '1504627610');
INSERT INTO `shop_order_detail` VALUES ('33', '22', '测试一下是', 'shopyiip.guaosi.com.cn/59aeab0aebe4c', '666.00', '1', '34', '1504627688');
INSERT INTO `shop_order_detail` VALUES ('35', '22', '测试一下是', 'shopyiip.guaosi.com.cn/59aeab0aebe4c', '666.00', '1', '36', '1504630213');
INSERT INTO `shop_order_detail` VALUES ('36', '22', '测试一下是', 'shopyiip.guaosi.com.cn/59aeab0aebe4c', '666.00', '1', '37', '1504630284');
INSERT INTO `shop_order_detail` VALUES ('37', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '2', '38', '1504630394');
INSERT INTO `shop_order_detail` VALUES ('38', '21', '测试一下', 'shopyiip.guaosi.com.cn/59aeaa9828eca', '666.00', '1', '38', '1504630394');
INSERT INTO `shop_order_detail` VALUES ('39', '22', '测试一下是', 'shopyiip.guaosi.com.cn/59aeab0aebe4c', '666.00', '3', '38', '1504630394');
INSERT INTO `shop_order_detail` VALUES ('40', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '39', '1504665525');
INSERT INTO `shop_order_detail` VALUES ('41', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '2', '40', '1504667738');
INSERT INTO `shop_order_detail` VALUES ('42', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '2', '41', '1504668138');
INSERT INTO `shop_order_detail` VALUES ('43', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '2', '42', '1504668366');
INSERT INTO `shop_order_detail` VALUES ('44', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '43', '1504668635');
INSERT INTO `shop_order_detail` VALUES ('45', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '44', '1504668907');
INSERT INTO `shop_order_detail` VALUES ('46', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '45', '1504669218');
INSERT INTO `shop_order_detail` VALUES ('47', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '46', '1504669438');
INSERT INTO `shop_order_detail` VALUES ('48', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '47', '1504669588');
INSERT INTO `shop_order_detail` VALUES ('49', '22', '测试一下是', 'shopyiip.guaosi.com.cn/59aeab0aebe4c', '666.00', '1', '48', '1504701465');
INSERT INTO `shop_order_detail` VALUES ('50', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '1', '49', '1504705580');
INSERT INTO `shop_order_detail` VALUES ('51', '23', '测试一下是3', 'shopyiip.guaosi.com.cn/59aeab69ddbeb', '666.00', '1', '50', '1504705752');
INSERT INTO `shop_order_detail` VALUES ('52', '23', '测试一下是3', 'shopyiip.guaosi.com.cn/59aeab69ddbeb', '666.00', '1', '51', '1504705877');
INSERT INTO `shop_order_detail` VALUES ('53', '23', '测试一下是3', 'shopyiip.guaosi.com.cn/59aeab69ddbeb', '666.00', '3', '52', '1504706213');
INSERT INTO `shop_order_detail` VALUES ('54', '22', '测试一下是', 'shopyiip.guaosi.com.cn/59aeab0aebe4c', '666.00', '1', '53', '1504706572');
INSERT INTO `shop_order_detail` VALUES ('55', '22', '测试一下是', 'shopyiip.guaosi.com.cn/59aeab0aebe4c', '666.00', '1', '54', '1504706642');
INSERT INTO `shop_order_detail` VALUES ('57', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '56', '1505117810');
INSERT INTO `shop_order_detail` VALUES ('60', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '6', '59', '1505119240');
INSERT INTO `shop_order_detail` VALUES ('62', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '1', '61', '1505122219');
INSERT INTO `shop_order_detail` VALUES ('63', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '1', '62', '1505122419');
INSERT INTO `shop_order_detail` VALUES ('64', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '1', '63', '1505122499');
INSERT INTO `shop_order_detail` VALUES ('65', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '1', '64', '1505122546');
INSERT INTO `shop_order_detail` VALUES ('66', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '1', '65', '1505122615');
INSERT INTO `shop_order_detail` VALUES ('67', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '2', '66', '1505122683');
INSERT INTO `shop_order_detail` VALUES ('68', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '4', '67', '1505140476');
INSERT INTO `shop_order_detail` VALUES ('69', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '68', '1505141113');
INSERT INTO `shop_order_detail` VALUES ('70', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '69', '1505141285');
INSERT INTO `shop_order_detail` VALUES ('71', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '70', '1505141323');
INSERT INTO `shop_order_detail` VALUES ('72', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '71', '1505141524');
INSERT INTO `shop_order_detail` VALUES ('73', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '72', '1505141624');
INSERT INTO `shop_order_detail` VALUES ('74', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '73', '1505141663');
INSERT INTO `shop_order_detail` VALUES ('75', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '74', '1505141712');
INSERT INTO `shop_order_detail` VALUES ('76', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '75', '1505142064');
INSERT INTO `shop_order_detail` VALUES ('77', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '76', '1505142168');
INSERT INTO `shop_order_detail` VALUES ('78', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '77', '1505142535');
INSERT INTO `shop_order_detail` VALUES ('79', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '78', '1505142572');
INSERT INTO `shop_order_detail` VALUES ('80', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '6', '79', '1505142825');
INSERT INTO `shop_order_detail` VALUES ('81', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '2', '80', '1505142903');
INSERT INTO `shop_order_detail` VALUES ('82', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '81', '1505143074');
INSERT INTO `shop_order_detail` VALUES ('83', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '82', '1505143245');
INSERT INTO `shop_order_detail` VALUES ('84', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '5', '83', '1505143540');
INSERT INTO `shop_order_detail` VALUES ('85', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '84', '1505143750');
INSERT INTO `shop_order_detail` VALUES ('86', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '85', '1505143857');
INSERT INTO `shop_order_detail` VALUES ('87', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '86', '1505143922');
INSERT INTO `shop_order_detail` VALUES ('88', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '4', '87', '1505144006');
INSERT INTO `shop_order_detail` VALUES ('89', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '88', '1505144097');
INSERT INTO `shop_order_detail` VALUES ('90', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '1', '89', '1505144249');
INSERT INTO `shop_order_detail` VALUES ('91', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '90', '1505144871');
INSERT INTO `shop_order_detail` VALUES ('92', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '1', '91', '1505145107');
INSERT INTO `shop_order_detail` VALUES ('93', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '92', '1505145412');
INSERT INTO `shop_order_detail` VALUES ('94', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '2', '93', '1505288359');
INSERT INTO `shop_order_detail` VALUES ('95', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '2', '94', '1505288495');
INSERT INTO `shop_order_detail` VALUES ('96', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '95', '1505288672');
INSERT INTO `shop_order_detail` VALUES ('97', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '96', '1505290131');
INSERT INTO `shop_order_detail` VALUES ('98', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '97', '1505290187');
INSERT INTO `shop_order_detail` VALUES ('99', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '3', '98', '1505290356');
INSERT INTO `shop_order_detail` VALUES ('100', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '4', '99', '1505290613');
INSERT INTO `shop_order_detail` VALUES ('101', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '2', '100', '1505290944');
INSERT INTO `shop_order_detail` VALUES ('102', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '2', '101', '1505291911');
INSERT INTO `shop_order_detail` VALUES ('103', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '2', '102', '1505292307');
INSERT INTO `shop_order_detail` VALUES ('104', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '2', '103', '1505292610');
INSERT INTO `shop_order_detail` VALUES ('105', '20', '金立S10', 'shopyiip.guaosi.com.cn/599d38db37559', '1699.56', '2', '104', '1505292662');
INSERT INTO `shop_order_detail` VALUES ('106', '16', '华为p10plus', 'shopyiip.guaosi.com.cn/599cefbf06202', '1000.00', '1', '105', '1512892924');
INSERT INTO `shop_order_detail` VALUES ('107', '22', '测试一下是', 'shopyiip.guaosi.com.cn/59aeab0aebe4c', '666.00', '1', '106', '1512893086');
INSERT INTO `shop_order_detail` VALUES ('108', '38', '小米mix', 'shopyiip.guaosi.com.cn/5a34f102728f3', '999.00', '1', '107', '1513430140');
INSERT INTO `shop_order_detail` VALUES ('109', '38', '小米mix', 'shopyiip.guaosi.com.cn/5a34f102728f3', '999.00', '1', '108', '1513430360');
INSERT INTO `shop_order_detail` VALUES ('110', '38', '小米mix', 'shopyiip.guaosi.com.cn/5a34f102728f3', '999.00', '1', '109', '1513431129');
INSERT INTO `shop_order_detail` VALUES ('111', '38', '小米mix', 'shopyiip.guaosi.com.cn/5a34f102728f3', '999.00', '1', '110', '1513431237');
INSERT INTO `shop_order_detail` VALUES ('112', '38', '小米mix', 'shopyiip.guaosi.com.cn/5a34f102728f3', '999.00', '1', '111', '1513431703');
INSERT INTO `shop_order_detail` VALUES ('113', '38', '小米mix', 'shopyiip.guaosi.com.cn/5a34f102728f3', '999.00', '1', '112', '1513431804');
INSERT INTO `shop_order_detail` VALUES ('114', '38', '小米mix', 'shopyiip.guaosi.com.cn/5a34f102728f3', '999.00', '1', '113', '1513432043');
INSERT INTO `shop_order_detail` VALUES ('115', '38', '小米mix', 'shopyiip.guaosi.com.cn/5a34f102728f3', '999.00', '1', '114', '1513432154');
INSERT INTO `shop_order_detail` VALUES ('116', '24', '一加5T', 'shopyiip.guaosi.com.cn/5a32772e79b6d', '3499.00', '1', '115', '1513670595');
INSERT INTO `shop_order_detail` VALUES ('117', '12', 'iphone7', 'shopyiip.guaosi.com.cn/599cee4897231', '777.00', '10', '116', '1513752893');
INSERT INTO `shop_order_detail` VALUES ('118', '35', '厉害了我的哥', 'shopyiip.guaosi.com.cn/5a328237488e4', '1234.00', '2', '117', '1515923892');
INSERT INTO `shop_order_detail` VALUES ('119', '40', '森马长袖', 'shopyiip.guaosi.com.cn/5a5b2df294f84', '70.00', '1', '118', '1515926819');
INSERT INTO `shop_order_detail` VALUES ('120', '40', '森马长袖', 'shopyiip.guaosi.com.cn/5a5b2df294f84', '70.00', '1', '119', '1515927169');
INSERT INTO `shop_order_detail` VALUES ('121', '39', '森马毛衣', 'shopyiip.guaosi.com.cn/5a5b2d6eec772', '128.00', '1', '120', '1515927259');
INSERT INTO `shop_order_detail` VALUES ('122', '39', '森马毛衣', 'shopyiip.guaosi.com.cn/5a5b2d6eec772', '128.00', '1', '121', '1515927430');
INSERT INTO `shop_order_detail` VALUES ('123', '39', '森马毛衣', 'shopyiip.guaosi.com.cn/5a5b2d6eec772', '128.00', '5', '122', '1515995708');
INSERT INTO `shop_order_detail` VALUES ('124', '39', '森马毛衣', 'shopyiip.guaosi.com.cn/5a5b2d6eec772', '128.00', '3', '123', '1516002252');
INSERT INTO `shop_order_detail` VALUES ('125', '41', 'iPhone X', 'shopyiip.guaosi.com.cn/5a5b34c0201ab', '7999.00', '1', '123', '1516002252');

-- ----------------------------
-- Table structure for shop_product
-- ----------------------------
DROP TABLE IF EXISTS `shop_product`;
CREATE TABLE `shop_product` (
  `productid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cateid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `brandid` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL DEFAULT '',
  `descr` text,
  `num` int(10) unsigned NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cover` varchar(200) NOT NULL DEFAULT '',
  `pics` text,
  `issale` enum('0','1') NOT NULL DEFAULT '0',
  `ishot` enum('0','1') NOT NULL DEFAULT '0',
  `detail` text COMMENT '商品描述详情',
  `istui` enum('0','1') NOT NULL DEFAULT '0',
  `saleprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ison` enum('0','1') NOT NULL DEFAULT '1',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `is_delete` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`productid`),
  KEY `shop_product_cateid` (`cateid`),
  KEY `shop_product_ison` (`ison`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_product
-- ----------------------------
INSERT INTO `shop_product` VALUES ('9', '13', '1', '小米', '小米小米小米', '888', '999.00', 'shopyiip.guaosi.com.cn/599c3be0de6d9', '[\"shopyiip.guaosi.com.cn\\/599c3be22f0ac\",\"shopyiip.guaosi.com.cn\\/599c3be75edb6\",\"shopyiip.guaosi.com.cn\\/599d19bec1671\",\"shopyiip.guaosi.com.cn\\/599d19c02a7dd\"]', '1', '1', '', '1', '777.00', '1', '1503475550', '0', '0');
INSERT INTO `shop_product` VALUES ('10', '13', '1', '魅族', '魅族魅族魅族魅族魅族魅族', '878', '999.00', 'shopyiip.guaosi.com.cn/599cebdc9e7f4', '[\"shopyiip.guaosi.com.cn\\/599cebe0e6cf6\",\"shopyiip.guaosi.com.cn\\/599cebfcad349\"]', '1', '1', '', '1', '777.00', '0', '1503475551', '0', '0');
INSERT INTO `shop_product` VALUES ('11', '13', '1', 'OPPO', 'OPPOOPPOOPPOOPPOOPPOOPPOOPPO', '888', '9999.00', 'shopyiip.guaosi.com.cn/599cec1fb14f3', '[\"shopyiip.guaosi.com.cn\\/599cec21e3aa8\",\"shopyiip.guaosi.com.cn\\/599cec22afa60\",\"shopyiip.guaosi.com.cn\\/599cec230dd46\"]', '1', '1', '', '1', '7777.00', '1', '1503475552', '0', '0');
INSERT INTO `shop_product` VALUES ('12', '13', '1', 'iphone7', 'iphone7iphone7iphone7iphone7', '8878', '9999.00', 'shopyiip.guaosi.com.cn/599cee4897231', '[\"shopyiip.guaosi.com.cn\\/599cee48a444e\",\"shopyiip.guaosi.com.cn\\/599cee496be86\"]', '1', '1', '', '1', '777.00', '1', '1503475553', '0', '1513752893');
INSERT INTO `shop_product` VALUES ('13', '13', '1', '荣耀v9', '荣耀v9荣耀v9荣耀v9荣耀v9荣耀v9荣耀v9', '1000', '1200.00', 'shopyiip.guaosi.com.cn/599ceecd5737c', '[\"shopyiip.guaosi.com.cn\\/599ceed31cace\",\"shopyiip.guaosi.com.cn\\/599ceed439981\",\"shopyiip.guaosi.com.cn\\/599ceed821558\"]', '1', '1', '', '1', '999.00', '1', '1503475554', '0', '0');
INSERT INTO `shop_product` VALUES ('14', '13', '1', '一加5', '一加5一加5一加5一加5一加5', '844', '1200.00', 'shopyiip.guaosi.com.cn/599cef03ef7c0', '[\"shopyiip.guaosi.com.cn\\/599cef0407777\",\"shopyiip.guaosi.com.cn\\/599cef0419a18\"]', '1', '1', '', '1', '999.00', '1', '1503475555', '0', '0');
INSERT INTO `shop_product` VALUES ('15', '13', '1', 'vivo-x9s', 'vivo-x9svivo-x9svivo-x9svivo-x9s', '949', '1200.00', 'shopyiip.guaosi.com.cn/599cef5f79884', '[\"shopyiip.guaosi.com.cn\\/599cef5f94426\",\"shopyiip.guaosi.com.cn\\/599cef6399eb1\",\"shopyiip.guaosi.com.cn\\/599cef682d75a\"]', '1', '1', '', '1', '1000.00', '1', '1503475556', '0', '0');
INSERT INTO `shop_product` VALUES ('16', '13', '1', '华为p10plus', '华为p10plus华为p10plus华为p10plus华为p10plus华为p10plus华为p10plus', '908', '1200.00', 'shopyiip.guaosi.com.cn/599cefbf06202', '[\"shopyiip.guaosi.com.cn\\/599cefbf1e1e7\",\"shopyiip.guaosi.com.cn\\/599cefbfd9c35\"]', '1', '1', '', '1', '1000.00', '1', '1503475557', '0', '1513430236');
INSERT INTO `shop_product` VALUES ('17', '13', '1', '三星盖乐世S8|S8+', '三星盖乐世S8|S8+三星盖乐世S8|S8+三星盖乐世S8|S8+三星盖乐世S8|S8+三星盖乐世S8|S8+三星盖乐世S8|S8+三星盖乐世S8|S8+三星盖乐世S8|S8+三星盖乐世S8|S8+三星盖乐世S8|S8+三星盖乐世S8|S8+三星盖乐世S8|S8+三星盖乐世S8|S8+三星盖乐世S8|S8+', '995', '5000.00', 'shopyiip.guaosi.com.cn/599d3636149dd', '[\"shopyiip.guaosi.com.cn\\/599d3636f110a\",\"shopyiip.guaosi.com.cn\\/599d3637077fd\",\"shopyiip.guaosi.com.cn\\/599d363749751\",\"shopyiip.guaosi.com.cn\\/599d363a0bfbb\"]', '1', '1', '', '0', '4000.00', '1', '1503475558', '0', '0');
INSERT INTO `shop_product` VALUES ('18', '13', '1', 'vivo Xplay6', '<h1>vivo Xplay6vivo Xplay6vivo Xplay6vivo Xplay6vivo Xplay6vivo Xplay6vivo Xplay6vivo Xplay6vivo Xplay6vivo Xplay6vivo Xplay6vivo Xplay6</h1>', '1000', '5000.00', 'shopyiip.guaosi.com.cn/599d371f30900', '[\"shopyiip.guaosi.com.cn\\/599d371f39bb0\",\"shopyiip.guaosi.com.cn\\/599d37217f2d1\",\"shopyiip.guaosi.com.cn\\/599d3722492de\",\"shopyiip.guaosi.com.cn\\/599d372af1ead\",\"shopyiip.guaosi.com.cn\\/599d372b79e30\",\"shopyiip.guaosi.com.cn\\/599d372c43be6\",\"shopyiip.guaosi.com.cn\\/599d372d648af\"]', '1', '1', '', '0', '4000.00', '1', '1503476700', '0', '0');
INSERT INTO `shop_product` VALUES ('19', '13', '1', 'OPPO R11 Plus', '<h1>OPPO R11 PlusOPPO R11 PlusOPPO R11 PlusOPPO R11 PlusOPPO R11 PlusOPPO R11 Plus<b><i></i></b><i>OPPO R11 PlusOPPO R11 PlusOPPO R11 Plus</i></h1>', '1000', '5000.00', 'shopyiip.guaosi.com.cn/599d376ac04bc', '[\"shopyiip.guaosi.com.cn\\/599d376ae5580\",\"shopyiip.guaosi.com.cn\\/599d376b07cc9\"]', '0', '1', '', '0', '4000.00', '1', '1503475563', '0', '0');
INSERT INTO `shop_product` VALUES ('20', '13', '1', '金立S10', '<h1><ul><li>金立S10金立S10金立S10金立S10金立S10金立S10金立S10金立S10金立S10金立S10金立S10</li><li></li></ul></h1><h1>金立S10</h1>', '13', '3000.00', 'shopyiip.guaosi.com.cn/599d38db37559', '[\"shopyiip.guaosi.com.cn\\/599d38e2034b7\",\"shopyiip.guaosi.com.cn\\/599d38e6b990b\",\"shopyiip.guaosi.com.cn\\/599d38eb3d282\",\"shopyiip.guaosi.com.cn\\/599d38f07bbd5\"]', '1', '0', '', '1', '1699.56', '1', '1505144259', '0', '1505294410');
INSERT INTO `shop_product` VALUES ('21', '1', '1', '测试一下', '测试一下测试一下', '888', '999.00', 'shopyiip.guaosi.com.cn/59aeaa9828eca', '[]', '1', '0', '', '1', '666.00', '1', '1504619160', '0', '1504619160');
INSERT INTO `shop_product` VALUES ('22', '1', '1', '测试一下是', '测试一下测试一下', '876', '999.00', 'shopyiip.guaosi.com.cn/59aeab0aebe4c', '[]', '1', '0', '', '1', '666.00', '1', '1504619275', '0', '1512893106');
INSERT INTO `shop_product` VALUES ('23', '13', '1', '游戏', '这只是一个游戏', '888', '999.00', 'shopyiip.guaosi.com.cn/5a2cd5738d4d6', '[\"shopyiip.guaosi.com.cn\\/5a2cd573c6d7a\",\"shopyiip.guaosi.com.cn\\/5a2cd573d48d5\"]', '1', '1', '<p>不错不错可以看看</p><p style=\"text-align:center\"><img src=\"http://shopyiip.guaosi.com.cn/uploads/1210/15128869960006004.jpg\" alt=\"15128869960006004.jpg\" width=\"331\" height=\"413\" title=\"15128869960006004.jpg\"/></p><p><br/></p>', '1', '777.00', '1', '1512887668', '0', '1512888357');
INSERT INTO `shop_product` VALUES ('24', '13', '3', '一加5T', '一加5T一加5T', '199', '3499.00', 'shopyiip.guaosi.com.cn/5a32772e79b6d', '[\"shopyiip.guaosi.com.cn\\/5a32772e8b7bd\"]', '0', '1', '<p><span style=\"text-decoration: underline;\"><strong>一加5T一加5T一加5T一加5T一加5T</strong></span></p><p><span style=\"text-decoration: underline;\"><strong><img src=\"http://shopyiip.guaosi.com.cn/uploads/1214/15132567400004e6f.jpg\"/></strong></span></p>', '1', '3229.00', '1', '1513256751', '0', '1513670595');
INSERT INTO `shop_product` VALUES ('25', '13', '3', '一加5T', '一加5T一加5T', '200', '3499.00', 'shopyiip.guaosi.com.cn/5a32772e79b6d', '[\"shopyiip.guaosi.com.cn\\/5a32772e8b7bd\"]', '0', '1', '<p><span style=\"text-decoration: underline;\"><strong>一加5T一加5T一加5T一加5T一加5T</strong></span></p><p><span style=\"text-decoration: underline;\"><strong><img src=\"http://shopyiip.guaosi.com.cn/uploads/1214/15132567400004e6f.jpg\"/></strong></span></p>', '1', '3229.00', '1', '1513256751', '0', '1513256751');
INSERT INTO `shop_product` VALUES ('26', '13', '3', '一加5T', '一加5T一加5T', '200', '3499.00', 'shopyiip.guaosi.com.cn/5a32772e79b6d', '[\"shopyiip.guaosi.com.cn\\/5a32772e8b7bd\"]', '0', '1', '<p><span style=\"text-decoration: underline;\"><strong>一加5T一加5T一加5T一加5T一加5T</strong></span></p><p><span style=\"text-decoration: underline;\"><strong><img src=\"http://shopyiip.guaosi.com.cn/uploads/1214/15132567400004e6f.jpg\"/></strong></span></p>', '1', '3229.00', '1', '1513256751', '0', '1513256751');
INSERT INTO `shop_product` VALUES ('27', '13', '3', '一加5T', '一加5T一加5T', '200', '3499.00', 'shopyiip.guaosi.com.cn/5a32772e79b6d', '[\"shopyiip.guaosi.com.cn\\/5a32772e8b7bd\"]', '0', '1', '<p><span style=\"text-decoration: underline;\"><strong>一加5T一加5T一加5T一加5T一加5T</strong></span></p><p><span style=\"text-decoration: underline;\"><strong><img src=\"http://shopyiip.guaosi.com.cn/uploads/1214/15132567400004e6f.jpg\"/></strong></span></p>', '1', '3229.00', '1', '1513256751', '0', '1515926658');
INSERT INTO `shop_product` VALUES ('28', '13', '3', '一加5T', '一加5T一加5T', '200', '3499.00', 'shopyiip.guaosi.com.cn/5a32772e79b6d', '[\"shopyiip.guaosi.com.cn\\/5a32772e8b7bd\"]', '0', '1', '<p><span style=\"text-decoration: underline;\"><strong>一加5T一加5T一加5T一加5T一加5T</strong></span></p><p><span style=\"text-decoration: underline;\"><strong><img src=\"http://shopyiip.guaosi.com.cn/uploads/1214/15132567400004e6f.jpg\"/></strong></span></p>', '1', '3229.00', '1', '1513256751', '0', '1513256751');
INSERT INTO `shop_product` VALUES ('29', '13', '3', '一加5T', '一加5T一加5T', '200', '3499.00', 'shopyiip.guaosi.com.cn/5a32772e79b6d', '[\"shopyiip.guaosi.com.cn\\/5a32772e8b7bd\"]', '0', '1', '<p><span style=\"text-decoration: underline;\"><strong>一加5T一加5T一加5T一加5T一加5T</strong></span></p><p><span style=\"text-decoration: underline;\"><strong><img src=\"http://shopyiip.guaosi.com.cn/uploads/1214/15132567400004e6f.jpg\"/></strong></span></p>', '1', '3229.00', '1', '1513256751', '0', '1513256751');
INSERT INTO `shop_product` VALUES ('30', '13', '3', '一加5T', '一加5T一加5T', '200', '3499.00', 'shopyiip.guaosi.com.cn/5a32772e79b6d', '[\"shopyiip.guaosi.com.cn\\/5a32772e8b7bd\"]', '0', '1', '<p><span style=\"text-decoration: underline;\"><strong>一加5T一加5T一加5T一加5T一加5T</strong></span></p><p><span style=\"text-decoration: underline;\"><strong><img src=\"http://shopyiip.guaosi.com.cn/uploads/1214/15132567400004e6f.jpg\"/></strong></span></p>', '1', '3229.00', '1', '1513256751', '0', '1513256751');
INSERT INTO `shop_product` VALUES ('31', '13', '3', '一加5T', '一加5T一加5T', '200', '3499.00', 'shopyiip.guaosi.com.cn/5a32772e79b6d', '[\"shopyiip.guaosi.com.cn\\/5a32772e8b7bd\"]', '0', '1', '<p><span style=\"text-decoration: underline;\"><strong>一加5T一加5T一加5T一加5T一加5T</strong></span></p><p><span style=\"text-decoration: underline;\"><strong><img src=\"http://shopyiip.guaosi.com.cn/uploads/1214/15132567400004e6f.jpg\"/></strong></span></p>', '1', '3229.00', '1', '1513256751', '0', '1513256751');
INSERT INTO `shop_product` VALUES ('32', '13', '3', '一加5T', '一加5T一加5T', '200', '3499.00', 'shopyiip.guaosi.com.cn/5a32772e79b6d', '[\"shopyiip.guaosi.com.cn\\/5a32772e8b7bd\"]', '0', '1', '<p><span style=\"text-decoration: underline;\"><strong>一加5T一加5T一加5T一加5T一加5T</strong></span></p><p><span style=\"text-decoration: underline;\"><strong><img src=\"http://shopyiip.guaosi.com.cn/uploads/1214/15132567400004e6f.jpg\"/></strong></span></p>', '1', '3229.00', '1', '1513256751', '0', '1513256751');
INSERT INTO `shop_product` VALUES ('34', '1', '2', '里厉害123', '里厉害123', '12', '123.00', 'shopyiip.guaosi.com.cn/5a3281df8205a', '[]', '1', '0', null, '0', '100.00', '1', '1513259487', '0', '1513261322');
INSERT INTO `shop_product` VALUES ('35', '1', '1', '厉害了我的哥', '厉害了我的哥', '121', '1234.00', 'shopyiip.guaosi.com.cn/5a328237488e4', '[]', '0', '0', null, '0', '1213.00', '1', '1513259577', '0', '1515923892');
INSERT INTO `shop_product` VALUES ('37', '1', '1', '魔力', '魔力魔力', '12', '103.00', 'shopyiip.guaosi.com.cn/5a32891b2f798', '[]', '0', '0', null, '0', '12.00', '1', '1513261339', '0', '1515994312');
INSERT INTO `shop_product` VALUES ('38', '13', '1', '小米mix', '小米mix小米mix', '54', '1000.00', 'shopyiip.guaosi.com.cn/5a34f102728f3', '[\"shopyiip.guaosi.com.cn\\/5a34f10448601\",\"shopyiip.guaosi.com.cn\\/5a34f1093568e\",\"shopyiip.guaosi.com.cn\\/5a34f10b5318e\"]', '1', '0', '<p>小米mix小米mix</p><p><img src=\"http://shopyiip.guaosi.com.cn/uploads/1216/1513418993000f40b.jpg\" alt=\"1513418993000f40b.jpg\"/></p>', '1', '999.00', '1', '1513419023', '0', '1513432162');
INSERT INTO `shop_product` VALUES ('39', '3', '6', '森马毛衣', '森马毛衣森马毛衣森马毛衣森马毛衣', '880', '128.00', 'shopyiip.guaosi.com.cn/5a5b2d6eec772', '[\"shopyiip.guaosi.com.cn\\/5a5b2d6f0485b\",\"shopyiip.guaosi.com.cn\\/5a5b2d6f0e083\",\"shopyiip.guaosi.com.cn\\/5a5b2d6f5e0bd\"]', '0', '1', '<p>森马毛衣</p><p>质量不错</p><p><img src=\"http://shopyiip.guaosi.com.cn/uploads/0114/15159248340007a1c.jpg\"/></p><p><img src=\"http://shopyiip.guaosi.com.cn/uploads/0114/15159248340009bae.jpg\"/></p><p><img src=\"http://shopyiip.guaosi.com.cn/uploads/0114/1515924834000c6d7.jpg\"/></p><p><br/></p>', '1', '0.01', '1', '1515924847', '0', '1516002252');
INSERT INTO `shop_product` VALUES ('40', '6', '6', '森马长袖', '森马长袖森马长袖森马长袖森马长袖', '887', '80.00', 'shopyiip.guaosi.com.cn/5a5b2df294f84', '[\"shopyiip.guaosi.com.cn\\/5a5b2df2da1ff\",\"shopyiip.guaosi.com.cn\\/5a5b2df6483a9\"]', '1', '1', '<p><strong>森马长袖森马长袖森马长袖森马长袖</strong></p><p></p><p><img src=\"http://shopyiip.guaosi.com.cn/uploads/0114/1515924965000e12c.jpg\"/></p><p><img src=\"http://shopyiip.guaosi.com.cn/uploads/0114/1515924965000b4df.jpg\"/></p><p><img src=\"http://shopyiip.guaosi.com.cn/uploads/0114/1515924965000bf69.jpg\"/></p><p><strong><br/></strong><br/></p>', '1', '70.00', '1', '1515924984', '0', '1515927179');
INSERT INTO `shop_product` VALUES ('41', '13', '1', 'iPhone X', 'iPhone X\r\niPhone X\r\n', '99', '8099.00', 'shopyiip.guaosi.com.cn/5a5b34c0201ab', '[\"shopyiip.guaosi.com.cn\\/5a5b34c0297e9\",\"shopyiip.guaosi.com.cn\\/5a5b34c03ceb8\"]', '1', '1', '<p>iPhone X</p><p>iPhone X</p><p>viPhone X</p><p>iPhone X</p><p>iPhone X</p><p><img src=\"http://shopyiip.guaosi.com.cn/uploads/0114/15159267120007dd7.jpg\"/></p><p><img src=\"http://shopyiip.guaosi.com.cn/uploads/0114/15159267120007786.jpg\"/></p><p><img src=\"http://shopyiip.guaosi.com.cn/uploads/0114/1515926712000d1ca.jpg\"/></p><p><br/></p>', '1', '7999.00', '1', '1515926720', '0', '1516002252');

-- ----------------------------
-- Table structure for shop_user
-- ----------------------------
DROP TABLE IF EXISTS `shop_user`;
CREATE TABLE `shop_user` (
  `userid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `username` varchar(32) NOT NULL DEFAULT '',
  `userpass` char(64) NOT NULL DEFAULT '',
  `useremail` varchar(100) NOT NULL DEFAULT '',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `qqopenid` char(32) NOT NULL DEFAULT '',
  `lasttime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后一次登录时间',
  `lastip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '最后一次登录ip',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `shop_user_username_userpass` (`username`,`userpass`),
  UNIQUE KEY `shop_user_useremail_userpass` (`useremail`,`userpass`),
  KEY `shop_user_qqopenid` (`qqopenid`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_user
-- ----------------------------
INSERT INTO `shop_user` VALUES ('1', 'guaosi', '$2y$13$0xjckSmd7EY3Qc6N6EIZJ.ef6aBXL/O2tJLv2cWydk7Jk5LkxdCIq', 'guaosi@vip.qq.com', '1503232177', '', '1513733430', '1033541992');
INSERT INTO `shop_user` VALUES ('9', 'guaosi3', '$2y$13$0xjckSmd7EY3Qc6N6EIZJ.ef6aBXL/O2tJLv2cWydk7Jk5LkxdCIq', 'admin@guaosi.com', '1504619753', '', '1516002137', '2364764079');
