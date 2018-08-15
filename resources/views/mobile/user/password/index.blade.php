@extends('layouts.mobile.app')

@section('content')
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav">密码修改</div>
				</div>
				<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('mobile.user.password.update') }}">
					{!! method_field('PUT') !!}
					{!! csrf_field() !!}
					<div class="weui-cells weui-cells_form">
						<div class="weui-cell">
							<div class="weui-cell__hd"><label class="weui-label">原密码</label></div>
							<div class="weui-cell__bd">
								<input class="weui-input" name="oldpassword" placeholder="请输入原密码" type="text">
							</div>
						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd"><label class="weui-label">新密码</label></div>
							<div class="weui-cell__bd">
								<input class="weui-input" name="newpassword" placeholder="请输入新密码" type="password">
							</div>
						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd"><label class="weui-label">确认密码</label></div>
							<div class="weui-cell__bd">
								<input class="weui-input" name="newpassword_confirmation" placeholder="请确认新输入密码" type="password">
							</div>
						</div>
					</div>
					<div class="weui-btn-area">
						<button name="applybtn" type="button" class="weui-btn weui-btn_primary ajaxsubmit">提 交</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection