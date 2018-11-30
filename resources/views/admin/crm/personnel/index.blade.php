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
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="">{{ trans('admin.crm.personnel.subuser') }}</th>
				<th width="120">{{ trans('admin.crm.personnel.topuser') }}</th>
				<th width="150">{{ trans('admin.crm.personnel.allotnum') }}</th>
				<th width="150">{{ trans('admin.crm.personnel.sellnum') }}</th>
				<th width="150">{{ trans('admin.crm.personnel.created_at') }}</th>
				<th width="150">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($list as $value)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $value->id }}" name="ids[]"></td>
				<td>{{ $value->user ? $value->user->username : '/' }}</td>
				<td>{{ $value->topuser ? $value->topuser->username : '/' }}</td>
				<td>
					@if ($value->user)
					<a href="{{ route('admin.crm.personnel.allocation', $value->id) }}">{{ $value->allotnum }}</a>
					@else
						<span>0</span>
					@endif
				</td>
				<td>
					@if ($value->user)
					<a href="{{ route('admin.extend.sellcard.index', ['username' => $value->user->username, 'pay_status' => 2]) }}">{{ $value->sellnum }}</a>
					@else
						<span>0</span>
					@endif
				</td>
				<td>{{ $value->created_at ? $value->created_at->format('Y-m-d H:i') : '/' }}</td>
				<td>
					<a href="{{ route('admin.crm.personnel.allocate',$value->id) }}" class="openwindow" title="{{ trans('admin.crm.personnel.allocate') }}">{{ trans('admin.crm.personnel.allocate') }}</a>
					<a href="{{ route('admin.crm.personnel.destroy',$value->id) }}" class="mlm delbtn" title="取消授权">取消授权</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($list) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">取消授权</button>
		</div>
		<div class="page y">
			{!! $list->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection