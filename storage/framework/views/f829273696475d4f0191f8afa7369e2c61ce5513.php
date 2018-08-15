<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('user.ordermeal')); ?></h3></div>
	</div>
	<?php if(count($orders)): ?>
		<div class="order-list mtw">
			<div class="hd">
				<table width="100%">
					<tr>
						<th width="63%" align="center"><?php echo e(trans('user.ordermeal.meal')); ?></th>
						<th width="13%" align="center"><?php echo e(trans('user.ordermeal.order_amount')); ?></th>
						<th width="12%" align="center"><?php echo e(trans('user.ordermeal.status')); ?></th>
						<th width="12%" align="center"><?php echo e(trans('user.operation')); ?></th>
					</tr>
				</table>
			</div>
			<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="bd mtw">
					<table width="100%">
						<tr class="tr-th">
							<td colspan="5">
								<span class="dealtime"><?php echo e($value->created_at->format('Y-m-d H:i:s')); ?></span>
								<span class="ordersn">订单号：<a href="<?php echo e(route('user.ordercard.show', $value->order_sn)); ?>" title="订单详情" class="openwindow"><?php echo e($value->order_sn); ?></a></span>
							</td>
						</tr>
						<?php $__currentLoopData = $value->records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr class="tr-bd">
								<td width="63%" valign="top">
									<div class="s-item">
										<div class="s-pic">
											<img src="<?php echo e(uploadImage($val->upimage)); ?>" width="150" height="150">
										</div>
										<div class="s-info">
											<div class="s-name">
												<?php echo e($val->name); ?>

											</div>
											<div class="s-extra">
												价格：<?php echo e($val->price); ?>

											</div>
											<div class="s-extra">
												数量：<?php echo e($val->number); ?>

											</div>
										</div>
									</div>
								</td>
								<?php if($loop->iteration == 1): ?>
									<td width="13%" align="center" <?php echo $value->records->count() > 1 ? 'rowspan="'.$value->records->count().'"' : ''; ?>>
										<p><strong>￥<?php echo e(sprintf("%.2f",$value->order_amount)); ?></strong></p>
									</td>
									<td width="12%" align="center" <?php echo $value->records->count() > 1 ? 'rowspan="'.$value->records->count().'"' : ''; ?>>
										<p class="order-status"><?php echo e($value->order_status); ?></p>
										<p><a href="<?php echo e(route('user.ordercard.show', $value->order_sn)); ?>" title="订单详情" class="openwindow">订单详情</a></p>
									</td>
									<td width="12%" align="center" <?php echo $value->records->count() > 1 ? 'rowspan="'.$value->records->count().'"' : ''; ?>>
										<?php if($value->ifpay == 0): ?>
											<a href="<?php echo e(route('brand.card.pay', $value->order_sn)); ?>" target="_blank" title="立即付款" class="btn-pay">立即付款</a>
										<?php else: ?>
											<?php if($value->shop): ?>
												<a href="<?php echo e(route('brand.shop.show', $value->shop->id)); ?>" target="_blank" title="再次消费" class="btn-again">再次消费</a>
											<?php endif; ?>
										<?php endif; ?>
									</td>
								<?php endif; ?>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</table>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
		<?php echo $orders->links(); ?>

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