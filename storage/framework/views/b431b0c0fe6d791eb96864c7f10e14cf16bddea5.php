<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.district')); ?></h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="<?php echo e(route('admin.district.batch')); ?>">
	<?php echo csrf_field(); ?>

	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.district.list')); ?></h3></div>
			<div class="y"><a href="<?php echo e(route('admin.district.create', ['upid' => request('upid')])); ?>" class="btn openwindow" title="<?php echo e(trans('admin.district.create')); ?>">+ <?php echo e(trans('admin.district.create')); ?></a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="50"><?php echo e(trans('admin.id')); ?></th>
				<th width="80"><?php echo e(trans('admin.displayorder')); ?></th>
				<th><?php echo e(trans('admin.district.name')); ?></th>
				<th width="150"><?php echo e(trans('admin.district.parent')); ?></th>
				<th width="100"><?php echo e(trans('admin.district.children')); ?></th>
				<th width="100"><?php echo e(trans('admin.operation')); ?></th>
			</tr>
			<?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><input class="ids" type="checkbox" value="<?php echo e($district->id); ?>" name="ids[]"></td>
				<td><?php echo e($district->id); ?></td>
				<td><input type="text" class="txt" name="displayorder[<?php echo e($district->id); ?>]" value="<?php echo e($district->displayorder); ?>" size="2"></td>
				<td><input type="text" class="txt" name="name[<?php echo e($district->id); ?>]" value="<?php echo e($district->name); ?>"></td>
				<td><?php echo e($district->upid ? $district->parent->name : '/'); ?></td>
				<td><a href="<?php echo e(route('admin.district.index',['upid' =>$district->id])); ?>"><?php echo e(trans('admin.view')); ?>(<?php echo e(count($district->children)); ?>)</a></td>
				<td>
					<a href="<?php echo e(route('admin.district.edit',$district->id)); ?>" class="openwindow" title="<?php echo e(trans('admin.district.edit')); ?>"><?php echo e(trans('admin.edit')); ?></a>
					<a href="<?php echo e(route('admin.district.destroy',$district->id)); ?>" class="mlm delbtn"><?php echo e(trans('admin.destroy')); ?></a>
				</td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($districts) > 0): ?>
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