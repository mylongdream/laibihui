@extends('layouts.mobile.app')

@section('style')
    <link href="{{ asset('static/css/swiper.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="weui-tab">
        <div class="weui-tab__panel">
            <div class="main-body">
                <div class="wp">
                    <div class="pbw">
                        <div class="index-header">
                            <div class="header-main">
                                @if ($setting['subwebstatus'])
                                    <div class="header-city">
                                        <a href="javascript:;">杭州</a>
                                    </div>
                                @endif
                                <div class="header-search open-popup" data-target="#searchBar" data-url="{{ route('mobile.brand.farm.search') }}">
                                    <div class="weui-search-bar__box">
                                        <i class="weui-icon-search"></i>
                                        <input type="search" class="weui-search-bar__input" name="keyword" placeholder="输入农家乐名称、地点" readonly="">
                                    </div>
                                </div>
                                <div class="header-user">
                                    <a href="{{ route('mobile.user.index') }}">我的</a>
                                </div>
                            </div>
                            <div class="header-fill"></div>
                        </div>
                        <div class="index-slide">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <a href="javascript:;"><img src="{{ asset('static/image/temp/index-slide1.jpg') }}"></a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="javascript:;"><img src="{{ asset('static/image/temp/index-slide2.jpg') }}"></a>
                                    </div>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                            <div class="weui-flex">
                                <div class="weui-flex__item">
                                    @if (auth()->check() && auth()->user()->card)
                                    <a href="{{ route('mobile.user.promotion.index') }}" class="">
                                        <div class="title">
                                            <span style="vertical-align: middle">推荐办卡</span>
                                            <span class="weui-badge" style="margin-left: 2px;">送钱</span>
                                        </div>
                                    </a>
                                    @else
                                        <a href="{{ route('mobile.brand.card.index') }}" class="">
                                            <div class="title">我要办卡</div>
                                        </a>
                                    @endif
                                </div>
                                <div class="weui-flex__item">
                                    <a href="{{ route('mobile.brand.card.active') }}" class="">
                                        <div class="title">快速开卡</div>
                                    </a>
                                </div>
                                <div class="weui-flex__item">
                                    <a href="{{ route('mobile.user.sign.index') }}" class="">
                                        <div class="title">签到领奖</div>
                                    </a>
                                </div>
                                <div class="weui-flex__item">
                                    <a href="{{ route('mobile.user.consume.index') }}" class="">
                                        <div class="title">消费账单</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="index-nav mtm">
                            <div class="swiper-slide">
                                <ul>
                                    @foreach (config('farm.play') as $key => $value)
                                        <li>
                                            <a href="{{ route('mobile.brand.farm.lists', ['play' => $key]) }}" class="">
                                                <div class="pic"><img src="{{ asset('static/image/brand/farm/fuct'.$key.'.png') }}"></div>
                                                <div class="title">{{ $value }}</div>
                                            </a>
                                        </li>
                                    @endforeach
                                    <li>
                                        <a href="{{ route('mobile.brand.farm.lists') }}" class="">
                                            <div class="pic"><img src="{{ asset('static/image/brand/farm/fuct8.png') }}"></div>
                                            <div class="title">更多</div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="index-farm mtm">
                            <div class="hd">
                                <h3>为您推荐</h3>
                            </div>
                            <div class="bd">
                                <ul class="cl">
                                    @foreach ($index->farmlist as $value)
                                        <li>
                                            <a href="{{ route('mobile.brand.farm.show', $value->id) }}" title="{{ $value->name }}">
                                                <div class="s-pic"><img src="{{ uploadImage($value->upimage) }}"></div>
                                                <div class="s-info">
                                                    <div class="s-name">{{ $value->name }}</div>
                                                    <div class="s-address">地址：{{ $value->address }}</div>
                                                    <div class="s-discount">
                                                        <label>尊享标牌价：</label>
                                                        <span class="s-discount1"><em>￥</em><strong>{{ $value->price }}</strong>元</span>
                                                        <span class="s-discount2"><del>原价靠边站</del></span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="weui-footer mtw">
                            <p class="weui-footer__links">
                                <a href="javascript:void(0);" class="weui-footer__link">关于我们</a>
                                <a href="javascript:void(0);" class="weui-footer__link">帮助中心</a>
                                <a href="javascript:void(0);" class="weui-footer__link">法律声明</a>
                                <a href="javascript:void(0);" class="weui-footer__link">商家入驻</a>
                            </p>
                            <p class="weui-footer__text">Copyright © 2008-2018 zhihui365.vip</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.mobile.footer')
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('static/js/swiper.min.js') }}"></script>
    <script type="text/javascript">
        var Swiper1 = new Swiper ('.index-slide .swiper-container', {
            autoplay: 4000,
            loop:true,
            pagination: {
                el: '.swiper-pagination'
            }
        });
    </script>
@endsection