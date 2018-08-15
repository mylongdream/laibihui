@extends('layouts.common.simple')

@section('content')
    <div class="wp login-box">
        <div class="login-main">
            <div class="mod-title">
                <h2>用户登录</h2>
                <span class="txt">还没有账号？<a href="{{ route('register') }}">立即注册</a></span>
            </div>
            <div class="mod-content">
                @if (count($errors) > 0)
                <div class="error">{{ $errors->first() }}</div>
                @endif
                <div class="login-tab">
                    <ul class="cl">
                        <li><a href="{{ route('login') }}"><span>常规登录</span></a></li>
                        <li class="on"><a href="{{ route('login.fast') }}"><span>快速登录</span></a></li>
                    </ul>
                </div>
                <form class="ajaxform" name="myform" method="post" action="{{ route('login.fast') }}">
                    {!! csrf_field() !!}
                    <div class="ipt">
                        <dl class="cl">
                            <dt>手机号码：</dt>
                            <dd><input type="text" name="mobile" class="input"></dd>
                        </dl>
                        <dl class="cl">
                            <dt>短信验证码：</dt>
                            <dd>
                                <input type="text" name="smscode" class="input verify">
                                <input type="hidden" name="mobilerule" value="forgotpwd">
                                <button id="getsmscode" class="verify-btn getsmscode-reg" name="verify-btn" type="button">发送验证码</button>
                            </dd>
                        </dl>
                    </div>
                    <div class="safe cl">
                        <div class="z">
                            <label class="checkbox" for="remember">
                                <input id="remember" type="checkbox" value="1" name="remember">
                                <span>自动登录</span>
                            </label>
                        </div>
                        <div class="y"><a href="{{ route('forgotpwd.reset') }}">忘记密码?</a></div>
                    </div>
                    <div class="btn">
                        <button name="applybtn" type="submit" class="button">登 录</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('static/js/jquery.smscode.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $("#getsmscode").sms({
                requestUrl:"{{ route('util.smscode') }}",
                callerror: function (data) {
                    $.jBox.tip(data, 'error');
                }
            });
        });
    </script>
@endsection