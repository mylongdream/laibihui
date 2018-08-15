<?php $__env->startSection('content'); ?>
    <div class="cheader cl">
        <div class="wp">
            <h1 class="logo">
                <a title="<?php echo e($setting['sitename']); ?>" href="<?php echo e(route('index')); ?>"><img border="0" alt="<?php echo e($setting['sitename']); ?>" src="<?php echo e(asset('static/image/common/logo.png')); ?>"></a>
            </h1>
            <div class="title">用户注册</div>
        </div>
    </div>
    <div class="wp reg-box">
        <div class="reg-main">
            <div class="mod-title">
                <h2>用户注册</h2>
                <span class="txt">已有账号？<a href="<?php echo e(route('login')); ?>">立即登录</a></span>
            </div>
            <div class="mod-content">
                <?php if(count($errors) > 0): ?>
                    <div class="error"><?php echo e($errors->first()); ?></div>
                <?php endif; ?>
                <div class="reg-body">
                    <form class="ajaxform registerform" name="registerform" method="post" action="<?php echo e(route('register')); ?>">
                        <?php echo csrf_field(); ?>

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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript" src="<?php echo e(asset('static/js/jquery.validate.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('static/js/jquery.validate.extend.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('static/js/jquery.smscode.js')); ?>"></script>
    <script type="text/javascript">
        $(function(){
            $('.ajaxform').validate({
                errorElement: "em",
                success: 'valid',
                rules: {
                    username: {
                        required: true,
                        rangelength:[3,16],
                        remote: {
                            url: '<?php echo e(route('check.username')); ?>',
                            type: "get",
                            dataType: 'json',
                            data: {
                                username: function () {
                                    return $("#form-username").val();
                                }
                            }
                        }
                    },
                    mobile: {
                        required: true,
                        mobile: true,
                        remote: {
                            url: '<?php echo e(route('check.mobile.register')); ?>',
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
                            url: '<?php echo e(route('check.smscode')); ?>',
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
                    username: {
                        required: "用户名不能为空",
                        rangelength: '用户名至少3-16位',
                        remote: '用户名不正确'
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
                requestUrl:"<?php echo e(route('util.smscode')); ?>",
                callerror: function (data) {
                    $.jBox.tip(data, 'error');
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common.register', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>