@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.brand.category') }}</h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.brand.category.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.brand.category.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.brand.category.create') }}" class="btn openwindow" title="{{ trans('admin.brand.category.create') }}">+ {{ trans('admin.brand.category.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="100">{{ trans('admin.displayorder') }}</th>
				<th width="300">{{ trans('admin.brand.category.name') }}</th>
				<th>{{ trans('admin.brand.category.description') }}</th>
				<th width="100">{{ trans('admin.brand.shop') }}</th>
				<th width="120">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($categorylist as $category)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $category->id }}" name="ids[]"></td>
				<td>{!! str_repeat('<div class="childnode">',$category->count-1) !!}<input type="text" class="txt" name="displayorder[{{ $category->id }}]" value="{{ $category->displayorder }}" style="width:40px">{!! str_repeat('</div>',$category->count-1) !!}</td>
				<td>{!! str_repeat('<div class="childnode">',$category->count-1) !!}<input type="text" class="txt" name="name[{{ $category->id }}]" value="{{ $category->name }}">{!! str_repeat('</div>',$category->count-1) !!}</td>
				<td>{{ $category->description ? $category->description : '/' }}</td>
				<td><a href="{{ route('admin.brand.shop.index',['catid' => $category->id]) }}">{{ count($category->shoplist) }}</a></td>
				<td>
                    <a href="{{ route('admin.brand.category.move',$category->id) }}" class="openwindow" title="{{ trans('admin.brand.category.move') }}">{{ trans('admin.move') }}</a>
					<a href="{{ route('admin.brand.category.edit',$category->id) }}" class="mlm openwindow" title="{{ trans('admin.brand.category.edit') }}">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.brand.category.destroy',$category->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($categorylist) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
			<button class="submitbtn" name="updatesubmit" value="yes" type="submit">{{ trans('admin.update') }}</button>
		</div>
    </div>
	@endif
	</form>
@endsection