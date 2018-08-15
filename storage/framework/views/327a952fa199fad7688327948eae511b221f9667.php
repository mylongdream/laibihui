<?php $__env->startSection('content'); ?>
    <div class="wp">
        <div class="filter-sort">
            <div class="mtm">
                <dl class="cl">
                    <dt>商家分类</dt>
                    <dd>
                        <a href="" class="a">不限</a>
                    </dd>
                </dl>
                <dl class="f-order cl">
                    <dt>排序</dt>
                    <dd>
                        <a href="" class="a"><span>默认</span></a>
                        <a href=""><span>折扣</span></a>
                        <a href=""><span>人气</span></a>
                        <a href=""><span>入驻时间</span></a>
                    </dd>
                </dl>
            </div>
        </div>
        <?php if(count($shoplist)): ?>
            <?php if(request('style') == 'grid'): ?>
                <div class="shop-grid mtm">
                    <ul class="cl">
                        <?php $__currentLoopData = $shoplist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="trigger-hover">
                                <div class="s-box">
                                    <div class="s-name"><a href="<?php echo e(route('brand.shop.show', $shop->id)); ?>" target="_blank" title="<?php echo e($shop->name); ?>"><?php echo e($shop->name); ?></a></div>
                                    <div class="s-pic"><a href="<?php echo e(route('brand.shop.show', $shop->id)); ?>" target="_blank" title="<?php echo e($shop->name); ?>"><img src="<?php echo e(uploadImage($shop->upimage)); ?>"></a></div>
                                    <div class="s-discount">
                                        <span class="s-discount1"><em>￥</em><strong><?php echo e($shop->discount); ?></strong>折</span>
                                        <span class="s-discount2"><del>原价靠边站</del></span>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php else: ?>
                <div class="shop-list mtm">
                    <ul class="cl">
                        <?php $__currentLoopData = $shoplist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="trigger-hover">
                                <div class="s-pic"><a href="<?php echo e(route('brand.shop.show', $shop->id)); ?>" target="_blank" title="<?php echo e($shop->name); ?>"><img src="<?php echo e(uploadImage($shop->upimage)); ?>"></a></div>
                                <div class="s-box">
                                    <div class="s-name"><a href="<?php echo e(route('brand.shop.show', $shop->id)); ?>" target="_blank" title="<?php echo e($shop->name); ?>"><?php echo e($shop->name); ?></a></div>
                                    <div class="s-info">地址：<?php echo e($shop->address); ?></div>
                                    <div class="s-info">电话：<?php echo e($shop->phone); ?></div>
                                    <div class="s-discount">
                                        <span class="s-discount1"><em>￥</em><strong><?php echo e($shop->discount); ?></strong>折</span>
                                        <span class="s-discount2"><del>原价靠边站</del></span>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?php echo $shoplist->appends(['catid' => request('catid')])->appends(['name' => request('name')])->links(); ?>

        <?php else: ?>
            <div class="shop-nodata mtm">
                <p>暂无该折扣的优惠信息！知惠网正在努力为您带来更多优惠！</p>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>