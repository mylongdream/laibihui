@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.admin.group') }}</h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.admin.group.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.admin.group.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.admin.group.create') }}" class="btn openwindow" title="{{ trans('admin.admin.group.create') }}">+ {{ trans('admin.admin.group.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="80">{{ trans('admin.displayorder') }}</th>
				<th width="200">{{ trans('admin.admin.group.name') }}</th>
				<th>{{ trans('admin.admin.group.description') }}</th>
				<th width="100">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($grouplist as $group)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $group->id }}" name="ids[]"></td>
				<td><input type="text" class="txt" name="displayorder[{{ $group->id }}]" value="{{ $group->displayorder }}" size="2"></td>
				<td>{{ $group->name }}</td>
				<td>{{ $group->description }}</td>
				<td>
					<a href="{{ route('admin.admin.group.edit',$group->id) }}" class="openwindow" title="{{ trans('admin.admin.group.edit') }}">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.admin.group.destroy',$group->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
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