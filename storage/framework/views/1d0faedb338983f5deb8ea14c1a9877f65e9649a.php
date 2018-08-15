<?php $__env->startSection('content'); ?>
    <div class="crm-main">
        <div class="crm-list mtw">
            <div class="crm-bar">
                <div class="z"><span>店铺名称：<?php echo e($shop->name); ?></span></div>
            </div>
            <table>
                <tr>
                    <th align="left">分配时间</th>
                    <th align="left" width="160">已分配</th>
                    <th align="left" width="120">分配数量</th>
                    <th align="left" width="120">分配价格</th>
                    <th align="left" width="80">操作</th>
                </tr>
                <?php $__currentLoopData = $allots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($value->created_at ? $value->created_at->format('Y-m-d H:i') : '/'); ?></td>
                        <td><a href="<?php echo e(route('crm.shop.card', ['id' => $shop->id, 'allotid' => $value->id])); ?>"><?php echo e($value->cardlist->count()); ?> 张</a></td>
                        <td><?php echo e($value->quantity); ?> 张</td>
                        <td><?php echo e($value->price); ?> 元</td>
                        <td><a href="<?php echo e(route('crm.shop.addcard', ['id' => $shop->id, 'allotid' => $value->id])); ?>" class="openwindow" title="导入卡号">导入卡号</a></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        </div>
        <?php echo $allots->links(); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.crm.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>