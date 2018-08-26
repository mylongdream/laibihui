@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.crm.personnel') }}</h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.crm.personnel.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.crm.personnel.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.crm.personnel.create') }}" class="btn openwindow" title="{{ trans('admin.crm.personnel.create') }}">+ {{ trans('admin.crm.personnel.create') }}</a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="150">{{ trans('admin.crm.personnel.subuser') }}</th>
				<th width="120">{{ trans('admin.crm.personnel.topuser') }}</th>
				<th width="150">{{ trans('admin.crm.personnel.getcardnum') }}</th>
				<th width="150">{{ trans('admin.crm.personnel.sellcardnum') }}</th>
				<th width="150">{{ trans('admin.crm.personnel.created_at') }}</th>
				<th width="100">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($userlist as $value)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $value->id }}" name="ids[]"></td>
				<td>{{ $value->subuser ? $value->subuser->username : '/' }}</td>
				<td>{{ $value->topuser ? $value->topuser->username : '/' }}</td>
				<td>0</td>
				<td>0</td>
				<td>{{ $value->created_at ? $value->created_at->format('Y-m-d H:i') : '/' }}</td>
				<td>
					<a href="{{ route('admin.crm.personnel.destroy',$value->id) }}" class="delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($userlist) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
    </div>
	@endif
	</form>
@endsection