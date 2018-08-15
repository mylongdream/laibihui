@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.mall.product') }}</h3></div>
		<ul class="tab">
			<li><a href="{{ route('admin.mall.product.index') }}"><span>{{ trans('admin.mall.product.list') }}</span></a></li>
			<li class="current"><a href="{{ route('admin.mall.product.recycle') }}"><span>{{ trans('admin.recycle') }}</span></a></li>
		</ul>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.mall.product.recycle') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.mall.product.name') }}</dt>
			<dd><input type="text" name="name" class="schtxt" value="{{ request('name') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.mall.product.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.mall.product.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="50">{{ trans('admin.id') }}</th>
				<th>{{ trans('admin.mall.product.name') }}</th>
				<th width="100">{{ trans('admin.mall.product.category') }}</th>
				<th width="100">{{ trans('admin.mall.product.viewnum') }}</th>
				<th width="150">{{ trans('admin.created_at') }}</th>
				<th width="150">{{ trans('admin.deleted_at') }}</th>
				<th width="70">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($products as $value)
			<tr>
				<td>{{ $value->id }}</td>
				<td>{{ $value->name }}</td>
				<td>{{ $value->category ? $value->category->name : '/' }}</td>
				<td>{{ $value->viewnum }} 次</td>
				<td>{{ $value->created_at->format('Y-m-d H:i') }}</td>
				<td>{{ $value->deleted_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.mall.product.restore',$value->id) }}" class="restorebtn" title="{{ trans('admin.mall.product.restore') }}">{{ trans('admin.restore') }}</a>
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