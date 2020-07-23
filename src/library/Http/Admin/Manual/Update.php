<?php

declare(strict_types=1);

namespace App\Xielei\Manual\Http\Admin\Manual;

use App\Xielei\Admin\Http\Common;
use App\Xielei\Manual\Model\Manual;
use Ebcms\Router;
use Xielei\FormBuilder\Builder;
use Xielei\FormBuilder\Col;
use Xielei\FormBuilder\Field\Hidden;
use Xielei\FormBuilder\Field\Radio;
use Xielei\FormBuilder\Field\Text;
use Xielei\FormBuilder\Field\Textarea;
use Xielei\FormBuilder\Other\Cover;
use Xielei\FormBuilder\Other\Summernote;
use Xielei\FormBuilder\Row;
use Xielei\FormBuilder\Summary;
use Xielei\RequestFilter;
use Xielei\Xss;

class Update extends Common
{
    public function get(
        Router $router,
        Manual $manualModel,
        RequestFilter $input
    ) {
        $data = $manualModel->get('*', [
            'id' => $input->get('id', 0, ['intval']),
        ]);
        $form = new Builder('更新手册');
        $form->addRow(
            (new Row())->addCol(
                (new Col('col-md-9'))->addItem(
                    (new Hidden('id', $data['id'])),
                    (new Text('手册标题', 'title', $data['title']))->set('help', '一般不超过20个字符')->set('required', 1),
                    (new Summernote('手册介绍', 'body', $data['body'], $router->buildUrl('/xielei/admin/upload'))),
                    (new Radio('是否公开', 'state', $data['state']))->set('options', [[
                        'label' => '是',
                        'value' => 1,
                    ], [
                        'label' => '否',
                        'value' => 2,
                    ]])->set('inline', true)
                ),
                (new Col('col-md-3'))->addItem(
                    (new Cover('封面', 'cover', $data['cover'], $router->buildUrl('/xielei/admin/upload'))),
                    (new Summary('元数据设置'))->addItem(
                        new Text('关键词', 'keywords', $data['keywords']),
                        new Textarea('简介', 'description', $data['description'])
                    ),
                    (new Summary('其他参数设置'))->addItem(
                        new Text('栏目默认模板', 'tpl_manual', $data['tpl_manual']),
                        new Text('内容默认模板', 'tpl_post', $data['tpl_post']),
                        new Text('别名', 'alias', $data['alias'])
                    )
                )
            )
        );
        return $this->html($form->__toString());
    }
    public function post(
        RequestFilter $input,
        Manual $manualModel,
        Xss $xss
    ) {
        $update = array_intersect_key($input->post(), [
            'title' => '',
            'cover' => '',
            'state' => '',
            'keywords' => '',
            'description' => '',
            'tpl_manual' => '',
            'tpl_post' => '',
            'alias' => '',
        ]);
        if ($input->has('post.body')) {
            $update['body'] = $input->post('body', '', [[$xss, 'clear']]);
        }
        $update['update_time'] = time();

        $manualModel->update($update, [
            'id' => $input->post('id', 0, ['intval']),
        ]);

        return $this->success('操作成功！', 'javascript:history.go(-2)');
    }
}
