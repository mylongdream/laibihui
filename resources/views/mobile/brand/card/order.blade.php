@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="topheader">
                <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                <div class="nav">办卡下单</div>
            </div>
            <form class="ajaxform" name="myform" method="post" action="{{ route('mobile.brand.card.order') }}">
                {!! csrf_field() !!}
                @if ($address)
                    <div class="weui-cells order-address open-popup" data-target="#address_list" data-url="{{ route('mobile.brand.card.addresslist') }}">
                        <div class="weui-cell weui-cell_access">
                            <div class="weui-cell__bd">
                                <p style="margin-bottom: 5px;">{{ $address->realname }}<span class="mlm">{{ $address->mobile }}</span> </p>
                                <p style="font-size: 13px;color: #888888;">
                                    @if (auth()->user()->address_id == $address->id)
                                        <span class="weui-badge" style="margin-right: 5px;">默认</span>
                                    @endif
                                        {{ $address->getprovince ? $address->getprovince->name : '' }} {{ $address->getcity ? $address->getcity->name : '' }} {{ $address->getarea ? $address->getarea->name : '' }} {{ $address->getstreet ? $address->getstreet->name : '' }}</p>
                                <p style="font-size: 13px;color: #888888;">{{ $address->address }}</p>
                            </div>
                            <div class="weui-cell__ft"><input type="hidden" name="addressid" value="{{ $address->id }}"></div>
                        </div>
                    </div>
                @else
                    <div class="weui-cells order-address">
                        <div class="address_add open-popup" data-target="#address_add" data-url="{{ route('mobile.user.address.create') }}">
                            <a href="javascript:;"><span>添加新地址</span></a>
                        </div>
                    </div>
                @endif
                <div class="weui-cells__title">办卡方式</div>
                <div class="weui-cells weui-cells_radio order-shipment">
                    <label class="weui-cell weui-check__label" for="ordertype0" data-freight="0">
                        <div class="weui-cell__bd">
                            <p>上门办卡（免运费）</p>
                        </div>
                        <div class="weui-cell__ft">
                            <input class="weui-check" name="ordertype" id="ordertype0" type="radio" value="0" checked="checked">
                            <span class="weui-icon-checked"></span>
                        </div>
                    </label>
                    <label class="weui-cell weui-check__label" for="ordertype1" data-freight="10">
                        <div class="weui-cell__bd">
                            <p>邮寄办卡（运费10元）</p>
                        </div>
                        <div class="weui-cell__ft">
                            <input class="weui-check" name="ordertype" id="ordertype1" type="radio" value="1">
                            <span class="weui-icon-checked"></span>
                        </div>
                    </label>
                </div>
                <div class="weui-cells__title">绑卡获得</div>
                <div class="weui-cells order-reward">
                    <div class="weui-cell weui-cell_access">
                        <div class="weui-cell__bd">
                            <p>到店体验金10元 + 冻结余额90元</p>
                        </div>
                    </div>
                    <div class="weui-cell weui-cell_access hidden">
                        <div class="weui-cell__bd">
                            <p>到店体验金20元 + 冻结余额180元</p>
                        </div>
                    </div>
                </div>
                <div class="weui-cells">
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">备注信息</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" name="remark" placeholder="选填：填写留言备注信息" type="text">
                        </div>
                    </div>
                </div>
                <div class="weui-cells">
                    <div class="weui-cell">
                        <div class="weui-cell__hd" style="margin-right: 10px;">
                            <img src="{{ asset('static/image/mobile/card.jpg') }}" style="height: 50px;display: block">
                        </div>
                        <div class="weui-cell__bd">
                            <p>知惠网联名卡</p>
                            <p style="margin-top:5px;">X 1</p>
                        </div>
                        <div class="weui-cell__ft">￥10.00</div>
                    </div>
                </div>
                <div class="weui-cells order-submit">
                    <div class="order-account">
                        应付金额<span id="needscore">10.00</span> 元
                    </div>
                    <div class="order-btn">
                        <button name="applybtn" type="button" class="weui-btn weui-btn_primary ajaxsubmit">提交订单</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).on("click", ".order-shipment .weui-cell", function(){
            var self = $(this);
            if(!self.hasClass("disabled")){
                var account = 10;
                $(".order-reward .weui-cell").eq(self.index()).show().siblings().hide();
                account += parseInt(self.attr("data-freight"));
                $(".order-submit span").html(account.toFixed(2));
            }
        });
        $(document).on("click", ".address-list .weui-cell", function(){
            var self = $(this);
            $('.order-address').html(self.prop("outerHTML"));
            $('.popup-container').remove();
            return false;
        });
    </script>
@endsection