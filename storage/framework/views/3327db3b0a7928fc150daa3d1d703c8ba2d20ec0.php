<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.brand.allot')); ?></h3></div>
	</div>
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.brand.allot.list')); ?></h3></div>
			<div class="y"><a href="<?php echo e(route('admin.brand.allot.create', ['shopid' => request('shopid')])); ?>" class="btn openwindow" title="<?php echo e(trans('admin.brand.allot.create')); ?>">+ <?php echo e(trans('admin.brand.allot.create')); ?></a></div>
		</div>
		<table>
			<tr>
				<th><?php echo e(trans('admin.brand.allot.shop')); ?></th>
				<th width="120"><?php echo e(trans('admin.brand.allot.cardlist')); ?></th>
				<th width="120"><?php echo e(trans('admin.brand.allot.quantity')); ?></th>
				<th width="90"><?php echo e(trans('admin.brand.allot.price')); ?></th>
				<th width="120"><?php echo e(trans('admin.created_at')); ?></th>
				<th width="90"><?php echo e(trans('admin.operation')); ?></th>
			</tr>
			<?php $__currentLoopData = $allots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><?php echo e($value->shop ? $value->shop->name : '/'); ?></td>
				<td><a href="<?php echo e(route('admin.brand.allot.cardlist', ['shopid' => request('shopid'), 'id' => $value->id])); ?>"><?php echo e($value->cardlist->count()); ?></a></td>
				<td><?php echo e($value->quantity); ?></td>
				<td><?php echo e($value->price); ?> 元</td>
				<td><?php echo e($value->created_at->format('Y-m-d H:i')); ?></td>
				<td>
					<a href="<?php echo e(route('admin.brand.allot.edit', ['shopid' => request('shopid'), 'id' => $value->id])); ?>" title="<?php echo e(trans('admin.brand.allot.edit')); ?>" class="openwindow"><?php echo e(trans('admin.edit')); ?></a>
					<a href="<?php echo e(route('admin.brand.allot.destroy', ['shopid' => request('shopid'), 'id' => $value->id])); ?>" class="mlm delbtn"><?php echo e(trans('admin.destroy')); ?></a>
				</td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($allots) > 0): ?>
	<div class="pgs cl">
		<div class="page y">
			<?php echo $allots->appends(['shopid' => request('shopid')])->appends(['name' => request('name')])->links(); ?>

		</div>
    </div>
	<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>