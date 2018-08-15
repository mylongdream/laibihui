@extends('layouts.user.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('user.consume') }}</h3></div>
	</div>
	@if (count($consumes))
		<div class="order-list mtw">
			<div class="hd">
				<table width="100%">
					<tr>
						<th width="56%" align="center">{{ trans('user.consume.shop') }}</th>
						<th width="10%" align="center">消费金额</th>
						<th width="10%" align="center">应付金额</th>
						<th width="12%" align="center">{{ trans('user.consume.status') }}</th>
						<th width="12%" align="center">{{ trans('user.operation') }}</th>
					</tr>
				</table>
			</div>
			@foreach ($consumes as $value)
				<div class="bd mtw">
					<table width="100%">
						<tr class="tr-th">
							<td colspan="5">
								<span class="dealtime">{{ $value->created_at->format('Y-m-d H:i:s') }}</span>
								<span class="ordersn">订单号：<a href="{{ route('user.consume.show', $value->order_sn) }}" title="订单详情" class="openwindow">{{ $value->order_sn }}</a></span>
							</td>
						</tr>
						<tr class="tr-bd">
							<td width="66%" valign="top">
								@if ($value->shop)
									<div class="s-item">
										<div class="s-pic">
											<a href="{{ route('brand.shop.show', $value->shop->id) }}" target="_blank" title="{{ $value->shop->name }}">
												<img src="{{ uploadImage($value->shop->upimage) }}" width="150" height="150">
											</a>
										</div>
										<div class="s-info">
											<div class="s-name">
												<a href="{{ route('brand.shop.show', $value->shop->id) }}" target="_blank" title="{{ $value->shop->name }}">{{ $value->shop->name }}</a>
											</div>
											<div class="s-extra">
												电话：{{ $value->shop->phone }}
											</div>
											<div class="s-extra">
												地址：{{ $value->shop->address }}
											</div>
										</div>
									</div>
								@else
									/
								@endif
							</td>
							<td width="10%" align="center">
								<p><strong>￥{{ sprintf("%.2f",$value->consume_money) }}</strong></p>
							</td>
							<td width="10%" align="center">
								<p><strong>￥{{ sprintf("%.2f",$value->order_amount) }}</strong></p>
							</td>
							<td width="12%" align="center">
								<p class="order-status">{{ trans('user.consume.status_'.$value->pay_status) }}</p>
								<p><a href="{{ route('user.consume.show', $value->order_sn) }}" title="订单详情" class="openwindow">订单详情</a></p>
							</td>
							<td width="12%" align="center">
								@if ($value->pay_status == 0)
									<a href="{{ route('user.consume.pay', $value->order_sn) }}" target="_blank" title="立即付款" class="btn-pay">立即付款</a>
								@else
									@if ($value->shop)
										<a href="{{ route('brand.shop.show', $value->shop->id) }}" target="_blank" title="再次消费" class="btn-again">再次消费</a>
									@endif
								@endif
							</td>
						</tr>
					</table>
				</div>
			@endforeach
		</div>
		{!! $consumes->links() !!}
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