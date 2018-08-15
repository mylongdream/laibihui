<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.setting.wechat')); ?></h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('admin.setting.wechat.update')); ?>">
		<?php echo method_field('PUT'); ?>

		<?php echo csrf_field(); ?>

		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z">
					<h3><?php echo e(trans('admin.setting.wechat')); ?></h3>
				</div>
			</div>
			<table>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.setting.wechat.name')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['wechat_name']) ? $setting['wechat_name'] : ''); ?>" name="setting[wechat_name]"></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.setting.wechat.id')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['wechat_id']) ? $setting['wechat_id'] : ''); ?>" name="setting[wechat_id]"></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.setting.wechat.originid')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['wechat_originid']) ? $setting['wechat_originid'] : ''); ?>" name="setting[wechat_originid]"></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.setting.wechat.followurl')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['wechat_followurl']) ? $setting['wechat_followurl'] : ''); ?>" name="setting[wechat_followurl]"></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.setting.wechat.qrcode')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['wechat_qrcode']) ? $setting['wechat_qrcode'] : ''); ?>" name="setting[wechat_qrcode]"></td>
				</tr>
				<tr>
					<td colspan="2" class="partition"><strong>开发者ID</strong> (如果您希望设置微信自定义菜单并拥有公众号“开发者 ID”，请把该信息填写此栏目中)</td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.setting.wechat.appid')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['wechat_appid']) ? $setting['wechat_appid'] : ''); ?>" name="setting[wechat_appid]"></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.setting.wechat.appsecret')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['wechat_appsecret']) ? $setting['wechat_appsecret'] : ''); ?>" name="setting[wechat_appsecret]"></td>
				</tr>
				<tr>
					<td colspan="2" class="partition"><strong>微信支付</strong> (如果您希望使用微信支付等功能，请把该信息填写此栏目中)</td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.setting.wechat.mchid')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['wechat_mchid']) ? $setting['wechat_mchid'] : ''); ?>" name="setting[wechat_mchid]"></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.setting.wechat.apikey')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['wechat_apikey']) ? $setting['wechat_apikey'] : ''); ?>" name="setting[wechat_apikey]"></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.setting.wechat.certpath')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['wechat_certpath']) ? $setting['wechat_certpath'] : ''); ?>" name="setting[wechat_certpath]"></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.setting.wechat.keypath')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['wechat_keypath']) ? $setting['wechat_keypath'] : ''); ?>" name="setting[wechat_keypath]"></td>
				</tr>
				<tr>
					<td colspan="2" class="partition"><strong>服务器配置</strong> (如果您希望使用微信关键词回复等功能，请把此栏中的内容填写到微信公众平台“开发者中心”设置中)</td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.setting.wechat.serverurl')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['wechat_serverurl']) ? $setting['wechat_serverurl'] : ''); ?>" name="setting[wechat_serverurl]"></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.setting.wechat.token')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['wechat_token']) ? $setting['wechat_token'] : ''); ?>" name="setting[wechat_token]"></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.setting.wechat.encodingaeskey')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['wechat_encodingaeskey']) ? $setting['wechat_encodingaeskey'] : ''); ?>" name="setting[wechat_encodingaeskey]"></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.setting.wechat.encrypttype')); ?></td>
					<td>
                        <label class="radio" for="encrypttype_0">
                            <input id="encrypttype_0" name="setting[wechat_encrypttype]" value="0" type="radio" <?php echo e(isset($setting['wechat_encrypttype'])&&$setting['wechat_encrypttype'] ? '' : 'checked'); ?>>
                            <?php echo e(trans('admin.setting.wechat.encrypttype_0')); ?>

                        </label>
                        <label class="radio" for="encrypttype_1">
                            <input id="encrypttype_1" name="setting[wechat_encrypttype]" value="1" type="radio" <?php echo e(isset($setting['wechat_encrypttype'])&&$setting['wechat_encrypttype']==1 ? 'checked' : ''); ?>>
                            <?php echo e(trans('admin.setting.wechat.encrypttype_1')); ?>

                        </label>
                        <label class="radio" for="encrypttype_2">
                            <input id="encrypttype_2" name="setting[wechat_encrypttype]" value="2" type="radio" <?php echo e(isset($setting['wechat_encrypttype'])&&$setting['wechat_encrypttype']==2 ? 'checked' : ''); ?>>
                            <?php echo e(trans('admin.setting.wechat.encrypttype_2')); ?>

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