@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.ordercard') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.extend.ordercard.send',$order->id) }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.extend.ordercard.send') }}</h3></div>
				<div class="y"><a href="{{ route('admin.extend.faq.index') }}" class="btn">< {{ trans('admin.extend.ordercard.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.ordercard.number') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="number"></td>
				</tr>
                    @if ($order->order_type == 0)
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.ordercard.visit.realname') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="realname"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.ordercard.visit.mobile') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="mobile"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.ordercard.visit.remark') }}</td>
					<td><textarea class="textarea" name="remark" cols="60" rows="5"></textarea></td>
				</tr>
                    @else
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.ordercard.shipping.shipping_id') }}</td>
					<td>
						<select name="shipping_id" class="select">
							<option value="0">请选择</option>
							@foreach ($shippings as $value)
								<option value="{{ $value->id }}">{{ $value->company }}</option>
							@endforeach
						</select>
						</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.ordercard.shipping.waybill') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="waybill"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.ordercard.shipping.remark') }}</td>
					<td><textarea class="textarea" name="remark" cols="60" rows="5"></textarea></td>
				</tr>
                    @endif
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection