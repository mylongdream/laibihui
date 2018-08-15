<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.extend.faq')); ?></h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('admin.extend.faq.update', $faq->id)); ?>">
    	<input type="hidden" name="_method" value="PUT">
		<?php echo csrf_field(); ?>

		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3><?php echo e(trans('admin.extend.faq.list')); ?></h3></div>
				<div class="y"><a href="<?php echo e(route('admin.extend.faq.index')); ?>" class="btn">< <?php echo e(trans('admin.extend.faq.list')); ?></a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.extend.faq.catid')); ?></td>
					<td>
						<select name="catid" class="select">
							<option value="0">请选择</option>
							<?php $__currentLoopData = $faqcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($value->id); ?>" <?php echo e($faq->catid == $value->id ? 'selected' : ''); ?>><?php echo e($value->name); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.extend.faq.title')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($faq->title); ?>" name="title"></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.extend.faq.message')); ?></td>
					<td><textarea class="textarea" name="message" cols="60" rows="5"><?php echo e($faq->message); ?></textarea></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.displayorder')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($faq->displayorder); ?>" name="displayorder"></td>
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