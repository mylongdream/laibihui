@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.attr.value') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.attr.value.update', $attrvalue->attr_value_id) }}">
		<input type="hidden" name="_method" value="PUT">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.attr.value.list') }}</h3></div>
				<div class="y"><a href="{{ route('admin.attr.value.index') }}" class="btn">< {{ trans('admin.attr.value.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.attr.attr.title') }}</td>
					<td>
						<select name="attr_id" class="select">
							<option value="0">请选择</option>
							@foreach ($attrlist as $attr)
								<option value="{{ $attr->attr_id }}" {!! $attrvalue->attr_id == $attr->attr_id ? 'selected' : '' !!}>{{ $attr->title }}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.attr.attr.title') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $attrvalue->title }}" name="title"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.displayorder') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $attrvalue->displayorder }}" name="displayorder"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection