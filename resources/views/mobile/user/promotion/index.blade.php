@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">{{ trans('user.promotion') }}</div>
                </div>
                <div class="weui-panel" style="padding:20px;text-align: center">
                    <p class="weui-msg__desc">你已成功推荐办卡 {{ $cardcount->firstnum }} 人，共获佣金 {{ $cardcount->firstmoney }} 元</p>
                    <p class="weui-msg__desc" style="margin-top:15px;">你朋友成功推荐办卡 {{ $cardcount->secondnum }} 人，共获佣金 {{ $cardcount->secondmoney }} 元</p>
                </div>
                <div class="weui-panel">
                    <div class="weui-panel__bd">
                        <div class="weui-media-box weui-media-box_small-appmsg">
                            <div class="weui-cells">
                                <a class="weui-cell weui-cell_access" href="{{ route('mobile.user.promotion.qrcode') }}">
                                    <div class="weui-cell__hd">
                                        <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-geren.png') }}" alt="">
                                    </div>
                                    <div class="weui-cell__bd weui-cell_primary">
                                        <p class="user-menu-txt">我的推广码</p>
                                    </div>
                                    <span class="weui-cell__ft"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="weui-panel">
                    <div class="weui-panel__bd">
                        <div class="weui-media-box weui-media-box_small-appmsg">
                            <div class="weui-cells">
                                <a class="weui-cell weui-cell_access" href="{{ route('mobile.user.promotion.first') }}">
                                    <div class="weui-cell__hd">
                                        <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-geren.png') }}" alt="">
                                    </div>
                                    <div class="weui-cell__bd weui-cell_primary">
                                        <span class="user-menu-txt">一级下线</span>
                                        <span class="weui-badge" style="margin-left: 5px;">{{ $usercount->first }}</span>
                                    </div>
                                    <span class="weui-cell__ft"></span>
                                </a>
                                <a class="weui-cell weui-cell_access" href="{{ route('mobile.user.promotion.second') }}">
                                    <div class="weui-cell__hd">
                                        <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-geren.png') }}" alt="">
                                    </div>
                                    <div class="weui-cell__bd weui-cell_primary">
                                        <span class="user-menu-txt">二级下线</span>
                                        <span class="weui-badge" style="margin-left: 5px;">{{ $usercount->second }}</span>
                                    </div>
                                    <span class="weui-cell__ft"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="weui-panel">
                    <div class="weui-panel__bd">
                        <div class="weui-media-box weui-media-box_small-appmsg">
                            <div class="weui-cells">
                                <a class="weui-cell weui-cell_access" href="{{ route('mobile.user.promotion.rule') }}">
                                    <div class="weui-cell__hd">
                                        <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-geren.png') }}" alt="">
                                    </div>
                                    <div class="weui-cell__bd weui-cell_primary">
                                        <p class="user-menu-txt">奖励机制</p>
                                    </div>
                                    <span class="weui-cell__ft"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection