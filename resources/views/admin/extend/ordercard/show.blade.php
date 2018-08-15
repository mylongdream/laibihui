@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.ordercard') }}</h3></div>
	</div>
	@if ($order->address)
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.extend.ordercard.consignee') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="100">{{ trans('admin.user.address.realname') }}</th>
				<th width="120">{{ trans('admin.user.address.mobile') }}</th>
				<th width="260">{{ trans('admin.user.address.area') }}</th>
				<th>{{ trans('admin.user.address.address') }}</th>
				<th width="120">{{ trans('admin.user.address.zipcode') }}</th>
			</tr>
			<tr>
				<td>{{ $order->address ? $order->address->realname : '/' }}</td>
				<td>{{ $order->address ? $order->address->mobile : '/' }}</td>
				<td>{{ $order->address->getprovince ? $order->address->getprovince->name : '' }} {{ $order->address->getcity ? $order->address->getcity->name : '' }} {{ $order->address->getarea ? $order->address->getarea->name : '' }} {{ $order->address->getstreet ? $order->address->getstreet->name : '' }}</td>
				<td>{{ $order->address ? $order->address->address : '/' }}</td>
				<td>{{ $order->address ? $order->address->zipcode : '/' }}</td>
			</tr>
		</table>
	</div>
	@endif
    @if ($order->order_type == 0 && $order->visit)
        <div class="tblist">
            <div class="tbhead cl">
                <div class="z"><h3>{{ trans('admin.extend.ordercard.shipping') }}</h3></div>
            </div>
            <table>
                <tr>
                    <th width="100">{{ trans('admin.extend.ordercard.visit.realname') }}</th>
                    <th width="120">{{ trans('admin.extend.ordercard.visit.mobile') }}</th>
					<th width="180">{{ trans('admin.extend.ordercard.number') }}</th>
                    <th>{{ trans('admin.extend.ordercard.visit.remark') }}</th>
                </tr>
                <tr>
                    <td>{{ $order->visit ? $order->visit->realname : '/' }}</td>
                    <td>{{ $order->visit ? $order->visit->mobile : '/' }}</td>
					<td>{{ $order->number or '/' }}</td>
                    <td>{{ $order->visit ? $order->visit->remark : '/' }}</td>
                </tr>
            </table>
        </div>
    @endif
    @if ($order->order_type == 1 && $order->shipping)
        <div class="tblist">
            <div class="tbhead cl">
                <div class="z"><h3>{{ trans('admin.extend.ordercard.shipping') }}</h3></div>
            </div>
            <table>
                <tr>
                    <th width="100">{{ trans('admin.extend.ordercard.shipping.shipping_id') }}</th>
                    <th width="180">{{ trans('admin.extend.ordercard.shipping.waybill') }}</th>
					<th width="180">{{ trans('admin.extend.ordercard.number') }}</th>
                    <th>{{ trans('admin.extend.ordercard.shipping.remark') }}</th>
                </tr>
                <tr>
                    <td>{{ $order->shipping ? ($order->shipping->shipping ? $order->shipping->shipping->company : '/') : '/' }}</td>
                    <td>{{ $order->shipping ? $order->shipping->waybill : '/' }}</td>
					<td>{{ $order->number or '/' }}</td>
                    <td>{{ $order->shipping ? $order->shipping->remark : '/' }}</td>
                </tr>
            </table>
        </div>
    @endif
	<div class="tbedit">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.extend.ordercard.show') }}</h3></div>
		</div>
		<table>
			<tr>
				<td width="150" align="right">{{ trans('admin.extend.ordercard.order_sn') }}</td>
				<td>{{ $order->order_sn or '/' }}</td>
			</tr>
			<tr>
				<td width="150" align="right">{{ trans('admin.extend.ordercard.remark') }}</td>
				<td>{{ $order->remark or '/' }}</td>
			</tr>
            <tr>
                <td width="150" align="right">{{ trans('admin.extend.ordercard.order_type') }}</td>
                <td>{{ trans('admin.extend.ordercard.order_type_'.$order->order_type) }}</td>
            </tr>
			@if ($order->created_at)
			<tr>
				<td width="150" align="right">{{ trans('admin.extend.ordercard.created_at') }}</td>
				<td>{{ $order->created_at ? $order->created_at->format('Y-m-d H:i') : '/' }}</td>
			</tr>
			@endif
			@if ($order->pay_at)
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.ordercard.pay_at') }}</td>
					<td>{{ $order->pay_at ? $order->pay_at->format('Y-m-d H:i') : '/' }}</td>
				</tr>
			@endif
			@if ($order->shipping_at)
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.ordercard.shipping_at') }}</td>
					<td>{{ $order->shipping_at ? $order->shipping_at->format('Y-m-d H:i') : '/' }}</td>
				</tr>
			@endif
			@if ($order->finish_at)
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.ordercard.finish_at') }}</td>
					<td>{{ $order->finish_at ? $order->finish_at->format('Y-m-d H:i') : '/' }}</td>
				</tr>
			@endif
			<tr>
				<td width="150" align="right">{{ trans('admin.extend.ordercard.handle') }}</td>
				<td>
                    @if ($order->order_status == 0 && $order->shipping_status == 0 && $order->pay_status == 1)


                        <a href="{{ route('admin.extend.ordercard.send',$order->id) }}" class="subtn openwindow" title="发货">发货</a>

                    @else
                        {{ trans('admin.extend.ordercard.status_'.$order->order_status.$order->shipping_status.$order->pay_status) }}
                    @endif
				</td>
			</tr>
		</table>
	</div>
@endsection