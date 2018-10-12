@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">经营统计</div>
                </div>
                <div class="weui-panel">
                    <div class="weui-panel__bd">
                        <div class="weui-media-box weui-media-box_small-appmsg">
                            <div class="weui-cells">
                                <a class="weui-cell weui-cell_access" href="{{ route('mobile.crm.shop.statistics.income') }}">
                                    <div class="weui-cell__hd">
                                        <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-dz.png') }}" alt="">
                                    </div>
                                    <div class="weui-cell__bd weui-cell_primary">
                                        <p class="user-menu-txt">收入统计</p>
                                    </div>
                                    <span class="weui-cell__ft"></span>
                                </a>
                                <a class="weui-cell weui-cell_access" href="{{ route('mobile.crm.shop.statistics.order') }}">
                                    <div class="weui-cell__hd">
                                        <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-geren.png') }}" alt="">
                                    </div>
                                    <div class="weui-cell__bd weui-cell_primary">
                                        <p class="user-menu-txt">订单统计</p>
                                    </div>
                                    <span class="weui-cell__ft"></span>
                                </a>
                                <a class="weui-cell weui-cell_access" href="javascript:;">
                                    <div class="weui-cell__hd">
                                        <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-dlmm.png') }}" alt="">
                                    </div>
                                    <div class="weui-cell__bd weui-cell_primary">
                                        <p class="user-menu-txt">订单来源</p>
                                    </div>
                                    <span class="weui-cell__ft"></span>
                                </a>
                                <a class="weui-cell weui-cell_access" href="javascript:;">
                                    <div class="weui-cell__hd">
                                        <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-dlmm.png') }}" alt="">
                                    </div>
                                    <div class="weui-cell__bd weui-cell_primary">
                                        <p class="user-menu-txt">销量排行</p>
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