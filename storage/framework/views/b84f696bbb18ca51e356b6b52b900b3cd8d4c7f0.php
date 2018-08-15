<?php $__env->startSection('content'); ?>
    <div class="crm-main">
        <div class="crm-list">
            <table>
                <tr>
                    <th align="left" colspan="2">商户名称</th>
                    <th align="left" width="120">相距距离</th>
                </tr>
                <?php $__currentLoopData = $shops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td width="60">
                            <a href="<?php echo e(route('brand.shop.show',$value->id)); ?>" target="_blank"><img src="<?php echo e(uploadImage($value->upimage)); ?>" width="60" height="60"></a>
                        </td>
                        <td>
                            <p><a href="<?php echo e(route('brand.shop.show',$value->id)); ?>" target="_blank"><?php echo e($value->name); ?></a></p>
                            <p style="margin-top: 10px;color: #999">地址：<?php echo e($value->address); ?></p>
                        </td>
                        <td><?php echo e(number_format($value->distance)); ?> 米</td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.crm.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>