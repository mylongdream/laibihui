@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.brand.consume') }}</h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.brand.consume.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.brand.consume.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="150">{{ trans('admin.brand.consume.user') }}</th>
				<th>{{ trans('admin.brand.consume.shop') }}</th>
				<th width="140">{{ trans('admin.brand.consume.consume_money') }}</th>
				<th width="140">{{ trans('admin.brand.consume.discount_money') }}</th>
				<th width="140">{{ trans('admin.brand.consume.ifpay') }}</th>
				<th width="140">{{ trans('admin.brand.consume.postip') }}</th>
				<th width="140">{{ trans('admin.created_at') }}</th>
			</tr>
			@foreach ($consumelist as $consume)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $consume->id }}" name="ids[]"></td>
				<td>{{ $consume->user->username }}</td>
				<td>
					@if ($consume->shop)
						<a href="{{ route('brand.shop.show', $consume->shop->id) }}" target="_blank" title="{{ $consume->shop->name }}">{{ $consume->shop->name }}</a>
					@else
						/
					@endif
				</td>
				<td>{{ $consume->consume_money }} 元</td>
				<td>{{ $consume->discount_money }} 元</td>
				<td>{{ $consume->pay_status ? '已支付' : '未支付' }}</td>
				<td>{{ $consume->postip }}</td>
				<td>{{ $consume->created_at->format('Y-m-d H:i') }}</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($consumelist) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
		<div class="page y">
			{!! $consumelist->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection