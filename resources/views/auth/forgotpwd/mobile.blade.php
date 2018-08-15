@extends('layouts.common.register')

@section('content')
    <div class="cheader cl">
        <div class="wp">
            <h1 class="logo">
                <a title="{{ $setting['sitename'] }}" href="{{ route('index') }}"><img border="0" alt="{{ $setting['sitename'] }}" src="{{ asset('static/image/common/logo.png') }}"></a>
            </h1>
            <div class="title">找回密码</div>
        </div>
    </div>
    <div class="wp reg-box">
        <div class="reg-main">
            <div class="mod-title">
                <h2>找回密码</h2>
                <span class="txt">还没有账号？<a href="{{ route('register') }}">立即注册</a></span>
            </div>
            <div class="mod-content">
                @if (count($errors) > 0)
                    <div class="error">{{ $errors->first() }}</div>
                @endif
                <form class="ajaxform" name="myform" method="post" action="{{ route('forgotpwd.mobile') }}">
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
                    <div class="btn">
                        <button name="applybtn" type="submit" class="button">下一步</button>
                    </div>
                </form>
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