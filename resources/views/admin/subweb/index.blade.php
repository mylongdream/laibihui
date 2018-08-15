@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.subweb') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.subweb.index') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.subweb.name') }}</dt>
			<dd><input type="text" name="name" class="schtxt" value="{{ request('name') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.subweb.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.subweb.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.subweb.create') }}" class="btn">+ {{ trans('admin.subweb.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="80">{{ trans('admin.displayorder') }}</th>
				<th>{{ trans('admin.subweb.name') }}</th>
				<th width="240">{{ trans('admin.subweb.domain') }}</th>
				<th width="100">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($subwebs as $subweb)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $subweb->subweb_id }}" name="ids[]"></td>
				<td><input type="text" class="txt" name="displayorder[{{ $subweb->subweb_id }}]" value="{{ $subweb->displayorder }}" size="2"></td>
				<td>{{ $subweb->name }}</td>
				<td>{{ route('subweb.index',$subweb->domain) }}</td>
				<td>
					<a href="{{ route('admin.subweb.edit',$subweb->subweb_id) }}" class="">{{ trans('admin.edit') }}</a>
					<a href="{{ route('admin.subweb.destroy',$subweb->subweb_id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($subwebs) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
			<button class="submitbtn" name="updatesubmit" value="yes" type="submit">{{ trans('admin.update') }}</button>
		</div>
		<div class="page y">
			{!! $subwebs->appends(['subject' => request('subject')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection