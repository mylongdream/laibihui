
@extends('layouts.common.app')

@section('content')
    <div class="wp pbw ptm">
        <!--简介-->
        <div class="farm-show-inner">
            <div class="farm-show-top">
                <div class="title">
                    <h1>{{ $farm->name }}</h1>
                </div>
                <div class="share">
                    <ul>
                        <li class="list">
                            <a href="javascript:void(0);"><em class="ico ico_2"></em>收藏TA</a>
                        </li>
                        <li class="list">
                            <a href="javascript:void(0);"><em class="ico ico_3"></em>分享</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="farm-show-infor">
                <div class="farm-show-picview">
                    <div id="preview" class="spec-preview cl">
                        <ul>
                            @if ($farm->upphoto)
                                @foreach (unserialize($farm->upphoto) as $upphoto)
                                    <li><a hidefocus="true" href="javascript:;"><img src="{{ uploadImage($upphoto) }}" /></a></li>
                                @endforeach
                            @else
                                <li><a hidefocus="true" href="javascript:;"><img src="{{ uploadImage($farm->upimage) }}" /></a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="spec-scroll cl">
                        <a class="prev" hidefocus="true" href="javascript:;">&lt;</a>
                        <div class="items cl">
                            <ul>
                                @if ($farm->upphoto)
                                    @foreach (unserialize($farm->upphoto) as $upphoto)
                                        <li><a hidefocus="true" href="javascript:;"><img src="{{ uploadImage($upphoto) }}" /></a></li>
                                    @endforeach
                                @else
                                    <li><a hidefocus="true" href="javascript:;"><img src="{{ uploadImage($farm->upimage) }}" /></a></li>
                                @endif
                            </ul>
                        </div>
                        <a class="next" hidefocus="true" href="javascript:;">&gt;</a>
                    </div>
                </div>
                <div class="farm-show-detail">
                    <div class="addr">
                        <span class="text-gray">地址：</span>{{ $farm->address }}
                        <a href="javascript:void(0);" class="seemap" onclick="$('html,body').animate({scrollTop: $('#farmmap').offset().top}, 1000);">查看地图</a>
                    </div>
                    <div class="state"><span class="text-gray">人均消费：</span><b class="text-red" style="font-size: 24px">{{ $farm->price }}</b> 元</div>
                    <div class="state"><span class="text-gray">联系电话：</span>{{ $farm->phone }}</div>
                    <div class="mtm">
                        <span class="text-gray">适合人群：</span>
                        @foreach ($farm->attrs->where('type', 'group') as $key => $value)
                            <em class="bq">{{ config('farm.group.'.$value['attr_id']) }}</em>
                        @endforeach
                    </div>
                    <div class="mtm">
                        <span class="text-gray">能玩什么：</span>
                        @foreach ($farm->attrs->where('type', 'play') as $key => $value)
                        <em class="bq">{{ config('farm.play.'.$value['attr_id']) }}</em>
                        @endforeach
                    </div>
                    <div class="mtm">
                        <span class="text-gray">特色服务：</span>
                        @foreach ($farm->attrs->where('type', 'service') as $key => $value)
                            <em class="bq2">{{ config('farm.service.'.$value['attr_id']) }}</em>
                        @endforeach
                    </div>
                    <div class="appoint">
                        <a href="{{ route('brand.farm.order', $farm->id) }}" class="button" title="立即预约">立即预约</a>
                    </div>
                </div>
            </div>
        </div>
        <!--简介结束-->
        <div class="farm-show-box mtw">
            <div class="bd">
                <div style="font-size:16px;color:#f00;">好消息：为让大家玩得开心点，吃的舒心，本网站推出优惠措施如下</div>
                <div style="font-size:14px;margin-top:10px;">1、凡是本网站会员并持有来必惠商家联名卡的用户都可以享受该农家乐特定的折扣价并回赠相应积分到你账户内（实际折扣价以页面显示为准）。</div>
                <div style="font-size:14px;margin-top:10px;">2、如未持有来必惠商家联名卡的用户下单该农家乐亦可享受此优惠，但没有对应积分回赠到你账户，建议立即办理来必惠商家联名卡。</div>
            </div>
        </div>
        <div class="farm-show-box mtw" id="farmmap">
            <div class="hd">商家位置</div>
            <div class="bd">
                <div class="bd-amap"><div id="amapcontainer" style="width:100%;height:350px;"></div></div>
            </div>
        </div>
        <div class="farm-show-box mtw">
            <div class="hd">商家简介</div>
            <div class="bd">
                <div style="font-size:14px;overflow: hidden">{!! $farm->message !!}</div>
            </div>
        </div>
        <div class="farm-show-box mtw">
            <div class="hd">店铺环境</div>
            <div class="bd">
                <div style="font-size:14px;overflow: hidden">{!! $farm->environment !!}</div>
            </div>
        </div>
        <div class="farm-show-box mtw">
            <div class="hd">配套设施</div>
            <div class="bd">
                <div class="farm-show-support">
                    <ul>
                        @foreach ($farm->attrs->where('type', 'support') as $key => $value)
                            <li>
                                <img src="{{ asset('static/image/brand/farm/supportIcon'.$value['attr_id'].'.png') }}">
                                <p>{{ config('farm.support.'.$value['attr_id']) }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.4.0&key=da8ac8316273d87097ab56f3cb828a3d&plugin=AMap.Autocomplete"></script>
    <script type="text/javascript">
        var map = new AMap.Map("amapcontainer", {
            resizeEnable: true,
            center: [{{ $farm->maplng }}, {{ $farm->maplat }}],//地图中心点
            zoom: 16 //地图显示的缩放级别
        });
        map.plugin(["AMap.ToolBar"], function() {
            map.addControl(new AMap.ToolBar());
        });
        new AMap.Marker({
            map: map,
            position: [{{ $farm->maplng }}, {{ $farm->maplat }}],
            icon: new AMap.Icon({
                size: new AMap.Size(40, 50),  //图标大小
                image: "{{ asset('static/image/common/way_btn.png') }}",
                imageOffset: new AMap.Pixel(0, -60)
            })
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $(".farm-show-picview").slide({ titCell:".spec-scroll li", mainCell:".spec-preview ul", effect:"fold", delayTime:200});
            $(".spec-scroll").slide({ mainCell:"ul",delayTime:100,vis:3,effect:"top",pnLoop:false,autoPage:true,prevCell:".prev",nextCell:".next" });
        });
    </script>
@endsection