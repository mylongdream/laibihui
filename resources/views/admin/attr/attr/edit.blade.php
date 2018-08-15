@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.attr.attr') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.attr.attr.update', $attr->attr_id) }}">
		<input type="hidden" name="_method" value="PUT">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.attr.attr.edit') }}</h3></div>
				<div class="y"><a href="{{ route('admin.attr.attr.index') }}" class="btn">< {{ trans('admin.attr.attr.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.attr.attr.title') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $attr->title }}" name="title"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.attr.attr.attr_key') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $attr->attr_key }}" name="attr_key"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.displayorder') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $attr->displayorder }}" name="displayorder"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection