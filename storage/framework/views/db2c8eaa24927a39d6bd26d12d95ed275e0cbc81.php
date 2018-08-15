<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.setting.watermark')); ?></h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('admin.setting.watermark.update')); ?>">
		<?php echo method_field('PUT'); ?>

		<?php echo csrf_field(); ?>

		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z">
					<h3><?php echo e(trans('admin.setting.watermark')); ?></h3>
				</div>
			</div>
			<table>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.setting.watermark.minwidthheight')); ?></td>
					<td><input class="txt mrm" type="text" size="20" value="<?php echo e(isset($setting['watermark_minwidth']) ? $setting['watermark_minwidth'] : '0'); ?>" name="setting[watermark_minwidth]"> X <input class="txt mlm" type="text" size="20" value="<?php echo e(isset($setting['watermark_minheight']) ? $setting['watermark_minheight'] : '0'); ?>" name="setting[watermark_minheight]"></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.setting.watermark.trans')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['watermark_trans']) ? $setting['watermark_trans'] : '0'); ?>" name="setting[watermark_trans]"></td>
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