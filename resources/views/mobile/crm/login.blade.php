@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="weui-msg">
                <div class="weui-msg__text-area">
                    <h2 class="weui-msg__title">CRM系统管理登录</h2>
                </div>
                <div class="weui-msg__opr-area">
                    <form class="ajaxform" name="myform" method="post" action="{{ route('mobile.crm.login') }}">
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
                        <div class="weui-btn-area">
                            <button name="applybtn" type="button" class="weui-btn weui-btn_primary ajaxsubmit">登 录</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
