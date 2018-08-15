@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.brand.allot') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.brand.allot.store', ['shopid' => request('shopid')]) }}">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.brand.allot.create', ['shopid' => request('shopid')]) }}</h3></div>
				<div class="y"><a href="{{ route('admin.brand.allot.index', ['shopid' => request('shopid')]) }}" class="btn">< {{ trans('admin.brand.allot.list') }}</a></div>
			</div>
			<table>
				<tbody class="tb-body">
				<tr>
					<td width="150" align="right">{{ trans('admin.brand.allot.shop') }}</td>
					<td>
						@if (request('shopid'))
							@foreach ($shoplist as $value)
								@if (request('shopid') == $value->id)
									{{ $value->name }}
									<input type="hidden" name="shopid" value="{{ request('shopid') }}">
								@endif
							@endforeach
						@else
							<select name="shop_id" class="select select_shop">
								<option value="0">请选择</option>
								@foreach ($shoplist as $value)
									<option value="{{ $value->id }}" {{ request('shopid') == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
								@endforeach
							</select>
						@endif
					</td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.allot.quantity') }}</td>
					<td><input class="txt" type="text" size="50" value="" name="quantity"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.brand.allot.price') }}</td>
					<td><input class="txt" type="text" size="30" value="" name="price"> 元</td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection