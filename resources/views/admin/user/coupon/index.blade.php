@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.user.coupon') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.user.coupon.index') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.user.coupon.coupon_name') }}</dt>
			<dd><input type="text" name="coupon_name" class="schtxt" value="{{ request('coupon_name') }}"></dd>
		</dl>
		<dl>
			<dt>{{ trans('admin.user.coupon.username') }}</dt>
			<dd><input type="text" name="username" class="schtxt" value="{{ request('username') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.user.coupon.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.user.coupon.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="240">{{ trans('admin.user.coupon.username') }}</th>
				<th width="240">{{ trans('admin.user.coupon.coupon_name') }}</th>
				<th width="120">{{ trans('admin.user.coupon.coupon_amount') }}</th>
				<th width="120">{{ trans('admin.user.coupon.coupon_fullamount') }}</th>
				<th>{{ trans('admin.user.coupon.use_time') }}</th>
				<th width="120">{{ trans('admin.created_at') }}</th>
				<th width="80">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($coupons as $coupon)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $coupon->id }}" name="ids[]"></td>
				<td>{{ $coupon->user ? $coupon->user->username : '/' }}</td>
				<td>{{ $coupon->coupon_name or '/' }}</td>
				<td>{{ $coupon->coupon_amount or '0' }} 元</td>
				<td>{{ $coupon->coupon_fullamount ? $coupon->coupon_fullamount.' 元' : trans('admin.unlimit')}}</td>
				<td>
					@if ($coupon->use_start && $coupon->use_end)
					{{ $coupon->use_start->format('Y-m-d H:i') }} - {{ $coupon->use_end->format('Y-m-d H:i') }}
					@elseif ($coupon->use_start)
						{{ $coupon->use_start->format('Y-m-d H:i') }} - {{ trans('admin.unlimit') }}
					@elseif ($coupon->use_end)
						{{ trans('admin.unlimit') }} - {{ $coupon->use_end->format('Y-m-d H:i') }}
					@else
						{{ trans('admin.unlimit') }}
					@endif
				</td>
				<td>{{ $coupon->created_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.user.coupon.destroy',$coupon->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($coupons) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
		<div class="page y">
			{!! $coupons->appends(['coupon_name' => request('coupon_name')])->appends(['username' => request('username')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection