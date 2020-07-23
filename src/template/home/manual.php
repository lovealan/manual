{include /common/header}
{include /common/topbar}
<div class="row">
    <div class="col-md-3">
        {php}$cur_id=0;{/php}
        {include /common/navbar}
    </div>
    <div class="col-md-9">
        {$manual.body}
    </div>
</div>
<script>
    $(document).ready(function() {
        $("details").attr("open", "open");
    });
</script>
{include /common/footer}