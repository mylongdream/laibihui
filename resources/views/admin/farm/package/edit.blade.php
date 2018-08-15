@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.farm.package') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.farm.package.update', ['farm_id' => request('farm_id'), 'id' => $package->id]) }}">
		{!! method_field('PUT') !!}
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
                <div class="z"><h3>{{ trans('admin.farm.package.edit') }}</h3></div>
				<div class="y"><a href="{{ route('admin.farm.package.index', ['farm_id' => request('farm_id')]) }}" class="btn">< {{ trans('admin.farm.package.list') }}</a></div>
			</div>
			<table>
				<tbody class="tb-body">
				<tr>
					<td width="150" align="right">{{ trans('admin.farm.farm.name') }}</td>
					<td>{{ $package->farm->name }}<input type="hidden" name="farm_id" value="{{ $package->farm->id }}" /></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.farm.package.name') }}</td>
					<td><input class="txt" type="text" size="50" value="{{ $package->name }}" name="name"></td>
				</tr>
				<tr>
					<td align="right">{{ trans('admin.farm.package.price') }}</td>
					<td><input class="txt" type="text" size="20" value="{{ $package->price }}" name="price"> 元<span class="tdtip"></span></td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.farm.package.onsale') }}</td>
					<td>
						<label class="radio" for="onsale_1">
							<input id="onsale_1" type="radio" name="onsale" value="1" checked> {{ trans('admin.yes') }}
						</label>
						<label class="radio" for="onsale_0">
							<input id="onsale_0" type="radio" name="onsale" value="0"> {{ trans('admin.no') }}
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