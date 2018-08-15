@extends('layouts.mobile.app')

@section('content')
	<div class="wp" style="background: #fff">
		@if (isset($status) && $status)
			<div class="page msg_success js_show">
				<div class="weui-msg">
					<div class="weui-msg__icon-area">
						<i class="weui-icon-success weui-icon_msg"></i>
					</div>
					<div class="weui-msg__text-area">
						<h2 class="weui-msg__title">操作成功</h2>
						@if (isset($info) && $info)
						<p class="weui-msg__desc">{{ $info }}</p>
						@endif
					</div>
					<div class="weui-msg__opr-area">
						<p class="weui-btn-area">
							@if (isset($url) && $url)
								<a class="weui-btn weui-btn_primary" href="{{ $url }}">确定</a>
							@else
								<a class="weui-btn weui-btn_default" href="javascript:history.back(-1);">确定</a>
							@endif
						</p>
					</div>
				</div>
			</div>
		@else
			<div class="page msg_success js_show">
				<div class="weui-msg">
					<div class="weui-msg__icon-area">
						<i class="weui-icon-warn weui-icon_msg"></i>
					</div>
					<div class="weui-msg__text-area">
						<h2 class="weui-msg__title">操作失败</h2>
						@if (isset($info) && $info)
							<p class="weui-msg__desc">{{ $info }}</p>
						@endif
					</div>
					<div class="weui-msg__opr-area">
						<p class="weui-btn-area">
							@if (isset($url) && $url)
								<a class="weui-btn weui-btn_primary" href="{{ $url }}">确定</a>
							@else
								<a class="weui-btn weui-btn_default" href="javascript:history.back(-1);">确定</a>
							@endif
						</p>
					</div>
				</div>
			</div>
		@endif
	</div>
@endsection