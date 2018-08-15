@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.brand.appoint') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.brand.appoint.index') }}">
	<div class="tbsearch">
		<dl>
			<dd>
				<select class="schselect" name="status" onchange='this.form.submit()'>
					<option value="-1" {!! request('status') == -1 ? 'selected="selected"' : '' !!}>{{ trans('admin.all') }}</option>
					<option value="0" {!! empty(request('status')) ? 'selected="selected"' : '' !!}>{{ trans('admin.brand.appoint.status_0') }}</option>
					<option value="1" {!! request('status') == 1 ? 'selected="selected"' : '' !!}>{{ trans('admin.brand.appoint.status_1') }}</option>
					<option value="2" {!! request('status') == 2 ? 'selected="selected"' : '' !!}>{{ trans('admin.brand.appoint.status_2') }}</option>
					<option value="3" {!! request('status') == 3 ? 'selected="selected"' : '' !!}>{{ trans('admin.brand.appoint.status_3') }}</option>
				</select>
			</dd>
		</dl>
		<dl>
			<dt>{{ trans('admin.brand.appoint.order_sn') }}</dt>
			<dd><input type="text" name="order_sn" class="schtxt" value="{{ request('order_sn') }}"></dd>
		</dl>
		<dl>
			<dt>{{ trans('admin.brand.appoint.realname') }}</dt>
			<dd><input type="text" name="realname" class="schtxt" value="{{ request('realname') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform confirmpwd" method="post" action="{{ route('admin.brand.appoint.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.brand.appoint.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th>{{ trans('admin.brand.appoint.order_sn') }}</th>
				<th width="180">{{ trans('admin.brand.appoint.shop') }}</th>
                <th width="70">{{ trans('admin.brand.appoint.realname') }}</th>
				<th width="100">{{ trans('admin.brand.appoint.mobile') }}</th>
				<th width="60">{{ trans('admin.brand.appoint.number') }}</th>
				<th width="120">{{ trans('admin.brand.appoint.appoint_at') }}</th>
				<th width="60">{{ trans('admin.brand.appoint.status') }}</th>
				<th width="120">{{ trans('admin.created_at') }}</th>
				<th width="80">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($appoints as $appoint)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $appoint->id }}" name="ids[]"></td>
				<td>{{ $appoint->order_sn or '/' }}</td>
				<td>
                    @if ($appoint->shop)
                    <a href="{{ route('brand.shop.show', $appoint->shop->id) }}" target="_blank" title="{{ $appoint->shop->name }}">{{ $appoint->shop->name }}</a>
                    @else
                        /
                    @endif
                </td>
				<td>{{ $appoint->realname or '/' }}</td>
				<td>{{ $appoint->mobile or '/' }}</td>
				<td>{{ $appoint->number or '0' }} 人</td>
				<td>{{ $appoint->appoint_at ? $appoint->appoint_at->format('Y-m-d H:i') : '/' }}</td>
				<td>{{ trans('admin.brand.appoint.status_'.$appoint->status) }}</td>
				<td>{{ $appoint->created_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.brand.appoint.edit',$appoint->id) }}" class="openwindow" title="{{ trans('admin.handle') }}">{{ trans('admin.handle') }}</a>
					<a href="{{ route('admin.brand.appoint.destroy',$appoint->id) }}" class="mlm delbtn confirmpwd">{{ trans('admin.destroy') }}</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if (count($appoints) > 0)
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit">{{ trans('admin.destroy') }}</button>
		</div>
		<div class="page y">
			{!! $appoints->appends(['status' => request('status')])->appends(['order_sn' => request('order_sn')])->appends(['realname' => request('realname')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection