<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>欢迎登陆CRM系统管理平台</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link href="{{ asset('static/css/crm.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('static/js/jbox/skin/default/jbox.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('static/js/jquery-1.11.1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jquery.SuperSlide.2.1.2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jbox/jquery.jBox-2.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/common.js') }}"></script>
</head>
<body>
	<div class="crm-login">
		<div class="toplogo">CRM系统管理登录</div>
		@if (count($errors) > 0)
			<div class="error">{{ $errors->first() }}</div>
		@endif
		<form class="ajaxform" name="myform" method="post" action="{{ route('crm.login') }}">
			{!! csrf_field() !!}
			<ul>
				<li class="inpLi"><label>账 号：</label><input type="text" name="account" class="inpLogin" placeholder="请输入手机号码"></li>
				<li class="inpLi"><label>密 码：</label><input type="password" name="password" class="inpLogin"></li>
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
			$(".crm-login").find("input[name=username]").focus();
		});
	</script>
</body>
</html>