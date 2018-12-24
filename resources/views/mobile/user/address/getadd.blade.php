@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">{{ trans('user.address.create') }}</div>
                </div>
                <form class="ajaxform" name="myform" method="post" action="{{ route('mobile.user.address.store') }}">
                    {!! csrf_field() !!}
                    <div class="weui-cells weui-cells_form" id="address_city">
                        <div class="weui-cell weui-cell_select weui-cell_select-after">
                            <div class="weui-cell__hd"><label class="weui-label">所在省份</label></div>
                            <div class="weui-cell__bd">
                                <select class="weui-select prov" name="province"></select>
                            </div>
                        </div>
                        <div class="weui-cell weui-cell_select weui-cell_select-after">
                            <div class="weui-cell__hd"><label class="weui-label">所在城市</label></div>
                            <div class="weui-cell__bd">
                                <select class="weui-select city" name="city"></select>
                            </div>
                        </div>
                        <div class="weui-cell weui-cell_select weui-cell_select-after">
                            <div class="weui-cell__hd"><label class="weui-label">所在区域</label></div>
                            <div class="weui-cell__bd">
                                <select class="weui-select dist" name="area"></select>
                            </div>
                        </div>
                        <div class="weui-cell weui-cell_select weui-cell_select-after">
                            <div class="weui-cell__hd"><label class="weui-label">所在街道</label></div>
                            <div class="weui-cell__bd">
                                <select class="weui-select street" name="street"></select>
                            </div>
                        </div>
                    </div>
                    <div class="weui-cells__title">详细地址</div>
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <textarea class="weui-textarea" name="address" placeholder="请输入详细地址" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">收货人</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="realname" placeholder="请输入收货人" type="text">
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">手机号</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="mobile" placeholder="请输入手机号" type="text">
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">邮政编码</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="zipcode" placeholder="请输入邮政编码" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell weui-cell_switch">
                            <div class="weui-cell__bd">设置为默认收货地址</div>
                            <div class="weui-cell__ft">
                                <label for="switchCP" class="weui-switch-cp">
                                    <input id="switchCP" class="weui-switch-cp__input" type="checkbox" name="default" value="1">
                                    <div class="weui-switch-cp__box"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="weui-btn-area">
                        <button name="applybtn" type="button" class="weui-btn weui-btn_primary address_submit">提 交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('static/js/jquery.cityselect.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $("#address_city").citySelect({
                url:"{{ route('util.district') }}",
                required:false
            });
            $(document).on("click", "#address_add .address_submit", function(){
                var self = $(this.form);
                var loading = weui.loading('loading');
                $.ajax({
                    type:self.attr("method"),
                    url:self.attr('action'),
                    data:self.serialize(),
                    success: function(data) {
                        loading.hide();
                        if(data.status == 1){
                            if(self.find(".ajaxtip-success__content").length > 0) data.info = self.find(".ajaxtip-success__content").html();
                            if (data.info) {
                                weui.toast(data.info, {
                                    duration: 3000,
                                    className: 'toast-success',
                                    callback: function(){
                                        $(".order-address").load(data.geturl);
                                        $(".popup-container").remove();
                                    }
                                });
                            } else {
                                $(".order-address").load(data.geturl);
                                $(".popup-container").remove();
                            }
                        } else {
                            if(self.find(".ajaxtip-error__content").length > 0) data.info = self.find(".ajaxtip-error__content").html();
                            weui.alert(data.info, {
                                isAndroid: false
                            });
                        }
                    },
                    error: function(data) {
                        loading.hide();
                        if (!data) {
                            return true;
                        } else {
                            message = $.parseJSON(data.responseText);
                            $.each(message.errors, function (key, value) {
                                weui.alert(value, {
                                    isAndroid: false
                                });
                                $(".verify-img").trigger("click");
                                return false;
                            });
                            return false;
                        }
                    }
                });
                return false;
            });
        });
    </script>
@endsection