@extends('layouts.mobile.app')

@section('content')
    <div class="">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">用户注册</div>
                </div>
                <div class="weui-tab" id="tab">
                    <div class="weui-navbar tab_box">
                        <div class="weui-navbar__item weui-bar__item_on">
                            <a href="{{ route('mobile.register', ['ReturnUrl' => request('ReturnUrl')]) }}" class="">
                                <div class="title">账号密码注册</div>
                            </a>
                        </div>
                        <div class="weui-navbar__item">
                            <a href="{{ route('mobile.register.fast', ['ReturnUrl' => request('ReturnUrl')]) }}" class="">
                                <div class="title">短信验证码注册</div>
                            </a>
                        </div>
                    </div>
                    <div class="weui-tab__panel">
                        <form class="ajaxform" name="myform" method="post" action="{{ route('mobile.register') }}">
                            {!! csrf_field() !!}
                            <input name="register_type" id="register_type" value="normal" type="hidden" />
                            <div class="weui-cells weui-cells_form">
                                <div class="weui-cell">
                                    <div class="weui-cell__hd"><label class="weui-label">用户名</label></div>
                                    <div class="weui-cell__bd">
                                        <input class="weui-input" name="username" placeholder="请输入用户名" type="text">
                                    </div>
                                </div>
                                <div class="weui-cell">
                                    <div class="weui-cell__hd"><label class="weui-label">密码</label></div>
                                    <div class="weui-cell__bd">
                                        <input class="weui-input" name="password" placeholder="请输入密码" type="password">
                                    </div>
                                </div>
                                <div class="weui-cell">
                                    <div class="weui-cell__hd"><label class="weui-label">确认密码</label></div>
                                    <div class="weui-cell__bd">
                                        <input class="weui-input" name="password_confirmation" placeholder="请输入确认密码" type="password">
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
                                        <input type="hidden" name="mobilerule" value="register">
                                    </div>
                                    <div class="weui-cell__ft">
                                        <button id="getsmscode" class="weui-vcode-btn" type="button">获取验证码</button>
                                    </div>
                                </div>
                            </div>
                            <div class="weui-btn-area">
                                <button name="applybtn" type="button" class="weui-btn weui-btn_primary ajaxsubmit">立即注册</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="quick-nav">
                    <div class="z"><a href="{{ route('mobile.forgotpwd.reset', ['ReturnUrl' => request('ReturnUrl')]) }}">忘记密码</a></div>
                    <div class="y"><a href="{{ route('mobile.login', ['ReturnUrl' => request('ReturnUrl')]) }}">立即登录</a></div>
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
                calltip: function (data) {
                    weui.alert(data);
                },
                callerror: function (data) {
                    weui.alert(data);
                }
            });
        });
    </script>
@endsection