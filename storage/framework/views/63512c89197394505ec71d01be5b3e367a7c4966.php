<?php $__env->startSection('content'); ?>
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">进度查询</div>
                </div>
                <div class="weui-panel">
                    <div class="weui-panel__bd">
                        <div class="weui-media-box weui-media-box_small-appmsg">
                            <div class="weui-cells">
                                <a class="weui-cell weui-cell_access" href="<?php echo e(route('mobile.user.promotion.card')); ?>">
                                    <div class="weui-cell__hd">
                                        <img class="user-menu-pic" src="<?php echo e(asset('static/image/mobile/center-icon-jyjl.png')); ?>" alt="">
                                    </div>
                                    <div class="weui-cell__bd weui-cell_primary">
                                        <p class="user-menu-txt">推荐办卡奖励查询</p>
                                    </div>
                                    <span class="weui-cell__ft"></span>
                                </a>
                                <a class="weui-cell weui-cell_access" href="<?php echo e(route('mobile.user.present.index')); ?>">
                                    <div class="weui-cell__hd">
                                        <img class="user-menu-pic" src="<?php echo e(asset('static/image/mobile/center-icon-ll.png')); ?>" alt="">
                                    </div>
                                    <div class="weui-cell__bd weui-cell_primary">
                                        <p class="user-menu-txt">礼品寄送进度查询</p>
                                    </div>
                                    <span class="weui-cell__ft"></span>
                                </a>
                                <a class="weui-cell weui-cell_access" href="<?php echo e(route('mobile.user.ordercard.index')); ?>">
                                    <div class="weui-cell__hd">
                                        <img class="user-menu-pic" src="<?php echo e(asset('static/image/mobile/center-icon-banka.png')); ?>" alt="">
                                    </div>
                                    <div class="weui-cell__bd weui-cell_primary">
                                        <p class="user-menu-txt">我的办卡进度查询</p>
                                    </div>
                                    <span class="weui-cell__ft"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>