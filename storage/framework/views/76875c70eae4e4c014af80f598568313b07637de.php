<?php $__env->startSection('content'); ?>
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav"><?php echo e(trans('user.ordermeal')); ?></div>
                </div>
                <div class="weui-form-preview mtm">
                    <div class="weui-form-preview__hd">
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label"><?php echo e(trans('user.ordermeal.status')); ?></label>
                            <span class="weui-form-preview__value"><?php echo e(trans('user.ordermeal.status_'.$order->order_status.$order->pay_status)); ?></span>
                        </div>
                    </div>
                    <div class="weui-form-preview__bd">
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label"><?php echo e(trans('user.ordermeal.order_amount')); ?></label>
                            <span class="weui-form-preview__value">¥<?php echo e(isset($order->order_amount) ? $order->order_amount : '0'); ?></span>
                        </div>
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label"><?php echo e(trans('user.ordermeal.created_at')); ?></label>
                            <span class="weui-form-preview__value"><?php echo e($order->created_at ? $order->created_at->format('Y-m-d H:i') : '/'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>