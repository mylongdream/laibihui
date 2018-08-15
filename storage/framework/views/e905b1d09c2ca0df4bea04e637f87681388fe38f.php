<?php $__env->startSection('content'); ?>
    <div class="crm-tabnav">
        <ul>
            <li><a href="<?php echo e(route('crm.consume.index')); ?>">消费明细</a></li>
            <li class="on"><a href="<?php echo e(route('crm.consume.balance')); ?>">每日结算</a></li>
        </ul>
    </div>
	<div class="crm-main">
        <form id="schform" name="schform" class="formsearch" method="get" action="<?php echo e(route('crm.consume.balance')); ?>">
            <div class="crm-search">
                <dl>
                    <dt>查询月份</dt>
                    <dd><input type="text" name="month" class="schtxt" value="<?php echo e($datetime->format('Y-m')); ?>" onclick="laydate({max: laydate.now(-1),format:'YYYY-MM'})"></dd>
                </dl>
                <div class="schbtn"><button name="" type="submit">搜索</button></div>
            </div>
        </form>
		<div class="crm-list mtw">
			<table>
				<tr>
					<th align="left">时间</th>
					<th align="left">线上支付</th>
					<th align="left">线下付款</th>
					<th align="left">实收金额</th>
				</tr>
				<?php if(count($consumes)): ?>
				<?php $__currentLoopData = $consumes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($value->date->format('Y-m-d')); ?></td>
						<td><strong>￥<?php echo e(sprintf("%.2f",$value->online)); ?></strong></td>
						<td><strong>￥<?php echo e(sprintf("%.2f",$value->offline)); ?></strong></td>
						<td><strong>￥<?php echo e(sprintf("%.2f",$value->account)); ?></strong></td>
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php else: ?>
					<tr>
						<td colspan="4" class="nodata">暂无数据</td>
					</tr>
				<?php endif; ?>
			</table>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
	<script type="text/javascript" src="<?php echo e(asset('static/js/laydate/laydate.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.crm.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>