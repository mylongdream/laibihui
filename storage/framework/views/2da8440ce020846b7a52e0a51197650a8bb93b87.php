<?php $__env->startSection('content'); ?>
    <div class="crm-tabnav">
        <ul>
            <li class="on"><a href="<?php echo e(route('crm.consume.index')); ?>">消费明细</a></li>
            <li><a href="<?php echo e(route('crm.consume.balance')); ?>">每日结算</a></li>
        </ul>
    </div>
	<div class="crm-main">
        <form id="schform" name="schform" class="formsearch" method="get" action="<?php echo e(route('crm.consume.index')); ?>">
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
					<th align="left">创建时间</th>
					<th align="left">订单编号</th>
					<th align="left">消费金额</th>
					<th align="left">折后金额</th>
					<th align="left">实收金额</th>
					<th align="left">支付方式</th>
					<th align="left">状态</th>
				</tr>
				<?php $__currentLoopData = $consumes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($value->created_at->format('Y-m-d H:i:s')); ?></td>
						<td><a href="<?php echo e(route('crm.consume.show', $value->order_sn)); ?>" class="openwindow" title="订单详情"><?php echo e($value->order_sn); ?></a></td>
						<td><strong>￥<?php echo e(sprintf("%.2f",$value->consume_money)); ?></strong>
						<td><strong>￥<?php echo e(sprintf("%.2f",$value->discount_money)); ?></strong></td>
						<td><strong>￥<?php echo e(sprintf("%.2f",$value->indiscount_money)); ?></strong></td>
						<td><?php echo e(trans('common.paytype.'.$value->pay_type)); ?></td>
						<td><?php echo e($value->ifpay ? '已付款' : '待付款'); ?></td>
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table>
		</div>
		<?php echo $consumes->appends(['order_sn' => request('order_sn')])->links(); ?>

	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.crm.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>