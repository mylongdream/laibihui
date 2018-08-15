<?php $__env->startSection('content'); ?>
    <div class="login-wrap">
        <div class="wp login-main">
            <div class="login-link">
            </div>
            <div class="login-box">
                <div class="login-tab tb-tab">
                    <ul class="cl">
                        <li class="on"><a href="javascript:;"><span>常规登录</span></a></li>
                        <li><a href="javascript:;"><span>快速登录</span></a></li>
                    </ul>
                </div>
                <?php if(count($errors) > 0): ?>
                    <div class="error"><?php echo e($errors->first()); ?></div>
                <?php endif; ?>
                <div class="tb-body">
                    <form class="ajaxform" name="myform" method="post" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>

                        <input name="ReturnUrl" value="<?php echo e(request('ReturnUrl')); ?>" type="hidden" />
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
                            <div class="y"><a href="<?php echo e(route('forgotpwd.reset')); ?>">忘记密码?</a></div>
                        </div>
                        <div class="btn">
                            <button name="applybtn" type="submit" class="button">登 录</button>
                        </div>
                    </form>
                </div>
                <div class="tb-body hidden">
                    <form class="ajaxform" name="myform" method="post" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>

                        <input name="ReturnUrl" value="<?php echo e(request('ReturnUrl')); ?>" type="hidden" />
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
                            <div class="y"><a href="<?php echo e(route('forgotpwd.reset')); ?>">忘记密码?</a></div>
                        </div>
                        <div class="btn">
                            <button name="applybtn" type="submit" class="button">登 录</button>
                        </div>
                    </form>
                </div>
                <div class="login-extra">
                    <span class="txt">还没有账号？<a href="<?php echo e(route('register')); ?>" style="color: #ff6600">立即注册</a></span>
                </div>
                <div class="login-partner cl">
                    <div class="partner-title">其它方式登录</div>
                    <a href="<?php echo e(route('auth.wxweb.index')); ?>">
                        <div id="weixin" class="partner-box partner-weixin">
                            <img src="<?php echo e(asset('static/image/common/weixinv2.png')); ?>">
                            <span>微信</span>
                        </div>
                    </a>
                    <a href="<?php echo e(route('auth.qq.index')); ?>">
                        <div class="partner-box partner-qq">
                            <img src="<?php echo e(asset('static/image/common/qqv2.png')); ?>">
                            <span>QQ</span>
                        </div>
                    </a>
                    <a href="<?php echo e(route('auth.weibo.index')); ?>">
                        <div class="partner-box partner-weibo partner-last">
                            <img src="<?php echo e(asset('static/image/common/weibov2.png')); ?>">
                            <span>微博</span>
                        </div>
                    </a>
                </div>
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
<?php echo $__env->make('layouts.common.loginpage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>