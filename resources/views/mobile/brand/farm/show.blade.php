@extends('layouts.mobile.app')

@section('style')
    <link href="{{ asset('static/css/swiper.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="weui-tab">
        <div class="">
            <div class="wp pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">店铺详情</div>
                    <div class="home"><a href="{{ route('mobile.index') }}"><span></span></a></div>
                </div>
                @if ($farm->banner)
                    <div class="shop-banner cl">
                        <img width="100%" height="150" border="0" src="{{ uploadImage($farm->banner) }}">
                    </div>
                @else
                    <div class="shop-top cl">
                        <div class="weui-media-box weui-media-box_appmsg">
                            <div class="weui-media-box__hd"><img class="weui-media-box__thumb radius" src="{{ uploadImage($farm->upimage) }}" alt=""></div>
                            <div class="weui-media-box__bd">
                                <div class="name">{{ $farm->name }}</div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="shop-slide mtm">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @if ($farm->upphoto)
                                @foreach (unserialize($farm->upphoto) as $upphoto)
                                    <div class="swiper-slide">
                                        <a href="javascript:;"><img src="{{ uploadImage($upphoto) }}"></a>
                                    </div>
                                @endforeach
                            @else
                                <div class="swiper-slide">
                                    <a href="javascript:;"><img src="{{ uploadImage($farm->upimage) }}"></a>
                                </div>
                            @endif
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="weui-cells mtm">
                    <div class="weui-cell shop-discount">
                        <div class="weui-cell__bd">
                            <p>尊享标牌价：<span><strong>{{ $farm->price }}</strong>元</span></p>
                        </div>
                        <div class="weui-cell__ft">
                            <a class="weui-btn weui-btn_primary" href="{{ route('mobile.brand.farm.order', ['id' => $farm->id]) }}">立即预约</a>
                        </div>
                    </div>
                </div>
                <div class="weui-cells mtm">
                    <a class="weui-cell weui-cell_access" href="{{ route('mobile.brand.farm.map', ['id' => $farm->id]) }}">
                        <div class="weui-cell__hd">
                            <img src="{{ asset('static/image/mobile/shop-address.png') }}" alt="" style="width:20px;margin-right:5px;display:block">
                        </div>
                        <div class="weui-cell__bd">
                            <p style="font-size: 14px">{{ $farm->address }}</p>
                        </div>
                        <span class="weui-cell__ft"></span>
                    </a>
                    @if ($farm->phone)
                        <a class="weui-cell weui-cell_access" href="tel:{{ $farm->phone }}">
                            <div class="weui-cell__hd">
                                <img src="{{ asset('static/image/mobile/shop-phone.png') }}" alt="" style="width:20px;margin-right:5px;display:block">
                            </div>
                            <div class="weui-cell__bd">
                                <p style="font-size: 14px">{{ $farm->phone }}</p>
                            </div>
                            <span class="weui-cell__ft"></span>
                        </a>
                    @endif
                </div>
                <div class="shop-intro mtm">
                    <div class="hd">
                        <h3>商家详情</h3>
                    </div>
                    <div class="bd">
                        <div class="">{!! $farm->message !!}</div>
                    </div>
                </div>
                <div class="weui-cells shop-comment mtm">
                    <a class="weui-cell weui-cell_access" href="{{ route('mobile.brand.farm.comment', ['id' => $farm->id]) }}">
                        <div class="weui-cell__bd">
                            <p style="font-size: 14px">顾客点评</p>
                        </div>
                        <span class="weui-cell__ft"></span>
                    </a>
                    @if (count($commentlist))
                        @foreach ($commentlist as $comment)
                            <a class="weui-cell weui-cell_access" style="align-items:initial;" href="{{ route('mobile.brand.farm.comment', ['id' => $farm->id]) }}">
                                <div class="weui-cell__hd">
                                    <img src="{{ $comment->user && $comment->user->headimgurl ? uploadImage($comment->user->headimgurl) : asset('static/image/common/getheadimg.jpg') }}" class="radius" style="width:50px;height:50px;margin-right:10px;display:block">
                                </div>
                                <div class="weui-cell__bd">
                                    <p style="font-size: 12px;color: #999">{{ $comment->user ? $comment->user->username : '匿名' }}</p>
                                    <p style="font-size: 12px;color: #999">{{ $comment->created_at->format('Y-m-d H:i') }}</p>
                                    <div class="comment-score">
                                        <span>服务：{{ $comment->service }}分</span>
                                        <span>环境：{{ $comment->environment }}分</span>
                                        <span>性价比：{{ $comment->priceratio }}分</span>
                                    </div>
                                    <p style="word-wrap:break-word;word-break:break-all; font-size: 14px;margin-top: 5px">{{ $comment->message }}</p>
                                    @if ($comment->upphoto)
                                        <div class="comment-photo">
                                            <ul>
                                                @foreach (unserialize($comment->upphoto) as $upphoto)
                                                    <li data-img="{{ uploadImage($upphoto) }}">
                                                        <img src="{{ uploadImage($upphoto, ['width'=>70,'height'=>70,'type'=>1]) }}" width="70" height="70" />
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    @else
                        <div class="comment-nodata">
                            <span>暂无评论</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('static/js/swiper.min.js') }}"></script>
    <script type="text/javascript">
        var slide = new Swiper ('.shop-slide .swiper-container', {
            autoplay: 4000,
            loop:true,
            pagination: {
                el: '.swiper-pagination'
            }
        });
        $(document).on("click", ".gologin", function(){
            weui.alert('你尚未登录，无法收藏', {
                buttons: [{
                    label: '前去登录',
                    onClick: function(){
                        window.location.href="{{ route('mobile.login') }}";
                    }
                }],
                isAndroid: false
            });
            return false;
        });
    </script>
@endsection