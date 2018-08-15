<?php $__env->startSection('content'); ?>
    <div class="crm-tabnav">
        <ul>
            <li class="on"><a href="<?php echo e(route('crm.shop.index')); ?>">成功客户</a></li>
            <li><a href="<?php echo e(route('crm.archive.index')); ?>">客户修改审核</a></li>
        </ul>
    </div>
    <div class="crm-main">
        <form id="schform" name="schform" class="formsearch" method="get" action="<?php echo e(route('crm.shop.index')); ?>">
            <div class="crm-search">
                <dl>
                    <dt>商户名称</dt>
                    <dd><input type="text" name="name" class="schtxt" value="<?php echo e(request('name')); ?>"></dd>
                </dl>
                <div class="schbtn"><button name="" type="submit">搜索</button></div>
            </div>
        </form>
        <div class="crm-list mtw">
            <table>
                <tr>
                    <th align="left" colspan="2">商户名称</th>
                    <th align="left" width="150">联名卡</th>
                    <th align="left" width="160">有效期限</th>
                    <th align="left" width="80">操作</th>
                </tr>
                <?php $__currentLoopData = $shops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr style="height: 90px">
                        <td width="60">
                            <a href="<?php echo e(route('brand.shop.show',$value->id)); ?>" target="_blank"><img src="<?php echo e(uploadImage($value->upimage)); ?>" width="60" height="60"></a>
                        </td>
                        <td>
                            <p><a href="<?php echo e(route('brand.shop.show',$value->id)); ?>" target="_blank"><?php echo e($value->name); ?></a></p>
                            <p style="margin-top: 10px;color: #999">地址：<?php echo e($value->address); ?></p>
                        </td>
                        <td>
                            <p>已分配：<?php echo e($value->shopcards_count); ?> 张</p>
                            <p style="margin-top: 10px;">已发行：<?php echo e($value->sellcards_count); ?> 张</p>
                        </td>
                        <td>
                            <p>起：<?php echo e($value->started_at ? $value->started_at->format('Y-m-d H:i') : '/'); ?></p>
                            <p style="margin-top: 10px;">止：<?php echo e($value->ended_at ? $value->ended_at->format('Y-m-d H:i') : '/'); ?></p>
                        </td>
                        <td>
                            <p><a href="<?php echo e(route('crm.shop.edit', $value->id)); ?>" class="">修改资料</a></p>
                            <p style="margin-top: 10px;"><a href="<?php echo e(route('crm.shop.allot', $value->id)); ?>">分配卡号</a></p>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        </div>
        <?php echo $shops->appends(['name' => request('name')])->appends(['address' => request('address')])->links(); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.crm.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>