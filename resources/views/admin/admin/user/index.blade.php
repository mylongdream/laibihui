@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.admin.user') }}</h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.admin.user.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.admin.user.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.admin.user.create') }}" class="btn openwindow" title="{{ trans('admin.admin.user.create') }}">+ {{ trans('admin.admin.user.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th>{{ trans('admin.admin.user.username') }}</th>
				<th width="120">{{ trans('admin.admin.group.name') }}</th>
				<th width="150">{{ trans('admin.admin.user.lastlogin') }}</th>
				<th width="100">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($userlist as $user)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $user->uid }}" name="ids[]"></td>
				<td>{{ $user->username }}</td>
				<td>{{ $user->group->name }}</td>
				<td>{{ $user->lastlogin ? $user->lastlogin->format('Y-m-d H:i') : '/' }}</td>
				<td>
					<a href="{{ route('admin.admin.user.edit',$user->uid) }}" class="openwindow" title="{{ trans('admin.admin.user.edit') }}">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.admin.user.destroy',$user->uid) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($userlist) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
    </div>
	@endif
	</form>
@endsection