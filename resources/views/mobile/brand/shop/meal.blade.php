@extends('layouts.mobile.app')

@section('content')
    <form class="ajaxform" name="myform" method="post" action="{{ route('mobile.brand.shop.meal', ['id' => $shop->id]) }}" style="height: 100%">
        {!! csrf_field() !!}
        <div class="weui-tab">
            <div class="weui-tab__panel">
                <div class="main-body">
                    <div class="wp">
                        <div class="pbw" style="overflow: hidden">
                            <div class="weui-cells">
                                <a href="{{ route('mobile.brand.shop.show', ['id' => $shop->id]) }}" class="weui-cell weui-cell_access">
                                    <div class="weui-cell__hd" style="position: relative;margin-right: 10px;">
                                        <img src="{{ uploadImage($shop->upimage) }}" style="width: 50px;height: 50px;display: block">
                                    </div>
                                    <div class="weui-cell__bd">
                                        <p>{{ $shop->name }}</p>
                                        <p style="font-size: 13px;color: #888888;">电话：{{ $shop->phone }}</p>
                                    </div>
                                    <div class="weui-cell__ft"></div>
                                </a>
                            </div>
                            <div class="weui-cells weui-cells_checkbox">
                                @foreach ($meallist as $value)
                                    <label class="weui-cell weui-check__label" for="meal{{ $value->id }}" data-price="{{ $value->price }}">
                                        <div class="weui-cell__hd">
                                            <input class="weui-check" name="meal[]" id="meal{{ $value->id }}" type="checkbox" value="{{ $value->id }}">
                                            <i class="weui-icon-checked"></i>
                                        </div>
                                        <div class="weui-cell__bd">
                                            <div class="weui-cell">
                                                <div class="weui-cell__hd" style="position: relative;margin-right: 10px;">
                                                    <img src="{{ uploadImage($value->upimage) }}" style="width: 50px;height: 50px;display: block">
                                                </div>
                                                <div class="weui-cell__bd">
                                                    <p>{{ $value->name }}</p>
                                                    <p style="color: #888888;">￥ {{ $value->price }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="weui-tabbar">
                <dl class="order-amount">
                    <dt>需付：￥<span id="totalMoney">0.00</span></dt>
                    <dd>
                        总额：￥<span id="totalPrice">0.00</span>
                        <span class="mlm">折扣：<span id="amount-discount">{{ $shop->discount }}</span> 折</span>
                    </dd>
                </dl>
                <button name="applybtn" type="button" class="weui-tabbar__item tabbar-btn ajaxsubmit">立即点餐</button>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).on("click", ".weui-check__label", function(){
            var discount = parseFloat($("#amount-discount").text()) || 0;
            var totalprice = 0;
            $(".weui-check__label").each(function(){
                if($(this).find('.weui-check').is(':checked')){
                    totalprice += parseFloat($(this).data("price")) || 0;
                }
            });
            $("#totalPrice").text(totalprice.toFixed(2));
            $("#totalMoney").text((totalprice * discount / 10).toFixed(2));
        });
    </script>
@endsection