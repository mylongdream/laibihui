@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab assist_container">
        <div class="weui-tab__panel">
            <div class="main-body">
                <div class="wp">
                    <div class="pbw">
                    <div class="assist_top">
                        <div><img width="100%" style="display: block" src="{{ asset('static/image/mobile/assist/top.jpg') }}" alt=""></div>
                        <div class="assist_rule_button">规则</div>
                    </div>
                    @if (count($list) > 0)
                    <div class="assist_list_box">
                        <ul>
                            @foreach ($list as $value)
                                <li>
                                    <div class="p-pic"><img src="{{ uploadImage($value->upimage) }}" width="120" height="120"></div>
                                    <div class="p-info">
                                        <div class="p-name">
                                            <a href="{{ route('mobile.brand.assist.show', $value->id) }}" title="{{ $value->name }}">{{ $value->name }}</a>
                                        </div>
                                        <div class="p-desc">
                                            <div class="p-help z">需{{ $value->helpnum }}人助力,仅剩{{ $value->leftnum }}份</div>
                                            <div class="p-sell y">已领{{ $value->sellnum }}件</div>
                                        </div>
                                        <div class="p-join">
                                            <div class="p-price z"><em>￥</em><strong>{{ $value->price }}</strong></div>
                                            <div class="p-btn y"><a href="{{ route('mobile.brand.assist.show', $value->id) }}" title="{{ $value->name }}">{{ $value->price ? '我要领' : '免费领' }}</a></div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @else
                    <div class="assist_list_empty">
                        <div class="img"><img src="{{ asset('static/image/mobile/assist/empty.png') }}" width="140" alt=""></div>
                        <div class="title">还没有商品哦～</div>
                        <div class="desc">等一会再来看看吧！！</div>
                    </div>
                    @endif
                </div>
                </div>
            </div>
        </div>
        <div class="weui-tabbar">
            <a href="{{ route('mobile.brand.assist.index') }}" class="weui-tabbar__item weui-bar__item_on">
                <img class="weui-tabbar__icon" src="{{ asset('static/image/mobile/assist/tabbar_index_selected.png') }}" alt="">
                <p class="weui-tabbar__label">今日免单</p>
            </a>
            <a href="{{ route('mobile.brand.assist.order') }}" class="weui-tabbar__item">
                <img class="weui-tabbar__icon" src="{{ asset('static/image/mobile/assist/tabbar_order.png') }}" alt="">
                <p class="weui-tabbar__label">我的免单</p>
            </a>
        </div>
    </div>
    <script type="text/html" id="tpl_assist_rule">
        <div class="assist_rule_container">
            <p>1· 邀请好友助力，达到助力人数即可享免单权利</p>
            <p class="mtm">2· 每个新用户仅可助力一次。同一微信公众号内</p>
            <p class="mtm">3· 若发现用户存在刷单、虚假用户助力等违规行为，平台有权判定助力失败</p>
            <p class="mtm">4· 邀请到足够好友帮助您助力成功之后，可前往我的免单里查看详情</p>
            <p class="mtm">5· 公众号可在法律法规允许范围内对本次活动规则解释并做适当修改</p>
        </div>
    </script>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).on("click", ".assist_rule_button", function(){
            weui.alert($("#tpl_assist_rule").html(), {
                buttons: [{
                    label: '我知道了'
                }],
                title: '活动规则',
                isAndroid: false
            });
        });
    </script>
@endsection
