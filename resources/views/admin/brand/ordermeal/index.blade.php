@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.brand.ordermeal') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.brand.ordermeal.index') }}">
	<div class="tbsearch">
		<dl>
			<dd>
				<select class="schselect" name="status" onchange='this.form.submit()'>
					<option value="-1" {!! request('status') == -1 ? 'selected="selected"' : '' !!}>{{ trans('admin.all') }}</option>
					<option value="0" {!! empty(request('status')) ? 'selected="selected"' : '' !!}>{{ trans('admin.brand.ordermeal.status_0') }}</option>
					<option value="1" {!! request('status') == 1 ? 'selected="selected"' : '' !!}>{{ trans('admin.brand.ordermeal.status_1') }}</option>
					<option value="2" {!! request('status') == 2 ? 'selected="selected"' : '' !!}>{{ trans('admin.brand.ordermeal.status_2') }}</option>
					<option value="3" {!! request('status') == 3 ? 'selected="selected"' : '' !!}>{{ trans('admin.brand.ordermeal.status_3') }}</option>
				</select>
			</dd>
		</dl>
		<dl>
			<dt>{{ trans('admin.brand.ordermeal.realname') }}</dt>
			<dd><input type="text" name="realname" class="schtxt" value="{{ request('realname') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform confirmpwd" method="post" action="{{ route('admin.brand.ordermeal.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.brand.ordermeal.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="180">{{ trans('admin.brand.ordermeal.shop') }}</th>
                <th width="70">{{ trans('admin.brand.ordermeal.user') }}</th>
				<th width="100">{{ trans('admin.brand.ordermeal.amount') }}</th>
				<th>{{ trans('admin.brand.ordermeal.meals') }}</th>
				<th width="60">{{ trans('admin.brand.ordermeal.status') }}</th>
				<th width="120">{{ trans('admin.created_at') }}</th>
				<th width="80">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($orders as $value)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $value->id }}" name="ids[]"></td>
				<td>
                    @if ($value->shop)
                    <a href="{{ route('brand.shop.show', $value->shop->id) }}" target="_blank" title="{{ $value->shop->name }}">{{ $value->shop->name }}</a>
                    @else
                        /
                    @endif
                </td>
				<td>{{ $value->user ? $value->user->username : '/' }}</td>
				<td>{{ $value->order_amount or '0' }} 元</td>
				<td>{{ $value->remark or '/' }}</td>
				<td>{{ trans('admin.brand.ordermeal.status_'.$value->status) }}</td>
				<td>{{ $value->created_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.brand.ordermeal.edit',$value->id) }}" class="openwindow" title="{{ trans('admin.handle') }}">{{ trans('admin.handle') }}</a>
					<a href="{{ route('admin.brand.ordermeal.destroy',$value->id) }}" class="mlm delbtn confirmpwd">{{ trans('admin.destroy') }}</a>
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
			{!! $ordermeals->appends(['status' => request('status')])->appends(['realname' => request('realname')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection