@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.activity') }}</h3></div>
		<ul class="tab">
			<li class="current"><a href="{{ route('admin.activity.index') }}"><span>{{ trans('admin.activity.list') }}</span></a></li>
			<li><a href="{{ route('admin.activity.apply') }}"><span>{{ trans('admin.activity.apply') }}</span></a></li>
		</ul>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.activity.index') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.activity.subject') }}</dt>
			<dd><input type="text" name="subject" class="schtxt" value="{{ request('subject') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.activity.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.activity.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.activity.create') }}" class="btn" title="{{ trans('admin.activity.create') }}">+ {{ trans('admin.activity.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th>{{ trans('admin.activity.subject') }}</th>
				<th width="100">{{ trans('admin.activity.city') }}</th>
				<th width="100">{{ trans('admin.activity.viewnum') }}</th>
				<th width="150">{{ trans('admin.created_at') }}</th>
				<th width="100">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($activitys as $activity)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $activity->activity_id }}" name="ids[]"></td>
				<td><a href="{{ route('activity.detail',$activity->activity_id) }}" target="_blank">{{ $activity->subject }}</a></td>
				<td>{{ $activity->city->city_name or '/' }}</td>
				<td>{{ $activity->viewnum }} 次</td>
				<td>{{ $activity->created_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.activity.edit',$activity->activity_id) }}" class="" title="{{ trans('admin.activity.edit') }}">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.activity.destroy',$activity->activity_id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($activitys) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
		<div class="page y">
			{!! $activitys->appends(['subject' => request('subject')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection