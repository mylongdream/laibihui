<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.brand.shop')); ?></h3></div>
		<ul class="tab">
			<li class="current"><a href="<?php echo e(route('admin.brand.shop.index')); ?>"><span><?php echo e(trans('admin.brand.shop.list')); ?></span></a></li>
			<li><a href="<?php echo e(route('admin.brand.shop.recycle')); ?>"><span><?php echo e(trans('admin.recycle')); ?></span></a></li>
		</ul>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="<?php echo e(route('admin.brand.shop.index')); ?>">
	<div class="tbsearch">
		<dl>
			<dt><?php echo e(trans('admin.brand.shop.category')); ?></dt>
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
			<div class="y"><a href="<?php echo e(route('admin.brand.shop.create')); ?>" class="btn" title="<?php echo e(trans('admin.brand.shop.create')); ?>">+ <?php echo e(trans('admin.brand.shop.create')); ?></a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="70">ID/<?php echo e(trans('admin.brand.shop.searchcode')); ?></th>
				<th><?php echo e(trans('admin.brand.shop.name')); ?></th>
				<th width="80"><?php echo e(trans('admin.brand.allot')); ?></th>
				<th width="80"><?php echo e(trans('admin.brand.shop.category')); ?></th>
				<th width="60"><?php echo e(trans('admin.brand.shop.discount')); ?></th>
				<th width="90"><?php echo e(trans('admin.brand.shop.subweb')); ?></th>
				<th width="120"><?php echo e(trans('admin.ended_at')); ?></th>
				<th width="120"><?php echo e(trans('admin.created_at')); ?></th>
				<th width="150"><?php echo e(trans('admin.operation')); ?></th>
			</tr>
			<?php $__currentLoopData = $shops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><input class="ids" type="checkbox" value="<?php echo e($shop->id); ?>" name="ids[]"></td>
				<td><?php echo e($shop->id); ?></td>
				<td><a href="<?php echo e(route('brand.shop.show',$shop->id)); ?>" target="_blank"><?php echo e($shop->name); ?></a></td>
				<td>
                    <?php if($shop->ordercard): ?>
					<a href="<?php echo e(route('admin.brand.allot.index',['shopid' => $shop->id])); ?>"><?php echo e(trans('admin.brand.allot')); ?></a>
                    <?php else: ?>
                        暂未开通
                    <?php endif; ?>
				</td>
				<td><?php echo e($shop->category ? $shop->category->name : '/'); ?></td>
				<td><?php echo e($shop->discount); ?> 折</td>
				<td><?php echo e(isset($shop->subweb->name) ? $shop->subweb->name : '/'); ?></td>
				<td><?php echo e($shop->ended_at ? $shop->ended_at->format('Y-m-d H:i') : '/'); ?></td>
				<td><?php echo e($shop->created_at->format('Y-m-d H:i')); ?></td>
				<td>
					<a href="<?php echo e(route('admin.brand.shop.qrcode',$shop->id)); ?>" title="<?php echo e(trans('admin.brand.shop.qrcode')); ?>" class="openwindow"><?php echo e(trans('admin.brand.shop.qrcode')); ?></a>
					<a href="<?php echo e(route('admin.brand.shop.edit',$shop->id)); ?>" title="<?php echo e(trans('admin.brand.shop.edit')); ?>" class="mlm"><?php echo e(trans('admin.edit')); ?></a>
					<a href="<?php echo e(route('admin.brand.shop.destroy',$shop->id)); ?>" class="mlm delbtn"><?php echo e(trans('admin.destroy')); ?></a>
				</td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($shops) > 0): ?>
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit"><?php echo e(trans('admin.destroy')); ?></button>
		</div>
		<div class="page y">
			<?php echo $shops->appends(['catid' => request('catid')])->appends(['name' => request('name')])->links(); ?>

		</div>
    </div>
	<?php endif; ?>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>