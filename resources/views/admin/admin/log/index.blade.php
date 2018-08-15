@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.admin.log') }}</h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.admin.log.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.admin.log.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="150">{{ trans('admin.admin.log.user') }}</th>
				<th>{{ trans('admin.admin.log.action') }}</th>
				<th width="140">{{ trans('admin.admin.log.postip') }}</th>
				<th width="140">{{ trans('admin.created_at') }}</th>
			</tr>
			@foreach ($loglist as $log)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $log->id }}" name="ids[]"></td>
				<td>{{ $log->user ? $log->user->username : '/' }}</td>
				<td>{{ $log->action }}</td>
				<td>{{ $log->postip }}</td>
				<td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($loglist) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
		<div class="page y">
			{!! $loglist->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection