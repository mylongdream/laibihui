@extends('layouts.mobile.app')

@section('content')
    <style>
        .assist_container .weui-tabbar__item{text-align: center;padding: 14px 0;}
        .assist_container .weui-bar__item_on .weui-tabbar__label{color:#ffaa29;}
        .assist_container .weui-tabbar__icon{display: inline-block;margin-right:5px;margin-bottom:-4px;}
        .assist_container .weui-tabbar__label{display: inline-block;font-size: 16px;line-height:20px;}
        .assist_top{position: relative}
        .assist_top .assist_rule_button{position: absolute;top:0;width:36px;height:32px;right:12px;line-height:32px;border-bottom-left-radius:18px;border-bottom-right-radius:18px;background-color:#e4c017;color:#a17400;font-size:12px;text-align:center;}
        .assist_list_box{background: #fff}
        .assist_list_box ul{position: relative}
        .assist_list_box li{display: block;overflow:hidden;padding:10px;border-bottom: 1px solid #eee;}
        .assist_list_box li .s-pic{float:left;}
        .assist_list_box li .s-pic img{display: block;}
        .assist_list_box li .s-info{margin-left:130px;}
        .assist_list_box li .s-name{font-size:16px;height:64px;line-height:32px;}
        .assist_list_box li .s-desc{font-size:14px;color:#999;overflow:hidden;line-height:20px;}
        .assist_list_box li .s-join{margin-top:4px;overflow:hidden;}
        .assist_list_box li .s-price{font-size:18px;height:32px;line-height:32px;color:#f00;}
        .assist_list_box li .s-price em{font-size:14px;font-style: normal;}
        .assist_list_box li .s-btn a{display:block;padding:0 10px;font-size:16px;height:32px;line-height:32px;color:#fff;background: #f00;}
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
                                    <div class="s-pic"><img src="{{ uploadImage($value->upimage) }}" width="120" height="120"></div>
                                    <div class="s-info">
                                        <div class="s-name">
                                            <a href="{{ route('mobile.brand.assist.show', $value->id) }}" title="{{ $value->name }}">{{ $value->name }}</a>
                                        </div>
                                        <div class="s-desc">
                                            <div class="s-help z">需{{ $value->helpnum }}人助力,仅剩{{ $value->leftnum }}份</div>
                                            <div class="s-sell y">已领{{ $value->sellnum }}件</div>
                                        </div>
                                        <div class="s-join">
                                            <div class="s-price z"><em>￥</em><strong>{{ $value->price }}</strong></div>
                                            <div class="s-btn y"><a href="{{ route('mobile.brand.assist.show', $value->id) }}" title="{{ $value->name }}">免费领</a></div>
                                        </div>
                                    </div>
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
