<div id="toptb" class="cl">
    <div class="wp">
        <?php if($setting['subwebstatus']): ?>
        <div class="map">
            <span class="current">全国</span>
            <span class="change"><a href="<?php echo e(route('page.allcity')); ?>">【切换城市】</a></span>
        </div>
        <?php else: ?>
            <div class="welcome">
                <span><a href="<?php echo e(route('index')); ?>">您好，欢迎来到<?php echo e($setting['sitename']); ?>！</a></span>
            </div>
        <?php endif; ?>
        <div class="link">
            <?php if(auth()->guard()->check()): ?>
                <span>你好，<?php echo e(auth()->user()->username); ?></span>
                <a href="<?php echo e(route('user.index')); ?>">个人中心</a>
                <span class="pipe">|</span>
                <a href="<?php echo e(route('logout')); ?>" class="ajaxget" title="退出">退出</a>
                <span class="pipe">|</span>
                <a href="<?php echo e(route('brand.card.index')); ?>" title="我要办卡">我要办卡</a>
            <?php else: ?>
                <a href="<?php echo e(route('login', ['ReturnUrl' => request()->getUri()])); ?>" title="请登录" class="">请登录</a>
                <span class="pipe">|</span>
                <a href="<?php echo e(route('register')); ?>" title="免费注册">免费注册</a>
                <span class="pipe">|</span>
                <a href="<?php echo e(route('brand.card.index')); ?>" title="我要办卡">我要办卡</a>
                <span class="pipe">|</span>
                <a href="<?php echo e(route('brand.card.active')); ?>" title="快速开卡">快速开卡</a>
            <?php endif; ?>
            <span class="pipe">|</span>
            <span class="tel">咨询热线：<?php echo e($setting['site_tel']); ?></span>
        </div>
    </div>
</div>
<div class="hdc cl">
    <div class="wp">
        <h1 class="logo">
            <a title="<?php echo e($setting['sitename']); ?>" href="<?php echo e(route('index')); ?>"><img border="0" alt="<?php echo e($setting['sitename']); ?>" src="<?php echo e(asset('static/image/common/logo.png')); ?>"></a>
        </h1>
        <div class="search">
            <form class="searchform" method="get" action="<?php echo e(route('brand.shop.index')); ?>">
                <input id="searchkey" name="name" type="text" value="<?php echo e(request('name')); ?>">
                <button value="true" name="searchsubmit" type="submit" onclick="if($('#searchkey').val()=='') return false;">搜索商家</button>
            </form>
        </div>
    </div>
</div>
<div class="nav_box cl">
    <div class="wp">
        <div class="nav_cat">
            <h3>商家分类</h3>
            <?php if(isset($showcat)): ?>
            <div class="cat_box">
                <?php $__currentLoopData = $categorylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="cat_item">
                    <div class="cat_name"><?php echo e($category->name); ?></div>
                    <div class="cat_sname">
                        <ul>
                            <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(route('brand.shop.index', ['catid' => $scategory->id])); ?>"><?php echo e($scategory->name); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <div class="cat_shop">
                        <ul>
                            <?php $__currentLoopData = $category->shoplist->take(15); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cateshop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <div class="s-pic"><a href="<?php echo e(route('brand.shop.show', $cateshop->id)); ?>" target="_blank" title="<?php echo e($cateshop->name); ?>"><img src="<?php echo e(uploadImage($cateshop->upimage)); ?>"></a></div>
                                <div class="s-name"><a href="<?php echo e(route('brand.shop.show', $cateshop->id)); ?>" target="_blank" title="<?php echo e($cateshop->name); ?>"><?php echo e($cateshop->name); ?></a></div>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="nav_main cl" id="nv">
            <ul>
                <li>
                    <a href="<?php echo e(route('index')); ?>" title="首页">首页</a>
                </li>
                <li class="<?php echo e(isset($curmenu) && $curmenu == 'shop' ? 'on' : ''); ?>">
                    <a href="<?php echo e(route('brand.shop.index')); ?>" title="折扣商家">折扣商家</a>
                </li>
            </ul>
        </div>
    </div>
</div>