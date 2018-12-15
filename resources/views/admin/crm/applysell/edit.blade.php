@extends('layouts.admin.app')

@section('content')
	<div class="itemnav">
		<div class="title"><h3>{{ trans('admin.crm.applysell') }}</h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('admin.crm.applysell.update', $order->id) }}">
    	<input type="hidden" name="_method" value="PUT">
		{!! csrf_field() !!}
		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3>{{ trans('admin.crm.applysell.list') }}</h3></div>
				<div class="y"><a href="{{ route('admin.crm.applysell.index') }}" class="btn">< {{ trans('admin.crm.applysell.list') }}</a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.applysell.user') }}</td>
					<td>{{ $order->user ? $order->user->username : '/' }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.applysell.realname') }}</td>
					<td>{{ $order->realname }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.applysell.mobile') }}</td>
					<td>{{ $order->mobile }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.applysell.wechatid') }}</td>
					<td>{{ $order->wechatid }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.applysell.address') }}</td>
					<td>{{ $order->address }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.applysell.remark') }}</td>
					<td>{{ $order->remark }}</td>
				</tr>
				<tr>
					<td width="150" align="right">{{ trans('admin.crm.applysell.status') }}</td>
					<td>
						<label class="radio" for="status_0">
							<input id="status_0" type="radio" name="status" value="0" {{ $order->status == 0 ? 'checked' : '' }}> {{ trans('admin.crm.applysell.status_0') }}
						</label>
						<label class="radio" for="status_1">
							<input id="status_1" type="radio" name="status" value="1" {{ $order->status == 1 ? 'checked' : '' }}> {{ trans('admin.crm.applysell.status_1') }}
						</label>
					</td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
@endsection