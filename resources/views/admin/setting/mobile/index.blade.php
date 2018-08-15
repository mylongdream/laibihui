@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.setting.mobile') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.setting.mobile.update') }}">
		{!! method_field('PUT') !!}
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z">
					<ul class="tb-tab">
						<li class="current"><span>{{ trans('admin.info_base') }}</span></li>
						<li><span>{{ trans('admin.info_seo') }}</span></li>
					</ul>
				</div>
			</div>
			<table>
				<tbody class="tb-body">
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.mobile.bbname') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['mobile_bbname'] or '' }}" name="setting[mobile_bbname]"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.mobile.url') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['mobile_url'] or '' }}" name="setting[mobile_url]"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.setting.mobile.forward') }}</td>
					<td>
						<label class="radio" for="forward_1">
							<input id="forward_1" type="radio" name="setting[mobile_forward]" value="1" {{ isset($setting['mobile_forward'])&&$setting['mobile_forward'] ? 'checked' : '' }}> {{ trans('admin.yes') }}
						</label>
						<label class="radio" for="forward_0">
							<input id="forward_0" type="radio" name="setting[mobile_forward]" value="0" {{ isset($setting['mobile_forward'])&&$setting['mobile_forward'] ? '' : 'checked' }}> {{ trans('admin.no') }}
						</label>
					</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.setting.mobile.bbclosed') }}</td>
					<td>
						<label class="radio" for="bbclosed_1">
							<input id="bbclosed_1" type="radio" name="setting[mobile_bbclosed]" value="1" {{ isset($setting['mobile_bbclosed'])&&$setting['mobile_bbclosed'] ? 'checked' : '' }}> {{ trans('admin.yes') }}
						</label>
						<label class="radio" for="bbclosed_0">
							<input id="bbclosed_0" type="radio" name="setting[mobile_bbclosed]" value="0" {{ isset($setting['mobile_bbclosed'])&&$setting['mobile_bbclosed'] ? '' : 'checked' }}> {{ trans('admin.no') }}
						</label>
					</td>
				</tr>
				</tbody>
				<tbody class="tb-body hidden">
				<tr>
					<td width="150" align="right">seo_title</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['mobile_seo_title'] or '' }}" name="setting[mobile_seo_title]"></td>
				</tr>
				<tr>
					<td width="150" align="right">seo_keywords</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['mobile_seo_keywords'] or '' }}" name="setting[mobile_seo_keywords]"></td>
				</tr>
				<tr>
					<td width="150" align="right">seo_description</td>
					<td><textarea class="textarea" name="setting[mobile_seo_description]" cols="60" rows="5">{{ $setting['mobile_seo_description'] or '' }}</textarea></td>
				</tr>
				</tbody>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection