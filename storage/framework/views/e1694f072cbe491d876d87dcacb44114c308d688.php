<?php if(!request()->ajax()): ?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>网站后台管理平台</title>
    <link href="<?php echo e(asset('static/css/admin.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('static/js/jbox/skin/green/jbox.css')); ?>" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo e(asset('static/js/jquery-1.10.1.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('static/js/jbox/jquery.jBox-2.3.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('static/js/laydate/laydate.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('static/js/admin.js')); ?>"></script>
</head>
<body>
<!-- 头部 -->
<div class="headtop cl">
    <div class="logo"><h2>后台管理</h2></div>
    <div class="nav">
        <ul class="">
            <?php $__currentLoopData = $topmenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tmenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="<?php echo e($tmenu->current  ? 'a' : ''); ?>"><a href="<?php echo e(route($tmenu->route)); ?>"><?php echo e($tmenu->title); ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <div class="info">
        <ul class="">
            <li class="manager">你好，<em><?php echo e(auth('admin')->user()->username); ?></em></li>
            <li><a href="<?php echo e(route('admin.logout')); ?>" class="ajaxbtn">退出</a></li>
            <li><a href="<?php echo e(route('admin.updatecache')); ?>" class="ajaxbtn">更新缓存</a></li>
            <li><a href="<?php echo e(route('index')); ?>" target="_blank">网站首页</a></li>
        </ul>
    </div>
</div>
<!-- /头部 -->

<div class="mainbody cl">
    <!-- 边栏 -->
    <div class="sidebar">
        <div id="menuBar" class="menu_box">
            <?php $__currentLoopData = $mainmenu->sortBy('displayorder'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <dl class="menu">
                <?php if($cmenu->route): ?>
                    <dd class="menu_item <?php echo e($cmenu->current  ? 'a' : ''); ?>"><a href="<?php echo e(route($cmenu->route)); ?>"><?php echo e($cmenu->title); ?></a></dd>
                <?php else: ?>
                    <dt class="menu_title"><?php echo e($cmenu->title); ?></dt>
                    <?php $__currentLoopData = $cmenu->children->sortBy('displayorder'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $smenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <dd class="menu_item <?php echo e($smenu->current  ? 'a' : ''); ?>"><a href="<?php echo e(route($smenu->route)); ?>"><?php echo e($smenu->title); ?></a></dd>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </dl>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <!-- /边栏 -->

    <!-- 内容区 -->
    <div class="mainbar" id="main-content">
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
    <!-- /内容区 -->
</div>
<?php endif; ?>
<?php echo $__env->yieldContent('script'); ?>
<?php if(!request()->ajax()): ?>
</body>
</html>
<?php endif; ?>