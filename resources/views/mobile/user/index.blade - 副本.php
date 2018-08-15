@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="weui-tab__panel">
            <div class="main-body">
                <div class="wp">
                    <div class="pbw">
                        <div class="user-info">
                            <div class="weui-media-box weui-media-box_appmsg">
                                <div class="weui-media-box__hd">
                                    <img class="weui-media-box__thumb radius" src="{{ auth()->user()->headimgurl ? uploadImage(auth()->user()->headimgurl) : asset('static/image/common/getheadimg.jpg') }}">
                                </div>
                                <div class="weui-media-box__bd">
                                    <dl class="cl">
                                        <dt>您好，<strong>{{auth()->user()->username}}</strong></dt>
                                        <dd>
                                            <p>手机号码：{{auth()->user()->mobile}}</p>
                                            <p>账户积分：{{auth()->user()->score}} 个</p>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="weui-panel">
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
                        <div class="weui-panel">
                            <div class="weui-panel__bd">
                                <div class="weui-media-box weui-media-box_small-appmsg">
                                    <div class="weui-cells">
                                        <a class="weui-cell weui-cell_access" href="{{ route('mobile.user.promotion.index') }}">
                                            <div class="weui-cell__hd">
                                                <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-tg.png') }}" alt="">
                                            </div>
                                            <div class="weui-cell__bd weui-cell_primary">
                                                <p class="user-menu-txt">推荐办卡</p>
                                            </div>
                                            <span class="weui-cell__ft"></span>
                                        </a>
                                        <a class="weui-cell weui-cell_access" href="{{ route('mobile.user.card.bind') }}">
                                            <div class="weui-cell__hd">
                                                <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-card.png') }}" alt="">
                                            </div>
                                            <div class="weui-cell__bd weui-cell_primary">
                                                <p class="user-menu-txt">在线绑卡</p>
                                            </div>
                                            <span class="weui-cell__ft"></span>
                                        </a>
                                        <a class="weui-cell weui-cell_access" href="{{ route('mobile.user.appoint.index') }}">
                                            <div class="weui-cell__hd">
                                                <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-yuyue.png') }}" alt="">
                                            </div>
                                            <div class="weui-cell__bd weui-cell_primary">
                                                <p class="user-menu-txt">店铺预约</p>
                                            </div>
                                            <span class="weui-cell__ft"></span>
                                        </a>
                                        <a class="weui-cell weui-cell_access" href="{{ route('mobile.user.consume.index') }}">
                                            <div class="weui-cell__hd">
                                                <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-order.png') }}" alt="">
                                            </div>
                                            <div class="weui-cell__bd weui-cell_primary">
                                                <p class="user-menu-txt">消费记录</p>
                                            </div>
                                            <span class="weui-cell__ft"></span>
                                        </a>
                                        <a class="weui-cell weui-cell_access" href="{{ route('mobile.user.score.index') }}">
                                            <div class="weui-cell__hd">
                                                <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-jk.png') }}" alt="">
                                            </div>
                                            <div class="weui-cell__bd weui-cell_primary">
                                                <p class="user-menu-txt">我的积分</p>
                                            </div>
                                            <span class="weui-cell__ft"></span>
                                        </a>
                                        <a class="weui-cell weui-cell_access" href="{{ route('mobile.user.collection.index') }}">
                                            <div class="weui-cell__hd">
                                                <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-sc.png') }}" alt="">
                                            </div>
                                            <div class="weui-cell__bd weui-cell_primary">
                                                <p class="user-menu-txt">我的收藏</p>
                                            </div>
                                            <span class="weui-cell__ft"></span>
                                        </a>
                                        <a class="weui-cell weui-cell_access" href="{{ route('mobile.user.history.index') }}">
                                            <div class="weui-cell__hd">
                                                <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-ll.png') }}" alt="">
                                            </div>
                                            <div class="weui-cell__bd weui-cell_primary">
                                                <p class="user-menu-txt">浏览历史</p>
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
                                        <a class="weui-cell weui-cell_access" href="{{ route('mobile.user.address.index') }}">
                                            <div class="weui-cell__hd">
                                                <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-dz.png') }}" alt="">
                                            </div>
                                            <div class="weui-cell__bd weui-cell_primary">
                                                <p class="user-menu-txt">我的地址</p>
                                            </div>
                                            <span class="weui-cell__ft"></span>
                                        </a>
                                        <a class="weui-cell weui-cell_access" href="{{ route('mobile.user.profile.index') }}">
                                            <div class="weui-cell__hd">
                                                <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-dlmm.png') }}" alt="">
                                            </div>
                                            <div class="weui-cell__bd weui-cell_primary">
                                                <p class="user-menu-txt">个人资料</p>
                                            </div>
                                            <span class="weui-cell__ft"></span>
                                        </a>
                                        <a class="weui-cell weui-cell_access" href="{{ route('mobile.user.password.index') }}">
                                            <div class="weui-cell__hd">
                                                <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-dlmm.png') }}" alt="">
                                            </div>
                                            <div class="weui-cell__bd weui-cell_primary">
                                                <p class="user-menu-txt">密码修改</p>
                                            </div>
                                            <span class="weui-cell__ft"></span>
                                        </a>
                                        <a class="weui-cell weui-cell_access" href="{{ route('mobile.logout') }}">
                                            <div class="weui-cell__hd">
                                                <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-out.png') }}" alt="">
                                            </div>
                                            <div class="weui-cell__bd weui-cell_primary">
                                                <p class="user-menu-txt">退出账号</p>
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
        @include('layouts.mobile.footer')
    </div>
@endsection