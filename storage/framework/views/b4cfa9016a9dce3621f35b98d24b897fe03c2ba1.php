<?php $__env->startSection('style'); ?>
    <link href="<?php echo e(asset('static/css/swiper.min.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="weui-tab">
        <div class="weui-tab__panel">
            <div class="main-body">
                <div class="wp">
                    <div class="pbw">
                        <div class="topheader">
                            <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                            <div class="nav">顾客点评</div>
                        </div>
                        <div class="weui-cells shop-comment mtm">
                            <?php if(count($commentlist)): ?>
                                <?php $__currentLoopData = $commentlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="weui-cell" style="align-items:initial;">
                                        <div class="weui-cell__hd">
                                            <img src="<?php echo e($comment->user && $comment->user->headimgurl ? uploadImage($comment->user->headimgurl) : asset('static/image/common/getheadimg.jpg')); ?>" class="radius" style="width:50px;height:50px;margin-right:10px;display:block">
                                        </div>
                                        <div class="weui-cell__bd">
                                            <p style="font-size: 12px;color: #999"><?php echo e($comment->user ? $comment->user->username : '匿名'); ?></p>
                                            <p style="font-size: 12px;color: #999"><?php echo e($comment->created_at->format('Y-m-d H:i')); ?></p>
                                            <div class="comment-score">
                                                <span>服务：<?php echo e($comment->service); ?>分</span>
                                                <span>环境：<?php echo e($comment->environment); ?>分</span>
                                                <span>性价比：<?php echo e($comment->priceratio); ?>分</span>
                                            </div>
                                            <p style="font-size: 14px;margin-top: 5px"><?php echo e($comment->message); ?></p>
                                            <?php if($comment->upphoto): ?>
                                                <div class="comment-photo">
                                                    <ul>
                                                        <?php $__currentLoopData = unserialize($comment->upphoto); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upphoto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li data-img="<?php echo e(uploadImage($upphoto)); ?>">
                                                                <img src="<?php echo e(uploadImage($upphoto, ['width'=>70,'height'=>70,'type'=>1])); ?>" width="70" height="70" />
                                                            </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="comment-nodata">
                                    <span>暂无评论</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php echo $commentlist->links(); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="weui-tabbar">
            <?php if(auth()->guard()->check()): ?>
            <a href="<?php echo e(route('mobile.brand.shop.comment.create', $shop->id)); ?>" class="weui-tabbar__item tabbar-btn">
                <span>发表评论</span>
            </a>
            <?php else: ?>
                <a href="<?php echo e(route('mobile.login')); ?>" class="weui-tabbar__item tabbar-btn">
                    <span>登录后再评论</span>
                </a>
                <?php endif; ?>
        </div>
    </div>
    <!-- Swiper -->
    <div class="swiper-container" id="origin-img">
        <div class="swiper-wrapper"></div>
        <div class="swiper-pagination"></div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript" src="<?php echo e(asset('static/js/swiper.min.js')); ?>"></script>
    <script type="text/javascript">
        var swiperStatus = false;
        var lastTouchEnd = 0;
        var swiper = new Swiper('#origin-img',{
            zoom:true,
            width: window.innerWidth,
            virtual: true,
            spaceBetween:20,
            pagination: {
                el: '.swiper-pagination',
                type: 'fraction'
            },
            on:{
                click: function(){
                    $('#origin-img').fadeOut('fast');
                    this.virtual.slides.length = 0;
                    swiperStatus=false;
                }
            }
        });
        $(document).on("click", ".comment-photo li", function(){
            var clickIndex = $(this).index();
            $(this).parent().find("li").each(function(){
                swiper.virtual.appendSlide('<div class="swiper-zoom-container"><img src="'+$(this).data("img")+'" /></div>');
            });
            swiper.slideTo(clickIndex);
            $('#origin-img').fadeIn('fast');
            swiperStatus = true;
        });
        //切换图状态禁止页面缩放
        document.addEventListener('touchstart',function (event) {
            if(event.touches.length>1 && swiperStatus){
                event.preventDefault();
            }
        });
        document.addEventListener('touchend',function (event) {
            var now=(new Date()).getTime();
            if(now-lastTouchEnd<=300){
                event.preventDefault();
            }
            lastTouchEnd = now;
        },false);
        document.addEventListener('touchmove',function(e){
            if(swiperStatus){
                e.preventDefault();
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>