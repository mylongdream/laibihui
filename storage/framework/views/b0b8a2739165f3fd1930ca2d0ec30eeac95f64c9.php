<?php $__env->startSection('content'); ?>
    <div class="weui-tab">
        <div class="weui-tab__panel">
            <div class="main-body">
                <div class="wp">
                    <div class="pbw">
                        <div class="weui-search-bar" id="searchBar">
                            <form class="weui-search-bar__form" action="<?php echo e(route('mobile.brand.shop.index')); ?>">
                                <div class="weui-search-bar__box">
                                    <i class="weui-icon-search"></i>
                                    <input type="search" class="weui-search-bar__input" name="keyword" value="<?php echo e(request('keyword')); ?>" placeholder="搜索">
                                    <a href="javascript:" class="weui-icon-clear"></a>
                                </div>
                                <label class="weui-search-bar__label">
                                    <i class="weui-icon-search"></i>
                                    <span>搜索</span>
                                </label>
                            </form>
                            <a href="javascript:" class="weui-search-bar__cancel-btn">取消</a>
                        </div>
                        <?php if(count($shoplist)): ?>
                            <?php if(request('style') == 'grid'): ?>
                                <div class="shop-grid">
                                    <ul class="cl">
                                        <?php $__currentLoopData = $shoplist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <div class="s-box">
                                                    <div class="s-pic"><a href="<?php echo e(route('mobile.brand.shop.show', $value->id)); ?>" target="_blank" title="<?php echo e($value->name); ?>"><img src="<?php echo e(uploadImage($value->upimage)); ?>"></a></div>
                                                    <div class="s-name"><a href="<?php echo e(route('mobile.brand.shop.show', $value->id)); ?>" target="_blank" title="<?php echo e($value->name); ?>"><?php echo e($value->name); ?></a></div>
                                                    <div class="s-discount">
                                                        <span class="s-discount1"><em>￥</em><strong><?php echo e($value->discount); ?></strong>折</span>
                                                        <span class="s-discount2"><del>原价靠边站</del></span>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php else: ?>
                                <div class="shop-list">
                                    <ul class="cl">
                                        <?php $__currentLoopData = $shoplist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <a href="<?php echo e(route('mobile.brand.shop.show', $value->id)); ?>" title="<?php echo e($value->name); ?>">
                                                    <div class="s-pic"><img src="<?php echo e(uploadImage($value->upimage)); ?>"></div>
                                                    <div class="s-info">
                                                        <div class="s-name"><?php echo e($value->name); ?></div>
                                                        <div class="s-address">地址：<?php echo e($value->address); ?></div>
                                                        <div class="s-discount">
                                                            <label>尊享标牌价：</label>
                                                            <span class="s-discount1"><em>￥</em><strong><?php echo e($value->discount); ?></strong>折</span>
                                                            <span class="s-discount2"><del>原价靠边站</del></span>
                                                        </div>
                                                        <?php if($value->offline || $value->appoint || $value->ordermeal || $value->ordercard): ?>
                                                            <div class="s-support">
                                                                本店支持：
                                                                <?php if($value->offline): ?>
                                                                    <span>线下付款</span>
                                                                <?php endif; ?>
                                                                <?php if($value->appoint): ?>
                                                                    <span>预约订座</span>
                                                                <?php endif; ?>
                                                                <?php if($value->ordermeal): ?>
                                                                    <span>在线点餐</span>
                                                                <?php endif; ?>
                                                                <?php if($value->ordercard): ?>
                                                                    <span>店内办卡</span>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                        <div class="s-name"><?php echo e($value->distance); ?></div>
                                                    </div>
                                                </a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <?php echo $shoplist->appends(['catid' => request('catid')])->appends(['name' => request('name')])->appends(['style' => request('style')])->links(); ?>

                        <?php else: ?>
                            <div class="no-data">
                                <p>暂无该折扣的优惠信息！</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->make('layouts.mobile.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        weui.searchBar('#searchBar');
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>