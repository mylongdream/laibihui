<?php $__env->startSection('content'); ?>
    <div class="weui-tab">
        <div class="">
            <div class="wp pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">店铺预约</div>
                </div>
                <form class="ajaxform" name="myform" method="post" action="<?php echo e(route('mobile.brand.shop.appoint', ['id' => $shop->id])); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="weui-cells">
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">顾客姓名</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="realname" placeholder="请输入顾客姓名" type="text">
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">预约人数</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input numeric" name="number" placeholder="请输入预约人数" type="number">
                            </div>
                            <div class="weui-cell__ft">人</div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">手机号码</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="mobile" placeholder="请输入手机号码" type="tel">
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">预约时间</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input timePicker" data-start="<?php echo e(date('Y-m-d', time())); ?>" data-end="<?php echo e(date('Y-m-d', time()+365*24*60*60)); ?>" name="appoint_at" placeholder="请输入预约时间" type="text" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="weui-cells__title">备注要求</div>
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <textarea name="remark" class="weui-textarea" placeholder="其他要求在此输入说明" rows="3"></textarea>
                                <div class="weui-textarea-counter"><span>0</span>/200</div>
                            </div>
                        </div>
                    </div>
                    <div class="weui-btn-area">
                        <button name="applybtn" type="button" class="weui-btn weui-btn_primary ajaxsubmit">立即预约</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>