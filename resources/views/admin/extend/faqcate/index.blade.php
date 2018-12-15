@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.faqcate') }}</h3></div>
		<ul class="tab">
			<li><a href="{{ route('admin.extend.faq.index') }}"><span>{{ trans('admin.extend.faq.list') }}</span></a></li>
			<li class="current"><a href="{{ route('admin.extend.faqcate.index') }}"><span>{{ trans('admin.extend.faqcate.list') }}</span></a></li>
		</ul>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.extend.faqcate.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.extend.faqcate.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.extend.faqcate.create') }}" class="btn openwindow" title="{{ trans('admin.extend.faqcate.create') }}">+ {{ trans('admin.extend.faqcate.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="50">{{ trans('admin.displayorder') }}</th>
				<th>{{ trans('admin.extend.faqcate.name') }}</th>
				<th width="80">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($faqcates as $faqcate)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $faqcate->id }}" name="ids[]"></td>
				<td><input type="text" class="txt" name="displayorder[{{ $faqcate->id }}]" value="{{ $faqcate->displayorder }}" size="2"></td>
				<td>{{ $faqcate->name or '/' }}</td>
				<td>
					<a href="{{ route('admin.extend.faqcate.edit',$faqcate->id) }}" class="openwindow" title="{{ trans('admin.extend.faqcate.edit') }}">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.extend.faqcate.destroy',$faqcate->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($faqcates) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
			<button class="submitbtn" name="updatesubmit" value="yes" type="submit">{{ trans('admin.update') }}</button>
		</div>
		<div class="page y">
			{!! $faqcates->appends(['title' => request('title')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection