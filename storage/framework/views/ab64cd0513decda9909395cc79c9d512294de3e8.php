<div class="shop_head">
    <div class="wp cl">
        <?php if($shop->banner): ?>
            <div class="shop_banner cl">
                <img width="100%" height="150" border="0" src="<?php echo e(uploadImage($shop->banner)); ?>">
            </div>
        <?php else: ?>
            <div class="shop_top cl">
                <div class="logo"><img width="120" height="120" border="0" src="<?php echo e(uploadImage($shop->upimage)); ?>"></div>
                <dl class="cl">
                    <dt><?php echo e($shop->name); ?></dt>
                    <dd>
                    <p>地址：<?php echo e($shop->address); ?></p>
                    <p>电话：<?php echo e($shop->phone); ?></p>
                    </dd>
                </dl>
            </div>
        <?php endif; ?>
        <div class="shop_nav cl" id="nv">
            <ul>
                <li><a href="<?php echo e(route('brand.shop.show',$shop->id)); ?>">店铺首页</a></li>
            </ul>
            <div class="collection">
                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->collections()->where('shop_id', $shop->id)->count()): ?>
                        <a href="javascript:;" title="店铺已收藏" class="disabled">店铺已收藏</a>
                    <?php else: ?>
                        <a href="<?php echo e(route('brand.shop.collection',$shop->id)); ?>" title="收藏此店铺" class="ajaxget confirmbtn">收藏此店铺</a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="<?php echo e(route('brand.shop.collection',$shop->id)); ?>" title="收藏此店铺" class="ajaxget">收藏此店铺</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>