@extends('layouts.common.app')

@section('content')
    <div class="wp pbw">
        <div class="mod-maintop">
        <div class="mod-maintop-m">
            <div class="mod-maintop-l">
                <div class="mod-slide">
                    <div class="bd">
                        <ul>
                            <li><a href="javascript:;"><img src="{{ asset('static/image/temp/index-slide1.jpg') }}"></a></li>
                            <li><a href="javascript:;"><img src="{{ asset('static/image/temp/index-slide2.jpg') }}"></a></li>
                        </ul>
                    </div>
                    <div class="hd"><ul></ul></div>
                    <a class="prev" href="javascript:void(0)"></a>
                    <a class="next" href="javascript:void(0)"></a>
                </div>
                <div class="mod-slide-bi mtm">
                    <ul>
                        <li><a href="javascript:;"><img src="{{ asset('static/image/temp/index-slide1.jpg') }}"></a></li>
                        <li><a href="javascript:;"><img src="{{ asset('static/image/temp/index-slide2.jpg') }}"></a></li>
                    </ul>
                </div>
            </div>
            <div class="mod-maintop-r">
                <div class="mod-trade">
                    <div class="mod-trade-line">
                        <p>一张能在几百家店打折的卡</p>
                    </div>
                    <div class="mod-trade-card">
                        <img width="200" src="{{ asset('static/image/common/card.jpg') }}">
                    </div>
                    <div class="mod-trade-buy">
                        <a href="{{ route('brand.card.index') }}" title="我要办卡"><img width="170" src="{{ asset('static/image/common/buy.png') }}"></a>
                    </div>
                    <div class="mod-trade-wechat">
                        <img width="170" src="{{ asset('static/image/common/wechat.jpg') }}">
                        <p>微信扫我查折扣</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="mod-shop mtw">
            <div class="hd">
                <h2>高性价比美食尽在知惠网</h2>
            </div>
            <div class="bd">
                <ul class="cl">
                    @foreach ($index->shops_food as $value)
                        <li>
                            <div class="s-pic"><a href="{{ route('brand.shop.show', $value->id) }}" target="_blank" title="{{ $value->name }}"><img src="{{ uploadImage($value->upimage) }}"></a></div>
                            <div class="s-name"><a href="{{ route('brand.shop.show', $value->id) }}" target="_blank" title="{{ $value->name }}">{{ $value->name }}</a></div>
                            <div class="s-discount">
                                <span class="s-discount1"><em>￥</em><strong>{{ $value->discount }}</strong>折</span>
                                <span class="s-discount2"><del>原价靠边站</del></span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="mod-shop mtw">
            <div class="hd">
                <h2>最低折扣最好玩的娱乐场所</h2>
            </div>
            <div class="bd">
                <ul class="cl">
                    @foreach ($index->shops_yule as $value)
                        <li>
                            <div class="s-pic"><a href="{{ route('brand.shop.show', $value->id) }}" target="_blank" title="{{ $value->name }}"><img src="{{ uploadImage($value->upimage) }}"></a></div>
                            <div class="s-name"><a href="{{ route('brand.shop.show', $value->id) }}" target="_blank" title="{{ $value->name }}">{{ $value->name }}</a></div>
                            <div class="s-discount">
                                <span class="s-discount1"><em>￥</em><strong>{{ $value->discount }}</strong>折</span>
                                <span class="s-discount2"><del>原价靠边站</del></span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="mod-shop mtw">
            <div class="hd">
                <h2>上知惠网最美就是你</h2>
            </div>
            <div class="bd">
                <ul class="cl">
                    @foreach ($index->shops_meizhuang as $value)
                        <li>
                            <div class="s-pic"><a href="{{ route('brand.shop.show', $value->id) }}" target="_blank" title="{{ $value->name }}"><img src="{{ uploadImage($value->upimage) }}"></a></div>
                            <div class="s-name"><a href="{{ route('brand.shop.show', $value->id) }}" target="_blank" title="{{ $value->name }}">{{ $value->name }}</a></div>
                            <div class="s-discount">
                                <span class="s-discount1"><em>￥</em><strong>{{ $value->discount }}</strong>折</span>
                                <span class="s-discount2"><del>原价靠边站</del></span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="mod-shop mtw">
            <div class="hd">
                <h2>婚纱摄影就找知惠网</h2>
            </div>
            <div class="bd">
                <ul class="cl">
                    @foreach ($index->shops_hunqing as $value)
                        <li>
                            <div class="s-pic"><a href="{{ route('brand.shop.show', $value->id) }}" target="_blank" title="{{ $value->name }}"><img src="{{ uploadImage($value->upimage) }}"></a></div>
                            <div class="s-name"><a href="{{ route('brand.shop.show', $value->id) }}" target="_blank" title="{{ $value->name }}">{{ $value->name }}</a></div>
                            <div class="s-discount">
                                <span class="s-discount1"><em>￥</em><strong>{{ $value->discount }}</strong>折</span>
                                <span class="s-discount2"><del>原价靠边站</del></span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="mod-shop mtw">
            <div class="hd">
                <h2>鞋帽箱包</h2>
            </div>
            <div class="bd">
                <ul class="cl">
                    @foreach ($index->shops_xiemao as $value)
                        <li>
                            <div class="s-pic"><a href="{{ route('brand.shop.show', $value->id) }}" target="_blank" title="{{ $value->name }}"><img src="{{ uploadImage($value->upimage) }}"></a></div>
                            <div class="s-name"><a href="{{ route('brand.shop.show', $value->id) }}" target="_blank" title="{{ $value->name }}">{{ $value->name }}</a></div>
                            <div class="s-discount">
                                <span class="s-discount1"><em>￥</em><strong>{{ $value->discount }}</strong>折</span>
                                <span class="s-discount2"><del>原价靠边站</del></span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @if ($setting['linkstatus'])
        <div class="mod-friendlink mtw">
            <div class="hd">
                <h2>友情链接</h2>
            </div>
            <div class="bd">
                <ul class="cl">
                    @foreach ($index->friendlinks as $friendlink)
                        <li><a href="{{ $friendlink->url }}" target="_blank" title="{{ $friendlink->title }}">{{ $friendlink->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
    </div>
    <div class="mod-lift">
        <ul>
            <li class="lift-item"><a href="javascript:;">美食</a></li>
            <li class="lift-item"><a href="javascript:;">娱乐</a></li>
            <li class="lift-item"><a href="javascript:;"><span>美容化妆</span></a></li>
            <li class="lift-item"><a href="javascript:;"><span>婚纱摄影</span></a></li>
            <li class="lift-item"><a href="javascript:;"><span>鞋帽箱包</span></a></li>
            <li class="lift-top"><a href="javascript:;"><span>顶部<i></i></span></a></li>
        </ul>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            $(".mod-slide").slide({ titCell:".hd ul", mainCell:".bd ul", effect:"leftLoop", vis:"auto", autoPlay:true, autoPage:true, trigger:"click" });
            var offon = true;
            $(window).resize(function() {
                $(".mod-lift").css("bottom",($(window).height()-$(".mod-lift").height())/2);
            }).trigger("resize");
            $(window).scroll(function(){//滚动浏览器就会执行
                if(offon){
                    //获取滚动高度
                    var _top = $(window).scrollTop();
                    if(_top>200){
                        $('.hdc').addClass('fixhdc');
                    }else{
                        $('.hdc').removeClass('fixhdc');
                    }
                    if(_top>$('.mod-shop').first().offset().top - $(window).height() / 2){
                        $('.mod-lift').fadeIn();
                    }else{
                        $('.mod-lift').fadeOut();
                    }
                    $('.mod-shop').each(function(index){
                        if($(this).offset().top  <= _top + $(window).height() / 2){
                            $('.mod-lift ul li').eq(index).addClass('on').siblings().removeClass('on');
                            //return false;
                        }
                    });
                }
            });
            $(".mod-lift ul li.lift-item").click(function(){
                offon = false;
                var _index = $(this).index();
                $(this).addClass('on').siblings().removeClass('on');
                var _top = $('.mod-shop').eq(_index).offset().top;//获取上偏移值
                $('body,html').animate({scrollTop:_top},1000,function(){
                    offon = true;
                });
            });
            $(".mod-lift li.lift-top").click(function() {
                offon = false;
                $('body,html').animate({scrollTop:0},1000,function(){
                    offon = true;
                    $('.mod-lift').fadeOut();
                });
                $('.mod-lift ul li').removeClass("on");
            });
        });
    </script>
@endsection