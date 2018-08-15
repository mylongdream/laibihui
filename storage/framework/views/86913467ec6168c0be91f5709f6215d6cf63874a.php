<?php $__env->startSection('content'); ?>
	<div class="crm-main">
        <form id="schform" name="schform" class="formsearch" method="get" action="<?php echo e(route('crm.ordermeal.index')); ?>">
            <div class="crm-search">
                <dl>
                    <dt>查询日期</dt>
                    <dd><input type="text" name="date" class="schtxt" value="<?php echo e(request('date')); ?>" onclick="laydate({max: laydate.now(),format:'YYYY-MM-DD'})"></dd>
                </dl>
                <div class="schbtn"><button name="" type="submit">搜索</button></div>
            </div>
        </form>
		<div class="crm-list mtw">
			<table>
				<tr>
					<th align="left">备注信息</th>
					<th align="left" width="100">提现金额</th>
					<th align="left" width="100">状态</th>
					<th align="left" width="180">时间</th>
				</tr>
				<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($value->order_sn); ?></td>
						<td><?php echo e($value->order_sn); ?></td>
						<td><?php echo e(trans('user.appoint.status_'.$value->status)); ?></td>
                        <td><?php echo e($value->created_at->format('Y-m-d H:i:s')); ?></td>
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table>
		</div>
		<?php echo $orders->appends(['date' => request('date')])->links(); ?>

	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
	<script type="text/javascript" src="<?php echo e(asset('static/js/laydate/laydate.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.crm.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>