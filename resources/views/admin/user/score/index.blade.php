@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.user.score') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.user.score.index') }}">
		<div class="tbsearch">
			<dl>
				<dt>{{ trans('admin.user.user.username') }}</dt>
				<dd><input type="text" name="username" class="schtxt" value="{{ request('username') }}"></dd>
			</dl>
			<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
		</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.user.score.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.user.score.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.user.score.create') }}" class="btn openwindow" title="{{ trans('admin.user.score.create') }}">+ {{ trans('admin.user.score.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="150">{{ trans('admin.user.score.user') }}</th>
				<th width="140">{{ trans('admin.user.score.score') }}</th>
				<th>{{ trans('admin.user.score.remark') }}</th>
				<th width="140">{{ trans('admin.user.score.postip') }}</th>
				<th width="140">{{ trans('admin.created_at') }}</th>
			</tr>
			@foreach ($scorelist as $score)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $score->id }}" name="ids[]"></td>
				<td>{{ $score->user ? $score->user->username : '/' }}</td>
				<td>{{ $score->score > 0 ? '+'.$score->score : $score->score }}</td>
				<td>{{ $score->remark }}</td>
				<td>{{ $score->postip }}</td>
				<td>{{ $score->created_at->format('Y-m-d H:i') }}</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($scorelist) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
		<div class="page y">
			{!! $scorelist->appends(['username' => request('username')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection