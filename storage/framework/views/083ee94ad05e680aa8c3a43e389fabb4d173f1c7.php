<?php $__env->startSection('content'); ?>
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">常见问题</div>
                </div>
                <?php $__currentLoopData = $faqcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="">
                        <div class="weui-cells__title"><?php echo e($value->name); ?></div>
                        <div class="weui-cells">
                            <?php $__currentLoopData = $value->faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="weui-cell weui-cell_access" href="<?php echo e(route('mobile.brand.faq.show', ['id' => $faq->id])); ?>">
                                    <div class="weui-cell__bd"><?php echo e($faq->title); ?></div>
                                    <div class="weui-cell__ft"></div>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>