<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<?php if(auth()->user()->mobile): ?>
			<div class="title"><h3>修改手机号</h3></div>
		<?php else: ?>
			<div class="title"><h3>绑定手机号</h3></div>
		<?php endif; ?>
	</div>
	<div class="mtw">
		<div class="tbedit">
			<form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('user.profile.mobile')); ?>">
				<?php echo csrf_field(); ?>

				<table>
					<tr>
						<td width="150" align="right"><?php echo e(trans('user.profile.mobile')); ?></td>
						<td>
							<input id="form-mobile" type="text" name="mobile" class="input">
						</td>
					</tr>
					<tr>
						<td width="150" align="right">验证码</td>
						<td>
							<input id="form-smscode" type="text" name="smscode" class="input verify">
							<input type="hidden" name="mobilerule" value="register">
							<button id="getsmscode" class="verify-btn getsmscode-reg" name="verify-btn" type="button">发送验证码</button>
						</td>
					</tr>
					<tr>
						<td align="right"></td>
                        <td><button value="true" name="savesubmit" type="submit" class="button">提 交</button></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
	<script type="text/javascript" src="<?php echo e(asset('static/js/jquery.smscode.js')); ?>"></script>
	<script type="text/javascript">
        $(function(){
            $("#getsmscode").sms({
                requestUrl:"<?php echo e(route('util.smscode')); ?>",
                callerror: function (data) {
                    $.jBox.tip(data, 'error');
                }
            });
        });
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>