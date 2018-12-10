@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="weui-msg" style="background:#fff;padding:15px 10px;">
                    <div class="weui-msg__icon-area" style="margin-bottom: 10px;">
                        <img src="{{ $shop->upimage ? uploadImage($shop->upimage) : asset('static/image/common/getheadimg.jpg') }}" width="92" height="92" style="display:block;margin:0 auto;">
                    </div>
                    <div class="">
                        <h2 class="weui-msg__title">{{ $shop->name }}</h2>
                        <p class="weui-msg__desc">联系电话：{{ $shop->phone }}</p>
                    </div>
                </div>
                <div class="weui-panel">
                    <div class="weui-panel__bd user-account">
                        <div class="weui-flex">
                            <div class="weui-flex__item">
                                <a href="javascript:;" class="">
                                    <div class="money">{{ $shop->money }} 元</div>
                                    <div class="name">当前账户金额</div>
                                </a>
                            </div>
                            <div class="weui-flex__item">
                                <a href="javascript:;" class="">
                                    <div class="money">{{ $shop->money }} 元</div>
                                    <div class="name">今日收入</div>
                                </a>
                            </div>
                            <div class="weui-flex__item">
                                <a href="javascript:;" class="">
                                    <div class="money">{{ $shop->money }} 元</div>
                                    <div class="name">本月收入</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="weui-panel">
                    <div class="weui-panel__bd user-account">
                        <div class="weui-flex">
                            <div class="weui-flex__item">
                                <a href="javascript:;" class="">
                                    <div class="money">{{ $count->giftcard_all }} 张</div>
                                    <div class="name">当前领卡总数</div>
                                </a>
                            </div>
                            <div class="weui-flex__item">
                                <a href="javascript:;" class="">
                                    <div class="money">{{ $count->giftcard_today }} 张</div>
                                    <div class="name">今日奖励</div>
                                </a>
                            </div>
                            <div class="weui-flex__item">
                                <a href="javascript:;" class="">
                                    <div class="money">{{ $count->giftcard_month }} 张</div>
                                    <div class="name">本月奖励</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="weui-panel">
                    <div class="weui-panel__bd">
                        <div class="weui-grids">
                            <a href="{{ route('mobile.crm.shop.appoint.index') }}" class="weui-grid">
                                <div class="weui-grid__icon">
                                    <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-hg.png') }}" alt="">
                                </div>
                                <p class="weui-grid__label">预约订座</p>
                            </a>
                            <a href="{{ route('mobile.crm.shop.ordermeal.index') }}" class="weui-grid">
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
                            <a href="{{ route('mobile.crm.shop.statistics.index') }}" class="weui-grid">
                                <div class="weui-grid__icon">
                                    <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-card.png') }}" alt="">
                                </div>
                                <p class="weui-grid__label">经营统计</p>
                            </a>
                            <a href="{{ route('mobile.crm.shop.function.index') }}" class="weui-grid">
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
                            <a href="{{ route('mobile.crm.shop.sellcard.index') }}" class="weui-grid">
                                <div class="weui-grid__icon">
                                    <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-farm.png') }}" alt="">
                                </div>
                                <p class="weui-grid__label">面对面办卡</p>
                            </a>
                            <a href="{{ route('mobile.crm.shop.sellcard.order') }}" class="weui-grid">
                                <div class="weui-grid__icon">
                                    <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-order.png') }}" alt="">
                                </div>
                                <p class="weui-grid__label">我的售卡</p>
                            </a>
                            <a href="{{ route('mobile.crm.shop.cardreward.index') }}" class="weui-grid">
                                <div class="weui-grid__icon">
                                    <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-cardreward.png') }}" alt="">
                                </div>
                                <p class="weui-grid__label">售卡兑奖</p>
                            </a>
                            <a href="{{ route('mobile.crm.shop.checkout.index') }}" class="weui-grid">
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
                            <a href="{{ route('mobile.crm.shop.lackcard.checkin') }}" class="weui-grid">
                                <div class="weui-grid__icon">
                                    <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-hg.png') }}" alt="">
                                </div>
                                <p class="weui-grid__label">缺卡登记</p>
                            </a>
                            <a href="{{ route('mobile.crm.shop.superior.index') }}" class="weui-grid">
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
@endsection