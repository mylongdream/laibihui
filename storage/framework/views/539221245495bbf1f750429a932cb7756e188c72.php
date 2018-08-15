<?php if(!request()->ajax()): ?>
        <!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width,user-scalable=0,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="format-detection" content="telephone=no" />
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(isset($setting['seo_title']) ? $setting['seo_title'] : ''); ?><?php echo e($setting['sitename'] ? ' - '.$setting['sitename'] : ''); ?></title>
    <meta name="description" content="<?php echo e(isset($setting['seo_keywords']) ? $setting['seo_keywords'] : ''); ?>">
    <meta name="keywords" content="<?php echo e(isset($setting['seo_description']) ? $setting['seo_description'] : ''); ?>">
	<script>
		function w(){
			var BASE_WIDTH = 640, ROOT_FONT_SIZE = 100;
			var e = document.documentElement.getBoundingClientRect().width;
			e = e > BASE_WIDTH ? BASE_WIDTH : e;
			document.querySelector("html").style.fontSize = e / (BASE_WIDTH / ROOT_FONT_SIZE) + "px"
		}
		window.addEventListener("resize",function(){w()}),w()
	</script>
	<?php echo $__env->yieldContent('style'); ?>
	<link href="<?php echo e(asset('static/css/weui.min.css?'.time())); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('static/css/mobile.css?'.time())); ?>" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo e(asset('static/js/jquery-1.11.1.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('static/js/jquery.cookie.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('static/js/weui.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('static/js/fastclick.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('static/js/mobile.js?'.time())); ?>"></script>
	<?php echo $__env->yieldContent('head'); ?>
</head>
<body>
<?php endif; ?>
<?php echo $__env->yieldContent('content'); ?>
<?php echo $__env->yieldContent('script'); ?>
<?php if(!request()->ajax()): ?>
<?php $__env->startSection('share'); ?>
    <?php if(isset($sharedata)): ?>
	<script type="text/javascript" src="http://qzonestyle.gtimg.cn/qzone/qzact/common/share/share.js"></script>
	<script type="text/javascript">
        var shareurl = "<?php echo e($sharedata['url']); ?>";
        setShareInfo({
            title: "<?php echo e($sharedata['title']); ?>",
            summary: "<?php echo e($sharedata['summary']); ?>",
            pic: "<?php echo e($sharedata['pic']); ?>",
            url: shareurl ? shareurl : window.location.href,
            <?php if(isset($signPackage)): ?>
            WXconfig:       {
                swapTitleInWX: false,
                appId: "<?php echo e($signPackage['appId']); ?>",
                timestamp: "<?php echo e($signPackage['timestamp']); ?>",
                nonceStr: "<?php echo e($signPackage['nonceStr']); ?>",
                signature: "<?php echo e($signPackage['signature']); ?>"
            }
            <?php endif; ?>
        });
	</script>
    <?php endif; ?>
<?php echo $__env->yieldSection(); ?>
</body>
</html>
<?php endif; ?>