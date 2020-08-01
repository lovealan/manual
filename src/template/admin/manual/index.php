{include /common/header}
<div class="my-4 display-4">手册管理</div>
<hr>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{:$router->buildUrl('/xielei/manual/admin/manual/index')}">手册管理</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data</li>
    </ol>
</nav>
<hr>
<script>
    function restate(id, state) {
        $.ajax({
            type: "POST",
            url: "{:$router->buildUrl('/xielei/manual/admin/manual/update')}",
            data: {
                id: id,
                state: state,
            },
            dataType: "JSON",
            success: function(response) {
                if (response.code) {
                    location.reload();
                } else {
                    alert(response.message);
                }
            }
        });
    }

    function deleteItem(id, title) {
        if (confirm("删除“" + title + "”\r\n此操作无法恢复，确定删除？")) {
            $.ajax({
                type: "POST",
                url: "{:$router->buildUrl('/xielei/manual/admin/manual/delete')}",
                data: {
                    id: id,
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.code) {
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                }
            });
        }
    }
</script>
<div class="table-responsive">
    <table class="table table-borderless table-sm">
        <tbody>
            {foreach $manuals as $vo}
            <tr>
                <td class="text-nowrap">
                    <svg t="1595426574921" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="5244" width="20" height="20">
                        <path d="M192 64c-35.3 0-64 28.7-64 64v768c0 35.3 28.7 64 64 64h704V64H192z m64 64v610h-17c-16.8 0-32.7 3.7-47 10.4V128h64z m-17 768c-25.9 0-47-21.1-47-47s21.1-47 47-47h593v94H239z m81-158V128h320v224l64-63.5 64 63.5V128h64v610H320z" p-id="5245"></path>
                    </svg>
                    <a href="{:$router->buildUrl('/xielei/manual/admin/post/index', ['manual_id'=>$vo['id']])}">{$vo.title}</a>
                </td>
                <td>
                    {if $vo['state']==1}
                    <a href="javascript:restate('{$vo.id}','2');" class="text-primary" title="点击切换">已公开</a>
                    {else}
                    <a href="javascript:restate('{$vo.id}','1');" class="text-warning" title="点击切换">未公开</a>
                    {/if}
                </td>
                <td class="text-nowrap">
                    <a href="{:$router->buildUrl('/xielei/manual/admin/manual/update', ['id'=>$vo['id']])}">设置</a>
                    <a href="javascript:deleteItem('{$vo.id}','{$vo.title}');">删除</a>
                    <a href="{:$router->buildUrl('/xielei/manual/home/manual', ['id'=>$vo['alias']?:$vo['id']])}" target="_blank">阅读</a>
                </td>
            </tr>
            {/foreach}
        </tbody>
    </table>
</div>
<a href="{:$router->buildUrl('/xielei/manual/admin/manual/create')}" class="btn btn-primary">创建手册</a>
{include /common/footer}