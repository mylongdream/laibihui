<?php $__env->startSection('content'); ?>
    <div class="wp reg-box">
        <div class="reg-main">
            <div class="mod-title">
                <h2>找回密码</h2>
                <span class="txt">还没有账号？<a href="<?php echo e(route('register')); ?>">立即注册</a></span>
            </div>
            <div class="mod-content">
                <?php if(count($errors) > 0): ?>
                    <div class="error"><?php echo e($errors->first()); ?></div>
                <?php endif; ?>
                <form class="ajaxform" name="myform" method="post" action="<?php echo e(route('forgotpwd.mobile')); ?>">
                    <?php echo csrf_field(); ?>

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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript" src="<?php echo e(asset('static/js/jquery.smscode.js')); ?>"></script>
    <script type="text/javascript">
        $(function(){
            $("#getsmscode").sms({
                requestUrl:"<?php echo e(route('util.smscode')); ?>",
                callerror: function (data) {
                    $.jBox.tip(data, 'error');
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common.forgotpwd', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>