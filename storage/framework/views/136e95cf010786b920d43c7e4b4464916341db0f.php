<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.farm.package')); ?></h3></div>
	</div>
	<div class="tbsearch">
		<dl>
			<dt><?php echo e(trans('admin.farm.farm.name')); ?></dt>
			<dd><span class="text"><?php echo e($farm ? $farm->name : ''); ?></span></dd>
		</dl>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="<?php echo e(route('admin.farm.package.batch', ['farm_id' => request('farm_id')])); ?>">
	<?php echo csrf_field(); ?>

	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.farm.package.list')); ?></h3></div>
			<div class="y"><a href="<?php echo e(route('admin.farm.package.create', ['farm_id' => request('farm_id')])); ?>" class="openwindow btn" title="<?php echo e(trans('admin.farm.package.create')); ?>">+ <?php echo e(trans('admin.farm.package.create')); ?></a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="80"><?php echo e(trans('admin.displayorder')); ?></th>
				<th><?php echo e(trans('admin.farm.farm.name')); ?></th>
				<th><?php echo e(trans('admin.farm.package.name')); ?></th>
				<th width="100"><?php echo e(trans('admin.farm.package.price')); ?></th>
				<th width="80"><?php echo e(trans('admin.farm.package.onsale')); ?></th>
				<th width="80"><?php echo e(trans('admin.operation')); ?></th>
			</tr>
			<?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><input class="ids" type="checkbox" value="<?php echo e($value->id); ?>" name="ids[]"></td>
				<td><input type="text" class="txt" name="displayorder[<?php echo e($value->id); ?>]" value="<?php echo e($value->displayorder); ?>" size="2"></td>
				<td><?php echo e($value->farm ? $value->farm->name : ''); ?></td>
				<td><?php echo e($value->name); ?></td>
				<td><?php echo e($value->price); ?> 元</td>
				<td><?php echo e($value->onsale ? trans('admin.yes') : trans('admin.no')); ?></td>
				<td>
					<a href="<?php echo e(route('admin.farm.package.edit', ['farm_id' => request('farm_id'), 'id' => $value->id])); ?>" class="openwindow" title="<?php echo e(trans('admin.farm.package.edit')); ?>"><?php echo e(trans('admin.edit')); ?></a>
					<a href="<?php echo e(route('admin.farm.package.destroy', ['farm_id' => request('farm_id'), 'id' => $value->id])); ?>" class="mlm delbtn"><?php echo e(trans('admin.destroy')); ?></a>
				</td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($packages) > 0): ?>
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit"><?php echo e(trans('admin.destroy')); ?></button>
			<button class="submitbtn" name="updatesubmit" value="yes" type="submit"><?php echo e(trans('admin.update')); ?></button>
		</div>
		<div class="page y">
			<?php echo $packages->appends(['name' => request('name')])->links(); ?>

		</div>
    </div>
	<?php endif; ?>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>