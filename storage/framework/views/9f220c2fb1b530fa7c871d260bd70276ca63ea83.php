<?php $__env->startSection('content'); ?>
    <div class="wp">
        <div class="filter-sort">
            <div class="mtm">
                <dl class="cl">
                    <dt>商家分类</dt>
                    <dd>
                        <a href="<?php echo e(route('brand.shop.index', ['discount' => request('discount'), 'keyword' => request('keyword'), 'orderby' => request('orderby')])); ?>" <?php echo request('catid') ? '' : 'class="a"'; ?>>不限</a>
                        <?php $__currentLoopData = $shopcates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('brand.shop.index', ['catid' => $value->id, 'discount' => request('discount'), 'keyword' => request('keyword'), 'orderby' => request('orderby')])); ?>" <?php echo $value->id == request('catid') ? 'class="a"' : ''; ?>><span><?php echo e($value->name); ?></span></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </dd>
                </dl>
                <dl class="cl">
                    <dt>商家折扣</dt>
                    <dd>
                        <a href="<?php echo e(route('brand.shop.index', ['catid' => request('catid'), 'keyword' => request('keyword'), 'orderby' => request('orderby')])); ?>" <?php echo request('discount') ? '' : 'class="a"'; ?>>不限</a>
                        <a href="<?php echo e(route('brand.shop.index', ['discount' => 1, 'catid' => request('catid'), 'keyword' => request('keyword'), 'orderby' => request('orderby')])); ?>" <?php echo request('discount') == 1 ? 'class="a"' : ''; ?>><span>9折以上</span></a>
                        <a href="<?php echo e(route('brand.shop.index', ['discount' => 2, 'catid' => request('catid'), 'keyword' => request('keyword'), 'orderby' => request('orderby')])); ?>" <?php echo request('discount') == 2 ? 'class="a"' : ''; ?>><span>8折-9折</span></a>
                        <a href="<?php echo e(route('brand.shop.index', ['discount' => 3, 'catid' => request('catid'), 'keyword' => request('keyword'), 'orderby' => request('orderby')])); ?>" <?php echo request('discount') == 3 ? 'class="a"' : ''; ?>><span>7折-8折</span></a>
                        <a href="<?php echo e(route('brand.shop.index', ['discount' => 4, 'catid' => request('catid'), 'keyword' => request('keyword'), 'orderby' => request('orderby')])); ?>" <?php echo request('discount') == 4 ? 'class="a"' : ''; ?>><span>6折-7折</span></a>
                        <a href="<?php echo e(route('brand.shop.index', ['discount' => 5, 'catid' => request('catid'), 'keyword' => request('keyword'), 'orderby' => request('orderby')])); ?>" <?php echo request('discount') == 5 ? 'class="a"' : ''; ?>><span>5折-6折</span></a>
                        <a href="<?php echo e(route('brand.shop.index', ['discount' => 6, 'catid' => request('catid'), 'keyword' => request('keyword'), 'orderby' => request('orderby')])); ?>" <?php echo request('discount') == 6 ? 'class="a"' : ''; ?>><span>5折以下</span></a>
                    </dd>
                </dl>
                <dl class="f-order cl">
                    <dt>排序</dt>
                    <dd>
                        <a href="<?php echo e(route('brand.shop.index', ['discount' => request('discount'), 'catid' => request('catid'), 'keyword' => request('keyword')])); ?>" <?php echo request('orderby') ? '' : 'class="a"'; ?>><span>默认</span></a>
                        <a href="<?php echo e(route('brand.shop.index', ['orderby' => 'discount', 'discount' => request('discount'), 'catid' => request('catid'), 'keyword' => request('keyword')])); ?>" <?php echo request('orderby') == 'discount' ? 'class="a"' : ''; ?>><span>折扣</span></a>
                        <a href="<?php echo e(route('brand.shop.index', ['orderby' => 'viewnum', 'discount' => request('discount'), 'catid' => request('catid'), 'keyword' => request('keyword')])); ?>" <?php echo request('orderby') == 'viewnum' ? 'class="a"' : ''; ?>><span>人气</span></a>
                        <a href="<?php echo e(route('brand.shop.index', ['orderby' => 'addtime', 'discount' => request('discount'), 'catid' => request('catid'), 'keyword' => request('keyword')])); ?>" <?php echo request('orderby') == 'addtime' ? 'class="a"' : ''; ?>><span>入驻时间</span></a>
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
            <?php echo $shoplist->appends(['catid' => request('catid')])->appends(['discount' => request('discount')])->appends(['keyword' => request('keyword')])->appends(['orderby' => request('orderby')])->links(); ?>

        <?php else: ?>
            <div class="shop-nodata mtm">
                <p>暂无该折扣的优惠信息！正在努力为您带来更多优惠！</p>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>