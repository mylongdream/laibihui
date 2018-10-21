@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">{{ trans('user.appoint') }}</div>
                </div>
                @if (count($appoints))
                @foreach ($appoints as $value)
                    <div class="weui-panel panel-item">
                        <div class="weui-panel__hd">
                            <div class="z">订单号：{{ $value->order_sn }}</div>
                        </div>
                        <div class="weui-panel__bd">
                            <div class="weui-media-box weui-media-box_appmsg">
                                <div class="weui-media-box__hd">
                                    <img class="weui-media-box__thumb" src="{{ $value->user && $value->user->headimgurl ? uploadImage($value->user->headimgurl) : asset('static/image/common/getheadimg.jpg') }}" alt="">
                                </div>
                                <div class="weui-media-box__bd">
                                    <h4 class="weui-media-box__title">{{ $value->realname ? $value->realname : '/' }}</h4>
                                    <p class="weui-media-box__desc">电话：{{ $value->mobile ? $value->mobile : '/' }}</p>
                                    <p class="weui-media-box__desc">时间：{{ $value->appoint_at ? $value->appoint_at->format('Y-m-d H:i') : '/' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="weui-panel__ft">
                            <div class="z status">状态：{{ trans('user.appoint.status_'.$value->status) }}</div>
                            <div class="y">
                                <a href="{{ route('mobile.crm.shop.appoint.show', $value->order_sn) }}" title="订单详情" class="mlm">订单详情</a>
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
@endsection
