<?php $__env->startSection('content'); ?>
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav"><?php echo e(trans('user.score')); ?></div>
				</div>
				<div class="weui-panel" style="margin: 0">
					<div class="weui-msg">
						<div class="weui-msg__text-area">
							<h2 class="weui-msg__title">当前<span style="font-size: 36px;margin: 0 10px"><?php echo e(auth()->user()->score); ?></span>个积分</h2>
						</div>
					</div>
				</div>
				<div class="weui-panel">
					<div class="weui-panel__bd user-account">
						<div class="weui-flex">
							<div class="weui-flex__item">
								<a href="<?php echo e(route('mobile.user.score.exchange')); ?>" class="">
									<div style="font-size: 14px;">积分换钱</div>
								</a>
							</div>
							<div class="weui-flex__item">
								<a href="<?php echo e(route('mobile.user.score.transfer')); ?>" class="">
									<div style="font-size: 14px;">积分转让</div>
								</a>
							</div>
						</div>
					</div>
				</div>
                <div class="weui-cells weui-panel">
				<?php $__currentLoopData = $scores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="weui-cell">
						<div class="weui-cell__bd">
                            <p style="font-size: 14px;"><?php echo e($value->remark); ?></p>
                            <p style="font-size: 12px;color: #999;margin-top: 5px">时间：<?php echo e($value->created_at->format('Y-m-d H:i')); ?></p>
						</div>
                        <div class="weui-cell__ft">
                            <?php if($value->score > 0): ?>
                                <strong style="color:#e4393c">+<?php echo e($value->score); ?></strong>
                            <?php else: ?>
                                <strong style="color:#999999"><?php echo e($value->score); ?></strong>
                            <?php endif; ?>
                        </div>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
				<?php echo $scores->links(); ?>

			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>