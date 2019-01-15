@extends('layouts.user.app')

@section('content')
    @if (!request()->ajax())
        <div class="itemnav">
            <div class="title"><h3>{{ trans('user.orderfarm') }}</h3></div>
        </div>
        <div class="order-show mtw">
            <table>
                <tr>
                    <th width="20%" align="right">{{ trans('user.orderfarm.farm_name') }}</th>
                    <td>{{ $order->farm ? $order->farm->name : '/' }}</td>
                </tr>
                <tr>
                    <th align="right">{{ trans('user.orderfarm.order_amount') }}</th>
                    <td>{{ $order->order_amount ? $order->order_amount : 0 }} 元</td>
                </tr>
                <tr>
                    <th align="right">{{ trans('user.orderfarm.status') }}</th>
                    <td>{{ trans('user.orderfarm.status_'.$order->order_status.$order->pay_status) }}</td>
                </tr>
            </table>
        </div>
    @else
        <div class="order-show" style="width: 450px;">
            <table>
                <tr>
                    <th width="30%" align="right">{{ trans('user.orderfarm.farm_name') }}</th>
                    <td>{{ $order->farm ? $consume->farm->name : '/' }}</td>
                </tr>
                <tr>
                    <th align="right">{{ trans('user.orderfarm.order_amount') }}</th>
                    <td>{{ $order->order_amount ? $order->order_amount : 0 }} 元</td>
                </tr>
                <tr>
                    <th align="right">{{ trans('user.orderfarm.status') }}</th>
                    <td>{{ trans('user.orderfarm.status_'.$order->order_status.$order->pay_status) }}</td>
                </tr>
            </table>
        </div>
    @endif
@endsection