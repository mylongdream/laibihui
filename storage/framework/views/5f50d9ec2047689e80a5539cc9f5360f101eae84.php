<?php $__env->startSection('content'); ?>
	<div class="crm-tabnav">
		<ul>
			<li><a href="<?php echo e(route('crm.ordercard.index')); ?>">已发行</a></li>
			<li class="on"><a href="<?php echo e(route('crm.ordercard.remain')); ?>">未发行</a></li>
		</ul>
	</div>
	<div class="crm-main">
        <form id="schform" name="schform" class="formsearch" method="get" action="<?php echo e(route('crm.ordercard.index')); ?>">
            <div class="crm-search">
                <dl>
                    <dt>卡号</dt>
                    <dd><input type="text" name="number" class="schtxt" value="<?php echo e(request('number')); ?>"></dd>
                </dl>
                <div class="schbtn"><button name="" type="submit">搜索</button></div>
            </div>
        </form>
		<div class="crm-list mtw">
			<table>
				<tr>
					<th align="left">卡号</th>
					<th align="left" width="180">提交时间</th>
				</tr>
				<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($value->number); ?></td>
                        <td><?php echo e($value->created_at->format('Y-m-d H:i:s')); ?></td>
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table>
		</div>
		<?php echo $orders->appends(['number' => request('number')])->links(); ?>

	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.crm.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>