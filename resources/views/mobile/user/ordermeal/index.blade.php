@extends('layouts.mobile.app')

@section('content')
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav">{{ trans('user.ordermeal') }}</div>
				</div>
				<div class="weui-tab" id="tab">
					<div class="weui-navbar tab_box">
						<div class="weui-navbar__item weui-bar__item_on">
							<a href="{{ route('mobile.user.ordermeal.index', ['status' => request('status')]) }}" class="">
								<div class="title">全部订单</div>
							</a>
						</div>
						<div class="weui-navbar__item">
							<a href="{{ route('mobile.user.ordermeal.index', ['status' => request('status')]) }}" class="">
								<div class="title">待付款</div>
							</a>
						</div>
						<div class="weui-navbar__item">
							<a href="{{ route('mobile.user.ordermeal.index', ['status' => request('status')]) }}" class="">
								<div class="title">已确认</div>
							</a>
						</div>
						<div class="weui-navbar__item">
							<a href="{{ route('mobile.user.ordermeal.index', ['status' => request('status')]) }}" class="">
								<div class="title">待评价</div>
							</a>
						</div>
					</div>
				@foreach ($orders as $value)
					<div class="weui-panel panel-item">
						<div class="weui-panel__hd">
							<div class="z">订单号：{{ $value->order_sn }}</div>
						</div>
						<div class="weui-panel__bd">
							@foreach ($value->records as $val)
							<a href="javascript:;" class="weui-media-box weui-media-box_appmsg">
								<div class="weui-media-box__hd">
                                    <img class="weui-media-box__thumb" src="{{ uploadImage($val->upimage) }}" alt="">
								</div>
                                <div class="weui-media-box__bd">
                                    <h4 class="weui-media-box__title">{{ $val->name or '/' }}</h4>
                                    <p class="weui-media-box__desc">价格：{{ $val->price }}</p>
                                    <p class="weui-media-box__desc">数量：{{ $val->number }}</p>
                                </div>
							</a>
							@endforeach
						</div>
                        <div class="weui-panel__ft">
                            <div class="z status">状态：{{ trans('user.ordermeal.status_'.$value->order_status.$value->pay_status) }}</div>
                            <div class="y">
                                @if ($value->ifpay == 0)
                                    <a href="{{ route('mobile.brand.card.pay', $value->order_sn) }}" title="立即付款" class="btn-pay">立即付款</a>
                                @else
                                    @if ($value->shop)
                                        <a href="{{ route('mobile.brand.shop.show', $value->shop->id) }}" title="再次消费" class="btn-again">再次消费</a>
                                    @endif
                                @endif
                                    <a href="{{ route('mobile.user.ordermeal.show', $value->order_sn) }}" title="订单详情" class="mlm">订单详情</a>
                            </div>
                        </div>
					</div>
				@endforeach
				{!! $orders->links() !!}
				</div>
			</div>
		</div>
	</div>
@endsection
