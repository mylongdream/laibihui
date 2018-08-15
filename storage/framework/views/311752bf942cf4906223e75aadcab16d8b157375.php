<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.brand.allot')); ?></h3></div>
	</div>
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.brand.allot.list')); ?></h3></div>
		</div>
		<table>
			<tr>
				<th><?php echo e(trans('admin.extend.card.number')); ?></th>
				<th width="150"><?php echo e(trans('admin.created_at')); ?></th>
			</tr>
			<?php $__currentLoopData = $cardlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><?php echo e(isset($card->number) ? $card->number : '/'); ?></td>
				<td><?php echo e($card->created_at->format('Y-m-d H:i')); ?></td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($cardlist) > 0): ?>
	<div class="pgs cl">
        <div class="page y">
            <?php echo $cardlist->links(); ?>

        </div>
    </div>
	<?php endif; ?>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>