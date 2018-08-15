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
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">卡  号</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="number" placeholder="请输入卡号" type="text">
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">卡  密</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="password" placeholder="请输入卡密" type="password">
                            </div>
                        </div>
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

<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>