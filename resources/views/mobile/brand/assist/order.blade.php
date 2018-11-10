@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab assist_container">
        <div class="weui-tab__panel">
            <div class="main-body">
                <div class="wp">
                    <div class="assist_top">
                        <div><img width="100%" style="display: block" src="{{ asset('static/image/mobile/assist_top.jpg') }}" alt=""></div>
                        <div class="assist_rule_button">规则</div>
                    </div>
                    @if (count($list) > 0)
                        <div class="assist_list_box">
                            <ul>
                                @foreach ($list as $value)
                                    <li>
                                        <a href="{{ route('mobile.brand.assist.show', $value->id) }}" title="{{ $value->name }}">
                                            <div class="s-pic"><img src="{{ uploadImage($value->upimage) }}"></div>
                                            <div class="s-info">
                                                <div class="s-name">{{ $value->name }}</div>
                                                <div class="s-address">地址：{{ $value->address }}</div>
                                                <div class="s-discount">
                                                    <label>尊享标牌价：</label>
                                                    <span class="s-discount1"><em>￥</em><strong>{{ $value->discount }}</strong>折</span>
                                                    <span class="s-discount2"><del>原价靠边站</del></span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="assist_list_empty">
                            <div class="img"><img src="{{ asset('static/image/mobile/assist_empty.png') }}" width="140" alt=""></div>
                            <div class="title">还没有领取商品哦～</div>
                            <div class="desc">快前往今日免单领取吧！</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="weui-tabbar">
            <a href="{{ route('mobile.brand.assist.index') }}" class="weui-tabbar__item">
                <img class="weui-tabbar__icon" src="{{ asset('static/image/mobile/assist_tabbar_index.png') }}" alt="">
                <p class="weui-tabbar__label">今日免单</p>
            </a>
            <a href="{{ route('mobile.brand.assist.order') }}" class="weui-tabbar__item weui-bar__item_on">
                <img class="weui-tabbar__icon" src="{{ asset('static/image/mobile/assist_tabbar_order_selected.png') }}" alt="">
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
