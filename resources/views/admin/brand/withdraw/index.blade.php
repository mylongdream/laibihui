@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.brand.withdraw') }}</h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.brand.withdraw.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.brand.withdraw.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="150">{{ trans('admin.brand.withdraw.user') }}</th>
				<th>{{ trans('admin.brand.withdraw.shop') }}</th>
				<th width="140">{{ trans('admin.brand.withdraw.money') }}</th>
				<th width="140">{{ trans('admin.brand.withdraw.ifpay') }}</th>
				<th width="140">{{ trans('admin.brand.withdraw.postip') }}</th>
				<th width="140">{{ trans('admin.created_at') }}</th>
			</tr>
			@foreach ($withdrawlist as $withdraw)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $withdraw->id }}" name="ids[]"></td>
				<td>{{ $withdraw->user->username }}</td>
				<td>
					@if ($withdraw->shop)
						<a href="{{ route('brand.shop.detail', $withdraw->shop->id) }}" target="_blank" title="{{ $withdraw->shop->name }}">{{ $withdraw->shop->name }}</a>
					@else
						/
					@endif
				</td>
				<td>{{ $withdraw->money }} 元</td>
				<td>{{ $withdraw->ifpay ? '已支付' : '未支付' }}</td>
				<td>{{ $withdraw->postip }}</td>
				<td>{{ $withdraw->created_at->format('Y-m-d H:i') }}</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($withdrawlist) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
		<div class="page y">
			{!! $withdrawlist->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection