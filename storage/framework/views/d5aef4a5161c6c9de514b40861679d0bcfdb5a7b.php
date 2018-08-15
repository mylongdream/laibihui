<?php $__env->startSection('content'); ?>
    <div class="crm-tabnav">
        <ul>
            <li class="on"><a href="<?php echo e(route('crm.customer.index')); ?>">客户管理</a></li>
            <li><a href="<?php echo e(route('crm.customer.referlist')); ?>">客户审核</a></li>
        </ul>
    </div>
    <div class="crm-main">
        <form id="schform" name="schform" class="formsearch" method="get" action="<?php echo e(route('crm.customer.index')); ?>">
            <div class="crm-search">
                <dl>
                    <dt><?php echo e(trans('crm.customer.name')); ?></dt>
                    <dd><input type="text" name="name" class="schtxt" value="<?php echo e(request('name')); ?>"></dd>
                </dl>
                <div class="schbtn"><button name="" type="submit">搜索</button></div>
            </div>
        </form>
        <div class="crm-list mtw">
            <table>
                <tr>
                    <th align="left" width="180">商户名称</th>
                    <th align="left">商户地址</th>
                    <th align="left" width="120">联系方式</th>
                    <th align="left" width="100">跟进情况</th>
                    <th align="left" width="80">审核</th>
                    <th align="left" width="80">操作</th>
                </tr>
                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><a href="<?php echo e(route('crm.customer.show',$value->id)); ?>" class="openwindow" title="商户详情"><?php echo e($value->name); ?></a></td>
                        <td><?php echo e($value->address); ?></td>
                        <td><?php echo e($value->phone); ?></td>
                        <td><?php echo e(trans('crm.customer.status_'.$value->status)); ?></td>
                        <td>
                            <?php if($value->status == 'finish'): ?>
                            <a href="<?php echo e(route('crm.customer.refer',$value->id)); ?>" class="">提交审核</a>
                            <?php else: ?>
                                <span>/</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo e(route('crm.customer.edit',$value->id)); ?>" class=""><?php echo e(trans('crm.edit')); ?></a>
                            <a href="<?php echo e(route('crm.customer.destroy',$value->id)); ?>" class="mlm delbtn"><?php echo e(trans('crm.destroy')); ?></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        </div>
        <?php echo $customers->appends(['name' => request('name')])->appends(['address' => request('address')])->links(); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.crm.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>