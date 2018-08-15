@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.brand.product') }}</h3></div>
		<ul class="tab">
			<li><a href="{{ route('admin.brand.product.index') }}"><span>{{ trans('admin.brand.product.list') }}</span></a></li>
			<li class="current"><a href="{{ route('admin.brand.product.recycle') }}"><span>{{ trans('admin.recycle') }}</span></a></li>
		</ul>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.brand.product.recycle') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.brand.product.name') }}</dt>
			<dd><input type="text" name="name" class="schtxt" value="{{ request('name') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.brand.product.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.brand.product.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="50">{{ trans('admin.id') }}</th>
				<th>{{ trans('admin.brand.product.name') }}</th>
				<th width="100">{{ trans('admin.brand.product.subweb') }}</th>
				<th width="100">{{ trans('admin.brand.product.viewnum') }}</th>
				<th width="150">{{ trans('admin.created_at') }}</th>
				<th width="150">{{ trans('admin.deleted_at') }}</th>
				<th width="70">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($products as $product)
			<tr>
				<td>{{ $product->id }}</td>
				<td>{{ $product->name }}</td>
				<td>{{ $product->subweb->name or '/' }}</td>
				<td>{{ $product->viewnum }} 次</td>
				<td>{{ $product->created_at->format('Y-m-d H:i') }}</td>
				<td>{{ $product->deleted_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.brand.product.restore',$product->id) }}" class="restorebtn" title="{{ trans('admin.brand.product.restore') }}">{{ trans('admin.restore') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($products) > 0)
	<div class="pgs cl">
		<div class="page y">
			{!! $products->appends(['name' => request('name')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection