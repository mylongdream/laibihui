@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.setting.basic') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.setting.basic.update') }}">
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
					<td width="150" align="right">{{ trans('admin.setting.basic.sitename') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['sitename'] or '' }}" name="setting[sitename]"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.basic.siteurl') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['siteurl'] or '' }}" name="setting[siteurl]"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.basic.adminemail') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['adminemail'] or '' }}" name="setting[adminemail]"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.basic.site_tel') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['site_tel'] or '' }}" name="setting[site_tel]"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.basic.site_qq') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['site_qq'] or '' }}" name="setting[site_qq]"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.basic.icp') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['icp'] or '' }}" name="setting[icp]"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.basic.stat') }}</td>
					<td><textarea class="textarea" name="setting[statcode]" cols="60" rows="5">{{ $setting['statcode'] or '' }}</textarea></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.setting.basic.bbclosed') }}</td>
					<td>
						<label class="radio" for="bbclosed_1">
							<input id="bbclosed_1" type="radio" name="setting[bbclosed]" value="1" {{ isset($setting['bbclosed'])&&$setting['bbclosed'] ? 'checked' : '' }}> {{ trans('admin.yes') }}
						</label>
						<label class="radio" for="bbclosed_0">
							<input id="bbclosed_0" type="radio" name="setting[bbclosed]" value="0" {{ isset($setting['bbclosed'])&&$setting['bbclosed'] ? '' : 'checked' }}> {{ trans('admin.no') }}
						</label>
					</td>
				</tr>
				</tbody>
				<tbody class="tb-body hidden">
				<tr>
					<td width="150" align="right">seo_title</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['seo_title'] or '' }}" name="setting[seo_title]"></td>
				</tr>
				<tr>
					<td width="150" align="right">seo_keywords</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['seo_keywords'] or '' }}" name="setting[seo_keywords]"></td>
				</tr>
				<tr>
					<td width="150" align="right">seo_description</td>
					<td><textarea class="textarea" name="setting[seo_description]" cols="60" rows="5">{{ $setting['seo_description'] or '' }}</textarea></td>
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