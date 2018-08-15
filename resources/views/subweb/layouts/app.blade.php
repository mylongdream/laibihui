<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:ds="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $setting['bbname'] or '' }}</title>
    <meta name="description" content="{{ $setting['bbname'] or '' }}">
    <meta name="keywords" content="{{ $setting['bbname'] or '' }}">
    <link href="{{ asset('static/css/common.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('static/css/module.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('static/js/jquery-1.8.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jquery.form.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jquery.SuperSlide.2.1.2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/layer/layer.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/common.js') }}"></script>
</head>
<body>
<div id="toptb" class="cl">
    <div class="wp">
        <div class="map">
            <span class="current">{{ $subweb->name }}</span>
            <span class="change"><a href="{{ route('page.allcity') }}">【切换城市】</a></span>
        </div>
        <div class="link">
            <a href="{{ route('login') }}" title="请登录">请登录</a>
            <span class="pipe">|</span>
            <a href="{{ route('register') }}" title="免费注册">免费注册</a>
            <span class="pipe">|</span>
            <a href="http://www.mjbang.cn/package.html" title="我要装修">我要装修</a>
            <span class="pipe">|</span>
            <span class="tel">咨询热线：4000-777-051</span>
        </div>
    </div>
</div>
<div class="hdc cl">
    <div class="wp">
        <h1 class="logo">
            <a title="快乐装修网" href="{{ route('subweb.index', $subweb->domain) }}"><img border="0" alt="快乐装修网" src="{{ asset('static/image/common/logo.png') }}"></a>
        </h1>
        <ul class="info">
            <li class="sub1">免费量房验房设计</li>
            <li class="sub2">监督检察院质量跟踪</li>
        </ul>
    </div>
</div>
<div id="nv" class="cl">
    <div class="wp">
        <ul>
            <li class="a">
                <a title="首页" hidefocus="true" href="{{ route('subweb.index', $subweb->domain) }}">首页</a>
            </li>
            <li>
                <a title="装修套餐" hidefocus="true" href="{{ route('page.package') }}">装修套餐</a>
            </li>
            <li>
                <a title="特权卡" hidefocus="true" href="{{ route('page.tequanka') }}">特权卡</a>
            </li>
            <li>
                <a title="工地直播" hidefocus="true" href="{{ route('subweb.worksite.index', $subweb->domain) }}">工地直播</a>
            </li>
            <li>
                <a title="装修栏目" hidefocus="true" href="{{ route('video.index') }}">装修栏目</a>
            </li>
            <li>
                <a title="才通天下" hidefocus="true" href="{{ route('page.cttx') }}">才通天下</a>
            </li>
            <li>
                <a title="家装案例" hidefocus="true" href="{{ route('subweb.case.index', $subweb->domain) }}">家装案例</a>
            </li>
            <li>
                <a title="设计团队" hidefocus="true" href="{{ route('subweb.designer.index', $subweb->domain) }}">设计团队</a>
            </li>
            <li>
                <a title="工地直播" hidefocus="true" href="{{ route('subweb.community.index', $subweb->domain) }}">热装小区</a>
            </li>
        </ul>
    </div>
</div>
<div class="main-content cl">
    @yield('content')
</div>
@include('subweb.layouts.footer')
</body>
</html>