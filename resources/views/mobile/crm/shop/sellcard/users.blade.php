@extends('layouts.mobile.app')

@section('content')
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav">卖卡人员</div>
				</div>
				@foreach ($users as $value)
					<div class="weui-panel panel-item">
						<div class="weui-panel__bd">
							<a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
								<div class="weui-media-box__hd">
									<img class="weui-media-box__thumb" src="{{ $value->user->headimgurl ? uploadImage($value->user->headimgurl) : asset('static/image/common/getheadimg.jpg') }}" alt="">
								</div>
								<div class="weui-media-box__bd">
									<h4 class="weui-media-box__title">{{ $value->user->username ? $value->user->username : '/' }}</h4>
									<p class="weui-media-box__desc">手机：{{ $value->user->mobile ? $value->user->mobile : '/' }}</p>
									<p class="weui-media-box__desc">时间：{{ $value->created_at->format('Y-m-d H:i') }}</p>
								</div>
							</a>
						</div>
					</div>
				@endforeach
				{!! $users->links() !!}
			</div>
		</div>
	</div>
@endsection