<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.brand.shop')); ?></h3></div>
		<ul class="tab">
			<li class="current"><a href="<?php echo e(route('admin.brand.shop.index')); ?>"><span><?php echo e(trans('admin.brand.shop.list')); ?></span></a></li>
			<li><a href="<?php echo e(route('admin.brand.shop.recycle')); ?>"><span><?php echo e(trans('admin.recycle')); ?></span></a></li>
		</ul>
	</div>
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.brand.shop.qrcode')); ?></h3></div>
				<div class="y"><a href="<?php echo e(route('admin.brand.shop.index')); ?>" class="btn">< <?php echo e(trans('admin.brand.shop.list')); ?></a></div>
		</div>
		<table>
			<tr>
				<th width="30%"><?php echo e(trans('admin.brand.shop.name')); ?></th>
				<th><?php echo e(trans('admin.brand.shop.address')); ?></th>
				<th width="20%">相距距离</th>
			</tr>
			<?php $__currentLoopData = $shops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><a href="<?php echo e(route('brand.shop.show',$value->id)); ?>" target="_blank"><?php echo e($value->name); ?></a></td>
					<td><?php echo e($value->address); ?></td>
					<td><?php echo e(number_format($value->distance)); ?> 米</td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>