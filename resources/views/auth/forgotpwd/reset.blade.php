@extends('layouts.common.register')

@section('content')
    <div class="cheader cl">
        <div class="wp">
            <h1 class="logo">
                <a title="{{ $setting['sitename'] }}" href="{{ route('index') }}"><img border="0" alt="{{ $setting['sitename'] }}" src="{{ asset('static/image/common/logo.png') }}"></a>
            </h1>
            <div class="title">重置密码</div>
        </div>
    </div>
    <div class="wp login-box">
        <div class="login-main">
            <div class="mod-title">
                <h2>重置密码</h2>
            </div>
            <div class="mod-content">
                @if (count($errors) > 0)
                    <div class="error">{{ $errors->first() }}</div>
                @endif
                <form class="ajaxform" name="myform" method="post" action="{{ route('forgotpwd.reset') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="mobile" value="{{ $mobile }}">
                    <div class="ipt">
                        <dl class="cl">
                            <dt>新密码：</dt>
                            <dd><input type="password" name="password" class="input" placeholder="密码至少6~14位，含数字、英文、符号两种"></dd>
                        </dl>
                        <dl class="cl">
                            <dt>确认密码：</dt>
                            <dd><input type="password" name="password_confirmation" class="input" placeholder="密码至少6~14位，含数字、英文、符号两种"></dd>
                        </dl>
                    </div>
                    <div class="btn">
                        <button name="applybtn" type="submit" class="button">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
