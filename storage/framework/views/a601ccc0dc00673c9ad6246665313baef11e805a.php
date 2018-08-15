<?php $__env->startSection('content'); ?>
    <?php if(!request()->ajax()): ?>
        <div class="weui-tab">
            <div class="wp">
                <div class="meal-show">
                    <div class="m-pic">
                        <img src="<?php echo e(uploadImage($meal->upimage)); ?>" alt="">
                    </div>
                    <div class="m-info">
                        <div class="m-name"><?php echo e($meal->name); ?></div>
                        <div class="m-price">￥ <em><?php echo e($meal->price); ?></em></div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="meal-show">
            <div class="m-pic">
                <img src="<?php echo e(uploadImage($meal->upimage)); ?>" alt="">
                <?php if($meal->message): ?>
                    <span><?php echo e($meal->message); ?></span>
                <?php endif; ?>
            </div>
            <div class="m-info">
                <div class="m-name"><?php echo e($meal->name); ?></div>
                <div class="m-extra cl">
                    <div class="m-price">￥ <em><?php echo e($meal->price); ?></em></div>
                    <div class="m-order">
                        <?php if($meal->cart): ?>
                            <button name="" type="button" class="disabled">已点选</button>
                        <?php else: ?>
                            <button name="" type="button" class="meal-order-btn">点这个</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>