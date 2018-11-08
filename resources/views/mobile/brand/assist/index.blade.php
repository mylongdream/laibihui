@extends('layouts.mobile.app')

@section('content')
    <style>
        .assist_container{}
        .assist_container .weui-tabbar{}
        .assist_container .weui-tabbar__item{text-align: center;padding: 14px 0;}
        .assist_container .weui-bar__item_on .weui-tabbar__label{color:#ffaa29;}
        .assist_container .weui-tabbar__icon{display: inline-block;margin-right:5px;margin-bottom:-4px;}
        .assist_container .weui-tabbar__label{display: inline-block;font-size: 16px;line-height:20px;}
        .assist_top{position: relative}
        .assist_top .assist_rule_button{position: absolute;top:0;width:36px;height:32px;right:12px;line-height:32px;border-bottom-left-radius:18px;border-bottom-right-radius:18px;background-color:#e4c017;color:#a17400;font-size:12px;text-align:center;}
        .assist_list_box{position: relative}
        .assist_list_box ul{position: relative}
        .assist_list_box li{position: relative}
        .assist_list_empty{margin:0 auto;padding:95px 10px;text-align: center;}
        .assist_list_empty .img{margin:0 auto;}
        .assist_list_empty .title{margin-top:18px;line-height:32px;color:#151516;font-size:18px;}
        .assist_list_empty .desc{line-height:24px;color:#9c9c9c;font-size:14px;}
    </style>
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
                        <div class="title">还没有商品哦～</div>
                        <div class="desc">等一会再来看看吧！！</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="weui-tabbar">
            <a href="{{ route('mobile.brand.assist.index') }}" class="weui-tabbar__item weui-bar__item_on">
                <img class="weui-tabbar__icon" src="{{ asset('static/image/mobile/assist_tabbar_index_selected.png') }}" alt="">
                <p class="weui-tabbar__label">今日免单</p>
            </a>
            <a href="{{ route('mobile.brand.assist.order') }}" class="weui-tabbar__item">
                <img class="weui-tabbar__icon" src="{{ asset('static/image/mobile/assist_tabbar_order.png') }}" alt="">
                <p class="weui-tabbar__label">我的免单</p>
            </a>
        </div>
    </div>
@endsection
