@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.attr.value') }}</h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.attr.value.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.attr.value.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.attr.value.create', ['attr_id'=>request('attr_id')]) }}" class="btn openwindow" title="{{ trans('admin.attr.value.create') }}">+ {{ trans('admin.attr.value.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="80">{{ trans('admin.displayorder') }}</th>
				<th>{{ trans('admin.attr.value.title') }}</th>
				<th width="150">{{ trans('admin.attr.attr.title') }}</th>
				<th width="100">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($attrvalues as $attrvalue)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $attrvalue->attr_value_id }}" name="ids[]"></td>
				<td><input type="text" class="txt" name="displayorder[{{ $attrvalue->attr_value_id }}]" value="{{ $attrvalue->displayorder }}" size="2"></td>
				<td><input type="text" class="txt" name="title[{{ $attrvalue->attr_value_id }}]" value="{{ $attrvalue->title }}"></td>
				<td>{{ $attrvalue->attr->title or '/' }}</td>
				<td>
					<a href="{{ route('admin.attr.value.edit',$attrvalue->attr_value_id) }}" class="openwindow" title="{{ trans('admin.attr.value.edit') }}">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.attr.value.destroy',$attrvalue->attr_value_id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($attrvalues) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
			<button class="submitbtn" name="updatesubmit" value="yes" type="submit">{{ trans('admin.update') }}</button>
		</div>
		<div class="page y">
			{!! $attrvalues->appends(['attr_id' => request('attr_id')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection