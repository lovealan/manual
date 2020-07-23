<?php

declare(strict_types=1);

namespace App\Xielei\Manual\Http\Admin\Post;

use App\Xielei\Admin\Http\Common;
use App\Xielei\Manual\Model\Manual;
use App\Xielei\Manual\Model\Post;
use Xielei\RequestFilter;
use Xielei\Template;

class Index extends Common
{

    public function get(
        Template $template,
        RequestFilter $input,
        Manual $manualModel,
        Post $postModel
    ) {
        return $this->html($template->renderFromFile('/post/index', [
            'manualModel'=>$manualModel,
            'postModel'=>$postModel,
            'manual' => $manualModel->get('*', [
                'id' => $input->get('manual_id', 0, ['intval']),
            ]),
            'pdata' => $this->getParentData($input->get('pid', 0, ['intval']), $postModel),
            'datas' => $postModel->select('*', [
                'manual_id' => $input->get('manual_id', 0, ['intval']),
                'pid' => $input->get('pid', 0, ['intval']),
                'ORDER' => [
                    // 'type' => 'ASC',
                    'rank' => 'DESC',
                    'id' => 'ASC',
                ],
            ]),
        ]));
    }

    private function getParentData($id = 0, Post $postModel)
    {
        $res = [];
        if ($data = $postModel->get('*', [
            'id' => $id,
        ])) {
            $sub = $this->getParentData($data['pid'], $postModel);
            foreach ($sub as $value) {
                $res[] = $value;
            }
            $res[] = $data;
        }
        return $res;
    }
}
