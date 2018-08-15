@extends('layouts.common.simple')

@section('content')
    <div class="content-body">
        <div class="wp">
            <div class="order-body">
                <form class="" enctype="multipart/form-data" method="post" action="{{ route('brand.farm.pay', $order->order_sn) }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="paytype" value="1" id="paytype">
                    <div class="order-info cl">
                        <div class="bd">
                            <div class="z">
                                <h2 class="title">订单提交成功！去付款咯～</h2>
                                <p class="desc">订单号：{{ $order->order_sn }}</p>
                            </div>
                            <div class="y">
                                <p class="total">
                                    应付总额：<span class="money"><em>{{ $order->order_amount }}</em>元</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="order-options order-payment cl">
                        <div class="hd">
                            <h3>支付方式</h3>
                        </div>
                        <div class="bd">
                            <ul>
                                <li class="on" data-id="1">
                                    <span>支付宝支付</span>
                                </li>
                                <li data-id="2">
                                    <span>微信支付</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="order-btn">
                        <button value="true" name="savesubmit" type="submit" class="button">立即支付</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            $(".order-payment li").click(function(){
                var self = $(this);
                if(!self.hasClass("disabled")){
                    self.addClass("on").siblings().removeClass("on");
                    $("#paytype").val(self.attr('data-id'));
                }
            });
        });
    </script>
@endsection
