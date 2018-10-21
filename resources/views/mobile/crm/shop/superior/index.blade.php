@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                @if ($shop->superior)
                <div class="weui-msg" style="background:#fff;padding:15px 10px;">
                    <div class="weui-msg__icon-area" style="margin-bottom: 10px;">
                        <img src="{{ $shop->superior->headimgurl ? uploadImage($shop->superior->headimgurl) : asset('static/image/common/getheadimg.jpg') }}" width="92" height="92" style="display:block;margin:0 auto;">
                    </div>
                    <div class="">
                        <h2 class="weui-msg__title">{{ $shop->superior->username }}</h2>
                        <p class="weui-msg__desc">联系电话：{{ $shop->superior->phone }}</p>
                    </div>
                </div>
                @else
                    <div class="weui-msg">
                        <div class="weui-msg__icon-area"><i class="weui-icon-warn weui-icon_msg"></i></div>
                        <div class="weui-msg__text-area">
                            <h2 class="weui-msg__title">客户经理不存在</h2>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection