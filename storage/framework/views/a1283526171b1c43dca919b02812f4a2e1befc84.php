<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.setting.mobile')); ?></h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('admin.setting.mobile.update')); ?>">
		<?php echo method_field('PUT'); ?>

		<?php echo csrf_field(); ?>

		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z">
					<ul class="tb-tab">
						<li class="current"><span><?php echo e(trans('admin.info_base')); ?></span></li>
						<li><span><?php echo e(trans('admin.info_seo')); ?></span></li>
					</ul>
				</div>
			</div>
			<table>
				<tbody class="tb-body">
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.setting.mobile.bbname')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['mobile_bbname']) ? $setting['mobile_bbname'] : ''); ?>" name="setting[mobile_bbname]"></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.setting.mobile.url')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['mobile_url']) ? $setting['mobile_url'] : ''); ?>" name="setting[mobile_url]"></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.setting.mobile.forward')); ?></td>
					<td>
						<label class="radio" for="forward_1">
							<input id="forward_1" type="radio" name="setting[mobile_forward]" value="1" <?php echo e(isset($setting['mobile_forward'])&&$setting['mobile_forward'] ? 'checked' : ''); ?>> <?php echo e(trans('admin.yes')); ?>

						</label>
						<label class="radio" for="forward_0">
							<input id="forward_0" type="radio" name="setting[mobile_forward]" value="0" <?php echo e(isset($setting['mobile_forward'])&&$setting['mobile_forward'] ? '' : 'checked'); ?>> <?php echo e(trans('admin.no')); ?>

						</label>
					</td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.setting.mobile.bbclosed')); ?></td>
					<td>
						<label class="radio" for="bbclosed_1">
							<input id="bbclosed_1" type="radio" name="setting[mobile_bbclosed]" value="1" <?php echo e(isset($setting['mobile_bbclosed'])&&$setting['mobile_bbclosed'] ? 'checked' : ''); ?>> <?php echo e(trans('admin.yes')); ?>

						</label>
						<label class="radio" for="bbclosed_0">
							<input id="bbclosed_0" type="radio" name="setting[mobile_bbclosed]" value="0" <?php echo e(isset($setting['mobile_bbclosed'])&&$setting['mobile_bbclosed'] ? '' : 'checked'); ?>> <?php echo e(trans('admin.no')); ?>

						</label>
					</td>
				</tr>
				</tbody>
				<tbody class="tb-body hidden">
				<tr>
					<td width="150" align="right">seo_title</td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['mobile_seo_title']) ? $setting['mobile_seo_title'] : ''); ?>" name="setting[mobile_seo_title]"></td>
				</tr>
				<tr>
					<td width="150" align="right">seo_keywords</td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['mobile_seo_keywords']) ? $setting['mobile_seo_keywords'] : ''); ?>" name="setting[mobile_seo_keywords]"></td>
				</tr>
				<tr>
					<td width="150" align="right">seo_description</td>
					<td><textarea class="textarea" name="setting[mobile_seo_description]" cols="60" rows="5"><?php echo e(isset($setting['mobile_seo_description']) ? $setting['mobile_seo_description'] : ''); ?></textarea></td>
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