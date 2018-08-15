<?php $__env->startSection('content'); ?>
    <div class="crm-tabnav">
        <ul>
            <li class="on"><a href="<?php echo e(route('crm.account.index')); ?>">个人资料</a></li>
            <li><a href="<?php echo e(route('crm.account.password')); ?>">密码安全</a></li>
        </ul>
    </div>
    <div class="crm-main">
        <div class="crm-infobox">
            <div class="hd">
                <h4>个人资料</h4>
            </div>
            <div class="bd crm-form">
                <table>
                    <tr>
                        <td width="150" align="right"><label>所属部门</label></td>
                        <td><?php echo e(config('crm.group.'.auth('crm')->user()->group.'.name')); ?></td>
                    </tr>
                    <tr>
                        <td align="right"><label>真实姓名</label></td>
                        <td><?php echo e(auth('crm')->user()->realname); ?></td>
                    </tr>
                    <tr>
                        <td align="right"><label>手机号码</label></td>
                        <td><?php echo e(auth('crm')->user()->mobile); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.crm.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>