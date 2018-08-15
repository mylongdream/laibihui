<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.brand.shop')); ?></h3></div>
		<ul class="tab">
			<li><a href="<?php echo e(route('admin.brand.shop.index')); ?>"><span><?php echo e(trans('admin.brand.shop.list')); ?></span></a></li>
			<li class="current"><a href="<?php echo e(route('admin.brand.shop.recycle')); ?>"><span><?php echo e(trans('admin.recycle')); ?></span></a></li>
		</ul>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="<?php echo e(route('admin.brand.shop.recycle')); ?>">
	<div class="tbsearch">
		<dl>
			<dt><?php echo e(trans('admin.brand.shop.name')); ?></dt>
			<dd><input type="text" name="name" class="schtxt" value="<?php echo e(request('name')); ?>"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit"><?php echo e(trans('admin.search')); ?></button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="<?php echo e(route('admin.brand.shop.batch')); ?>">
	<?php echo csrf_field(); ?>

	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.brand.shop.list')); ?></h3></div>
		</div>
		<table>
			<tr>
				<th width="40"><?php echo e(trans('admin.id')); ?></th>
				<th width="180"><?php echo e(trans('admin.brand.shop.name')); ?></th>
				<th><?php echo e(trans('admin.brand.shop.address')); ?></th>
				<th width="60"><?php echo e(trans('admin.brand.shop.discount')); ?></th>
				<th width="60"><?php echo e(trans('admin.brand.shop.viewnum')); ?></th>
				<th width="90"><?php echo e(trans('admin.brand.shop.subweb')); ?></th>
				<th width="120"><?php echo e(trans('admin.created_at')); ?></th>
				<th width="120"><?php echo e(trans('admin.deleted_at')); ?></th>
				<th width="50"><?php echo e(trans('admin.operation')); ?></th>
			</tr>
			<?php $__currentLoopData = $shops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><?php echo e($shop->id); ?></td>
				<td><?php echo e($shop->name); ?></td>
				<td><?php echo e(isset($shop->address) ? $shop->address : '/'); ?></td>
				<td><?php echo e($shop->discount); ?> 折</td>
				<td><?php echo e($shop->viewnum); ?> 次</td>
				<td><?php echo e(isset($shop->subweb->name) ? $shop->subweb->name : '/'); ?></td>
				<td><?php echo e($shop->created_at->format('Y-m-d H:i')); ?></td>
				<td><?php echo e($shop->deleted_at->format('Y-m-d H:i')); ?></td>
				<td>
					<a href="<?php echo e(route('admin.brand.shop.restore',$shop->id)); ?>" class="restorebtn" title="<?php echo e(trans('admin.brand.shop.restore')); ?>"><?php echo e(trans('admin.restore')); ?></a>
				</td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($shops) > 0): ?>
	<div class="pgs cl">
		<div class="page y">
			<?php echo $shops->appends(['name' => request('name')])->links(); ?>

		</div>
    </div>
	<?php endif; ?>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>