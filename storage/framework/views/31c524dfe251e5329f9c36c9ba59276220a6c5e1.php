<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.farm.order')); ?></h3></div>
	</div>
	<div class="tbedit">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.farm.order.show')); ?></h3></div>
		</div>
		<table>
			<tr>
				<td width="150" align="right"><?php echo e(trans('admin.farm.order.order_sn')); ?></td>
				<td><?php echo e(isset($order->order_sn) ? $order->order_sn : '/'); ?></td>
			</tr>
			<tr>
				<td width="150" align="right"><?php echo e(trans('admin.farm.order.gotime')); ?></td>
				<td><?php echo e($order->gotime ? $order->gotime->format('Y-m-d') : '/'); ?></td>
			</tr>
			<tr>
				<td width="150" align="right"><?php echo e(trans('admin.farm.order.realname')); ?></td>
				<td><?php echo e(isset($order->realname) ? $order->realname : '/'); ?></td>
			</tr>
			<tr>
				<td width="150" align="right"><?php echo e(trans('admin.farm.order.mobile')); ?></td>
				<td><?php echo e(isset($order->mobile) ? $order->mobile : '/'); ?></td>
			</tr>
			<tr>
				<td width="150" align="right"><?php echo e(trans('admin.farm.order.remark')); ?></td>
				<td><?php echo e(isset($order->remark) ? $order->remark : '/'); ?></td>
			</tr>
			<?php if($order->created_at): ?>
			<tr>
				<td width="150" align="right"><?php echo e(trans('admin.farm.order.created_at')); ?></td>
				<td><?php echo e($order->created_at ? $order->created_at->format('Y-m-d H:i') : '/'); ?></td>
			</tr>
			<?php endif; ?>
			<?php if($order->pay_at): ?>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.farm.order.pay_at')); ?></td>
					<td><?php echo e($order->pay_at ? $order->pay_at->format('Y-m-d H:i') : '/'); ?></td>
				</tr>
			<?php endif; ?>
			<?php if($order->finish_at): ?>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.farm.order.finish_at')); ?></td>
					<td><?php echo e($order->finish_at ? $order->finish_at->format('Y-m-d H:i') : '/'); ?></td>
				</tr>
			<?php endif; ?>
			<tr>
				<td width="150" align="right"><?php echo e(trans('admin.farm.order.handle')); ?></td>
				<td>
                    <?php if($order->order_status == 0 && $order->pay_status == 1): ?>


                        <a href="<?php echo e(route('admin.farm.order.finish',$order->id)); ?>" class="subtn" title="确认">确认</a>
                    <?php else: ?>
                        <?php echo e(trans('admin.farm.order.status_'.$order->order_status.$order->pay_status)); ?>

                    <?php endif; ?>
				</td>
			</tr>
		</table>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>