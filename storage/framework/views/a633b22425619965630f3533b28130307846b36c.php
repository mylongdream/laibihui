<?php $__env->startSection('content'); ?>
    <div class="crm-main">
        <form id="schform" name="schform" class="formsearch" method="get" action="<?php echo e(route('crm.checkcustomer.index')); ?>">
            <div class="crm-search">
                <dl>
                    <dd>
                        <select class="schselect" name="type" onchange='this.form.submit()'>
                            <option value="passed" <?php echo request('type') == 'passed' ? 'selected="selected"' : ''; ?>>通过客户</option>
                            <option value="auditing" <?php echo request('type') == 'auditing' ? 'selected="selected"' : ''; ?>>待审客户</option>
                            <option value="rejected" <?php echo request('type') == 'rejected' ? 'selected="selected"' : ''; ?>>驳回客户</option>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>商户名称</dt>
                    <dd><input type="text" name="name" class="schtxt" value="<?php echo e(request('name')); ?>"></dd>
                </dl>
                <div class="schbtn"><button name="" type="submit">搜索</button></div>
            </div>
        </form>
        <div class="crm-list mtw">
            <?php if(request('type') == 'passed'): ?>
                <table>
                    <tr>
                        <th align="left" width="180">商户名称</th>
                        <th align="left">商户地址</th>
                        <th align="left" width="120">联系方式</th>
                        <th align="left" width="120">提交业务员</th>
                        <th align="left" width="120">通过时间</th>
                    </tr>
                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><a href="<?php echo e(route('crm.checkcustomer.show',$value->id)); ?>" class="openwindow" title="商户详情"><?php echo e($value->name); ?></a></td>
                            <td><?php echo e($value->address); ?></td>
                            <td><?php echo e($value->phone); ?></td>
                            <td><?php echo e($value->user ? $value->user->realname : '/'); ?></td>
                            <td><?php echo e($value->check_at ? $value->check_at->format('Y-m-d H:i') : '/'); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            <?php endif; ?>
            <?php if(request('type') == 'auditing'): ?>
                <table>
                    <tr>
                        <th align="left" width="180">商户名称</th>
                        <th align="left">商户地址</th>
                        <th align="left" width="120">联系方式</th>
                        <th align="left" width="120">提交业务员</th>
                        <th align="left" width="80">操作</th>
                    </tr>
                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><a href="<?php echo e(route('crm.checkcustomer.show',$value->id)); ?>" class="openwindow" title="商户详情"><?php echo e($value->name); ?></a></td>
                            <td><?php echo e($value->address); ?></td>
                            <td><?php echo e($value->phone); ?></td>
                            <td><?php echo e($value->user ? $value->user->realname : '/'); ?></td>
                            <td>
                                <a href="<?php echo e(route('crm.checkcustomer.check',$value->id)); ?>" class="">点击审核</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            <?php endif; ?>
            <?php if(request('type') == 'rejected'): ?>
                <table>
                    <tr>
                        <th align="left" width="180">商户名称</th>
                        <th align="left">商户地址</th>
                        <th align="left" width="120">联系方式</th>
                        <th align="left" width="120">提交业务员</th>
                        <th align="left" width="120">驳回时间</th>
                    </tr>
                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><a href="<?php echo e(route('crm.checkcustomer.show',$value->id)); ?>" class="openwindow" title="商户详情"><?php echo e($value->name); ?></a></td>
                            <td><?php echo e($value->address); ?></td>
                            <td><?php echo e($value->phone); ?></td>
                            <td><?php echo e($value->user ? $value->user->realname : '/'); ?></td>
                            <td><?php echo e($value->check_at ? $value->check_at->format('Y-m-d H:i') : '/'); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            <?php endif; ?>
        </div>
        <?php echo $customers->appends(['name' => request('name')])->appends(['type' => request('type')])->links(); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.crm.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>