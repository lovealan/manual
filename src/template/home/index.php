{include /common/header}
<?php
$manuals = $manualModel->select('*', [
    'ORDER' => [
        'id' => 'ASC',
    ],
    'state' => 1,
]);
?>
<div class="my-4 d-inline-block display-4 font-weight-bold text-secondary text-monospace">手册中心</div>
<div class="row row-cols-1 row-cols-md-2">
    {foreach $manuals as $vo}
    <div class="col mb-4">
        <div class="card h-100">
            <div class="row no-gutters">
                <div class="col-md-4">
                    {if $vo['cover']}
                    <img src="{$vo.cover}" class="card-img p-2" alt="...">
                    {else}
                    <div class="text-center pt-5 display-4 text-secondary">无图</div>
                    {/if}
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title text-muted"><a href="{:$router->buildUrl('/xielei/manual/home/manual',['id'=>$vo['alias']?:$vo['id']])}" class="stretched-link text-primary" target="_blank">{$vo.title}</a></h5>
                        <hr>
                        <p class="card-text">{:mb_substr(strip_tags($vo['body']), 0, 50)}</p>
                        <div class="text-secondary">最近更新：<code>{:format_date($vo['update_time'])}</code></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {/foreach}
</div>
{include /common/footer}