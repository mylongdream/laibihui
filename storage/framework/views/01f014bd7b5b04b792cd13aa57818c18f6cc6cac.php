<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.wechat.menu')); ?></h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('admin.wechat.menu.store')); ?>">
		<?php echo csrf_field(); ?>

		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3><?php echo e(trans('admin.wechat.menu.create')); ?></h3></div>
				<div class="y"><a href="<?php echo e(route('admin.wechat.menu.index')); ?>" class="btn">< <?php echo e(trans('admin.wechat.menu.list')); ?></a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.wechat.menu.parentid')); ?></td>
					<td>
						<select id="parentid" class="select" name="parentid">
							<option value="">请选择上级菜单</option>
							<?php $__currentLoopData = $menulist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($value->id); ?>"><?php echo e(str_repeat('->',$value->count-1)); ?><?php echo e($value->name); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.wechat.menu.name')); ?></td>
					<td><input class="txt" type="text" size="50" value="" name="name"></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.wechat.menu.type')); ?></td>
					<td>
						<select name="type" class="select typeselect">
							<option value="">请选择菜单类型</option>
							<?php $__currentLoopData = $menutype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</td>
				</tr>
				<tbody class="typesub" id="type_click" style="display:none">
				<tr>
					<td align="right">关键字</td>
					<td>
						<input class="txt" type="text" size="50" value="" name="message[click][key]">
					</td>
				</tr>
				</tbody>
				<tbody class="typesub" id="type_view" style="display:none">
				<tr>
					<td align="right">链接网址</td>
					<td>
						<input class="txt" type="text" size="50" value="" name="message[view][url]">
					</td>
				</tr>
				</tbody>
				<tbody class="typesub" id="type_miniprogram" style="display:none">
				<tr>
					<td align="right">链接网址</td>
					<td>
						<input class="txt" type="text" size="50" value="" name="message[miniprogram][url]"><span class="tdtip">老版本客户端将打开本url</span>
					</td>
				</tr>
				<tr>
					<td align="right">小程序appid</td>
					<td>
						<input class="txt" type="text" size="50" value="" name="message[miniprogram][appid]">
					</td>
				</tr>
				<tr>
					<td align="right">小程序页面路径</td>
					<td>
						<input class="txt" type="text" size="50" value="" name="message[miniprogram][pagepath]"><span class="tdtip">如：pages/index/index</span>
					</td>
				</tr>
				</tbody>
				<tr>
					<td align="right">排序</td>
					<td><input class="txt" type="text" size="50" value="0" name="displayorder"></td>
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
        $(function() {
            $(".typeselect").change(function() {
                $('.typesub').hide();
                if($(this).val()){
                    $('#type_'+$(this).val()).show();
                }
            }).trigger("change");
        });
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>