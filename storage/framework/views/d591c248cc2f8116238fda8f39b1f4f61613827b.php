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
<div class="cl">
<?php endif; ?>
    <?php echo $__env->yieldContent('content'); ?>
<?php if(!request()->ajax()): ?>
</div>
<div class="cfooter cl">
    <div class="container wp">
        <div class="link">
            <a href="javascript:;" title="关于我们">关于我们</a>
            <span class="pipe">|</span>
            <a href="javascript:;" title="联系我们">联系我们</a>
            <span class="pipe">|</span>
            <a href="<?php echo e(route('about.faq')); ?>" title="帮助中心">帮助中心</a>
            <span class="pipe">|</span>
            <a href="javascript:;" title="意见反馈">意见反馈</a>
            <span class="pipe">|</span>
            <a href="javascript:;" title="高新聘请">高新聘请</a>
            <span class="pipe">|</span>
            <a href="javascript:;" title="法律声明">法律声明</a>
            <span class="pipe">|</span>
            <a href="javascript:;" title="商家入驻">商家入驻</a>
            <span class="pipe">|</span>
            <a href="javascript:;" title="关于一卡通">关于一卡通</a>
        </div>
        <div class="copyright">
            <p>
                <span>全国商务合作热线：<?php echo e($setting['site_tel']); ?></span>
                <span class="mlm"><?php echo e($setting['sitename']); ?></span>
                <span class="mlm"><a href="http://www.miitbeian.gov.cn/" rel="nofollow" target="_blank"><?php echo e($setting['icp']); ?></a></span>
            </p>
            <p>Copyright © 2018 zhihui365.vip All Right Reserved </p>
        </div>
    </div>
</div>
<?php echo $__env->yieldContent('script'); ?>
</body>
</html>
<?php endif; ?>