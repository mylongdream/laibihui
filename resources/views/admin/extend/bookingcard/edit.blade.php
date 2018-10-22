@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.bookingcard') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.extend.bookingcard.update', $order->id) }}">
    	<input type="hidden" name="_method" value="PUT">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.extend.bookingcard.list') }}</h3></div>
				<div class="y"><a href="{{ route('admin.extend.bookingcard.index') }}" class="btn">< {{ trans('admin.extend.bookingcard.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.bookingcard.user') }}</td>
					<td>{{ $order->user->username }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.bookingcard.cardnum') }}</td>
					<td>{{ $order->cardnum }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.bookingcard.status') }}</td>
					<td>
						<label class="radio" for="status_0">
							<input id="status_0" type="radio" name="status" value="0" {{ $order->status == 0 ? 'checked' : '' }}> {{ trans('admin.extend.bookingcard.status_0') }}
						</label>
						<label class="radio" for="status_1">
							<input id="status_1" type="radio" name="status" value="1" {{ $order->status == 1 ? 'checked' : '' }}> {{ trans('admin.extend.bookingcard.status_1') }}
						</label>
					</td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection