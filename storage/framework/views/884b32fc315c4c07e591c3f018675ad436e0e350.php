<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('user.consume')); ?></h3></div>
	</div>
	<?php if(count($consumes)): ?>
		<div class="order-list mtw">
			<div class="hd">
				<table width="100%">
					<tr>
						<th width="66%" align="center"><?php echo e(trans('user.consume.shop')); ?></th>
						<th width="10%" align="center"><?php echo e(trans('user.consume.money')); ?></th>
						<th width="12%" align="center"><?php echo e(trans('user.consume.status')); ?></th>
						<th width="12%" align="center"><?php echo e(trans('user.operation')); ?></th>
					</tr>
				</table>
			</div>
			<?php $__currentLoopData = $consumes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="bd mtw">
					<table width="100%">
						<tr class="tr-th">
							<td colspan="5">
								<span class="dealtime"><?php echo e($value->created_at->format('Y-m-d H:i:s')); ?></span>
								<span class="ordersn">订单号：<a href="<?php echo e(route('user.consume.show', $value->order_sn)); ?>" title="订单详情" class="openwindow"><?php echo e($value->order_sn); ?></a></span>
							</td>
						</tr>
						<tr class="tr-bd">
							<td width="66%" valign="top">
								<?php if($value->shop): ?>
									<div class="s-item">
										<div class="s-pic">
											<a href="<?php echo e(route('brand.shop.show', $value->shop->id)); ?>" target="_blank" title="<?php echo e($value->shop->name); ?>">
												<img src="<?php echo e(uploadImage($value->shop->upimage)); ?>" width="150" height="150">
											</a>
										</div>
										<div class="s-info">
											<div class="s-name">
												<a href="<?php echo e(route('brand.shop.show', $value->shop->id)); ?>" target="_blank" title="<?php echo e($value->shop->name); ?>"><?php echo e($value->shop->name); ?></a>
											</div>
											<div class="s-extra">
												电话：<?php echo e($value->shop->phone); ?>

											</div>
											<div class="s-extra">
												地址：<?php echo e($value->shop->address); ?>

											</div>
										</div>
									</div>
								<?php else: ?>
									/
								<?php endif; ?>
							</td>
							<td width="10%" align="center">
								<p><strong>￥<?php echo e(sprintf("%.2f",$value->money)); ?></strong></p>
							</td>
							<td width="12%" align="center">
								<p class="order-status"><?php echo e(trans('user.consume.status_'.$value->ifpay)); ?></p>
								<p><a href="<?php echo e(route('user.consume.show', $value->order_sn)); ?>" title="订单详情" class="openwindow">订单详情</a></p>
							</td>
							<td width="12%" align="center">
								<?php if($value->ifpay == 0): ?>
									<a href="<?php echo e(route('user.consume.pay', $value->order_sn)); ?>" target="_blank" title="立即付款" class="btn-pay">立即付款</a>
								<?php else: ?>
									<?php if($value->shop): ?>
										<a href="<?php echo e(route('brand.shop.show', $value->shop->id)); ?>" target="_blank" title="再次消费" class="btn-again">再次消费</a>
									<?php endif; ?>
								<?php endif; ?>
							</td>
						</tr>
					</table>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
		<?php echo $consumes->links(); ?>

	<?php else: ?>
		<div class="tblist mtw">
			<table>
				<tr>
					<td colspan="3" class="nodata">暂无数据</td>
				</tr>
			</table>
		</div>
	<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>