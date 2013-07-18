
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `pay_balance`
-- ----------------------------
DROP TABLE IF EXISTS `pay_balance`;
CREATE TABLE `pay_balance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(45) NOT NULL,
  `balance` decimal(9,2) unsigned NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `pay_shop`
-- ----------------------------
DROP TABLE IF EXISTS `pay_shop`;
CREATE TABLE `pay_shop` (
  `id` int(11) unsigned NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `pic` varchar(250) DEFAULT NULL,
  `item_name` varchar(50) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `price` float DEFAULT '0',
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_shop
-- ----------------------------
INSERT INTO `pay_shop` VALUES ('1', 'item', 'http://aidb.ru/uploads/item_icon/icon_item_sword_u01.png', 'Мечь', '', '12', '1');

-- ----------------------------
-- Table structure for `pay_transactions`
-- ----------------------------
DROP TABLE IF EXISTS `pay_transactions`;
CREATE TABLE `pay_transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(250) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `char_name` varchar(50) DEFAULT NULL,
  `item_type` varchar(50) DEFAULT NULL,
  `item_name` varchar(50) DEFAULT NULL,
  `count` smallint(5) unsigned DEFAULT NULL,
  `price_one` float(9,2) unsigned DEFAULT NULL,
  `price_final` float(9,2) unsigned DEFAULT NULL,
  `trans_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
