<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.farm.package')); ?></h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('admin.farm.package.update', ['farm_id' => request('farm_id'), 'id' => $package->id])); ?>">
		<?php echo method_field('PUT'); ?>

		<?php echo csrf_field(); ?>

		<div class="tbedit">
			<div class="tbhead cl">
                <div class="z"><h3><?php echo e(trans('admin.farm.package.edit')); ?></h3></div>
				<div class="y"><a href="<?php echo e(route('admin.farm.package.index', ['farm_id' => request('farm_id')])); ?>" class="btn">< <?php echo e(trans('admin.farm.package.list')); ?></a></div>
			</div>
			<table>
				<tbody class="tb-body">
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.farm.farm.name')); ?></td>
					<td><?php echo e($package->farm->name); ?><input type="hidden" name="farm_id" value="<?php echo e($package->farm->id); ?>" /></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.farm.package.name')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($package->name); ?>" name="name"></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.farm.package.price')); ?></td>
					<td><input class="txt" type="text" size="20" value="<?php echo e($package->price); ?>" name="price"> 元<span class="tdtip"></span></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.farm.package.onsale')); ?></td>
					<td>
						<label class="radio" for="onsale_1">
							<input id="onsale_1" type="radio" name="onsale" value="1" checked> <?php echo e(trans('admin.yes')); ?>

						</label>
						<label class="radio" for="onsale_0">
							<input id="onsale_0" type="radio" name="onsale" value="0"> <?php echo e(trans('admin.no')); ?>

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