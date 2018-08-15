@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.user.group') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.user.group.update', $group->id) }}">
		{!! method_field('PUT') !!}
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.user.group.edit') }}</h3></div>
				<div class="y"><a href="{{ route('admin.user.group.index') }}" class="btn">< {{ trans('admin.user.group.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.user.group.name') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $group->name }}" name="name"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.user.group.description') }}</td>
					<td><textarea class="textarea" name="description" cols="60" rows="4">{{ $group->description }}</textarea></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.displayorder') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $group->displayorder }}" name="displayorder"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection