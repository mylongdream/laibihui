<div class="weui-tabbar">
    <a href="{{ route('mobile.index') }}" class="weui-tabbar__item{!! isset($curmenu) && $curmenu == 'index' ? ' weui-bar__item_on' : '' !!}">
        @if (isset($curmenu) && $curmenu == 'index')
            <img class="weui-tabbar__icon" src="{{ asset('static/image/mobile/tabbar_home_selected.png') }}" alt="">
        @else
            <img class="weui-tabbar__icon" src="{{ asset('static/image/mobile/tabbar_home.png') }}" alt="">
        @endif
        <p class="weui-tabbar__label">首页</p>
    </a>
    <a href="{{ route('mobile.brand.recommend.index') }}" class="weui-tabbar__item{!! isset($curmenu) && $curmenu == 'recommend' ? ' weui-bar__item_on' : '' !!}">
        @if (isset($curmenu) && $curmenu == 'recommend')
            <img class="weui-tabbar__icon" src="{{ asset('static/image/mobile/tabbar_like_selected.png') }}" alt="">
        @else
            <img class="weui-tabbar__icon" src="{{ asset('static/image/mobile/tabbar_like.png') }}" alt="">
        @endif
        <p class="weui-tabbar__label">推荐</p>
    </a>
    <a href="{{ route('mobile.user.index') }}" class="weui-tabbar__item{!! isset($curmenu) && $curmenu == 'user' ? ' weui-bar__item_on' : '' !!}">
        @if (isset($curmenu) && $curmenu == 'user')
            <img class="weui-tabbar__icon" src="{{ asset('static/image/mobile/tabbar_user_selected.png') }}" alt="">
        @else
            <img class="weui-tabbar__icon" src="{{ asset('static/image/mobile/tabbar_user.png') }}" alt="">
        @endif
        <p class="weui-tabbar__label">我的</p>
    </a>
</div>