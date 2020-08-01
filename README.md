# manual

manual

## 安装

``` cmd
composer require xielei/manual
```

通过composer安装后，需要配置数据库信息，新建`config/xielei/database/database.php`数据库配置文件，配置如下：

``` php
// 若采用mysql数据库，则配置如下，还要导入包里面的import.sql
return [
  'database_name' => '...',
  'server' => '127.0.0.1',
  'username' => '...',
  'password' => '...',
];

// 若采用sqlite，则配置
return [
  'database_type' => 'sqlite',
  'database_file' => 'E:\WWW\ebcms\config\sqlite.db', //根据你的情况填写，包里面有sqlite.db
  'command' => null,
];
```

当然，也可以动态配置，需要在`app.start@xielei.manual`上挂载如下代码：

``` php
use Ebcms\App;
use Ebcms\Config;

App::getInstance()->execute(function (
    App $app,
    Config $config
) {
    // sqlite
    $config->set('database.database_type@xielei.database', 'sqlite');
    $config->set('database.database_file@xielei.database', $app->getAppPath() . '/config/xielei/manual/manual.db');
    $config->set('database.command@xielei.database', null);
    // mysql
    // ...
});
```

## 特点

- markdown书写
- 搜索
- 多级目录

## 案例

- [https://www.ebcms.com/manual/ebcms_framework](https://www.ebcms.com/manual/ebcms_framework)

## 自定义路由

可通过下面的代码实现自定义路由，并挂载到钩子 `app.start` 上

``` php
use App\Xielei\Manual\Http\Home\Manual;
use App\Xielei\Manual\Http\Home\Post;
use App\Xielei\Manual\Http\Home\Search;
use Ebcms\App;
use Ebcms\Router;

App::getInstance()->execute(function (
    Router $router
) {
    $router->getCollector()->addGroup((function (): string {
        if (
            (!empty($_SERVER['REQUEST_SCHEME']) && $_SERVER['REQUEST_SCHEME'] == 'https')
            || (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
            || (!empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443')
        ) {
            $schema = 'https';
        } else {
            $schema = 'http';
        }

        $script_name = '/' . implode('/', array_filter(explode('/', $_SERVER['SCRIPT_NAME'])));
        $request_uri = parse_url('/' . implode('/', array_filter(explode('/', $_SERVER['REQUEST_URI']))), PHP_URL_PATH);
        if (strpos($request_uri, $script_name) === 0) {
            return $schema . '://' . $_SERVER['HTTP_HOST'] . $script_name;
        } else {
            return $schema . '://' . $_SERVER['HTTP_HOST'] . (strlen(dirname($script_name)) > 1 ? dirname($script_name) : '');
        }
    })(), function ($route) {
        $route->get('/manual/search/{manual_id}', Search::class, '/xielei/manual/home/search');
        $route->get('/manual/{id}', Manual::class, '/xielei/manual/home/manual');
        $route->get('/manual/post/{id}', Post::class, '/xielei/manual/home/post');
    });
});
```
