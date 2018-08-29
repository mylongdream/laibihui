@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.user.user') }}</h3></div>
		<ul class="tab">
			<li><a href="{{ route('admin.user.user.index') }}"><span>{{ trans('admin.user.user.list') }}</span></a></li>
			<li class="current"><a href="{{ route('admin.user.user.promotion') }}"><span>{{ trans('admin.user.user.promotion') }}</span></a></li>
		</ul>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.user.user.promotion') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.user.user.username') }}</dt>
			<dd><input type="text" name="username" class="schtxt" value="{{ request('username') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.user.user.promotion') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="70">{{ trans('admin.user.user.headimgurl') }}</th>
				<th>{{ trans('admin.user.user.username') }}</th>
				<th width="200">{{ trans('admin.user.user.fromuser') }}</th>
				<th width="200">{{ trans('admin.user.user.fromupuser') }}</th>
				<th width="120">{{ trans('admin.created_at') }}</th>
			</tr>
			@foreach ($userlist as $value)
			<tr>
				<td><img class="block" width="48" height="48" src="{{ $value->headimgurl ? uploadImage($value->headimgurl) : asset('static/image/common/getheadimg.jpg') }}"></td>
				<td><p>{{ $value->username }}</p><p style="color: #999">{{ $value->group ? $value->group->name : '' }}</p></td>
				<td>{{ $value->fromuser ? $value->fromuser->username : '/' }}</td>
				<td>{{ $value->fromupuser ? $value->fromupuser->username : '/' }}</td>
				<td>{{ $value->created_at->format('Y-m-d H:i') }}</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($userlist) > 0)
	<div class="pgs cl">
		<div class="page y">
			{!! $userlist->appends(['username' => request('username')])->links() !!}
		</div>
    </div>
	@endif
@endsection