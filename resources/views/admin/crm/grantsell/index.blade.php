@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.crm.grantsell') }}</h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.crm.grantsell.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.crm.grantsell.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="">{{ trans('admin.crm.grantsell.realname') }}</th>
				<th width="120">{{ trans('admin.crm.grantsell.mobile') }}</th>
				<th width="150">{{ trans('admin.crm.grantsell.age') }}</th>
				<th width="150">{{ trans('admin.crm.grantsell.idcard') }}</th>
				<th width="150">{{ trans('admin.crm.grantsell.location') }}</th>
				<th width="150">{{ trans('admin.crm.grantsell.created_at') }}</th>
				<th width="150">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($list as $value)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $value->id }}" name="ids[]"></td>
				<td>{{ $value->realname }}</td>
				<td>{{ $value->mobile }}</td>
				<td>{{ $value->age }}</td>
				<td>{{ $value->idcard }}</td>
				<td>{{ $value->getprovince ? $value->getprovince->name : '' }}{{ $value->getcity ? $value->getcity->name : '' }}</td>
				<td>{{ $value->created_at ? $value->created_at->format('Y-m-d H:i') : '/' }}</td>
				<td>
					<a href="{{ route('admin.crm.grantsell.show',$value->id) }}" class="" title="{{ trans('admin.crm.grantsell.show') }}">{{ trans('admin.view') }}</a>
					<a href="{{ route('admin.crm.grantsell.destroy',$value->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($list) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
		<div class="page y">
			{!! $list->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection