@extends('home.layouts.simple')

@section('content')
    <div class="wp">
        <div class="login-box">
            <div class="mod-title">
                <h2>重置密码</h2>
            </div>
            <div class="mod-content">
                @if (count($errors) > 0)
                    <div class="error">{{ $errors->first() }}</div>
                @endif
                <form class="ajaxform" name="myform" method="post" action="{{ route('auth.password.reset') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="ipt">
                        <dl class="cl">
                            <dt>新密码：</dt>
                            <dd><input type="password" name="password" class="px" required></dd>
                        </dl>
                        <dl class="cl">
                            <dt>确认密码：</dt>
                            <dd><input type="password" name="password_confirmation" class="px" required></dd>
                        </dl>
                    </div>
                    <div class="btn">
                        <button name="applybtn" type="submit" class="formdialog">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
