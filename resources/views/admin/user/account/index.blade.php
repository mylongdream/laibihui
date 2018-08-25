@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.user.account') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.user.account.index') }}">
		<div class="tbsearch">
			<dl>
				<dt>{{ trans('admin.user.user.username') }}</dt>
				<dd><input type="text" name="username" class="schtxt" value="{{ request('username') }}"></dd>
			</dl>
			<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
		</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.user.account.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.user.account.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.user.account.create') }}" class="btn openwindow" title="{{ trans('admin.user.account.create') }}">+ {{ trans('admin.user.account.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="150">{{ trans('admin.user.account.user') }}</th>
				<th width="140">{{ trans('admin.user.account.user_money') }}</th>
				<th width="140">{{ trans('admin.user.account.frozen_money') }}</th>
				<th>{{ trans('admin.user.account.remark') }}</th>
				<th width="140">{{ trans('admin.user.account.postip') }}</th>
				<th width="140">{{ trans('admin.created_at') }}</th>
			</tr>
			@foreach ($accountlist as $account)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $account->id }}" name="ids[]"></td>
				<td>{{ $account->user ? $account->user->username : '/' }}</td>
				<td>{{ $account->user_money > 0 ? '+'.$account->user_money : $account->user_money }}</td>
				<td>{{ $account->frozen_money > 0 ? '+'.$account->frozen_money : $account->frozen_money }}</td>
				<td>{{ $account->remark }}</td>
				<td>{{ $account->postip }}</td>
				<td>{{ $account->created_at->format('Y-m-d H:i') }}</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($accountlist) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
		<div class="page y">
			{!! $accountlist->appends(['username' => request('username')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection