<?php

use Ebcms\App;
use Ebcms\Router;

return App::getInstance()->execute(function (Router $router) {
    return [
        'title' => '手册管理系统',
        'actions' => [[
            'title' => '手册管理',
            'url' => $router->buildUrl('/xielei/manual/admin/manual/index'),
        ], [
            'title' => '系统设置',
            'url' => $router->buildUrl('/xielei/manual/admin/config/index'),
        ]],
    ];
});
