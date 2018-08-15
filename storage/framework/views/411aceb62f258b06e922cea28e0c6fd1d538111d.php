<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.extend.card')); ?></h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('admin.extend.card.export')); ?>">
		<?php echo csrf_field(); ?>

		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3><?php echo e(trans('admin.extend.card.export')); ?></h3></div>
				<div class="y"><a href="<?php echo e(route('admin.extend.card.index')); ?>" class="btn">< <?php echo e(trans('admin.extend.card.list')); ?></a></div>
			</div>
			<table>
                <tr>
                    <td width="150" align="right"><?php echo e(trans('admin.extend.card.ifbind')); ?></td>
                    <td>
                        <select class="select" name="bind">
                            <option value="0">未绑定</option>
                            <option value="1">已绑定</option>
							<option value="2">被分配</option>
                        </select>
                    </td>
                </tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.extend.card.prefix')); ?></td>
					<td><input class="txt" type="text" size="30" value="" name="prefix"><span class="tdtip">可以填写如区号：0571</span></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.extend.card.count')); ?></td>
					<td><input class="txt" type="text" size="30" value="1" name="count"><span class="tdtip">最多可以导出10000张</span></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="批量导出" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>