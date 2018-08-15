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
                        @if (count($commentlist))
                            @foreach ($commentlist as $comment)
                                <div class="weui-cells shop-comment mtm">
                                    <a class="weui-cell weui-cell_access" href="{{ route('mobile.brand.shop.show', $comment->shop->id) }}">
                                        <div class="weui-cell__bd">
                                            <p style="font-size: 14px">消费商户：{{ $comment->shop->name }}</p>
                                        </div>
                                        <div class="weui-cell__ft">
                                        </div>
                                    </a>
                                    <div class="weui-cell" style="align-items:initial;">
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
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="comment-nodata">
                                <span>暂无评论</span>
                            </div>
                        @endif
                        {!! $commentlist->links() !!}
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.mobile.footer')
    </div>
    <!-- Swiper -->
    <div class="swiper-container" id="origin-img">
        <div class="swiper-wrapper"></div>
        <div class="swiper-pagination"></div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('static/js/swiper.min.js') }}"></script>
    <script type="text/javascript">
        var swiperStatus = false;
        var lastTouchEnd = 0;
        var swiper = new Swiper('#origin-img',{
            zoom:true,
            width: window.innerWidth,
            virtual: true,
            spaceBetween:20,
            pagination: {
                el: '.swiper-pagination',
                type: 'fraction'
            },
            on:{
                click: function(){
                    $('#origin-img').fadeOut('fast');
                    this.virtual.slides.length = 0;
                    swiperStatus=false;
                }
            }
        });
        $(document).on("click", ".comment-photo li", function(){
            var clickIndex = $(this).index();
            $(this).parent().find("li").each(function(){
                swiper.virtual.appendSlide('<div class="swiper-zoom-container"><img src="'+$(this).data("img")+'" /></div>');
            });
            swiper.slideTo(clickIndex);
            $('#origin-img').fadeIn('fast');
            swiperStatus = true;
        });
        //切换图状态禁止页面缩放
        document.addEventListener('touchstart',function (event) {
            if(event.touches.length>1 && swiperStatus){
                event.preventDefault();
            }
        });
        document.addEventListener('touchend',function (event) {
            var now=(new Date()).getTime();
            if(now-lastTouchEnd<=300){
                event.preventDefault();
            }
            lastTouchEnd = now;
        },false);
        document.addEventListener('touchmove',function(e){
            if(swiperStatus){
                e.preventDefault();
            }
        });
    </script>
@endsection
