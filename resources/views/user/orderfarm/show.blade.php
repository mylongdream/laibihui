@extends('layouts.user.app')

@section('content')
    @if (!request()->ajax())
        <div class="itemnav">
            <div class="title"><h3>{{ trans('user.ordercard') }}</h3></div>
        </div>
        <div class="order-show mtw">
            <table>
                <tr>
                    <th width="20%" align="right">{{ trans('user.ordercard.order_sn') }}</th>
                    <td>{{ $order->order_sn }}</td>
                </tr>
                <tr>
                    <th align="right">{{ trans('user.ordercard.status') }}</th>
                    <td>{{ trans('user.ordercard.status_'.$order->order_status.$order->shipping_status.$order->pay_status) }}</td>
                </tr>
            </table>
        </div>
        <div class="order-show mtw">
            <table>
                <tr>
                    <th width="20%" align="right">收货人</th>
                    <td>{{ $order->address->realname }}</td>
                </tr>
                <tr>
                    <th width="20%" align="right">手机号码</th>
                    <td>{{ $order->address->mobile }}</td>
                </tr>
                <tr>
                    <th align="right">收货地址</th>
                    <td>{{ $order->address->getprovince ? $order->address->getprovince->name : '' }} {{ $order->address->getcity ? $order->address->getcity->name : '' }} {{ $order->address->getarea ? $order->address->getarea->name : '' }} {{ $order->address->getstreet ? $order->address->getstreet->name : '' }} {{ $order->address->address }}</td>
                </tr>
            </table>
        </div>
        @if ($order->order_type == 0 && $order->visit)
            <div class="order-show mtw">
                <table>
                    <tr>
                        <th width="20%" align="right">{{ trans('user.ordercard.visit.realname') }}</th>
                        <td>{{ $order->visit ? $order->visit->realname : '/' }}</td>
                    </tr>
                    <tr>
                        <th width="20%" align="right">{{ trans('user.ordercard.visit.mobile') }}</th>
                        <td>{{ $order->visit ? $order->visit->mobile : '/' }}</td>
                    </tr>
                    @if ($order->visit && $order->visit->remark)
                        <tr>
                            <th align="right">{{ trans('user.ordercard.visit.remark') }}</th>
                            <td>{{ $order->visit ? $order->visit->remark : '/' }}</td>
                        </tr>
                    @endif
                </table>
            </div>
        @endif
        @if ($order->order_type == 1 && $order->shipping)
            <div class="order-show mtw">
                <table>
                    <tr>
                        <th width="20%" align="right">{{ trans('user.ordercard.shipping.shipping_id') }}</th>
                        <td>{{ $order->shipping ? ($order->shipping->shipping ? $order->shipping->shipping->company : '/') : '/' }}</td>
                    </tr>
                    <tr>
                        <th width="20%" align="right">{{ trans('user.ordercard.shipping.waybill') }}</th>
                        <td>{{ $order->shipping ? $order->shipping->waybill : '/' }}</td>
                    </tr>
                    @if ($order->shipping && $order->shipping->remark)
                        <tr>
                            <th align="right">{{ trans('user.ordercard.shipping.remark') }}</th>
                            <td>{{ $order->shipping ? $order->shipping->remark : '/' }}</td>
                        </tr>
                    @endif
                </table>
            </div>
        @endif
        <div class="order-show mtw">
            <table>
                <tr>
                    <th width="20%" align="right">{{ trans('user.ordercard.created_at') }}</th>
                    <td>{{ $order->created_at ? $order->created_at->format('Y-m-d H:i') : '/' }}</td>
                </tr>
                @if ($order->pay_at)
                    <tr>
                        <th width="20%" align="right">{{ trans('user.ordercard.pay_at') }}</th>
                        <td>{{ $order->pay_at ? $order->pay_at->format('Y-m-d H:i') : '/' }}</td>
                    </tr>
                @endif
                @if ($order->shipping_at)
                    <tr>
                        <th align="right">{{ trans('user.ordercard.shipping_at') }}</th>
                        <td>{{ $order->shipping_at ? $order->shipping_at->format('Y-m-d H:i') : '/' }}</td>
                    </tr>
                @endif
                @if ($order->finish_at)
                    <tr>
                        <th align="right">{{ trans('user.ordercard.finish_at') }}</th>
                        <td>{{ $order->finish_at ? $order->finish_at->format('Y-m-d H:i') : '/' }}</td>
                    </tr>
                @endif
            </table>
        </div>
    @else
        <div style="width: 550px;">
            <div class="order-show">
                <table>
                    <tr>
                        <th width="20%" align="right">{{ trans('user.ordercard.order_sn') }}</th>
                        <td>{{ $order->order_sn }}</td>
                    </tr>
                    <tr>
                        <th align="right">{{ trans('user.ordercard.status') }}</th>
                        <td>{{ trans('user.ordercard.status_'.$order->order_status.$order->shipping_status.$order->pay_status) }}</td>
                    </tr>
                </table>
            </div>
            <div class="order-show mtm">
                <table>
                    <tr>
                        <th width="20%" align="right">收货人</th>
                        <td>{{ $order->address->realname }}</td>
                    </tr>
                    <tr>
                        <th width="20%" align="right">手机号码</th>
                        <td>{{ $order->address->mobile }}</td>
                    </tr>
                    <tr>
                        <th align="right">收货地址</th>
                        <td>{{ $order->address->getprovince ? $order->address->getprovince->name : '' }} {{ $order->address->getcity ? $order->address->getcity->name : '' }} {{ $order->address->getarea ? $order->address->getarea->name : '' }} {{ $order->address->getstreet ? $order->address->getstreet->name : '' }} {{ $order->address->address }}</td>
                    </tr>
                </table>
            </div>
            @if ($order->order_type == 0 && $order->visit)
                <div class="order-show mtm">
                    <table>
                        <tr>
                            <th width="20%" align="right">{{ trans('user.ordercard.visit.realname') }}</th>
                            <td>{{ $order->visit ? $order->visit->realname : '/' }}</td>
                        </tr>
                        <tr>
                            <th width="20%" align="right">{{ trans('user.ordercard.visit.mobile') }}</th>
                            <td>{{ $order->visit ? $order->visit->mobile : '/' }}</td>
                        </tr>
                        @if ($order->visit && $order->visit->remark)
                            <tr>
                                <th align="right">{{ trans('user.ordercard.visit.remark') }}</th>
                                <td>{{ $order->visit ? $order->visit->remark : '/' }}</td>
                            </tr>
                        @endif
                    </table>
                </div>
            @endif
            @if ($order->order_type == 1 && $order->shipping)
                <div class="order-show mtm">
                    <table>
                        <tr>
                            <th width="20%" align="right">{{ trans('user.ordercard.shipping.shipping_id') }}</th>
                            <td>{{ $order->shipping ? ($order->shipping->shipping ? $order->shipping->shipping->company : '/') : '/' }}</td>
                        </tr>
                        <tr>
                            <th width="20%" align="right">{{ trans('user.ordercard.shipping.waybill') }}</th>
                            <td>{{ $order->shipping ? $order->shipping->waybill : '/' }}</td>
                        </tr>
                        @if ($order->shipping && $order->shipping->remark)
                            <tr>
                                <th align="right">{{ trans('user.ordercard.shipping.remark') }}</th>
                                <td>{{ $order->shipping ? $order->shipping->remark : '/' }}</td>
                            </tr>
                        @endif
                    </table>
                </div>
            @endif
            <div class="order-show mtm">
                <table>
                    <tr>
                        <th width="20%" align="right">{{ trans('user.ordercard.created_at') }}</th>
                        <td>{{ $order->created_at ? $order->created_at->format('Y-m-d H:i') : '/' }}</td>
                    </tr>
                    @if ($order->pay_at)
                        <tr>
                            <th width="20%" align="right">{{ trans('user.ordercard.pay_at') }}</th>
                            <td>{{ $order->pay_at ? $order->pay_at->format('Y-m-d H:i') : '/' }}</td>
                        </tr>
                    @endif
                    @if ($order->shipping_at)
                        <tr>
                            <th align="right">{{ trans('user.ordercard.shipping_at') }}</th>
                            <td>{{ $order->shipping_at ? $order->shipping_at->format('Y-m-d H:i') : '/' }}</td>
                        </tr>
                    @endif
                    @if ($order->finish_at)
                        <tr>
                            <th align="right">{{ trans('user.ordercard.finish_at') }}</th>
                            <td>{{ $order->finish_at ? $order->finish_at->format('Y-m-d H:i') : '/' }}</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    @endif
@endsection