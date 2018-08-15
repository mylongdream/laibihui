@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.province') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.province.store') }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.province.list') }}</h3></div>
				<div class="y"><a href="{{ route('admin.province.index') }}" class="btn">< {{ trans('admin.province.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.province.name') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="province_name"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.province.firstletter') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="firstletter" maxlength="1"></td>
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