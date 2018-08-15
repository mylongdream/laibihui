<div class="weui-tabbar">
    <a href="<?php echo e(route('mobile.index')); ?>" class="weui-tabbar__item<?php echo isset($curmenu) && $curmenu == 'index' ? ' weui-bar__item_on' : ''; ?>">
        <?php if(isset($curmenu) && $curmenu == 'index'): ?>
            <img class="weui-tabbar__icon" src="<?php echo e(asset('static/image/mobile/tabbar_home_selected.png')); ?>" alt="">
        <?php else: ?>
            <img class="weui-tabbar__icon" src="<?php echo e(asset('static/image/mobile/tabbar_home.png')); ?>" alt="">
        <?php endif; ?>
        <p class="weui-tabbar__label">首页</p>
    </a>
    <a href="<?php echo e(route('mobile.brand.recommend.index')); ?>" class="weui-tabbar__item<?php echo isset($curmenu) && $curmenu == 'recommend' ? ' weui-bar__item_on' : ''; ?>">
        <?php if(isset($curmenu) && $curmenu == 'recommend'): ?>
            <img class="weui-tabbar__icon" src="<?php echo e(asset('static/image/mobile/tabbar_like_selected.png')); ?>" alt="">
        <?php else: ?>
            <img class="weui-tabbar__icon" src="<?php echo e(asset('static/image/mobile/tabbar_like.png')); ?>" alt="">
        <?php endif; ?>
        <p class="weui-tabbar__label">推荐</p>
    </a>
    <a href="<?php echo e(route('mobile.brand.category.index')); ?>" class="weui-tabbar__item<?php echo isset($curmenu) && $curmenu == 'category' ? ' weui-bar__item_on' : ''; ?>">
        <?php if(isset($curmenu) && $curmenu == 'category'): ?>
            <img class="weui-tabbar__icon" src="<?php echo e(asset('static/image/mobile/tabbar_category_selected.png')); ?>" alt="">
        <?php else: ?>
            <img class="weui-tabbar__icon" src="<?php echo e(asset('static/image/mobile/tabbar_category.png')); ?>" alt="">
        <?php endif; ?>
        <p class="weui-tabbar__label">分类</p>
    </a>
    <a href="<?php echo e(route('mobile.brand.comment.index')); ?>" class="weui-tabbar__item<?php echo isset($curmenu) && $curmenu == 'comment' ? ' weui-bar__item_on' : ''; ?>">
        <?php if(isset($curmenu) && $curmenu == 'comment'): ?>
            <img class="weui-tabbar__icon" src="<?php echo e(asset('static/image/mobile/tabbar_comment_selected.png')); ?>" alt="">
        <?php else: ?>
            <img class="weui-tabbar__icon" src="<?php echo e(asset('static/image/mobile/tabbar_comment.png')); ?>" alt="">
        <?php endif; ?>
        <p class="weui-tabbar__label">点评</p>
    </a>
    <a href="<?php echo e(route('mobile.user.index')); ?>" class="weui-tabbar__item<?php echo isset($curmenu) && $curmenu == 'user' ? ' weui-bar__item_on' : ''; ?>">
        <?php if(isset($curmenu) && $curmenu == 'user'): ?>
            <img class="weui-tabbar__icon" src="<?php echo e(asset('static/image/mobile/tabbar_user_selected.png')); ?>" alt="">
        <?php else: ?>
            <img class="weui-tabbar__icon" src="<?php echo e(asset('static/image/mobile/tabbar_user.png')); ?>" alt="">
        <?php endif; ?>
        <p class="weui-tabbar__label">我的</p>
    </a>
</div>