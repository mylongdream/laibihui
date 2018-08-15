<?php $__env->startSection('content'); ?>
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <?php if(auth()->user()->mobile): ?>
                        <div class="nav">修改手机号</div>
                    <?php else: ?>
                        <div class="nav">绑定手机号</div>
                    <?php endif; ?>
                </div>
                <form class="ajaxform" name="myform" method="post" action="<?php echo e(route('mobile.user.profile.mobile')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">手机号</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="mobile" placeholder="请输入手机号" type="text">
                            </div>
                        </div>
                        <div class="weui-cell weui-cell_vcode">
                            <div class="weui-cell__hd">
                                <label class="weui-label">验证码</label>
                            </div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" placeholder="请输入验证码" type="text" name="smscode">
                                <input type="hidden" name="mobilerule" value="register">
                            </div>
                            <div class="weui-cell__ft">
                                <button id="getsmscode" class="weui-vcode-btn" type="button">获取验证码</button>
                            </div>
                        </div>
                    </div>
                    <div class="weui-btn-area">
                        <?php if(auth()->user()->mobile): ?>
                            <button name="applybtn" type="button" class="weui-btn weui-btn_primary ajaxsubmit">立即修改</button>
                        <?php else: ?>
                            <button name="applybtn" type="button" class="weui-btn weui-btn_primary ajaxsubmit">立即绑定</button>
                        <?php endif; ?>
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
                requestUrl: "<?php echo e(route('util.smscode')); ?>",
                calltip: function (data) {
                    weui.alert(data);
                },
                callerror: function (data) {
                    weui.alert(data);
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>