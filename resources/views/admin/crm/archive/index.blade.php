@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.crm.archive') }}</h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.crm.archive.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.crm.archive.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="120">{{ trans('admin.crm.archive.user') }}</th>
				<th>{{ trans('admin.crm.archive.shop') }}</th>
				<th width="120">{{ trans('admin.crm.archive.created_at') }}</th>
				<th width="150">{{ trans('admin.crm.archive.status') }}</th>
				<th width="100">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($list as $value)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $value->id }}" name="ids[]"></td>
				<td>{{ $value->user ? $value->user->realname : '/' }}</td>
				<td>{{ $value->shop ? $value->shop->name : '/' }}</td>
				<td>{{ $value->created_at->format('Y-m-d H:i') }}</td>
				<td>
					@if ($value->status == 0)
						<a href="{{ route('admin.crm.archive.edit',$value->id) }}" class="openwindow" title="审核">点击审核</a>
                        @else
                        {{ trans('admin.crm.archive.status_'.$value->status) }}
					@endif
				</td>
				<td>
					<a href="{{ route('admin.crm.archive.show',$value->id) }}" class="">{{ trans('admin.view') }}</a>
					<a href="{{ route('admin.crm.archive.destroy',$value->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
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