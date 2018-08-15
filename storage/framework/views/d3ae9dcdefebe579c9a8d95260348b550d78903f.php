<?php $__env->startSection('content'); ?>
    <?php if(!request()->ajax()): ?>
    <div class="crm-main">
        <div class="crm-infobox">
            <div class="bd crm-form">
                    <table>
                        <tr>
                            <td align="right">经营类目</td>
                            <td><?php echo e($customer->category->name); ?></td>
                        </tr>
                        <tr>
                            <td width="150" align="right">商户名称</td>
                            <td><?php echo e($customer->name); ?></td>
                        </tr>
                        <tr>
                            <td align="right">商户地址</td>
                            <td><?php echo e($customer->address); ?></td>
                        </tr>
                        <tr>
                            <td align="right">联系电话</td>
                            <td><?php echo e($customer->phone); ?></td>
                        </tr>
                        <tr>
                            <td align="right">备注其它</td>
                            <td><?php echo e($customer->remark); ?></td>
                        </tr>
                    </table>
            </div>
        </div>
    </div>
    <?php else: ?>
        <div class="crm-form">
            <table>
                <tr>
                    <td width="150" align="right">经营类目</td>
                    <td width="450"><?php echo e($customer->category->name); ?></td>
                </tr>
                <tr>
                    <td align="right">商户名称</td>
                    <td><?php echo e($customer->name); ?></td>
                </tr>
                <tr>
                    <td align="right">商户地址</td>
                    <td><?php echo e($customer->address); ?></td>
                </tr>
                <tr>
                    <td align="right">联系电话</td>
                    <td><?php echo e($customer->phone); ?></td>
                </tr>
                <tr>
                    <td align="right">备注其它</td>
                    <td><?php echo e($customer->remark); ?></td>
                </tr>
            </table>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.crm.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>