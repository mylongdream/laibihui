<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.crm.group')); ?></h3></div>
	</div>
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.crm.group.list')); ?></h3></div>
		</div>
		<table>
			<tr>
				<th width="200"><?php echo e(trans('admin.crm.group.name')); ?></th>
				<th><?php echo e(trans('admin.crm.group.description')); ?></th>
				<th width="200"><?php echo e(trans('admin.crm.group.module')); ?></th>
			</tr>
			<?php $__currentLoopData = config('crm.group'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><?php echo e($value['name']); ?></td>
				<td><?php echo e($value['description']); ?></td>
				<td><?php echo e($key); ?></td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>