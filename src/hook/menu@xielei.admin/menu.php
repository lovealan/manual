<?php

use App\Xielei\Admin\Model\Menu;
use Ebcms\App;
use Ebcms\Router;

App::getInstance()->execute(function (
    Router $router,
    Menu $menu
) {
    $menu->add('手册系统', [
        'title' => '手册管理',
        'url' => $router->buildUrl('/xielei/manual/admin/manual/index'),
    ]);
});
