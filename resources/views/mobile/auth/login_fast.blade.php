@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">用户登录</div>
                </div>
                <div class="tab_box">
                    <div class="weui-flex">
                        <div class="weui-flex__item">
                            <a href="{{ route('mobile.login') }}" class="">
                                <div class="title">账号密码登录</div>
                            </a>
                        </div>
                        <div class="weui-flex__item weui-flex__item_on">
                            <a href="{{ route('mobile.login.fast') }}" class="">
                                <div class="title">短信验证码登录</div>
                            </a>
                        </div>
                    </div>
                </div>
                <form class="ajaxform" name="myform" method="post" action="{{ route('mobile.login.fast') }}">
                    {!! csrf_field() !!}
                    <div class="weui-cells weui-cells_form">
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
                                <input type="hidden" name="mobilerule" value="forgotpwd">
                            </div>
                            <div class="weui-cell__ft">
                                <button id="getsmscode" class="weui-vcode-btn" type="button">获取验证码</button>
                            </div>
                        </div>
                    </div>
                    <label for="remember" class="weui-agree">
                        <input id="remember" class="weui-agree__checkbox" type="checkbox" value="1" name="remember">
                        <span class="weui-agree__text">自动登录</span>
                    </label>
                    <div class="weui-btn-area">
                        <button name="applybtn" type="button" class="weui-btn weui-btn_primary ajaxsubmit">登 录</button>
                    </div>
                </form>
                <div class="quick-nav">
                    <div class="z"><a href="{{ route('mobile.forgotpwd.reset') }}">忘记密码</a></div>
                    <div class="y"><a href="{{ route('mobile.register') }}">立即注册</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('static/js/jquery.smscode.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $("#getsmscode").sms({
                requestUrl: "{{ route('util.smscode') }}",
                callerror: function (data) {
                    weui.alert(data);
                }
            });
        });
    </script>
@endsection