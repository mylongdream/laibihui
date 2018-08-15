@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.farm.order') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.farm.order.index') }}">
	<div class="tbsearch">
		<dl>
			<dd>
				<select class="schselect" name="status" onchange='this.form.submit()'>
					<option value="" {!! empty(request('status')) ? 'selected="selected"' : '' !!}>全部</option>
					<option value="waitpay" {!! request('status') == 'waitpay' ? 'selected="selected"' : '' !!}>待付款</option>
					<option value="success" {!! request('status') == 'success' ? 'selected="selected"' : '' !!}>已成功</option>
					<option value="closed" {!! request('status') == 'closed' ? 'selected="selected"' : '' !!}>已关闭</option>
				</select>
			</dd>
		</dl>
		<dl>
			<dt>{{ trans('admin.mall.order.order_sn') }}</dt>
			<dd><input type="text" name="order_sn" class="schtxt" value="{{ request('order_sn') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.farm.order.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.farm.order.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="160">{{ trans('admin.farm.order.order_sn') }}</th>
				<th width="120">{{ trans('admin.farm.order.realname') }}</th>
				<th width="140">{{ trans('admin.farm.order.mobile') }}</th>
				<th>{{ trans('admin.farm.order.remark') }}</th>
				<th width="60">{{ trans('admin.farm.order.status') }}</th>
				<th width="120">{{ trans('admin.farm.order.created_at') }}</th>
				<th width="80">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($orders as $value)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $value->id }}" name="ids[]"></td>
				<td>{{ $value->order_sn or '/' }}</td>
				<td>{{ $value->realname ? $value->realname : '/' }}</td>
				<td>{{ $value->realname ? $value->mobile : '/' }}</td>
				<td>{{ $value->remark or '/' }}</td>
				<td>{{ trans('admin.farm.order.status_'.$value->order_status.$value->pay_status) }}</td>
				<td>{{ $value->created_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.farm.order.show',$value->id) }}" class="" title="{{ trans('admin.view') }}">{{ trans('admin.view') }}</a>
					<a href="{{ route('admin.farm.order.destroy',$value->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
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
			{!! $orders->appends(['status' => request('status')])->appends(['order_sn' => request('order_sn')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection