@extends('layouts.mobile.app')

@section('content')
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav">{{ trans('user.promotion.first') }}</div>
				</div>
                @foreach ($promotions as $value)
                    <div class="weui-panel panel-item">
                        <div class="weui-panel__bd">
                            <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
                                <div class="weui-media-box__hd">
                                    <img class="weui-media-box__thumb" src="{{ $value->headimgurl ? uploadImage($value->headimgurl) : asset('static/image/common/getheadimg.jpg') }}" alt="">
                                </div>
                                <div class="weui-media-box__bd">
                                    <h4 class="weui-media-box__title">{{ $value->username ? $value->username : '/' }}</h4>
                                    <p class="weui-media-box__desc">手机：{{ $value->mobile ? $value->mobile : '/' }}</p>
                                    <p class="weui-media-box__desc">时间：{{ $value->created_at->format('Y-m-d H:i') }}</p>
                                </div>
                            </a>
                        </div>
                        <div class="weui-panel__ft">
                            <div class="z status">状态：{{ $value->card ? '已开卡' : '未开卡' }}</div>
                        </div>
                    </div>
                @endforeach
                {!! $promotions->links() !!}
			</div>
		</div>
	</div>
@endsection