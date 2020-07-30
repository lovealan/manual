{include /common/header}
{include /common/topbar}
<div class="row">
    <div class="col-md-3 h-100">
        {php}$cur_id=0;{/php}
        {include /common/navbar}
    </div>
    <div class="col-md-9 content">
        <h1 class="mb-3">{$manual.title}</h1>
        <div class="text-muted mb-3 px-1 pb-1 border-top bg-light"><small>最近更新：{:format_date($manual['update_time'])}</small></div>
        {$manual.body}
    </div>
</div>
<script>
    $(document).ready(function() {
        $("details").attr("open", "open");
    });
</script>
{include /common/footer}