@extends('layouts.mobile.app')

@section('content')
    <div class="">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">{{ trans('user.promotion.second') }}</div>
                </div>
                <div class="weui-tab" id="tab">
                    <div class="weui-navbar tab_box">
                        <div class="weui-navbar__item weui-bar__item_on">
                            <a href="{{ route('mobile.user.promotion.second', ['bindcard' => 1]) }}" class="">
                                <div class="title">未开卡<span class="weui-badge" style="margin-left: 5px;">{{ $usercount->doesntHaveCard }}</span></div>
                            </a>
                        </div>
                        <div class="weui-navbar__item">
                            <a href="{{ route('mobile.user.promotion.second', ['bindcard' => 2]) }}" class="">
                                <div class="title">已开卡<span class="weui-badge" style="margin-left: 5px;">{{ $usercount->hasCard }}</span></div>
                            </a>
                        </div>
                    </div>
                    @foreach ($promotions as $value)
                        <div class="weui-panel panel-item">
                            <div class="weui-panel__bd">
                                <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
                                    <div class="weui-media-box__hd">
                                        <img class="weui-media-box__thumb" src="{{ $value->headimgurl ? uploadImage($value->headimgurl) : asset('static/image/common/getheadimg.jpg') }}" alt="">
                                    </div>
                                    <div class="weui-media-box__bd">
                                        <h4 class="weui-media-box__title">{{ $value->username ? $value->username : '/' }}</h4>
                                        <p class="weui-media-box__desc">手机：{{ $value->mobile ? $value->mobile : '/' }}</p>
                                        <p class="weui-media-box__desc">时间：{{ $value->created_at->format('Y-m-d H:i') }}</p>
                                    </div>
                                </a>
                            </div>
                            <div class="weui-panel__ft">
                                <div class="z status">状态：{{ $value->card ? '已开卡' : '未开卡' }}</div>
                            </div>
                        </div>
                    @endforeach
                    {!! $promotions->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection