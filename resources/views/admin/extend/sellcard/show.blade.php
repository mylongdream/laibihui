@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.sellcard') }}</h3></div>
	</div>
	<div class="tbedit">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.extend.sellcard.show') }}</h3></div>
		</div>
		<table>
			<tr>
				<td width="150" align="right">{{ trans('admin.extend.sellcard.user') }}</td>
				<td>{{ $order->user ? $order->user->username : '/' }}</td>
			</tr>
			<tr>
				<td width="150" align="right">{{ trans('admin.extend.sellcard.order_sn') }}</td>
				<td>{{ $order->order_sn or '/' }}</td>
			</tr>
			<tr>
				<td width="150" align="right">{{ trans('admin.extend.sellcard.number') }}</td>
				<td>{{ $order->number or '/' }}</td>
			</tr>
			<tr>
				<td width="150" align="right">{{ trans('admin.extend.sellcard.order_amount') }}</td>
				<td>{{ $order->order_amount or '0' }} 元</td>
			</tr>
            <tr>
                <td width="150" align="right">{{ trans('admin.extend.sellcard.pay_type') }}</td>
                <td>{{ trans('admin.extend.sellcard.pay_type_'.$order->pay_type) }}</td>
            </tr>
			@if ($order->created_at)
			<tr>
				<td width="150" align="right">{{ trans('admin.extend.sellcard.created_at') }}</td>
				<td>{{ $order->created_at ? $order->created_at->format('Y-m-d H:i') : '/' }}</td>
			</tr>
			@endif
			<tr>
				<td width="150" align="right">{{ trans('admin.extend.sellcard.pay_status') }}</td>
				<td>{{ trans('admin.extend.sellcard.pay_status_'.$order->pay_status) }}</td>
			</tr>
			@if ($order->pay_at)
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.sellcard.pay_at') }}</td>
					<td>{{ $order->pay_at ? $order->pay_at->format('Y-m-d H:i') : '/' }}</td>
				</tr>
			@endif
		</table>
	</div>
@endsection