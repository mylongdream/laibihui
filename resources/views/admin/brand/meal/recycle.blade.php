@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.brand.shop') }}</h3></div>
		<ul class="tab">
			<li><a href="{{ route('admin.brand.shop.index') }}"><span>{{ trans('admin.brand.shop.list') }}</span></a></li>
			<li class="current"><a href="{{ route('admin.brand.shop.recycle') }}"><span>{{ trans('admin.recycle') }}</span></a></li>
		</ul>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.brand.shop.recycle') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.brand.shop.name') }}</dt>
			<dd><input type="text" name="name" class="schtxt" value="{{ request('name') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.brand.shop.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.brand.shop.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="40">{{ trans('admin.id') }}</th>
				<th width="180">{{ trans('admin.brand.shop.name') }}</th>
				<th>{{ trans('admin.brand.shop.address') }}</th>
				<th width="60">{{ trans('admin.brand.shop.discount') }}</th>
				<th width="60">{{ trans('admin.brand.shop.viewnum') }}</th>
				<th width="90">{{ trans('admin.brand.shop.subweb') }}</th>
				<th width="120">{{ trans('admin.created_at') }}</th>
				<th width="120">{{ trans('admin.deleted_at') }}</th>
				<th width="50">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($shops as $shop)
			<tr>
				<td>{{ $shop->id }}</td>
				<td>{{ $shop->name }}</td>
				<td>{{ $shop->address or '/' }}</td>
				<td>{{ $shop->discount }} 折</td>
				<td>{{ $shop->viewnum }} 次</td>
				<td>{{ $shop->subweb->name or '/' }}</td>
				<td>{{ $shop->created_at->format('Y-m-d H:i') }}</td>
				<td>{{ $shop->deleted_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.brand.shop.restore',$shop->id) }}" class="restorebtn" title="{{ trans('admin.brand.shop.restore') }}">{{ trans('admin.restore') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($shops) > 0)
	<div class="pgs cl">
		<div class="page y">
			{!! $shops->appends(['name' => request('name')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection