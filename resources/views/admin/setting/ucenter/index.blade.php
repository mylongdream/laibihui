@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.setting.ucenter') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.setting.ucenter.update') }}">
		{!! method_field('PUT') !!}
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z">
					<h3>{{ trans('admin.setting.ucenter') }}</h3>
				</div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.ucenter.appid') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['uc_appid'] or '' }}" name="setting[uc_appid]"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.ucenter.key') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['uc_key'] or '' }}" name="setting[uc_key]"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.ucenter.api') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['uc_api'] or '' }}" name="setting[uc_api]"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection