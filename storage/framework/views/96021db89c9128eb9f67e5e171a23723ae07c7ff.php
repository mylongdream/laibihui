<?php $__env->startSection('content'); ?>
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav"><?php echo e(trans('user.cardreward')); ?></div>
				</div>
				<div class="weui-panel" style="margin: 0">
					<div class="weui-msg">
						<div class="weui-msg__text-area">
							<h2 class="weui-msg__title">当前已售卡 <span style="font-size: 36px;margin: 0 10px">0</span> 张</h2>
						</div>
					</div>
				</div>
                <div class="weui-cells weui-panel cardreward">
					<?php if($list): ?>
					<ul>
						<?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li>
								<div class="pic"><img src="<?php echo e(uploadImage($value->upimage)); ?>" width="60" height="60"></div>
								<div class="name"><?php echo e($value->name); ?></div>
								<div class="info"><?php echo e($value->cardnum); ?> 张卡</div>
								<div class="btn"><a href="javascript:;" class="disabled">点击兑换</a></div>
							</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
					<?php endif; ?>
                </div>
				<?php echo $list->links(); ?>

			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>