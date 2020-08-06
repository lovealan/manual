{include /common/header}
{include /common/topbar}
<div class="row">
    <div class="col-md-3 h-100">
        {php}$cur_id=0;{/php}
        {include /common/navbar}
    </div>
    <div class="col-md-9">
        {foreach $posts as $vo}
        <div class="card my-2">
            <div class="card-body">
                <h5 class="card-title">
                    <a class="text-decoration-none stretched-link" href="{:$router->buildUrl('/xielei/manual/home/post', ['id'=>$vo['alias']?:$vo['id']])}">{:str_ireplace(htmlspecialchars($input->get('q')), '<strong><font color="#f00">'.htmlspecialchars($input->get('q')).'</font><strong>', htmlspecialchars($vo['title']))}</a>
                </h5>
                <div class="text-muted text-monospace">
                    {:str_ireplace(htmlspecialchars($input->get('q')), '<strong><font color="#f00">'.htmlspecialchars($input->get('q')).'</font><strong>', htmlspecialchars($vo['body']))}
                </div>
            </div>
        </div>
        {/foreach}
    </div>
</div>
{if $config->get('site.openslide@xielei.manual', 0)}
<script>
    $(document).ready(function() {
        $("details").attr("open", "open");
    });
</script>
{/if}
{include /common/footer}