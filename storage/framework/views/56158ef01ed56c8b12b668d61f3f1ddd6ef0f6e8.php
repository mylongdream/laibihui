<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.district')); ?></h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('admin.district.update', $district->id)); ?>">
		<input type="hidden" name="_method" value="PUT">
		<?php echo csrf_field(); ?>

		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3><?php echo e(trans('admin.district.list')); ?></h3></div>
				<div class="y"><a href="<?php echo e(route('admin.district.index')); ?>" class="btn">< <?php echo e(trans('admin.district.list')); ?></a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.district.parent')); ?></td>
					<td><?php echo e($district->upid && $district->parent ? $district->parent->name : '/'); ?></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.district.name')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($district->name); ?>" name="name"></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.displayorder')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($district->displayorder); ?>" name="displayorder"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>