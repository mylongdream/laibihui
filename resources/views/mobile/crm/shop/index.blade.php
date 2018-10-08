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
                                <div class="weui-grids">
                                    <a href="javascript:;" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-hg.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">预约订座</p>
                                    </a>
                                    <a href="javascript:;" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-tg.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">点餐管理</p>
                                    </a>
                                    <a href="javascript:;" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-jindu.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">跨界整合</p>
                                    </a>
                                    <a href="javascript:;" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-card.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">经营统计</p>
                                    </a>
                                    <a href="javascript:;" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-yuyue.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">签约管理</p>
                                    </a>
                                    <a href="javascript:;" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-meal.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">保证金管理</p>
                                    </a>
                                    <a href="javascript:;" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-farm.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">面对面办卡</p>
                                    </a>
                                    <a href="javascript:;" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-order.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">我的售卡</p>
                                    </a>
                                    <a href="javascript:;" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-cardreward.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">售卡兑奖</p>
                                    </a>
                                    <a href="javascript:;" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-cardreward.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">收银结账</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="weui-panel">
                            <div class="weui-panel__bd">
                                <div class="weui-grids">
                                    <a href="javascript:;" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-hg.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">缺卡登记</p>
                                    </a>
                                    <a href="javascript:;" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-tg.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">联系客户经理</p>
                                    </a>
                                    <a href="javascript:;" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-jindu.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">设置</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection