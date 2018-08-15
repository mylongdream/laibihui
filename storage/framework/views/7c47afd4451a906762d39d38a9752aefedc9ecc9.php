<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.brand.ordermeal')); ?></h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="<?php echo e(route('admin.brand.ordermeal.index')); ?>">
	<div class="tbsearch">
		<dl>
			<dd>
				<select class="schselect" name="status" onchange='this.form.submit()'>
					<option value="-1" <?php echo request('status') == -1 ? 'selected="selected"' : ''; ?>><?php echo e(trans('admin.all')); ?></option>
					<option value="0" <?php echo empty(request('status')) ? 'selected="selected"' : ''; ?>><?php echo e(trans('admin.brand.ordermeal.status_0')); ?></option>
					<option value="1" <?php echo request('status') == 1 ? 'selected="selected"' : ''; ?>><?php echo e(trans('admin.brand.ordermeal.status_1')); ?></option>
					<option value="2" <?php echo request('status') == 2 ? 'selected="selected"' : ''; ?>><?php echo e(trans('admin.brand.ordermeal.status_2')); ?></option>
					<option value="3" <?php echo request('status') == 3 ? 'selected="selected"' : ''; ?>><?php echo e(trans('admin.brand.ordermeal.status_3')); ?></option>
				</select>
			</dd>
		</dl>
		<dl>
			<dt><?php echo e(trans('admin.brand.ordermeal.realname')); ?></dt>
			<dd><input type="text" name="realname" class="schtxt" value="<?php echo e(request('realname')); ?>"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit"><?php echo e(trans('admin.search')); ?></button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform confirmpwd" method="post" action="<?php echo e(route('admin.brand.ordermeal.batch')); ?>">
	<?php echo csrf_field(); ?>

	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.brand.ordermeal.list')); ?></h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="180"><?php echo e(trans('admin.brand.ordermeal.shop')); ?></th>
                <th width="70"><?php echo e(trans('admin.brand.ordermeal.user')); ?></th>
				<th width="100"><?php echo e(trans('admin.brand.ordermeal.amount')); ?></th>
				<th><?php echo e(trans('admin.brand.ordermeal.meals')); ?></th>
				<th width="60"><?php echo e(trans('admin.brand.ordermeal.status')); ?></th>
				<th width="120"><?php echo e(trans('admin.created_at')); ?></th>
				<th width="80"><?php echo e(trans('admin.operation')); ?></th>
			</tr>
			<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><input class="ids" type="checkbox" value="<?php echo e($value->id); ?>" name="ids[]"></td>
				<td>
                    <?php if($value->shop): ?>
                    <a href="<?php echo e(route('brand.shop.show', $value->shop->id)); ?>" target="_blank" title="<?php echo e($value->shop->name); ?>"><?php echo e($value->shop->name); ?></a>
                    <?php else: ?>
                        /
                    <?php endif; ?>
                </td>
				<td><?php echo e($value->user ? $value->user->username : '/'); ?></td>
				<td><?php echo e(isset($value->order_amount) ? $value->order_amount : '0'); ?> 元</td>
				<td><?php echo e(isset($value->remark) ? $value->remark : '/'); ?></td>
				<td><?php echo e(trans('admin.brand.ordermeal.status_'.$value->status)); ?></td>
				<td><?php echo e($value->created_at->format('Y-m-d H:i')); ?></td>
				<td>
					<a href="<?php echo e(route('admin.brand.ordermeal.edit',$value->id)); ?>" class="openwindow" title="<?php echo e(trans('admin.handle')); ?>"><?php echo e(trans('admin.handle')); ?></a>
					<a href="<?php echo e(route('admin.brand.ordermeal.destroy',$value->id)); ?>" class="mlm delbtn confirmpwd"><?php echo e(trans('admin.destroy')); ?></a>
				</td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($orders) > 0): ?>
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit"><?php echo e(trans('admin.destroy')); ?></button>
		</div>
		<div class="page y">
			<?php echo $ordermeals->appends(['status' => request('status')])->appends(['realname' => request('realname')])->links(); ?>

		</div>
    </div>
	<?php endif; ?>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>