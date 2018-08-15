@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.district') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.district.update', $district->id) }}">
		<input type="hidden" name="_method" value="PUT">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.district.list') }}</h3></div>
				<div class="y"><a href="{{ route('admin.district.index') }}" class="btn">< {{ trans('admin.district.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.district.parent') }}</td>
					<td>{{ $district->upid && $district->parent ? $district->parent->name : '/' }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.district.name') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $district->name }}" name="name"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.displayorder') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $district->displayorder }}" name="displayorder"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection