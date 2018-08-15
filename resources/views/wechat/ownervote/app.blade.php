@if (!request()->ajax())
<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width,user-scalable=0,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="format-detection" content="telephone=no" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $meta_title or '' }}</title>
    <meta name="description" content="{{ $meta_description or '' }}">
    <meta name="keywords" content="{{ $meta_keywords or '' }}">
	<script>
		function w(){
			var BASE_WIDTH = 640, ROOT_FONT_SIZE = 100;
			var e = document.documentElement.getBoundingClientRect().width;
			e = e > BASE_WIDTH ? BASE_WIDTH : e;
			document.querySelector("html").style.fontSize = e / (BASE_WIDTH / ROOT_FONT_SIZE) + "px"
		}
		window.addEventListener("resize",function(){w()}),w()
	</script>
	@yield('style')
	<link href="{{ asset('static/css/weui.min.css?'.time()) }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('static/css/mobile.css?'.time()) }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('static/js/jquery-1.11.1.js') }}"></script>
	<script type="text/javascript" src="{{ asset('static/js/weui.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('static/js/fastclick.js') }}"></script>
	<script type="text/javascript" src="{{ asset('static/js/mobile.js?'.time()) }}"></script>
</head>
<body>
@endif
@yield('content')
@yield('script')
@if (!request()->ajax())
@section('share')
    @isset($sharedata)
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
    wx.config({{ $app->jssdk->buildConfig(array('onMenuShareQQ', 'onMenuShareWeibo'), true) }});
</script>
    @endisset
@show
</body>
</html>
@endif