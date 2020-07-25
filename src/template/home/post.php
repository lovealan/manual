{include /common/header}
{include /common/topbar}
<div class="row">
    <div class="col-md-3">
        {php}$cur_id=$post['id'];{/php}
        {include /common/navbar}
    </div>
    <div class="col-md-9 content">
        <h1 class="mb-3">{$post.title}</h1>
        <div class="text-muted mb-3 px-1 pb-1 border-top bg-light"><small>最近更新：{:date('Y-m-d H:i:s', $post['update_time'])}</small></div>
        {$post['body']}
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".nav_current").parents("details").attr("open", "open");
    });
</script>
{include /common/footer}