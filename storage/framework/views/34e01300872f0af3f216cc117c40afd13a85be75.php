<?php $__env->startSection('content'); ?>
    <div class="weui-tab">
        <div class="wp">
            <div class="topheader">
                <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                <div class="nav"><?php echo e(trans('user.promotion')); ?></div>
            </div>
            <div class="weui-panel">
                <div class="weui-panel__bd">
                    <img style="width:100%" src="<?php echo e(route('mobile.user.promotion.qrcode', ['getcode' => 1])); ?>" alt="">
                </div>
            </div>
            <?php if(strpos(request()->userAgent(), 'MicroMessenger') !== false): ?>
            <div class="weui-btn-area">
                <button class="weui-btn weui-btn_primary open-popup" data-target="#pop-share">马上分享</button>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="close-popup" id="pop-share" data-target="#pop-share">
        <img class="" src="<?php echo e(asset('static/image/mobile/share-it.png?'.time())); ?>">
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php if(strpos(request()->userAgent(), 'MicroMessenger') !== false): ?>
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
    <script type="text/javascript">
        wx.config(<?php echo app('wechat.official_account')->jssdk->buildConfig(array('onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ', 'onMenuShareWeibo'), false); ?>);
        wx.ready(function() {
            wx.onMenuShareAppMessage({
                title: '',
                desc: '',
                link: '<?php echo e($shareData['link']); ?>',
                imgUrl: ''
            });
            wx.onMenuShareTimeline({
                title: '',
                link: '<?php echo e($shareData['link']); ?>',
                imgUrl: ''
            });
        });
    </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>