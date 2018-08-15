@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.attr.attr') }}</h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.attr.attr.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.attr.attr.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.attr.attr.create', ['from_id'=>request('from_id')]) }}" class="btn openwindow" title="{{ trans('admin.attr.attr.create') }}">+ {{ trans('admin.attr.attr.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="80">{{ trans('admin.displayorder') }}</th>
				<th>{{ trans('admin.attr.attr.title') }}</th>
				<th width="200">{{ trans('admin.attr.attr.attr_key') }}</th>
				<th width="140">{{ trans('admin.attr.value') }}</th>
				<th width="100">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($attrs as $attr)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $attr->attr_id }}" name="ids[]"></td>
				<td><input type="text" class="txt" name="displayorder[{{ $attr->attr_id }}]" value="{{ $attr->displayorder }}" size="2"></td>
				<td><input type="text" class="txt" name="title[{{ $attr->attr_id }}]" value="{{ $attr->title }}"></td>
				<td>{{ $attr->attr_key or '/' }}</td>
				<td><a href="{{ route('admin.attr.value.index',['attr_id'=>$attr->attr_id]) }}">{{ trans('admin.view') }}</a> ( {{ $attr->values()->count() }} )</td>
				<td>
					<a href="{{ route('admin.attr.attr.edit',$attr->attr_id) }}" class="openwindow" title="{{ trans('admin.attr.attr.edit') }}">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.attr.attr.destroy',$attr->attr_id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($attrs) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
			<button class="submitbtn" name="updatesubmit" value="yes" type="submit">{{ trans('admin.update') }}</button>
		</div>
		<div class="page y">
			{!! $attrs->appends(['from_id' => request('from_id')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection