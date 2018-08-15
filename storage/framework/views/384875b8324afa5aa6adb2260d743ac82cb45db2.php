<?php $__env->startSection('content'); ?>
    <div class="weui-tab">
        <div class="weui-tab__panel">
            <div class="main-body">
                <div class="wp">
                    <div class="pbw">
                        <div class="topheader">
                            <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                            <div class="nav"><?php echo e(trans('user.promotion')); ?></div>
                        </div>
                        <div class="weui-panel">
                            <div class="weui-panel__bd">
                                <div class="weui-article">
                                    <h1>推广链接</h1>
                                    <p>复制推荐链接后分享给好友</p>
                                    <p><?php echo e($promotion); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="weui-panel">
                            <div class="weui-panel__bd">
                                <div class="weui-article">
                                    <h1>奖励机制</h1>
                                    <p>1、当用户通过你所发的推广链接访问本站并成功注册为本站会员奖励积分<?php echo e($setting['promotion_register']); ?>分</p>
                                    <p>2、当用户通过你所发的推广链接成功注册成为本站会员并成功办卡消费奖励推荐办卡费5元和额外奖励积分<?php echo e($setting['promotion_register']); ?>分</p>
                                    <p>假设：A用户推荐一个B用户，然后 B用户推荐一个C用户，然后C用户推荐同一个D用户，奖励公式为：B用户成功推荐一个C用户等C用户成功持卡消费， 那A用户就额外提成0.5元，B用户就提成5元推荐办卡费。若B用户想得到0.5元提成，必须等到C用户推荐的D用户成功持卡消费</p>
                                    <p>您所获得的收益：一个A用户成功推荐十个B用户办卡并绑卡那A用户就获得了50元办卡推荐费（每个办卡用户提成5元乘以10个用户等于您如果发推荐了10个用户可以提成50元奖励金）
                                        若A发展的办卡用户B成功推荐了10个C用户并绑卡消费，那A就可以额外获得0.5元每推荐一个C用户（每个办卡用户提成0.5元乘以10个用户等于您额外可以获得5元奖励金）
                                        注:本推荐的奖励金可以消费也可以提现到银行卡。
                                    </p>
                                    <p>如果您对本规则还有不清楚的请致电：<?php echo e($setting['site_tel']); ?> 或联系在线QQ客服 <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo e($setting['site_qq']); ?>&site=qq&menu=yes" target="_blank"><img border="0" src="http://wpa.qq.com/pa?p=1:<?php echo e($setting['site_qq']); ?>:1"></a> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="weui-tabbar">
            <a href="<?php echo e(route('mobile.user.promotion.card')); ?>" class="weui-tabbar__item tabbar-btn">
                <span>我的推荐</span>
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>