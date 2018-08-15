<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.extend.bindcard')); ?></h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="<?php echo e(route('admin.extend.bindcard.index')); ?>">
	<div class="tbsearch">
		<dl>
			<dt><?php echo e(trans('admin.extend.bindcard.number')); ?></dt>
			<dd><input type="text" name="number" class="schtxt" value="<?php echo e(request('number')); ?>"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit"><?php echo e(trans('admin.search')); ?></button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="<?php echo e(route('admin.extend.bindcard.batch')); ?>">
	<?php echo csrf_field(); ?>

	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.extend.bindcard.list')); ?></h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="140"><?php echo e(trans('admin.extend.bindcard.user')); ?></th>
				<th><?php echo e(trans('admin.extend.bindcard.number')); ?></th>
				<th width="80"><?php echo e(trans('admin.extend.bindcard.money')); ?></th>
				<th width="140"><?php echo e(trans('admin.extend.bindcard.fromuser')); ?></th>
				<th width="140"><?php echo e(trans('admin.extend.bindcard.fromupuser')); ?></th>
				<th width="120"><?php echo e(trans('admin.extend.bindcard.postip')); ?></th>
				<th width="120"><?php echo e(trans('admin.created_at')); ?></th>
				<th width="70"><?php echo e(trans('admin.operation')); ?></th>
			</tr>
			<?php $__currentLoopData = $bindcards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bindcard): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><input class="ids" type="checkbox" value="<?php echo e($bindcard->id); ?>" name="ids[]"></td>
				<td><?php echo e($bindcard->user ? $bindcard->user->username : '/'); ?></td>
				<td><?php echo e(isset($bindcard->number) ? $bindcard->number : '/'); ?></td>
				<td><?php echo e($bindcard->money); ?> 元</td>
				<td><?php echo e($bindcard->fromuser ? $bindcard->fromuser->username : '/'); ?></td>
				<td><?php echo e($bindcard->fromupuser ? $bindcard->fromupuser->username : '/'); ?></td>
				<td><?php echo e($bindcard->postip); ?></td>
				<td><?php echo e($bindcard->created_at->format('Y-m-d H:i')); ?></td>
				<td>
					<a href="<?php echo e(route('admin.extend.bindcard.destroy',$bindcard->id)); ?>" class="delbtn"><?php echo e(trans('admin.destroy')); ?></a>
				</td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($bindcards) > 0): ?>
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit"><?php echo e(trans('admin.destroy')); ?></button>
		</div>
        <div class="page y">
            <?php echo $bindcards->appends(['number' => request('number')])->links(); ?>

        </div>
    </div>
	<?php endif; ?>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>