<?php

declare(strict_types=1);

namespace App\Xielei\Manual\Http\Post;

use App\Xielei\Admin\Http\Common;
use App\Xielei\Manual\Model\Manual;
use App\Xielei\Manual\Model\Post;
use Xielei\RequestFilter;

class Create extends Common
{
    public function post(
        RequestFilter $input,
        Manual $manualModel,
        Post $postModel
    ) {
        $data = [
            'manual_id' => $input->post('manual_id'),
            'pid' => $input->post('pid'),
            'type' => $input->post('type', 1, ['intval']),
            'title' => $input->post('title'),
            'state' => $input->post('state', 2, ['intval']),
            'create_time' => time(),
            'update_time' => time(),
        ];
        $postModel->insert($data);
        $manualModel->update([
            'update_time' => time(),
        ], [
            'id' => $input->post('manual_id'),
        ]);
        $postModel->reRank($data['manual_id'], $data['pid']);
        return $this->success('操作成功！', 'javascript:history.go(-2)');
    }
}
