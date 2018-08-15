<?php $__env->startSection('content'); ?>
    <div class="crm-tabnav">
        <ul>
            <li><a href="<?php echo e(route('crm.customer.index')); ?>">客户管理</a></li>
            <li class="on"><a href="<?php echo e(route('crm.customer.referlist')); ?>">客户审核</a></li>
        </ul>
    </div>
    <div class="crm-main">
        <div class="crm-tabtit">
            <ul>
                <li class="<?php echo e(request('type') == 'passed' ? 'on' : ''); ?>"><a href="<?php echo e(route('crm.customer.referlist', ['type' => 'passed'])); ?>">已通过审核</a></li>
                <li class="<?php echo e(request('type') == 'auditing' ? 'on' : ''); ?>"><a href="<?php echo e(route('crm.customer.referlist', ['type' => 'auditing'])); ?>">待通过审核</a></li>
                <li class="<?php echo e(request('type') == 'rejected' ? 'on' : ''); ?>"><a href="<?php echo e(route('crm.customer.referlist', ['type' => 'rejected'])); ?>">未通过审核</a></li>
            </ul>
        </div>
        <div class="crm-list mtw">
            <?php if(request('type') == 'passed'): ?>
                <table>
                    <tr>
                        <th align="left">商户名称</th>
                        <th align="left" width="150">通过时间</th>
                        <th align="left" width="150">提交时间</th>
                        <th align="left" width="80">操作</th>
                    </tr>
                    <?php if(count($customers)): ?>
                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($value->name); ?></td>
                                <td><?php echo e($value->check_at ? $value->check_at->format('Y-m-d H:i') : '/'); ?></td>
                                <td><?php echo e($value->refer_at->format('Y-m-d H:i')); ?></td>
                                <td>
                                    <a href="<?php echo e(route('crm.customer.show',$value->id)); ?>"><?php echo e(trans('crm.view')); ?></a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="nodata">暂无数据</td>
                        </tr>
                    <?php endif; ?>
                </table>
            <?php endif; ?>
            <?php if(request('type') == 'auditing'): ?>
                <table>
                    <tr>
                        <th align="left">商户名称</th>
                        <th align="left" width="150">提交时间</th>
                        <th align="left" width="80">操作</th>
                    </tr>
                    <?php if(count($customers)): ?>
                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($value->name); ?></td>
                                <td><?php echo e($value->refer_at->format('Y-m-d H:i')); ?></td>
                                <td>
                                    <a href="<?php echo e(route('crm.customer.show',$value->id)); ?>"><?php echo e(trans('crm.view')); ?></a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="nodata">暂无数据</td>
                        </tr>
                    <?php endif; ?>
                </table>
            <?php endif; ?>
            <?php if(request('type') == 'rejected'): ?>
                <table>
                    <tr>
                        <th align="left">商户名称</th>
                        <th align="left" width="150">未通过原因</th>
                        <th align="left" width="150">未通过时间</th>
                        <th align="left" width="150">提交时间</th>
                        <th align="left" width="80">操作</th>
                    </tr>
                    <?php if(count($customers)): ?>
                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($value->name); ?></td>
                                <td><a class="dropDown toggleExtra" href="javascript:;"><span>展开</span></a></td>
                                <td><?php echo e($value->check_at ? $value->check_at->format('Y-m-d H:i') : '/'); ?></td>
                                <td><?php echo e($value->refer_at->format('Y-m-d H:i')); ?></td>
                                <td>
                                    <a href="<?php echo e(route('crm.customer.show',$value->id)); ?>"><?php echo e(trans('crm.view')); ?></a>
                                </td>
                            </tr>
                            <tr class="extra">
                                <td colspan="6">
                                    <div class="extra-reason">
                                        <p>请您核实，您提交的内容中可能存在以下问题： </p>
                                        <p style="color: red"><?php echo e($value->check_reason); ?></p>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="nodata">暂无数据</td>
                        </tr>
                    <?php endif; ?>
                </table>
            <?php endif; ?>
        </div>
        <?php echo $customers->appends(['name' => request('name')])->appends(['address' => request('address')])->links(); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $(function(){
            $(".crm-list table").on("click", "tr .toggleExtra",function() {
                var e = $(this).parents("tr"),
                    a = e.next();
                if(a.hasClass("extra")){
                    a.siblings(".extra").css("display", "none");
                    e.siblings("tr").not(a).removeClass("on");
                    if("none" === a.css("display")){
                        a.css("display", "table-row").addClass("on");
                        e.addClass("on");
                    }else{
                        a.css("display", "none").removeClass("on");
                        e.removeClass("on")
                    }
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.crm.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>