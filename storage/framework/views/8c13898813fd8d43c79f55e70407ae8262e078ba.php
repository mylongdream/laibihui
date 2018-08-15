<div class="menu-box">
    <dl class="first">
        <dt class="clickable <?php echo e(isset($curmenu) && $curmenu == 'index' ? 'on' : ''); ?>">
            <a title="" href="<?php echo e(route('user.index')); ?>"><span class="menu_home">首页</span></a>
        </dt>
    </dl>
    <dl>
        <dt>
            <span class="menu_function">管理</span>
        </dt>
        <dd class="<?php echo e(isset($curmenu) && $curmenu == 'promotion' ? 'on' : ''); ?>">
            <a title="" href="<?php echo e(route('user.promotion.index')); ?>"><span>推荐注册<i>送钱</i></span></a>
        </dd>
        <dd class="<?php echo e(isset($curmenu) && $curmenu == 'ordercard' ? 'on' : ''); ?>">
            <a title="" href="<?php echo e(route('user.ordercard.index')); ?>"><span><?php echo e(trans('user.ordercard')); ?></span></a>
        </dd>
        <dd class="<?php echo e(isset($curmenu) && $curmenu == 'bindcard' ? 'on' : ''); ?>">
            <a title="" href="<?php echo e(route('user.bindcard.index')); ?>"><span><?php echo e(trans('user.bindcard')); ?></span></a>
        </dd>
        <dd class="<?php echo e(isset($curmenu) && $curmenu == 'appoint' ? 'on' : ''); ?>">
            <a title="" href="<?php echo e(route('user.appoint.index')); ?>"><span>预约订座</span></a>
        </dd>
        <dd class="<?php echo e(isset($curmenu) && $curmenu == 'ordermeal' ? 'on' : ''); ?>">
            <a title="" href="<?php echo e(route('user.ordermeal.index')); ?>"><span>点餐管理</span></a>
        </dd>
        <dd class="<?php echo e(isset($curmenu) && $curmenu == 'orderfarm' ? 'on' : ''); ?>">
            <a title="" href="<?php echo e(route('user.orderfarm.index')); ?>"><span>农家乐管理</span></a>
        </dd>
        <dd class="<?php echo e(isset($curmenu) && $curmenu == 'consume' ? 'on' : ''); ?>">
            <a title="" href="<?php echo e(route('user.consume.index')); ?>"><span>消费账单</span></a>
        </dd>
        <dd class="<?php echo e(isset($curmenu) && $curmenu == 'score' ? 'on' : ''); ?>">
            <a title="" href="<?php echo e(route('user.score.index')); ?>"><span>我的积分</span></a>
        </dd>
        <dd class="<?php echo e(isset($curmenu) && $curmenu == 'collection' ? 'on' : ''); ?>">
            <a title="" href="<?php echo e(route('user.collection.index')); ?>"><span>我的收藏</span></a>
        </dd>
        <dd class="<?php echo e(isset($curmenu) && $curmenu == 'history' ? 'on' : ''); ?>">
            <a title="" href="<?php echo e(route('user.history.index')); ?>"><span>浏览历史</span></a>
        </dd>
        <dd class="<?php echo e(isset($curmenu) && $curmenu == 'cardreward' ? 'on' : ''); ?>">
            <a title="" href="<?php echo e(route('user.cardreward.index')); ?>"><span>售卡兑奖</span></a>
        </dd>
    </dl>
    <dl>
        <dt>
            <span class="menu_setup">设置</span>
        </dt>
        <dd class="<?php echo e(isset($curmenu) && $curmenu == 'profile' ? 'on' : ''); ?>">
            <a title="" href="<?php echo e(route('user.profile.index')); ?>"><span>个人资料</span></a>
        </dd>
        <dd class="<?php echo e(isset($curmenu) && $curmenu == 'password' ? 'on' : ''); ?>">
            <a title="" href="<?php echo e(route('user.password.index')); ?>"><span>密码安全</span></a>
        </dd>
        <dd class="<?php echo e(isset($curmenu) && $curmenu == 'address' ? 'on' : ''); ?>">
            <a title="" href="<?php echo e(route('user.address.index')); ?>"><span>收货地址</span></a>
        </dd>
        <dd class="<?php echo e(isset($curmenu) && $curmenu == 'binding' ? 'on' : ''); ?>">
            <a title="" href="<?php echo e(route('user.binding.index')); ?>"><span>账号绑定</span></a>
        </dd>
    </dl>
</div>