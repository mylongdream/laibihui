<?php $__env->startSection('content'); ?>
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav"><?php echo e(trans('user.promotion')); ?></div>
                </div>
                <div class="weui-panel">
                    <div class="weui-panel__bd">
                        <div class="weui-media-box weui-media-box_small-appmsg">
                            <div class="weui-cells">
                                <a class="weui-cell weui-cell_access" href="<?php echo e(route('mobile.user.promotion.qrcode')); ?>">
                                    <div class="weui-cell__hd">
                                        <img class="user-menu-pic" src="<?php echo e(asset('static/image/mobile/center-icon-geren.png')); ?>" alt="">
                                    </div>
                                    <div class="weui-cell__bd weui-cell_primary">
                                        <p class="user-menu-txt">我的推广码</p>
                                    </div>
                                    <span class="weui-cell__ft"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="weui-panel">
                    <div class="weui-panel__bd">
                        <div class="weui-media-box weui-media-box_small-appmsg">
                            <div class="weui-cells">
                                <a class="weui-cell weui-cell_access" href="<?php echo e(route('mobile.user.promotion.first')); ?>">
                                    <div class="weui-cell__hd">
                                        <img class="user-menu-pic" src="<?php echo e(asset('static/image/mobile/center-icon-geren.png')); ?>" alt="">
                                    </div>
                                    <div class="weui-cell__bd weui-cell_primary">
                                        <span class="user-menu-txt">一级下线</span>
                                        <span class="weui-badge" style="margin-left: 5px;">0</span>
                                    </div>
                                    <span class="weui-cell__ft"></span>
                                </a>
                                <a class="weui-cell weui-cell_access" href="<?php echo e(route('mobile.user.promotion.second')); ?>">
                                    <div class="weui-cell__hd">
                                        <img class="user-menu-pic" src="<?php echo e(asset('static/image/mobile/center-icon-geren.png')); ?>" alt="">
                                    </div>
                                    <div class="weui-cell__bd weui-cell_primary">
                                        <span class="user-menu-txt">二级下线</span>
                                        <span class="weui-badge" style="margin-left: 5px;">0</span>
                                    </div>
                                    <span class="weui-cell__ft"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="weui-panel">
                    <div class="weui-panel__bd">
                        <div class="weui-media-box weui-media-box_small-appmsg">
                            <div class="weui-cells">
                                <a class="weui-cell weui-cell_access" href="<?php echo e(route('mobile.user.promotion.rule')); ?>">
                                    <div class="weui-cell__hd">
                                        <img class="user-menu-pic" src="<?php echo e(asset('static/image/mobile/center-icon-geren.png')); ?>" alt="">
                                    </div>
                                    <div class="weui-cell__bd weui-cell_primary">
                                        <p class="user-menu-txt">奖励机制</p>
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