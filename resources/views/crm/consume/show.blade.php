@extends('layouts.crm.app')

@section('content')
    @if (!request()->ajax())
        <div class="crm-main">
            <div class="order-show mtw">
                <table>
                    <tr>
                        <th align="right">创建时间</th>
                        <td>{{ $consume->created_at ? $consume->created_at->format('Y-m-d H:i') : '/' }}</td>
                    </tr>
                    <tr>
                        <th width="150" align="right">订单编号</th>
                        <td>{{ $consume->order_sn or '/' }}</td>
                    </tr>
                    <tr>
                        <th align="right">消费用户</th>
                        <td>{{ $consume->user->username }}</td>
                    </tr>
                    <tr>
                        <th align="right">消费金额</th>
                        <td><strong>￥{{ sprintf("%.2f",$consume->consume_money) }}</strong>
                    </tr>
                    <tr>
                        <th align="right">折后金额</th>
                        <td><strong>￥{{ sprintf("%.2f",$consume->discount_money) }}</strong></td>
                    </tr>
                    <tr>
                        <th align="right">实际收入</th>
                        <td><strong>￥{{ sprintf("%.2f",$consume->indiscount_money) }}</strong></td>
                    </tr>
                    <tr>
                        <th align="right">支付方式</th>
                        <td>{{ trans('common.paytype.'.$consume->pay_type) }}</td>
                    </tr>
                    <tr>
                        <th align="right">付款状态</th>
                        <td>{{ $consume->pay_status ? '已付款' : '待付款' }}</td>
                    </tr>
                    @if ($consume->pay_at)
                        <tr>
                            <th align="right">付款时间</th>
                            <td>{{ $consume->pay_at ? $consume->pay_at->format('Y-m-d H:i') : '/' }}</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    @else
        <div class="order-show" style="width: 500px;">
            <table>
                <tr>
                    <th align="right">创建时间</th>
                    <td>{{ $consume->created_at ? $consume->created_at->format('Y-m-d H:i') : '/' }}</td>
                </tr>
                <tr>
                    <th width="150" align="right">订单编号</th>
                    <td>{{ $consume->order_sn or '/' }}</td>
                </tr>
                <tr>
                    <th align="right">消费用户</th>
                    <td>{{ $consume->user->username }}</td>
                </tr>
                <tr>
                    <th align="right">消费金额</th>
                    <td><strong>￥{{ sprintf("%.2f",$consume->consume_money) }}</strong>
                </tr>
                <tr>
                    <th align="right">折后金额</th>
                    <td><strong>￥{{ sprintf("%.2f",$consume->discount_money) }}</strong></td>
                </tr>
                <tr>
                    <th align="right">实际收入</th>
                    <td><strong>￥{{ sprintf("%.2f",$consume->indiscount_money) }}</strong></td>
                </tr>
                <tr>
                    <th align="right">支付方式</th>
                    <td>{{ trans('common.paytype.'.$consume->pay_type) }}</td>
                </tr>
                <tr>
                    <th align="right">付款状态</th>
                    <td>{{ $consume->ifpay ? '已付款' : '待付款' }}</td>
                </tr>
                @if ($consume->pay_at)
                <tr>
                    <th align="right">付款时间</th>
                    <td>{{ $consume->pay_at ? $consume->pay_at->format('Y-m-d H:i') : '/' }}</td>
                </tr>
                @endif
            </table>
        </div>
    @endif
@endsection