<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.crm.user')); ?></h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('admin.crm.user.update', $user->uid)); ?>">
		<?php echo method_field('PUT'); ?>

		<?php echo csrf_field(); ?>

		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3><?php echo e(trans('admin.crm.user.edit')); ?></h3></div>
				<div class="y"><a href="<?php echo e(route('admin.crm.user.index')); ?>" class="btn">< <?php echo e(trans('admin.crm.user.list')); ?></a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.crm.user.group')); ?></td>
					<td>
						<select name="group" class="select selectgroup">
							<option value="">请选择</option>
							<?php $__currentLoopData = $grouplist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($key); ?>" <?php echo $user->group == $key ? 'selected="selected"' : ''; ?>><?php echo e($value['name']); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</td>
				</tr>
				<tr class="shopmanage <?php echo $user->group == "shangjia" ? '' : 'hidden'; ?>">
					<td width="150" align="right"><?php echo e(trans('admin.crm.user.shop_id')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($user->shop_id); ?>" name="shop_id"></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.crm.user.realname')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($user->realname); ?>" name="realname"></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.crm.user.password')); ?></td>
					<td><input class="txt" type="password" size="50" value="" name="password"><span class="tdtip">不填则不修改原密码</span></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.crm.user.mobile')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($user->mobile); ?>" name="mobile"></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.crm.user.qq')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($user->qq); ?>" name="qq"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
	<script type="text/javascript">
        $(function(){
            $(document).on("change", ".selectgroup", function(){
                if($(this).val() == "shangjia"){
                    $(".shopmanage").show();
                }else{
                    $(".shopmanage").hide();
                }
            });
        });
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>