<?php $__env->startSection('content'); ?>
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav"><?php echo e(trans('user.sellcard')); ?></div>
                </div>
                <div class="weui-panel">
                    <div class="weui-panel__bd">
                        <img style="width:100%" src="<?php echo e(route('mobile.user.sellcard.index', ['getcode' => 1])); ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>