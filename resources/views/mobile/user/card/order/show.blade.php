@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">{{ trans('user.card.order') }}</div>
                </div>
                <div class="weui-panel weui-panel_access">
                    <div class="weui-panel__bd">
							<a href="javascript:;" class="weui-media-box weui-media-box_appmsg">
								<div class="weui-media-box__hd">
									<img class="weui-media-box__thumb" src="{{ asset('static/image/common/getheadimg.jpg') }}" alt="">
								</div>
								<div class="weui-media-box__bd">
									<h4 class="weui-media-box__title">{{ $order->address->realname }} <span class="mlm">{{ $order->address->mobile }}</span></h4>
									<p class="weui-media-box__desc">{{ $order->address->getprovince ? $order->address->getprovince->name : '' }} {{ $order->address->getcity ? $order->address->getcity->name : '' }} {{ $order->address->getarea ? $order->address->getarea->name : '' }} {{ $order->address->getstreet ? $order->address->getstreet->name : '' }}</p>
									<p class="weui-media-box__desc">{{ $order->address->address }}</p>
								</div>
							</a>
                    </div>
                </div>
                <div class="weui-form-preview mtm">
                    <div class="weui-form-preview__hd">
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">{{ trans('user.card.order.status') }}</label>
                            <span class="weui-form-preview__value">{{ trans('user.order.status_'.$order->ifpay) }}</span>
                        </div>
                    </div>
                    <div class="weui-form-preview__bd">
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">{{ trans('user.card.order.order_amount') }}</label>
                            <span class="weui-form-preview__value">¥{{ $order->order_amount or '0' }}</span>
                        </div>
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">{{ trans('user.card.order.created_at') }}</label>
                            <span class="weui-form-preview__value">{{ $order->created_at ? $order->created_at->format('Y-m-d H:i') : '/' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
