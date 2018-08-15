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
                        <option value="1" class="search_cate">会议</option>
                        <option value="2" class="search_cate">采摘</option>
                        <option value="3" class="search_cate">垂钓</option>
                        <option value="4" class="search_cate">烧烤</option>
                        <option value="5" class="search_cate">登山</option>
                        <option value="6" class="search_cate">温泉</option>
                        <option value="7" class="search_cate">赏花</option>
                    </select>
                    <select name='group_id' class="long">
                        <option>适合人群？</option>
                        <option value="1" class="search_group" val="ss">朋友聚会</option>
                        <option value="2" class="search_group" val="ss">学生活动</option>
                        <option value="3" class="search_group" val="ss">老年养生</option>
                        <option value="4" class="search_group" val="ss">亲子游玩</option>
                        <option value="5" class="search_group" val="ss">家庭游玩</option>
                        <option value="6" class="search_group" val="ss">公司组团</option>
                        <option value="7" class="search_group" val="ss">情侣游玩</option>
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
                <li class="item">
                    <a href="javascript:;">
                        <img src="{{ asset('static/image/brand/farm/fuct1.png') }}" />
                        <p>会议</p>
                    </a>
                </li>
                <li class="item">
                    <a href="javascript:;">
                        <img src="{{ asset('static/image/brand/farm/fuct2.png') }}" />
                        <p>采摘</p>
                    </a>
                </li>
                <li class="item">
                    <a href="javascript:;">
                        <img src="{{ asset('static/image/brand/farm/fuct3.png') }}" />
                        <p>垂钓</p>
                    </a>
                </li>
                <li class="item">
                    <a href="javascript:;">
                        <img src="{{ asset('static/image/brand/farm/fuct4.png') }}" />
                        <p>烧烤</p>
                    </a>
                </li>
                <li class="item">
                    <a href="javascript:;">
                        <img src="{{ asset('static/image/brand/farm/fuct5.png') }}" />
                        <p>登山</p>
                    </a>
                </li>
                <li class="item">
                    <a href="javascript:;">
                        <img src="{{ asset('static/image/brand/farm/fuct6.png') }}" />
                        <p>温泉</p>
                    </a>
                </li>
                <li class="item">
                    <a href="javascript:;">
                        <img src="{{ asset('static/image/brand/farm/fuct7.png') }}" />
                        <p>赏花</p>
                    </a>
                </li>
                <li class="item">
                    <a href="javascript:;">
                        <img src="{{ asset('static/image/brand/farm/fuct8.png') }}" />
                        <p>更多</p>
                    </a>
                </li>
            </ul>
        </div>
        <div class="farm-group">
            <div class="hd farm_title">
                <em></em><h2>适合群体</h2><img src="{{ asset('static/image/brand/farm/titleImg1.png') }}" />
            </div>
            <div class="bd">
                <ul class="cl">
                    <li class="item on"><a href="javascript:;"><img src="{{ asset('static/image/brand/farm/group1.jpg') }}" /></a></li>
                    <li class="item "><a href="javascript:;"><img src="{{ asset('static/image/brand/farm/group2.jpg') }}" /></a></li>
                    <li class="item "><a href="javascript:;"><img src="{{ asset('static/image/brand/farm/group3.jpg') }}" /></a></li>
                    <li class="item "><a href="javascript:;"><img src="{{ asset('static/image/brand/farm/group4.jpg') }}" /></a></li>
                    <li class="item "><a href="javascript:;"><img src="{{ asset('static/image/brand/farm/group5.jpg') }}" /></a></li>
                    <li class="item "><a href="javascript:;"><img src="{{ asset('static/image/brand/farm/group6.jpg') }}" /></a></li>
                    <li class="item "><a href="javascript:;"><img src="{{ asset('static/image/brand/farm/group7.jpg') }}" /></a></li>
                </ul>
            </div>
        </div>
        <div class="farm-recommend">
            <div class="hd farm_title">
                <em></em><h2>当季热门农家乐</h2><img src="{{ asset('static/image/brand/farm/titleImg2.png') }}" />
            </div>
            <div class="bd">
                <ul class="cl">
                    <li class="trigger-hover">
                        <div class="f-pic"><a href="#"><img src="http://www.baocms.cn/attachs/2016/10/27/thumb_58116b2b3d9f4.jpg" width="285" height="200" /><span class="f-tag">热门农家乐</span></a></div>
                        <div class="f-info">
                            <div class="f-title"><a href="javascript:;"><b>[合肥]</b> 百家宴</a></div>
                            <div class="f-address">地址：合肥蜀山区华润五彩城合肥蜀山区华润五彩城</div>
                            <div class="f-price">￥<span>500</span>起</div>
                        </div>
                    </li>
                    <li class="trigger-hover">
                        <div class="f-pic"><a href="#"><img src="http://www.baocms.cn/attachs/2016/10/27/thumb_58116b2b3d9f4.jpg" width="285" height="200" /><span class="f-tag">热门农家乐</span></a></div>
                        <div class="f-info">
                            <div class="f-title"><a href="javascript:;"><b>[合肥]</b> 百家宴</a></div>
                            <div class="f-address">地址：合肥蜀山区华润五彩城合肥蜀山区华润五彩城</div>
                            <div class="f-price">￥<span>500</span>起</div>
                        </div>
                    </li>
                    <li class="trigger-hover">
                        <div class="f-pic"><a href="#"><img src="http://www.baocms.cn/attachs/2016/10/27/thumb_58116b2b3d9f4.jpg" width="285" height="200" /><span class="f-tag">热门农家乐</span></a></div>
                        <div class="f-info">
                            <div class="f-title"><a href="javascript:;"><b>[合肥]</b> 百家宴</a></div>
                            <div class="f-address">地址：合肥蜀山区华润五彩城合肥蜀山区华润五彩城</div>
                            <div class="f-price">￥<span>500</span>起</div>
                        </div>
                    </li>
                    <li class="trigger-hover">
                        <div class="f-pic"><a href="#"><img src="http://www.baocms.cn/attachs/2016/10/27/thumb_58116b2b3d9f4.jpg" width="285" height="200" /><span class="f-tag">热门农家乐</span></a></div>
                        <div class="f-info">
                            <div class="f-title"><a href="javascript:;"><b>[合肥]</b> 百家宴</a></div>
                            <div class="f-address">地址：合肥蜀山区华润五彩城合肥蜀山区华润五彩城</div>
                            <div class="f-price">￥<span>500</span>起</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="farm-interest">
            <div class="hd farm_title">
                <em></em><h2>优选农家乐</h2><img src="{{ asset('static/image/brand/farm/titleImg3.png') }}" />
            </div>
            <div class="bd">
                <ul class="cl">
                    <li class="trigger-hover">
                        <div class="f-pic"><a href="#"><img src="http://www.baocms.cn/attachs/2016/10/27/thumb_58116b2b3d9f4.jpg" width="285" height="200" /></a></div>
                        <div class="f-info">
                            <div class="f-title"><a href="javascript:;"><b>[合肥]</b> 百家宴</a></div>
                            <div class="f-address">地址：合肥蜀山区华润五彩城合肥蜀山区华润五彩城</div>
                            <div class="f-price">￥<span>500</span>起</div>
                        </div>
                    </li>
                    <li class="trigger-hover">
                        <div class="f-pic"><a href="#"><img src="http://www.baocms.cn/attachs/2016/10/27/thumb_58116b2b3d9f4.jpg" width="285" height="200" /></a></div>
                        <div class="f-info">
                            <div class="f-title"><a href="javascript:;"><b>[合肥]</b> 百家宴</a></div>
                            <div class="f-address">地址：合肥蜀山区华润五彩城合肥蜀山区华润五彩城</div>
                            <div class="f-price">￥<span>500</span>起</div>
                        </div>
                    </li>
                    <li class="trigger-hover">
                        <div class="f-pic"><a href="#"><img src="http://www.baocms.cn/attachs/2016/10/27/thumb_58116b2b3d9f4.jpg" width="285" height="200" /></a></div>
                        <div class="f-info">
                            <div class="f-title"><a href="javascript:;"><b>[合肥]</b> 百家宴</a></div>
                            <div class="f-address">地址：合肥蜀山区华润五彩城合肥蜀山区华润五彩城</div>
                            <div class="f-price">￥<span>500</span>起</div>
                        </div>
                    </li>
                    <li class="trigger-hover">
                        <div class="f-pic"><a href="#"><img src="http://www.baocms.cn/attachs/2016/10/27/thumb_58116b2b3d9f4.jpg" width="285" height="200" /></a></div>
                        <div class="f-info">
                            <div class="f-title"><a href="javascript:;"><b>[合肥]</b> 百家宴</a></div>
                            <div class="f-address">地址：合肥蜀山区华润五彩城合肥蜀山区华润五彩城</div>
                            <div class="f-price">￥<span>500</span>起</div>
                        </div>
                    </li>
                    <li class="trigger-hover">
                        <div class="f-pic"><a href="#"><img src="http://www.baocms.cn/attachs/2016/10/27/thumb_58116b2b3d9f4.jpg" width="285" height="200" /></a></div>
                        <div class="f-info">
                            <div class="f-title"><a href="javascript:;"><b>[合肥]</b> 百家宴</a></div>
                            <div class="f-address">地址：合肥蜀山区华润五彩城合肥蜀山区华润五彩城</div>
                            <div class="f-price">￥<span>500</span>起</div>
                        </div>
                    </li>
                    <li class="trigger-hover">
                        <div class="f-pic"><a href="#"><img src="http://www.baocms.cn/attachs/2016/10/27/thumb_58116b2b3d9f4.jpg" width="285" height="200" /></a></div>
                        <div class="f-info">
                            <div class="f-title"><a href="javascript:;"><b>[合肥]</b> 百家宴</a></div>
                            <div class="f-address">地址：合肥蜀山区华润五彩城合肥蜀山区华润五彩城</div>
                            <div class="f-price">￥<span>500</span>起</div>
                        </div>
                    </li>
                    <li class="trigger-hover">
                        <div class="f-pic"><a href="#"><img src="http://www.baocms.cn/attachs/2016/10/27/thumb_58116b2b3d9f4.jpg" width="285" height="200" /></a></div>
                        <div class="f-info">
                            <div class="f-title"><a href="javascript:;"><b>[合肥]</b> 百家宴</a></div>
                            <div class="f-address">地址：合肥蜀山区华润五彩城合肥蜀山区华润五彩城</div>
                            <div class="f-price">￥<span>500</span>起</div>
                        </div>
                    </li>
                    <li class="trigger-hover">
                        <div class="f-pic"><a href="#"><img src="http://www.baocms.cn/attachs/2016/10/27/thumb_58116b2b3d9f4.jpg" width="285" height="200" /></a></div>
                        <div class="f-info">
                            <div class="f-title"><a href="javascript:;"><b>[合肥]</b> 百家宴</a></div>
                            <div class="f-address">地址：合肥蜀山区华润五彩城合肥蜀山区华润五彩城</div>
                            <div class="f-price">￥<span>500</span>起</div>
                        </div>
                    </li>
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