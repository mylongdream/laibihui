@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.setting.nav') }}</h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.setting.nav.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.setting.nav.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.setting.nav.create') }}" class="btn openwindow" title="{{ trans('admin.setting.nav.create') }}">+ {{ trans('admin.setting.nav.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="100">{{ trans('admin.displayorder') }}</th>
				<th width="300">{{ trans('admin.setting.nav.title') }}</th>
				<th>{{ trans('admin.setting.nav.url') }}</th>
				<th width="100">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($navlist as $nav)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $nav->id }}" name="ids[]"></td>
				<td>{!! str_repeat('<div class="childnode">',$nav->count-1) !!}<input type="text" class="txt" name="displayorder[{{ $nav->id }}]" value="{{ $nav->displayorder }}" style="width:40px">{!! str_repeat('</div>',$nav->count-1) !!}</td>
				<td>{!! str_repeat('<div class="childnode">',$nav->count-1) !!}<input type="text" class="txt" name="title[{{ $nav->id }}]" value="{{ $nav->title }}">{!! str_repeat('</div>',$nav->count-1) !!}</td>
				<td>{{ $nav->url ? url($nav->url) : '/' }}</td>
				<td>
					<a href="{{ route('admin.setting.nav.edit',$nav->id) }}" class="openwindow" title="{{ trans('admin.setting.nav.edit') }}">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.setting.nav.destroy',$nav->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($navlist) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
			<button class="submitbtn" name="updatesubmit" value="yes" type="submit">{{ trans('admin.update') }}</button>
		</div>
    </div>
	@endif
	</form>
@endsection