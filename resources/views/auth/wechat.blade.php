<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:ds="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $setting['seo_title'] or '' }}{{ $setting['sitename'] ? ' - '.$setting['sitename'] : '' }}</title>
    <meta name="description" content="{{ $setting['seo_keywords'] or '' }}">
    <meta name="keywords" content="{{ $setting['seo_description'] or '' }}">
    <link href="{{ asset('static/css/common.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('static/css/module.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('static/js/jbox/skin/default/jbox.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('static/js/jquery-1.11.1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jquery.SuperSlide.2.1.2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jbox/jquery.jBox-2.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/common.js') }}"></script>
    <style type="text/css">
        body{background-color: rgb(51, 51, 51); padding: 50px;}
    </style>
</head>
<body>
<div class="wechat-login">
    <div class="hd">微信登录</div>
    <div class="bd">
        <div class="qrcode"><img id="wechatQrcode" border="0" alt="" src="{{ $qrcode }}"></div>
        <div class="info">
            <div class="status">
                <p>请使用微信扫描二维码登录</p>
                <p>“{{ $setting['sitename'] }}”</p>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        function loadwechatLogin(url){
            $.post(url,function(data){
                if(data.status === 2){
                    $('#wechatQrcode').html(data.qrcode);
                    window.setTimeout(function(){loadwechatLogin(data.checkurl);},200);
                }else if(data.status === 1){
                    window.location.href = '{{ request('ReturnUrl') ? request('ReturnUrl') : route('index') }}';
                }else{
                    window.setTimeout(function(){loadwechatLogin(url);},200);
                }
            });
        }
        loadwechatLogin('{{ $checkurl }}');
    });
</script>
</body>
</html>