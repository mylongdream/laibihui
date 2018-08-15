@extends('layouts.user.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('user.card.order') }}</h3></div>
	</div>
	@if (count($orders))
		<div class="order-list mtw">
			<div class="hd">
				<table width="100%">
					<tr>
						<th width="53%" align="center">{{ trans('user.card.order.consignee') }}</th>
                        <th width="10%" align="center">{{ trans('user.card.order.order_type') }}</th>
						<th width="13%" align="center">{{ trans('user.card.order.order_amount') }}</th>
						<th width="12%" align="center">{{ trans('user.card.order.status') }}</th>
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
								<span class="ordersn">订单号：<a href="{{ route('user.card.order.show', $value->order_sn) }}" title="订单详情" class="openwindow">{{ $value->order_sn }}</a></span>
							</td>
						</tr>
						<tr class="tr-bd">
							<td width="53%" valign="top">
                                <div class="s-item">
                                    <div class="s-pic">
                                            <img src="{{ asset('static/image/common/getheadimg.jpg') }}" width="150" height="150">
                                    </div>
                                    <div class="s-info">
                                        <div class="s-name">
                                            {{ $value->address->realname }} <span class="mlm">{{ $value->address->mobile }}</span>
                                        </div>
                                        <div class="s-extra">
                                            {{ $value->address->getprovince ? $value->address->getprovince->name : '' }} {{ $value->address->getcity ? $value->address->getcity->name : '' }} {{ $value->address->getarea ? $value->address->getarea->name : '' }} {{ $value->address->getstreet ? $value->address->getstreet->name : '' }}
                                        </div>
                                        <div class="s-extra">
                                            {{ $value->address->address }}
                                        </div>
                                    </div>
                                </div>
							</td>
                            <td width="10%" align="center">{{ trans('user.card.order.order_type_'.$value->order_type) }}</td>
							<td width="13%" align="center">
                                <p>{{ $value->order_amount }} 元</p>
                                <p style="color:#6c6c6c;margin-top: 8px">(含运费：{{ $value->shipping_fee }} 元)</p>
                            </td>
							<td width="12%" align="center">
								<p class="order-status">{{ $value->order_status }}</p>
								<p><a href="{{ route('user.card.order.show', $value->order_sn) }}" title="订单详情" class="openwindow">订单详情</a></p>
							</td>
							<td width="12%" align="center">
								@if ($value->ifpay == 0)
									<a href="{{ route('brand.card.pay', $value->order_sn) }}" target="_blank" title="立即付款" class="btn-pay">立即付款</a>
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