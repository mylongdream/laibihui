<?php $__env->startSection('content'); ?>
    <div class="weui-tab">
        <div class="weui-tab__panel">
            <div class="main-body">
                <div class="wp">
                    <div class="pbw">
                        <?php $__currentLoopData = $categorylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="">
                                <div class="weui-cells__title"><?php echo e($category->name); ?></div>
                                <div class="weui-cells">
                                    <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a class="weui-cell weui-cell_access" href="<?php echo e(route('mobile.brand.shop.index', ['catid' => $scate->id])); ?>" target="_blank" title="<?php echo e($scate->name); ?>">
                                            <div class="weui-cell__bd"><?php echo e($scate->name); ?></div>
                                            <div class="weui-cell__ft"></div>
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->make('layouts.mobile.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>