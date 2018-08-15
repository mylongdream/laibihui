@extends('layouts.user.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('user.ordermeal') }}</h3></div>
	</div>
	@if (count($orders))
		<div class="order-list mtw">
			<div class="hd">
				<table width="100%">
					<tr>
						<th width="63%" align="center">{{ trans('user.ordermeal.meal') }}</th>
						<th width="13%" align="center">{{ trans('user.ordermeal.order_amount') }}</th>
						<th width="12%" align="center">{{ trans('user.ordermeal.status') }}</th>
						<th width="12%" align="center">{{ trans('user.operation') }}</th>
					</tr>
				</table>
			</div>
			@foreach ($orders as $value)
				<div class="bd mtw">
					<table width="100%">
						<tr class="tr-th">
							<td colspan="5">
								<span class="dealtime">{{ $value->created_at->format('Y-m-d H:i:s') }}</span>
								<span class="ordersn">订单号：<a href="{{ route('user.ordercard.show', $value->order_sn) }}" title="订单详情" class="openwindow">{{ $value->order_sn }}</a></span>
							</td>
						</tr>
						@foreach ($value->records as $val)
							<tr class="tr-bd">
								<td width="63%" valign="top">
									<div class="s-item">
										<div class="s-pic">
											<img src="{{ uploadImage($val->upimage) }}" width="150" height="150">
										</div>
										<div class="s-info">
											<div class="s-name">
												{{ $val->name }}
											</div>
											<div class="s-extra">
												价格：{{ $val->price }}
											</div>
											<div class="s-extra">
												数量：{{ $val->number }}
											</div>
										</div>
									</div>
								</td>
								@if ($loop->iteration == 1)
									<td width="13%" align="center" {!! $value->records->count() > 1 ? 'rowspan="'.$value->records->count().'"' : '' !!}>
										<p><strong>￥{{ sprintf("%.2f",$value->order_amount) }}</strong></p>
									</td>
									<td width="12%" align="center" {!! $value->records->count() > 1 ? 'rowspan="'.$value->records->count().'"' : '' !!}>
										<p class="order-status">{{ $value->order_status }}</p>
										<p><a href="{{ route('user.ordercard.show', $value->order_sn) }}" title="订单详情" class="openwindow">订单详情</a></p>
									</td>
									<td width="12%" align="center" {!! $value->records->count() > 1 ? 'rowspan="'.$value->records->count().'"' : '' !!}>
										@if ($value->ifpay == 0)
											<a href="{{ route('brand.card.pay', $value->order_sn) }}" target="_blank" title="立即付款" class="btn-pay">立即付款</a>
										@else
											@if ($value->shop)
												<a href="{{ route('brand.shop.show', $value->shop->id) }}" target="_blank" title="再次消费" class="btn-again">再次消费</a>
											@endif
										@endif
									</td>
								@endif
							</tr>
						@endforeach
					</table>
				</div>
			@endforeach
		</div>
		{!! $orders->links() !!}
	@else
		<div class="tblist mtw">
			<table>
				<tr>
					<td colspan="3" class="nodata">暂无数据</td>
				</tr>
			</table>
		</div>
	@endif
@endsection