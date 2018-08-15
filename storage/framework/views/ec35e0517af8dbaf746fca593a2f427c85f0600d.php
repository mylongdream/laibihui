<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.user.group')); ?></h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="<?php echo e(route('admin.user.group.batch')); ?>">
	<?php echo csrf_field(); ?>

	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.user.group.list')); ?></h3></div>
			<div class="y"><a href="<?php echo e(route('admin.user.group.create')); ?>" class="btn openwindow" title="<?php echo e(trans('admin.user.group.create')); ?>">+ <?php echo e(trans('admin.user.group.create')); ?></a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="80"><?php echo e(trans('admin.displayorder')); ?></th>
				<th width="200"><?php echo e(trans('admin.user.group.name')); ?></th>
				<th><?php echo e(trans('admin.user.group.description')); ?></th>
				<th width="100"><?php echo e(trans('admin.operation')); ?></th>
			</tr>
			<?php $__currentLoopData = $grouplist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><input class="ids" type="checkbox" value="<?php echo e($group->id); ?>" name="ids[]"></td>
				<td><input type="text" class="txt" name="displayorder[<?php echo e($group->id); ?>]" value="<?php echo e($group->displayorder); ?>" size="2"></td>
				<td><?php echo e($group->name); ?></td>
				<td><?php echo e($group->description); ?></td>
				<td>
					<a href="<?php echo e(route('admin.user.group.edit',$group->id)); ?>" class="openwindow" title="<?php echo e(trans('admin.user.group.edit')); ?>"><?php echo e(trans('admin.edit')); ?></a>
					<a href="<?php echo e(route('admin.user.group.destroy',$group->id)); ?>" class="mlm delbtn"><?php echo e(trans('admin.destroy')); ?></a>
				</td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($grouplist) > 0): ?>
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit"><?php echo e(trans('admin.destroy')); ?></button>
			<button class="submitbtn" name="updatesubmit" value="yes" type="submit"><?php echo e(trans('admin.update')); ?></button>
		</div>
    </div>
	<?php endif; ?>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>