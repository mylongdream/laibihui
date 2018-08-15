<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.brand.category')); ?></h3></div>
	</div>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="<?php echo e(route('admin.brand.category.batch')); ?>">
	<?php echo csrf_field(); ?>

	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.brand.category.list')); ?></h3></div>
			<div class="y"><a href="<?php echo e(route('admin.brand.category.create')); ?>" class="btn openwindow" title="<?php echo e(trans('admin.brand.category.create')); ?>">+ <?php echo e(trans('admin.brand.category.create')); ?></a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="100"><?php echo e(trans('admin.displayorder')); ?></th>
				<th width="300"><?php echo e(trans('admin.brand.category.name')); ?></th>
				<th><?php echo e(trans('admin.brand.category.description')); ?></th>
				<th width="100"><?php echo e(trans('admin.brand.shop')); ?></th>
				<th width="120"><?php echo e(trans('admin.operation')); ?></th>
			</tr>
			<?php $__currentLoopData = $categorylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><input class="ids" type="checkbox" value="<?php echo e($category->id); ?>" name="ids[]"></td>
				<td><?php echo str_repeat('<div class="childnode">',$category->count-1); ?><input type="text" class="txt" name="displayorder[<?php echo e($category->id); ?>]" value="<?php echo e($category->displayorder); ?>" style="width:40px"><?php echo str_repeat('</div>',$category->count-1); ?></td>
				<td><?php echo str_repeat('<div class="childnode">',$category->count-1); ?><input type="text" class="txt" name="name[<?php echo e($category->id); ?>]" value="<?php echo e($category->name); ?>"><?php echo str_repeat('</div>',$category->count-1); ?></td>
				<td><?php echo e($category->description ? $category->description : '/'); ?></td>
				<td><a href="<?php echo e(route('admin.brand.shop.index',['catid' => $category->id])); ?>"><?php echo e(count($category->shoplist)); ?></a></td>
				<td>
                    <a href="<?php echo e(route('admin.brand.category.move',$category->id)); ?>" class="openwindow" title="<?php echo e(trans('admin.brand.category.move')); ?>"><?php echo e(trans('admin.move')); ?></a>
					<a href="<?php echo e(route('admin.brand.category.edit',$category->id)); ?>" class="mlm openwindow" title="<?php echo e(trans('admin.brand.category.edit')); ?>"><?php echo e(trans('admin.edit')); ?></a>
					<a href="<?php echo e(route('admin.brand.category.destroy',$category->id)); ?>" class="mlm delbtn"><?php echo e(trans('admin.destroy')); ?></a>
				</td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($categorylist) > 0): ?>
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit"><?php echo e(trans('admin.destroy')); ?></button>
			<button class="submitbtn" name="updatesubmit" value="yes" type="submit"><?php echo e(trans('admin.update')); ?></button>
		</div>
    </div>
	<?php endif; ?>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>