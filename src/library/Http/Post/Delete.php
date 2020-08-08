<?php

declare(strict_types=1);

namespace App\Xielei\Manual\Http\Post;

use App\Xielei\Admin\Http\Common;
use App\Xielei\Manual\Model\Manual;
use App\Xielei\Manual\Model\Post;
use Xielei\Database\Model;
use Xielei\RequestFilter;

class Delete extends Common
{
    public function post(
        RequestFilter $input,
        Manual $manualModel,
        Post $postModel
    ) {
        if ($post = $postModel->get('*', [
            'id' => $input->post('id', 0, ['intval']),
        ])) {
            $this->delete($postModel, [$post['id']]);

            $postModel->reRank($post['manual_id'], $post['pid']);

            $manualModel->update([
                'update_time' => time(),
            ], [
                'id' => $input->post('id'),
            ]);
        }
        return $this->success('操作成功！');
    }

    private function delete(Model $model, array $ids)
    {
        foreach ($ids as $pid) {
            if ($subid = $model->select('id', [
                'pid' => $pid
            ])) {
                $this->delete($model, $subid);
            }
        }
        $model->delete([
            'id' => $ids,
        ]);
    }
}
