/*
Navicat MySQL Data Transfer

Source Server         : 192.168.1.111
Source Server Version : 50552
Source Host           : 192.168.1.111:3306
Source Database       : tp_mall

Target Server Type    : MYSQL
Target Server Version : 50552
File Encoding         : 65001

Date: 2019-04-03 16:38:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp_mall_admin
-- ----------------------------
DROP TABLE IF EXISTS `tp_mall_admin`;
CREATE TABLE `tp_mall_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uname` varchar(60) NOT NULL DEFAULT '',
  `uemail` varchar(60) NOT NULL DEFAULT '',
  `upwd` varchar(32) NOT NULL DEFAULT '',
  `uimg` varchar(255) NOT NULL,
  `usalt` varchar(255) NOT NULL,
  `last_login` int(11) NOT NULL DEFAULT '0',
  `last_ip` varchar(15) NOT NULL DEFAULT '',
  `nav_list` text NOT NULL,
  `add_time` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_name` (`uname`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_mall_admin
-- ----------------------------
INSERT INTO `tp_mall_admin` VALUES ('1', 'superadmin', 'zyddj123@163.com', 'e10adc3949ba59abbe56e057f20f883e', '', '29988429c481f219b8c5ba8c071440e1', '1537751566', '127.0.0.1', '商品列表|goods.php?act=list,订单列表|order.php?act=list,用户评论|comment_manage.php?act=list,会员列表|users.php?act=list,商店设置|shop_config.php?act=list_edit', '1514448117', '1');
