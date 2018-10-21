@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                @if ($shop->getsuperior)
                <div class="weui-msg" style="background:#fff;padding:15px 10px;">
                    <div class="weui-msg__icon-area" style="margin-bottom: 10px;">
                        <img src="{{ $shop->getsuperior->headimgurl ? uploadImage($shop->getsuperior->headimgurl) : asset('static/image/common/getheadimg.jpg') }}" width="92" height="92" style="display:block;margin:0 auto;">
                    </div>
                    <div class="">
                        <h2 class="weui-msg__title">{{ $shop->getsuperior->username }}</h2>
                    </div>
                </div>
                    <div class="weui-cells">
                        @if ($shop->getsuperior->mobile)
                        <div class="weui-cell weui-cell_access">
                            <div class="weui-cell__bd">
                                <span>手机：{{ $shop->getsuperior->mobile }}</span>
                            </div>
                            <div class="weui-cell__ft"></div>
                        </div>
                        @endif
                        @if ($shop->getsuperior->qq)
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <span>QQ：{{ $shop->getsuperior->qq }}</span>
                            </div>
                        </div>
                        @endif
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