<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.extend.reward')); ?></h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="<?php echo e(route('admin.extend.reward.batch')); ?>">
	<?php echo csrf_field(); ?>

	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.extend.reward.list')); ?></h3></div>
			<div class="y"><a href="<?php echo e(route('admin.extend.reward.create')); ?>" class="btn openwindow" title="<?php echo e(trans('admin.extend.reward.create')); ?>">+ <?php echo e(trans('admin.extend.reward.create')); ?></a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="100"><?php echo e(trans('admin.extend.reward.upimage')); ?></th>
				<th><?php echo e(trans('admin.extend.reward.name')); ?></th>
				<th width="150"><?php echo e(trans('admin.extend.reward.cardnum')); ?></th>
				<th width="100"><?php echo e(trans('admin.extend.reward.onsale')); ?></th>
				<th width="150"><?php echo e(trans('admin.extend.reward.created_at')); ?></th>
				<th width="100"><?php echo e(trans('admin.operation')); ?></th>
			</tr>
			<?php $__currentLoopData = $rewardlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reward): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><input class="ids" type="checkbox" value="<?php echo e($reward->id); ?>" name="ids[]"></td>
				<td><img src="<?php echo e(uploadImage($reward->upimage)); ?>" width="60" height="60"></td>
				<td><?php echo e($reward->name); ?></td>
				<td><?php echo e($reward->cardnum); ?></td>
				<td><?php echo e($reward->onsale ? trans('admin.yes') : trans('admin.no')); ?></td>
				<td><?php echo e($reward->created_at ? $reward->created_at->format('Y-m-d H:i') : '/'); ?></td>
				<td>
					<a href="<?php echo e(route('admin.extend.reward.edit',$reward->id)); ?>" class="openwindow" title="<?php echo e(trans('admin.extend.reward.edit')); ?>"><?php echo e(trans('admin.edit')); ?></a>
					<a href="<?php echo e(route('admin.extend.reward.destroy',$reward->id)); ?>" class="mlm delbtn"><?php echo e(trans('admin.destroy')); ?></a>
				</td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($rewardlist) > 0): ?>
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit"><?php echo e(trans('admin.destroy')); ?></button>
		</div>
    </div>
	<?php endif; ?>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>