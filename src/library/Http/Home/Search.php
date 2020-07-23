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

        $where = 'WHERE manual_id=:manual_id AND type=:type AND MATCH (title,keywords,description,body) AGAINST (:q IN NATURAL LANGUAGE MODE)';
        $posts = $postModel->select('*',  Db::raw($where, [
            ':manual_id' => $manual['id'],
            ':type' => 2,
            ':q' => $input->get('q'),
        ]));

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
