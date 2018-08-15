<div id="toptb" class="cl">
    <div class="wp">
        @if ($setting['subwebstatus'])
        <div class="map">
            <span class="current">全国</span>
            <span class="change"><a href="{{ route('page.allcity') }}">【切换城市】</a></span>
        </div>
        @else
            <div class="welcome">
                <span><a href="{{ route('index') }}">您好，欢迎来到{{ $setting['sitename'] }}！</a></span>
            </div>
        @endif
        <div class="link">
            @auth
                <span>你好，{{auth()->user()->username}}</span>
                <a href="{{ route('user.index') }}">个人中心</a>
                <span class="pipe">|</span>
                <a href="{{ route('logout') }}" class="ajaxget" title="退出">退出</a>
                <span class="pipe">|</span>
                <a href="{{ route('brand.card.index') }}" title="我要办卡">我要办卡</a>
            @else
                <a href="{{ route('login', ['ReturnUrl' => request()->getUri()]) }}" title="请登录" class="">请登录</a>
                <span class="pipe">|</span>
                <a href="{{ route('register') }}" title="免费注册">免费注册</a>
                <span class="pipe">|</span>
                <a href="{{ route('brand.card.index') }}" title="我要办卡">我要办卡</a>
                <span class="pipe">|</span>
                <a href="{{ route('brand.card.active') }}" title="快速开卡">快速开卡</a>
            @endauth
            <span class="pipe">|</span>
            <span class="tel">咨询热线：{{ $setting['site_tel'] }}</span>
        </div>
    </div>
</div>
<div class="hdc cl">
    <div class="wp" style="position: relative">
        <h1 class="logo">
            <a title="{{ $setting['sitename'] }}" href="{{ route('index') }}"><img border="0" alt="{{ $setting['sitename'] }}" src="{{ asset('static/image/common/logo.png') }}"></a>
        </h1>
        <div class="search">
            <form class="searchform" method="get" action="{{ route('brand.shop.index') }}">
                <input id="searchkey" name="keyword" type="text" value="{{ request('keyword') }}">
                <button type="submit" onclick="if($('#searchkey').val()=='') return false;">搜索商家</button>
            </form>
        </div>
    </div>
</div>
<div class="nav_box cl">
    <div class="wp">
        <div class="nav_cat">
            <h3>商家分类</h3>
            @if (isset($showcat))
            <div class="cat_box">
                @foreach ($categorylist as $category)
                <div class="cat_item">
                    <div class="cat_name">{{ $category->name }}</div>
                    <div class="cat_sname">
                        <ul>
                            @foreach ($category->children as $scategory)
                            <li><a href="{{ route('brand.shop.index', ['catid' => $scategory->id]) }}">{{ $scategory->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="cat_shop">
                        <ul>
                            @foreach ($category->shoplist->take(15) as $cateshop)
                            <li>
                                <div class="s-pic"><a href="{{ route('brand.shop.show', $cateshop->id) }}" target="_blank" title="{{ $cateshop->name }}"><img src="{{ uploadImage($cateshop->upimage) }}"></a></div>
                                <div class="s-name"><a href="{{ route('brand.shop.show', $cateshop->id) }}" target="_blank" title="{{ $cateshop->name }}">{{ $cateshop->name }}</a></div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        <div class="nav_main cl" id="nv">
            <ul>
                <li>
                    <a href="{{ route('index') }}" title="首页">首页</a>
                </li>
                <li class="{{ isset($curmenu) && $curmenu == 'shop' ? 'on' : '' }}">
                    <a href="{{ route('brand.shop.index') }}" title="折扣商家">折扣商家</a>
                </li>
                <li class="{{ isset($curmenu) && $curmenu == 'farm' ? 'on' : '' }}">
                    <a href="{{ route('brand.farm.index') }}" title="农家乐">农家乐</a>
                </li>
            </ul>
        </div>
    </div>
</div>