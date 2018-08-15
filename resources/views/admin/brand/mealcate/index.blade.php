@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.brand.mealcate') }}</h3></div>
		<ul class="tab">
			<li><a href="{{ route('admin.brand.meal.index') }}"><span>{{ trans('admin.brand.meal.list') }}</span></a></li>
			<li class="current"><a href="{{ route('admin.brand.mealcate.index') }}"><span>{{ trans('admin.brand.mealcate.list') }}</span></a></li>
		</ul>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.brand.mealcate.index') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.brand.mealcate.shop') }}</dt>
			<dd>
				<select class="schselect" name="shopid">
					<option value="">请选择</option>
					@foreach ($shoplist as $value)
						<option value="{{ $value->id }}" {!! request('shopid') == $value->id ? 'selected="selected"' : '' !!}>{{ $value->name }}</option>
					@endforeach
				</select>
			</dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.brand.mealcate.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.brand.mealcate.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.brand.mealcate.create', ['shopid' => request('shopid')]) }}" class="btn openwindow" title="{{ trans('admin.brand.mealcate.create') }}">+ {{ trans('admin.brand.mealcate.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th>{{ trans('admin.brand.mealcate.name') }}</th>
				<th width="220">{{ trans('admin.brand.mealcate.shop') }}</th>
				<th width="120">{{ trans('admin.created_at') }}</th>
				<th width="90">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($mealcates as $value)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $value->id }}" name="ids[]"></td>
				<td>{{ $value->name or '/' }}</td>
				<td>{{ $value->shop ? $value->shop->name : '/' }}</td>
				<td>{{ $value->created_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.brand.mealcate.edit',$value->id) }}" title="{{ trans('admin.brand.mealcate.edit') }}" class="openwindow">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.brand.mealcate.destroy',$value->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($mealcates) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
		<div class="page y">
			{!! $mealcates->appends(['shopid' => request('shopid')])->appends(['name' => request('name')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection