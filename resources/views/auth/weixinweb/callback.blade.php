@extends('layouts.common.register')

@section('content')
    <div class="cheader cl">
        <div class="wp">
            <h1 class="logo">
                <a title="{{ $setting['sitename'] }}" href="{{ route('index') }}"><img border="0" alt="{{ $setting['sitename'] }}" src="{{ asset('static/image/common/logo.png') }}"></a>
            </h1>
            <div class="title">微信登录</div>
        </div>
    </div>
    <div class="wp union-bind">
        <div class="bind-main">
            <div class="mod-content">
                @if (count($errors) > 0)
                    <div class="error">{{ $errors->first() }}</div>
                @endif
                <div class="tb-tab bind-tab">
                    <ul class="cl">
                        <li class="on"><a href="javascript:;"><span>已有账号，请绑定</span></a></li>
                        <li><a href="javascript:;"><span>没有账号，请完善资料</span></a></li>
                    </ul>
                </div>
                <div class="tb-body bind-login">
                    <form class="ajaxform" name="myform" method="post" action="{{ route('login') }}">
                        {!! csrf_field() !!}
                        <div class="ipt">
                            <dl class="cl">
                                <dt>账 号：</dt>
                                <dd><input type="text" name="account" class="input" placeholder="用户名/手机号码"></dd>
                            </dl>
                            <dl class="cl">
                                <dt>密 码：</dt>
                                <dd><input type="password" name="password" class="input"></dd>
                            </dl>
                            <dl class="cl">
                                <dt>验证码：</dt>
                                <dd>
                                    <input type="text" name="verify" class="input verify">
                                    <img class="verify-img reloadverify" src="{{captcha_src()}}" alt="启用验证码" title="看不清？点击更换另一个验证码。">
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
                <div class="tb-body bind-reg hidden">
                    <form class="ajaxform registerform" name="registerform" method="post" action="{{ route('register') }}">
                        {!! csrf_field() !!}
                        <div class="ipt">
                            <dl class="cl">
                                <dt>用户名：</dt>
                                <dd>
                                    <input id="form-username" type="text" name="username" class="input" placeholder="用户名至少3-16位，不允许非数字开头">
                                </dd>
                            </dl>
                            <dl class="cl">
                                <dt>密码：</dt>
                                <dd>
                                    <input id="form-password" type="password" name="password" class="input" placeholder="密码至少6-14位，含数字、字母、符号">
                                </dd>
                            </dl>
                            <dl class="cl">
                                <dt>确认密码：</dt>
                                <dd>
                                    <input id="form-password_confirmation" type="password" name="password_confirmation" class="input" placeholder="请再次输入密码">
                                </dd>
                            </dl>
                            <dl class="cl">
                                <dt>手机号码：</dt>
                                <dd>
                                    <input id="form-mobile" type="text" name="mobile" class="input">
                                </dd>
                            </dl>
                            <dl class="cl">
                                <dt>短信验证码：</dt>
                                <dd>
                                    <input id="form-smscode" type="text" name="smscode" class="input verify">
                                    <input type="hidden" name="mobilerule" value="register">
                                    <button id="getsmscode" class="verify-btn getsmscode-reg" name="verify-btn" type="button">发送验证码</button>
                                </dd>
                            </dl>
                        </div>
                        <div class="btn">
                            <button name="regbtn" type="submit" class="button">立即注册</button>
                        </div>
                    </form>
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
                requestUrl:"{{ route('util.smscode') }}",
                callerror: function (data) {
                    $.jBox.tip(data, 'error');
                }
            });
        });
    </script>
@endsection