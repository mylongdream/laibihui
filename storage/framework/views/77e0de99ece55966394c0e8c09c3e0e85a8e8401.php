<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.brand.appoint')); ?></h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="<?php echo e(route('admin.brand.appoint.index')); ?>">
	<div class="tbsearch">
		<dl>
			<dd>
				<select class="schselect" name="status" onchange='this.form.submit()'>
					<option value="-1" <?php echo request('status') == -1 ? 'selected="selected"' : ''; ?>><?php echo e(trans('admin.all')); ?></option>
					<option value="0" <?php echo empty(request('status')) ? 'selected="selected"' : ''; ?>><?php echo e(trans('admin.brand.appoint.status_0')); ?></option>
					<option value="1" <?php echo request('status') == 1 ? 'selected="selected"' : ''; ?>><?php echo e(trans('admin.brand.appoint.status_1')); ?></option>
					<option value="2" <?php echo request('status') == 2 ? 'selected="selected"' : ''; ?>><?php echo e(trans('admin.brand.appoint.status_2')); ?></option>
					<option value="3" <?php echo request('status') == 3 ? 'selected="selected"' : ''; ?>><?php echo e(trans('admin.brand.appoint.status_3')); ?></option>
				</select>
			</dd>
		</dl>
		<dl>
			<dt><?php echo e(trans('admin.brand.appoint.order_sn')); ?></dt>
			<dd><input type="text" name="order_sn" class="schtxt" value="<?php echo e(request('order_sn')); ?>"></dd>
		</dl>
		<dl>
			<dt><?php echo e(trans('admin.brand.appoint.realname')); ?></dt>
			<dd><input type="text" name="realname" class="schtxt" value="<?php echo e(request('realname')); ?>"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit"><?php echo e(trans('admin.search')); ?></button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform confirmpwd" method="post" action="<?php echo e(route('admin.brand.appoint.batch')); ?>">
	<?php echo csrf_field(); ?>

	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.brand.appoint.list')); ?></h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th><?php echo e(trans('admin.brand.appoint.order_sn')); ?></th>
				<th width="180"><?php echo e(trans('admin.brand.appoint.shop')); ?></th>
                <th width="70"><?php echo e(trans('admin.brand.appoint.realname')); ?></th>
				<th width="100"><?php echo e(trans('admin.brand.appoint.mobile')); ?></th>
				<th width="60"><?php echo e(trans('admin.brand.appoint.number')); ?></th>
				<th width="120"><?php echo e(trans('admin.brand.appoint.appoint_at')); ?></th>
				<th width="60"><?php echo e(trans('admin.brand.appoint.status')); ?></th>
				<th width="120"><?php echo e(trans('admin.created_at')); ?></th>
				<th width="80"><?php echo e(trans('admin.operation')); ?></th>
			</tr>
			<?php $__currentLoopData = $appoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appoint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><input class="ids" type="checkbox" value="<?php echo e($appoint->id); ?>" name="ids[]"></td>
				<td><?php echo e(isset($appoint->order_sn) ? $appoint->order_sn : '/'); ?></td>
				<td>
                    <?php if($appoint->shop): ?>
                    <a href="<?php echo e(route('brand.shop.show', $appoint->shop->id)); ?>" target="_blank" title="<?php echo e($appoint->shop->name); ?>"><?php echo e($appoint->shop->name); ?></a>
                    <?php else: ?>
                        /
                    <?php endif; ?>
                </td>
				<td><?php echo e(isset($appoint->realname) ? $appoint->realname : '/'); ?></td>
				<td><?php echo e(isset($appoint->mobile) ? $appoint->mobile : '/'); ?></td>
				<td><?php echo e(isset($appoint->number) ? $appoint->number : '0'); ?> 人</td>
				<td><?php echo e($appoint->appoint_at ? $appoint->appoint_at->format('Y-m-d H:i') : '/'); ?></td>
				<td><?php echo e(trans('admin.brand.appoint.status_'.$appoint->status)); ?></td>
				<td><?php echo e($appoint->created_at->format('Y-m-d H:i')); ?></td>
				<td>
					<a href="<?php echo e(route('admin.brand.appoint.edit',$appoint->id)); ?>" class="openwindow" title="<?php echo e(trans('admin.handle')); ?>"><?php echo e(trans('admin.handle')); ?></a>
					<a href="<?php echo e(route('admin.brand.appoint.destroy',$appoint->id)); ?>" class="mlm delbtn confirmpwd"><?php echo e(trans('admin.destroy')); ?></a>
				</td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($appoints) > 0): ?>
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit"><?php echo e(trans('admin.destroy')); ?></button>
		</div>
		<div class="page y">
			<?php echo $appoints->appends(['status' => request('status')])->appends(['order_sn' => request('order_sn')])->appends(['realname' => request('realname')])->links(); ?>

		</div>
    </div>
	<?php endif; ?>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>