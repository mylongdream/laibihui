<?php if(!request()->ajax()): ?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:ds="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e($setting['sitename'] ? $setting['sitename'] : ''); ?>CRM管理系统</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link href="<?php echo e(asset('static/css/crm.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('static/js/jbox/skin/default/jbox.css')); ?>" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo e(asset('static/js/jquery-1.11.1.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('static/js/jquery.SuperSlide.2.1.2.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('static/js/jbox/jquery.jBox-2.3.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('static/js/common.js')); ?>"></script>
</head>
<body>
<?php echo $__env->make('layouts.crm.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="crm-body">
    <div class="wp">
        <div class="crm-container cl">
            <div class="sd">
                <?php echo $__env->make('layouts.crm.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="mn">
                    <?php endif; ?>
                    <?php if(request()->ajax()): ?>
                        <div class="ajaxmain">
                            <?php endif; ?>
                            <?php echo $__env->yieldContent('content'); ?>
                            <?php if(request()->ajax()): ?>
                        </div>
                    <?php endif; ?>
                    <?php if(!request()->ajax()): ?>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('layouts.crm.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<?php echo $__env->yieldContent('script'); ?>
<?php if(!request()->ajax()): ?>
</body>
</html>
<?php endif; ?>