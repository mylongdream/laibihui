@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.wechat.redpack') }}</h3></div>
		<ul class="tab">
			<li class="current"><a href="{{ route('admin.wechat.redpack.index') }}"><span>{{ trans('admin.wechat.redpack.list') }}</span></a></li>
			<li><a href="{{ route('admin.wechat.redpack.create') }}"><span>{{ trans('admin.wechat.redpack.create') }}</span></a></li>
		</ul>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.wechat.redpack.index') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.wechat.redpack.openid') }}</dt>
			<dd><input type="text" name="openid" class="schtxt" value="{{ request('openid') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<div class="tblist">
		<table>
			<tr>
				<th width="80">{{ trans('admin.wechat.user.headimgurl') }}</th>
				<th width="120">{{ trans('admin.wechat.user.nickname') }}</th>
				<th>{{ trans('admin.wechat.redpack.openid') }}</th>
				<th width="100">{{ trans('admin.wechat.redpack.total_amount') }}</th>
				<th width="160">{{ trans('admin.wechat.redpack.return_msg') }}</th>
				<th width="160">{{ trans('admin.created_at') }}</th>
				<th width="80">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($redpacks as $redpack)
				<tr>
					<td><img class="block" width="48" height="48" src="{{ $redpack->user->headimgurl or '/' }}"></td>
					<td>{{ $redpack->user->nickname or '/' }}</td>
					<td>{{ $redpack->openid or '/' }}</td>
					<td>{{ trans('admin.wechat.redpack.total_amount.rmb', ['amount' => $redpack->amount]) }}</td>
					<td>{{ $redpack->return_msg or '/' }}</td>
					<td>{{ $redpack->created_at->format('Y-m-d H:i') }}</td>
					<td>
						<a href="{{ route('admin.wechat.redpack.show',$redpack->id) }}" class="openwindow" title="{{ trans('admin.wechat.redpack.view') }}">{{ trans('admin.view') }}</a>
						<a href="{{ route('admin.wechat.redpack.destroy',$redpack->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
					</td>
				</tr>
			@endforeach
		</table>
	</div>
	@if (count($redpacks) > 0)
	<div class="pgs cl">
		<div class="page y">
			{!! $redpacks->appends(['openid' => request('openid')])->links() !!}
		</div>
    </div>
	@endif
@endsection