@extends('layouts.mobile.app')

@section('content')
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav">{{ trans('user.orderfarm') }}</div>
				</div>
				<div class="weui-tab" id="tab">
					<div class="weui-navbar tab_box">
						<div class="weui-navbar__item weui-bar__item_on">
							<a href="{{ route('mobile.user.orderfarm.index', ['status' => request('status')]) }}" class="">
								<div class="title">全部订单</div>
							</a>
						</div>
						<div class="weui-navbar__item">
							<a href="{{ route('mobile.user.orderfarm.index', ['status' => request('status')]) }}" class="">
								<div class="title">待付款</div>
							</a>
						</div>
						<div class="weui-navbar__item">
							<a href="{{ route('mobile.user.orderfarm.index', ['status' => request('status')]) }}" class="">
								<div class="title">进行中</div>
							</a>
						</div>
						<div class="weui-navbar__item">
							<a href="{{ route('mobile.user.orderfarm.index', ['status' => request('status')]) }}" class="">
								<div class="title">已完成</div>
							</a>
						</div>
						<div class="weui-navbar__item">
							<a href="{{ route('mobile.user.orderfarm.index', ['status' => request('status')]) }}" class="">
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
							<div class="weui-cell">
								<div class="weui-cell__hd" style="margin-right: 10px;">
									<img src="{{ uploadImage($value->farm->upimage) }}" style="height: 50px;display: block">
								</div>
								<div class="weui-cell__bd">
									<p>{{ $value->farm->name }}</p>
									<p style="margin-top:5px;color:#999;font-size:14px">套餐：{{ $value->package_name }}</p>
								</div>
								<div class="weui-cell__ft">￥{{ $value->order_amount }}</div>
							</div>
						</div>
                        <div class="weui-panel__ft">
                            <div class="z status">状态：{{ trans('user.orderfarm.status_'.$value->order_status.$value->pay_status) }}</div>
                            <div class="y">
								@if ($value->order_status == 0 && $value->pay_status == 0)
                                    <a href="{{ route('mobile.brand.farm.pay', $value->order_sn) }}" title="立即付款" class="btn-pay">立即付款</a>
                                @endif
                                    <a href="{{ route('mobile.user.orderfarm.show', $value->order_sn) }}" title="订单详情" class="mlm">订单详情</a>
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
