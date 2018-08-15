<?php $__env->startSection('content'); ?>
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav"><?php echo e(trans('user.consume')); ?></div>
				</div>
				<?php $__currentLoopData = $consumes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="weui-panel panel-item">
						<div class="weui-panel__hd">
							<div class="z">订单号：<?php echo e($value->order_sn); ?></div>
						</div>
						<div class="weui-panel__bd">
							<a href="<?php echo e(route('mobile.brand.shop.show', $value->shop->id)); ?>" class="weui-media-box weui-media-box_appmsg">
								<div class="weui-media-box__hd">
									<img class="weui-media-box__thumb" src="<?php echo e(uploadImage($value->shop->upimage)); ?>" alt="">
								</div>
								<div class="weui-media-box__bd">
									<h4 class="weui-media-box__title"><?php echo e($value->shop ? $value->shop->name : '/'); ?></h4>
									<p class="weui-media-box__desc">电话：<?php echo e($value->shop ? $value->shop->phone : '/'); ?></p>
									<p class="weui-media-box__desc">地址：<?php echo e($value->shop ? $value->shop->address : '/'); ?></p>
								</div>
							</a>
						</div>
                        <div class="weui-panel__ft">
                            <div class="z status">状态：<?php echo e(trans('user.consume.status_'.$value->ifpay)); ?></div>
                            <div class="y">
                                <?php if($value->ifpay == 0): ?>
                                    <a href="<?php echo e(route('mobile.user.consume.pay', $value->order_sn)); ?>" title="立即付款" class="btn-pay">立即付款</a>
                                <?php else: ?>
                                    <?php if($value->shop): ?>
                                        <a href="<?php echo e(route('mobile.brand.shop.show', $value->shop->id)); ?>" title="再次消费" class="btn-again">再次消费</a>
                                    <?php endif; ?>
                                <?php endif; ?>
                                    <a href="<?php echo e(route('mobile.user.consume.show', $value->order_sn)); ?>" title="订单详情" class="mlm">订单详情</a>
                            </div>
                        </div>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php echo $consumes->links(); ?>

			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>