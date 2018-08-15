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
                <form class="ajaxform" name="myform" method="post" action="{{ route('auth.password.email') }}">
                    {!! csrf_field() !!}
                    <div class="ipt">
                        <dl class="cl">
                            <dt>邮箱：</dt>
                            <dd><input type="text" name="email" class="px"></dd>
                        </dl>
                        <dl class="cl">
                            <dt>用户名：</dt>
                            <dd><input type="text" name="email" class="px"></dd>
                        </dl>
                    </div>
                    <div class="btn">
                        <button name="applybtn" type="submit" class="formdialog">发送邮件</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection