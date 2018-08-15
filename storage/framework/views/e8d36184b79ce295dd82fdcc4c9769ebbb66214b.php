<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.wechat.redpack')); ?></h3></div>
		<ul class="tab">
			<li class="current"><a href="<?php echo e(route('admin.wechat.redpack.index')); ?>"><span><?php echo e(trans('admin.wechat.redpack.list')); ?></span></a></li>
			<li><a href="<?php echo e(route('admin.wechat.redpack.create')); ?>"><span><?php echo e(trans('admin.wechat.redpack.create')); ?></span></a></li>
		</ul>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="<?php echo e(route('admin.wechat.redpack.index')); ?>">
	<div class="tbsearch">
		<dl>
			<dt><?php echo e(trans('admin.wechat.redpack.openid')); ?></dt>
			<dd><input type="text" name="openid" class="schtxt" value="<?php echo e(request('openid')); ?>"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit"><?php echo e(trans('admin.search')); ?></button></div>
	</div>
	</form>
	<div class="tblist">
		<table>
			<tr>
				<th width="80"><?php echo e(trans('admin.wechat.user.headimgurl')); ?></th>
				<th width="120"><?php echo e(trans('admin.wechat.user.nickname')); ?></th>
				<th><?php echo e(trans('admin.wechat.redpack.openid')); ?></th>
				<th width="100"><?php echo e(trans('admin.wechat.redpack.total_amount')); ?></th>
				<th width="160"><?php echo e(trans('admin.wechat.redpack.return_msg')); ?></th>
				<th width="160"><?php echo e(trans('admin.created_at')); ?></th>
				<th width="80"><?php echo e(trans('admin.operation')); ?></th>
			</tr>
			<?php $__currentLoopData = $redpacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $redpack): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><img class="block" width="48" height="48" src="<?php echo e(isset($redpack->user->headimgurl) ? $redpack->user->headimgurl : '/'); ?>"></td>
					<td><?php echo e(isset($redpack->user->nickname) ? $redpack->user->nickname : '/'); ?></td>
					<td><?php echo e(isset($redpack->openid) ? $redpack->openid : '/'); ?></td>
					<td><?php echo e(trans('admin.wechat.redpack.total_amount.rmb', ['amount' => $redpack->amount])); ?></td>
					<td><?php echo e(isset($redpack->return_msg) ? $redpack->return_msg : '/'); ?></td>
					<td><?php echo e($redpack->created_at->format('Y-m-d H:i')); ?></td>
					<td>
						<a href="<?php echo e(route('admin.wechat.redpack.show',$redpack->id)); ?>" class="openwindow" title="<?php echo e(trans('admin.wechat.redpack.view')); ?>"><?php echo e(trans('admin.view')); ?></a>
						<a href="<?php echo e(route('admin.wechat.redpack.destroy',$redpack->id)); ?>" class="mlm delbtn"><?php echo e(trans('admin.destroy')); ?></a>
					</td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($redpacks) > 0): ?>
	<div class="pgs cl">
		<div class="page y">
			<?php echo $redpacks->appends(['openid' => request('openid')])->links(); ?>

		</div>
    </div>
	<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>