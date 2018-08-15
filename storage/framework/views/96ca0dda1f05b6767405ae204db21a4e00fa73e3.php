<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.wechat.menu')); ?></h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="<?php echo e(route('admin.wechat.menu.batch')); ?>">
	<?php echo csrf_field(); ?>

	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.wechat.menu.list')); ?></h3></div>
			<div class="y">
				<a href="<?php echo e(route('admin.wechat.menu.create')); ?>" class="btn openwindow" title="<?php echo e(trans('admin.wechat.menu.create')); ?>">+ <?php echo e(trans('admin.wechat.menu.create')); ?></a>
				<a href="<?php echo e(route('admin.wechat.menu.publish')); ?>" class="btn" title="<?php echo e(trans('admin.wechat.menu.publish')); ?>"><?php echo e(trans('admin.wechat.menu.publish')); ?></a>
			</div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="100"><?php echo e(trans('admin.displayorder')); ?></th>
				<th width="250"><?php echo e(trans('admin.wechat.menu.name')); ?></th>
				<th width="200"><?php echo e(trans('admin.wechat.menu.type')); ?></th>
				<th><?php echo e(trans('admin.wechat.menu.message')); ?></th>
				<th width="80"><?php echo e(trans('admin.operation')); ?></th>
			</tr>
			<?php $__currentLoopData = $menulist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><input class="ids" type="checkbox" value="<?php echo e($value->id); ?>" name="ids[]"></td>
				<td><?php echo str_repeat('<div class="childnode">',$value->count-1); ?><input type="text" class="txt" name="displayorder[<?php echo e($value->id); ?>]" value="<?php echo e($value->displayorder); ?>" style="width:40px"><?php echo str_repeat('</div>',$value->count-1); ?></td>
				<td><?php echo str_repeat('<div class="childnode">',$value->count-1); ?><input type="text" class="txt" name="name[<?php echo e($value->id); ?>]" value="<?php echo e($value->name); ?>"><?php echo str_repeat('</div>',$value->count-1); ?></td>
				<td><?php echo e($value->type ? $menutype[$value->type] : '/'); ?></td>
				<td>
					<?php if($value->message): ?>
					<?php $__currentLoopData = unserialize($value->message); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<p><strong><?php echo e($k); ?>：</strong><?php echo e($val); ?></p>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php else: ?>
						/
					<?php endif; ?>
				</td>
				<td>
					<a href="<?php echo e(route('admin.wechat.menu.edit',$value->id)); ?>" class="openwindow" title="<?php echo e(trans('admin.wechat.menu.edit')); ?>"><?php echo e(trans('admin.edit')); ?></a>
					<a href="<?php echo e(route('admin.wechat.menu.destroy',$value->id)); ?>" class="mlm delbtn"><?php echo e(trans('admin.destroy')); ?></a>
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