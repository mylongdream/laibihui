@extends('layouts.user.app')

@section('content')
    @if (!request()->ajax())
    <div class="itemnav">
        <div class="title"><h3>{{ trans('user.consume') }}</h3></div>
    </div>
    <div class="order-show mtw">
        <table>
            <tr>
                <th width="20%" align="right">{{ trans('user.consume.shop') }}</th>
                <td>{{ $consume->shop ? $consume->shop->name : '/' }}</td>
            </tr>
            <tr>
                <th align="right">{{ trans('user.consume.order_amount') }}</th>
                <td>{{ $consume->order_amount ? $consume->order_amount : 0 }} 元</td>
            </tr>
            <tr>
                <th align="right">{{ trans('user.consume.status') }}</th>
                <td>{{ trans('user.consume.status_'.$consume->pay_status) }}</td>
            </tr>
        </table>
    </div>
    @else
        <div class="order-show" style="width: 450px;">
        <table>
            <tr>
                <th width="30%" align="right">{{ trans('user.consume.shop') }}</th>
                <td>{{ $consume->shop ? $consume->shop->name : '/' }}</td>
            </tr>
            <tr>
                <th align="right">{{ trans('user.consume.order_amount') }}</th>
                <td>{{ $consume->order_amount ? $consume->order_amount : 0 }} 元</td>
            </tr>
            <tr>
                <th align="right">{{ trans('user.consume.status') }}</th>
                <td>{{ trans('user.consume.status_'.$consume->pay_status) }}</td>
            </tr>
        </table>
    </div>
    @endif
@endsection