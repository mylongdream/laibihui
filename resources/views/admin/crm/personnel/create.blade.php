@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.crm.personnel') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.crm.personnel.store') }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.crm.personnel.create') }}</h3></div>
				<div class="y"><a href="{{ route('admin.crm.user.index') }}" class="btn">< {{ trans('admin.crm.personnel.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.personnel.topusername') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="topusername"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.personnel.subusername') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="subusername"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection