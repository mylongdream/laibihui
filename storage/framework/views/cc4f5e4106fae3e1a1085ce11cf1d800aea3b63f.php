<?php $__env->startSection('content'); ?>
    <?php if(!request()->ajax()): ?>
        <div class="crm-tabnav">
            <ul>
                <li class="on"><a href="<?php echo e(route('crm.ordermeal.index')); ?>">自助点餐明细</a></li>
                <li><a href="<?php echo e(route('crm.ordermeal.create')); ?>">我要点餐</a></li>
            </ul>
        </div>
        <div class="crm-main">
            <form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('crm.ordermeal.update', $order->order_sn)); ?>">
                <?php echo method_field('PUT'); ?>

                <?php echo csrf_field(); ?>

                <div class="order-show">
                    <table>
                        <tr>
                            <th width="20%" align="right">订单编号</th>
                            <td><?php echo e($order->order_sn ? $order->order_sn : '/'); ?></td>
                        </tr>
                        <tr>
                            <th align="right">用户是否绑卡</th>
                            <td><?php echo e($order->bindcard ? '是' : '否'); ?></td>
                        </tr>
                        <tr>
                            <th align="right">所点菜品</th>
                            <td>
                                <?php $__currentLoopData = $order->records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                        </tr>
                        <?php if($order->remark): ?>
                            <tr>
                                <th align="right">顾客要求</th>
                                <td><?php echo e($order->remark ? $order->remark : '/'); ?></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
                <div class="mtw">
                    <table width="100%">
                        <tr>
                            <td width="33%">消费总金额：<?php echo e(isset($order->consume_money) ? $order->consume_money : '0'); ?>元</td>
                            <td width="33%">优惠金额：<?php echo e($order->consume_money - $order->order_amount); ?>元</td>
                            <td width="34%">实付金额：<?php echo e(isset($order->order_amount) ? $order->order_amount : '0'); ?>元</td>
                        </tr>
                    </table>
                </div>
                <div class="order-show mtw">
                    <table width="100%">
                        <tr>
                            <td align="center">
                                <label class="radio" for="status_1"><input value="1" name="status" id="status_1" type="radio" checked>已确认</label>
                                <label class="radio" for="status_2"><input value="2" name="status" id="status_2" type="radio" >已取消</label>
                            </td>
                        </tr>
                        <tr>
                            <td align="center"><button value="true" name="savesubmit" type="submit" class="button">提 交</button></td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    <?php else: ?>
        <div style="width: 650px;">
            <form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('crm.ordermeal.update', $order->order_sn)); ?>">
                <?php echo method_field('PUT'); ?>

                <?php echo csrf_field(); ?>

                <div class="order-show">
                    <table>
                        <tr>
                            <th width="150" align="right">订单编号</th>
                            <td><?php echo e($order->order_sn ? $order->order_sn : '/'); ?></td>
                        </tr>
                        <tr>
                            <th align="right">用户是否绑卡</th>
                            <td><?php echo e($order->bindcard ? '是' : '否'); ?></td>
                        </tr>
                        <tr>
                            <th align="right">所点菜品</th>
                            <td>
                                <?php $__currentLoopData = $order->records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                        </tr>
                        <?php if($order->remark): ?>
                            <tr>
                                <th align="right">顾客要求</th>
                                <td><?php echo e($order->remark ? $order->remark : '/'); ?></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
                <div class="order-show mtw">
                    <table width="100%">
                        <tr>
                            <td width="33%">消费总金额：<?php echo e(isset($order->consume_money) ? $order->consume_money : '0'); ?>元</td>
                            <td width="33%">优惠金额：<?php echo e($order->consume_money - $order->order_amount); ?>元</td>
                            <td width="34%">实付金额：<?php echo e(isset($order->order_amount) ? $order->order_amount : '0'); ?>元</td>
                        </tr>
                    </table>
                </div>
                <div class="order-show mtw">
                    <table width="100%">
                        <tr>
                            <td align="center">
                                <label class="radio" for="status_1"><input value="1" name="status" id="status_1" type="radio" checked>已确认</label>
                                <label class="radio" for="status_2"><input value="2" name="status" id="status_2" type="radio" >已取消</label>
                            </td>
                        </tr>
                        <tr>
                            <td align="center"><button value="true" name="savesubmit" type="submit" class="button">提 交</button></td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.crm.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>