@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.wechat.user') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.wechat.user.index') }}">
		<div class="tbsearch">
			<dl>
				<dd>
					<select class="schselect" name="subscribe" onchange='this.form.submit()'>
						<option value="">全部用户</option>
						<option value="yes" {!! request('subscribe') == 'yes' ? 'selected="selected"' : '' !!}>已关注用户</option>
						<option value="no" {!! request('subscribe') == 'no' ? 'selected="selected"' : '' !!}>未关注用户</option>
					</select>
				</dd>
			</dl>
			<dl>
				<dt>{{ trans('admin.wechat.user.nickname') }}</dt>
				<dd><input type="text" name="nickname" class="schtxt" value="{{ request('nickname') }}"></dd>
			</dl>
			<dl>
				<dt>{{ trans('admin.wechat.user.openid') }}</dt>
				<dd><input type="text" name="openid" class="schtxt" value="{{ request('openid') }}"></dd>
			</dl>
			<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
		</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.wechat.user.index') }}">
		{!! csrf_field() !!}
		<input type="hidden" id="operate" name="operate" value="" />
		<div class="tblist">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.wechat.user.list') }}</h3></div>
				<div class="y">
					<a href="{{ route('admin.wechat.user.import') }}" class="btn" title="{{ trans('admin.wechat.user.import') }}">{{ trans('admin.wechat.user.import') }}</a>
					<a href="{{ route('admin.wechat.user.upall') }}" class="btn" title="{{ trans('admin.wechat.user.upall') }}">{{ trans('admin.wechat.user.upall') }}</a>
				</div>
			</div>
			<table>
				<tr>
					<th width="24"><label><input class="checkall" type="checkbox"></label></th>
					<th width="60">{{ trans('admin.wechat.user.headimgurl') }}</th>
					<th width="180">{{ trans('admin.wechat.user.nickname') }}</th>
					<th>{{ trans('admin.wechat.user.openid') }}</th>
					<th width="70">{{ trans('admin.wechat.user.city') }}</th>
					<th width="70">{{ trans('admin.wechat.user.sex') }}</th>
					<th width="70">{{ trans('admin.wechat.user.subscribe') }}</th>
					<th width="120">{{ trans('admin.created_at') }}</th>
					<th width="60">{{ trans('admin.operation') }}</th>
				</tr>
				@foreach ($userlist as $value)
					<tr>
						<td><label><input class="ids" type="checkbox" value="{{ $value->uid }}" name="ids[]"></label></td>
						<td><img class="block" width="48" height="48" src="{{ $value->headimgurl ? $value->headimgurl : asset('static/image/common/getheadimg.jpg') }}"></td>
						<td>{{ $value->nickname }}</td>
						<td>{{ $value->openid }}</td>
						<td>{{ $value->city ? $value->city : '/' }}</td>
						<td>{{ $value->sex ? $value->sex == 1 ? '男' : '女' : '保密' }}</td>
						<td>{{ $value->subscribe ? '是' : '否' }}</td>
						<td>{{ $value->created_at->format('Y-m-d H:i') }}</td>
						<td>
							<a href="{{ route('admin.wechat.user.update',$value->uid) }}" class="ajaxbtn" title="{{ trans('admin.wechat.user.edit') }}">{{ trans('admin.edit') }}</a>
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
					{!! $userlist->appends(['subscribe' => request('subscribe')])->appends(['nickname' => request('nickname')])->appends(['openid' => request('openid')])->links() !!}
				</div>
			</div>
		@endif
	</form>
@endsection