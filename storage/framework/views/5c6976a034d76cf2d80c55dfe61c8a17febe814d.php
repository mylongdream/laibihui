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
		<div class="messagebox">
			<div class="messagetip">
				<p class="infotitle"><?php echo e($info); ?></p>
				<p class="marginbot">
					<?php if(isset($url)): ?>
						<a href="<?php echo e($url); ?>">如果您的浏览器没有自动跳转，请点击这里</a>
					<?php else: ?>
						<a href="javascript:history.back(-1);">请点击这里返回上一页</a>
					<?php endif; ?>
				</p>
			</div>
		</div>
	</div>
</div>
<?php echo $__env->make('layouts.crm.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>
</html>