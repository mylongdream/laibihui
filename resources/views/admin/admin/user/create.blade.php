@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.admin.user') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.admin.user.store') }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.admin.user.create') }}</h3></div>
				<div class="y"><a href="{{ route('admin.admin.user.index') }}" class="btn">< {{ trans('admin.admin.user.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.admin.user.group') }}</td>
					<td>
						<select name="group_id" class="select">
							<option value="0">请选择</option>
							@foreach ($grouplist as $group)
								<option value="{{ $group->id }}">{{ $group->name }}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.admin.user.username') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="username"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.admin.user.password') }}</td>
					<td><input class="txt" type="password" size="50" value="" name="password"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.admin.user.password_confirmation') }}</td>
					<td><input class="txt" type="password" size="50" value="" name="password_confirmation"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.admin.user.email') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="email"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.admin.user.mobile') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="mobile"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection