@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">快速开卡</div>
                </div>
                <form class="ajaxform" name="myform" method="post" action="{{ route('mobile.brand.card.active') }}">
                    {!! csrf_field() !!}
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell weui-cell_vcode">
                            <div class="weui-cell__hd"><label class="weui-label">卡  号</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="number" placeholder="请输入卡号" type="text">
                            </div>
                            @if (strpos(request()->userAgent(), 'MicroMessenger') !== false)
                            <div class="weui-cell__ft">
                                <button id="getcardnum" class="weui-vcode-btn" type="button">扫一扫</button>
                            </div>
                            @endif
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">卡  密</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="password" placeholder="请输入卡密" type="password">
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">手机号</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="mobile" placeholder="请输入手机号" type="text">
                            </div>
                        </div>
                        <div class="weui-cell weui-cell_vcode">
                            <div class="weui-cell__hd">
                                <label class="weui-label">验证码</label>
                            </div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" placeholder="请输入验证码" type="text" name="smscode">
                                <input type="hidden" name="mobilerule" value="active">
                            </div>
                            <div class="weui-cell__ft">
                                <button id="getsmscode" class="weui-vcode-btn" type="button">获取验证码</button>
                            </div>
                        </div>
                    </div>
                    <div class="weui-btn-area">
                        <button name="applybtn" type="button" class="weui-btn weui-btn_primary ajaxsubmit">快速开卡</button>
                    </div>
                </form>
                <div class="quick-nav">
                    <div class="z"><strong>注：</strong>快速开卡成功后会自动注册成为会员，登录密码默认为卡的密码</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
    <script type="text/javascript">
        wx.config({!! app('wechat.official_account')->jssdk->buildConfig(array('scanQRCode'), false) !!});
    </script>
    <script type="text/javascript" src="{{ asset('static/js/jquery.smscode.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $("#getsmscode").sms({
                requestUrl: "{{ route('util.smscode') }}",
                callerror: function (data) {
                    weui.alert(data);
                }
            });
            $(document).on("click", "#getcardnum", function(){
                wx.scanQRCode({
                    needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                    scanType: ["barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                    success: function (res) {
                        var serialNumber  = res.resultStr;
                        var serial = serialNumber.split(",");
                        serialNumber = serial[serial.length-1];
                        $("input[name='number']").val(serialNumber);
                    }
                });
            });
        });
    </script>
@endsection
