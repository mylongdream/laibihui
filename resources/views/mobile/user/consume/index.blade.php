@extends('layouts.mobile.app')

@section('content')
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav">{{ trans('user.consume') }}</div>
				</div>
				@foreach ($consumes as $value)
					<div class="weui-panel panel-item">
						<div class="weui-panel__hd">
							<div class="z">订单号：{{ $value->order_sn }}</div>
						</div>
						<div class="weui-panel__bd">
							<a href="{{ route('mobile.brand.shop.show', $value->shop->id) }}" class="weui-media-box weui-media-box_appmsg">
								<div class="weui-media-box__hd">
									<img class="weui-media-box__thumb" src="{{ uploadImage($value->shop->upimage) }}" alt="">
								</div>
								<div class="weui-media-box__bd">
									<h4 class="weui-media-box__title">{{ $value->shop ? $value->shop->name : '/' }}</h4>
									<p class="weui-media-box__desc">电话：{{ $value->shop ? $value->shop->phone : '/' }}</p>
									<p class="weui-media-box__desc">地址：{{ $value->shop ? $value->shop->address : '/' }}</p>
								</div>
							</a>
						</div>
                        <div class="weui-panel__ft">
                            <div class="z status">状态：{{ trans('user.consume.status_'.$value->pay_status) }}</div>
                            <div class="y">
                                @if ($value->pay_status == 0)
                                    <a href="{{ route('mobile.user.consume.pay', $value->order_sn) }}" title="立即付款" class="btn-pay">立即付款</a>
                                @else
                                    @if ($value->shop)
                                        <a href="{{ route('mobile.brand.shop.show', $value->shop->id) }}" title="再次消费" class="btn-again">再次消费</a>
                                    @endif
                                @endif
                                    <a href="{{ route('mobile.user.consume.show', $value->order_sn) }}" title="订单详情" class="mlm">订单详情</a>
                            </div>
                        </div>
					</div>
				@endforeach
				{!! $consumes->links() !!}
			</div>
		</div>
	</div>
@endsection
