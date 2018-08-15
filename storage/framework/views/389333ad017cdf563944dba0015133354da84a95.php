<?php $__env->startSection('content'); ?>
    <div class="wp">
        <div class="buy-body">
            <p align="center"><img src="<?php echo e(asset('static/image/brand/card1.jpg')); ?>" alt=""></p>
            <p align="center"><a href="<?php echo e(route('brand.card.order')); ?>"><img src="<?php echo e(asset('static/image/brand/apply.gif')); ?>" alt=""></a></p>
            <p align="center"><img src="<?php echo e(asset('static/image/brand/card2.jpg')); ?>" alt=""></p>
            <p align="center"><img src="<?php echo e(asset('static/image/brand/card4.jpg')); ?>" alt=""></p>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>