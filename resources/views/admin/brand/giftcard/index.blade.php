@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.crm.giftcard') }}</h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.crm.giftcard.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.crm.giftcard.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="">{{ trans('admin.crm.giftcard.user') }}</th>
				<th width="120">{{ trans('admin.crm.giftcard.shop') }}</th>
				<th width="150">{{ trans('admin.crm.giftcard.order_sn') }}</th>
				<th width="150">{{ trans('admin.crm.giftcard.cardnum') }}</th>
				<th width="150">{{ trans('admin.crm.giftcard.created_at') }}</th>
				<th width="150">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($list as $value)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $value->id }}" name="ids[]"></td>
				<td>{{ $value->user ? $value->user->username : '/' }}</td>
				<td>{{ $value->shop ? $value->shop->name : '/' }}</td>
				<td>{{ $value->order_sn }}</td>
				<td>{{ $value->cardnum }} уе</td>
				<td>{{ $value->created_at ? $value->created_at->format('Y-m-d H:i') : '/' }}</td>
				<td>
					<a href="{{ route('admin.crm.giftcard.destroy',$value->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
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