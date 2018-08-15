@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.user.sign') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.user.sign.index') }}">
		<div class="tbsearch">
			<dl>
				<dt>{{ trans('admin.user.user.username') }}</dt>
				<dd><input type="text" name="username" class="schtxt" value="{{ request('username') }}"></dd>
			</dl>
			<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
		</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.user.sign.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.user.sign.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th>{{ trans('admin.user.sign.user') }}</th>
				<th width="140">{{ trans('admin.user.sign.postip') }}</th>
				<th width="140">{{ trans('admin.created_at') }}</th>
			</tr>
			@foreach ($signlist as $sign)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $sign->id }}" name="ids[]"></td>
				<td>{{ $sign->user ? $sign->user->username : '/' }}</td>
				<td>{{ $sign->postip }}</td>
				<td>{{ $sign->created_at->format('Y-m-d H:i') }}</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($signlist) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
		<div class="page y">
			{!! $signlist->appends(['username' => request('username')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection