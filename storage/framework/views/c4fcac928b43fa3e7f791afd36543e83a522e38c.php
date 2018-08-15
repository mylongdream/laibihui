<?php $__env->startSection('content'); ?>
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav"><?php echo e(trans('user.orderfarm')); ?></div>
				</div>
				<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="weui-panel panel-item">
						<div class="weui-panel__hd">
							<div class="z">订单号：<?php echo e($value->order_sn); ?></div>
						</div>
						<div class="weui-panel__bd">
							<div class="weui-cell">
								<div class="weui-cell__hd" style="margin-right: 10px;">
									<img src="<?php echo e(uploadImage($value->farm->upimage)); ?>" style="height: 50px;display: block">
								</div>
								<div class="weui-cell__bd">
									<p><?php echo e($value->farm->name); ?></p>
									<p style="margin-top:5px;color:#999;font-size:14px">套餐：<?php echo e($value->package_name); ?></p>
								</div>
								<div class="weui-cell__ft">￥<?php echo e($value->order_amount); ?></div>
							</div>
						</div>
                        <div class="weui-panel__ft">
                            <div class="z status">状态：<?php echo e(trans('user.orderfarm.status_'.$value->order_status.$value->pay_status)); ?></div>
                            <div class="y">
								<?php if($value->order_status == 0 && $value->pay_status == 0): ?>
                                    <a href="<?php echo e(route('mobile.brand.farm.pay', $value->order_sn)); ?>" title="立即付款" class="btn-pay">立即付款</a>
                                <?php endif; ?>
                                    <a href="<?php echo e(route('mobile.user.orderfarm.show', $value->order_sn)); ?>" title="订单详情" class="mlm">订单详情</a>
                            </div>
                        </div>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php echo $orders->links(); ?>

			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>