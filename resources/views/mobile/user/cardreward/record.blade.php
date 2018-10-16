@extends('layouts.mobile.app')

@section('content')
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav">{{ trans('user.score.transfer') }}</div>
				</div>
				<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('mobile.user.score.transfer') }}">
					{!! csrf_field() !!}
					<div class="weui-panel" style="margin: 0">
						<div class="weui-msg">
							<div class="weui-msg__text-area">
								<h2 class="weui-msg__title">当前<span style="font-size: 36px;margin: 0 10px">{{ auth()->user()->score }}</span>个积分</h2>
							</div>
						</div>
					</div>
					<div class="weui-cells pay-money">
						<div class="weui-cell">
							<div class="weui-cell__hd"><label class="weui-label">转让积分</label></div>
							<div class="weui-cell__bd">
								<input class="weui-input numeric" type="number" name="amount" value="1" id="amount-input" data-max="{{ auth()->user()->score > 0 ? auth()->user()->score : 1 }}">
							</div>
							<div class="weui-cell__ft">个</div>
						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd"><label for="" class="weui-label">对方账户</label></div>
							<div class="weui-cell__bd">
								<input class="weui-input" value=""  placeholder="用户名/手机号码" type="text" name="account">
							</div>
						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd"><label for="" class="weui-label">转让说明</label></div>
							<div class="weui-cell__bd">
								<input class="weui-input" value="" placeholder="" type="text" name="message">
							</div>
						</div>
					</div>
					<div class="weui-cells order-submit">
						<div class="order-btn">
							@if (auth()->user()->score > 0)
								<button name="applybtn" type="button" class="weui-btn weui-btn_primary ajaxsubmit">转 让</button>
							@else
								<button name="applybtn" type="button" class="weui-btn weui-btn_default">无法转让</button>
							@endif
						</div>
						<div class="order-remark">
							注：<span>请确保对方账户正确后再转让</span>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
