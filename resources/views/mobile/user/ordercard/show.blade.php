@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">{{ trans('user.ordercard') }}</div>
                </div>
                <div class="weui-panel weui-panel_access">
                    <div class="weui-panel__bd">
                        <div class="weui-cell">
                            <div class="weui-cell__hd" style="margin-right: 10px;">
                                <img src="{{ asset('static/image/mobile/card.jpg') }}" style="height: 50px;display: block">
                            </div>
                            <div class="weui-cell__bd">
                                <p>知惠网联名卡</p>
                                <p style="margin-top:5px;color:#999;font-size:14px;">办卡方式：{{ trans('user.ordercard.order_type_'.$order->order_type) }}</p>
                            </div>
                            <div class="weui-cell__ft">￥10.00</div>
                        </div>
                    </div>
                </div>
                <div class="weui-form-preview mtm">
                    <div class="weui-form-preview__hd">
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">{{ trans('user.ordercard.status') }}</label>
                            <span class="weui-form-preview__value">{{ trans('user.ordercard.status_'.$order->order_status.$order->shipping_status.$order->pay_status) }}</span>
                        </div>
                    </div>
                    <div class="weui-form-preview__bd">
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">订单编号</label>
                            <span class="weui-form-preview__value">{{ $order->order_sn }}</span>
                        </div>
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">订单金额</label>
                            <span class="weui-form-preview__value">¥{{ $order->order_amount }}</span>
                        </div>
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">收货人</label>
                            <span class="weui-form-preview__value">{{ $order->address->realname }}</span>
                        </div>
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">手机号码</label>
                            <span class="weui-form-preview__value">{{ $order->address->mobile }}</span>
                        </div>
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">收货地址</label>
                            <span class="weui-form-preview__value">{{ $order->address->getprovince ? $order->address->getprovince->name : '' }} {{ $order->address->getcity ? $order->address->getcity->name : '' }} {{ $order->address->getarea ? $order->address->getarea->name : '' }} {{ $order->address->getstreet ? $order->address->getstreet->name : '' }} {{ $order->address->address }}</span>
                        </div>
                    </div>
                </div>
                @if ($order->order_type == 0 && $order->visit)
                    <div class="weui-form-preview mtm">
                        <div class="weui-form-preview__bd">
                            <div class="weui-form-preview__item">
                                <label class="weui-form-preview__label">{{ trans('user.ordercard.visit.realname') }}</label>
                                <span class="weui-form-preview__value">{{ $order->visit ? $order->visit->realname : '/' }}</span>
                            </div>
                            <div class="weui-form-preview__item">
                                <label class="weui-form-preview__label">{{ trans('user.ordercard.visit.mobile') }}</label>
                                <span class="weui-form-preview__value">{{ $order->visit ? $order->visit->mobile : '/' }}</span>
                            </div>
                            @if ($order->visit && $order->visit->remark)
                                <div class="weui-form-preview__item">
                                    <label class="weui-form-preview__label">{{ trans('user.ordercard.visit.remark') }}</label>
                                    <span class="weui-form-preview__value">{{ $order->visit ? $order->visit->remark : '/' }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                @if ($order->order_type == 1 && $order->shipping)
                    <div class="weui-form-preview mtm">
                        <div class="weui-form-preview__bd">
                            <div class="weui-form-preview__item">
                                <label class="weui-form-preview__label">{{ trans('user.ordercard.shipping.shipping_id') }}</label>
                                <span class="weui-form-preview__value">{{ $order->shipping ? ($order->shipping->shipping ? $order->shipping->shipping->company : '/') : '/' }}</span>
                            </div>
                            <div class="weui-form-preview__item">
                                <label class="weui-form-preview__label">{{ trans('user.ordercard.shipping.waybill') }}</label>
                                <span class="weui-form-preview__value">{{ $order->shipping ? $order->shipping->waybill : '/' }}</span>
                            </div>
                            @if ($order->shipping && $order->shipping->remark)
                                <div class="weui-form-preview__item">
                                    <label class="weui-form-preview__label">{{ trans('user.ordercard.shipping.remark') }}</label>
                                    <span class="weui-form-preview__value">{{ $order->shipping ? $order->shipping->remark : '/' }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                <div class="weui-form-preview mtm">
                    <div class="weui-form-preview__bd">
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">{{ trans('user.ordercard.created_at') }}</label>
                            <span class="weui-form-preview__value">{{ $order->created_at ? $order->created_at->format('Y-m-d H:i') : '/' }}</span>
                        </div>
                        @if ($order->pay_at)
                            <div class="weui-form-preview__item">
                                <label class="weui-form-preview__label">{{ trans('user.ordercard.pay_at') }}</label>
                                <span class="weui-form-preview__value">{{ $order->pay_at ? $order->pay_at->format('Y-m-d H:i') : '/' }}</span>
                            </div>
                        @endif
                        @if ($order->shipping_at)
                            <div class="weui-form-preview__item">
                                <label class="weui-form-preview__label">{{ trans('user.ordercard.shipping_at') }}</label>
                                <span class="weui-form-preview__value">{{ $order->shipping_at ? $order->shipping_at->format('Y-m-d H:i') : '/' }}</span>
                            </div>
                        @endif
                        @if ($order->finish_at)
                            <div class="weui-form-preview__item">
                                <label class="weui-form-preview__label">{{ trans('user.ordercard.finish_at') }}</label>
                                <span class="weui-form-preview__value">{{ $order->finish_at ? $order->finish_at->format('Y-m-d H:i') : '/' }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                @if ($order->order_status == 0 && $order->shipping_status == 0 && $order->pay_status == 0)
                    <div class="weui-btn-area">
                        <a href="{{ route('mobile.brand.card.pay', $order->order_sn) }}" title="立即付款" class="weui-btn weui-btn_primary">立即付款</a>
                        <a href="{{ route('mobile.user.ordercard.cancel', $order->order_sn) }}" title="取消订单" class="weui-btn weui-btn_warn ajaxbutton confirmbtn">取消订单</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
