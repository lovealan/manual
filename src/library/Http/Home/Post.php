<?php

declare(strict_types=1);

namespace App\Xielei\Manual\Http\Home;

use App\Xielei\Manual\Model\Manual;
use App\Xielei\Manual\Model\Post as ModelPost;
use Xielei\RequestFilter;
use Xielei\Template;

class Post extends Common
{

    public function get(
        RequestFilter $input,
        Template $template,
        Manual $manualModel,
        ModelPost $postModel
    ) {
        if (!$post = $postModel->get('*', [
            'state' => 1,
            'OR' => [
                'id' => $input->get('id'),
                'alias' => $input->get('id'),
            ],
        ])) {
            return $this->failure('页面不存在！');
        }

        if (!$manual = $manualModel->get('*', [
            'state' => 1,
            'id' => $post['manual_id'],
        ])) {
            return $this->failure('页面不存在！');
        }

        return $this->html($template->renderFromFile($manual['tpl_post'] ?: '/post', [
            'post' => $post,
            'manual' => $manual,
            'manualModel' => $manualModel,
            'postModel' => $postModel,
            'meta' => [
                'title' => $post['title'] . ' - ' . $manual['title'],
                'keywords' => $post['keywords'],
                'description' => $post['description'],
            ],
        ]));
    }
}
