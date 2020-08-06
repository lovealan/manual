<?php

declare(strict_types=1);

namespace App\Xielei\Manual\Http\Home;

use App\Xielei\Manual\Model\Manual;
use App\Xielei\Manual\Model\Post;
use Ebcms\Config;
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
            'OR' => [
                'id' => $input->get('manual_id'),
                'alias' => $input->get('manual_id'),
            ],
        ])) {
            return $this->failure('页面不存在！');
        }

        $q = $input->get('q', '', ['trim']);
        if (strlen($q) < 2) {
            return $this->failure('请输入关键词！');
        }

        $posts = $postModel->select('*',  [
            'manual_id' => $manual['id'],
            'type' => 2,
            'state' => 1,
            'OR' => [
                'title[~]' => $q,
                'keywords[~]' => $q,
                'description[~]' => $q,
                'body[~]' => $q,
            ],
        ]);

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
