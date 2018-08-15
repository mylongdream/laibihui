<?php $__env->startSection('content'); ?>
    <div class="tbedit" style="margin:0">
        <div class="tbhead cl">
            <div class="z">
                <h3>个人信息</h3>
            </div>
        </div>
        <table>
            <tr>
                <td width="150" align="right"><?php echo e(trans('admin.profileinfo.username')); ?></td>
                <td><?php echo e(auth('admin')->user()->username); ?></td>
            </tr>
            <tr>
                <td width="150" align="right"><?php echo e(trans('admin.profileinfo.lastlogin')); ?></td>
                <td><?php echo e(auth('admin')->user()->lastlogin->format('Y-m-d H:i')); ?></td>
            </tr>
            <tr>
                <td width="150" align="right"><?php echo e(trans('admin.profileinfo.lastip')); ?></td>
                <td><?php echo e(auth('admin')->user()->lastip); ?></td>
            </tr>
            <tr>
                <td width="150" align="right"><?php echo e(trans('admin.profileinfo.logincount')); ?></td>
                <td><?php echo e(auth('admin')->user()->logincount); ?></td>
            </tr>
        </table>
    </div>
    <div class="tbedit">
        <div class="tbhead cl">
            <div class="z">
                <h3>系统信息</h3>
            </div>
        </div>
        <table>
            <tr>
                <td width="150" align="right"><?php echo e(trans('admin.system.server.os')); ?></td>
                <td><?php echo e($systeminfo['os']); ?></td>
            </tr>
            <tr>
                <td align="right"><?php echo e(trans('admin.system.server.server_domain')); ?></td>
                <td><?php echo e($systeminfo['server_domain']); ?></td>
            </tr>
            <tr>
                <td align="right"><?php echo e(trans('admin.system.server.web_server')); ?></td>
                <td><?php echo e($systeminfo['web_server']); ?></td>
            </tr>
            <tr>
                <td align="right"><?php echo e(trans('admin.system.server.php_ver')); ?></td>
                <td><?php echo e($systeminfo['php_ver']); ?></td>
            </tr>
            <tr>
                <td align="right"><?php echo e(trans('admin.system.server.mysql_ver')); ?></td>
                <td><?php echo e($systeminfo['mysql_ver']); ?></td>
            </tr>
            <tr>
                <td align="right"><?php echo e(trans('admin.system.server.max_filesize')); ?></td>
                <td><?php echo e($systeminfo['max_filesize']); ?></td>
            </tr>
            <tr>
                <td align="right"><?php echo e(trans('admin.system.server.mysql_size')); ?></td>
                <td><?php echo e($systeminfo['mysql_size']); ?></td>
            </tr>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>