<form class="mt-2" action="{:$router->buildUrl('/xielei/manual/home/search', ['manual_id'=>$manual['alias']?:$manual['id']])}" method="GET">
    <div class="input-group mb-3">
        <input type="text" name="q" value="{:$input->get('q')}" class="form-control" placeholder="请输入搜索词" aria-label="请输入搜索词" aria-describedby="search_btn">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit" id="search_btn">搜索</button>
        </div>
    </div>
</form>
<div class="bg-light py-3">
<div class="bg-light mb-1 px-3">
    <svg t="1595426574921" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="5244" width="20" height="20">
        <path d="M192 64c-35.3 0-64 28.7-64 64v768c0 35.3 28.7 64 64 64h704V64H192z m64 64v610h-17c-16.8 0-32.7 3.7-47 10.4V128h64z m-17 768c-25.9 0-47-21.1-47-47s21.1-47 47-47h593v94H239z m81-158V128h320v224l64-63.5 64 63.5V128h64v610H320z" p-id="5245"></path>
    </svg>
    <a href="{:$router->buildUrl('/xielei/manual/home/manual',['id'=>$manual['alias']?:$manual['id']])}" class="font-weight-bold">{$manual.title}</a>
</div>
{function mulu($model, $manual_id, $pid, $cur_id, $router)}
<?php
$datas = $model->select('*', [
    'manual_id' => $manual_id,
    'pid' => $pid,
    'state' => 1,
    'ORDER' => [
        // 'type' => 'ASC',
        'rank' => 'DESC',
        'id' => 'ASC'
    ],
]);
?>
<ul class="pl-3 mb-0" style="list-style:none;">
    {if $datas}
    {foreach $datas as $vo}
    <li class="mt-1" style="list-style:none;">
        {if $vo['type'] == 1}
        <details>
            <summary>{$vo.title}</summary>
            {:mulu($model, $manual_id, $vo['id'], $cur_id, $router)}
        </details>
        {else}
        <svg t="1595425699202" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4212" width="20" height="20">
            <path d="M288 320h448a32 32 0 0 0 0-64H288a32 32 0 0 0 0 64zM288 544h448a32 32 0 0 0 0-64H288a32 32 0 0 0 0 64zM544 704H288a32 32 0 0 0 0 64h256a32 32 0 0 0 0-64z" p-id="4213" fill="#aaa"></path>
            <path d="M896 132.928C896 77.28 851.552 32 796.928 32H227.04C172.448 32 128 77.28 128 132.928v758.144C128 946.72 172.448 992 227.04 992h435.008c1.568 0 2.912-0.672 4.416-0.896 8.96 1.6 18.464-0.256 25.984-6.528l192-160a31.424 31.424 0 0 0 10.816-27.2c0.16-1.184 0.736-2.208 0.736-3.424V132.928zM192 891.072V132.928C192 112.576 207.712 96 227.04 96h569.888C816.288 96 832 112.576 832 132.928V736h-96a96 96 0 0 0-96 96v96H227.04C207.712 928 192 911.424 192 891.072zM814.016 800L704 891.68V832a32 32 0 0 1 32-32h78.016z" p-id="4214" fill="#aaa"></path>
        </svg>
        <a href="{:$router->buildUrl('/xielei/manual/home/post',['id'=>$vo['alias']?:$vo['id']])}" class="{if $vo['id']==$cur_id}text-primary nav_current{else}text-secondary{/if}">{$vo.title}</a>
        {/if}
    </li>
    {/foreach}
    {else}
    <li class="text-muted">(空)</li>
    {/if}
</ul>
{/function}
{:mulu($postModel, $manual['id'], 0, $cur_id, $router)}
</div>