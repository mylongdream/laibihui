@extends('layouts.common.app')

@section('content')
    <div class="wp pbw ptm">
        <div class="farm-banner">
            <div class="farm-slide">
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
            <div class="farm-form">
                <form action="/ding/lists.html" method="post">
                    <select name='area_id' class="long">
                        <option>去哪玩？</option>
                        <option value="1" class="search_area">瑶海</option>
                        <option value="2" class="search_area">新站</option>
                        <option value="3" class="search_area">包河</option>
                        <option value="4" class="search_area">政务</option>
                        <option value="5" class="search_area">庐阳</option>
                        <option value="6" class="search_area">蜀山</option>
                        <option value="7" class="search_area">滨湖</option>
                        <option value="8" class="search_area">高新</option>
                        <option value="9" class="search_area">肥东</option>
                        <option value="10" class="search_area">肥西</option>
                        <option value="12" class="search_area">长丰</option>
                    </select>
                    <select name='cate_id' class="long">
                        <option>玩什么？</option>
                        @foreach (config('farm.play') as $key => $value)
                        <option value="{{ $key }}" class="search_cate">{{ $value }}</option>
                        @endforeach
                    </select>
                    <select name='group_id' class="long">
                        <option>适合人群？</option>
                        @foreach (config('farm.group') as $key => $value)
                        <option value="{{ $key }}" class="search_group">{{ $value }}</option>
                        @endforeach
                    </select>
                    <select name='price' class="long">
                        <option>价格区间？</option>
                        <option value="200" class="search_price">200以下</option>
                        <option value="200" val="300" class="search_price">200-300</option>
                        <option value="300" val="500" class="search_price">300-500</option>
                        <option value="500" class="search_price">500以上</option>
                    </select>
                    <input class="btn" type="button" id="search" value="立刻查询" />
                </form>
                <div class="style">
                    <p>您还可以选择以下就餐类型：</p><a href="#" class="">朋友聚会</a><a href="#" class="on">家庭游玩</a><a href="#" class="">公司组团</a></div>
            </div>
        </div>
        <!--功能-->
        <div class="farm-fuct">
            <ul>
                @foreach (config('farm.play') as $key => $value)
                <li class="item">
                    <a href="{{ route('brand.farm.lists', ['play' => $key]) }}"><img src="{{ asset('static/image/brand/farm/fuct'.$key.'.png') }}" /><p>{{ $value }}</p></a>
                </li>
                @endforeach
                <li class="item">
                    <a href="{{ route('brand.farm.lists') }}"><img src="{{ asset('static/image/brand/farm/fuct8.png') }}" /><p>更多</p></a>
                </li>
            </ul>
        </div>
        <div class="farm-group">
            <div class="hd farm_title">
                <em></em><h2>适合群体</h2><img src="{{ asset('static/image/brand/farm/titleImg1.png') }}" />
            </div>
            <div class="bd">
                <ul class="cl">
                    @foreach (config('farm.group') as $key => $value)
                    <li class="item {{ $loop->iteration == 1 ? 'on' : '' }}"><a href="{{ route('brand.farm.lists', ['group' => $key]) }}"><img src="{{ asset('static/image/brand/farm/group'.$key.'.jpg') }}" /></a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="farm-recommend">
            <div class="hd farm_title">
                <em></em><h2>当季热门农家乐</h2><img src="{{ asset('static/image/brand/farm/titleImg2.png') }}" />
            </div>
            <div class="bd">
                <ul class="cl">
                    @foreach ($farm->recommend as $value)
                    <li class="trigger-hover">
                        <div class="f-pic"><a href="{{ route('brand.farm.show', $value->id) }}"><img src="{{ uploadImage($value->upimage) }}" width="285" height="200" /><span class="f-tag">热门农家乐</span></a></div>
                        <div class="f-info">
                            <div class="f-title"><a href="javascript:;"><b>[合肥]</b> {{ $value->name }}</a></div>
                            <div class="f-address">地址：{{ $value->address }}</div>
                            <div class="f-price">￥<span>{{ $value->price }}</span>起</div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="farm-interest">
            <div class="hd farm_title">
                <em></em><h2>优选农家乐</h2><img src="{{ asset('static/image/brand/farm/titleImg3.png') }}" />
            </div>
            <div class="bd">
                <ul class="cl">
                    @foreach ($farm->interest as $value)
                    <li class="trigger-hover">
                        <div class="f-pic"><a href="{{ route('brand.farm.show', $value->id) }}"><img src="{{ uploadImage($value->upimage) }}" width="285" height="200" /></a></div>
                        <div class="f-info">
                            <div class="f-title"><a href="javascript:;"><b>[合肥]</b> {{ $value->name }}</a></div>
                            <div class="f-address">地址：{{ $value->address }}</div>
                            <div class="f-price">￥<span>{{ $value->price }}</span>起</div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            $(".farm-slide").slide({ titCell:".hd ul", mainCell:".bd ul", effect:"leftLoop", vis:"auto", autoPlay:true, autoPage:true, trigger:"click" });
            $(".farm-group .item").hover(function(){
                $(".farm-group .item").removeClass("on");
                $(this).addClass("on");
            });
        });
    </script>
@endsection