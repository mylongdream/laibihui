@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="">
            <div class="wp pbw">
                @if ($shop->banner)
                    <div class="shop-banner cl">
                        <img width="100%" height="150" border="0" src="{{ uploadImage($shop->banner) }}">
                    </div>
                @else
                    <div class="shop-top cl">
                        <div class="weui-media-box weui-media-box_appmsg">
                            <div class="weui-media-box__hd"><img class="weui-media-box__thumb radius" src="{{ uploadImage($shop->upimage) }}" alt=""></div>
                            <div class="weui-media-box__bd">
                                <dl class="cl">
                                    <dt>{{ $shop->name }}</dt>
                                    <dd>
                                        <p>地址：{{ $shop->address }}</p>
                                        <p>电话：{{ $shop->phone }}</p>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="shop-nav">
                    <div class="weui-flex">
                        <div class="weui-flex__item">
                            <a href="myburse.html" class="">
                                <div class="title">首页</div>
                            </a>
                        </div>
                        <div class="weui-flex__item">
                            <a href="myburse.html" class="">
                                <div class="title">商家详情</div>
                            </a>
                        </div>
                        <div class="weui-flex__item">
                            <a href="myburse.html" class="">
                                <div class="title">顾客点评</div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="shop-slide mtm">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @if ($shop->upphoto)
                                @foreach (unserialize($shop->upphoto) as $upphoto)
                                    <div class="swiper-slide">
                                        <a href="javascript:;"><img src="{{ uploadImage($upphoto, ['width'=>800,'height'=>800,'type'=>2]) }}"></a>
                                    </div>
                                @endforeach
                            @else
                                <div class="swiper-slide">
                                    <a href="javascript:;"><img src="{{ uploadImage($shop->upimage, ['width'=>800,'height'=>800,'type'=>2]) }}"></a>
                                </div>
                            @endif
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="shop-intro mtm">
                    <div class="hd">
                        <h3>商家详情</h3>
                    </div>
                    <div class="bd">
                        <div class="">{!! $shop->message !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('static/js/jquery.swiper.min.js') }}"></script>
    <script type="text/javascript">
        $(".shop-slide .swiper-container").swiper({pagination: ".swiper-pagination",autoplay: 4000,loop:true});
    </script>
@endsection