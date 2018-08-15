@if (!request()->ajax())
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>网站后台管理平台</title>
    <link href="{{ asset('static/css/admin.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('static/js/jbox/skin/green/jbox.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('static/js/jquery-1.10.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jbox/jquery.jBox-2.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/laydate/laydate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/admin.js') }}"></script>
</head>
<body>
<!-- 头部 -->
<div class="headtop cl">
    <div class="logo"><h2>后台管理</h2></div>
    <div class="nav">
        <ul class="">
            @foreach ($topmenu as $tmenu)
                <li class="{{ $tmenu->current  ? 'a' : '' }}"><a href="{{ route($tmenu->route) }}">{{ $tmenu->title }}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="info">
        <ul class="">
            <li class="manager">你好，<em>{{ auth('admin')->user()->username }}</em></li>
            <li><a href="{{ route('admin.logout') }}" class="ajaxbtn">退出</a></li>
            <li><a href="{{ route('admin.updatecache') }}" class="ajaxbtn">更新缓存</a></li>
            <li><a href="{{ route('index') }}" target="_blank">网站首页</a></li>
        </ul>
    </div>
</div>
<!-- /头部 -->

<div class="mainbody cl">
    <!-- 边栏 -->
    <div class="sidebar">
        <div id="menuBar" class="menu_box">
            @foreach ($mainmenu->sortBy('displayorder') as $cmenu)
            <dl class="menu">
                @if ($cmenu->route)
                    <dd class="menu_item {{ $cmenu->current  ? 'a' : '' }}"><a href="{{ route($cmenu->route) }}">{{ $cmenu->title }}</a></dd>
                @else
                    <dt class="menu_title">{{ $cmenu->title }}</dt>
                    @foreach ($cmenu->children->sortBy('displayorder') as $smenu)
                    <dd class="menu_item {{ $smenu->current  ? 'a' : '' }}"><a href="{{ route($smenu->route) }}">{{ $smenu->title }}</a></dd>
                    @endforeach
                @endif
            </dl>
            @endforeach
        </div>
    </div>
    <!-- /边栏 -->

    <!-- 内容区 -->
    <div class="mainbar" id="main-content">
@endif
@if (request()->ajax())
    	<div class="ajaxmain">
@endif
        @yield('content')
@if (request()->ajax())
		</div>
@endif
@if (!request()->ajax())
    </div>
    <!-- /内容区 -->
</div>
@endif
@yield('script')
@if (!request()->ajax())
</body>
</html>
@endif