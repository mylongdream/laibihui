<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.brand.appoint')); ?></h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('admin.brand.appoint.update', $appoint->id)); ?>">
    	<input type="hidden" name="_method" value="PUT">
		<?php echo csrf_field(); ?>

		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3><?php echo e(trans('admin.brand.appoint.list')); ?></h3></div>
				<div class="y"><a href="<?php echo e(route('admin.brand.appoint.index')); ?>" class="btn">< <?php echo e(trans('admin.brand.appoint.list')); ?></a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.brand.appoint.order_sn')); ?></td>
					<td><?php echo e(isset($appoint->order_sn) ? $appoint->order_sn : '/'); ?></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.brand.appoint.realname')); ?></td>
					<td><?php echo e($appoint->realname); ?></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.brand.appoint.mobile')); ?></td>
					<td><?php echo e(isset($appoint->mobile) ? $appoint->mobile : '/'); ?></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.brand.appoint.number')); ?></td>
					<td><?php echo e(isset($appoint->number) ? $appoint->number : '0'); ?> 人</td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.brand.appoint.appoint_at')); ?></td>
					<td><?php echo e($appoint->appoint_at ? $appoint->appoint_at->format('Y-m-d H:i') : '/'); ?></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.brand.appoint.remark')); ?></td>
					<td><?php echo e(isset($appoint->remark) ? $appoint->remark : '/'); ?></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.brand.appoint.status')); ?></td>
					<td>
						<label class="radio" for="status_0" onclick="$('#result_box').hide()">
							<input id="status_0" type="radio" name="status" value="0" <?php echo e($appoint->status == 0 ? 'checked' : ''); ?>> <?php echo e(trans('admin.brand.appoint.status_0')); ?>

						</label>
						<label class="radio" for="status_1" onclick="$('#result_box').show()">
							<input id="status_1" type="radio" name="status" value="1" <?php echo e($appoint->status == 1 ? 'checked' : ''); ?>> <?php echo e(trans('admin.brand.appoint.status_1')); ?>

						</label>
						<label class="radio" for="status_2" onclick="$('#result_box').show()">
							<input id="status_2" type="radio" name="status" value="2" <?php echo e($appoint->status == 2 ? 'checked' : ''); ?>> <?php echo e(trans('admin.brand.appoint.status_2')); ?>

						</label>
						<label class="radio" for="status_3" onclick="$('#result_box').show()">
							<input id="status_3" type="radio" name="status" value="3" <?php echo e($appoint->status == 3 ? 'checked' : ''); ?>> <?php echo e(trans('admin.brand.appoint.status_3')); ?>

						</label>
					</td>
				</tr>
				<tbody id="result_box" class="<?php echo e($appoint->status == 0 ? 'hidden' : ''); ?>">
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.brand.appoint.reason')); ?></td>
					<td><textarea class="textarea" name="reason" cols="60" rows="4"><?php echo e($appoint->reason); ?></textarea></td>
				</tr>
				</tbody>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>