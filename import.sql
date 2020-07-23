/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : 127.0.0.1:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2020-07-23 17:22:37
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='内容栏目表';

-- ----------------------------
-- Records of prefix_xielei_manual_manual
-- ----------------------------
INSERT INTO `prefix_xielei_manual_manual` VALUES ('1', 'ebcms/framework 手册', '', '', '', '', '', '1', 'ebcms/framework是新一代的PHP开发框架，遵守业界广泛认同的PSR标准规范，是您不错的选择。', '', '1595486640', '1595496051');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='内容基本表';

-- ----------------------------
-- Records of prefix_xielei_manual_post
-- ----------------------------
INSERT INTO `prefix_xielei_manual_post` VALUES ('1', '1', '0', '2', '系统流程', '', '', '系统流程极其简单，简约如下：\r\n\r\n1. 入口文件index.php\r\n2. 引入自定义文件bootstrap.php\r\n3. 执行钩子app.start\r\n4. 路由解析\r\n5. 执行钩子app.start@包\r\n6. 执行程序\r\n7. 执行钩子app.end@包\r\n8. 执行钩子app.end\r\n9. 结束', '', '0', '1595486686', '1595494699', '1', '5');
INSERT INTO `prefix_xielei_manual_post` VALUES ('2', '1', '0', '2', '钩子', '', '', '## 整个系统有且仅有四个钩子\r\n\r\n* app.start\r\n* app.start@包\r\n* app.end@包\r\n* app.end\r\n\r\napp.start：系统开始解析路由之前\r\n\r\napp.start@包：路由解析完成后，此时可以得到请求的包名、控制器名\r\n\r\napp.end@包：此时系统已经完成执行，可以得到响应\r\n\r\napp.end：同上，只是app.end@包 仅会在请求某个包的url下执行\r\n', '', '0', '1595486693', '1595494818', '1', '4');
INSERT INTO `prefix_xielei_manual_post` VALUES ('3', '1', '0', '2', '配置系统', '', '', '配置分类三块：\r\n\r\n**1.默认配置**\r\n\r\n默认配置是上述两项配置均没有的时候的默认值，由类\\Ebcms\\Config->get(\'key\',\'value\',\'默认值\')，固定在代码中\r\n\r\n**2.模块配置**\r\n\r\n模块配置有开发者事先配置，在对应包的config文件夹下面\r\n\r\n**3.用户配置**\r\n\r\n此配置位于系统的config文件夹下面，拥有最高的优先级\r\n\r\n优先级顺序是 默认配置<模块配置<用户配置\r\n', '', '0', '1595486703', '1595494922', '1', '3');
INSERT INTO `prefix_xielei_manual_post` VALUES ('4', '1', '0', '2', '中间件', '', '', '**中间件遵守标准的PSR规范！**\r\n\r\n中间件由\\Ebcms\\RequestHandler管理\r\n\r\n支持如下方法：\r\n\r\n* middleware(MiddlewareInterface $middleware) 注册一个中间件\r\n* middlewares(array $middlewares) 注册多个中间件\r\n* prependMiddleware(MiddlewareInterface $middleware) 注册一个中间件(前置)<br>\r\n* lazyMiddleware(string $middleware) 注册一个中间件(字符串形式、命名空间形式)<br>\r\n* lazyMiddlewares(array $middlewares) 注册多个中间件(字符串形式、命名空间形式)\r\n* lazyPrependMiddleware(string $middleware) 注册一个中间件(字符串形式、命名空间形式)(前置)<br>', '', '0', '1595486714', '1595495004', '1', '2');
INSERT INTO `prefix_xielei_manual_post` VALUES ('5', '1', '0', '2', '路由', '', '', '**路由类`\\Ebcms\\Router`**\r\n\r\n**总体有两点，注册路由和生成地址，下面分别说明。**\r\n\r\n**1.注册路由**\r\n\r\n方法如下：\r\n\r\n```\r\n$router->getCollector()->... \r\n$router->getCollector()->get(\'/index\', Index::class, \'第三个参数是路由别名\');\r\n```\r\n\r\n**get post put delete patch head等方法。**\r\n\r\n另外也支持路由分组，例如：\r\n\r\n```\r\n$router->getCollector()->addGroup(\'/sub\', function($route){\r\n	$route->get(\'/a\', ControlerA::class,\'suba\');\r\n	$route->get(\'/b\', ControllerB::class,\'subb\');\r\n	$route->addGroup(\'/sub2\', function($route){\r\n		$route->get(\'/cc\', ControllerC::class, \'subsub\');\r\n	});\r\n});\r\n```\r\n\r\n**2.生成地址**\r\n\r\n`$router->buildUrl(\'suba\')`就会生成`/sub/a`\r\n\r\n`$router->buildUrl(\'subb\')`就会生成`/sub/b`\r\n\r\n`$router->buildUrl(\'subsub\')`就会生成`/sub/sub2/cc`\r\n\r\n**3.路由执行**\r\n\r\n当访问`/sub/sub2/cc`的时候，就会执行`ControllerC`控制器。\r\n', '', '0', '1595486720', '1595495770', '1', '1');
INSERT INTO `prefix_xielei_manual_post` VALUES ('6', '1', '0', '2', '依赖注入', '', '', '**依赖注入来自开源项目[ebcms/psr11](https://github.com/ebcms/psr11)，欢迎PR ^-^.**\r\n\r\n**默认的，执行的控制器的构造方法`construct()`支持依赖注入，例如：**\r\n\r\n**通过容器获取的类支持依赖注入，例如：**\r\n\r\n```\r\n$container->get(Foo::class);\r\n```\r\n\r\n那么 此处的Foo类的构造函数就可以依赖注入\r\n\r\n**通过`App::getInstrance()->execute(function(...){})`支持依赖注入，例如：**\r\n\r\n```\r\nApp::getInstance()->execute(function (\r\n    App $app,\r\n    RequestHandler $requestHandler,\r\n    RequestFilter $input,\r\n    Router $router,\r\n    Config $config,\r\n    Template $template,\r\n    ....\r\n) {\r\n    $app->....\r\n});\r\n```\r\n', '', '0', '1595486816', '1595496051', '1', '0');
INSERT INTO `prefix_xielei_manual_post` VALUES ('7', '1', '0', '2', '文档说明', '', '', '本文档若无特别说明，均是省去了命名空间的类，例如：\r\n\r\nCacheInterface ResponseInterface...等待 代表的是 PSR规定的接口\r\n\r\nConfig Router...等等代表 \\Ebcms\\..下的类\r\n\r\n其他的以此类推，编辑器会自动提示。', '', '0', '1595488340', '1595494516', '1', '6');
