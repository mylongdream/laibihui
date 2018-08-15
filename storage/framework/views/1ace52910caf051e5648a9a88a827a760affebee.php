<?php $__env->startSection('content'); ?>
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">在线绑卡</div>
                </div>
                <?php if($card): ?>
                    <div class="msg_success">
                        <div class="weui-msg">
                            <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
                            <div class="weui-msg__text-area">
                                <h2 class="weui-msg__title">已成功绑卡</h2>
                                <p class="weui-msg__desc">卡号为：<?php echo e($card->number); ?></p>
                            </div>
                            <div class="weui-msg__opr-area">
                                <p class="weui-btn-area">
                                    <a href="<?php echo e(route('mobile.brand.shop.index')); ?>" class="weui-btn weui-btn_primary">前去消费</a>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                <form class="ajaxform" name="myform" method="post" action="<?php echo e(route('mobile.user.bindcard.index')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell weui-cell_vcode">
                            <div class="weui-cell__hd"><label class="weui-label">卡  号</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="number" placeholder="请输入卡号" type="text">
                            </div>
                            <?php if(strpos(request()->userAgent(), 'MicroMessenger') !== false): ?>
                                <div class="weui-cell__ft">
                                    <button id="getcardnum" class="weui-vcode-btn" type="button">扫一扫</button>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">卡  密</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="password" placeholder="请输入卡密" type="password">
                            </div>
                        </div>
                        <?php if(!auth()->user()->mobile): ?>
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
                        <?php endif; ?>
                    </div>
                    <div class="weui-btn-area">
                        <button name="applybtn" type="button" class="weui-btn weui-btn_primary ajaxsubmit">快速开卡</button>
                    </div>
                </form>
                <div class="quick-nav">
                    <div class=""><a href="<?php echo e(route('mobile.brand.card.index')); ?>" class="text-red">我还没有卡，立即前去办卡</a></div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php if(strpos(request()->userAgent(), 'MicroMessenger') !== false): ?>
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
    <script type="text/javascript">
        wx.config(<?php echo app('wechat.official_account')->jssdk->buildConfig(array('scanQRCode'), false); ?>);
    </script>
    <script type="text/javascript">
        $(function(){
            $(document).on("click", "#getcardnum", function(){
                wx.scanQRCode({
                    needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                    scanType: ["barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                    success: function (res) {
                        var serialNumber  = res.resultStr;
                        var serial = serialNumber.split(",");
                        serialNumber = serial[serial.length-1];
                        $("input[name='number']").val(serialNumber);
                    }
                });
            });
        });
    </script>
    <?php endif; ?>
    <?php if(!auth()->user()->mobile): ?>
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
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>