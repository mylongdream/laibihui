<?php if(!request()->ajax()): ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:ds="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(isset($setting['seo_title']) ? $setting['seo_title'] : ''); ?><?php echo e($setting['sitename'] ? ' - '.$setting['sitename'] : ''); ?></title>
    <meta name="description" content="<?php echo e(isset($setting['seo_keywords']) ? $setting['seo_keywords'] : ''); ?>">
    <meta name="keywords" content="<?php echo e(isset($setting['seo_description']) ? $setting['seo_description'] : ''); ?>">
    <link href="<?php echo e(asset('static/css/common.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('static/css/module.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('static/js/jbox/skin/default/jbox.css')); ?>" rel="stylesheet" type="text/css">
    <?php echo $__env->yieldContent('style'); ?>
    <script type="text/javascript" src="<?php echo e(asset('static/js/jquery-1.11.1.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('static/js/jquery.SuperSlide.2.1.2.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('static/js/jbox/jquery.jBox-2.3.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('static/js/laydate/laydate.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('static/js/common.js')); ?>"></script>
</head>
<body>
<?php echo $__env->make('layouts.common.header_simple', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-content cl">
<?php endif; ?>
    <?php echo $__env->yieldContent('content'); ?>
<?php if(!request()->ajax()): ?>
</div>
<?php echo $__env->make('layouts.common.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldContent('script'); ?>
</body>
</html>
<?php endif; ?>