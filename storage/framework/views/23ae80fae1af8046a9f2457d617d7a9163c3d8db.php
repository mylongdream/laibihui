<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.admin.menu')); ?></h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="<?php echo e(route('admin.admin.menu.batch')); ?>">
	<?php echo csrf_field(); ?>

	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.admin.menu.list')); ?></h3></div>
			<div class="y"><a href="<?php echo e(route('admin.admin.menu.create')); ?>" class="btn openwindow" title="<?php echo e(trans('admin.admin.menu.create')); ?>">+ <?php echo e(trans('admin.admin.menu.create')); ?></a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="100"><?php echo e(trans('admin.displayorder')); ?></th>
				<th width="300"><?php echo e(trans('admin.admin.menu.title')); ?></th>
				<th><?php echo e(trans('admin.admin.menu.url')); ?></th>
				<th width="100"><?php echo e(trans('admin.operation')); ?></th>
			</tr>
			<?php $__currentLoopData = $menulist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><input class="ids" type="checkbox" value="<?php echo e($menu->id); ?>" name="ids[]"></td>
				<td><?php echo str_repeat('<div class="childnode">',$menu->count-1); ?><input type="text" class="txt" name="displayorder[<?php echo e($menu->id); ?>]" value="<?php echo e($menu->displayorder); ?>" style="width:40px"><?php echo str_repeat('</div>',$menu->count-1); ?></td>
				<td><?php echo str_repeat('<div class="childnode">',$menu->count-1); ?><input type="text" class="txt" name="title[<?php echo e($menu->id); ?>]" value="<?php echo e($menu->title); ?>"><?php echo str_repeat('</div>',$menu->count-1); ?></td>
				<td><?php echo e($menu->route ? route($menu->route) : '/'); ?></td>
				<td>
					<a href="<?php echo e(route('admin.admin.menu.edit',$menu->id)); ?>" class="openwindow" title="<?php echo e(trans('admin.admin.menu.edit')); ?>"><?php echo e(trans('admin.edit')); ?></a>
					<a href="<?php echo e(route('admin.admin.menu.destroy',$menu->id)); ?>" class="mlm delbtn"><?php echo e(trans('admin.destroy')); ?></a>
				</td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($menulist) > 0): ?>
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