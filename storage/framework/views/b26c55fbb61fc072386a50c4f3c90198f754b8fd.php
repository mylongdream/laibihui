<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('user.profile')); ?></h3></div>
	</div>
	<div class="mtw">
		<div class="tbedit">
			<form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('user.profile.update')); ?>">
				<?php echo method_field('PUT'); ?>

				<?php echo csrf_field(); ?>

				<table>
					<tr>
						<td width="150" align="right"><?php echo e(trans('user.profile.username')); ?></td>
						<td><?php echo e(auth()->user()->username); ?></td>
					</tr>
					<tr>
						<td align="right"><?php echo e(trans('user.profile.mobile')); ?></td>
						<td><?php echo e(auth()->user()->mobile); ?> <a href="<?php echo e(route('user.profile.mobile')); ?>">修改</a></td>
					</tr>
					<tr>
						<td align="right"><?php echo e(trans('user.profile.realname')); ?></td>
						<td><input class="input" type="text" size="50" value="<?php echo e($profile->realname); ?>" name="realname"></td>
					</tr>
					<tr>
						<td align="right"><?php echo e(trans('user.profile.email')); ?></td>
						<td><input class="input" type="text" size="50" value="<?php echo e($profile->email); ?>" name="email"></td>
					</tr>
					<tr>
						<td align="right"><?php echo e(trans('user.profile.gender')); ?></td>
						<td>
                            <label class="radio" for="gender_0"><input value="0" name="gender" id="gender_0" type="radio" <?php echo e($profile->gender == 0 ? 'checked' : ''); ?>>保密</label>
                            <label class="radio" for="gender_1"><input value="1" name="gender" id="gender_1" type="radio" <?php echo e($profile->gender == 1 ? 'checked' : ''); ?>>男</label>
                            <label class="radio" for="gender_2"><input value="2" name="gender" id="gender_2" type="radio" <?php echo e($profile->gender == 2 ? 'checked' : ''); ?>>女</label>
                        </td>
					</tr>
					<tr>
						<td align="right"><?php echo e(trans('user.profile.birthday')); ?></td>
						<td><input id="birthday" class="input" type="text" size="50" value="<?php echo e($profile->birthday ? $profile->birthday->format('Y-m-d') : ''); ?>" name="birthday" onclick="laydate({max: laydate.now(-1),format:'YYYY-MM-DD'})"></td>
					</tr>
					<tr>
						<td align="right"><?php echo e(trans('user.profile.workarea')); ?></td>
						<td>
							<div id="workarea_city">
								<select class="select prov" name="workprovince"></select>
								<select class="select city" name="workcity"></select>
								<select class="select dist" name="workarea"></select>
								<select class="select street" name="workstreet"></select>
							</div>
						</td>
					</tr>
					<tr>
						<td align="right"><?php echo e(trans('user.profile.marry')); ?></td>
						<td>
							<label class="radio" for="marry_1"><input value="单身" name="marry" id="marry_1" type="radio" <?php echo e($profile->marry == "单身" ? 'checked' : ''); ?>>单身</label>
							<label class="radio" for="marry_2"><input value="已婚" name="marry" id="marry_2" type="radio" <?php echo e($profile->marry == "已婚" ? 'checked' : ''); ?>>已婚</label>
						</td>
					</tr>
					<tr>
						<td align="right"><?php echo e(trans('user.profile.hobby')); ?></td>
						<td><input class="input" type="text" size="50" value="<?php echo e($profile->hobby); ?>" name="hobby"></td>
					</tr>
					<tr>
						<td align="right"><?php echo e(trans('user.profile.stage')); ?></td>
						<td>
							<label class="radio" for="stage_1"><input value="少年" name="stage" id="stage_1" type="radio" <?php echo e($profile->stage == "少年" ? 'checked' : ''); ?>>少年</label>
							<label class="radio" for="stage_2"><input value="青年" name="stage" id="stage_2" type="radio" <?php echo e($profile->stage == "青年" ? 'checked' : ''); ?>>青年</label>
							<label class="radio" for="stage_3"><input value="中年" name="stage" id="stage_3" type="radio" <?php echo e($profile->stage == "中年" ? 'checked' : ''); ?>>中年</label>
							<label class="radio" for="stage_4"><input value="老年" name="stage" id="stage_4" type="radio" <?php echo e($profile->stage == "老年" ? 'checked' : ''); ?>>老年</label>
						</td>
					</tr>
					<tr>
						<td align="right"><?php echo e(trans('user.profile.occupation')); ?></td>
						<td><input class="input" type="text" size="50" value="<?php echo e($profile->occupation); ?>" name="occupation"></td>
					</tr>
					<tr>
						<td align="right"></td>
                        <td><button value="true" name="savesubmit" type="submit" class="button">修 改</button></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
	<script type="text/javascript" src="<?php echo e(asset('static/js/laydate/laydate.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('static/js/jquery.cityselect.js')); ?>"></script>
	<script type="text/javascript">
        $("#workarea_city").citySelect({
            url:"<?php echo e(route('util.district')); ?>",
            required:false,
            prov:"<?php echo e($profile->workprovince); ?>",
            city:"<?php echo e($profile->workcity); ?>",
            dist:"<?php echo e($profile->workarea); ?>",
            street:"<?php echo e($profile->workstreet); ?>"
        });
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>