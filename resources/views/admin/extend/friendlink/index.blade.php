@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.friendlink') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.extend.friendlink.index') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.extend.friendlink.title') }}</dt>
			<dd><input type="text" name="title" class="schtxt" value="{{ request('title') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.extend.friendlink.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.extend.friendlink.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.extend.friendlink.create') }}" class="btn openwindow" title="{{ trans('admin.extend.friendlink.create') }}">+ {{ trans('admin.extend.friendlink.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="80">{{ trans('admin.displayorder') }}</th>
				<th width="160">{{ trans('admin.extend.friendlink.title') }}</th>
				<th width="300">{{ trans('admin.extend.friendlink.url') }}</th>
				<th>{{ trans('admin.extend.friendlink.description') }}</th>
				<th width="150">{{ trans('admin.created_at') }}</th>
				<th width="100">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($friendlinks as $friendlink)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $friendlink->id }}" name="ids[]"></td>
				<td><input type="text" class="txt" name="displayorder[{{ $friendlink->photo_id }}]" value="{{ $friendlink->displayorder }}" size="2"></td>
				<td>{{ $friendlink->title or '/' }}</td>
				<td>{{ $friendlink->url or '/' }}</td>
				<td>{{ $friendlink->description or '/' }}</td>
				<td>{{ $friendlink->created_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.extend.friendlink.edit',$friendlink->id) }}" class="openwindow" title="{{ trans('admin.extend.friendlink.edit') }}">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.extend.friendlink.destroy',$friendlink->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($friendlinks) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
			<button class="submitbtn" name="updatesubmit" value="yes" type="submit">{{ trans('admin.update') }}</button>
		</div>
    </div>
	@endif
	</form>
@endsection