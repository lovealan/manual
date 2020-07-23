{include /common/header}
{include /common/topbar}
<div class="row">
    <div class="col-md-3">
        {php}$cur_id=$post['id'];{/php}
        {include /common/navbar}
    </div>
    <div class="col-md-9">
        <h1 class="mb-4">{$post.title}</h1>
        {$post['body']}
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".nav_current").parents("details").attr("open", "open");
    });
</script>
{include /common/footer}