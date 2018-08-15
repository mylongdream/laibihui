<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.extend.faq')); ?></h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="<?php echo e(route('admin.extend.faq.index')); ?>">
	<div class="tbsearch">
		<dl>
			<dt><?php echo e(trans('admin.extend.faq.title')); ?></dt>
			<dd><input type="text" name="title" class="schtxt" value="<?php echo e(request('title')); ?>"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit"><?php echo e(trans('admin.search')); ?></button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="<?php echo e(route('admin.extend.faq.batch')); ?>">
	<?php echo csrf_field(); ?>

	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.extend.faq.list')); ?></h3></div>
			<div class="y"><a href="<?php echo e(route('admin.extend.faq.create')); ?>" class="btn openwindow" title="<?php echo e(trans('admin.extend.faq.create')); ?>">+ <?php echo e(trans('admin.extend.faq.create')); ?></a></div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="50"><?php echo e(trans('admin.displayorder')); ?></th>
				<th><?php echo e(trans('admin.extend.faq.title')); ?></th>
				<th width="150"><?php echo e(trans('admin.extend.faq.catid')); ?></th>
				<th width="120"><?php echo e(trans('admin.created_at')); ?></th>
				<th width="80"><?php echo e(trans('admin.operation')); ?></th>
			</tr>
			<?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><input class="ids" type="checkbox" value="<?php echo e($faq->id); ?>" name="ids[]"></td>
				<td><input type="text" class="txt" name="displayorder[<?php echo e($faq->photo_id); ?>]" value="<?php echo e($faq->displayorder); ?>" size="2"></td>
				<td><?php echo e(isset($faq->title) ? $faq->title : '/'); ?></td>
				<td><?php echo e($faq->category ? $faq->category->name : '/'); ?></td>
				<td><?php echo e($faq->created_at->format('Y-m-d H:i')); ?></td>
				<td>
					<a href="<?php echo e(route('admin.extend.faq.edit',$faq->id)); ?>" class="openwindow" title="<?php echo e(trans('admin.extend.faq.edit')); ?>"><?php echo e(trans('admin.edit')); ?></a>
					<a href="<?php echo e(route('admin.extend.faq.destroy',$faq->id)); ?>" class="mlm delbtn"><?php echo e(trans('admin.destroy')); ?></a>
				</td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($faqs) > 0): ?>
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit"><?php echo e(trans('admin.destroy')); ?></button>
			<button class="submitbtn" name="updatesubmit" value="yes" type="submit"><?php echo e(trans('admin.update')); ?></button>
		</div>
		<div class="page y">
			<?php echo $faqs->appends(['title' => request('title')])->links(); ?>

		</div>
    </div>
	<?php endif; ?>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>