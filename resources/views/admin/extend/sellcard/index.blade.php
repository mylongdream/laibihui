@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.sellcard') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.extend.sellcard.index') }}">
	<div class="tbsearch">
		<dl>
			<dt>{{ trans('admin.extend.sellcard.order_type') }}</dt>
			<dd>
				<select class="schselect" name="pay_status" onchange='this.form.submit()'>
					<option value="0">{{ trans('admin.all') }}</option>
					<option value="1" {!! request('pay_status') == 1 ? 'selected="selected"' : '' !!}>待付款</option>
					<option value="2" {!! request('pay_status') == 2 ? 'selected="selected"' : '' !!}>已付款</option>
				</select>
			</dd>
		</dl>
		<dl>
			<dt>{{ trans('admin.extend.sellcard.order_sn') }}</dt>
			<dd><input type="text" name="order_sn" class="schtxt" value="{{ request('order_sn') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.extend.sellcard.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.extend.sellcard.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="100">{{ trans('admin.extend.sellcard.user') }}</th>
				<th width="160">{{ trans('admin.extend.sellcard.order_sn') }}</th>
				<th width="240">{{ trans('admin.extend.sellcard.consignee') }}</th>
				<th>{{ trans('admin.extend.sellcard.remark') }}</th>
				<th width="100">{{ trans('admin.extend.sellcard.fromuser') }}</th>
				<th width="80">{{ trans('admin.extend.sellcard.order_type') }}</th>
				<th width="60">{{ trans('admin.extend.sellcard.status') }}</th>
				<th width="120">{{ trans('admin.extend.sellcard.created_at') }}</th>
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
				<td>{{ $value->fromuser ? $value->fromuser->username : '/' }}</td>
				<td>{{ trans('admin.extend.sellcard.order_type_'.$value->order_type) }}</td>
				<td>{{ trans('admin.extend.sellcard.status_'.$value->order_status.$value->shipping_status.$value->pay_status) }}</td>
				<td>{{ $value->created_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.extend.sellcard.show',$value->id) }}" class="" title="{{ trans('admin.view') }}">{{ trans('admin.view') }}</a>
					<a href="{{ route('admin.extend.sellcard.destroy',$value->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
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
			{!! $orders->appends(['pay_status' => request('pay_status')])->appends(['order_sn' => request('order_sn')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection