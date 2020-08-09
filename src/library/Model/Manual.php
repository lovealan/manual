<?php

declare(strict_types=1);

namespace App\Xielei\Manual\Model;

class Manual extends Common
{

    public function getTable(): string
    {
        return 'xielei_manual_manual';
    }
}
