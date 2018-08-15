@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.brand.meal') }}</h3></div>
		<ul class="tab">
			<li class="current"><a href="{{ route('admin.brand.meal.index') }}"><span>{{ trans('admin.brand.meal.list') }}</span></a></li>
			<li><a href="{{ route('admin.brand.mealcate.index') }}"><span>{{ trans('admin.brand.mealcate.list') }}</span></a></li>
		</ul>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.brand.meal.index') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.brand.meal.shop') }}</dt>
			<dd>
				<select class="schselect" name="shopid">
					<option value="">请选择</option>
					@foreach ($shoplist as $value)
						<option value="{{ $value->id }}" {!! request('shopid') == $value->id ? 'selected="selected"' : '' !!}>{{ $value->name }}</option>
					@endforeach
				</select>
			</dd>
		</dl>
		<dl>
			<dt>{{ trans('admin.brand.meal.name') }}</dt>
			<dd><input type="text" name="name" class="schtxt" value="{{ request('name') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.brand.meal.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.brand.meal.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.brand.meal.create', ['shopid' => request('shopid')]) }}" class="btn" title="{{ trans('admin.brand.meal.create') }}">+ {{ trans('admin.brand.meal.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th>{{ trans('admin.brand.meal.name') }}</th>
				<th width="220">{{ trans('admin.brand.meal.shop') }}</th>
				<th width="120">{{ trans('admin.brand.meal.category') }}</th>
				<th width="90">{{ trans('admin.brand.meal.price') }}</th>
				<th width="90">{{ trans('admin.brand.meal.onsale') }}</th>
				<th width="120">{{ trans('admin.created_at') }}</th>
				<th width="90">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($meals as $value)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $value->id }}" name="ids[]"></td>
				<td>{{ $value->name or '/' }}</td>
				<td>{{ $value->shop ? $value->shop->name : '/' }}</td>
				<td>{{ $value->category ? $value->category->name : '默认分类' }}</td>
				<td>{{ $value->price }} 元</td>
				<td>{{ trans('admin.brand.meal.onsale_'.$value->onsale) }}</td>
				<td>{{ $value->created_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.brand.meal.edit',$value->id) }}" title="{{ trans('admin.brand.meal.edit') }}" class="">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.brand.meal.destroy',$value->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($meals) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
		<div class="page y">
			{!! $meals->appends(['shopid' => request('shopid')])->appends(['name' => request('name')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection