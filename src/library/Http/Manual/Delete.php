<?php

declare(strict_types=1);

namespace App\Xielei\Manual\Http\Manual;

use App\Xielei\Admin\Http\Common;
use App\Xielei\Manual\Model\Post;
use App\Xielei\Manual\Model\Manual;
use Xielei\RequestFilter;

class Delete extends Common
{
    public function get(
        RequestFilter $input,
        Post $postModel,
        Manual $manualModel
    ) {
        $postModel->delete([
            'manual_id' => $input->get('id', 0, ['intval']),
        ]);
        $manualModel->delete([
            'id' => $input->get('id', 0, ['intval']),
        ]);
        return $this->success('操作成功！');
    }
}
