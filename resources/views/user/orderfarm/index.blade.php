@extends('layouts.user.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('user.orderfarm') }}</h3></div>
	</div>
	@if (count($orders))
		<div class="order-list mtw">
			<div class="hd">
				<table width="100%">
					<tr>
						<th width="52%" align="center">{{ trans('user.orderfarm.farm_name') }}</th>
                        <th width="10%" align="center">{{ trans('user.orderfarm.package_name') }}</th>
						<th width="14%" align="center">{{ trans('user.orderfarm.order_amount') }}</th>
						<th width="12%" align="center">{{ trans('user.orderfarm.status') }}</th>
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
								<span class="ordersn">订单号：<a href="{{ route('user.orderfarm.show', $value->order_sn) }}" title="订单详情" class="openwindow">{{ $value->order_sn }}</a></span>
							</td>
						</tr>
						<tr class="tr-bd">
							<td width="52%" valign="top">
								@if ($value->farm)
									<div class="s-item">
										<div class="s-pic">
											<a href="{{ route('brand.farm.show', $value->farm->id) }}" target="_blank" title="{{ $value->farm->name }}">
												<img src="{{ uploadImage($value->farm->upimage) }}" width="150" height="150">
											</a>
										</div>
										<div class="s-info">
											<div class="s-name">
												<a href="{{ route('brand.farm.show', $value->farm->id) }}" target="_blank" title="{{ $value->farm->name }}">{{ $value->farm->name }}</a>
											</div>
											<div class="s-extra">
												电话：{{ $value->farm->phone }}
											</div>
											<div class="s-extra">
												地址：{{ $value->farm->address }}
											</div>
										</div>
									</div>
								@else
									/
								@endif
							</td>
                            <td width="10%" align="center">{{ $value->package_name }}</td>
							<td width="14%" align="center">
								<p><strong>￥{{ sprintf("%.2f",$value->order_amount) }}</strong></p>
                            </td>
							<td width="12%" align="center">
								<p class="order-status">{{ trans('user.orderfarm.status_'.$value->order_status.$value->pay_status) }}</p>
								<p><a href="{{ route('user.orderfarm.show', $value->order_sn) }}" title="订单详情" class="openwindow">订单详情</a></p>
							</td>
							<td width="12%" align="center">
								@if ($value->order_status == 0 && $value->pay_status == 0)
									<a href="{{ route('brand.farm.pay', $value->order_sn) }}" target="_blank" title="立即付款" class="btn-pay">立即付款</a>
									<a href="{{ route('user.orderfarm.cancel', $value->order_sn) }}" title="取消订单" class="mtm btn-again ajaxget confirmbtn">取消订单</a>
								@endif
							</td>
						</tr>
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