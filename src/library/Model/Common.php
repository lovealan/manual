<?php

declare(strict_types=1);

namespace App\Xielei\Manual\Model;

use Ebcms\Config;
use Medoo\Medoo;
use Xielei\Database\Model;

abstract class Common extends Model
{
    public function __construct(
        Config $config
    ) {
        $this->db = new Medoo(array_merge([
            'database_type' => 'sqlite',
            'database_file' => __DIR__ . '/../../../sqlite.db',
            'prefix' => 'prefix_',
            'option' => [
                \PDO::ATTR_CASE => \PDO::CASE_NATURAL,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_STRINGIFY_FETCHES => false,
                \PDO::ATTR_EMULATE_PREPARES => false,
            ],
            'command' => null,
        ], (array) $config->get('database@xielei.manual', [])));
    }
}
