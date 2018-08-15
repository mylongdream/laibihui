
<input type="hidden" name="user_id" value="<?php echo e($userinfo->uid); ?>">
<ul>
    <li>用户名：<span><?php echo e($userinfo->username); ?></span></li>
    <li>会员姓名：<span><?php echo e(isset($userinfo->realname) ? $userinfo->realname : '无'); ?></span></li>
    <li>手机号码：<span><?php echo e(isset($userinfo->mobile) ? $userinfo->mobile : '无'); ?></span></li>
    <li>到店体验金：<span><?php echo e($userinfo->tiyan_money); ?> 元</span></li>
    <li>可用积分：<span><?php echo e($userinfo->score); ?> 个</span></li>
    <li>可用余额：<span><?php echo e($userinfo->user_money); ?> 元</span></li>
</ul>

