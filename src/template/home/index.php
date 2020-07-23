{include /common/header}
<?php
$manuals = $manualModel->select('*', [
    'ORDER' => [
        'id' => 'ASC',
    ],
    'state' => 1,
]);
function format_date($time)
{
    $t = time() - $time;
    $f = array(
        '31536000' => '年',
        '2592000' => '个月',
        '604800' => '星期',
        '86400' => '天',
        '3600' => '小时',
        '60' => '分钟',
        '1' => '秒'
    );
    foreach ($f as $k => $v) {
        $c = $c = floor($t / intval($k));
        if (0 != $c) {
            return $c . $v . '前';
        }
    }
}
?>
<div class="my-4 d-inline-block display-4 font-weight-bold text-secondary text-monospace">手册中心</div>
<div class="row row-cols-1 row-cols-md-4 row-cols-sm-3 row-cols-xs-2">
    {foreach $manuals as $vo}
    <div class="col mb-4">
        <div class="card mb-3 h-100 shadow-sm">
            <img src="{$vo['cover']}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{$vo.title}</h5>
                <p class="card-text">{:mb_substr(strip_tags($vo['body']), 0, 200)}</p>
            </div>
            <div class="card-footer">
                <a href="{:$router->buildUrl('/xielei/manual/home/manual',['id'=>$vo['alias']?:$vo['id']])}" class="float-right">阅读</a>
                <small class="text-muted">{:format_date($vo['update_time'])}</small>
            </div>
        </div>
    </div>
    {/foreach}
</div>
{include /common/footer}