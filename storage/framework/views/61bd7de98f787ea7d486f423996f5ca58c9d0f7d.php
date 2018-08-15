<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('user.score')); ?></h3></div>
		<ul class="tab">
			<li class="on"><a href="<?php echo e(route('user.score.index')); ?>"><span><?php echo e(trans('user.score.list')); ?></span></a></li>
			<li><a href="<?php echo e(route('user.score.exchange')); ?>"><span><?php echo e(trans('user.score.exchange')); ?></span></a></li>
			<li><a href="<?php echo e(route('user.score.transfer')); ?>"><span><?php echo e(trans('user.score.transfer')); ?></span></a></li>
		</ul>
	</div>
	<div class="tblist mtw">
		<table>
			<tr>
				<th align="left"><?php echo e(trans('user.score.remark')); ?></th>
				<th align="center"><?php echo e(trans('user.score.score')); ?></th>
				<th align="center" width="120"><?php echo e(trans('user.score.created_at')); ?></th>
			</tr>
			<?php if(count($scores)): ?>
				<?php $__currentLoopData = $scores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td align="left"><?php echo e($value->remark); ?></td>
						<td align="center">
							<?php if($value->score > 0): ?>
								<strong style="color:#e4393c">+<?php echo e($value->score); ?></strong>
                            <?php else: ?>
                                <strong style="color:#999999"><?php echo e($value->score); ?></strong>
                            <?php endif; ?>
						</td>
						<td align="center"><?php echo e($value->created_at->format('Y-m-d H:i')); ?></td>
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php else: ?>
				<tr>
					<td colspan="3" align="center" class="nodata">暂无数据</td>
				</tr>
			<?php endif; ?>
		</table>
	</div>
	<?php echo $scores->links(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>