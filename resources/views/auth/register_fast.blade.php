@extends('layouts.common.simple')

@section('content')
    <div class="wp reg-box">
        <div class="reg-main">
            <div class="mod-title">
                <h2>用户注册</h2>
                <span class="txt">已有账号？<a href="{{ route('login') }}">立即登录</a></span>
            </div>
            <div class="mod-content">
                @if (count($errors) > 0)
                    <div class="error">{{ $errors->first() }}</div>
                @endif
                <div class="reg-tab">
                    <ul class="cl">
                        <li><a href="{{ route('register') }}"><span>常规注册</span></a></li>
                        <li class="on"><a href="{{ route('register.fast') }}"><span>快速注册</span></a></li>
                    </ul>
                </div>
                <div class="reg-body">
                    <form class="ajaxform registerform" name="registerform" method="post" action="{{ route('register.fast') }}">
                        {!! csrf_field() !!}
                        <input name="register_type" id="register_type" value="fast" type="hidden" />
                        <div class="ipt">
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
                            <dl class="cl">
                                <dt>密码：</dt>
                                <dd>
                                    <input id="form-password" type="password" name="password" class="input" placeholder="密码至少6-14位，含数字、字母、符号">
                                </dd>
                            </dl>
                        </div>
                        <div class="btn">
                            <button name="regbtn" type="submit" class="button">快速注册</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('static/js/jquery.validate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jquery.validate.extend.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jquery.smscode.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $('.ajaxform').validate({
                errorElement: "em",
                success: 'valid',
                rules: {
                    mobile: {
                        required: true,
                        mobile: true,
                        remote: {
                            url: '{{ route('check.mobile.register') }}',
                            type: "get",
                            dataType: 'json',
                            data: {
                                mobile: function () {
                                    return $("#form-mobile").val();
                                }
                            }
                        }
                    },
                    smscode: {
                        required: true,
                        smscode: true,
                        remote: {
                            url: '{{ route('check.smscode') }}',
                            type: "get",
                            dataType: 'json',
                            data: {
                                smscode: function () {
                                    return $("#form-smscode").val();
                                }
                            }
                        }
                    }
                },
                messages: {
                    mobile: {
                        required: "手机号码不能为空",
                        mobile: "手机格式错误",
                        remote: '该手机号已被注册'
                    },
                    smscode: {
                        required: "验证码不能为空",
                        smscode: "验证码错误",
                        remote: "验证码错误"
                    }
                },
                submitHandler: function (form) {
                    $.ajax({
                        type: $(form).attr("method"),
                        url: $(form).attr("action"),
                        data: $(form).serialize(),
                        dataType: "json",
                        async:false
                    }).success(function(data) {
                        if(data.status == 1){
                            if(data.info){
                                $.jBox.tip(data.info+"，3秒后自动跳转……", 'success');
                                window.setTimeout(function () {
                                    if(data.url){
                                        window.location.href = data.url;
                                    } else {
                                        location.reload();
                                    }
                                }, 3000);
                            }else{
                                if(data.url){
                                    window.location.href = data.url;
                                } else {
                                    location.reload();
                                }
                            }
                        } else {
                            $.jBox.error(data.info, '提示');
                            //刷新验证码
                            $(".verify-img").trigger("click");
                        }
                    }).error(function(data) {
                        if (!data) {
                            return true;
                        } else {
                            message = $.parseJSON(data.responseText);
                            $.each(message.errors, function (key, value) {
                                $.jBox.tip(value, 'error');
                                //刷新验证码
                                $(".verify-img").trigger("click");
                                return false;
                            });
                            return false;
                        }
                    });
                }
            });
            $("#getsmscode").sms({
                requestUrl:"{{ route('util.smscode') }}",
                callerror: function (data) {
                    $.jBox.tip(data, 'error');
                }
            });
        });
    </script>
@endsection