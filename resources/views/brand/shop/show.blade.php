@extends('layouts.common.simple')

@section('content')
    <div class="shop-body">
        @include('brand.shop.header')
        <div class="wp">
            <div class="product-box cl mtm">
                <div class="product-picview">
                    <div id="preview" class="spec-preview cl">
                        <ul>
                            @if ($shop->upphoto)
                                @foreach (unserialize($shop->upphoto) as $upphoto)
                                    <li><img class="cloudzoom" data-cloudzoom = "zoomImage: '{{ uploadImage($upphoto, ['width'=>800,'height'=>800,'type'=>2]) }}'" src="{{ uploadImage($upphoto, ['width'=>350,'height'=>350,'type'=>2]) }}" width="350" height="350" /></li>
                                @endforeach
                            @else
                                <li><a href="{{ uploadImage($shop->upimage, ['width'=>800,'height'=>800,'type'=>2]) }}"><img class="cloudzoom" src="{{ uploadImage($shop->upimage, ['width'=>350,'height'=>350,'type'=>2]) }}" width="350" height="350" /></a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="spec-scroll cl">
                        <a class="prev" hidefocus="true" href="javascript:;">&lt;</a>
                        <div class="items cl">
                            <ul>
                                @if ($shop->upphoto)
                                    @foreach (unserialize($shop->upphoto) as $upphoto)
                                        <li><a hidefocus="true" href="javascript:;"><img src="{{ uploadImage($upphoto, ['width'=>50,'height'=>50,'type'=>2]) }}" width="50" height="50" /></a></li>
                                    @endforeach
                                @else
                                    <li><a hidefocus="true" href="javascript:;"><img src="{{ uploadImage($shop->upimage, ['width'=>50,'height'=>50,'type'=>2]) }}" width="50" height="50" /></a></li>
                                @endif
                            </ul>
                        </div>
                        <a class="next" hidefocus="true" href="javascript:;">&gt;</a>
                    </div>
                </div>
                <div class="product-intro">
                    <div class="p-name">
                        <h1>{{ $shop->name }}</h1>
                        <div class="p-ad"></div>
                    </div>
                    <div class="p-price">
                        <dl class="cl">
                            <dt>折扣：</dt>
                            <dd><em>￥</em><span>{{ $shop->discount }}</span>折</dd>
                        </dl>
                        <div class="qrcode trigger-hover">
                            <div class="qrcode-icon"></div>
                            <div class="qrcode-box">
                                <div style="text-align:center;font-size:16px;padding:20px 20px 0">微信扫一扫，轻松购享优惠</div>
                                <img src="{{ route('brand.shop.qrcode', $shop->id) }}" width="250" height="250" />
                            </div>
                        </div>
                    </div>
                    <div class="p-line">
                        <dl class="cl">
                            <dt>有效期：</dt>
                            <dd>
                                @if ($shop->started_at)
                                    @if ($shop->ended_at)
                                        {{ $shop->started_at->format('Y-m-d H:i') }} 至  {{ $shop->ended_at->format('Y-m-d H:i') }}
                                    @else
                                        {{ $shop->started_at->format('Y-m-d H:i') }} 至 长期
                                    @endif
                                @else
                                    @if ($shop->ended_at)
                                        截止至  {{ $shop->ended_at->format('Y-m-d H:i') }}
                                    @else
                                        长期
                                    @endif
                                @endif
                            </dd>
                        </dl>
                    </div>
                    <div class="p-line">
                        <dl class="cl">
                            <dt>地址：</dt>
                            <dd>{{ $shop->address }}</dd>
                        </dl>
                    </div>
                    <div class="p-line">
                        <dl class="cl">
                            <dt>电话：</dt>
                            <dd>{{ $shop->phone }}</dd>
                        </dl>
                    </div>
                    <div class="p-line">
                        <dl class="cl">
                            <dt>营业时间：</dt>
                            <dd>{{ $shop->openhours ? $shop->openhours : '暂无' }}</dd>
                        </dl>
                    </div>
                    <div class="p-btns cl">
                        <div class="product-appoint"><a href="{{ route('brand.shop.appoint', $shop->id) }}" class="openwindow" title="立即预约">立即预约</a></div>
                    </div>
                </div>
            </div>
            <div class="cl ct_shop mtm">
                <div class="side">
                    <div class="shop-info">
                        <div class="hd">
                            <span>店铺信息</span>
                        </div>
                        <div class="bd">
                            <dl>
                                <dt><img width="120" height="120" border="0" src="{{ uploadImage($shop->upimage) }}"></dt>
                                <dd>{{ $shop->name }}</dd>
                            </dl>
                            <table>
                                <tr>
                                    <th>分类： </th>
                                    <td>{{ $shop->category->name }}</td>
                                </tr>
                                <tr>
                                    <th>电话： </th>
                                    <td>{{ $shop->phone }}</td>
                                </tr>
                                <tr>
                                    <th>地址： </th>
                                    <td>{{ $shop->address }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="shop-sdlist mtm">
                        <div class="hd">
                            <span>最新店铺</span>
                        </div>
                        <div class="bd">
                            <ul>
                                @foreach ($newshops as $newshop)
                                    <li>
                                        <div class="s-pic"><a href="{{ route('brand.shop.show', $newshop->id) }}" target="_blank" title="{{ $newshop->name }}"><img width="120" height="120" border="0" src="{{ uploadImage($newshop->upimage) }}"></a></div>
                                        <div class="s-info">
                                            <div class="s-name"><a href="{{ route('brand.shop.show', $newshop->id) }}" target="_blank" title="{{ $newshop->name }}">{{ $newshop->name }}</a></div>
                                            <div class="s-address">{{ $newshop->address }}</div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="shop-sdlist mtm">
                        <div class="hd">
                            <span>热门店铺</span>
                        </div>
                        <div class="bd">
                            <ul>
                                @foreach ($hotshops as $hotshop)
                                    <li>
                                        <div class="s-pic"><a href="{{ route('brand.shop.show', $hotshop->id) }}" target="_blank" title="{{ $hotshop->name }}"><img width="120" height="120" border="0" src="{{ uploadImage($hotshop->upimage) }}"></a></div>
                                        <div class="s-info">
                                            <div class="s-name"><a href="{{ route('brand.shop.show', $hotshop->id) }}" target="_blank" title="{{ $hotshop->name }}">{{ $hotshop->name }}</a></div>
                                            <div class="s-address">{{ $hotshop->address }}</div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="main">
                    <div class="shop-tips">
                        <div class="shop-tips-text">
                            <p>亲爱的用户，本店已与知惠网签署合作协议，请您放心消费！</p>
                            <p>如遇商家不给折扣现象，请您当场拨打维权热线！</p>
                            <p>15162882535（小朱）或18862762696（小沈）会帮您及时解决哦~</p>
                        </div>
                    </div>
                    @if ($shop->pic_zizhi)
                        <div class="shop-zizhi mtm">
                            <div class="hd">
                                <span>店铺资质</span>
                            </div>
                            <div class="bd">
                                <ul>
                                    @foreach (unserialize($shop->pic_zizhi) as $upphoto)
                                        <li><img src="{{ uploadImage($upphoto) }}" alt=""></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    @if ($shop->maplng && $shop->maplat)
                        <div class="shop-map mtm">
                            <div class="hd">
                                <span>地图展示</span>
                            </div>
                            <div class="bd">
                                <div class="bd-amap"><div id="amapcontainer"></div></div>
                            </div>
                        </div>
                    @endif
                    <div class="shop-intro mtm">
                        <div class="hd">
                            <span>商家详情</span>
                        </div>
                        <div class="bd">
                            <div style="overflow: hidden">{!! $shop->message !!}</div>
                        </div>
                    </div>
                    <div class="shop-comment mtm">
                        <div class="hd">
                            <span>顾客点评</span>
                        </div>
                        <div class="bd">
                            <div class="shop-comment-form">
                                <form id="cpform" name="cpform" class="ajaxform" method="post" action="{{ route('brand.shop.comment', $shop->id) }}">
                                    {!! csrf_field() !!}
                                    <div class="comment-score">
                                        <dl>
                                            <dt>服务</dt>
                                            <dd><div id="service" class="score-star"></div></dd>
                                        </dl>
                                        <dl>
                                            <dt>环境</dt>
                                            <dd><div id="environment" class="score-star"></div></dd>
                                        </dl>
                                        <dl>
                                            <dt>性价比</dt>
                                            <dd><div id="priceratio" class="score-star"></div></dd>
                                        </dl>
                                    </div>
                                    <div class="comment-box">
                                        <div class="comment-area">
                                            <textarea data-maxlength="300" name="message" placeholder="消费完，不吐不快！别憋着，马上说出来吧！"></textarea>
                                        </div>
                                        @auth
                                        <div class="uploadbox comment-photo">
                                            <ul></ul>
                                        </div>
                                        @endauth
                                        <div class="comment-toolbar">
                                            @auth
                                            <a href="javascript:;" class="upbtn" id="upphoto">上传图片</a>
                                            @endauth
                                            <button class="submitbtn" name="commentsubmit" value="yes" type="submit">发表评论</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="shop-comment-list"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @if ($shop->maplng && $shop->maplat)
        <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.4.0&key=da8ac8316273d87097ab56f3cb828a3d&plugin=AMap.Autocomplete"></script>
        <script type="text/javascript">
            var map = new AMap.Map("amapcontainer", {
                resizeEnable: true,
                center: [{{ $shop->maplng }}, {{ $shop->maplat }}],//地图中心点
                zoom: 16 //地图显示的缩放级别
            });
            map.plugin(["AMap.ToolBar"], function() {
                map.addControl(new AMap.ToolBar());
            });
            new AMap.Marker({
                map: map,
                position: [{{ $shop->maplng }}, {{ $shop->maplat }}],
                icon: new AMap.Icon({
                    size: new AMap.Size(40, 50),  //图标大小
                    image: "{{ asset('static/image/common/way_btn.png') }}",
                    imageOffset: new AMap.Pixel(0, -60)
                })
            });
        </script>
    @endif
    <link href="{{ asset('static/js/lightbox2/css/lightbox.min.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('static/js/lightbox2/js/lightbox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jquery.CloudZoom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jquery.raty.js') }}"></script>
    <script type="text/javascript">
        CloudZoom.quickStart();
        $(".product-picview").slide({ titCell:".spec-scroll li", mainCell:".spec-preview ul", effect:"fold", delayTime:200});
        $(".spec-scroll").slide({ mainCell:"ul",delayTime:100,vis:5,effect:"left",autoPage:true,prevCell:".prev",nextCell:".next" });
        $(function(){
            $.fn.raty.defaults.path = "{{ asset('static/image/common') }}";
            $('#service').raty({
                scoreName: 'service',
                size     : 24,
                score: 3
            });
            $('#environment').raty({
                scoreName: 'environment',
                size     : 24,
                score: 3
            });
            $('#priceratio').raty({
                scoreName: 'priceratio',
                size     : 24,
                score: 3
            });
            $(".shop-comment-list").load("{{ route('brand.shop.comment', $shop->id) }}").on("click", ".pagination a", function(){
                var self = $(this);
                $(".shop-comment-list").load(self.attr("href"));
                return false;
            });
        });
    </script>
    @auth
    <script type="text/javascript" src="{{ asset('static/js/webuploader/webuploader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jquery.webuploader.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $("#upphoto").powerWebUpload({
                server: "{{ route('user.upload.image') }}",
                formData: {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                hiddenInputId: 'upphoto[]',
                fileNumLimit: 10,
                width: 120,
                height: 120
            });
        });
    </script>
    @endauth
@endsection