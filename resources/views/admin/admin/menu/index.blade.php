@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.admin.menu') }}</h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.admin.menu.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.admin.menu.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.admin.menu.create') }}" class="btn openwindow" title="{{ trans('admin.admin.menu.create') }}">+ {{ trans('admin.admin.menu.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="100">{{ trans('admin.displayorder') }}</th>
				<th width="300">{{ trans('admin.admin.menu.title') }}</th>
				<th>{{ trans('admin.admin.menu.url') }}</th>
				<th width="100">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($menulist as $menu)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $menu->id }}" name="ids[]"></td>
				<td>{!! str_repeat('<div class="childnode">',$menu->count-1) !!}<input type="text" class="txt" name="displayorder[{{ $menu->id }}]" value="{{ $menu->displayorder }}" style="width:40px">{!! str_repeat('</div>',$menu->count-1) !!}</td>
				<td>{!! str_repeat('<div class="childnode">',$menu->count-1) !!}<input type="text" class="txt" name="title[{{ $menu->id }}]" value="{{ $menu->title }}">{!! str_repeat('</div>',$menu->count-1) !!}</td>
				<td>{{ $menu->route ? route($menu->route) : '/' }}</td>
				<td>
					<a href="{{ route('admin.admin.menu.edit',$menu->id) }}" class="openwindow" title="{{ trans('admin.admin.menu.edit') }}">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.admin.menu.destroy',$menu->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($menulist) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
			<button class="submitbtn" name="updatesubmit" value="yes" type="submit">{{ trans('admin.update') }}</button>
		</div>
    </div>
	@endif
	</form>
@endsection