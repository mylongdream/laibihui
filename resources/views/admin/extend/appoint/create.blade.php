@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.friendlink') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.extend.friendlink.store') }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.extend.friendlink.list') }}</h3></div>
				<div class="y"><a href="{{ route('admin.extend.friendlink.index') }}" class="btn">< {{ trans('admin.extend.friendlink.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.friendlink.title') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="title"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.friendlink.url') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="url"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.friendlink.description') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="description"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.extend.friendlink.logo') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="logo"></td>
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