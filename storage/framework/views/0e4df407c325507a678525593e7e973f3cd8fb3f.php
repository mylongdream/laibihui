<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.admin.menu')); ?></h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('admin.admin.menu.store')); ?>">
		<?php echo csrf_field(); ?>

		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3><?php echo e(trans('admin.admin.menu.create')); ?></h3></div>
				<div class="y"><a href="<?php echo e(route('admin.admin.menu.index')); ?>" class="btn">< <?php echo e(trans('admin.admin.menu.list')); ?></a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.admin.menu.parentid')); ?></td>
					<td>
						<select id="parentid" class="select" name="parentid">
							<option value="">请选择上级菜单</option>
							<?php $__currentLoopData = $menulist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $smenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($smenu->id); ?>"><?php echo e(str_repeat('->',$smenu->count-1)); ?><?php echo e($smenu->title); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.admin.menu.title')); ?></td>
					<td><input class="txt" type="text" size="50" value="" name="title"></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.admin.menu.route')); ?></td>
					<td><input class="txt" type="text" size="50" value="" name="route"></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.admin.menu.hidden')); ?></td>
					<td>
						<label class="radio" for="hidden_1">
							<input id="hidden_1" name="hidden" value="1" type="radio"> 是
						</label>
						<label class="radio" for="hidden_0">
							<input id="hidden_0" name="hidden" value="0" type="radio" checked="checked"> 否
						</label>
					</td>
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