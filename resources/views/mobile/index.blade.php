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
                                <div class="header-search open-popup" data-target="#searchBar" data-url="{{ route('mobile.search') }}">
                                    <div class="weui-search-bar__box">
                                        <i class="weui-icon-search"></i>
                                        <input type="search" class="weui-search-bar__input" name="keyword" placeholder="输入商户名、地点、商户搜索码" readonly="">
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
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="weui-flex">
                                            <div class="weui-flex__item">
                                                <a href="{{ route('mobile.brand.shop.index') }}" class="">
                                                    <div class="pic"><img src="{{ asset('static/image/mobile/nav_icon_meishi.png') }}"></div>
                                                    <div class="title">美食</div>
                                                </a>
                                            </div>
                                            <div class="weui-flex__item">
                                                <a href="{{ route('mobile.brand.shop.index') }}" class="">
                                                    <div class="pic"><img src="{{ asset('static/image/mobile/nav_icon_xiuxianyule.png') }}"></div>
                                                    <div class="title">娱乐休闲</div>
                                                </a>
                                            </div>
                                            <div class="weui-flex__item">
                                                <a href="{{ route('mobile.brand.shop.index') }}" class="">
                                                    <div class="pic"><img src="{{ asset('static/image/mobile/nav_icon_meifa.png') }}"></div>
                                                    <div class="title">美容美发</div>
                                                </a>
                                            </div>
                                            <div class="weui-flex__item">
                                                <a href="{{ route('mobile.brand.shop.index') }}" class="">
                                                    <div class="pic"><img src="{{ asset('static/image/mobile/nav_icon_jiehun.png') }}"></div>
                                                    <div class="title">婚纱摄影</div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="weui-flex">
                                            <div class="weui-flex__item">
                                                <a href="{{ route('mobile.brand.shop.index') }}" class="">
                                                    <div class="pic"><img src="{{ asset('static/image/mobile/nav_icon_huoguo.png') }}"></div>
                                                    <div class="title">火锅</div>
                                                </a>
                                            </div>
                                            <div class="weui-flex__item">
                                                <a href="{{ route('mobile.brand.shop.index') }}" class="">
                                                    <div class="pic"><img src="{{ asset('static/image/mobile/nav_icon_jianshen.png') }}"></div>
                                                    <div class="title">运动健身</div>
                                                </a>
                                            </div>
                                            <div class="weui-flex__item">
                                                <a href="{{ route('mobile.brand.shop.index') }}" class="">
                                                    <div class="pic"><img src="{{ asset('static/image/mobile/nav_icon_zhoubianyou.png') }}"></div>
                                                    <div class="title">旅游度假</div>
                                                </a>
                                            </div>
                                            <div class="weui-flex__item">
                                                <a href="{{ route('mobile.brand.shop.index') }}" class="">
                                                    <div class="pic"><img src="{{ asset('static/image/mobile/nav_icon_ktv.png') }}"></div>
                                                    <div class="title">KTV</div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="weui-flex">
                                            <div class="weui-flex__item">
                                                <a href="{{ route('mobile.brand.shop.index') }}" class="">
                                                    <div class="pic"><img src="{{ asset('static/image/mobile/nav_icon_huoguo.png') }}"></div>
                                                    <div class="title">火锅</div>
                                                </a>
                                            </div>
                                            <div class="weui-flex__item">
                                                <a href="{{ route('mobile.brand.shop.index') }}" class="">
                                                    <div class="pic"><img src="{{ asset('static/image/mobile/nav_icon_jianshen.png') }}"></div>
                                                    <div class="title">运动健身</div>
                                                </a>
                                            </div>
                                            <div class="weui-flex__item">
                                                <a href="{{ route('mobile.brand.shop.index') }}" class="">
                                                    <div class="pic"><img src="{{ asset('static/image/mobile/nav_icon_zhoubianyou.png') }}"></div>
                                                    <div class="title">旅游度假</div>
                                                </a>
                                            </div>
                                            <div class="weui-flex__item">
                                                <a href="{{ route('mobile.brand.shop.index') }}" class="">
                                                    <div class="pic"><img src="{{ asset('static/image/mobile/nav_icon_ktv.png') }}"></div>
                                                    <div class="title">KTV</div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="weui-flex">
                                            <div class="weui-flex__item">
                                                <a href="{{ route('mobile.brand.shop.index') }}" class="">
                                                    <div class="pic"><img src="{{ asset('static/image/mobile/nav_icon_meishi.png') }}"></div>
                                                    <div class="title">美食</div>
                                                </a>
                                            </div>
                                            <div class="weui-flex__item">
                                                <a href="{{ route('mobile.brand.shop.index') }}" class="">
                                                    <div class="pic"><img src="{{ asset('static/image/mobile/nav_icon_xiuxianyule.png') }}"></div>
                                                    <div class="title">娱乐休闲</div>
                                                </a>
                                            </div>
                                            <div class="weui-flex__item">
                                                <a href="{{ route('mobile.brand.shop.index') }}" class="">
                                                    <div class="pic"><img src="{{ asset('static/image/mobile/nav_icon_meifa.png') }}"></div>
                                                    <div class="title">美容美发</div>
                                                </a>
                                            </div>
                                            <div class="weui-flex__item">
                                                <a href="{{ route('mobile.brand.shop.index') }}" class="">
                                                    <div class="pic"><img src="{{ asset('static/image/mobile/nav_icon_jiehun.png') }}"></div>
                                                    <div class="title">婚纱摄影</div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                        <div class="index-shop mtm">
                            <div class="hd">
                                <h3>为您推荐</h3>
                            </div>
                            <div class="bd">
                                <ul class="cl">
                                    @foreach ($index->shops as $value)
                                        <li>
                                            <a href="{{ route('mobile.brand.shop.show', $value->id) }}" title="{{ $value->name }}">
                                                <div class="s-pic"><img src="{{ uploadImage($value->upimage) }}"></div>
                                                <div class="s-info">
                                                    <div class="s-name">{{ $value->name }}</div>
                                                    <div class="s-address">地址：{{ $value->address }}</div>
                                                    <div class="s-discount">
                                                        <label>尊享标牌价：</label>
                                                        <span class="s-discount1"><em>￥</em><strong>{{ $value->discount }}</strong>折</span>
                                                        <span class="s-discount2"><del>原价靠边站</del></span>
                                                    </div>
                                                    @if ($value->offline || $value->appoint || $value->ordermeal || $value->ordercard)
                                                        <div class="s-support">
                                                            本店支持：
                                                            @if ($value->offline)
                                                                <span>线下付款</span>
                                                            @endif
                                                            @if ($value->appoint)
                                                                <span>预约订座</span>
                                                            @endif
                                                            @if ($value->ordermeal)
                                                                <span>在线点餐</span>
                                                            @endif
                                                            @if ($value->ordercard)
                                                                <span>店内办卡</span>
                                                            @endif
                                                        </div>
                                                    @endif
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
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.4.6&key=da8ac8316273d87097ab56f3cb828a3d&plugin=AMap.Autocomplete"></script>
    <script type="text/javascript" src="{{ asset('static/js/jquery.amap.js?'.time()) }}"></script>
    <script type="text/javascript">
        var Swiper1 = new Swiper ('.index-slide .swiper-container', {
            autoplay: 4000,
            loop:true,
            pagination: {
                el: '.swiper-pagination'
            }
        });
        var Swiper2 = new Swiper ('.index-nav .swiper-container', {
            autoplay: false,
            loop:false,
            pagination: {
                el: '.swiper-pagination'
            }
        });
        if(!$.cookie('location')){
            mMap.initMap('', function(data){
                $.cookie('location', JSON.stringify(data), 24*60*7);
                window.location.reload();
            });
        }
    </script>
@endsection