@extends('home.layouts.simple')

@section('content')
    <div class="wp">
        <div class="login-box">
            <div class="mod-title">
                <h2>找回密码</h2>
                <span class="txt">还没有账号？<a href="{{ route('auth.register') }}">立即注册</a></span>
            </div>
            <div class="mod-content">
                @if (count($errors) > 0)
                    <div class="error">{{ $errors->first() }}</div>
                @endif
                <form class="ajaxform" name="myform" method="post" action="{{ route('auth.forgotpwd.mobile') }}">
                    {!! csrf_field() !!}
                    <div class="ipt">
                        <dl class="cl">
                            <dt>手机号码：</dt>
                            <dd><input type="text" name="mobile" class="px"></dd>
                        </dl>
                        <dl class="cl">
                            <dt>验证码：</dt>
                            <dd>
                                <input type="text" name="verify" class="verify">
                                <button id="getsmscode" class="verify-btn getsmscode-reset" name="verify-btn" type="button">发送验证码</button>
                            </dd>
                        </dl>
                    </div>
                    <div class="btn">
                        <button name="applybtn" type="submit" class="formdialog">下一步</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection