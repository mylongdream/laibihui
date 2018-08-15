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
    <link href="{{ asset('static/js/jbox/skin/default/jbox.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('static/js/jquery-1.8.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jquery.form.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jbox/jquery.jBox-2.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jquery.SuperSlide.2.1.2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/common.js') }}"></script>
</head>
<body>
<div class="shead cl">
    <div class="wp">
        <div class="z">
            <h1 class="logo">
                <a title="快乐装修网" href="{{ action('Home\IndexController@index') }}"><img border="0" alt="快乐装修网" src="{{ asset('static/image/common/logo.png') }}"></a>
            </h1>
            <div class="home"><a href="{{ route('index') }}">首页</a></div>
            <div class="nav trigger-hover">
                <div class="txt">
                    <span><i class="z"></i>导航<i class="y"></i></span>
                </div>
                <div class="sub">
                    <ul>
                        @foreach ($navs->where('type', 'headernav')->where('parentid', '0') as $nav)
                            <li>
                                <a href="{{ url($nav->url) }}" title="{{ $nav->title }}" hidefocus="true" @if ($nav->target) target="_blank" @endif>{{ $nav->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="y">
            @if(auth()->check())
                <div class="user trigger-hover">
                    <div class="txt">
                        <div class="info">
                            <div class="avtm z"><img width="20" height="20" src="http://uc.klzxw.com/avatar.php?uid=10529&size=small"></div>
                            <div class="username">{{auth()->user()->username}}</div>
                            <div class="arrow y"></div>
                        </div>
                    </div>
                    <div class="sub">
                        <ul>
                            <li>
                                <a title="个人中心" hidefocus="true" href="{{ route('page.package') }}">个人中心</a>
                            </li>
                            <li>
                                <a title="个人中心" hidefocus="true" href="{{ route('page.package') }}">个人中心</a>
                            </li>
                            <li>
                                <a title="个人中心" hidefocus="true" href="{{ route('page.package') }}">个人中心</a>
                            </li>
                            <li>
                                <a title="个人中心" hidefocus="true" href="{{ route('page.package') }}">个人中心</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="logout">
                    <a href="{{ route('logout') }}">退出</a>
                </div>
            @else
                <div class="login">
                    <a href="{{ route('login') }}">登录</a>
                </div>
                <div class="register">
                    <a href="{{ route('register') }}">注册</a>
                </div>
            @endif
        </div>
    </div>
</div>
<div class="main-content cl">
    @yield('content')
</div>
@include('home.layouts.footer')
</body>
</html>