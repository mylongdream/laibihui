@extends('layouts.common.app')

@section('content')
    <div class="wp">
        <div class="filter-sort">
            <div class="mtm">
                <dl class="cl">
                    <dt>商家分类</dt>
                    <dd>
                        <a href="{{ route('brand.shop.index', ['discount' => request('discount'), 'keyword' => request('keyword'), 'orderby' => request('orderby')]) }}" {!! request('catid') ? '' : 'class="a"' !!}>不限</a>
                        @foreach ($shopcates as $value)
                            <a href="{{ route('brand.shop.index', ['catid' => $value->id, 'discount' => request('discount'), 'keyword' => request('keyword'), 'orderby' => request('orderby')]) }}" {!! $value->id == request('catid') ? 'class="a"' : '' !!}><span>{{ $value->name }}</span></a>
                        @endforeach
                    </dd>
                </dl>
                <dl class="cl">
                    <dt>商家折扣</dt>
                    <dd>
                        <a href="{{ route('brand.shop.index', ['catid' => request('catid'), 'keyword' => request('keyword'), 'orderby' => request('orderby')]) }}" {!! request('discount') ? '' : 'class="a"' !!}>不限</a>
                        <a href="{{ route('brand.shop.index', ['discount' => 1, 'catid' => request('catid'), 'keyword' => request('keyword'), 'orderby' => request('orderby')]) }}" {!! request('discount') == 1 ? 'class="a"' : '' !!}><span>9折以上</span></a>
                        <a href="{{ route('brand.shop.index', ['discount' => 2, 'catid' => request('catid'), 'keyword' => request('keyword'), 'orderby' => request('orderby')]) }}" {!! request('discount') == 2 ? 'class="a"' : '' !!}><span>8折-9折</span></a>
                        <a href="{{ route('brand.shop.index', ['discount' => 3, 'catid' => request('catid'), 'keyword' => request('keyword'), 'orderby' => request('orderby')]) }}" {!! request('discount') == 3 ? 'class="a"' : '' !!}><span>7折-8折</span></a>
                        <a href="{{ route('brand.shop.index', ['discount' => 4, 'catid' => request('catid'), 'keyword' => request('keyword'), 'orderby' => request('orderby')]) }}" {!! request('discount') == 4 ? 'class="a"' : '' !!}><span>6折-7折</span></a>
                        <a href="{{ route('brand.shop.index', ['discount' => 5, 'catid' => request('catid'), 'keyword' => request('keyword'), 'orderby' => request('orderby')]) }}" {!! request('discount') == 5 ? 'class="a"' : '' !!}><span>5折-6折</span></a>
                        <a href="{{ route('brand.shop.index', ['discount' => 6, 'catid' => request('catid'), 'keyword' => request('keyword'), 'orderby' => request('orderby')]) }}" {!! request('discount') == 6 ? 'class="a"' : '' !!}><span>5折以下</span></a>
                    </dd>
                </dl>
                <dl class="f-order cl">
                    <dt>排序</dt>
                    <dd>
                        <a href="{{ route('brand.shop.index', ['discount' => request('discount'), 'catid' => request('catid'), 'keyword' => request('keyword')]) }}" {!! request('orderby') ? '' : 'class="a"' !!}><span>默认</span></a>
                        <a href="{{ route('brand.shop.index', ['orderby' => 'discount', 'discount' => request('discount'), 'catid' => request('catid'), 'keyword' => request('keyword')]) }}" {!! request('orderby') == 'discount' ? 'class="a"' : '' !!}><span>折扣</span></a>
                        <a href="{{ route('brand.shop.index', ['orderby' => 'viewnum', 'discount' => request('discount'), 'catid' => request('catid'), 'keyword' => request('keyword')]) }}" {!! request('orderby') == 'viewnum' ? 'class="a"' : '' !!}><span>人气</span></a>
                        <a href="{{ route('brand.shop.index', ['orderby' => 'addtime', 'discount' => request('discount'), 'catid' => request('catid'), 'keyword' => request('keyword')]) }}" {!! request('orderby') == 'addtime' ? 'class="a"' : '' !!}><span>入驻时间</span></a>
                    </dd>
                </dl>
            </div>
        </div>
        @if (count($shoplist))
            @if (request('style') == 'grid')
                <div class="shop-grid mtm">
                    <ul class="cl">
                        @foreach ($shoplist as $shop)
                            <li class="trigger-hover">
                                <div class="s-box">
                                    <div class="s-name"><a href="{{ route('brand.shop.show', $shop->id) }}" target="_blank" title="{{ $shop->name }}">{{ $shop->name }}</a></div>
                                    <div class="s-pic"><a href="{{ route('brand.shop.show', $shop->id) }}" target="_blank" title="{{ $shop->name }}"><img src="{{ uploadImage($shop->upimage) }}"></a></div>
                                    <div class="s-discount">
                                        <span class="s-discount1"><em>￥</em><strong>{{ $shop->discount }}</strong>折</span>
                                        <span class="s-discount2"><del>原价靠边站</del></span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="shop-list mtm">
                    <ul class="cl">
                        @foreach ($shoplist as $shop)
                            <li class="trigger-hover">
                                <div class="s-pic"><a href="{{ route('brand.shop.show', $shop->id) }}" target="_blank" title="{{ $shop->name }}"><img src="{{ uploadImage($shop->upimage) }}"></a></div>
                                <div class="s-box">
                                    <div class="s-name"><a href="{{ route('brand.shop.show', $shop->id) }}" target="_blank" title="{{ $shop->name }}">{{ $shop->name }}</a></div>
                                    <div class="s-info">地址：{{ $shop->address }}</div>
                                    <div class="s-info">电话：{{ $shop->phone }}</div>
                                    <div class="s-discount">
                                        <span class="s-discount1"><em>￥</em><strong>{{ $shop->discount }}</strong>折</span>
                                        <span class="s-discount2"><del>原价靠边站</del></span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!! $shoplist->appends(['catid' => request('catid')])->appends(['discount' => request('discount')])->appends(['keyword' => request('keyword')])->appends(['orderby' => request('orderby')])->links() !!}
        @else
            <div class="shop-nodata mtm">
                <p>暂无该折扣的优惠信息！正在努力为您带来更多优惠！</p>
            </div>
        @endif
    </div>
@endsection