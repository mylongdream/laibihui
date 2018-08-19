<div class="menu-box">
    <ul>
        <li class="<?php echo e(isset($curmenu) && $curmenu == 'index' ? 'on' : ''); ?>">
            <a title="" href="<?php echo e(route('crm.index')); ?>"><span class="menu_index">系统首页</span></a>
        </li>

        <?php if(auth('crm')->user()->group->module == 'zhaoshang'): ?>
            <li class="<?php echo e(isset($curmenu) && $curmenu == 'addcustomer' ? 'on' : ''); ?>">
                <a title="" href="<?php echo e(route('crm.customer.create')); ?>"><span class="menu_index">新增客户</span></a>
            </li>
            <li class="<?php echo e(isset($curmenu) && $curmenu == 'customer' ? 'on' : ''); ?>">
                <a title="" href="<?php echo e(route('crm.customer.index')); ?>"><span class="menu_index">客户管理</span></a>
            </li>
            <li class="<?php echo e(isset($curmenu) && $curmenu == 'shop' ? 'on' : ''); ?>">
                <a title="" href="<?php echo e(route('crm.shop.index')); ?>"><span class="menu_index">成功客户</span></a>
            </li>
            <li class="<?php echo e(isset($curmenu) && $curmenu == 'follow' ? 'on' : ''); ?>">
                <a title="" href="javascript:;"><span class="menu_index">跟单管理</span></a>
            </li>
            <li class="<?php echo e(isset($curmenu) && $curmenu == 'service' ? 'on' : ''); ?>">
                <a title="" href="javascript:;"><span class="menu_index">售后服务</span></a>
            </li>
            <li class="<?php echo e(isset($curmenu) && $curmenu == 'charge' ? 'on' : ''); ?>">
                <a title="" href="javascript:;"><span class="menu_index">费用管理</span></a>
            </li>
        <?php endif; ?>

        <?php if(auth('crm')->user()->group->module == 'kefu'): ?>
            <li class="<?php echo e(isset($curmenu) && $curmenu == 'checkcustomer' ? 'on' : ''); ?>">
                <a title="" href="<?php echo e(route('crm.checkcustomer.index')); ?>"><span class="menu_index">客户审查</span></a>
            </li>
        <?php endif; ?>

        <?php if(auth('crm')->user()->group->module == 'shangjia'): ?>
            <li class="<?php echo e(isset($curmenu) && $curmenu == 'consume' ? 'on' : ''); ?>">
                <a title="" href="<?php echo e(route('crm.consume.index')); ?>"><span class="menu_index">店铺消费</span></a>
            </li>
            <?php if(auth('crm')->user()->shop->ordercard): ?>
            <li class="<?php echo e(isset($curmenu) && $curmenu == 'ordercard' ? 'on' : ''); ?>">
                <a title="" href="<?php echo e(route('crm.ordercard.index')); ?>"><span class="menu_index">店内办卡</span></a>
            </li>
            <?php endif; ?>
            <?php if(auth('crm')->user()->shop->appoint): ?>
                <li class="<?php echo e(isset($curmenu) && $curmenu == 'appoint' ? 'on' : ''); ?>">
                    <a title="" href="<?php echo e(route('crm.appoint.index')); ?>"><span class="menu_index">预约订座</span></a>
                </li>
            <?php endif; ?>
            <?php if(auth('crm')->user()->shop->ordermeal): ?>
                <li class="<?php echo e(isset($curmenu) && $curmenu == 'ordermeal' ? 'on' : ''); ?>">
                    <a title="" href="<?php echo e(route('crm.ordermeal.index')); ?>"><span class="menu_index">点餐管理</span></a>
                </li>
            <?php endif; ?>
            <li class="<?php echo e(isset($curmenu) && $curmenu == 'withdraw' ? 'on' : ''); ?>">
                <a title="" href="<?php echo e(route('crm.withdraw.index')); ?>"><span class="menu_index">提现记录</span></a>
            </li>
            <li class="<?php echo e(isset($curmenu) && $curmenu == 'checkout' ? 'on' : ''); ?>">
                <a title="" href="<?php echo e(route('crm.checkout.index')); ?>"><span class="menu_index">收银结账</span></a>
            </li>
        <?php endif; ?>

        <li class="<?php echo e(isset($curmenu) && $curmenu == 'account' ? 'on' : ''); ?>">
            <a title="" href="<?php echo e(route('crm.account.index')); ?>"><span class="menu_index">账户管理</span></a>
        </li>
    </ul>
</div>