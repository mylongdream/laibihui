@extends('layouts.mobile.app')

@section('style')
    <link href="{{ asset('static/css/swiper.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <style>
        .assist_show_slide .swiper-slide a {width: 100%;padding: 50% 0;position: relative;overflow:hidden;display:block;}
        .assist_show_slide .swiper-slide img {width: 100%;height: 100%;display:block;position: absolute;top: 0;left: 0;}
    </style>
    <div class="weui-tab">
        <div class="weui-tab__panel">
            <div class="main-body">
                <div class="wp">
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
                    <div class="assist_show_intro mtm">
                        <div class="hd">
                            <h3>商品详情</h3>
                        </div>
                        <div class="bd">
                            <div class="">{!! $info->message !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="weui-tabbar">
            @if (auth()->check())
                <a href="{{ route('mobile.brand.assist.index') }}" class="weui-tabbar__item tabbar-btn">
                    <span>我要领</span>
                </a>
            @else
                <a href="{{ route('mobile.brand.assist.order') }}" class="weui-tabbar__item tabbar-btn">
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