<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.crm.archive')); ?></h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="<?php echo e(route('admin.crm.archive.batch')); ?>">
	<?php echo csrf_field(); ?>

	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.crm.archive.list')); ?></h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="120"><?php echo e(trans('admin.crm.archive.user')); ?></th>
				<th><?php echo e(trans('admin.crm.archive.shop')); ?></th>
				<th width="120"><?php echo e(trans('admin.crm.archive.created_at')); ?></th>
				<th width="150"><?php echo e(trans('admin.crm.archive.status')); ?></th>
				<th width="100"><?php echo e(trans('admin.operation')); ?></th>
			</tr>
			<?php $__currentLoopData = $archivelist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><input class="ids" type="checkbox" value="<?php echo e($value->id); ?>" name="ids[]"></td>
				<td><?php echo e($value->user ? $value->user->realname : '/'); ?></td>
				<td><?php echo e($value->shop ? $value->shop->name : '/'); ?></td>
				<td><?php echo e($value->created_at->format('Y-m-d H:i')); ?></td>
				<td>
					<?php if($value->status == 0): ?>
						<a href="<?php echo e(route('admin.crm.archive.edit',$value->id)); ?>" class="openwindow" title="审核">点击审核</a>
                        <?php else: ?>
                        <?php echo e(trans('admin.crm.archive.status_'.$value->status)); ?>

					<?php endif; ?>
				</td>
				<td>
					<a href="<?php echo e(route('admin.crm.archive.show',$value->id)); ?>" class=""><?php echo e(trans('admin.view')); ?></a>
					<a href="<?php echo e(route('admin.crm.archive.destroy',$value->id)); ?>" class="mlm delbtn"><?php echo e(trans('admin.destroy')); ?></a>
				</td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($archivelist) > 0): ?>
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit"><?php echo e(trans('admin.destroy')); ?></button>
		</div>
    </div>
	<?php endif; ?>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>