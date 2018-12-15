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
                            <div class="weui-panel__bd user-account">
                                <div class="weui-flex">
                                    <div class="weui-flex__item">
                                        <a href="javascript:;" class="">
                                            <div class="money">{{ $count->card_today }} 张</div>
                                            <div class="name">今日发卡量</div>
                                        </a>
                                    </div>
                                    <div class="weui-flex__item">
                                        <a href="javascript:;" class="">
                                            <div class="money">{{ $count->card_yesterday }} 张</div>
                                            <div class="name">昨日发卡量</div>
                                        </a>
                                    </div>
                                    <div class="weui-flex__item">
                                        <a href="javascript:;" class="">
                                            <div class="money">{{ $count->card_allotnum }} 张</div>
                                            <div class="name">库存卡数</div>
                                        </a>
                                    </div>
                                    <div class="weui-flex__item">
                                        <a href="javascript:;" class="">
                                            <div class="money">{{ $count->card_sellnum }} 张</div>
                                            <div class="name">总发行卡数</div>
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
                                            <div class="money">0 元</div>
                                            <div class="name">今日业绩</div>
                                        </a>
                                    </div>
                                    <div class="weui-flex__item">
                                        <a href="javascript:;" class="">
                                            <div class="money">0 元</div>
                                            <div class="name">昨日业绩</div>
                                        </a>
                                    </div>
                                    <div class="weui-flex__item">
                                        <a href="javascript:;" class="">
                                            <div class="money">0 元</div>
                                            <div class="name">本月业绩</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="weui-panel">
                            <div class="weui-panel__bd">
                                <div class="weui-grids">
                                    <a href="{{ route('mobile.crm.tuiguang.sellcard.index') }}" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-hg.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">面对面办卡</p>
                                    </a>
                                    <a href="{{ route('mobile.crm.tuiguang.grantsell.index') }}" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-tg.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">授权办卡管理</p>
                                    </a>
                                    <a href="{{ route('mobile.crm.tuiguang.lackcard.checkin') }}" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-jindu.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">缺卡登记</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="weui-panel">
                            <div class="weui-panel__bd">
                                <div class="weui-grids">
                                    <a href="{{ route('mobile.crm.tuiguang.cardreward.index') }}" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-hg.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">售卡兑奖</p>
                                    </a>
                                    <a href="javascript:;" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-tg.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">通讯簿</p>
                                    </a>
                                    <a href="{{ route('mobile.crm.logout') }}" class="weui-grid">
                                        <div class="weui-grid__icon">
                                            <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-jindu.png') }}" alt="">
                                        </div>
                                        <p class="weui-grid__label">退出登录</p>
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