@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.feedback') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.extend.feedback.index') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.extend.feedback.message') }}</dt>
			<dd><input type="text" name="message" class="schtxt" value="{{ request('message') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.extend.feedback.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.extend.feedback.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="150">{{ trans('admin.extend.feedback.user') }}</th>
				<th>{{ trans('admin.extend.feedback.message') }}</th>
				<th width="150">{{ trans('admin.extend.feedback.phone') }}</th>
				<th width="120">{{ trans('admin.created_at') }}</th>
				<th width="80">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($feedbacks as $feedback)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $feedback->id }}" name="ids[]"></td>
				<td>{{ $feedback->user ? $feedback->user->username : '/' }}</td>
				<td>{{ $feedback->message ? str_limit($feedback->message, 60) : '/' }}</td>
				<td>{{ $feedback->phone ? $feedback->phone : '/' }}</td>
				<td>{{ $feedback->created_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.extend.feedback.show',$feedback->id) }}" class="openwindow" title="{{ trans('admin.extend.feedback.show') }}">{{ trans('admin.view') }}</a>
					<a href="{{ route('admin.extend.feedback.destroy',$feedback->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($feedbacks) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
		<div class="page y">
			{!! $feedbacks->appends(['message' => request('message')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection