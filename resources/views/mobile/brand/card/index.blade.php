@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="weui-tab__panel">
            <div class="main-body">
                <div class="wp">
                    <div class="topheader">
                        <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                        <div class="nav">我要办卡</div>
                    </div>
                    <div class="">
                        <p>
                            <img width="100%" style="display: block" src="{{ asset('static/image/mobile/card1.jpg') }}" alt="">
                        </p>
                        <p>
                            <img width="100%" style="display: block" src="{{ asset('static/image/mobile/card2.jpg') }}" alt="">
                        </p>
                        <p>
                            <img width="100%" style="display: block" src="{{ asset('static/image/mobile/card4.jpg') }}" alt="">
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="weui-tabbar">
            @auth
            @if (auth()->user()->card)
            <a href="{{ route('mobile.user.promotion.index') }}" class="weui-tabbar__item tabbar-btn">
                <span>推荐办卡</span>
            </a>
            @else
                <a href="{{ route('mobile.brand.card.order') }}" class="weui-tabbar__item tabbar-btn">
                    <span>点击办卡</span>
                </a>
            @endif
            @else
                <a href="{{ route('mobile.login') }}" class="weui-tabbar__item tabbar-btn">
                    <span>登录后再办卡</span>
                </a>
                @endauth
        </div>
    </div>
@endsection

@section('script')
    @if (auth()->check() && auth()->user()->card)
    <script type="text/javascript">
        var html = '<div style="text-align:left;font-size: 18px;">';
        html += '<p>亲爱的顾客朋友：</p>';
        html += '<p style="text-indent:2em" class="mtw">您已经绑定知惠网商家联名卡，卡号为：{{ auth()->user()->card->number }}</p>';
        html += '<p style="text-indent:2em" class="mtw">您可以推荐朋友同事办卡，获得5元奖励佣金。<a href="{{ route('mobile.user.promotion.index') }}" style="color:#f00">立即推荐</a></p>';
        html += '</div>';
        weui.alert(html, {
            buttons: [{
                label: '我知道了'
            }],
            isAndroid: false
        });
    </script>
    @endif
@endsection
