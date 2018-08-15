@extends('layouts.common.app')

@section('content')
    <div class="wp pbw ptw">
        <div class="mall-slide">
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
        <div class="mod-shop mtw">
            <div class="hd">
                <h2>推荐兑换</h2>
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
                <h2>热门兑换</h2>
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
    </div>
    <script type="text/javascript">
        $(function() {
            $(".mall-slide").slide({ titCell:".hd ul", mainCell:".bd ul", effect:"leftLoop", vis:"auto", autoPlay:true, autoPage:true, trigger:"click" });
        });
    </script>
@endsection