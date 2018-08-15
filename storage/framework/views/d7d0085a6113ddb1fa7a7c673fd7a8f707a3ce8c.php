<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.extend.ordercard')); ?></h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="<?php echo e(route('admin.extend.ordercard.index')); ?>">
	<div class="tbsearch">
		<dl>
			<dd>
				<select class="schselect" name="status" onchange='this.form.submit()'>
					<option value="" <?php echo empty(request('status')) ? 'selected="selected"' : ''; ?>>全部</option>
					<option value="waitpay" <?php echo request('status') == 'waitpay' ? 'selected="selected"' : ''; ?>>待付款</option>
					<option value="waitsend" <?php echo request('status') == 'waitsend' ? 'selected="selected"' : ''; ?>>待发货</option>
					<option value="havesend" <?php echo request('status') == 'havesend' ? 'selected="selected"' : ''; ?>>已发货</option>
					<option value="success" <?php echo request('status') == 'success' ? 'selected="selected"' : ''; ?>>已成功</option>
					<option value="closed" <?php echo request('status') == 'closed' ? 'selected="selected"' : ''; ?>>已关闭</option>
				</select>
			</dd>
		</dl>
		<dl>
			<dt><?php echo e(trans('admin.extend.ordercard.order_type')); ?></dt>
			<dd>
				<select class="schselect" name="pay_type" onchange='this.form.submit()'>
					<option value="0"><?php echo e(trans('admin.all')); ?></option>
					<option value="1" <?php echo request('pay_type') == 1 ? 'selected="selected"' : ''; ?>>上门办卡</option>
					<option value="2" <?php echo request('pay_type') == 2 ? 'selected="selected"' : ''; ?>>邮寄办卡</option>
				</select>
			</dd>
		</dl>
		<dl>
			<dt><?php echo e(trans('admin.extend.ordercard.order_sn')); ?></dt>
			<dd><input type="text" name="order_sn" class="schtxt" value="<?php echo e(request('order_sn')); ?>"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit"><?php echo e(trans('admin.search')); ?></button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="<?php echo e(route('admin.extend.ordercard.batch')); ?>">
	<?php echo csrf_field(); ?>

	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.extend.ordercard.list')); ?></h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="100"><?php echo e(trans('admin.extend.ordercard.user')); ?></th>
				<th width="160"><?php echo e(trans('admin.extend.ordercard.order_sn')); ?></th>
				<th width="240"><?php echo e(trans('admin.extend.ordercard.consignee')); ?></th>
				<th><?php echo e(trans('admin.extend.ordercard.remark')); ?></th>
				<th width="100"><?php echo e(trans('admin.extend.ordercard.fromuser')); ?></th>
				<th width="80"><?php echo e(trans('admin.extend.ordercard.order_type')); ?></th>
				<th width="60"><?php echo e(trans('admin.extend.ordercard.status')); ?></th>
				<th width="120"><?php echo e(trans('admin.extend.ordercard.created_at')); ?></th>
				<th width="80"><?php echo e(trans('admin.operation')); ?></th>
			</tr>
			<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><input class="ids" type="checkbox" value="<?php echo e($value->id); ?>" name="ids[]"></td>
				<td><?php echo e($value->user ? $value->user->username : '/'); ?></td>
				<td><?php echo e(isset($value->order_sn) ? $value->order_sn : '/'); ?></td>
				<td>
                    <p><?php echo e($value->address->realname); ?> <span class="mlm"><?php echo e($value->address->mobile); ?></span></p>
                    <p><?php echo e($value->address->getprovince ? $value->address->getprovince->name : ''); ?> <?php echo e($value->address->getcity ? $value->address->getcity->name : ''); ?> <?php echo e($value->address->getarea ? $value->address->getarea->name : ''); ?> <?php echo e($value->address->getstreet ? $value->address->getstreet->name : ''); ?> <?php echo e($value->address->address); ?></p>
				</td>
				<td><?php echo e(isset($value->remark) ? $value->remark : '/'); ?></td>
				<td><?php echo e($value->fromuser ? $value->fromuser->username : '/'); ?></td>
				<td><?php echo e(trans('admin.extend.ordercard.order_type_'.$value->order_type)); ?></td>
				<td><?php echo e(trans('admin.extend.ordercard.status_'.$value->order_status.$value->shipping_status.$value->pay_status)); ?></td>
				<td><?php echo e($value->created_at->format('Y-m-d H:i')); ?></td>
				<td>
					<a href="<?php echo e(route('admin.extend.ordercard.show',$value->id)); ?>" class="" title="<?php echo e(trans('admin.view')); ?>"><?php echo e(trans('admin.view')); ?></a>
					<a href="<?php echo e(route('admin.extend.ordercard.destroy',$value->id)); ?>" class="mlm delbtn"><?php echo e(trans('admin.destroy')); ?></a>
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
			<?php echo $orders->appends(['status' => request('status')])->appends(['order_type' => request('order_type')])->appends(['order_sn' => request('order_sn')])->links(); ?>

		</div>
    </div>
	<?php endif; ?>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>