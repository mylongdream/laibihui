@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            @if ($success)
            <div class="weui-msg">
                <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
                <div class="weui-msg__text-area">
                    <h2 class="weui-msg__title">支付成功</h2>
                    <p class="weui-msg__desc">欢迎下次再来</p>
                </div>
                <div class="weui-msg__opr-area">
                    <p class="weui-btn-area">
                        <a href="{{ route('mobile.brand.shop.show', $shop->id) }}" class="weui-btn weui-btn_primary">回到商家首页</a>
                    </p>
                </div>
            </div>
            @else
            <div class="weui-msg">
                <div class="weui-msg__icon-area"><i class="weui-icon-warn weui-icon_msg"></i></div>
                <div class="weui-msg__text-area">
                    <h2 class="weui-msg__title">支付失败</h2>
                    <p class="weui-msg__desc">很抱歉，支付失败了</p>
                </div>
                <div class="weui-msg__opr-area">
                    <p class="weui-btn-area">
                        <a href="{{ route('mobile.brand.shop.pay', $shop->id) }}" class="weui-btn weui-btn_primary">重新付款</a>
                    </p>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
