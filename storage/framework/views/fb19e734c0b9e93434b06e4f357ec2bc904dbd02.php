<?php $__env->startSection('content'); ?>
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav"><?php echo e(trans('user.consume')); ?></div>
                </div>
                <div class="weui-panel weui-panel_access">
                    <div class="weui-panel__bd">
                        <a href="<?php echo e(route('mobile.brand.shop.show', $consume->shop->id)); ?>" class="weui-media-box weui-media-box_appmsg">
                            <div class="weui-media-box__hd">
                                <img class="weui-media-box__thumb" src="<?php echo e(uploadImage($consume->shop->upimage)); ?>" alt="">
                            </div>
                            <div class="weui-media-box__bd">
                                <h4 class="weui-media-box__title"><?php echo e($consume->shop ? $consume->shop->name : '/'); ?></h4>
                                <p class="weui-media-box__desc">电话：<?php echo e($consume->shop ? $consume->shop->phone : '/'); ?></p>
                                <p class="weui-media-box__desc">地址：<?php echo e($consume->shop ? $consume->shop->address : '/'); ?></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="weui-form-preview mtm">
                    <div class="weui-form-preview__hd">
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label"><?php echo e(trans('user.consume.status')); ?></label>
                            <span class="weui-form-preview__value"><?php echo e(trans('user.consume.status_'.$consume->ifpay)); ?></span>
                        </div>
                    </div>
                    <div class="weui-form-preview__bd">
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label"><?php echo e(trans('user.consume.consume_money')); ?></label>
                            <span class="weui-form-preview__value">¥<?php echo e(isset($consume->consume_money) ? $consume->consume_money : '0'); ?></span>
                        </div>
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label"><?php echo e(trans('user.consume.order_amount')); ?></label>
                            <span class="weui-form-preview__value">¥<?php echo e(isset($consume->order_amount) ? $consume->order_amount : '0'); ?></span>
                        </div>
                        <div class="weui-form-preview__item">
                            <label class="weui-form-preview__label"><?php echo e(trans('user.consume.created_at')); ?></label>
                            <span class="weui-form-preview__value"><?php echo e($consume->created_at ? $consume->created_at->format('Y-m-d H:i') : '/'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>