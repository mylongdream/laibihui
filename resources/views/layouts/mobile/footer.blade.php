<div class="weui-tabbar">
    <a href="{{ route('mobile.index') }}" class="weui-tabbar__item{!! isset($curmenu) && $curmenu == 'index' ? ' weui-bar__item_on' : '' !!}">
        @if (isset($curmenu) && $curmenu == 'index')
            <img class="weui-tabbar__icon" src="{{ asset('static/image/mobile/tabbar_home_selected.png') }}" alt="">
        @else
            <img class="weui-tabbar__icon" src="{{ asset('static/image/mobile/tabbar_home.png') }}" alt="">
        @endif
        <p class="weui-tabbar__label">推荐</p>
    </a>
    <a href="{{ route('mobile.brand.category.index') }}" class="weui-tabbar__item{!! isset($curmenu) && $curmenu == 'category' ? ' weui-bar__item_on' : '' !!}">
        @if (isset($curmenu) && $curmenu == 'category')
            <img class="weui-tabbar__icon" src="{{ asset('static/image/mobile/tabbar_category_selected.png') }}" alt="">
        @else
            <img class="weui-tabbar__icon" src="{{ asset('static/image/mobile/tabbar_category.png') }}" alt="">
        @endif
        <p class="weui-tabbar__label">分类</p>
    </a>
    <a href="{{ route('mobile.brand.farm.index') }}" class="weui-tabbar__item{!! isset($curmenu) && $curmenu == 'farm' ? ' weui-bar__item_on' : '' !!}">
        @if (isset($curmenu) && $curmenu == 'farm')
            <img class="weui-tabbar__icon" src="{{ asset('static/image/mobile/tabbar_like_selected.png') }}" alt="">
        @else
            <img class="weui-tabbar__icon" src="{{ asset('static/image/mobile/tabbar_like.png') }}" alt="">
        @endif
        <p class="weui-tabbar__label">农家乐</p>
    </a>
    <a href="{{ route('mobile.brand.comment.index') }}" class="weui-tabbar__item{!! isset($curmenu) && $curmenu == 'comment' ? ' weui-bar__item_on' : '' !!}">
        @if (isset($curmenu) && $curmenu == 'comment')
            <img class="weui-tabbar__icon" src="{{ asset('static/image/mobile/tabbar_comment_selected.png') }}" alt="">
        @else
            <img class="weui-tabbar__icon" src="{{ asset('static/image/mobile/tabbar_comment.png') }}" alt="">
        @endif
        <p class="weui-tabbar__label">点评</p>
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