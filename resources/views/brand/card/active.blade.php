@extends('layouts.common.simple')

@section('content')
    <div class="wp reg-box">
        <div class="reg-main">
            <div class="mod-title">
                <h2>快速开卡</h2>
                <span class="txt">开卡成功后便为登录状态</span>
            </div>
            <div class="mod-content">
                @if (count($errors) > 0)
                    <div class="error">{{ $errors->first() }}</div>
                @endif
                <form class="ajaxform" name="myform" method="post" action="{{ route('brand.card.active') }}">
                    {!! csrf_field() !!}
                    <div class="ipt">
                        <dl class="cl">
                            <dt>卡  号：</dt>
                            <dd><input id="form-number" type="text" name="number" class="input" placeholder=""></dd>
                        </dl>
                        <dl class="cl">
                            <dt>卡  密：</dt>
                            <dd><input id="form-password" type="password" name="password" class="input" placeholder=""></dd>
                        </dl>
                        <dl class="cl">
                            <dt>手机号码：</dt>
                            <dd>
                                <input id="form-mobile" type="text" name="mobile" class="input" placeholder="">
                            </dd>
                        </dl>
                        <dl class="cl">
                            <dt>短信验证码：</dt>
                            <dd>
                                <input id="form-smscode" type="text" name="smscode" class="input verify">
                                <input type="hidden" name="mobilerule" value="active">
                                <button id="getsmscode" class="verify-btn getsmscode-reg" name="verify-btn" type="button">发送验证码</button>
                            </dd>
                        </dl>
                    </div>
                    <div class="btn">
                        <button name="applybtn" type="submit" class="button">快速开卡</button>
                    </div>
                    <div class="form-tip">
                        快速开卡成功后会自动注册成为会员，登录密码默认为卡的密码
                    </div>
                </form>
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
                    number: {
                        required: true,
                        rangelength:[16,16],
                        remote: {
                            url: '{{ route('check.card.number') }}',
                            type: "get",
                            dataType: 'json',
                            data: {
                                number: function () {
                                    return $("#form-number").val();
                                }
                            }
                        }
                    },
                    password: {
                        required: true,
                        requiredTo: "#form-number",
                        remote: {
                            url: '{{ route('check.card.password') }}',
                            type: "get",
                            dataType: 'json',
                            data: {
                                number: function () {
                                    return $("#form-number").val();
                                },
                                password: function () {
                                    return $("#form-password").val();
                                }
                            }
                        }
                    },
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
                    number: {
                        required: "卡号不能为空",
                        rangelength: "请输入16位的卡号",
                        remote: '卡号不正确'
                    },
                    password: {
                        required: "密码不能为空",
                        requiredTo: "请先填写卡号",
                        remote: '密码不正确'
                    },
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