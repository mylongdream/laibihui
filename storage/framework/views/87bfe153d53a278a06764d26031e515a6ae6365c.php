<?php $__env->startSection('content'); ?>
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">设置</div>
                </div>
                <div class="weui-panel">
                    <div class="weui-panel__bd">
                        <div class="weui-media-box weui-media-box_small-appmsg">
                            <div class="weui-cells">
                                <a class="weui-cell weui-cell_access" href="<?php echo e(route('mobile.user.address.index')); ?>">
                                    <div class="weui-cell__hd">
                                        <img class="user-menu-pic" src="<?php echo e(asset('static/image/mobile/center-icon-dz.png')); ?>" alt="">
                                    </div>
                                    <div class="weui-cell__bd weui-cell_primary">
                                        <p class="user-menu-txt">我的地址</p>
                                    </div>
                                    <span class="weui-cell__ft"></span>
                                </a>
                                <a class="weui-cell weui-cell_access" href="<?php echo e(route('mobile.user.profile.index')); ?>">
                                    <div class="weui-cell__hd">
                                        <img class="user-menu-pic" src="<?php echo e(asset('static/image/mobile/center-icon-geren.png')); ?>" alt="">
                                    </div>
                                    <div class="weui-cell__bd weui-cell_primary">
                                        <p class="user-menu-txt">个人资料</p>
                                    </div>
                                    <span class="weui-cell__ft"></span>
                                </a>
                                <a class="weui-cell weui-cell_access" href="<?php echo e(route('mobile.user.password.index')); ?>">
                                    <div class="weui-cell__hd">
                                        <img class="user-menu-pic" src="<?php echo e(asset('static/image/mobile/center-icon-dlmm.png')); ?>" alt="">
                                    </div>
                                    <div class="weui-cell__bd weui-cell_primary">
                                        <p class="user-menu-txt">密码修改</p>
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
                                <a class="weui-cell weui-cell_access" href="<?php echo e(route('mobile.logout')); ?>">
                                    <div class="weui-cell__hd">
                                        <img class="user-menu-pic" src="<?php echo e(asset('static/image/mobile/center-icon-out.png')); ?>" alt="">
                                    </div>
                                    <div class="weui-cell__bd weui-cell_primary">
                                        <p class="user-menu-txt">退出账号</p>
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