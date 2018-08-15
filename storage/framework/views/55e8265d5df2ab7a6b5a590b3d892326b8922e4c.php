<?php $__env->startSection('content'); ?>
	<div class="crm-main">
        <form id="schform" name="schform" class="formsearch" method="get" action="<?php echo e(route('crm.appoint.index')); ?>">
            <div class="crm-search">
		<dl>
			<dd>
				<select class="schselect" name="status" onchange='this.form.submit()'>
					<option value="0" <?php echo empty(request('status')) ? 'selected="selected"' : ''; ?>>待处理</option>
					<option value="1" <?php echo request('status') == 1 ? 'selected="selected"' : ''; ?>>已接受</option>
					<option value="2" <?php echo request('status') == 2 ? 'selected="selected"' : ''; ?>>已拒绝</option>
					<option value="3" <?php echo request('status') == 3 ? 'selected="selected"' : ''; ?>>已取消</option>
				</select>
			</dd>
		</dl>
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
					<th align="left">姓名</th>
					<th align="left">预约时间</th>
					<th align="left">预约人数</th>
					<th align="left" width="80">状态</th>
					<th align="left" width="160">提交时间</th>
					<?php if(empty(request('status'))): ?>
					<th align="left" width="40">操作</th>
					<?php endif; ?>
				</tr>
				<?php $__currentLoopData = $appoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><a href="<?php echo e(route('crm.appoint.show', $value->order_sn)); ?>" class="openwindow" title="查看订单"><?php echo e($value->order_sn); ?></a></td>
					<td><?php echo e($value->realname); ?></td>
						<td><?php echo e($value->appoint_at ? $value->appoint_at->format('Y-m-d H:i') : '/'); ?></td>
						<td><?php echo e($value->number); ?> 人</td>
						<td><?php echo e(trans('user.appoint.status_'.$value->status)); ?></td>
                        <td><?php echo e($value->created_at->format('Y-m-d H:i:s')); ?></td>
						<?php if(empty(request('status'))): ?>
						<td><a href="<?php echo e(route('crm.appoint.edit', $value->order_sn)); ?>" class="openwindow" title="处理订单">处理</a></td>
						<?php endif; ?>
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table>
		</div>
		<?php echo $appoints->appends(['order_sn' => request('order_sn')])->links(); ?>

	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.crm.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>