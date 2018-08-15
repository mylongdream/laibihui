@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="topheader">
                <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                <div class="nav">农家乐下单</div>
            </div>
            <form class="ajaxform" name="myform" method="post" action="{{ route('mobile.brand.farm.order', $farm->id) }}">
                {!! csrf_field() !!}
                <div class="weui-cells">
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">到店时间</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input datePicker hidekeyboard" name="gotime" placeholder="必填：填写您的到店时间" type="text" readonly>
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">您的姓名</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" name="realname" placeholder="必填：填写您的姓名" type="text">
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">手机号码</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" name="mobile" placeholder="必填：填写您的手机号码" type="text">
                        </div>
                    </div>
                </div>
                <div class="weui-cells__title">套餐选择</div>
                <div class="weui-cells weui-cells_radio order-package">
                    @foreach ($farm->package->where('onsale', 1)->sortBy('displayorder') as $key => $value)
                        <label class="weui-cell weui-check__label" for="package_{{ $value->id }}" data-id="{{ $value->id }}" data-price="{{ $value->price }}">
                            <div class="weui-cell__bd">
                                <p>{{ $value->name }}（{{ $value->price }}元）</p>
                            </div>
                            <div class="weui-cell__ft">
                                <input class="weui-check" name="package_id" id="package_{{ $value->id }}" type="radio" value="{{ $value->id }}">
                                <span class="weui-icon-checked"></span>
                            </div>
                        </label>
                    @endforeach
                </div>
                <div class="weui-cells">
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">备注信息</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" name="remark" placeholder="选填：填写留言备注信息" type="text">
                        </div>
                    </div>
                </div>
                <div class="weui-cells order-submit">
                    <div class="order-account">
                        应付金额<span id="needscore">0.00</span> 元
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
        $(document).on("click", ".order-package .weui-cell", function(){
            var self = $(this);
            if(!self.hasClass("disabled")){
                var account = parseInt(self.attr("data-price"));
                $(".order-submit span").html(account.toFixed(2));
            }
        });
        $(".order-package .weui-cell:first").click();
    </script>
@endsection