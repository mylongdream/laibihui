@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.mall.product') }}</h3></div>
		<ul class="tab">
			<li class="current"><a href="{{ route('admin.mall.product.index') }}"><span>{{ trans('admin.mall.product.list') }}</span></a></li>
			<li><a href="{{ route('admin.mall.product.recycle') }}"><span>{{ trans('admin.recycle') }}</span></a></li>
		</ul>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.mall.product.index') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.mall.product.category') }}</dt>
			<dd>
				<select class="schselect" name="catid">
					<option value="">请选择</option>
					@foreach ($categorylist as $scategory)
						<option value="{{ $scategory->id }}" {!! request('catid') == $scategory->id ? 'selected="selected"' : '' !!}>{{ str_repeat('->',$scategory->count-1) }}{{ $scategory->name }}</option>
					@endforeach
				</select>
			</dd>
		</dl>
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
			<div class="y"><a href="{{ route('admin.mall.product.create', ['shopid' => request('shopid')]) }}" class="btn" title="{{ trans('admin.mall.product.create') }}">+ {{ trans('admin.mall.product.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th>{{ trans('admin.mall.product.name') }}</th>
				<th width="100">{{ trans('admin.mall.product.category') }}</th>
				<th width="80">{{ trans('admin.mall.product.viewnum') }}</th>
				<th width="120">{{ trans('admin.created_at') }}</th>
				<th width="80">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($products as $value)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $value->id }}" name="ids[]"></td>
				<td><a href="{{ route('mall.product.detail',$value->id) }}" target="_blank">{{ $value->name }}</a></td>
				<td>{{ $value->category ? $value->category->name : '/' }}</td>
				<td>{{ $value->viewnum }} 次</td>
				<td>{{ $value->created_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.mall.product.edit',$value->id) }}" class="" title="{{ trans('admin.mall.product.edit') }}">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.mall.product.destroy',$value->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($products) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
		<div class="page y">
			{!! $products->appends(['name' => request('name')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection