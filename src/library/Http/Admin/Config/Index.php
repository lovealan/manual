<?php

declare(strict_types=1);

namespace App\Xielei\Manual\Http\Admin\Config;

use App\Xielei\Admin\Http\Common;
use App\Xielei\Manual\Model\Config as ModelConfig;
use Ebcms\Config;
use Xielei\FormBuilder\Builder;
use Xielei\FormBuilder\Col;
use Xielei\FormBuilder\Field\Text;
use Xielei\FormBuilder\Field\Textarea;
use Xielei\FormBuilder\Row;
use Xielei\RequestFilter;

class Index extends Common
{
    public function get(
        Config $config
    ) {
        $form = new Builder('系统设置');
        $form->addRow(
            (new Row())->addCol(
                (new Col('col-md-9'))->addItem(
                    (new Text('网站名称', 'xielei[manual][site][name]', $config->get('site.name@xielei.manual')))->set('help', '网站标题的后缀，一般不宜过长，例如:EBCMS'),
                    (new Text('网站标题', 'xielei[manual][site][title]', $config->get('site.title@xielei.manual')))->set('help', '首页标题，例如：好用的网站管理系统'),
                    (new Text('网站关键词', 'xielei[manual][site][keywords]', $config->get('site.keywords@xielei.manual')))->set('help', '例如：cms ebcms 内容管理系统'),
                    (new Textarea('网站简介', 'xielei[manual][site][description]', $config->get('site.description@xielei.manual')))->set('help', '例如：ebcms是好用的内容管理系统'),
                    (new Text('前台模板路径', 'xielei[manual][site][template_root]', $config->get('site.template_root@xielei.manual')))->set('help', '相对于网站index.php文件的路径，也可以写绝对路径')
                ),
                (new Col('col-md-3'))->addItem()
            )
        );
        return $form->__toString();
    }

    public function post(
        RequestFilter $input,
        ModelConfig $configModel
    ) {
        $configModel->save($input->post());
        return $this->success('更新成功！');
    }
}
