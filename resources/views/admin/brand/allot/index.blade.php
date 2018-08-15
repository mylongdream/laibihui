@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.brand.allot') }}</h3></div>
	</div>
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.brand.allot.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.brand.allot.create', ['shopid' => request('shopid')]) }}" class="btn openwindow" title="{{ trans('admin.brand.allot.create') }}">+ {{ trans('admin.brand.allot.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th>{{ trans('admin.brand.allot.shop') }}</th>
				<th width="120">{{ trans('admin.brand.allot.cardlist') }}</th>
				<th width="120">{{ trans('admin.brand.allot.quantity') }}</th>
				<th width="90">{{ trans('admin.brand.allot.price') }}</th>
				<th width="120">{{ trans('admin.created_at') }}</th>
				<th width="90">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($allots as $value)
			<tr>
				<td>{{ $value->shop ? $value->shop->name : '/' }}</td>
				<td><a href="{{ route('admin.brand.allot.cardlist', ['shopid' => request('shopid'), 'id' => $value->id]) }}">{{ $value->cardlist->count() }}</a></td>
				<td>{{ $value->quantity }}</td>
				<td>{{ $value->price }} 元</td>
				<td>{{ $value->created_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.brand.allot.edit', ['shopid' => request('shopid'), 'id' => $value->id]) }}" title="{{ trans('admin.brand.allot.edit') }}" class="openwindow">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.brand.allot.destroy', ['shopid' => request('shopid'), 'id' => $value->id]) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($allots) > 0)
	<div class="pgs cl">
		<div class="page y">
			{!! $allots->appends(['shopid' => request('shopid')])->appends(['name' => request('name')])->links() !!}
		</div>
    </div>
	@endif
@endsection