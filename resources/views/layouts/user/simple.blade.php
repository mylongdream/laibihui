@if (!request()->ajax())
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
    <link href="{{ asset('static/css/user.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('static/js/jbox/skin/default/jbox.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('static/js/jquery-1.8.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jquery.SuperSlide.2.1.2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jbox/jquery.jBox-2.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/common.js') }}"></script>
</head>
<body>
@include('layouts.common.header_simple')
<div class="main-content cl">
    <div class="content-body">
        <div class="wp">
            <div class="container-box cl">
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
        </div>
    </div>
</div>
@yield('script')
@include('layouts.common.footer')
</body>
</html>
@endif