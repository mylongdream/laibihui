@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.attr.attr') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.attr.attr.store') }}">
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.attr.attr.create') }}</h3></div>
				<div class="y"><a href="{{ route('admin.attr.attr.index') }}" class="btn">< {{ trans('admin.attr.attr.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.attr.attr.title') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="title"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.attr.attr.attr_key') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="attr_key"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.displayorder') }}</td>
					<td><input class="txt" type="text" size="50" value="0" name="displayorder"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection