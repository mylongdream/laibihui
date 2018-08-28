@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="weui-tab__panel">
            <div class="main-body">
                <div class="wp">
                    <div class="pbw">
                        <div class="weui-panel weui-panel_access">
                            <div class="weui-media-box weui-media-box_appmsg">
                                <div class="weui-media-box__hd">
                                    <img class="weui-media-box__thumb" src="{{ auth('crm')->user()->headimgurl ? uploadImage(auth('crm')->user()->headimgurl) : asset('static/image/common/getheadimg.jpg') }}">
                                </div>
                                <div class="weui-media-box__bd">
                                    <h4 class="weui-media-box__title">{{ auth('crm')->user()->username }}</h4>
                                    <p class="weui-media-box__desc">手机号码：{{ auth('crm')->user()->mobile ? auth('crm')->user()->mobile : '暂无' }}</p>
                                    <p class="weui-media-box__desc">用户分组：{{ auth('crm')->user()->group->name }}</p>
                                </div>
                                <div class="weui-media-box__ft">
                                </div>
                            </div>
                        </div>
                        <div class="weui-panel">
                            <div class="weui-panel__bd">
                                <div class="weui-media-box weui-media-box_small-appmsg">
                                    <div class="weui-cells">
                                        <a class="weui-cell weui-cell_access" href="">
                                            <div class="weui-cell__hd">
                                                <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-geren.png') }}" alt="">
                                            </div>
                                            <div class="weui-cell__bd weui-cell_primary">
                                                <p class="user-menu-txt">店铺消费</p>
                                            </div>
                                            <span class="weui-cell__ft"></span>
                                        </a>
                                        <a class="weui-cell weui-cell_access" href="">
                                            <div class="weui-cell__hd">
                                                <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-geren.png') }}" alt="">
                                            </div>
                                            <div class="weui-cell__bd weui-cell_primary">
                                                <p class="user-menu-txt">预约订座</p>
                                            </div>
                                            <span class="weui-cell__ft"></span>
                                        </a>
                                        <a class="weui-cell weui-cell_access" href="">
                                            <div class="weui-cell__hd">
                                                <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-geren.png') }}" alt="">
                                            </div>
                                            <div class="weui-cell__bd weui-cell_primary">
                                                <p class="user-menu-txt">点餐管理</p>
                                            </div>
                                            <span class="weui-cell__ft"></span>
                                        </a>
                                        <a class="weui-cell weui-cell_access" href="">
                                            <div class="weui-cell__hd">
                                                <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-geren.png') }}" alt="">
                                            </div>
                                            <div class="weui-cell__bd weui-cell_primary">
                                                <p class="user-menu-txt">提现记录</p>
                                            </div>
                                            <span class="weui-cell__ft"></span>
                                        </a>
                                        <a class="weui-cell weui-cell_access" href="">
                                            <div class="weui-cell__hd">
                                                <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-geren.png') }}" alt="">
                                            </div>
                                            <div class="weui-cell__bd weui-cell_primary">
                                                <p class="user-menu-txt">收银结账</p>
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
                                        <a class="weui-cell weui-cell_access" href="{{ route('mobile.crm.logout') }}">
                                            <div class="weui-cell__hd">
                                                <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-geren.png') }}" alt="">
                                            </div>
                                            <div class="weui-cell__bd weui-cell_primary">
                                                <p class="user-menu-txt">退出登录</p>
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
        </div>
    </div>
@endsection