<?php

use App\Xielei\Manual\Middleware\PowerBy;
use Ebcms\App;
use Ebcms\RequestHandler;

App::getInstance()->execute(function (
    RequestHandler $requestHandler,
    App $app
) {
    if (strpos($app->getRequestTargetClass(), "App\\Xielei\\Manual\\Http\\Home\\") === 0) {
        $requestHandler->lazyMiddleware(PowerBy::class);
    }
});
