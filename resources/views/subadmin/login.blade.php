<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>欢迎登陆网站后台管理平台</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link href="{{ asset('static/css/admin.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('static/js/jquery-1.8.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jquery.form.js') }}"></script>
	<script type="text/javascript" src="{{ asset('static/js/admin.js') }}"></script>
	<script type="text/javascript" src="{{ asset('static/js/jbox/jquery.jBox-2.3.min.js') }}"></script>
	<link type="text/css" rel="stylesheet" href="{{ asset('static/js/jbox/skin/green/jbox.css') }}"/>
</head>
<body>
	<div id="login">
		<div class="toplogo">网站后台管理登录</div>
		@if (count($errors) > 0)
			<div class="error">{{ $errors->first() }}</div>
		@endif
		<form class="ajaxform" name="myform" method="post" action="{{ route('admin.login') }}">
			{!! csrf_field() !!}
			<ul>
				<li class="inpLi"><label>用户名：</label><input type="text" name="username" class="inpLogin"></li>
				<li class="inpLi"><label>密码：</label><input type="password" name="password" class="inpLogin"></li>
				<li class="verifypic">
					<div class="inpLi"><label>验证码：</label><input type="text" name="verify" class="verify"></div>
					<img class="verify-img reloadverify" src="{{captcha_src()}}" alt="启用验证码" title="看不清？点击更换另一个验证码。">
				</li>
				<li><input type="submit" name="submit" class="btnLogin" value="登  录"></li>
			</ul>
		</form>
	</div>
    <script type="text/javascript">
		$(function(){
			//初始化选中用户名输入框
			$("#login").find("input[name=username]").focus();
		});
	</script>
</body>
</html>