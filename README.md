# manual

manual

## Installation

``` cmd
composer require xielei/manual
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
