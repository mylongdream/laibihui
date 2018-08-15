<?php $__env->startSection('content'); ?>
    <div class="crm-tabnav">
        <ul>
            <li class="on"><a href="<?php echo e(route('crm.ordermeal.index')); ?>">自助点餐明细</a></li>
            <li><a href="<?php echo e(route('crm.ordermeal.create')); ?>">我要点餐</a></li>
        </ul>
    </div>
	<div class="crm-main">
        <form id="schform" name="schform" class="formsearch" method="get" action="<?php echo e(route('crm.ordermeal.index')); ?>">
            <div class="crm-search">
                <dl>
                    <dt>订单编号</dt>
                    <dd><input type="text" name="order_sn" class="schtxt" value="<?php echo e(request('order_sn')); ?>"></dd>
                </dl>
                <div class="schbtn"><button name="" type="submit">搜索</button></div>
            </div>
        </form>
		<div class="crm-list mtw">
			<table>
				<tr>
					<th align="left" width="180">订单编号</th>
					<th align="left">点餐金额</th>
					<th align="left">是否绑卡</th>
					<th align="left" width="100">处理状态</th>
					<th align="left" width="180">点餐时间</th>
				</tr>
				<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><a href="<?php echo e(route('crm.ordermeal.show', $value->order_sn)); ?>" title="查看订单" class="openwindow"><?php echo e($value->order_sn); ?></a></td>
						<td><?php echo e(isset($value->consume_money) ? $value->consume_money : '0'); ?>元</td>
						<td><?php echo e($value->bindcard ? '是' : '否'); ?></td>
						<td>
                            <?php if($value->status): ?>
							<?php echo e(trans('crm.ordermeal.status_'.$value->status)); ?>

                            <?php else: ?>
                                <a href="<?php echo e(route('crm.ordermeal.edit', $value->order_sn)); ?>" title="处理订单" class="openwindow"><?php echo e(trans('user.appoint.status_'.$value->status)); ?></a>
                            <?php endif; ?>
						</td>
                        <td><?php echo e($value->created_at->format('Y-m-d H:i:s')); ?></td>
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table>
		</div>
		<?php echo $orders->appends(['order_sn' => request('order_sn')])->links(); ?>

	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.crm.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>