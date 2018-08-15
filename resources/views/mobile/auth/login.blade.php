@extends('layouts.mobile.app')

@section('content')
    <div class="">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">用户登录</div>
                </div>
                <div class="weui-tab" id="tab">
                    <div class="weui-navbar tab_box">
                        <div class="weui-navbar__item">账号密码登录</div>
                        <div class="weui-navbar__item">短信验证码登录</div>
                    </div>
                    <div class="weui-tab__panel">
                        <div class="weui-tab__content">
                            <form class="ajaxform" name="myform" method="post" action="{{ route('mobile.login') }}">
                                {!! csrf_field() !!}
                                <input name="ReturnUrl" value="{{ request('ReturnUrl') }}" type="hidden" />
                                <input name="login_type" id="login_type" value="normal" type="hidden" />
                                <div class="weui-cells weui-cells_form">
                                    <div class="weui-cell">
                                        <div class="weui-cell__hd"><label class="weui-label">账号</label></div>
                                        <div class="weui-cell__bd">
                                            <input class="weui-input" name="account" placeholder="请输入用户名或手机号" type="text">
                                        </div>
                                    </div>
                                    <div class="weui-cell">
                                        <div class="weui-cell__hd"><label class="weui-label">密码</label></div>
                                        <div class="weui-cell__bd">
                                            <input class="weui-input" name="password" placeholder="请输入密码" type="password">
                                        </div>
                                    </div>
                                    <div class="weui-cell weui-cell_vcode">
                                        <div class="weui-cell__hd"><label class="weui-label">验证码</label></div>
                                        <div class="weui-cell__bd">
                                            <input class="weui-input" name="verify" placeholder="请输入验证码" type="text">
                                        </div>
                                        <div class="weui-cell__ft">
                                            <img class="weui-vcode-img verify-img" src="{{captcha_src('mobile')}}">
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
                        </div>
                        <div class="weui-tab__content">
                            <form class="ajaxform" name="myform" method="post" action="{{ route('mobile.login') }}">
                                {!! csrf_field() !!}
                                <input name="ReturnUrl" value="{{ request('ReturnUrl') }}" type="hidden" />
                                <input name="login_type" id="login_type" value="fast" type="hidden" />
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
                        </div>
                    </div>
                </div>
                <div class="quick-nav">
                    <div class="z"><a href="{{ route('mobile.forgotpwd.reset', ['ReturnUrl' => request('ReturnUrl')]) }}">忘记密码</a></div>
                    <div class="y"><a href="{{ route('mobile.register', ['ReturnUrl' => request('ReturnUrl')]) }}">立即注册</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('static/js/jquery.smscode.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            weui.tab('#tab',{
                defaultIndex: 0,
                onChange: function(index){
                    console.log(index);
                }
            });
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