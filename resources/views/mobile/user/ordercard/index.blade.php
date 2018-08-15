@extends('layouts.mobile.app')

@section('content')
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav">{{ trans('user.ordercard') }}</div>
				</div>
				@foreach ($orders as $value)
					<div class="weui-panel panel-item">
						<div class="weui-panel__hd">
							<div class="z">订单号：{{ $value->order_sn }}</div>
						</div>
						<div class="weui-panel__bd">
							<div class="weui-cell">
								<div class="weui-cell__hd" style="margin-right: 10px;">
									<img src="{{ asset('static/image/mobile/card.jpg') }}" style="height: 50px;display: block">
								</div>
								<div class="weui-cell__bd">
									<p>知惠网联名卡</p>
									<p style="margin-top:5px;color:#999;font-size:14px">办卡方式：{{ trans('user.ordercard.order_type_'.$value->order_type) }}</p>
								</div>
								<div class="weui-cell__ft">￥10.00</div>
							</div>
						</div>
                        <div class="weui-panel__ft">
                            <div class="z status">状态：{{ trans('user.ordercard.status_'.$value->order_status.$value->shipping_status.$value->pay_status) }}</div>
                            <div class="y">
								@if ($value->order_status == 0 && $value->shipping_status == 0 && $value->pay_status == 0)
                                    <a href="{{ route('mobile.brand.card.pay', $value->order_sn) }}" title="立即付款" class="btn-pay">立即付款</a>
                                @endif
                                    <a href="{{ route('mobile.user.ordercard.show', $value->order_sn) }}" title="订单详情" class="mlm">订单详情</a>
                            </div>
                        </div>
					</div>
				@endforeach
				{!! $orders->links() !!}
			</div>
		</div>
	</div>
@endsection
