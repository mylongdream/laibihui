@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.mall.category') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.mall.category.update', $category->id) }}">
		<input type="hidden" name="_method" value="PUT">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.mall.category.edit') }}</h3></div>
				<div class="y"><a href="{{ route('admin.mall.category.index') }}" class="btn">< {{ trans('admin.mall.category.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.mall.category.parentid') }}</td>
					<td>
						<select id="parentid" class="select" name="parentid">
							<option value="">请选择上级菜单</option>
							@foreach ($categorylist as $scategory)
								<option value="{{ $scategory->id }}" {!! $category->parentid == $scategory->id ? 'selected="selected"' : '' !!}>{{ str_repeat('->',$scategory->count-1) }}{{ $scategory->name }}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.mall.category.name') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $category->name }}" name="name"></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.mall.category.upimage') }}</td>
					<td>
						<a href="javascript:;" class="upbtn" id="upimage">上传图片</a><span class="tdtip"></span>
						<div class="uploadbox"><ul></ul></div>
					</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.mall.category.description') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $category->description }}" name="description"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection