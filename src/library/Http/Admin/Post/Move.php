<?php

declare(strict_types=1);

namespace App\Xielei\Manual\Http\Admin\Post;

use App\Xielei\Admin\Http\Common;
use App\Xielei\Manual\Model\Post;
use Xielei\RequestFilter;

class Move extends Common
{
    public function post(
        RequestFilter $input,
        Post $postModel
    ) {
        if ($ids = $input->post('ids')) {
            $pid = $input->post('pid', 0, ['intval']);
            if ($ids = array_merge(array_diff($ids, [$pid]))) {
                $postModel->update([
                    'pid' => $input->post('pid'),
                ], [
                    'id' => $input->post('ids'),
                ]);
                if (!$this->hasTop($postModel, $pid)) {
                    $postModel->update([
                        'pid' => 0,
                    ], [
                        'id' => $pid,
                    ]);
                }
                $postModel->reRank($postModel->get('manual_id', ['id' => $ids]), $pid);
            }
        }
        return $this->success('操作成功！', 'javascript:history.go(-2)');
    }

    private function hasTop(Post $postModel, $id, $has = [])
    {
        $has[] = $id;
        $pid = $postModel->get('pid', [
            'id' => $id,
        ]);
        if ($pid == 0) {
            return true;
        } elseif (in_array($pid, $has)) {
            return false;
        } else {
            return $this->hasTop($postModel, $pid, $has);
        }
    }
}
