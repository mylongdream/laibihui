@extends('layouts.common.simple')

@section('content')
    <div class="content-body">
        <div class="wp">
            <div class="order-shop">
                <div class="pic">
                    <img src="{{ uploadImage($farm->upimage) }}" width="285" height="200" />
                </div>
                <div class="info">
                    <h2 class="title"><a href="{{ route('brand.farm.show', $farm->id) }}">{{ $farm->name }}</a></h2>
                    <p class="desc">地址：{{ $farm->address }}</p>
                </div>
            </div>
            <div class="order-body mtw">
                <form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('brand.farm.order', $farm->id) }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="package_id" value="0" id="package_id">
                    <div class="order-options order-package cl">
                        <div class="hd">
                            <h3>套餐选择</h3>
                        </div>
                        <div class="bd">
                            <ul>
                                @foreach ($farm->package->where('onsale', 1)->sortBy('displayorder') as $key => $value)
                                <li data-id="{{ $value->id }}" data-price="{{ $value->price }}">
                                    <span>{{ $value->name }}（{{ $value->price }}元）</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="order-options order-remark cl">
                        <div class="hd">
                            <h3>到店时间</h3>
                        </div>
                        <div class="bd">
                            <input style="width: 500px" class="input" type="text" size="50" value="" name="gotime" placeholder="必填：填写您的到店时间" onclick="laydate({min: laydate.now(),istime: true,format:'YYYY-MM-DD'})">
                        </div>
                    </div>
                    <div class="order-options order-remark cl">
                        <div class="hd">
                            <h3>您的姓名</h3>
                        </div>
                        <div class="bd">
                            <input style="width: 500px" class="input" type="text" size="50" value="" name="realname" placeholder="必填：填写您的姓名">
                        </div>
                    </div>
                    <div class="order-options order-remark cl">
                        <div class="hd">
                            <h3>手机号码</h3>
                        </div>
                        <div class="bd">
                            <input style="width: 500px" class="input" type="text" size="50" value="" name="mobile" placeholder="必填：填写您的手机号码">
                        </div>
                    </div>
                    <div class="order-options order-remark cl">
                        <div class="hd">
                            <h3>留言备注</h3>
                        </div>
                        <div class="bd">
                            <input style="width: 500px" class="input" type="text" size="50" value="" name="remark" placeholder="选填：填写您需要的留言备注信息">
                        </div>
                    </div>
                    <div class="order-options cl">
                        <div class="hd">
                            <h3>支付方式</h3>
                        </div>
                        <div class="bd">
                            <ul>
                                <li class="on">
                                    <span>在线支付 （支持微信支付、支付宝、银联在线支付等）</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="order-btn">
                        <span class="order-count">应付总额： <em>0.00</em> 元</span>
                        <button value="true" name="savesubmit" type="submit" class="button">提交订单</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            $(document).on("click", ".order-payment li", function(){
                var self = $(this);
                if(!self.hasClass("disabled")){
                    self.addClass("on").siblings().removeClass("on");
                    $("#paytype").val(self.attr('data-id'));
                }
            });
            $(document).on("click", ".order-package li", function(){
                var self = $(this);
                if(!self.hasClass("disabled")){
                    self.addClass("on").siblings().removeClass("on");
                    var account = parseInt(self.attr("data-price"));
                    $(".order-count em").html(account.toFixed(2));
                    $("#package_id").val(self.attr('data-id'));
                }
            });
            $(".order-package li").click();
        });
    </script>
@endsection
