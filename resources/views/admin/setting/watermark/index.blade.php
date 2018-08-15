@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.setting.watermark') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.setting.watermark.update') }}">
		{!! method_field('PUT') !!}
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z">
					<h3>{{ trans('admin.setting.watermark') }}</h3>
				</div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.watermark.minwidthheight') }}</td>
					<td><input class="txt mrm" type="text" size="20" value="{{ $setting['watermark_minwidth'] or '0' }}" name="setting[watermark_minwidth]"> X <input class="txt mlm" type="text" size="20" value="{{ $setting['watermark_minheight'] or '0' }}" name="setting[watermark_minheight]"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.watermark.trans') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $setting['watermark_trans'] or '0' }}" name="setting[watermark_trans]"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection