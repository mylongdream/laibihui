@extends('layouts.crm.app')

@section('content')
    <div class="crm-tabnav">
        <ul>
            <li class="on"><a href="{{ route('crm.shop.ordermeal.index') }}">自助点餐明细</a></li>
            <li><a href="{{ route('crm.shop.ordermeal.create') }}">我要点餐</a></li>
        </ul>
    </div>
	<div class="crm-main">
        <form id="schform" name="schform" class="formsearch" method="get" action="{{ route('crm.shop.ordermeal.index') }}">
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
					<th align="left" width="180">订单编号</th>
					<th align="left">点餐金额</th>
					<th align="left">是否绑卡</th>
					<th align="left" width="100">处理状态</th>
					<th align="left" width="180">点餐时间</th>
				</tr>
				@foreach ($orders as $value)
					<tr>
						<td><a href="{{ route('crm.shop.ordermeal.show', $value->order_sn) }}" title="查看订单" class="openwindow">{{ $value->order_sn }}</a></td>
						<td>{{ $value->consume_money or '0' }}元</td>
						<td>{{ $value->bindcard ? '是' : '否' }}</td>
						<td>
                            @if ($value->status)
							{{ trans('crm.ordermeal.status_'.$value->status) }}
                            @else
                                <a href="{{ route('crm.shop.ordermeal.edit', $value->order_sn) }}" title="处理订单" class="openwindow">{{ trans('user.appoint.status_'.$value->status) }}</a>
                            @endif
						</td>
                        <td>{{ $value->created_at->format('Y-m-d H:i:s') }}</td>
					</tr>
				@endforeach
			</table>
		</div>
		{!! $orders->appends(['order_sn' => request('order_sn')])->links() !!}
	</div>
@endsection