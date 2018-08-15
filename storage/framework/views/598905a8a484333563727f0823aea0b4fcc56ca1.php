<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.user.user')); ?></h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="<?php echo e(route('admin.user.user.index')); ?>">
	<div class="tbsearch">
		<dl>
			<dd>
				<select class="schselect" name="bindcard" onchange='this.form.submit()'>
					<option value="">全部</option>
					<option value="1" <?php echo request('bindcard') == 1 ? 'selected="selected"' : ''; ?>>未开卡</option>
					<option value="2" <?php echo request('bindcard') == 2 ? 'selected="selected"' : ''; ?>>已开卡</option>
				</select>
			</dd>
		</dl>
		<dl>
			<dt><?php echo e(trans('admin.user.user.mobile')); ?></dt>
			<dd><input type="text" name="mobile" class="schtxt" value="<?php echo e(request('mobile')); ?>"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit"><?php echo e(trans('admin.search')); ?></button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="<?php echo e(route('admin.user.user.index')); ?>">
	<?php echo csrf_field(); ?>

	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.user.user.list')); ?></h3></div>
			<div class="y"><a href="<?php echo e(route('admin.user.user.create')); ?>" class="btn openwindow" title="<?php echo e(trans('admin.user.user.create')); ?>">+ <?php echo e(trans('admin.user.user.create')); ?></a></div>
		</div>
		<table>
			<tr>
				<th width="24"><label><input class="checkall" type="checkbox"></label></th>
				<th width="70"><?php echo e(trans('admin.user.user.headimgurl')); ?></th>
				<th><?php echo e(trans('admin.user.user.username')); ?></th>
				<th width="100"><?php echo e(trans('admin.user.user.mobile')); ?></th>
				<th width="70"><?php echo e(trans('admin.user.user.tiyan_money')); ?></th>
				<th width="70"><?php echo e(trans('admin.user.user.user_money')); ?></th>
				<th width="70"><?php echo e(trans('admin.user.user.frozen_money')); ?></th>
				<th width="70"><?php echo e(trans('admin.user.user.score')); ?></th>
				<th width="120"><?php echo e(trans('admin.user.user.lastlogin')); ?></th>
				<th width="120"><?php echo e(trans('admin.created_at')); ?></th>
				<th width="80"><?php echo e(trans('admin.operation')); ?></th>
			</tr>
			<?php $__currentLoopData = $userlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><label><input class="ids" type="checkbox" value="<?php echo e($value->uid); ?>" name="ids[]"></label></td>
				<td><img class="block" width="48" height="48" src="<?php echo e($value->headimgurl ? uploadImage($value->headimgurl) : asset('static/image/common/getheadimg.jpg')); ?>"></td>
				<td><?php echo e($value->username); ?></td>
				<td><?php echo e(isset($value->mobile) ? $value->mobile : '/'); ?></td>
				<td><?php echo e($value->tiyan_money); ?> 元</td>
				<td><?php echo e($value->user_money); ?> 元</td>
				<td><?php echo e($value->frozen_money); ?> 元</td>
				<td><?php echo e($value->score); ?></td>
				<td><?php echo e($value->lastlogin ? $value->lastlogin->format('Y-m-d H:i') : '/'); ?></td>
				<td><?php echo e($value->created_at->format('Y-m-d H:i')); ?></td>
				<td>
					<a href="<?php echo e(route('admin.user.user.edit',$value->uid)); ?>" class="openwindow" title="<?php echo e(trans('admin.user.user.edit')); ?>"><?php echo e(trans('admin.edit')); ?></a>
					<a href="<?php echo e(route('admin.user.user.destroy',$value->uid)); ?>" class="mlm delbtn" title="<?php echo e(trans('admin.user.user.destroy')); ?>"><?php echo e(trans('admin.destroy')); ?></a>
				</td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($userlist) > 0): ?>
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit"><?php echo e(trans('admin.destroy')); ?></button>
		</div>
		<div class="page y">
			<?php echo $userlist->appends(['bindcard' => request('bindcard')])->appends(['mobile' => request('mobile')])->links(); ?>

		</div>
    </div>
	<?php endif; ?>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>