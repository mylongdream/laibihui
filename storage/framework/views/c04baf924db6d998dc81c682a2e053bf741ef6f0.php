<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.setting.nav')); ?></h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="<?php echo e(route('admin.setting.nav.batch')); ?>">
	<?php echo csrf_field(); ?>

	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.setting.nav.list')); ?></h3></div>
			<div class="y"><a href="<?php echo e(route('admin.setting.nav.create')); ?>" class="btn openwindow" title="<?php echo e(trans('admin.setting.nav.create')); ?>">+ <?php echo e(trans('admin.setting.nav.create')); ?></a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="100"><?php echo e(trans('admin.displayorder')); ?></th>
				<th width="300"><?php echo e(trans('admin.setting.nav.title')); ?></th>
				<th><?php echo e(trans('admin.setting.nav.url')); ?></th>
				<th width="100"><?php echo e(trans('admin.operation')); ?></th>
			</tr>
			<?php $__currentLoopData = $navlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><input class="ids" type="checkbox" value="<?php echo e($nav->id); ?>" name="ids[]"></td>
				<td><?php echo str_repeat('<div class="childnode">',$nav->count-1); ?><input type="text" class="txt" name="displayorder[<?php echo e($nav->id); ?>]" value="<?php echo e($nav->displayorder); ?>" style="width:40px"><?php echo str_repeat('</div>',$nav->count-1); ?></td>
				<td><?php echo str_repeat('<div class="childnode">',$nav->count-1); ?><input type="text" class="txt" name="title[<?php echo e($nav->id); ?>]" value="<?php echo e($nav->title); ?>"><?php echo str_repeat('</div>',$nav->count-1); ?></td>
				<td><?php echo e($nav->url ? url($nav->url) : '/'); ?></td>
				<td>
					<a href="<?php echo e(route('admin.setting.nav.edit',$nav->id)); ?>" class="openwindow" title="<?php echo e(trans('admin.setting.nav.edit')); ?>"><?php echo e(trans('admin.edit')); ?></a>
					<a href="<?php echo e(route('admin.setting.nav.destroy',$nav->id)); ?>" class="mlm delbtn"><?php echo e(trans('admin.destroy')); ?></a>
				</td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($navlist) > 0): ?>
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