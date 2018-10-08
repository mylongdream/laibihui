@extends('layouts.crm.app')

@section('content')
    <div class="crm-tabnav">
        <ul>
            <li class="on"><a href="{{ route('crm.consume.index') }}">消费明细</a></li>
            <li><a href="{{ route('crm.consume.balance') }}">每日结算</a></li>
        </ul>
    </div>
	<div class="crm-main">
        <form id="schform" name="schform" class="formsearch" method="get" action="{{ route('crm.consume.index') }}">
            <div class="crm-search">
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
					<th align="left">创建时间</th>
					<th align="left">订单编号</th>
					<th align="left">消费金额</th>
					<th align="left">折后金额</th>
					<th align="left">实收金额</th>
					<th align="left">支付方式</th>
					<th align="left">状态</th>
				</tr>
				@foreach ($consumes as $value)
					<tr>
						<td>{{ $value->created_at->format('Y-m-d H:i:s') }}</td>
						<td><a href="{{ route('crm.consume.show', $value->order_sn) }}" class="openwindow" title="订单详情">{{ $value->order_sn }}</a></td>
						<td><strong>￥{{ sprintf("%.2f",$value->consume_money) }}</strong>
						<td><strong>￥{{ sprintf("%.2f",$value->discount_money) }}</strong></td>
						<td><strong>￥{{ sprintf("%.2f",$value->indiscount_money) }}</strong></td>
						<td>{{ trans('common.paytype.'.$value->pay_type) }}</td>
						<td>{{ $value->pay_status ? '已付款' : '待付款' }}</td>
					</tr>
				@endforeach
			</table>
		</div>
		{!! $consumes->appends(['order_sn' => request('order_sn')])->links() !!}
	</div>
@endsection