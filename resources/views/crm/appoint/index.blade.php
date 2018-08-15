@extends('layouts.crm.app')

@section('content')
	<div class="crm-main">
        <form id="schform" name="schform" class="formsearch" method="get" action="{{ route('crm.appoint.index') }}">
            <div class="crm-search">
		<dl>
			<dd>
				<select class="schselect" name="status" onchange='this.form.submit()'>
					<option value="0" {!! empty(request('status')) ? 'selected="selected"' : '' !!}>待处理</option>
					<option value="1" {!! request('status') == 1 ? 'selected="selected"' : '' !!}>已接受</option>
					<option value="2" {!! request('status') == 2 ? 'selected="selected"' : '' !!}>已拒绝</option>
					<option value="3" {!! request('status') == 3 ? 'selected="selected"' : '' !!}>已取消</option>
				</select>
			</dd>
		</dl>
                <dl>
                    <dt>订单编号</dt>
                    <dd><input type="text" name="order_sn" class="schtxt" value="{{ request('order_sn') }}"></dd>
                </dl>
                <div class="schbtn"><button name="" type="submit">搜索</button></div>
            </div>
        </form>
		<div class="crm-list mtw">
			<table>
				<tr>
					<th align="left" width="180">订单编号</th>
					<th align="left">姓名</th>
					<th align="left">预约时间</th>
					<th align="left">预约人数</th>
					<th align="left" width="80">状态</th>
					<th align="left" width="160">提交时间</th>
					@if (empty(request('status')))
					<th align="left" width="40">操作</th>
					@endif
				</tr>
				@foreach ($appoints as $value)
					<tr>
						<td><a href="{{ route('crm.appoint.show', $value->order_sn) }}" class="openwindow" title="查看订单">{{ $value->order_sn }}</a></td>
					<td>{{ $value->realname }}</td>
						<td>{{ $value->appoint_at ? $value->appoint_at->format('Y-m-d H:i') : '/' }}</td>
						<td>{{ $value->number }} 人</td>
						<td>{{ trans('user.appoint.status_'.$value->status) }}</td>
                        <td>{{ $value->created_at->format('Y-m-d H:i:s') }}</td>
						@if (empty(request('status')))
						<td><a href="{{ route('crm.appoint.edit', $value->order_sn) }}" class="openwindow" title="处理订单">处理</a></td>
						@endif
					</tr>
				@endforeach
			</table>
		</div>
		{!! $appoints->appends(['order_sn' => request('order_sn')])->links() !!}
	</div>
@endsection