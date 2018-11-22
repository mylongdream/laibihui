@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.setting.commission') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.setting.commission.update') }}">
		{!! method_field('PUT') !!}
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z">
					<h3>{{ trans('admin.setting.commission') }}</h3>
				</div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.wechat.name') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['wechat_name'] or '' }}" name="setting[wechat_name]"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.wechat.id') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['wechat_id'] or '' }}" name="setting[wechat_id]"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.wechat.originid') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['wechat_originid'] or '' }}" name="setting[wechat_originid]"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.wechat.followurl') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['wechat_followurl'] or '' }}" name="setting[wechat_followurl]"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.wechat.qrcode') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['wechat_qrcode'] or '' }}" name="setting[wechat_qrcode]"></td>
				</tr>
				<tr>
					<td colspan="2" class="partition"><strong>开发者ID</strong> (如果您希望设置微信自定义菜单并拥有公众号“开发者 ID”，请把该信息填写此栏目中)</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.setting.wechat.appid') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['wechat_appid'] or '' }}" name="setting[wechat_appid]"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.setting.wechat.appsecret') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['wechat_appsecret'] or '' }}" name="setting[wechat_appsecret]"></td>
				</tr>
				<tr>
					<td colspan="2" class="partition"><strong>微信支付</strong> (如果您希望使用微信支付等功能，请把该信息填写此栏目中)</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.setting.wechat.mchid') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['wechat_mchid'] or '' }}" name="setting[wechat_mchid]"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.setting.wechat.apikey') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['wechat_apikey'] or '' }}" name="setting[wechat_apikey]"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.setting.wechat.certpath') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['wechat_certpath'] or '' }}" name="setting[wechat_certpath]"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.setting.wechat.keypath') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['wechat_keypath'] or '' }}" name="setting[wechat_keypath]"></td>
				</tr>
				<tr>
					<td colspan="2" class="partition"><strong>服务器配置</strong> (如果您希望使用微信关键词回复等功能，请把此栏中的内容填写到微信公众平台“开发者中心”设置中)</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.setting.wechat.serverurl') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['wechat_serverurl'] or '' }}" name="setting[wechat_serverurl]"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.setting.wechat.token') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['wechat_token'] or '' }}" name="setting[wechat_token]"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.setting.wechat.encodingaeskey') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['wechat_encodingaeskey'] or '' }}" name="setting[wechat_encodingaeskey]"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.setting.wechat.encrypttype') }}</td>
					<td>
                        <label class="radio" for="encrypttype_0">
                            <input id="encrypttype_0" name="setting[wechat_encrypttype]" value="0" type="radio" {{ isset($setting['wechat_encrypttype'])&&$setting['wechat_encrypttype'] ? '' : 'checked' }}>
                            {{ trans('admin.setting.wechat.encrypttype_0') }}
                        </label>
                        <label class="radio" for="encrypttype_1">
                            <input id="encrypttype_1" name="setting[wechat_encrypttype]" value="1" type="radio" {{ isset($setting['wechat_encrypttype'])&&$setting['wechat_encrypttype']==1 ? 'checked' : '' }}>
                            {{ trans('admin.setting.wechat.encrypttype_1') }}
                        </label>
                        <label class="radio" for="encrypttype_2">
                            <input id="encrypttype_2" name="setting[wechat_encrypttype]" value="2" type="radio" {{ isset($setting['wechat_encrypttype'])&&$setting['wechat_encrypttype']==2 ? 'checked' : '' }}>
                            {{ trans('admin.setting.wechat.encrypttype_2') }}
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