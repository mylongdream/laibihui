@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.farm.order') }}</h3></div>
	</div>
	<div class="tbedit">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.farm.order.show') }}</h3></div>
		</div>
		<table>
			<tr>
				<td width="150" align="right">{{ trans('admin.farm.order.order_sn') }}</td>
				<td>{{ $order->order_sn or '/' }}</td>
			</tr>
			<tr>
				<td width="150" align="right">{{ trans('admin.farm.order.gotime') }}</td>
				<td>{{ $order->gotime ? $order->gotime->format('Y-m-d') : '/' }}</td>
			</tr>
			<tr>
				<td width="150" align="right">{{ trans('admin.farm.order.realname') }}</td>
				<td>{{ $order->realname or '/' }}</td>
			</tr>
			<tr>
				<td width="150" align="right">{{ trans('admin.farm.order.mobile') }}</td>
				<td>{{ $order->mobile or '/' }}</td>
			</tr>
			<tr>
				<td width="150" align="right">{{ trans('admin.farm.order.remark') }}</td>
				<td>{{ $order->remark or '/' }}</td>
			</tr>
			@if ($order->created_at)
			<tr>
				<td width="150" align="right">{{ trans('admin.farm.order.created_at') }}</td>
				<td>{{ $order->created_at ? $order->created_at->format('Y-m-d H:i') : '/' }}</td>
			</tr>
			@endif
			@if ($order->pay_at)
				<tr>
					<td width="150" align="right">{{ trans('admin.farm.order.pay_at') }}</td>
					<td>{{ $order->pay_at ? $order->pay_at->format('Y-m-d H:i') : '/' }}</td>
				</tr>
			@endif
			@if ($order->finish_at)
				<tr>
					<td width="150" align="right">{{ trans('admin.farm.order.finish_at') }}</td>
					<td>{{ $order->finish_at ? $order->finish_at->format('Y-m-d H:i') : '/' }}</td>
				</tr>
			@endif
			<tr>
				<td width="150" align="right">{{ trans('admin.farm.order.handle') }}</td>
				<td>
                    @if ($order->order_status == 0 && $order->pay_status == 1)


                        <a href="{{ route('admin.farm.order.finish',$order->id) }}" class="subtn" title="确认">确认</a>
                    @else
                        {{ trans('admin.farm.order.status_'.$order->order_status.$order->pay_status) }}
                    @endif
				</td>
			</tr>
		</table>
	</div>
@endsection