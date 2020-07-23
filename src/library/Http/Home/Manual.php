<?php

declare(strict_types=1);

namespace App\Xielei\Manual\Http\Home;

use App\Xielei\Manual\Model\Manual as ModelManual;
use App\Xielei\Manual\Model\Post;
use Xielei\RequestFilter;
use Xielei\Template;

class Manual extends Common
{

    public function get(
        RequestFilter $input,
        Template $template,
        ModelManual $manualModel,
        Post $postModel
    ) {
        if (!$manual = $manualModel->get('*', [
            'state' => 1,
            'OR' => [
                'id' => $input->get('id'),
                'alias' => $input->get('id'),
            ],
        ])) {
            return $this->failure('页面不存在！');
        }

        return $this->html($template->renderFromFile($manual['tpl_manual'] ?: '/manual', [
            'manual' => $manual,
            'manualModel' => $manualModel,
            'postModel' => $postModel,
            'meta' => [
                'title' => $manual['title'],
                'keywords' => $manual['keywords'],
                'description' => $manual['description'],
            ],
        ]));
    }
}
