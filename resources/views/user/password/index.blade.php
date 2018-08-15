@extends('layouts.user.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('user.password') }}</h3></div>
	</div>
	<div class="mtw">
		<div class="tbedit">
			<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('user.password.update') }}">
				{!! method_field('PUT') !!}
				{!! csrf_field() !!}
				<table>
					<tr>
						<td width="150" align="right">{{ trans('user.password.old') }}</td>
						<td><input class="input" type="password" size="50" value="" name="oldpassword" placeholder="请输入原密码"></td>
					</tr>
					<tr>
						<td align="right">{{ trans('user.password.new') }}</td>
						<td><input class="input" type="password" size="50" value="" name="newpassword" placeholder="请输入新密码"></td>
					</tr>
					<tr>
						<td align="right">{{ trans('user.password.confirm') }}</td>
						<td><input class="input" type="password" size="50" value="" name="newpassword_confirmation" placeholder="请确认新输入密码"></td>
					</tr>
					<tr>
						<td align="right"></td>
						<td><button value="true" name="savesubmit" type="submit" class="button">提 交</button></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
@endsection