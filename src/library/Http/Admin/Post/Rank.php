<?php

declare(strict_types=1);

namespace App\Xielei\Manual\Http\Admin\Post;

use App\Xielei\Admin\Http\Common;
use App\Xielei\Manual\Model\Post;
use Xielei\RequestFilter;

class Rank extends Common
{
    public function post(
        RequestFilter $input,
        Post $postModel
    ) {
        if (!$post = $postModel->get('*', [
            'id' => $input->post('id', 0, ['intval']),
        ])) {
            return $this->failure('不存在!');
        }
        if ($input->post('type', 'down') == 'down') {
            if ($smallid = $postModel->get('id', [
                'manual_id' => $post['manual_id'],
                'pid' => $post['pid'],
                'rank[<]' => $post['rank'],
                'ORDER' => [
                    'rank' => 'DESC',
                ],
            ])) {
                $postModel->update([
                    'rank[+]' => 1,
                ], [
                    'id' => $smallid,
                ]);
                $postModel->update([
                    'rank[-]' => 1,
                ], [
                    'id' => $post['id'],
                ]);
            }
        } else {
            if ($bigid = $postModel->get('id', [
                'manual_id' => $post['manual_id'],
                'pid' => $post['pid'],
                'rank[>]' => $post['rank'],
                'ORDER' => [
                    'rank' => 'ASC',
                ],
            ])) {
                $postModel->update([
                    'rank[-]' => 1,
                ], [
                    'id' => $bigid,
                ]);
                $postModel->update([
                    'rank[+]' => 1,
                ], [
                    'id' => $post['id'],
                ]);
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
