@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.crm.applysell') }}</h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.crm.applysell.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.crm.applysell.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="100">{{ trans('admin.crm.applysell.realname') }}</th>
				<th width="120">{{ trans('admin.crm.applysell.mobile') }}</th>
				<th width="150">{{ trans('admin.crm.applysell.wechatid') }}</th>
				<th width="150">{{ trans('admin.crm.applysell.address') }}</th>
				<th width="">{{ trans('admin.crm.applysell.remark') }}</th>
				<th width="150">{{ trans('admin.crm.applysell.created_at') }}</th>
				<th width="150">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($list as $value)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $value->id }}" name="ids[]"></td>
				<td>{{ $value->realname }}</td>
				<td>{{ $value->mobile }}</td>
				<td>{{ $value->wechatid }}</td>
				<td>{{ $value->address }}</td>
				<td>{{ $value->remark }}</td>
				<td>{{ $value->created_at ? $value->created_at->format('Y-m-d H:i') : '/' }}</td>
				<td>
					<a href="{{ route('admin.crm.applysell.show',$value->id) }}" class="" title="{{ trans('admin.crm.applysell.show') }}">{{ trans('admin.view') }}</a>
					<a href="{{ route('admin.crm.applysell.destroy',$value->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
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