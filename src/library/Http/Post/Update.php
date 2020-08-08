<?php

declare(strict_types=1);

namespace App\Xielei\Manual\Http\Post;

use App\Xielei\Admin\Http\Common;
use App\Xielei\Manual\Form\Simplemde;
use App\Xielei\Manual\Model\Manual;
use App\Xielei\Manual\Model\Post;
use Ebcms\Router;
use Xielei\FormBuilder\Builder;
use Xielei\FormBuilder\Col;
use Xielei\FormBuilder\Field\Hidden;
use Xielei\FormBuilder\Field\Radio;
use Xielei\FormBuilder\Field\Text;
use Xielei\FormBuilder\Field\Textarea;
use Xielei\FormBuilder\Row;
use Xielei\FormBuilder\Summary;
use Xielei\RequestFilter;

class Update extends Common
{
    public function get(
        Post $postModel,
        Router $router,
        RequestFilter $input
    ) {
        $data = $postModel->get('*', [
            'id' => $input->get('id', 0, ['intval']),
        ]);
        $form = new Builder('编辑文档');
        $form->addRow(
            (new Row())->addCol(
                (new Col('col-md-9'))->addItem(
                    (new Hidden('id', $data['id'])),
                    (new Text('文档名称', 'title', $data['title']))->set('help', '一般不超过80个字符')->set('required', 1),
                    (new Simplemde('文档详情', 'body', $data['body'], $router->buildUrl('/xielei/admin/upload'))),
                    (new Radio('是否公开', 'state', $data['state']))
                        ->set('options', [[
                            'label' => '是',
                            'value' => 1,
                        ], [
                            'label' => '否',
                            'value' => 2,
                        ]])
                        ->set('inline', true)
                ),
                (new Col('col-md-3'))->addItem(
                    new Text('别名', 'alias', $data['alias']),
                    new Text('关键词', 'keywords', $data['keywords']),
                    new Textarea('简介', 'description', $data['description'])
                )
            )
        );
        return $this->html($form->__toString());
    }
    public function post(
        RequestFilter $input,
        Post $postModel,
        Manual $manualModel
    ) {
        $update = array_intersect_key($input->post(), [
            'title' => '',
            'keywords' => '',
            'description' => '',
            'alias' => '',
            'state' => '',
        ]);
        if ($input->has('post.body')) {
            $update['body'] = $input->post('body', '', []);
        }
        $update['update_time'] = time();

        $postModel->update($update, [
            'id' => $input->post('id', 0, ['intval']),
        ]);

        if ($manual_id = $postModel->get('manual_id', [
            'id' => $input->post('id'),
        ])) {
            $manualModel->update([
                'update_time' => time(),
            ], [
                'id' => $manual_id,
            ]);
        }

        return $this->success('操作成功！', 'javascript:history.go(-2)');
    }
}
