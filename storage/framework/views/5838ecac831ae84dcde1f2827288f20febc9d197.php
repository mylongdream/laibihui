<?php $__env->startSection('content'); ?>
    <div class="weui-tab">
        <div class="">
            <div class="wp pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">店铺资质</div>
                </div>
                <div class="shop-zizhi">
                    <?php if($shop->pic_zizhi): ?>
                        <?php $__currentLoopData = unserialize($shop->pic_zizhi); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upphoto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p><img src="<?php echo e(uploadImage($upphoto)); ?>" alt=""></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <div style="font-size: 18px;text-align: center;padding: 60px 10px;">暂无图片</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>