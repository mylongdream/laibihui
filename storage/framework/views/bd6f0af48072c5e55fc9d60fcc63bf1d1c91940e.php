<?php $__env->startSection('content'); ?>
    <?php if(!request()->ajax()): ?>
        <div class="crm-main">
            <div class="order-show mtw">
                <table>
                    <tr>
                        <th align="right">创建时间</th>
                        <td><?php echo e($consume->created_at ? $consume->created_at->format('Y-m-d H:i') : '/'); ?></td>
                    </tr>
                    <tr>
                        <th width="150" align="right">订单编号</th>
                        <td><?php echo e(isset($consume->order_sn) ? $consume->order_sn : '/'); ?></td>
                    </tr>
                    <tr>
                        <th align="right">消费用户</th>
                        <td><?php echo e($consume->user->username); ?></td>
                    </tr>
                    <tr>
                        <th align="right">消费金额</th>
                        <td><strong>￥<?php echo e(sprintf("%.2f",$consume->consume_money)); ?></strong>
                    </tr>
                    <tr>
                        <th align="right">折后金额</th>
                        <td><strong>￥<?php echo e(sprintf("%.2f",$consume->discount_money)); ?></strong></td>
                    </tr>
                    <tr>
                        <th align="right">实际收入</th>
                        <td><strong>￥<?php echo e(sprintf("%.2f",$consume->indiscount_money)); ?></strong></td>
                    </tr>
                    <tr>
                        <th align="right">支付方式</th>
                        <td><?php echo e(trans('common.paytype.'.$consume->pay_type)); ?></td>
                    </tr>
                    <tr>
                        <th align="right">付款状态</th>
                        <td><?php echo e($consume->ifpay ? '已付款' : '待付款'); ?></td>
                    </tr>
                    <?php if($consume->pay_at): ?>
                        <tr>
                            <th align="right">付款时间</th>
                            <td><?php echo e($consume->pay_at ? $consume->pay_at->format('Y-m-d H:i') : '/'); ?></td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    <?php else: ?>
        <div class="order-show" style="width: 500px;">
            <table>
                <tr>
                    <th align="right">创建时间</th>
                    <td><?php echo e($consume->created_at ? $consume->created_at->format('Y-m-d H:i') : '/'); ?></td>
                </tr>
                <tr>
                    <th width="150" align="right">订单编号</th>
                    <td><?php echo e(isset($consume->order_sn) ? $consume->order_sn : '/'); ?></td>
                </tr>
                <tr>
                    <th align="right">消费用户</th>
                    <td><?php echo e($consume->user->username); ?></td>
                </tr>
                <tr>
                    <th align="right">消费金额</th>
                    <td><strong>￥<?php echo e(sprintf("%.2f",$consume->consume_money)); ?></strong>
                </tr>
                <tr>
                    <th align="right">折后金额</th>
                    <td><strong>￥<?php echo e(sprintf("%.2f",$consume->discount_money)); ?></strong></td>
                </tr>
                <tr>
                    <th align="right">实际收入</th>
                    <td><strong>￥<?php echo e(sprintf("%.2f",$consume->indiscount_money)); ?></strong></td>
                </tr>
                <tr>
                    <th align="right">支付方式</th>
                    <td><?php echo e(trans('common.paytype.'.$consume->pay_type)); ?></td>
                </tr>
                <tr>
                    <th align="right">付款状态</th>
                    <td><?php echo e($consume->ifpay ? '已付款' : '待付款'); ?></td>
                </tr>
                <?php if($consume->pay_at): ?>
                <tr>
                    <th align="right">付款时间</th>
                    <td><?php echo e($consume->pay_at ? $consume->pay_at->format('Y-m-d H:i') : '/'); ?></td>
                </tr>
                <?php endif; ?>
            </table>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.crm.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>