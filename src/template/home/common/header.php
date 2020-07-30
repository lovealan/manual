<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{$meta['title']??''}</title>
    <meta name="keywords" content="{$meta['keywords']??''}" />
    <meta name="description" content="{$meta['description']??''}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" integrity="sha256-aAr2Zpq8MZ+YA/D6JtRD3xtrwpEz2IqOS+pWD/7XKIw=" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js" integrity="sha256-Xt8pc4G0CdcRvI0nZ2lRpZ4VHng0EoUDMlGcBSQ9HiQ=" crossorigin="anonymous"></script>
    <script>
        $(function() {
            $(".content table").addClass("table");
            $(".content a").addClass("px-2").append(' <svg t="1595730969467" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3841" width="15" height="15"><path d="M719.168 207.168L576 64h384v384l-150.272-150.272-264.128 264.064-90.496-90.496 264.064-264.128zM192 960H64V64h384v128H192v640h640V576h128v384H192z" fill="#007bff" p-id="3842"></path></svg>').attr('target','_blank');
            $.each($(".content code"), function(index, ele) {
                if ($(ele).parents("pre").length == 0) {
                    $(ele).addClass("mx-1");
                }
            });
        });
    </script>
</head>

<?php
function format_date($time){
    $t=time()-$time;
    $f=array(
        '31536000'=>'年',
        '2592000'=>'个月',
        '604800'=>'星期',
        '86400'=>'天',
        '3600'=>'小时',
        '60'=>'分钟',
        '1'=>'秒'
    );
    foreach ($f as $k=>$v)    {
        if (0 !=$c=floor($t/(int)$k)) {
            return $c.$v.'前';
        }
    }
    return '一天内';
}
?>

<body>
    <div class="container-lg">