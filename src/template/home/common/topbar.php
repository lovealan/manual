<div class="row mt-3">
    <div class="col-md-3">
        <img src="{$manual.cover}" class="img-fluid img-thumbnail" alt="">
    </div>
    <div class="col-md-9">
        <h1>{$manual.title}</h1>
        <div class="text-muted">最近更新：{:date('Y-m-d H:i:s', $manual['update_time'])}</div>
        <div class="overflow-auto mt-2" style="max-height:200px;">
        </div>
    </div>
</div>
<hr>