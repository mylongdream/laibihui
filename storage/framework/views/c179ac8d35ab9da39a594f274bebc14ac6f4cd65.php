<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.subweb')); ?></h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="<?php echo e(route('admin.subweb.index')); ?>">
	<div class="tbsearch">
		<dl>
			<dt><?php echo e(trans('admin.subweb.name')); ?></dt>
			<dd><input type="text" name="name" class="schtxt" value="<?php echo e(request('name')); ?>"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit"><?php echo e(trans('admin.search')); ?></button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="<?php echo e(route('admin.subweb.batch')); ?>">
	<?php echo csrf_field(); ?>

	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.subweb.list')); ?></h3></div>
			<div class="y"><a href="<?php echo e(route('admin.subweb.create')); ?>" class="btn">+ <?php echo e(trans('admin.subweb.create')); ?></a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="80"><?php echo e(trans('admin.displayorder')); ?></th>
				<th><?php echo e(trans('admin.subweb.name')); ?></th>
				<th width="240"><?php echo e(trans('admin.subweb.domain')); ?></th>
				<th width="100"><?php echo e(trans('admin.operation')); ?></th>
			</tr>
			<?php $__currentLoopData = $subwebs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subweb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><input class="ids" type="checkbox" value="<?php echo e($subweb->subweb_id); ?>" name="ids[]"></td>
				<td><input type="text" class="txt" name="displayorder[<?php echo e($subweb->subweb_id); ?>]" value="<?php echo e($subweb->displayorder); ?>" size="2"></td>
				<td><?php echo e($subweb->name); ?></td>
				<td><?php echo e(route('subweb.index',$subweb->domain)); ?></td>
				<td>
					<a href="<?php echo e(route('admin.subweb.edit',$subweb->subweb_id)); ?>" class=""><?php echo e(trans('admin.edit')); ?></a>
					<a href="<?php echo e(route('admin.subweb.destroy',$subweb->subweb_id)); ?>" class="mlm delbtn"><?php echo e(trans('admin.destroy')); ?></a>
				</td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($subwebs) > 0): ?>
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit"><?php echo e(trans('admin.destroy')); ?></button>
			<button class="submitbtn" name="updatesubmit" value="yes" type="submit"><?php echo e(trans('admin.update')); ?></button>
		</div>
		<div class="page y">
			<?php echo $subwebs->appends(['subject' => request('subject')])->links(); ?>

		</div>
    </div>
	<?php endif; ?>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>