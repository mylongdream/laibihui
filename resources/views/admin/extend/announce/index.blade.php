@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.announce') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.extend.announce.index') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.extend.announce.title') }}</dt>
			<dd><input type="text" name="title" class="schtxt" value="{{ request('title') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.extend.announce.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.extend.announce.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.extend.announce.create') }}" class="btn" title="{{ trans('admin.extend.announce.create') }}">+ {{ trans('admin.extend.announce.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="50">{{ trans('admin.displayorder') }}</th>
				<th>{{ trans('admin.extend.announce.title') }}</th>
				<th width="120">{{ trans('admin.extend.announce.viewnum') }}</th>
				<th width="120">{{ trans('admin.created_at') }}</th>
				<th width="80">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($announces as $announce)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $announce->id }}" name="ids[]"></td>
				<td><input type="text" class="txt" name="displayorder[{{ $announce->photo_id }}]" value="{{ $announce->displayorder }}" size="2"></td>
				<td>{{ $announce->title or '/' }}</td>
				<td>{{ $announce->viewnum or '0' }}</td>
				<td>{{ $announce->created_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.extend.announce.edit',$announce->id) }}" class="" title="{{ trans('admin.extend.announce.edit') }}">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.extend.announce.destroy',$announce->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($announces) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
			<button class="submitbtn" name="updatesubmit" value="yes" type="submit">{{ trans('admin.update') }}</button>
		</div>
		<div class="page y">
			{!! $announces->appends(['title' => request('title')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection