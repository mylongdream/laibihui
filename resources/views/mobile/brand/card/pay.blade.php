@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <form class="ajaxform" name="myform" method="post" action="{{ route('mobile.brand.card.pay', $order->order_sn) }}">
                    {!! csrf_field() !!}
                    <div class="weui-panel" style="margin: 0">
                        <div class="weui-msg">
                            <div class="weui-msg__text-area">
                                <h2 class="weui-msg__title">订单提交成功</h2>
                                <p class="weui-msg__desc">请尽快完成支付，超时订单将关闭。</p>
                            </div>
                        </div>
                    </div>
                    <div class="weui-form-preview mtm">
                        <div class="weui-form-preview__bd">
                            <div class="weui-form-preview__item">
                                <label class="weui-form-preview__label">订单编号</label>
                                <span class="weui-form-preview__value">{{ $order->order_sn }}</span>
                            </div>
                            <div class="weui-form-preview__item">
                                <label class="weui-form-preview__label">订单金额</label>
                                <span class="weui-form-preview__value">¥{{ $order->order_amount }}</span>
                            </div>
                            <div class="weui-form-preview__item">
                                <label class="weui-form-preview__label">收货人</label>
                                <span class="weui-form-preview__value">{{ $order->address->realname }}</span>
                            </div>
                            <div class="weui-form-preview__item">
                                <label class="weui-form-preview__label">手机号码</label>
                                <span class="weui-form-preview__value">{{ $order->address->mobile }}</span>
                            </div>
                            <div class="weui-form-preview__item">
                                <label class="weui-form-preview__label">收货地址</label>
                                <span class="weui-form-preview__value">{{ $order->address->getprovince ? $order->address->getprovince->name : '' }} {{ $order->address->getcity ? $order->address->getcity->name : '' }} {{ $order->address->getarea ? $order->address->getarea->name : '' }} {{ $order->address->getstreet ? $order->address->getstreet->name : '' }} {{ $order->address->address }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="weui-cells__title">请选择支付方式</div>
                    <div class="weui-cells weui-cells_radio">
                        <label class="weui-cell weui-check__label" for="paytype1">
                            <div class="weui-cell__bd">
                                <p>支付宝</p>
                            </div>
                            <div class="weui-cell__ft">
                                <input class="weui-check" name="paytype" id="paytype1" type="radio" value="1" checked="checked">
                                <span class="weui-icon-checked"></span>
                            </div>
                        </label>
                        <label class="weui-cell weui-check__label" for="paytype2">
                            <div class="weui-cell__bd">
                                <p>微信支付</p>
                            </div>
                            <div class="weui-cell__ft">
                                <input class="weui-check" name="paytype" id="paytype2" type="radio" value="2">
                                <span class="weui-icon-checked"></span>
                            </div>
                        </label>
                        <label class="weui-cell weui-check__label" for="paytype3">
                            <div class="weui-cell__bd">
                                <p>银联在线支付</p>
                            </div>
                            <div class="weui-cell__ft">
                                <input class="weui-check" name="paytype" id="paytype3" type="radio" value="3">
                                <span class="weui-icon-checked"></span>
                            </div>
                        </label>
                    </div>
                    <div class="weui-btn-area">
                        <button name="applybtn" type="submit" class="weui-btn weui-btn_primary">去付款</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).on("click", ".open-popup", function(){
            $('.popup-container').show();
            return false;
        });
        $(document).on("click", ".close-popup", function(){
            $('.popup-container').hide();
            return false;
        });
    </script>
@endsection