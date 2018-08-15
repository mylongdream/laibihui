<?php $__env->startSection('content'); ?>
	<div class="messagebox">
		<div class="messagetip">
			<p class="infotitle"><?php echo e($info); ?></p>
			<p class="marginbot">
				<?php if(isset($url)): ?>
					<a href="<?php echo e($url); ?>">如果您的浏览器没有自动跳转，请点击这里</a>
				<?php else: ?>
					<a href="javascript:history.back(-1);">请点击这里返回上一页</a>
				<?php endif; ?>
			</p>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>