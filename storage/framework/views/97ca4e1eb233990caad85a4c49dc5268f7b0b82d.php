<?php $__env->startSection('content'); ?>
    <?php $__currentLoopData = auth()->user()->addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="address-item <?php echo e(auth()->user()->address_id == $value->id ? 'on' : ''); ?>" data-id="<?php echo e($value->id); ?>">
            <dl>
                <dt>
                    <span><?php echo e($value->realname); ?></span>
                    <a href="<?php echo e(route('user.address.edit', ['id' => $value->id])); ?>" class="openwindow" title="修改地址">修改</a>
                </dt>
                <dd><?php echo e($value->mobile); ?></dd>
                <dd>
                    <p><?php echo e($value->getprovince ? $value->getprovince->name : ''); ?> <?php echo e($value->getcity ? $value->getcity->name : ''); ?> <?php echo e($value->getarea ? $value->getarea->name : ''); ?> <?php echo e($value->getstreet ? $value->getstreet->name : ''); ?></p>
                    <p><?php echo e($value->address); ?></p>
                </dd>
            </dl>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.common.simple', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>