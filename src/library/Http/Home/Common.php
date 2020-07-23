<?php

declare(strict_types=1);

namespace App\Xielei\Manual\Http\Home;

use App\Xielei\Admin\Traits\ResponseTrait;
use App\Xielei\Admin\Traits\RestfulTrait;
use Ebcms\Config;
use Ebcms\Router;
use Xielei\RequestFilter;
use Xielei\Template;

abstract class Common
{
    use RestfulTrait;
    use ResponseTrait;

    public function __construct(
        Config $config,
        Router $router,
        RequestFilter $input,
        Template $template
    ) {
        $template->setRoot($config->get('site.template_root@xielei.manual', '') ?: __DIR__ . '/../../../template/home');
        $template->assign('config', $config);
        $template->assign('router', $router);
        $template->assign('input', $input);
        $this->template = $template;
    }
}
