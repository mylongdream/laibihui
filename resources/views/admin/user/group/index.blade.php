@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.user.group') }}</h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.user.group.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.user.group.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.user.group.create') }}" class="btn openwindow" title="{{ trans('admin.user.group.create') }}">+ {{ trans('admin.user.group.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="80">{{ trans('admin.displayorder') }}</th>
				<th width="200">{{ trans('admin.user.group.name') }}</th>
				<th>{{ trans('admin.user.group.description') }}</th>
				<th width="120">{{ trans('admin.user.group.tag_id') }}</th>
				<th width="100">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($grouplist as $group)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $group->id }}" name="ids[]"></td>
				<td><input type="text" class="txt" name="displayorder[{{ $group->id }}]" value="{{ $group->displayorder }}" size="2"></td>
				<td>{{ $group->name }}</td>
				<td>{{ $group->description }}</td>
				<td>{{ $group->wechat_tag ? $group->wechat_tag->name : '/' }}</td>
				<td>
					<a href="{{ route('admin.user.group.edit',$group->id) }}" class="openwindow" title="{{ trans('admin.user.group.edit') }}">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.user.group.destroy',$group->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($grouplist) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
			<button class="submitbtn" name="updatesubmit" value="yes" type="submit">{{ trans('admin.update') }}</button>
		</div>
    </div>
	@endif
	</form>
@endsection