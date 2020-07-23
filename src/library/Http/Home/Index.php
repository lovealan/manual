<?php

declare(strict_types=1);

namespace App\Xielei\Manual\Http\Home;

use App\Xielei\Manual\Model\Manual;
use App\Xielei\Manual\Model\Post;
use Ebcms\Config;
use Xielei\Template;

class Index extends Common
{

    public function get(
        Template $template,
        Config $config,
        Manual $manualModel,
        Post $postModel
    ) {
        return $this->html($template->renderFromFile('/index', [
            'manualModel' => $manualModel,
            'postModel' => $postModel,
            'meta' => [
                'title' => $config->get('site.name@xielei.manual') . ' - ' . $config->get('site.title@xielei.manual'),
                'keywords' => $config->get('site.keywords@xielei.manual'),
                'description' => $config->get('site.description@xielei.manual'),
            ],
        ]));
    }
}
