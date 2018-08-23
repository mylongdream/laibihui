@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="weui-msg">
                <div class="weui-msg__text-area">
                    <h2 class="weui-msg__title">{{ $fromuser->username }} 为您办卡</h2>
                    <p class="weui-msg__desc">您将在线支付10元费用进行办卡</p>
                </div>
                <div class="sellcard_box">
                    <form method="post" action="{{ route('mobile.sellcard', ['fromuser' => request('fromuser')]) }}">
                        {!! csrf_field() !!}
                        <div class="sellcard_bd">
                            <input name="number" class="weui-input" placeholder="请输入卡号" type="text">
                        </div>
                        <div class="sellcard_btn">
                            <button type="submit" class="weui-btn weui-btn_primary">提 交</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection