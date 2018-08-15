@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.mall.category') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.mall.category.move', $category->id) }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.mall.category.move') }}</h3></div>
				<div class="y"><a href="{{ route('admin.mall.category.index') }}" class="btn">< {{ trans('admin.mall.category.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">当前分类</td>
					<td>
						{{ $category->name }}
					</td>
				</tr>
				<tr>
					<td width="150" align="right">移动到</td>
					<td>
						<select class="select" name="catid">
							<option value="">请选择分类</option>
							@foreach ($categorylist as $scategory)
								<option value="{{ $scategory->id }}">{{ str_repeat('->',$scategory->count-1) }}{{ $scategory->name }}</option>
							@endforeach
						</select>
						<span class="tdtip">当前分类下的店铺移动到该分类下</span>
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