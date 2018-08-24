@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.user.user') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.user.user.index') }}">
	<div class="tbsearch">
		<dl>
			<dd>
				<select class="schselect" name="bindcard" onchange='this.form.submit()'>
					<option value="">全部</option>
					<option value="1" {!! request('bindcard') == 1 ? 'selected="selected"' : '' !!}>未开卡</option>
					<option value="2" {!! request('bindcard') == 2 ? 'selected="selected"' : '' !!}>已开卡</option>
				</select>
			</dd>
		</dl>
		<dl>
			<dt>{{ trans('admin.user.user.mobile') }}</dt>
			<dd><input type="text" name="mobile" class="schtxt" value="{{ request('mobile') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.user.user.index') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.user.user.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.user.user.create') }}" class="btn openwindow" title="{{ trans('admin.user.user.create') }}">+ {{ trans('admin.user.user.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><label><input class="checkall" type="checkbox"></label></th>
				<th width="70">{{ trans('admin.user.user.headimgurl') }}</th>
				<th>{{ trans('admin.user.user.username') }}</th>
				<th width="70">{{ trans('admin.user.user.tiyan_money') }}</th>
				<th width="70">{{ trans('admin.user.user.user_money') }}</th>
				<th width="70">{{ trans('admin.user.user.frozen_money') }}</th>
				<th width="70">{{ trans('admin.user.user.score') }}</th>
				<th width="120">{{ trans('admin.user.user.lastlogin') }}</th>
				<th width="120">{{ trans('admin.created_at') }}</th>
				<th width="90">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($userlist as $value)
			<tr>
				<td><label><input class="ids" type="checkbox" value="{{ $value->uid }}" name="ids[]"></label></td>
				<td><img class="block" width="48" height="48" src="{{ $value->headimgurl ? uploadImage($value->headimgurl) : asset('static/image/common/getheadimg.jpg') }}"></td>
				<td><p>{{ $value->username }}</p><p style="color: #999">{{ $value->group ? $value->group->name : '' }}</p></td>
				<td>{{ $value->tiyan_money }} 元</td>
				<td>{{ $value->user_money }} 元</td>
				<td>{{ $value->frozen_money }} 元</td>
				<td>{{ $value->score }}</td>
				<td>{{ $value->lastlogin ? $value->lastlogin->format('Y-m-d H:i') : '/' }}</td>
				<td>{{ $value->created_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.user.user.group',$value->uid) }}" class="openwindow" title="{{ trans('admin.user.user.group') }}">{{ trans('admin.user.user.group') }}</a>
					<a href="{{ route('admin.user.user.edit',$value->uid) }}" class="mlm openwindow" title="{{ trans('admin.user.user.edit') }}">{{ trans('admin.edit') }}</a>
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
		<div class="page y">
			{!! $userlist->appends(['bindcard' => request('bindcard')])->appends(['mobile' => request('mobile')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection