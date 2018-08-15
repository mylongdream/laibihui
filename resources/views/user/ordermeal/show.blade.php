@extends('layouts.user.app')

@section('content')
    @if (!request()->ajax())
    <div class="itemnav">
        <div class="title"><h3>{{ trans('user.card.order') }}</h3></div>
    </div>
    <div class="order-show mtw">
        <table>
            <tr>
                <th width="20%" align="right">{{ trans('user.order.shop') }}</th>
                <td>{{ $order->shop ? $order->shop->name : '/' }}</td>
            </tr>
            <tr>
                <th align="right">{{ trans('user.order.money') }}</th>
                <td>{{ $order->money or '0' }} 元</td>
            </tr>
            <tr>
                <th align="right">{{ trans('user.order.status') }}</th>
                <td>{{ trans('user.order.status_'.$order->ifpay) }}</td>
            </tr>
        </table>
    </div>
    @else
        <div class="order-show" style="width: 450px;">
        <table>
            <tr>
                <th width="30%" align="right">{{ trans('user.order.shop') }}</th>
                <td>{{ $order->shop ? $order->shop->name : '/' }}</td>
            </tr>
            <tr>
                <th align="right">{{ trans('user.order.money') }}</th>
                <td>{{ $order->money or '0' }} 元</td>
            </tr>
            <tr>
                <th align="right">{{ trans('user.order.status') }}</th>
                <td>{{ trans('user.order.status_'.$order->ifpay) }}</td>
            </tr>
        </table>
    </div>
    @endif
@endsection