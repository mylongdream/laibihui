@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.user.user') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.user.user.group', $user->uid) }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.user.user.group') }}</h3></div>
				<div class="y"><a href="{{ route('admin.user.user.index') }}" class="btn">< {{ trans('admin.user.user.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.user.user.group') }}</td>
					<td>
						<select name="group_id" class="select">
							<option value="0">请选择</option>
							@foreach ($grouplist as $group)
								<option value="{{ $group->id }}" {!! $user->group_id == $group->id ? 'selected="selected"' : '' !!}>{{ $group->name }}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection