/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : 127.0.0.1:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2020-07-23 21:31:33
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
INSERT INTO `prefix_xielei_manual_manual` VALUES ('1', 'ebcms/framework 手册', 'ebcms', '', '', '', '', '1', '`ebcms/framework`是新一代的PHP开发框架，遵守业界广泛认同的**PSR标准规范**，是您不错的选择。', '/ebcms/public/uploads/2020/07-23/5f1959005b2d1.jpg', '1595486640', '1595511036');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='内容基本表';

-- ----------------------------
-- Records of prefix_xielei_manual_post
-- ----------------------------
INSERT INTO `prefix_xielei_manual_post` VALUES ('1', '1', '0', '2', '流程', '', '', '系统流程极其简单，简约如下：\r\n\r\n1. 入口文件`index.php`\r\n2. 载入文件`bootstrap.php`\r\n3. 执行钩子`app.start`\r\n4. 解析路由\r\n5. 执行钩子`app.start@包`\r\n6. 执行程序\r\n7. 执行钩子`app.end@包`\r\n8. 执行钩子`app.end`\r\n9. 结束\r\n\r\n`app.start`：系统开始解析路由之前\r\n\r\n`app.start@包`：路由解析完成后，此时可以得到请求的`包名`、`控制器名`\r\n\r\n`app.end@包`：此时系统已经完成执行，可以得到`响应`\r\n\r\n`app.end`：同上，只是`app.end@包`仅会在请求某个包的url下执行\r\n\r\n**特别说明**\r\n\r\n若配置路由直接路由到闭包的时候，则不会执行相关包的钩子（即无5和7），因为没有经过包。', '', '0', '1595486686', '1595510806', '1', '5');
INSERT INTO `prefix_xielei_manual_post` VALUES ('2', '1', '0', '2', '钩子', '', '', '**整个系统有且仅有四个钩子**\r\n\r\n* `app.start`\r\n* `app.start@包`\r\n* `app.end@包`\r\n* `app.end`\r\n\r\n钩子的作用主要是在系统执行到某个点的时候，进行切面操作，例如：\r\n\r\n* 在`app.start`的时候注册路由\r\n* 在`app.end`的时候操作`响应`\r\n* 在`app.start@包`的时候，对该包的执行进行一些配置\r\n\r\n钩子会自动载入包对应文件夹下的**所有文件**，如下：\r\n\r\n* /hook/钩子名/\\*\\*.php\r\n* /所有安装了的包/src/hook/钩子名/\\*\\*.php\r\n\r\n**可以跨包操作**\r\n\r\n例如在`xielei/manual`包下面配置钩子`/hook/app.start@xielei.test/foo.php`,`/hook/app.start@xielei.test/bar.php`文件夹，在文件加下的文件就会在**`xielei/test`**包执行的时候引入上述两个文件\r\n\r\n常见的使用场景如下：\r\n\r\n* 设置模板路径，做主题包\r\n* 对其他包做插件\r\n* ...\r\n\r\n**钩子示例**\r\n\r\n记录全局请求日志 `/hook/app.start/log.php`\r\n```\r\n<?php\r\n\r\ndeclare(strict_types=1);\r\n\r\nuse Ebcms\\App;\r\nuse Ebcms\\Container;\r\nuse Monolog\\Handler\\StreamHandler;\r\nuse Monolog\\Logger;\r\nuse Psr\\Log\\LoggerInterface;\r\n\r\nApp::getInstance()->execute(function (\r\n    Container $container,\r\n    App $app\r\n) {\r\n    $container->set(LoggerInterface::class, function () use ($app): LoggerInterface {\r\n        $log = new Logger($_SERVER[\'HTTP_HOST\']);\r\n        $log->pushHandler(new StreamHandler($app->getAppPath() . \'/runtime/log/\' . date(\'Y-m-d\') . \'/debug.log\', Logger::DEBUG));\r\n        return $log;\r\n    });\r\n    $container->get(LoggerInterface::class)->debug($_SERVER[\'REQUEST_METHOD\'] . \':\' . $_SERVER[\'REQUEST_URI\'], [$_POST, $_GET]);\r\n});\r\n```\r\n\r\n给`xielei/article`包自定义函数 `/hook/app.start@xielei.article/functions.php`\r\n```\r\n<?php\r\n\r\ndeclare(strict_types=1);\r\n\r\nfunction test(): array\r\n{\r\n    return [];\r\n}\r\n```\r\n\r\n给`xielei/article`包注入中间件 `/hook/app.start@xielei.article/middleware.php`\r\n```\r\n<?php\r\n\r\ndeclare(strict_types=1);\r\n\r\nuse Ebcms\\App;\r\nuse Ebcms\\RequestHandler;\r\n\r\nApp::getInstance()->execute(function (\r\n    RequestHandler $requestHandler,\r\n    App $app\r\n) {\r\n    $requestHandler->lazyMiddleware(SomeMiddleware::class);\r\n});\r\n```\r\n\r\n...还有很多，这里就不一一列举。', '', '0', '1595486693', '1595510114', '1', '4');
INSERT INTO `prefix_xielei_manual_post` VALUES ('3', '1', '0', '2', '配置', '', '', '**配置类`\\Ebcms\\Config`**\r\n\r\n配置分类三块：\r\n\r\n**用户配置**\r\n\r\n此配置位于系统的`config`文件夹下面，拥有最高的优先级，例如：\r\n\r\n`/config/xielei/article/site.php`\r\n\r\n**模块配置**\r\n\r\n模块配置有开发者事先配置，在对应包的`config`文件夹下面，例如：\r\n\r\n`包路径/src/config/site.php`\r\n\r\n**默认配置**\r\n\r\n默认配置是固定在代码中，无模块配置和用户配置的时候的默认值，例如：\r\n\r\n```\r\n$config->get(\'key\',\'默认值\');\r\n$config->get(\'siteconfig@xielei.article\', [...]);\r\n$config->get(\'site.title@xielei.article\', \'某某网站\');\r\n```\r\n\r\n**优先级顺序**\r\n\r\n`用户配置`>`模块配置`>`默认配置`\r\n\r\n意思就是 在有用户配置的情况下会优先使用用户配置，否则就使用模块配置，若没有模块配置，再使用默认配置\r\n\r\n用法：\r\n\r\n```\r\n$config->get(\'foo.bar@包\', \'默认值\');\r\n```\r\n\r\n例如：\r\n\r\n```\r\n// 获取包xielei/article的配置文件site.php下的title值\r\n$config->get(\'site.title@xielei.article\');\r\n\r\n// 获取包xielei/article的配置文件site.php下的所有值\r\n$config->get(\'site@xielei/article\');\r\n```\r\n\r\n**只能获取已经安装的模块的配置数据**\r\n\r\n**包可以用`.`分割，也可以用`/`分割**', '', '0', '1595486703', '1595510880', '1', '3');
INSERT INTO `prefix_xielei_manual_post` VALUES ('4', '1', '0', '2', '中间件', '', '', '**中间件遵守标准的PSR规范！**\r\n\r\n中间件由`\\Ebcms\\RequestHandler`管理\r\n\r\n支持如下方法：\r\n\r\n* `middleware(MiddlewareInterface $middleware)` 注册一个中间件\r\n* `middlewares(array $middlewares)` 注册多个中间件\r\n* `prependMiddleware(MiddlewareInterface $middleware)` 注册一个中间件(顶部追加)\r\n* `lazyMiddleware(string $middleware)` 注册一个中间件(字符串形式、命名空间形式)\r\n* `lazyMiddlewares(array $middlewares)` 注册多个中间件(字符串形式、命名空间形式)\r\n* `lazyPrependMiddleware(string $middleware)` 注册一个中间件(字符串形式、命名空间形式)(顶部追加)\r\n\r\n**前置中间件**\r\n\r\n前置中间件就是在获得响应之前进行条件判断返回其他响应，主要是用作拦截，比如权限认证、跳转等等\r\n\r\n一个前置中间件的示例：\r\n\r\n```\r\n<?php\r\n\r\ndeclare(strict_types=1);\r\n\r\nuse Psr\\Http\\Message\\ResponseInterface;\r\nuse Psr\\Http\\Message\\ServerRequestInterface;\r\nuse Psr\\Http\\Server\\MiddlewareInterface;\r\nuse Psr\\Http\\Server\\RequestHandlerInterface;\r\n\r\nclass Auth implements MiddlewareInterface\r\n{\r\n    public function process(\r\n        ServerRequestInterface $request,\r\n        RequestHandlerInterface $handler\r\n    ): ResponseInterface {\r\n        if (\'未登录\') {\r\n            // 在响应之前返回跳转\r\n            return new JumpResponse(\'http://...\', 302);\r\n        }\r\n        return $handler->handle($request);\r\n    }\r\n}\r\n\r\n```\r\n\r\n**后置中间件**\r\n\r\n后置中间件主要是在获得响应后，对`响应`做变更，例如往响应的代码中注入代码，比如加入统计代码之类的。\r\n\r\n一个后置中间件的示例：\r\n\r\n```\r\n<?php\r\n\r\ndeclare(strict_types=1);\r\n\r\nuse Ebcms\\StreamFactory;\r\nuse Psr\\Http\\Message\\ServerRequestInterface;\r\nuse Psr\\Http\\Message\\ResponseInterface;\r\nuse Psr\\Http\\Server\\MiddlewareInterface;\r\nuse Psr\\Http\\Server\\RequestHandlerInterface;\r\n\r\nclass RejectTongjiCode implements MiddlewareInterface\r\n{\r\n\r\n    public function process(\r\n        ServerRequestInterface $request,\r\n        RequestHandlerInterface $handler\r\n    ): ResponseInterface {\r\n        $response = $handler->handle($request);\r\n        // 在响应之后，对响应注入其他代码\r\n        $tongji_code = \'<script>...</script>\';\r\n        $contents = str_replace(\'</body>\', $tongji_code . \'</body>\', $response->getBody());\r\n        return $response->withBody((new StreamFactory())->createStream($contents));\r\n    }\r\n}\r\n\r\n```\r\n\r\n*前置中间件和后置中间件的代码区别就是前置是在`$handler->handle($request)`处理之前返回其他`响应`，后置是在获取`$handler->handle($request)`响应之后对`响应`做出处理*\r\n\r\n**将中间件注入到系统**\r\n\r\n注入到系统中有很多方式，比如在钩子上注入，也可以在控制器中注入，也可以在路由上注入\r\n\r\n**通过钩子注入示例**\r\n\r\n```\r\n// /hook/app.start/aaa.php\r\n\r\n<?php\r\n\r\ndeclare(strict_types=1);\r\n\r\nuse Ebcms\\App;\r\nuse Ebcms\\RequestHandler;\r\n\r\nApp::getInstance()->execute(function (\r\n    RequestHandler $requestHandler\r\n) {\r\n    $requestHandler->lazyMiddleware(SomeMiddleware::class);\r\n});\r\n```\r\n\r\n**在控制器中注入示例**\r\n\r\n```\r\n<?php\r\n\r\ndeclare(strict_types=1);\r\n\r\nuse Ebcms\\RequestHandler;\r\n\r\nclass Index\r\n{\r\n    public function __construct(\r\n        RequestHandler $requestHandler\r\n    ) {\r\n        $requestHandler->lazyMiddleware(SomeMiddleware::class);\r\n    }\r\n}\r\n```', '', '0', '1595486714', '1595507704', '1', '2');
INSERT INTO `prefix_xielei_manual_post` VALUES ('5', '1', '0', '2', '路由', '', '', '**路由类`\\Ebcms\\Router`**\r\n\r\n**注册路由**\r\n\r\n方法如下：\r\n\r\n```\r\n$router->getCollector()->... \r\n$router->getCollector()->get(\'/index\', Index::class, \'第三个参数是路由别名\');\r\n```\r\n\r\n**支持`get`,`post`,`put`,`delete`,`patch`,`head`等方法。**\r\n\r\n另外也支持路由分组，例如：\r\n\r\n```\r\n$router->getCollector()->addGroup(\'/sub\', function($route){\r\n	$route->get(\'/a\', ControlerA::class,\'/suba\');\r\n	$route->get(\'/b\', ControllerB::class,\'/subb\');\r\n	$route->addGroup(\'/sub2\', function($route){\r\n		$route->get(\'/cc\', ControllerC::class, \'/subsub\');\r\n	});\r\n});\r\n```\r\n\r\n**生成地址**\r\n\r\n`$router->buildUrl(\'/suba\')`就会生成`/sub/a`\r\n\r\n`$router->buildUrl(\'/subb\')`就会生成`/sub/b`\r\n\r\n`$router->buildUrl(\'/subsub\')`就会生成`/sub/sub2/cc`\r\n\r\n**路由分发**\r\n\r\n当访问`/sub/sub2/cc`的时候，就会分发到`ControllerC`控制器。\r\n\r\n**默认路由**\r\n\r\n上面讲的是自定义路由的情况，若是没有定义路由，系统会有默认路由，规则如下：\r\n\r\n`/包/路径`\r\n\r\n举例：\r\n\r\n* `/xielei/article/index` 路由到 `App\\Xielei\\Article\\Http\\Index`\r\n* `/xielei/article/admin/article/create` 路由到 `App\\Xielei\\Article\\Http\\Admin\\Article\\Create`\r\n* `/xielei/article/admin/create-category` 路由到 `App\\Xielei\\Article\\Http\\Admin\\CreateCategory`\r\n* `/xielei/my-demo/show-item` 路由到 `App\\Xielei\\MyDemo\\Http\\ShowItem`\r\n\r\n**绑定域名**\r\n\r\n示例代码如下：\r\n\r\n```\r\n$router->getCollector()->addGroup(\'http://www.ebcms.com/sub\', function($route){\r\n	$route->get(\'/foo\', ControlerA::class,\'/name-1\');\r\n	$route->addGroup(\'/sub2\', function($route){\r\n		$route->get(\'/cc\', ControllerC::class, \'/name-2\');\r\n		$route->get(\'/cc/ddd.html\', ControllerC::class, \'/name-houzui\');\r\n	});\r\n});\r\n\r\n$router->buildUrl(\'/name-1\'); // http://www.ebcms.com/sub/foo\r\n\r\n$router->buildUrl(\'/name-2\'); // http://www.ebcms.com/sub/sub2/cc\r\n\r\n$router->buildUrl(\'/name-houzui\'); // http://www.ebcms.com/sub/sub2/cc/ddd.html\r\n```\r\n\r\n**通常，要是不绑定域名，不限制https或http的话 `http://www.ebcms.com/` 可以通过代码获取当前的域名而不必固定写死**\r\n', '', '0', '1595486720', '1595510937', '1', '1');
INSERT INTO `prefix_xielei_manual_post` VALUES ('6', '1', '0', '2', '依赖注入', '', '', '**容器类`\\Ebcms\\Container`**\r\n\r\n**依赖注入来自开源项目[ebcms/psr11](https://github.com/ebcms/psr11)，欢迎PR ^-^.**\r\n\r\n依赖注入的好处就是可以全局管理类，无须实例化直接获取。\r\n\r\n**自动实例化类**\r\n\r\n```\r\n<?php\r\n\r\nclass Bar\r\n{\r\n    public function __construct()\r\n    {\r\n    }\r\n}\r\n\r\n\r\nclass Foo\r\n{\r\n    public function __construct(Bar $bar)\r\n    {\r\n        $this->bar = $bar;\r\n    }\r\n    \r\n    public function getBar()\r\n    {\r\n        return $this->bar;\r\n    }\r\n}\r\n\r\n$foo = $container->get(Foo::class); //Foo\r\n$foo->getBar(); //Bar\r\n```\r\n\r\n而无须实例化Foo类，也不需要实例化Bar类，这一切都通过$container帮您完成。\r\n\r\n**默认的，执行的控制器的构造方法`__construct()`支持依赖注入，例如：**\r\n\r\n```\r\n<?php\r\n\r\ndeclare(strict_types=1);\r\n\r\nuse Ebcms\\App;\r\nuse Ebcms\\Config;\r\nuse Ebcms\\Router;\r\nuse Xielei\\Template;\r\n\r\nclass Index\r\n{\r\n    public function __construct(\r\n        App $app,\r\n        Router $router,\r\n        Config $config,\r\n        Template $template,\r\n        ...\r\n    ) {\r\n        $config->get(......);\r\n        $router->buildUrl(..);\r\n    }\r\n}\r\n```\r\n\r\n**通过容器获取的类支持依赖注入，例如：**\r\n\r\n```\r\n$container->get(Foo::class);\r\n```\r\n\r\n那么 此处的Foo类的构造函数就可以依赖注入\r\n\r\n**通过`App::getInstrance()->execute(function(...){})`实现依赖注入，例如：**\r\n\r\n```\r\nApp::getInstance()->execute(function (\r\n    App $app,\r\n    RequestHandler $requestHandler,\r\n    RequestFilter $input,\r\n    Router $router,\r\n    Config $config,\r\n    Template $template,\r\n    ....\r\n) {\r\n    $app->....\r\n});\r\n```\r\n', '', '0', '1595486816', '1595511036', '1', '0');
INSERT INTO `prefix_xielei_manual_post` VALUES ('7', '1', '0', '2', '说明', '', '', '本文档若无特别说明，均是省去了命名空间的类，例如：\r\n\r\n`CacheInterface` `ResponseInterface`...等待 代表的是 PSR规定的接口\r\n\r\n`Config` `Router`...等等代表 `\\Ebcms\\..`下的类\r\n\r\n其他的以此类推，编辑器会自动提示。', '', '0', '1595488340', '1595510641', '1', '6');
