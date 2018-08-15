@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.brand.mealcate') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.brand.mealcate.store') }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.brand.mealcate.create') }}</h3></div>
				<div class="y"><a href="{{ route('admin.brand.mealcate.index') }}" class="btn">< {{ trans('admin.brand.mealcate.list') }}</a></div>
			</div>
			<table>
				<tbody class="tb-body">
				<tr>
					<td width="150" align="right">{{ trans('admin.brand.mealcate.shop') }}</td>
					<td>
						<select name="shop_id" class="select">
							<option value="0">请选择</option>
							@foreach ($shoplist as $value)
								<option value="{{ $value->id }}" {{ request('shopid') == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.mealcate.name') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="name"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.displayorder') }}</td>
					<td><input class="txt" type="text" size="30" value="" name="displayorder"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection