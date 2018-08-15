@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.setting.nav') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.setting.nav.update', $nav->id) }}">
		<input type="hidden" name="_method" value="PUT">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.setting.nav.edit') }}</h3></div>
				<div class="y"><a href="{{ route('admin.setting.nav.index') }}" class="btn">< {{ trans('admin.setting.nav.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.nav.parentid') }}</td>
					<td>
						<select id="parentid" class="select" name="parentid">
							<option value="">请选择上级菜单</option>
							@foreach ($navlist as $snav)
								<option value="{{ $snav->id }}" {!! $nav->parentid == $snav->id ? 'selected="selected"' : '' !!}>{{ str_repeat('->',$snav->count-1) }}{{ $snav->title }}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.nav.title') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $nav->title }}" name="title"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.nav.url') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $nav->url }}" name="route"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.setting.nav.hidden') }}</td>
					<td>
						<label class="radio" for="hidden_1">
							<input id="hidden_1" name="hidden" value="1" type="radio" {!! $nav->hidden ? 'checked="checked"' : '' !!}> 是
						</label>
						<label class="radio" for="hidden_0">
							<input id="hidden_0" name="hidden" value="0" type="radio" {!! $nav->hidden ? '' : 'checked="checked"' !!}> 否
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