<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.crm.user')); ?></h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="<?php echo e(route('admin.crm.user.batch')); ?>">
	<?php echo csrf_field(); ?>

	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.crm.user.list')); ?></h3></div>
			<div class="y"><a href="<?php echo e(route('admin.crm.user.create')); ?>" class="btn openwindow" title="<?php echo e(trans('admin.crm.user.create')); ?>">+ <?php echo e(trans('admin.crm.user.create')); ?></a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="120"><?php echo e(trans('admin.crm.user.realname')); ?></th>
				<th width="150"><?php echo e(trans('admin.crm.user.mobile')); ?></th>
				<th width="150"><?php echo e(trans('admin.crm.user.qq')); ?></th>
				<th><?php echo e(trans('admin.crm.user.group')); ?></th>
				<th width="150"><?php echo e(trans('admin.crm.user.lastlogin')); ?></th>
				<th width="100"><?php echo e(trans('admin.operation')); ?></th>
			</tr>
			<?php $__currentLoopData = $userlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><input class="ids" type="checkbox" value="<?php echo e($user->uid); ?>" name="ids[]"></td>
				<td><?php echo e($user->realname); ?></td>
				<td><?php echo e($user->mobile); ?></td>
				<td><?php echo e($user->qq ? $user->qq : '/'); ?></td>
				<td><?php echo e(config('crm.group.'.$user->group.'.name')); ?><?php echo e($user->group == 'shangjia' ? '（'.($user->shop ? $user->shop->name : '/').'）' : ''); ?></td>
				<td><?php echo e($user->lastlogin ? $user->lastlogin->format('Y-m-d H:i') : '/'); ?></td>
				<td>
					<a href="<?php echo e(route('admin.crm.user.edit',$user->uid)); ?>" class="openwindow" title="<?php echo e(trans('admin.crm.user.edit')); ?>"><?php echo e(trans('admin.edit')); ?></a>
					<a href="<?php echo e(route('admin.crm.user.destroy',$user->uid)); ?>" class="mlm delbtn"><?php echo e(trans('admin.destroy')); ?></a>
				</td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($userlist) > 0): ?>
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit"><?php echo e(trans('admin.destroy')); ?></button>
		</div>
    </div>
	<?php endif; ?>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>