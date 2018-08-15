@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.setting.style') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.setting.style.update') }}">
		{!! method_field('PUT') !!}
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z">
					<h3>{{ trans('admin.setting.style') }}</h3>
				</div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.style.promotion_register') }}</td>
					<td><input class="txt" type="text" size="20" value="{{ $setting['promotion_register'] or '' }}" name="setting[promotion_register]"> 个<span class="tdtip">推荐用户注册可得积分数</span></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.style.censoruser') }}</td>
					<td><textarea class="textarea" name="censoruser" cols="50" rows="4">{{ $setting['censoruser'] or '' }}</textarea><span class="tdtip">用户名中无法使用这些关键字。每个关键字一行，可使用通配符 "*" 如 "*admin*"(不含引号)</span></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.style.buycard') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['buycard_mobile'] or '' }}" name="setting[buycard_mobile]"><span class="tdtip">用户预约办卡成功后会发送提醒短信到该手机上</span></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.style.subwebstatus') }}</td>
					<td>
						<label class="radio" for="subwebstatus_1">
							<input id="subwebstatus_1" type="radio" name="setting[subwebstatus]" value="1" {{ isset($setting['subwebstatus'])&&$setting['subwebstatus'] ? 'checked' : '' }}> {{ trans('admin.yes') }}
						</label>
						<label class="radio" for="subwebstatus_0">
							<input id="subwebstatus_0" type="radio" name="setting[subwebstatus]" value="0" {{ isset($setting['subwebstatus'])&&$setting['subwebstatus'] ? '' : 'checked' }}> {{ trans('admin.no') }}
						</label>
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.style.linkstatus') }}</td>
					<td>
						<label class="radio" for="linkstatus_1">
							<input id="linkstatus_1" type="radio" name="setting[linkstatus]" value="1" {{ isset($setting['linkstatus'])&&$setting['linkstatus'] ? 'checked' : '' }}> {{ trans('admin.yes') }}
						</label>
						<label class="radio" for="linkstatus_0">
							<input id="linkstatus_0" type="radio" name="setting[linkstatus]" value="0" {{ isset($setting['linkstatus'])&&$setting['linkstatus'] ? '' : 'checked' }}> {{ trans('admin.no') }}
						</label>
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