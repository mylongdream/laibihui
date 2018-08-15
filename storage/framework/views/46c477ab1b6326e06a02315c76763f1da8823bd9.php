<?php $__env->startSection('style'); ?>
    <link href="<?php echo e(asset('static/css/swiper.min.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="weui-tab">
        <div class="">
            <div class="wp pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">店铺详情</div>
                    <div class="home"><a href="<?php echo e(route('mobile.index')); ?>"><span></span></a></div>
                </div>
                <?php if($farm->banner): ?>
                    <div class="shop-banner cl">
                        <img width="100%" height="150" border="0" src="<?php echo e(uploadImage($farm->banner)); ?>">
                    </div>
                <?php else: ?>
                    <div class="shop-top cl">
                        <div class="weui-media-box weui-media-box_appmsg">
                            <div class="weui-media-box__hd"><img class="weui-media-box__thumb radius" src="<?php echo e(uploadImage($farm->upimage)); ?>" alt=""></div>
                            <div class="weui-media-box__bd">
                                <div class="name"><?php echo e($farm->name); ?></div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="shop-slide mtm">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php if($farm->upphoto): ?>
                                <?php $__currentLoopData = unserialize($farm->upphoto); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upphoto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="swiper-slide">
                                        <a href="javascript:;"><img src="<?php echo e(uploadImage($upphoto)); ?>"></a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="swiper-slide">
                                    <a href="javascript:;"><img src="<?php echo e(uploadImage($farm->upimage)); ?>"></a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="weui-cells mtm">
                    <div class="weui-cell shop-discount">
                        <div class="weui-cell__bd">
                            <p>尊享标牌价：<span><strong><?php echo e($farm->price); ?></strong>元</span></p>
                        </div>
                        <div class="weui-cell__ft">
                            <a class="weui-btn weui-btn_primary" href="<?php echo e(route('mobile.brand.farm.order', ['id' => $farm->id])); ?>">立即预约</a>
                        </div>
                    </div>
                </div>
                <div class="weui-cells mtm">
                    <a class="weui-cell weui-cell_access" href="<?php echo e(route('mobile.brand.farm.map', ['id' => $farm->id])); ?>">
                        <div class="weui-cell__hd">
                            <img src="<?php echo e(asset('static/image/mobile/shop-address.png')); ?>" alt="" style="width:20px;margin-right:5px;display:block">
                        </div>
                        <div class="weui-cell__bd">
                            <p style="font-size: 14px"><?php echo e($farm->address); ?></p>
                        </div>
                        <span class="weui-cell__ft"></span>
                    </a>
                    <?php if($farm->phone): ?>
                        <a class="weui-cell weui-cell_access" href="tel:<?php echo e($farm->phone); ?>">
                            <div class="weui-cell__hd">
                                <img src="<?php echo e(asset('static/image/mobile/shop-phone.png')); ?>" alt="" style="width:20px;margin-right:5px;display:block">
                            </div>
                            <div class="weui-cell__bd">
                                <p style="font-size: 14px"><?php echo e($farm->phone); ?></p>
                            </div>
                            <span class="weui-cell__ft"></span>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="shop-intro mtm">
                    <div class="hd">
                        <h3>商家详情</h3>
                    </div>
                    <div class="bd">
                        <div class=""><?php echo $farm->message; ?></div>
                    </div>
                </div>
                <div class="weui-cells shop-comment mtm">
                    <a class="weui-cell weui-cell_access" href="<?php echo e(route('mobile.brand.farm.comment', ['id' => $farm->id])); ?>">
                        <div class="weui-cell__bd">
                            <p style="font-size: 14px">顾客点评</p>
                        </div>
                        <span class="weui-cell__ft"></span>
                    </a>
                    <?php if(count($commentlist)): ?>
                        <?php $__currentLoopData = $commentlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a class="weui-cell weui-cell_access" style="align-items:initial;" href="<?php echo e(route('mobile.brand.farm.comment', ['id' => $farm->id])); ?>">
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
                                    <p style="word-wrap:break-word;word-break:break-all; font-size: 14px;margin-top: 5px"><?php echo e($comment->message); ?></p>
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
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <div class="comment-nodata">
                            <span>暂无评论</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript" src="<?php echo e(asset('static/js/swiper.min.js')); ?>"></script>
    <script type="text/javascript">
        var slide = new Swiper ('.shop-slide .swiper-container', {
            autoplay: 4000,
            loop:true,
            pagination: {
                el: '.swiper-pagination'
            }
        });
        $(document).on("click", ".gologin", function(){
            weui.alert('你尚未登录，无法收藏', {
                buttons: [{
                    label: '前去登录',
                    onClick: function(){
                        window.location.href="<?php echo e(route('mobile.login')); ?>";
                    }
                }],
                isAndroid: false
            });
            return false;
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>