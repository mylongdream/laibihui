<?php $__env->startSection('content'); ?>
	<div class="wp" style="background: #fff">
		<?php if(isset($status) && $status): ?>
			<div class="page msg_success js_show">
				<div class="weui-msg">
					<div class="weui-msg__icon-area">
						<i class="weui-icon-success weui-icon_msg"></i>
					</div>
					<div class="weui-msg__text-area">
						<h2 class="weui-msg__title">操作成功</h2>
						<?php if(isset($info) && $info): ?>
						<p class="weui-msg__desc"><?php echo e($info); ?></p>
						<?php endif; ?>
					</div>
					<div class="weui-msg__opr-area">
						<p class="weui-btn-area">
							<?php if(isset($url) && $url): ?>
								<a class="weui-btn weui-btn_primary" href="<?php echo e($url); ?>">确定</a>
							<?php else: ?>
								<a class="weui-btn weui-btn_default" href="javascript:history.back(-1);">确定</a>
							<?php endif; ?>
						</p>
					</div>
				</div>
			</div>
		<?php else: ?>
			<div class="page msg_success js_show">
				<div class="weui-msg">
					<div class="weui-msg__icon-area">
						<i class="weui-icon-warn weui-icon_msg"></i>
					</div>
					<div class="weui-msg__text-area">
						<h2 class="weui-msg__title">操作失败</h2>
						<?php if(isset($info) && $info): ?>
							<p class="weui-msg__desc"><?php echo e($info); ?></p>
						<?php endif; ?>
					</div>
					<div class="weui-msg__opr-area">
						<p class="weui-btn-area">
							<?php if(isset($url) && $url): ?>
								<a class="weui-btn weui-btn_primary" href="<?php echo e($url); ?>">确定</a>
							<?php else: ?>
								<a class="weui-btn weui-btn_default" href="javascript:history.back(-1);">确定</a>
							<?php endif; ?>
						</p>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>