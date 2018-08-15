@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">{{ trans('user.consume') }}</div>
                </div>
                <div class="weui-panel weui-panel_access">
                    <div class="weui-panel__bd">
                        <a href="{{ route('mobile.brand.shop.show', $consume->shop->id) }}" class="weui-media-box weui-media-box_appmsg">
                            <div class="weui-media-box__hd">
                                <img class="weui-media-box__thumb" src="{{ uploadImage($consume->shop->upimage) }}" alt="">
                            </div>
                            <div class="weui-media-box__bd">
                                <h4 class="weui-media-box__title">{{ $consume->shop ? $consume->shop->name : '/' }}</h4>
                                <p class="weui-media-box__desc">电话：{{ $consume->shop ? $consume->shop->phone : '/' }}</p>
                                <p class="weui-media-box__desc">地址：{{ $consume->shop ? $consume->shop->address : '/' }}</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="weui-form-preview mtm">
                    <div class="weui-form-preview__hd">
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">{{ trans('user.consume.status') }}</label>
                            <span class="weui-form-preview__value">{{ trans('user.consume.status_'.$consume->pay_status) }}</span>
                        </div>
                    </div>
                    <div class="weui-form-preview__bd">
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">{{ trans('user.consume.consume_money') }}</label>
                            <span class="weui-form-preview__value">¥{{ $consume->consume_money or '0' }}</span>
                        </div>
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">{{ trans('user.consume.order_amount') }}</label>
                            <span class="weui-form-preview__value">¥{{ $consume->order_amount or '0' }}</span>
                        </div>
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label">{{ trans('user.consume.created_at') }}</label>
                            <span class="weui-form-preview__value">{{ $consume->created_at ? $consume->created_at->format('Y-m-d H:i') : '/' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
