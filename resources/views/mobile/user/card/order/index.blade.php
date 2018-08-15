@extends('layouts.mobile.app')

@section('content')
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav">{{ trans('user.card.order') }}</div>
				</div>
				@foreach ($orders as $value)
					<div class="weui-panel panel-item">
						<div class="weui-panel__hd">
							<div class="z">订单号：{{ $value->order_sn }}</div>
						</div>
						<div class="weui-panel__bd">
							<a href="javascript:;" class="weui-media-box weui-media-box_appmsg">
								<div class="weui-media-box__hd">
									<img class="weui-media-box__thumb" src="{{ asset('static/image/common/getheadimg.jpg') }}" alt="">
								</div>
								<div class="weui-media-box__bd">
									<h4 class="weui-media-box__title">{{ $value->address->realname }} <span class="mlm">{{ $value->address->mobile }}</span></h4>
									<p class="weui-media-box__desc">{{ $value->address->getprovince ? $value->address->getprovince->name : '' }} {{ $value->address->getcity ? $value->address->getcity->name : '' }} {{ $value->address->getarea ? $value->address->getarea->name : '' }} {{ $value->address->getstreet ? $value->address->getstreet->name : '' }}</p>
									<p class="weui-media-box__desc">{{ $value->address->address }}</p>
								</div>
							</a>
						</div>
                        <div class="weui-panel__ft">
                            <div class="z status">状态：{{ trans('user.order.status_'.$value->ifpay) }}</div>
                            <div class="y">
                                @if ($value->ifpay == 0)
                                    <a href="{{ route('mobile.brand.card.pay', $value->order_sn) }}" title="立即付款" class="btn-pay">立即付款</a>
                                @else
                                    @if ($value->shop)
                                        <a href="{{ route('mobile.brand.shop.show', $value->shop->id) }}" title="再次消费" class="btn-again">再次消费</a>
                                    @endif
                                @endif
                                    <a href="{{ route('mobile.user.card.order.show', $value->order_sn) }}" title="订单详情" class="mlm">订单详情</a>
                            </div>
                        </div>
					</div>
				@endforeach
				{!! $orders->links() !!}
			</div>
		</div>
	</div>
@endsection
