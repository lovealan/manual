{include /common/header}
{include /common/navbar}
<div class="row">
    <div class="col-md-3">
        {php}$cur_id=0;{/php}
        {include /common/navbar}
    </div>
    <div class="col-md-9">
        {foreach $posts as $vo}
        <div class="card my-2">
            <div class="card-body">
                <h5 class="card-title">
                    <a class="text-decoration-none stretched-link" href="{:$router->buildUrl('/xielei/manual/home/post', ['id'=>$vo['alias']?:$vo['id']])}">{$vo.title}</a>
                </h5>
                <div class="text-muted text-monospace">
                    {:mb_substr(strip_tags($vo['body']), 0, 200)}..
                </div>
            </div>
        </div>
        {/foreach}
    </div>
</div>
<script>
    $(document).ready(function() {
        $("details").attr("open", "open");
    });
</script>
{include /common/footer}