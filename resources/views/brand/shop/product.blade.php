@extends('layouts.common.simple')

@section('content')
    <div class="shop-body">
        @include('brand.shop.header')
        <div class="wp">
            <div class="shop-product mtm">
                <div class="hd">
                    <span>商家商品</span>
                </div>
                <div class="bd">
                    <ul class="cl">
                        @foreach ($products as $product)
                            <li>
                                <div class="s-pic"><a href="{{ route('brand.product.detail', $product->id) }}" target="_blank" title="{{ $product->name }}"><img src="{{ uploadImage($product->upimage) }}"></a></div>
                                <div class="s-name"><a href="{{ route('brand.product.detail', $product->id) }}" target="_blank" title="{{ $product->name }}">{{ $product->name }}</a></div>
                                <div class="s-discount">
                                    <span class="s-discount1"><em>￥</em><strong>{{ $product->shop->discount }}</strong>折</span>
                                    <span class="s-discount2"><del>原价靠边站</del></span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection