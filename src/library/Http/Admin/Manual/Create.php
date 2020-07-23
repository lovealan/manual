<?php

declare(strict_types=1);

namespace App\Xielei\Manual\Http\Admin\Manual;

use App\Xielei\Admin\Http\Common;
use App\Xielei\Manual\Model\Manual;
use Ebcms\Router;
use Xielei\FormBuilder\Builder;
use Xielei\FormBuilder\Col;
use Xielei\FormBuilder\Field\Radio;
use Xielei\FormBuilder\Field\Text;
use Xielei\FormBuilder\Field\Textarea;
use Xielei\FormBuilder\Other\Cover;
use Xielei\FormBuilder\Other\Summernote;
use Xielei\FormBuilder\Row;
use Xielei\FormBuilder\Summary;
use Xielei\RequestFilter;

class Create extends Common
{
    public function get(
        Router $router
    ) {
        $form = new Builder('创建手册');
        $form->addRow(
            (new Row())->addCol(
                (new Col('col-md-9'))->addItem(
                    (new Text('手册标题', 'title'))->set('help', '一般不超过20个字符')->set('required', 1),
                    (new Summernote('手册介绍', 'body', '', $router->buildUrl('/xielei/admin/upload'))),
                    (new Radio('是否公开', 'state', 1))->set('options', [[
                        'label' => '是',
                        'value' => 1,
                    ], [
                        'label' => '否',
                        'value' => 2,
                    ]])->set('inline', true)
                ),
                (new Col('col-md-3'))->addItem(
                    (new Cover('封面', 'cover', '', $router->buildUrl('/xielei/admin/upload'))),
                    (new Summary('元数据设置'))->addItem(
                        new Text('关键词', 'keywords'),
                        new Textarea('简介', 'description')
                    ),
                    (new Summary('其他参数设置'))->addItem(
                        new Text('封面模板', 'tpl_manual'),
                        new Text('内容模板', 'tpl_post'),
                        new Text('别名', 'alias')
                    )
                )
            )
        );
        return $form;
    }

    public function post(
        RequestFilter $input,
        Manual $manualModel
    ) {
        $manualModel->insert([
            'title' => $input->post('title'),
            'body' => $input->post('body', '', []),
            'state' => $input->post('state'),
            'keywords' => $input->post('keywords'),
            'description' => $input->post('description'),
            'tpl_manual' => $input->post('tpl_manual'),
            'tpl_post' => $input->post('tpl_post'),
            'alias' => $input->post('alias'),
            'create_time' => time(),
            'update_time' => time(),
        ]);
        return $this->success('操作成功！', 'javascript:history.go(-2)');
    }
}
