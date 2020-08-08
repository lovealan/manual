<?php

declare(strict_types=1);

namespace App\Xielei\Manual\Http\Manual;

use App\Xielei\Admin\Http\Common;
use App\Xielei\Manual\Model\Manual;
use Xielei\Template;

class Index extends Common
{

    public function get(
        Manual $manualModel,
        Template $template
    ) {
        return $this->html($template->renderFromFile('/manual/index', [
            'manuals' => $manualModel->select('*', [
                'ORDER' => [
                    'id' => 'ASC',
                ],
            ]),
        ]));
    }
}
