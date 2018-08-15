@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.admin.menu') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.admin.menu.update', $menu->id) }}">
		<input type="hidden" name="_method" value="PUT">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.admin.menu.edit') }}</h3></div>
				<div class="y"><a href="{{ route('admin.admin.menu.index') }}" class="btn">< {{ trans('admin.admin.menu.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.admin.menu.parentid') }}</td>
					<td>
						<select id="parentid" class="select" name="parentid">
							<option value="">请选择上级菜单</option>
							@foreach ($menulist as $smenu)
								<option value="{{ $smenu->id }}" {!! $menu->parentid == $smenu->id ? 'selected="selected"' : '' !!}>{{ str_repeat('->',$smenu->count-1) }}{{ $smenu->title }}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.admin.menu.title') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $menu->title }}" name="title"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.admin.menu.route') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $menu->route }}" name="route"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.admin.menu.hidden') }}</td>
					<td>
						<label class="radio" for="hidden_1">
							<input id="hidden_1" name="hidden" value="1" type="radio" {!! $menu->hidden ? 'checked="checked"' : '' !!}> 是
						</label>
						<label class="radio" for="hidden_0">
							<input id="hidden_0" name="hidden" value="0" type="radio" {!! $menu->hidden ? '' : 'checked="checked"' !!}> 否
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