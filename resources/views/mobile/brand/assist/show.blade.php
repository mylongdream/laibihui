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
                        <div class="assist_show_slide">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @if ($info->upphoto)
                                        @foreach (unserialize($info->upphoto) as $upphoto)
                                            <div class="swiper-slide">
                                                <a href="javascript:;"><img src="{{ uploadImage($upphoto) }}"></a>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="swiper-slide">
                                            <a href="javascript:;"><img src="{{ uploadImage($info->upimage) }}"></a>
                                        </div>
                                    @endif
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                        <div class="assist_show_base mtm">
                            <div class="p-info">
                                <div class="p-price z"><em>￥</em><strong>{{ $info->price }}</strong></div>
                                <div class="p-help y">需{{ $info->helpnum }}人助力,已领{{ $info->sellnum }}件,仅剩{{ $info->leftnum }}份</div>
                            </div>
                            <div class="p-name">{{ $info->name }}</div>
                            <div class="p-rule">
                                <h3>活动规则</h3>
                                <p>1· 邀请好友助力，达到助力人数即可享免单权利</p>
                                <p>2· 每个新用户仅可助力一次。同一微信公众号内</p>
                                <p>3· 若发现用户存在刷单、虚假用户助力等违规行为，平台有权判定助力失败</p>
                                <p>4· 邀请到足够好友帮助您助力成功之后，可前往我的免单里查看详情</p>
                                <p>5· 公众号可在法律法规允许范围内对本次活动规则解释并做适当修改</p>
                            </div>
                        </div>
                        <div class="assist_show_intro mtm">
                            <div class="hd">
                                <p>商品详情</p>
                            </div>
                            <div class="bd">
                                <div class="">{!! $info->message !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="weui-tabbar assist_show_bar">
            <a href="{{ route('mobile.brand.assist.index') }}" class="tabbar-more">
                <span>更多免单</span>
            </a>
            @if (auth()->check())
                <a href="{{ route('mobile.brand.assist.index') }}" class="weui-tabbar__item tabbar-btn">
                    <span>{{ $info->price ? '我要领' : '免费领' }}</span>
                </a>
            @else
                <a href="{{ route('mobile.brand.assist.order') }}" class="weui-tabbar__item tabbar-btn tabbar-btn_disabled">
                    <span>先登录</span>
                </a>
            @endif
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('static/js/swiper.min.js') }}"></script>
    <script type="text/javascript">
        var slide = new Swiper ('.assist_show_slide .swiper-container', {
            autoplay: 4000,
            loop:true,
            pagination: {
                el: '.swiper-pagination'
            }
        });
    </script>
@endsection