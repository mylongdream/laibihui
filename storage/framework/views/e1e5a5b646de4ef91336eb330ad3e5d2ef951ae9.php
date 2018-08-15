<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.setting.basic')); ?></h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('admin.setting.basic.update')); ?>">
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
					<td width="150" align="right"><?php echo e(trans('admin.setting.basic.sitename')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['sitename']) ? $setting['sitename'] : ''); ?>" name="setting[sitename]"></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.setting.basic.siteurl')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['siteurl']) ? $setting['siteurl'] : ''); ?>" name="setting[siteurl]"></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.setting.basic.adminemail')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['adminemail']) ? $setting['adminemail'] : ''); ?>" name="setting[adminemail]"></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.setting.basic.site_tel')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['site_tel']) ? $setting['site_tel'] : ''); ?>" name="setting[site_tel]"></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.setting.basic.site_qq')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['site_qq']) ? $setting['site_qq'] : ''); ?>" name="setting[site_qq]"></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.setting.basic.icp')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['icp']) ? $setting['icp'] : ''); ?>" name="setting[icp]"></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.setting.basic.stat')); ?></td>
					<td><textarea class="textarea" name="setting[statcode]" cols="60" rows="5"><?php echo e(isset($setting['statcode']) ? $setting['statcode'] : ''); ?></textarea></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.setting.basic.bbclosed')); ?></td>
					<td>
						<label class="radio" for="bbclosed_1">
							<input id="bbclosed_1" type="radio" name="setting[bbclosed]" value="1" <?php echo e(isset($setting['bbclosed'])&&$setting['bbclosed'] ? 'checked' : ''); ?>> <?php echo e(trans('admin.yes')); ?>

						</label>
						<label class="radio" for="bbclosed_0">
							<input id="bbclosed_0" type="radio" name="setting[bbclosed]" value="0" <?php echo e(isset($setting['bbclosed'])&&$setting['bbclosed'] ? '' : 'checked'); ?>> <?php echo e(trans('admin.no')); ?>

						</label>
					</td>
				</tr>
				</tbody>
				<tbody class="tb-body hidden">
				<tr>
					<td width="150" align="right">seo_title</td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['seo_title']) ? $setting['seo_title'] : ''); ?>" name="setting[seo_title]"></td>
				</tr>
				<tr>
					<td width="150" align="right">seo_keywords</td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['seo_keywords']) ? $setting['seo_keywords'] : ''); ?>" name="setting[seo_keywords]"></td>
				</tr>
				<tr>
					<td width="150" align="right">seo_description</td>
					<td><textarea class="textarea" name="setting[seo_description]" cols="60" rows="5"><?php echo e(isset($setting['seo_description']) ? $setting['seo_description'] : ''); ?></textarea></td>
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