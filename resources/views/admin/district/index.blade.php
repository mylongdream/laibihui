@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.district') }}</h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.district.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.district.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.district.create', ['upid' => request('upid')]) }}" class="btn openwindow" title="{{ trans('admin.district.create') }}">+ {{ trans('admin.district.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="50">{{ trans('admin.id') }}</th>
				<th width="80">{{ trans('admin.displayorder') }}</th>
				<th>{{ trans('admin.district.name') }}</th>
				<th width="150">{{ trans('admin.district.parent') }}</th>
				<th width="100">{{ trans('admin.district.children') }}</th>
				<th width="100">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($districts as $district)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $district->id }}" name="ids[]"></td>
				<td>{{ $district->id }}</td>
				<td><input type="text" class="txt" name="displayorder[{{ $district->id }}]" value="{{ $district->displayorder }}" size="2"></td>
				<td><input type="text" class="txt" name="name[{{ $district->id }}]" value="{{ $district->name }}"></td>
				<td>{{ $district->upid ? $district->parent->name : '/' }}</td>
				<td><a href="{{ route('admin.district.index',['upid' =>$district->id]) }}">{{ trans('admin.view') }}({{ count($district->children) }})</a></td>
				<td>
					<a href="{{ route('admin.district.edit',$district->id) }}" class="openwindow" title="{{ trans('admin.district.edit') }}">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.district.destroy',$district->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($districts) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
			<button class="submitbtn" name="updatesubmit" value="yes" type="submit">{{ trans('admin.update') }}</button>
		</div>
    </div>
	@endif
	</form>
@endsection