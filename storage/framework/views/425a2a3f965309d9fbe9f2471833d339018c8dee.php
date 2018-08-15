<?php $__env->startSection('content'); ?>
    <div class="itemnav">
        <div class="title"><h3><?php echo e(trans('user.cardreward')); ?></h3></div>
        <ul class="tab">
            <li class="on"><a href="<?php echo e(route('user.cardreward.index')); ?>"><span><?php echo e(trans('user.cardreward.list')); ?></span></a></li>
            <li><a href="<?php echo e(route('user.cardreward.myreward')); ?>"><span><?php echo e(trans('user.cardreward.myreward')); ?></span></a></li>
        </ul>
    </div>
    <div class="cardreward mtw">
        <?php if($list): ?>
            <ul>
                <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <div class="pic"><img src="<?php echo e(uploadImage($value->upimage)); ?>" width="60" height="60"></div>
                        <div class="name"><?php echo e($value->name); ?></div>
                        <div class="info">所需卡数：<?php echo e($value->cardnum); ?>张</div>
                        <div class="btn"><a href="javascript:;" class="disabled">点击兑换</a></div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>