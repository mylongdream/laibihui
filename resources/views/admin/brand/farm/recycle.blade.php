@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.brand.farm') }}</h3></div>
		<ul class="tab">
			<li><a href="{{ route('admin.brand.farm.index') }}"><span>{{ trans('admin.brand.farm.list') }}</span></a></li>
			<li class="current"><a href="{{ route('admin.brand.farm.recycle') }}"><span>{{ trans('admin.recycle') }}</span></a></li>
		</ul>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.brand.farm.recycle') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.brand.farm.name') }}</dt>
			<dd><input type="text" name="name" class="schtxt" value="{{ request('name') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.brand.farm.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.brand.farm.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="40">{{ trans('admin.id') }}</th>
				<th width="180">{{ trans('admin.brand.farm.name') }}</th>
				<th>{{ trans('admin.brand.farm.address') }}</th>
				<th width="60">{{ trans('admin.brand.farm.price') }}</th>
				<th width="60">{{ trans('admin.brand.farm.viewnum') }}</th>
				<th width="90">{{ trans('admin.brand.farm.subweb') }}</th>
				<th width="120">{{ trans('admin.created_at') }}</th>
				<th width="120">{{ trans('admin.deleted_at') }}</th>
				<th width="50">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($farms as $farm)
			<tr>
				<td>{{ $farm->id }}</td>
				<td>{{ $farm->name }}</td>
				<td>{{ $farm->address or '/' }}</td>
				<td>{{ $farm->price }} 元</td>
				<td>{{ $farm->viewnum }} 次</td>
				<td>{{ $farm->subweb->name or '/' }}</td>
				<td>{{ $farm->created_at->format('Y-m-d H:i') }}</td>
				<td>{{ $farm->deleted_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.brand.farm.restore',$farm->id) }}" class="restorebtn" title="{{ trans('admin.brand.farm.restore') }}">{{ trans('admin.restore') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($farms) > 0)
	<div class="pgs cl">
		<div class="page y">
			{!! $farms->appends(['name' => request('name')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection