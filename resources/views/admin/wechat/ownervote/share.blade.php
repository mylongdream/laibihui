@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>业主评选</h3></div>
		<ul class="tab">
			<li><a href="{{ route('admin.wechat.ownervote.index') }}"><span>基本设置</span></a></li>
			<li><a href="{{ route('admin.wechat.ownervote.apply') }}"><span>参与用户</span></a></li>
			<li><a href="{{ route('admin.wechat.ownervote.vote') }}"><span>投票记录</span></a></li>
			<li><a href="{{ route('admin.wechat.ownervote.visit') }}"><span>访问记录</span></a></li>
			<li class="current"><a href="{{ route('admin.wechat.ownervote.share') }}"><span>分享记录</span></a></li>
		</ul>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.wechat.ownervote.share') }}">
	<div class="tbsearch">
		<dl>
			<dt>用户昵称</dt>
			<dd><input type="text" name="nickname" class="schtxt" value="{{ request('nickname') }}"></dd>
		</dl>
		<dl>
			<dt>用户openid</dt>
			<dd><input type="text" name="openid" class="schtxt" value="{{ request('openid') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.wechat.ownervote.share') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>投票记录</h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><label><input class="checkall" type="checkbox"></label></th>
				<th width="60">用户头像</th>
				<th width="160">用户昵称</th>
				<th>用户openid</th>
				<th width="120">分享途径</th>
				<th width="120">发送IP</th>
				<th width="120">发送时间</th>
			</tr>
			@foreach ($sharelist as $value)
			<tr>
				<td><label><input class="ids" type="checkbox" value="{{ $value->id }}" name="ids[]"></label></td>
				<td><img class="block" width="48" height="48" src="{{ $value->headimgurl ? $value->headimgurl : asset('static/image/common/getheadimg.jpg') }}"></td>
				<td>{{ $value->nickname }}</td>
				<td>{{ $value->openid }}</td>
				<td>{{ $value->shareto }}</td>
				<td>{{ $value->postip }}</td>
				<td>{{ $value->created_at ? $value->created_at->format('Y-m-d H:i') : '' }}</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($sharelist) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
		<div class="page y">
			{!! $sharelist->appends(['nickname' => request('nickname')])->appends(['openid' => request('openid')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection