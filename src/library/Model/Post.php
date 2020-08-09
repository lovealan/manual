<?php

declare(strict_types=1);

namespace App\Xielei\Manual\Model;

class Post extends Common
{

    public function getTable(): string
    {
        return 'xielei_manual_post';
    }

    public function levelPosts($manual_id)
    {
        return $this->level($this->select('*', [
            'manual_id' => $manual_id,
            'ORDER' => [
                'rank' => 'DESC',
                'id' => 'ASC',
            ],
        ]));
    }

    public function reRank($manual_id, $pid)
    {
        $posts = $this->select('*', [
            'manual_id' => $manual_id,
            'pid' => $pid,
            'ORDER' => [
                'rank' => 'DESC',
                'id' => 'ASC',
            ],
        ]);
        $count = count($posts);
        foreach ($posts as $key => $vo) {
            if ($vo['rank'] != ($count - $key - 1)) {
                $this->update([
                    'rank' => ($count - $key - 1),
                ], [
                    'id' => $vo['id'],
                ]);
            }
        }
    }

    private function level(array $data, $pid = 0, $level = 0): array
    {
        $res = [];
        foreach ($data as $value) {
            if ($value['pid'] == $pid) {
                $res[] = [
                    'value' => $value['true_value'],
                    'label' => str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level) . '┠&nbsp;' . $value['title'],
                ];
                foreach ($this->level($data, $value['id'], $level + 1) as $value) {
                    $res[] = $value;
                }
            }
        }
        return $res;
    }
}
