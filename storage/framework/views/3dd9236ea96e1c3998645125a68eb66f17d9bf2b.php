<?php $__env->startSection('content'); ?>
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav"><?php echo e(trans('user.history')); ?></div>
				</div>
				<?php if(count($historys)): ?>
				<?php $__currentLoopData = $historys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="weui-panel panel-item">
						<div class="weui-panel__hd"><a href="<?php echo e(route('mobile.user.history.delete', $value->id)); ?>" title="删除" class="delete delbtn">删除</a></div>
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
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php echo $historys->links(); ?>

				<?php else: ?>
					<div class="no-data">
						<p>暂无数据！</p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>