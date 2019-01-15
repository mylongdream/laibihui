@extends('layouts.common.loginpage')

@section('content')
    <div class="login-wrap">
        <div class="wp login-main">
            <div class="login-link">
            </div>
            <div class="login-box">
                <div class="login-tab tb-tab">
                    <ul class="cl">
                        <li class="on"><a href="javascript:;"><span>扫码登录</span></a></li>
                        <li><a href="javascript:;"><span>账户登录</span></a></li>
                    </ul>
                </div>
                @if (count($errors) > 0)
                    <div class="error">{{ $errors->first() }}</div>
                @endif
                <div class="tb-body">
                    <div id="qr-login" class="login-qrcode"></div>
                </div>
                <div class="tb-body hidden">
                    <form id="loginNormal" class="ajaxform" name="myform" method="post" action="{{ route('login') }}">
                        {!! csrf_field() !!}
                        <input name="ReturnUrl" value="{{ request('ReturnUrl') }}" type="hidden" />
                        <input name="login_type" id="login_type" value="normal" type="hidden" />
                        <div class="login-tip">
                            <div id="login_error1" class="error login_error" style="display: none;"></div>
                        </div>
                        <div class="ipt">
                            <dl class="cl line_1">
                                <dt>账 号：</dt>
                                <dd><input type="text" name="account" class="input" placeholder="用户名/手机号码"></dd>
                            </dl>
                            <dl class="cl line_2">
                                <dt>密 码：</dt>
                                <dd><input type="password" name="password" class="input" placeholder="密码"></dd>
                            </dl>
                        </div>
                        <div class="safe cl">
                            <div class="z">
                                <label class="checkbox" for="remember1">
                                    <input id="remember1" type="checkbox" value="1" name="remember">
                                    <span>自动登录</span>
                                </label>
                            </div>
                            <div class="y"><a href="javascript:void(0)" onclick="$('#loginNormal').hide();$('#loginTel').show();">手机动态密码登录</a></div>
                        </div>
                        <div class="btn">
                            <button name="applybtn" type="submit" class="button">登 录</button>
                        </div>
                    </form>
                    <form id="loginTel" class="ajaxform hidden" name="myform" method="post" action="{{ route('login') }}">
                        {!! csrf_field() !!}
                        <input name="ReturnUrl" value="{{ request('ReturnUrl') }}" type="hidden" />
                        <input name="login_type" id="login_type" value="fast" type="hidden" />
                        <div class="login-tip">
                            <div id="login_error2" class="error login_error" style="display: none;"></div>
                        </div>
                        <div class="ipt">
                            <dl class="cl line_1">
                                <dt>手机号码：</dt>
                                <dd><input type="text" name="mobile" class="input" placeholder="手机号码"></dd>
                            </dl>
                            <dl class="cl line_2">
                                <dt>短信验证码：</dt>
                                <dd>
                                    <input type="text" name="smscode" class="input verify" placeholder="短信验证码">
                                    <input type="hidden" name="mobilerule" value="forgotpwd">
                                    <button id="getsmscode" class="verify-btn getsmscode-reg" name="verify-btn" type="button">发送验证码</button>
                                </dd>
                            </dl>
                        </div>
                        <div class="safe cl">
                            <div class="z">
                                <label class="checkbox" for="remember2">
                                    <input id="remember2" type="checkbox" value="1" name="remember">
                                    <span>自动登录</span>
                                </label>
                            </div>
                            <div class="y"><a href="javascript:void(0)" onclick="$('#loginTel').hide();$('#loginNormal').show();">账号登录</a></div>
                        </div>
                        <div class="btn">
                            <button name="applybtn" type="submit" class="button">登 录</button>
                        </div>
                    </form>
                </div>
                <div class="login-extra">
                    <div class="z"><a href="{{ route('forgotpwd.reset') }}">忘记密码?</a></div>
                    <div class="y"><span class="txt">还没有账号？<a href="{{ route('register') }}" style="color: #ff6600">立即注册</a></span></div>
                </div>
                <div class="login-partner cl">
                    <div class="partner-title">其它方式登录</div>
                    <a href="{{ route('auth.wechat.index') }}">
                        <div id="weixin" class="partner-box partner-weixin">
                            <img src="{{ asset('static/image/common/weixinv2.png') }}">
                            <span>微信</span>
                        </div>
                    </a>
                    <a href="{{ route('auth.qq.index') }}">
                        <div class="partner-box partner-qq">
                            <img src="{{ asset('static/image/common/qqv2.png') }}">
                            <span>QQ</span>
                        </div>
                    </a>
                    <a href="{{ route('auth.weibo.index') }}">
                        <div class="partner-box partner-weibo partner-last">
                            <img src="{{ asset('static/image/common/weibov2.png') }}">
                            <span>微博</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('static/js/jquery.smscode.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $("#qr-login").load("{{ route('auth.wechat.index') }}");
            $("#getsmscode").sms({
                requestUrl:"{{ route('util.smscode') }}",
                callerror: function (data) {
                    $.jBox.tip(data, 'error');
                }
            });
        });
    </script>
@endsection