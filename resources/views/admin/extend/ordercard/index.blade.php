@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.ordercard') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.extend.ordercard.index') }}">
	<div class="tbsearch">
		<dl>
			<dd>
				<select class="schselect" name="status" onchange='this.form.submit()'>
					<option value="" {!! empty(request('status')) ? 'selected="selected"' : '' !!}>全部</option>
					<option value="waitpay" {!! request('status') == 'waitpay' ? 'selected="selected"' : '' !!}>待付款</option>
					<option value="waitsend" {!! request('status') == 'waitsend' ? 'selected="selected"' : '' !!}>待发货</option>
					<option value="havesend" {!! request('status') == 'havesend' ? 'selected="selected"' : '' !!}>已发货</option>
					<option value="success" {!! request('status') == 'success' ? 'selected="selected"' : '' !!}>已成功</option>
					<option value="closed" {!! request('status') == 'closed' ? 'selected="selected"' : '' !!}>已关闭</option>
				</select>
			</dd>
		</dl>
		<dl>
			<dt>{{ trans('admin.extend.ordercard.order_type') }}</dt>
			<dd>
				<select class="schselect" name="pay_type" onchange='this.form.submit()'>
					<option value="0">{{ trans('admin.all') }}</option>
					<option value="1" {!! request('pay_type') == 1 ? 'selected="selected"' : '' !!}>上门办卡</option>
					<option value="2" {!! request('pay_type') == 2 ? 'selected="selected"' : '' !!}>邮寄办卡</option>
				</select>
			</dd>
		</dl>
		<dl>
			<dt>{{ trans('admin.extend.ordercard.order_sn') }}</dt>
			<dd><input type="text" name="order_sn" class="schtxt" value="{{ request('order_sn') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.extend.ordercard.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.extend.ordercard.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="100">{{ trans('admin.extend.ordercard.user') }}</th>
				<th width="160">{{ trans('admin.extend.ordercard.order_sn') }}</th>
				<th width="240">{{ trans('admin.extend.ordercard.consignee') }}</th>
				<th>{{ trans('admin.extend.ordercard.remark') }}</th>
				<th width="80">{{ trans('admin.extend.ordercard.order_type') }}</th>
				<th width="60">{{ trans('admin.extend.ordercard.status') }}</th>
				<th width="120">{{ trans('admin.extend.ordercard.created_at') }}</th>
				<th width="80">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($orders as $value)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $value->id }}" name="ids[]"></td>
				<td>{{ $value->user ? $value->user->username : '/' }}</td>
				<td>{{ $value->order_sn or '/' }}</td>
				<td>
                    <p>{{ $value->address->realname }} <span class="mlm">{{ $value->address->mobile }}</span></p>
                    <p>{{ $value->address->getprovince ? $value->address->getprovince->name : '' }} {{ $value->address->getcity ? $value->address->getcity->name : '' }} {{ $value->address->getarea ? $value->address->getarea->name : '' }} {{ $value->address->getstreet ? $value->address->getstreet->name : '' }} {{ $value->address->address }}</p>
				</td>
				<td>{{ $value->remark or '/' }}</td>
				<td>{{ trans('admin.extend.ordercard.order_type_'.$value->order_type) }}</td>
				<td>{{ trans('admin.extend.ordercard.status_'.$value->order_status.$value->shipping_status.$value->pay_status) }}</td>
				<td>{{ $value->created_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.extend.ordercard.show',$value->id) }}" class="" title="{{ trans('admin.view') }}">{{ trans('admin.view') }}</a>
					<a href="{{ route('admin.extend.ordercard.destroy',$value->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
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
			{!! $orders->appends(['status' => request('status')])->appends(['order_type' => request('order_type')])->appends(['order_sn' => request('order_sn')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection