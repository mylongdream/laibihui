@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.admin.group') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.admin.group.store') }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.admin.group.create') }}</h3></div>
				<div class="y"><a href="{{ route('admin.admin.group.index') }}" class="btn">< {{ trans('admin.admin.group.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.admin.group.name') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="name"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.admin.group.description') }}</td>
					<td><textarea class="textarea" name="description" cols="60" rows="4"></textarea></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.displayorder') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="displayorder"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection