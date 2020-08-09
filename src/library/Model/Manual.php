<?php

declare(strict_types=1);

namespace App\Xielei\Manual\Model;

use Xielei\Database\Model;

class Manual extends Model
{
    public function getTable(): string
    {
        return 'xielei_manual_manual';
    }
}
