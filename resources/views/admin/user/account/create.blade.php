@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.user.account') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.user.account.store') }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.user.account.create') }}</h3></div>
				<div class="y"><a href="{{ route('admin.user.account.index') }}" class="btn">< {{ trans('admin.user.account.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.user.account.username') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="username"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.user.account.account') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="account"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.user.account.remark') }}</td>
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