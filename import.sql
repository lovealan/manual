/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : 127.0.0.1:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2020-07-23 14:40:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for prefix_xielei_manual_manual
-- ----------------------------
DROP TABLE IF EXISTS `prefix_xielei_manual_manual`;
CREATE TABLE `prefix_xielei_manual_manual` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '节点ID',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `alias` varchar(255) NOT NULL DEFAULT '' COMMENT '目录',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '简介',
  `tpl_manual` varchar(255) NOT NULL DEFAULT '' COMMENT '模板',
  `tpl_post` varchar(255) NOT NULL DEFAULT '' COMMENT '内容页模板',
  `state` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否发布',
  `body` text,
  `cover` varchar(255) NOT NULL DEFAULT '' COMMENT '目录',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='内容栏目表';

-- ----------------------------
-- Records of prefix_xielei_manual_manual
-- ----------------------------

-- ----------------------------
-- Table structure for prefix_xielei_manual_post
-- ----------------------------
DROP TABLE IF EXISTS `prefix_xielei_manual_post`;
CREATE TABLE `prefix_xielei_manual_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '节点ID',
  `manual_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类id',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类id',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1 目录 2文档',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键词',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '摘要',
  `body` text,
  `alias` varchar(255) NOT NULL DEFAULT '' COMMENT '文件名称',
  `click` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击量',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '操作时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `state` tinyint(3) unsigned NOT NULL DEFAULT '99' COMMENT '状态',
  `rank` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击量',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `list` (`manual_id`,`state`) USING BTREE,
  FULLTEXT KEY `ft_index` (`title`,`keywords`,`description`,`body`) /*!50100 WITH PARSER `ngram` */ 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='内容基本表';

-- ----------------------------
-- Records of prefix_xielei_manual_post
-- ----------------------------
