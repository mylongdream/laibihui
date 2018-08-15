<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.mall.product')); ?></h3></div>
		<ul class="tab">
			<li class="current"><a href="<?php echo e(route('admin.mall.product.index')); ?>"><span><?php echo e(trans('admin.mall.product.list')); ?></span></a></li>
			<li><a href="<?php echo e(route('admin.mall.product.recycle')); ?>"><span><?php echo e(trans('admin.recycle')); ?></span></a></li>
		</ul>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="<?php echo e(route('admin.mall.product.index')); ?>">
	<div class="tbsearch">
		<dl>
			<dt><?php echo e(trans('admin.mall.product.category')); ?></dt>
			<dd>
				<select class="schselect" name="catid">
					<option value="">请选择</option>
					<?php $__currentLoopData = $categorylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($scategory->id); ?>" <?php echo request('catid') == $scategory->id ? 'selected="selected"' : ''; ?>><?php echo e(str_repeat('->',$scategory->count-1)); ?><?php echo e($scategory->name); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
			</dd>
		</dl>
		<dl>
			<dt><?php echo e(trans('admin.mall.product.name')); ?></dt>
			<dd><input type="text" name="name" class="schtxt" value="<?php echo e(request('name')); ?>"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit"><?php echo e(trans('admin.search')); ?></button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="<?php echo e(route('admin.mall.product.batch')); ?>">
	<?php echo csrf_field(); ?>

	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.mall.product.list')); ?></h3></div>
			<div class="y"><a href="<?php echo e(route('admin.mall.product.create', ['shopid' => request('shopid')])); ?>" class="btn" title="<?php echo e(trans('admin.mall.product.create')); ?>">+ <?php echo e(trans('admin.mall.product.create')); ?></a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th><?php echo e(trans('admin.mall.product.name')); ?></th>
				<th width="100"><?php echo e(trans('admin.mall.product.category')); ?></th>
				<th width="80"><?php echo e(trans('admin.mall.product.viewnum')); ?></th>
				<th width="120"><?php echo e(trans('admin.created_at')); ?></th>
				<th width="80"><?php echo e(trans('admin.operation')); ?></th>
			</tr>
			<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><input class="ids" type="checkbox" value="<?php echo e($value->id); ?>" name="ids[]"></td>
				<td><a href="<?php echo e(route('mall.product.detail',$value->id)); ?>" target="_blank"><?php echo e($value->name); ?></a></td>
				<td><?php echo e($value->category ? $value->category->name : '/'); ?></td>
				<td><?php echo e($value->viewnum); ?> 次</td>
				<td><?php echo e($value->created_at->format('Y-m-d H:i')); ?></td>
				<td>
					<a href="<?php echo e(route('admin.mall.product.edit',$value->id)); ?>" class="" title="<?php echo e(trans('admin.mall.product.edit')); ?>"><?php echo e(trans('admin.edit')); ?></a>
					<a href="<?php echo e(route('admin.mall.product.destroy',$value->id)); ?>" class="mlm delbtn"><?php echo e(trans('admin.destroy')); ?></a>
				</td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($products) > 0): ?>
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit"><?php echo e(trans('admin.destroy')); ?></button>
		</div>
		<div class="page y">
			<?php echo $products->appends(['name' => request('name')])->links(); ?>

		</div>
    </div>
	<?php endif; ?>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>