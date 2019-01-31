@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">{{ trans('user.appoint') }}</div>
                </div>
                <div class="weui-tab" id="tab">
                    <div class="weui-navbar tab_box">
                        <div class="weui-navbar__item weui-bar__item_on">
                            <a href="{{ route('mobile.user.appoint.index', ['status' => request('status')]) }}" class="">
                                <div class="title">全部订单</div>
                            </a>
                        </div>
                        <div class="weui-navbar__item">
                            <a href="{{ route('mobile.user.appoint.index', ['status' => request('status')]) }}" class="">
                                <div class="title">待付款</div>
                            </a>
                        </div>
                        <div class="weui-navbar__item">
                            <a href="{{ route('mobile.user.appoint.index', ['status' => request('status')]) }}" class="">
                                <div class="title">进行中</div>
                            </a>
                        </div>
                        <div class="weui-navbar__item">
                            <a href="{{ route('mobile.user.appoint.index', ['status' => request('status')]) }}" class="">
                                <div class="title">已完成</div>
                            </a>
                        </div>
                        <div class="weui-navbar__item">
                            <a href="{{ route('mobile.user.appoint.index', ['status' => request('status')]) }}" class="">
                                <div class="title">待点评</div>
                            </a>
                        </div>
                    </div>
                    <div class="weui-tab__panel">
                        @if (count($appoints))
                            @foreach ($appoints as $value)
                                <div class="weui-panel panel-item">
                                    <div class="weui-panel__hd">
                                        <div class="z">订单号：{{ $value->order_sn }}</div>
                                    </div>
                                    <div class="weui-panel__bd">
                                        <a href="{{ route('mobile.brand.shop.show', $value->shop->id) }}" class="weui-media-box weui-media-box_appmsg">
                                            <div class="weui-media-box__hd">
                                                <img class="weui-media-box__thumb" src="{{ uploadImage($value->shop->upimage) }}" alt="">
                                            </div>
                                            <div class="weui-media-box__bd">
                                                <h4 class="weui-media-box__title">{{ $value->shop ? $value->shop->name : '/' }}</h4>
                                                <p class="weui-media-box__desc">电话：{{ $value->shop ? $value->shop->phone : '/' }}</p>
                                                <p class="weui-media-box__desc">地址：{{ $value->shop ? $value->shop->address : '/' }}</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="weui-panel__ft">
                                        <div class="z status">状态：{{ trans('user.appoint.status_'.$value->status) }}</div>
                                        <div class="y">
                                            @if ($value->status == 0)
                                                <a href="{{ route('mobile.user.appoint.cancel', $value->order_sn) }}" title="取消预约" class="openwindow btn-cancel">取消预约</a>
                                            @else
                                                @if ($value->shop)
                                                    <a href="{{ route('mobile.brand.shop.show', $value->shop->id) }}" target="_blank" title="再次预约" class="btn-again">再次预约</a>
                                                @endif
                                            @endif
                                            <a href="{{ route('mobile.user.appoint.show', $value->order_sn) }}" title="订单详情" class="mlm">订单详情</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {!! $appoints->links() !!}
                        @else
                            <div class="no-data">
                                <p>暂无数据！</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
