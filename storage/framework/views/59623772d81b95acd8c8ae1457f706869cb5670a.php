<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.brand.withdraw')); ?></h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="<?php echo e(route('admin.brand.withdraw.batch')); ?>">
	<?php echo csrf_field(); ?>

	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.brand.withdraw.list')); ?></h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="150"><?php echo e(trans('admin.brand.withdraw.user')); ?></th>
				<th><?php echo e(trans('admin.brand.withdraw.shop')); ?></th>
				<th width="140"><?php echo e(trans('admin.brand.withdraw.money')); ?></th>
				<th width="140"><?php echo e(trans('admin.brand.withdraw.ifpay')); ?></th>
				<th width="140"><?php echo e(trans('admin.brand.withdraw.postip')); ?></th>
				<th width="140"><?php echo e(trans('admin.created_at')); ?></th>
			</tr>
			<?php $__currentLoopData = $withdrawlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdraw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><input class="ids" type="checkbox" value="<?php echo e($withdraw->id); ?>" name="ids[]"></td>
				<td><?php echo e($withdraw->user->username); ?></td>
				<td>
					<?php if($withdraw->shop): ?>
						<a href="<?php echo e(route('brand.shop.detail', $withdraw->shop->id)); ?>" target="_blank" title="<?php echo e($withdraw->shop->name); ?>"><?php echo e($withdraw->shop->name); ?></a>
					<?php else: ?>
						/
					<?php endif; ?>
				</td>
				<td><?php echo e($withdraw->money); ?> 元</td>
				<td><?php echo e($withdraw->ifpay ? '已支付' : '未支付'); ?></td>
				<td><?php echo e($withdraw->postip); ?></td>
				<td><?php echo e($withdraw->created_at->format('Y-m-d H:i')); ?></td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($withdrawlist) > 0): ?>
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit"><?php echo e(trans('admin.destroy')); ?></button>
		</div>
		<div class="page y">
			<?php echo $withdrawlist->links(); ?>

		</div>
    </div>
	<?php endif; ?>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>