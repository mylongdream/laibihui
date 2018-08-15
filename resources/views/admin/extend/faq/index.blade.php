@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.faq') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.extend.faq.index') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.extend.faq.title') }}</dt>
			<dd><input type="text" name="title" class="schtxt" value="{{ request('title') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.extend.faq.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.extend.faq.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.extend.faq.create') }}" class="btn openwindow" title="{{ trans('admin.extend.faq.create') }}">+ {{ trans('admin.extend.faq.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="50">{{ trans('admin.displayorder') }}</th>
				<th>{{ trans('admin.extend.faq.title') }}</th>
				<th width="150">{{ trans('admin.extend.faq.catid') }}</th>
				<th width="120">{{ trans('admin.created_at') }}</th>
				<th width="80">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($faqs as $faq)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $faq->id }}" name="ids[]"></td>
				<td><input type="text" class="txt" name="displayorder[{{ $faq->photo_id }}]" value="{{ $faq->displayorder }}" size="2"></td>
				<td>{{ $faq->title or '/' }}</td>
				<td>{{ $faq->category ? $faq->category->name : '/' }}</td>
				<td>{{ $faq->created_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.extend.faq.edit',$faq->id) }}" class="openwindow" title="{{ trans('admin.extend.faq.edit') }}">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.extend.faq.destroy',$faq->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($faqs) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
			<button class="submitbtn" name="updatesubmit" value="yes" type="submit">{{ trans('admin.update') }}</button>
		</div>
		<div class="page y">
			{!! $faqs->appends(['title' => request('title')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection