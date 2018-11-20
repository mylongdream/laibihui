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
                                    <img class="weui-media-box__thumb" src="{{ auth()->user()->headimgurl ? uploadImage(auth()->user()->headimgurl) : asset('static/image/common/getheadimg.jpg') }}">
                                </div>
                                <div class="weui-media-box__bd">
                                    <h4 class="weui-media-box__title">{{ auth()->user()->username }}</h4>
                                    <p class="weui-media-box__desc">手机号码：{{ auth()->user()->mobile ? auth()->user()->mobile : '暂无' }}</p>
                                    <p class="weui-media-box__desc">账户积分：{{ auth()->user()->score }} 个</p>
                                </div>
                                <div class="weui-media-box__ft">
                                </div>
                            </div>
                        </div>
                        <div class="weui-panel">
                            <a class="weui-cell weui-cell_access" href="{{ route('mobile.user.account.index') }}">
                                <div class="weui-cell__hd">
                                    <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-jk.png') }}" alt="">
                                </div>
                                <div class="weui-cell__bd weui-cell_primary">
                                    <p class="user-menu-txt">我的钱包</p>
                                </div>
                                <span class="weui-cell__ft"></span>
                            </a>
                        </div>
                        <div class="weui-panel" style="margin: 0">
                            <div class="weui-panel__bd user-account">
                                <div class="weui-flex">
                                    <div class="weui-flex__item">
                                        <a href="javascript:;" class="">
                                            <div class="money">{{auth()->user()->tiyan_money}} 元</div>
                                            <div class="name">到店体验金</div>
                                        </a>
                                    </div>
                                    <div class="weui-flex__item">
                                        <a href="javascript:;" class="">
                                            <div class="money">{{auth()->user()->frozen_money}} 元</div>
                                            <div class="name">冻结余额</div>
                                        </a>
                                    </div>
                                    <div class="weui-flex__item">
                                        <a href="javascript:;" class="">
                                            <div class="money">{{auth()->user()->user_money}} 元</div>
                                            <div class="name">可用余额</div>
                                        </a>
                                    </div>
                                    <div class="weui-flex__item">
                                        <a href="javascript:;" class="">
                                            <div class="money">{{auth()->user()->consume_money}} 元</div>
                                            <div class="name">消费总额</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (!auth()->user()->card)
                        <div class="weui-panel">
                            <a class="weui-cell weui-cell_access" href="{{ route('mobile.brand.card.index') }}">
                                <div class="weui-cell__bd weui-cell_primary">
                                    <p class="user-menu-txt">温馨提醒；如你不方便就近办卡可邮寄办卡，享200元奖励！点击查看详情
                                    </p>
                                </div>
                                <span class="weui-cell__ft"></span>
                            </a>
                        </div>
                            @else
                            <div class="weui-panel">
                                <a class="weui-cell weui-cell_access" href="{{ route('mobile.user.promotion.index') }}">
                                    <div class="weui-cell__bd weui-cell_primary">
                                        <p class="user-menu-txt">特大喜讯:推荐亲朋好友注册，最高享五元佣金返还，点击了解详情
                                        </p>
                                    </div>
                                    <span class="weui-cell__ft"></span>
                                </a>
                            </div>
                        @endif
                        <div class="weui-panel">
                            <div class="weui-panel__bd">
                                <div class="weui-grids">
                                    <a href="{{ route('mobile.user.sign.index') }}" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-hg.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">签到领奖</p>
                                    </a>
                                    <a href="{{ route('mobile.user.promotion.index') }}" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-tg.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">推荐注册</p>
                                    </a>
                                    <a href="{{ route('mobile.user.progress') }}" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-jindu.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">进度查询</p>
                                    </a>
                                    <a href="{{ route('mobile.user.bindcard.index') }}" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-card.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">{{ trans('user.bindcard') }}</p>
                                    </a>
                                    <a href="{{ route('mobile.user.appoint.index') }}" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-yuyue.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">预约订座</p>
                                    </a>
                                    <a href="{{ route('mobile.user.ordermeal.index') }}" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-meal.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">点餐管理</p>
                                    </a>
                                    <a href="{{ route('mobile.user.orderfarm.index') }}" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-farm.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">农家乐管理</p>
                                    </a>
                                    <a href="{{ route('mobile.user.consume.index') }}" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-order.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">消费账单</p>
                                    </a>
                                    <a href="{{ route('mobile.brand.assist.index') }}" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-assist.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">助力免单</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="weui-panel">
                            <div class="weui-panel__bd">
                                <div class="weui-grids">
                                    <a href="{{ route('mobile.user.score.index') }}" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-score.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">积分明细</p>
                                    </a>
                                    <a href="{{ route('mobile.user.collection.index') }}" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-sc.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">我的收藏</p>
                                    </a>
                                    <a href="{{ route('mobile.user.history.index') }}" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-ll.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">浏览历史</p>
                                    </a>
                                    <a href="{{ route('mobile.user.setting') }}" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-setting.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">设置</p>
                                    </a>
                                    <a href="{{ route('mobile.brand.faq.index') }}" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-kefu.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">我的客服</p>
                                    </a>
                                    <a href="{{ route('mobile.user.feedback.index') }}" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-fuwu.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">意见反馈</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.mobile.footer')
    </div>
@endsection