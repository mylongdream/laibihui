<?php $__env->startSection('content'); ?>
    <?php if(!request()->ajax()): ?>
	<div class="crm-main">
    <div class="order-show mtw">
        <table>
            <tr>
                <th width="150" align="right">订单编号</th>
					<td><?php echo e(isset($appoint->order_sn) ? $appoint->order_sn : '/'); ?></td>
            </tr>
            <tr>
                <th align="right">姓名</th>
					<td><?php echo e($appoint->realname); ?></td>
            </tr>
            <tr>
                <th align="right">手机</th>
					<td><?php echo e(isset($appoint->mobile) ? $appoint->mobile : '/'); ?></td>
            </tr>
            <tr>
                <th align="right">预约人数</th>
					<td><?php echo e(isset($appoint->number) ? $appoint->number : '0'); ?> 人</td>
            </tr>
            <tr>
                <th align="right">预约时间</th>
					<td><?php echo e($appoint->appoint_at ? $appoint->appoint_at->format('Y-m-d H:i') : '/'); ?></td>
            </tr>
            <tr>
                <th align="right">备注信息</th>
					<td><?php echo e(isset($appoint->remark) ? $appoint->remark : '/'); ?></td>
            </tr>
        </table>
    </div>
    </div>
    <?php else: ?>
        <div class="order-show" style="width: 500px;">
        <table>
            <tr>
                <th width="120" align="right">订单编号</th>
					<td><?php echo e(isset($appoint->order_sn) ? $appoint->order_sn : '/'); ?></td>
            </tr>
            <tr>
                <th align="right">姓名</th>
					<td><?php echo e($appoint->realname); ?></td>
            </tr>
            <tr>
                <th align="right">手机</th>
					<td><?php echo e(isset($appoint->mobile) ? $appoint->mobile : '/'); ?></td>
            </tr>
            <tr>
                <th align="right">预约人数</th>
					<td><?php echo e(isset($appoint->number) ? $appoint->number : '0'); ?> 人</td>
            </tr>
            <tr>
                <th align="right">预约时间</th>
					<td><?php echo e($appoint->appoint_at ? $appoint->appoint_at->format('Y-m-d H:i') : '/'); ?></td>
            </tr>
            <tr>
                <th align="right">备注信息</th>
					<td><?php echo e(isset($appoint->remark) ? $appoint->remark : '/'); ?></td>
            </tr>
        </table>
    </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.crm.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>