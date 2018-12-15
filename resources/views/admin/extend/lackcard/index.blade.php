@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.lackcard') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.extend.lackcard.index') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.extend.lackcard.status') }}</dt>
			<dd>
				<select class="schselect" name="status" onchange='this.form.submit()'>
					<option value="-1">{{ trans('admin.all') }}</option>
					<option value="0" {!! request('status') == 0 ? 'selected="selected"' : '' !!}>未处理</option>
					<option value="1" {!! request('status') == 1 ? 'selected="selected"' : '' !!}>已处理</option>
				</select>
			</dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.extend.lackcard.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.extend.lackcard.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th>{{ trans('admin.extend.lackcard.user') }}</th>
				<th width="100">{{ trans('admin.extend.lackcard.cardnum') }}</th>
				<th width="60">{{ trans('admin.extend.lackcard.status') }}</th>
				<th width="120">{{ trans('admin.created_at') }}</th>
				<th width="80">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($orders as $value)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $value->id }}" name="ids[]"></td>
				<td>{{ $value->user ? $value->user->username : '/' }}</td>
				<td>{{ $value->cardnum }}</td>
				<td>{{ trans('admin.extend.lackcard.status_'.$value->status) }}</td>
				<td>{{ $value->created_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.extend.lackcard.edit',$value->id) }}" class="openwindow" title="{{ trans('admin.handle') }}">{{ trans('admin.handle') }}</a>
					<a href="{{ route('admin.extend.lackcard.destroy',$value->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($orders) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
		<div class="page y">
			{!! $orders->appends(['status' => request('status')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection