@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.user.score') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.user.score.store') }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.user.score.create') }}</h3></div>
				<div class="y"><a href="{{ route('admin.admin.user.index') }}" class="btn">< {{ trans('admin.user.score.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.user.score.username') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="username"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.user.score.score') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="score"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.user.score.remark') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="remark"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection