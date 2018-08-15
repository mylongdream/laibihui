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
					<td width="150" align="right"><?php echo e(trans('admin.user.user.group')); ?></td>
					<td>
						<select name="group_id" class="select">
							<option value="0">请选择</option>
							<?php $__currentLoopData = $grouplist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($group->id); ?>" <?php echo $user->group_id == $group->id ? 'selected="selected"' : ''; ?>><?php echo e($group->name); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.user.user.username')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($user->username); ?>" name="username"></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.user.user.password')); ?></td>
					<td><input class="txt" type="password" size="50" value="" name="password"><span class="tdtip">不填则不修改原密码</span></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.user.user.mobile')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($user->mobile); ?>" name="mobile"></td>
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