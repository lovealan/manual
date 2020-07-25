<?php

declare(strict_types=1);

namespace App\Xielei\Manual\Http\Home;

use App\Xielei\Manual\Model\Manual;
use App\Xielei\Manual\Model\Post;
use Ebcms\Config;
use Xielei\Database\Db;
use Xielei\RequestFilter;
use Xielei\Template;

class Search extends Common
{

    public function get(
        Config $config,
        RequestFilter $input,
        Manual $manualModel,
        Post $postModel,
        Template $template
    ) {

        if (!$manual = $manualModel->get('*', [
            'state' => 1,
            'id' => $input->get('manual_id'),
        ])) {
            return $this->failure('页面不存在！');
        }
        $posts = [];

        if (strlen($input->get('q', '', ['trim'])) > 1) {
            $posts = $postModel->select('*',  [
                'manual_id' => $input->get('manual_id'),
                'type' => 2,
                'state' => 1,
                'OR' => [
                    'title[~]' => $input->get('q', '....', ['trim']),
                    'keywords[~]' => $input->get('q', '....', ['trim']),
                    'description[~]' => $input->get('q', '....', ['trim']),
                    'body[~]' => $input->get('q', '....', ['trim']),
                ],
            ]);
        }

        $html = $template->renderFromFile('/search', [
            'posts' => $posts,
            'manual' => $manual,
            'manualModel' => $manualModel,
            'postModel' => $postModel,
            'meta' => [
                'title' => '搜索 - ' . $config->get('site.name@xielei.manual'),
                'keywords' => $input->get('q'),
                'description' => $input->get('q'),
            ],
        ]);
        return $this->html($html);
    }
}
