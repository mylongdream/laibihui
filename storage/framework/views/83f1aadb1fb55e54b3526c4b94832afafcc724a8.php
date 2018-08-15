<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.admin.log')); ?></h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="<?php echo e(route('admin.admin.log.batch')); ?>">
	<?php echo csrf_field(); ?>

	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.admin.log.list')); ?></h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="150"><?php echo e(trans('admin.admin.log.user')); ?></th>
				<th><?php echo e(trans('admin.admin.log.action')); ?></th>
				<th width="140"><?php echo e(trans('admin.admin.log.postip')); ?></th>
				<th width="140"><?php echo e(trans('admin.created_at')); ?></th>
			</tr>
			<?php $__currentLoopData = $loglist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><input class="ids" type="checkbox" value="<?php echo e($log->id); ?>" name="ids[]"></td>
				<td><?php echo e($log->user ? $log->user->username : '/'); ?></td>
				<td><?php echo e($log->action); ?></td>
				<td><?php echo e($log->postip); ?></td>
				<td><?php echo e($log->created_at->format('Y-m-d H:i')); ?></td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($loglist) > 0): ?>
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit"><?php echo e(trans('admin.destroy')); ?></button>
		</div>
		<div class="page y">
			<?php echo $loglist->links(); ?>

		</div>
    </div>
	<?php endif; ?>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>