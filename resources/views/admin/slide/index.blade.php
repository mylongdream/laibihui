@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.slide') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.slide.index') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.slide.name') }}</dt>
			<dd><input type="text" name="name" class="schtxt" value="{{ request('name') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.slide.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.slide.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.slide.create') }}" class="btn openwindow" title="{{ trans('admin.slide.create') }}">+ {{ trans('admin.slide.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="80">{{ trans('admin.displayorder') }}</th>
				<th>{{ trans('admin.slide.subject') }}</th>
				<th width="100">{{ trans('admin.slide.url') }}</th>
				<th width="100">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($slides as $slide)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $slide->slide_id }}" name="ids[]"></td>
				<td><input type="text" class="txt" name="displayorder[{{ $slide->slide_id }}]" value="{{ $slide->displayorder }}" size="2"></td>
				<td>{{ $slide->subject or '/' }}</td>
				<td>{{ $slide->url or '/' }}</td>
				<td>
					<a href="{{ route('admin.slide.edit',$slide->slide_id) }}" class="openwindow" title="{{ trans('admin.slide.edit') }}">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.slide.destroy',$slide->slide_id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($slides) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
			<button class="submitbtn" name="updatesubmit" value="yes" type="submit">{{ trans('admin.update') }}</button>
		</div>
		<div class="page y">
			{!! $slides->appends(['subject' => request('subject')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection