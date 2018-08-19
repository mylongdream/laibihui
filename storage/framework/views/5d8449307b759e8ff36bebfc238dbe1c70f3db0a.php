<?php $__env->startSection('content'); ?>
    <div class="crm-main">
        <form id="schform" name="schform" class="formsearch" method="get" action="<?php echo e(route('crm.shop.card', ['id' => $shop->id, 'allotid' => request('allotid')])); ?>">
            <div class="crm-search">
                <dl>
                    <dt>卡号</dt>
                    <dd><input type="text" name="number" class="schtxt" value="<?php echo e(request('number')); ?>"></dd>
                </dl>
                <div class="schbtn"><button name="" type="submit">搜索</button></div>
            </div>
        </form>
        <div class="crm-list mtw">
            <div class="crm-bar">
                <div class="z"><span>店铺名称：<?php echo e($shop->name); ?></span></div>
                <div class="y"><a href="<?php echo e(route('crm.shop.addcard', ['id' => $shop->id, 'allotid' => request('allotid')])); ?>" class="btn openwindow" title="导入卡号">+ 导入卡号</a></div>
            </div>
            <table>
                <tr>
                    <th align="left">卡号</th>
                    <th align="left" width="160">状态</th>
                    <th align="left" width="120">分配时间</th>
                </tr>
                <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($value->number); ?></td>
                        <td><?php echo e($value->card ? '已开卡' : '待开卡'); ?></td>
                        <td><?php echo e($value->created_at ? $value->created_at->format('Y-m-d H:i') : '/'); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        </div>
        <?php echo $cards->appends(['number' => request('number')])->links(); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.crm.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>