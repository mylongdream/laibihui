@extends('layouts.mobile.app')

@section('content')
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav">{{ trans('user.promotion.card') }}</div>
				</div>
				<div class="tab_box">
					<div class="weui-flex">
						<div class="weui-flex__item {!! intval(request('lower')) == 0 ? 'weui-flex__item_on' : '' !!}">
							<a href="{{ route('mobile.user.promotion.card', ['lower' => 0]) }}" class="">
								<div class="title">一级下线</div>
							</a>
						</div>
						<div class="weui-flex__item {!! intval(request('lower')) == 1 ? 'weui-flex__item_on' : '' !!}">
							<a href="{{ route('mobile.user.promotion.card', ['lower' => 1]) }}" class="">
								<div class="title">二级下线</div>
							</a>
						</div>
					</div>
				</div>
                @foreach ($promotions as $value)
                    <div class="weui-panel panel-item">
                        <div class="weui-panel__bd">
                            <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
                                <div class="weui-media-box__hd">
                                    <img class="weui-media-box__thumb" src="{{ $value->user && $value->user->headimgurl ? uploadImage($value->user->headimgurl) : asset('static/image/common/getheadimg.jpg') }}" alt="">
                                </div>
                                <div class="weui-media-box__bd">
                                    <h4 class="weui-media-box__title">{{ $value->user ? $value->user->username : '/' }}</h4>
                                    <p class="weui-media-box__desc">手机：{{ $value->user ? $value->user->mobile : '/' }}</p>
                                    <p class="weui-media-box__desc">时间：{{ $value->created_at->format('Y-m-d H:i') }}</p>
                                </div>
                            </a>
                        </div>
                        <div class="weui-panel__ft">
                            <div class="z status">状态：已开卡</div>
                        </div>
                    </div>
                @endforeach
                {!! $promotions->appends(['lower' => request('lower')])->links() !!}
			</div>
		</div>
	</div>
@endsection