@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="topheader">
                <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                <div class="nav">点餐下单</div>
            </div>
            <form class="ajaxform" name="myform" method="post" action="{{ route('mobile.brand.shop.meal.order', ['id' => $shop->id]) }}">
                {!! csrf_field() !!}
                <div class="weui-cells">
                    @foreach ($cartlist as $value)
                        <div class="weui-cell">
                            <div class="weui-cell__hd" style="margin-right: 10px;">
                                <img src="{{ uploadImage($value->meal->upimage) }}" style="width: 50px;height: 50px;display: block">
                            </div>
                            <div class="weui-cell__bd">
                                <p>{{ $value->meal->name }}</p>
                                <p style="margin-top:5px;">X {{ $value->number }}</p>
                            </div>
                            <div class="weui-cell__ft">￥ {{ $value->meal->price }}</div>
                        </div>
                    @endforeach
                </div>
                <div class="weui-cells">
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">其他要求</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" name="remark" placeholder="选填：填写其他要求" type="text">
                        </div>
                    </div>
                </div>
                <div class="weui-cells">
                    @if (auth()->user()->card)
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            <p style="font-size: 14px">你已绑卡 可以享受（<span style="color: #f00">{{ $shop->discount }}</span>）折优惠</p>
                        </div>
                    </div>
                    @else
                        <a class="weui-cell weui-cell_access" href="{{ route('mobile.brand.card.index') }}">
                            <div class="weui-cell__bd">
                                <p style="font-size: 14px">你尚未绑卡 请尽快绑卡 享受（<span style="color: #f00">{{ $shop->discount }}</span>）折优惠</p>
                            </div>
                            <div class="weui-cell__ft">我要办卡</div>
                        </a>
                    @endif
                </div>
                <div class="weui-cells order-submit">
                    <div class="order-account">
                        应付金额<span id="needscore">{{ $totalMoney }}</span> 元
                    </div>
                    <div class="order-btn">
                        <button name="applybtn" type="button" class="weui-btn weui-btn_primary ajaxsubmit">提交订单</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection