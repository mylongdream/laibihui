@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.wechat.redpack') }}</h3></div>
	</div>
	<div class="tbedit">
		<div class="tbhead cl">
			<div class="z"><h3>{{ trans('admin.wechat.redpack.list') }}</h3></div>
			<div class="y"><a href="{{ route('admin.wechat.redpack.index') }}" class="btn">< {{ trans('admin.wechat.redpack.list') }}</a></div>
		</div>
		<table>
			<tr>
				<td width="150" align="right">{{ trans('admin.wechat.redpack.mch_billno') }}</td>
				<td>{{ $billno->mch_billno }}</td>
			</tr>
			<tr>
				<td width="150" align="right">{{ trans('admin.wechat.redpack.detail_id') }}</td>
				<td>{{ $billno->detail_id }}</td>
			</tr>
			<tr>
				<td width="150" align="right">{{ trans('admin.wechat.redpack.status') }}</td>
				<td>{{ trans('admin.wechat.redpack.status.'.$billno->status) }}</td>
			</tr>
			<tr>
				<td width="150" align="right">{{ trans('admin.wechat.redpack.hb_type') }}</td>
				<td>{{ trans('admin.wechat.redpack.hb_type.'.$billno->hb_type) }}</td>
			</tr>
			<tr>
				<td width="150" align="right">{{ trans('admin.wechat.redpack.total_num') }}</td>
				<td>{{ $billno->total_num }}</td>
			</tr>
			<tr>
				<td width="150" align="right">{{ trans('admin.wechat.redpack.total_amount') }}</td>
				<td>{{ trans('admin.wechat.redpack.total_amount.rmb', ['amount' => $billno->total_amount/100]) }}</td>
			</tr>
			<tr>
				<td width="150" align="right">{{ trans('admin.wechat.redpack.send_time') }}</td>
				<td>{{ $billno->send_time }}</td>
			</tr>
			<tr>
				<td width="150" align="right">{{ trans('admin.wechat.redpack.act_name') }}</td>
				<td>{{ $billno->act_name }}</td>
			</tr>
		</table>
	</div>
@endsection