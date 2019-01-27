@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.user.redpack') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.user.redpack.index') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.user.redpack.redpack_name') }}</dt>
			<dd><input type="text" name="redpack_name" class="schtxt" value="{{ request('redpack_name') }}"></dd>
		</dl>
		<dl>
			<dt>{{ trans('admin.user.redpack.username') }}</dt>
			<dd><input type="text" name="username" class="schtxt" value="{{ request('username') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.user.redpack.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.user.redpack.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="140">{{ trans('admin.user.redpack.username') }}</th>
				<th width="240">{{ trans('admin.user.redpack.redpack_name') }}</th>
				<th width="120">{{ trans('admin.user.redpack.redpack_amount') }}</th>
				<th width="120">{{ trans('admin.user.redpack.redpack_fullamount') }}</th>
				<th>{{ trans('admin.user.redpack.use_time') }}</th>
				<th width="120">{{ trans('admin.user.coupon.created_at') }}</th>
				<th width="80">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($redpacks as $redpack)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $redpack->id }}" name="ids[]"></td>
				<td>{{ $redpack->user ? $redpack->user->username : '/' }}</td>
				<td>{{ $redpack->redpack_name or '/' }}</td>
				<td>{{ $redpack->redpack_amount or '0' }} 元</td>
				<td>{{ $redpack->redpack_fullamount ? $redpack->redpack_fullamount.' 元' : trans('admin.unlimit')}}</td>
				<td>
					@if ($redpack->use_start && $redpack->use_end)
					{{ $redpack->use_start->format('Y-m-d H:i') }} - {{ $redpack->use_end->format('Y-m-d H:i') }}
					@elseif ($redpack->use_start)
						{{ $redpack->use_start->format('Y-m-d H:i') }} - {{ trans('admin.unlimit') }}
					@elseif ($redpack->use_end)
						{{ trans('admin.unlimit') }} - {{ $redpack->use_end->format('Y-m-d H:i') }}
					@else
						{{ trans('admin.unlimit') }}
					@endif
				</td>
				<td>{{ $redpack->created_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.user.redpack.destroy',$redpack->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($redpacks) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
		<div class="page y">
			{!! $redpacks->appends(['redpack_name' => request('redpack_name')])->appends(['username' => request('username')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection