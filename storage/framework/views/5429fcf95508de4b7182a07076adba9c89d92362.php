<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('user.ordercard')); ?></h3></div>
	</div>
	<?php if(count($orders)): ?>
		<div class="order-list mtw">
			<div class="hd">
				<table width="100%">
					<tr>
						<th width="52%" align="center"><?php echo e(trans('user.ordercard.consignee')); ?></th>
                        <th width="10%" align="center"><?php echo e(trans('user.ordercard.order_type')); ?></th>
						<th width="14%" align="center"><?php echo e(trans('user.ordercard.order_amount')); ?></th>
						<th width="12%" align="center"><?php echo e(trans('user.ordercard.status')); ?></th>
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
						<tr class="tr-bd">
							<td width="52%" valign="top">
                                <div class="s-item">
                                    <div class="s-pic">
                                            <img src="<?php echo e(asset('static/image/mobile/card.jpg')); ?>" width="150" height="150">
                                    </div>
                                    <div class="s-info">
                                        <div class="s-name">
											知惠网联名卡
                                        </div>
                                        <div class="s-extra">
											办卡方式：<?php echo e(trans('user.ordercard.order_type_'.$value->order_type)); ?>

                                        </div>
                                    </div>
                                </div>
							</td>
                            <td width="10%" align="center"><?php echo e(trans('user.ordercard.order_type_'.$value->order_type)); ?></td>
							<td width="14%" align="center">
								<p><strong>￥<?php echo e(sprintf("%.2f",$value->order_amount)); ?></strong></p>
                                <p style="color:#6c6c6c;margin-top: 8px">(含运费：￥<?php echo e(sprintf("%.2f",$value->shipping_fee)); ?>)</p>
                            </td>
							<td width="12%" align="center">
								<p class="order-status"><?php echo e(trans('user.ordercard.status_'.$value->order_status.$value->shipping_status.$value->pay_status)); ?></p>
								<p><a href="<?php echo e(route('user.ordercard.show', $value->order_sn)); ?>" title="订单详情" class="openwindow">订单详情</a></p>
							</td>
							<td width="12%" align="center">
								<?php if($value->order_status == 0 && $value->shipping_status == 0 && $value->pay_status == 0): ?>
									<a href="<?php echo e(route('brand.card.pay', $value->order_sn)); ?>" target="_blank" title="立即付款" class="btn-pay">立即付款</a>
									<a href="<?php echo e(route('user.ordercard.cancel', $value->order_sn)); ?>" title="取消订单" class="mtm btn-again ajaxget confirmbtn">取消订单</a>
								<?php endif; ?>
							</td>
						</tr>
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