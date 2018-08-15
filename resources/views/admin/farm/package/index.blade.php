@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.farm.package') }}</h3></div>
	</div>
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.farm.farm.name') }}</dt>
			<dd><span class="text">{{ $farm ? $farm->name : '' }}</span></dd>
		</dl>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.farm.package.batch', ['farm_id' => request('farm_id')]) }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.farm.package.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.farm.package.create', ['farm_id' => request('farm_id')]) }}" class="openwindow btn" title="{{ trans('admin.farm.package.create') }}">+ {{ trans('admin.farm.package.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="80">{{ trans('admin.displayorder') }}</th>
				<th>{{ trans('admin.farm.farm.name') }}</th>
				<th>{{ trans('admin.farm.package.name') }}</th>
				<th width="100">{{ trans('admin.farm.package.price') }}</th>
				<th width="80">{{ trans('admin.farm.package.onsale') }}</th>
				<th width="80">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($packages as $value)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $value->id }}" name="ids[]"></td>
				<td><input type="text" class="txt" name="displayorder[{{ $value->id }}]" value="{{ $value->displayorder }}" size="2"></td>
				<td>{{ $value->farm ? $value->farm->name : '' }}</td>
				<td>{{ $value->name }}</td>
				<td>{{ $value->price }} 元</td>
				<td>{{ $value->onsale ? trans('admin.yes') : trans('admin.no') }}</td>
				<td>
					<a href="{{ route('admin.farm.package.edit', ['farm_id' => request('farm_id'), 'id' => $value->id]) }}" class="openwindow" title="{{ trans('admin.farm.package.edit') }}">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.farm.package.destroy', ['farm_id' => request('farm_id'), 'id' => $value->id]) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($packages) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
			<button class="submitbtn" name="updatesubmit" value="yes" type="submit">{{ trans('admin.update') }}</button>
		</div>
		<div class="page y">
			{!! $packages->appends(['name' => request('name')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection