<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.user.user')); ?></h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('admin.user.user.update', $user->uid)); ?>">
		<?php echo method_field('PUT'); ?>

		<?php echo csrf_field(); ?>

		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3><?php echo e(trans('admin.user.user.edit')); ?></h3></div>
				<div class="y"><a href="<?php echo e(route('admin.user.user.index')); ?>" class="btn">< <?php echo e(trans('admin.user.user.list')); ?></a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.user.user.username')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($user->username); ?>" name="username"></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.user.user.password')); ?></td>
					<td><input class="txt" type="password" size="50" value="" name="password"><span class="tdtip">不填则不修改原密码</span></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.user.user.realname')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($user->realname); ?>" name="realname"></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.user.user.mobile')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($user->mobile); ?>" name="mobile"></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.user.user.qq')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($user->qq); ?>" name="qq"></td>
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