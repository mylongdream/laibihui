@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.extend.appoint') }}</h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="{{ route('admin.extend.appoint.index') }}">
	<div class="tbsearch">
		<dl>
			<dd>
				<select class="schselect" name="status" onchange='this.form.submit()'>
					<option value="-1" {!! request('status') == -1 ? 'selected="selected"' : '' !!}>{{ trans('admin.all') }}</option>
					<option value="0" {!! empty(request('status')) ? 'selected="selected"' : '' !!}>{{ trans('admin.extend.appoint.status_0') }}</option>
					<option value="1" {!! request('status') == 1 ? 'selected="selected"' : '' !!}>{{ trans('admin.extend.appoint.status_1') }}</option>
					<option value="2" {!! request('status') == 2 ? 'selected="selected"' : '' !!}>{{ trans('admin.extend.appoint.status_2') }}</option>
				</select>
			</dd>
		</dl>
		<dl>
			<dt>{{ trans('admin.extend.appoint.pay_type') }}</dt>
			<dd>
				<select class="schselect" name="pay_type" onchange='this.form.submit()'>
					<option value="0">{{ trans('admin.all') }}</option>
					<option value="1" {!! request('pay_type') == 1 ? 'selected="selected"' : '' !!}>上门办卡</option>
					<option value="2" {!! request('pay_type') == 2 ? 'selected="selected"' : '' !!}>邮寄办卡</option>
				</select>
			</dd>
		</dl>
		<dl>
			<dt>{{ trans('admin.extend.appoint.realname') }}</dt>
			<dd><input type="text" name="realname" class="schtxt" value="{{ request('realname') }}"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit">{{ trans('admin.search') }}</button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('admin.extend.appoint.batch') }}">
	{!! csrf_field() !!}
	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.extend.appoint.list') }}</h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="50">{{ trans('admin.extend.appoint.realname') }}</th>
				<th width="100">{{ trans('admin.extend.appoint.mobile') }}</th>
				<th width="240">{{ trans('admin.extend.appoint.address') }}</th>
				<th>{{ trans('admin.extend.appoint.remark') }}</th>
				<th width="100">{{ trans('admin.extend.appoint.fromuser') }}</th>
				<th width="140">{{ trans('admin.extend.appoint.pay_type') }}</th>
				<th width="60">{{ trans('admin.extend.appoint.status') }}</th>
				<th width="120">{{ trans('admin.created_at') }}</th>
				<th width="80">{{ trans('admin.operation') }}</th>
			</tr>
			@foreach ($appoints as $appoint)
			<tr>
				<td><input class="ids" type="checkbox" value="{{ $appoint->id }}" name="ids[]"></td>
				<td>{{ $appoint->realname or '/' }}</td>
				<td>{{ $appoint->mobile or '/' }}</td>
				<td>{{ $appoint->address or '/' }}</td>
				<td>{{ $appoint->remark or '/' }}</td>
				<td>{{ $appoint->fromuser ? $appoint->fromuser->username : '/' }}</td>
				<td>
					@switch($appoint->pay_type)
					@case(1)
                    支付宝支付{{ $appoint->pay_at ? '（已付款）' : '（未付款）' }}
					@break
					@case(2)
                    微信支付{{ $appoint->pay_at ? '（已付款）' : '（未付款）' }}
					@break
					@default
                    上门办卡
					@endswitch
				</td>
				<td>{{ trans('admin.extend.appoint.status_'.$appoint->status) }}</td>
				<td>{{ $appoint->created_at->format('Y-m-d H:i') }}</td>
				<td>
					<a href="{{ route('admin.extend.appoint.edit',$appoint->id) }}" class="openwindow" title="{{ trans('admin.handle') }}">{{ trans('admin.handle') }}</a>
					<a href="{{ route('admin.extend.appoint.destroy',$appoint->id) }}" class="mlm delbtn">{{ trans('admin.destroy') }}</a>
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
			{!! $appoints->appends(['status' => request('status')])->appends(['pay_type' => request('pay_type')])->appends(['realname' => request('realname')])->links() !!}
		</div>
    </div>
	@endif
	</form>
@endsection