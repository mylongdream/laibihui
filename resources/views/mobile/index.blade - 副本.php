@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="weui-tab__panel">
            <div class="main-body">
                <div class="wp">
                    <div class="pbw">
                        <div class="swiper-container index-slide">
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
                        <div class="index_nav mtm">
                            <div class="weui-flex">
                                <div class="weui-flex__item">
                                    <a href="{{ route('mobile.brand.category.index') }}" class="">
                                        <div class="pic"><img src="{{ asset('static/image/mobile/nav_icon_1.png') }}"></div>
                                        <div class="title">商家分类</div>
                                    </a>
                                </div>
                                <div class="weui-flex__item">
                                    <a href="{{ route('mobile.brand.shop.index') }}" class="">
                                        <div class="pic"><img src="{{ asset('static/image/mobile/nav_icon_2.png') }}"></div>
                                        <div class="title">折扣商家</div>
                                    </a>
                                </div>
                                <div class="weui-flex__item">
                                    <a href="{{ route('mobile.brand.card.index') }}" class="">
                                        <div class="pic"><img src="{{ asset('static/image/mobile/nav_icon_3.png') }}"></div>
                                        <div class="title">我要办卡</div>
                                    </a>
                                </div>
                                <div class="weui-flex__item">
                                    <a href="{{ route('mobile.brand.card.active') }}" class="">
                                        <div class="pic"><img src="{{ asset('static/image/mobile/nav_icon_4.png') }}"></div>
                                        <div class="title">快速开卡</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="index-shop mtm">
                            <div class="hd">
                                <h3>高性价比美食尽在知惠网</h3>
                            </div>
                            <div class="bd">
                                <ul class="cl">
                                    @foreach ($index->shops_food as $value)
                                        <li>
                                            <div class="s-pic"><a href="{{ route('mobile.brand.shop.show', $value->id) }}" title="{{ $value->name }}"><img src="{{ uploadImage($value->upimage) }}"></a></div>
                                            <div class="s-name"><a href="{{ route('mobile.brand.shop.show', $value->id) }}" title="{{ $value->name }}">{{ $value->name }}</a></div>
                                            <div class="s-discount">
                                                <span class="s-discount1"><em>￥</em><strong>{{ $value->discount }}</strong>折</span>
                                                <span class="s-discount2"><del>原价靠边站</del></span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="index-shop mtm">
                            <div class="hd">
                                <h3>最低折扣最好玩的娱乐场所</h3>
                            </div>
                            <div class="bd">
                                <ul class="cl">
                                    @foreach ($index->shops_yule as $value)
                                        <li>
                                            <div class="s-pic"><a href="{{ route('mobile.brand.shop.show', $value->id) }}" title="{{ $value->name }}"><img src="{{ uploadImage($value->upimage) }}"></a></div>
                                            <div class="s-name"><a href="{{ route('mobile.brand.shop.show', $value->id) }}" title="{{ $value->name }}">{{ $value->name }}</a></div>
                                            <div class="s-discount">
                                                <span class="s-discount1"><em>￥</em><strong>{{ $value->discount }}</strong>折</span>
                                                <span class="s-discount2"><del>原价靠边站</del></span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="index-shop mtm">
                            <div class="hd">
                                <h3>上知惠网最美就是你</h3>
                            </div>
                            <div class="bd">
                                <ul class="cl">
                                    @foreach ($index->shops_meizhuang as $value)
                                        <li>
                                            <div class="s-pic"><a href="{{ route('mobile.brand.shop.show', $value->id) }}" title="{{ $value->name }}"><img src="{{ uploadImage($value->upimage) }}"></a></div>
                                            <div class="s-name"><a href="{{ route('mobile.brand.shop.show', $value->id) }}" title="{{ $value->name }}">{{ $value->name }}</a></div>
                                            <div class="s-discount">
                                                <span class="s-discount1"><em>￥</em><strong>{{ $value->discount }}</strong>折</span>
                                                <span class="s-discount2"><del>原价靠边站</del></span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="index-shop mtm">
                            <div class="hd">
                                <h3>婚纱摄影就找知惠网</h3>
                            </div>
                            <div class="bd">
                                <ul class="cl">
                                    @foreach ($index->shops_hunqing as $value)
                                        <li>
                                            <div class="s-pic"><a href="{{ route('mobile.brand.shop.show', $value->id) }}" title="{{ $value->name }}"><img src="{{ uploadImage($value->upimage) }}"></a></div>
                                            <div class="s-name"><a href="{{ route('mobile.brand.shop.show', $value->id) }}" title="{{ $value->name }}">{{ $value->name }}</a></div>
                                            <div class="s-discount">
                                                <span class="s-discount1"><em>￥</em><strong>{{ $value->discount }}</strong>折</span>
                                                <span class="s-discount2"><del>原价靠边站</del></span>
                                            </div>
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
    <link href="{{ asset('static/css/swiper.min.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('static/js/jquery.swiper.min.js') }}"></script>
    <script type="text/javascript">
        var Swiper = new Swiper ('.swiper-container', {
            autoplay: 4000,
            loop:true,
            pagination:'.swiper-pagination'
        });
    </script>
@endsection