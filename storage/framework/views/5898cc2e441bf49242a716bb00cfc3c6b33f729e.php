<div class="crm-head cl">
    <div class="wp">
        <div class="z">
            <h1 class="logo">
                <a href="javascript:;"><img border="0" alt="<?php echo e($setting['sitename']); ?>" src="<?php echo e(asset('static/image/common/logo.png')); ?>"></a>
            </h1>
            <div class="name">
                CRM管理系统
            </div>
        </div>
        <?php if(auth()->guard('crm')->check()): ?>
        <div class="y">
            <div class="user">
                <strong><?php echo e(config('crm.group.'.auth('crm')->user()->group.'.name')); ?>：<?php echo e(auth('crm')->user()->realname); ?></strong>
            </div>
            <div class="logout">
                <a href="<?php echo e(route('crm.logout')); ?>">退出</a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>