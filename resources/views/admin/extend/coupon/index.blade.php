@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.coupon') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.extend.coupon.index') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.extend.coupon.name') }}</dt>
			<dd><input type="text" name="name" class="schtxt" value="{{ request('name') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.extend.coupon.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.extend.coupon.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.extend.coupon.create') }}" class="btn" title="{{ trans('admin.extend.coupon.create') }}">+ {{ trans('admin.extend.coupon.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="240">{{ trans('admin.extend.coupon.name') }}</th>
				<th width="120">{{ trans('admin.extend.coupon.amount') }}</th>
				<th width="120">{{ trans('admin.extend.coupon.fullamount') }}</th>
				<th>{{ trans('admin.extend.coupon.use_time') }}</th>
				<th width="80">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($coupons as $coupon)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $coupon->id }}" name="ids[]"></td>
				<td>{{ $coupon->name or '/' }}</td>
				<td>{{ $coupon->amount }} 元</td>
				<td>{{ $coupon->fullamount ? $coupon->fullamount.' 元' : trans('admin.unlimit')}}</td>
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
				<td>
					<a href="{{ route('admin.extend.coupon.edit',$coupon->id) }}" class="" title="{{ trans('admin.extend.coupon.edit') }}">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.extend.coupon.destroy',$coupon->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
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
			{!! $coupons->appends(['title' => request('title')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection