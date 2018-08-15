<div class="shop_head">
    <div class="wp cl">
        @if ($shop->banner)
            <div class="shop_banner cl">
                <img width="100%" height="150" border="0" src="{{ uploadImage($shop->banner) }}">
            </div>
        @else
            <div class="shop_top cl">
                <div class="logo"><img width="120" height="120" border="0" src="{{ uploadImage($shop->upimage) }}"></div>
                <dl class="cl">
                    <dt>{{ $shop->name }}</dt>
                    <dd>
                    <p>地址：{{ $shop->address }}</p>
                    <p>电话：{{ $shop->phone }}</p>
                    </dd>
                </dl>
            </div>
        @endif
        <div class="shop_nav cl" id="nv">
            <ul>
                <li><a href="{{ route('brand.shop.show',$shop->id) }}">店铺首页</a></li>
            </ul>
            <div class="collection">
                @auth
                    @if (auth()->user()->collections()->where('shop_id', $shop->id)->count())
                        <a href="javascript:;" title="店铺已收藏" class="disabled">店铺已收藏</a>
                    @else
                        <a href="{{ route('brand.shop.collection',$shop->id) }}" title="收藏此店铺" class="ajaxget confirmbtn">收藏此店铺</a>
                    @endif
                @else
                    <a href="{{ route('brand.shop.collection',$shop->id) }}" title="收藏此店铺" class="ajaxget">收藏此店铺</a>
                @endauth
            </div>
        </div>
    </div>
</div>