<?php $__env->startSection('content'); ?>
    <div class="weui-tab">
        <div class="wp">
            <div class="roulette-container">
                <div class="roulette-top">
                    <img width="100%" src="<?php echo e(asset('static/image/mobile/sign-top.png')); ?>" alt="">
                </div>
                <div class="roulette-box">
                    <div class="pan-back">
                        <div class="pan-area">
                            <ul class="item-wrap item-wrap<?php echo e(count($prize)); ?>">
                                <?php $__currentLoopData = $prize; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li style="transform: rotate(<?php echo e((2*$loop->iteration-3)*180/$loop->count - 270); ?>deg) skew(<?php echo e(90-360/$loop->count); ?>deg);-webkit-transform: rotate(<?php echo e((2*$loop->iteration-3)*180/$loop->count - 270); ?>deg) skew(<?php echo e(90-360/$loop->count); ?>deg);-ms-transform: rotate(<?php echo e((2*$loop->iteration-3)*180/$loop->count - 270); ?>deg) skew(<?php echo e(90-360/$loop->count); ?>deg);-o-transform: rotate(<?php echo e((2*$loop->iteration-3)*180/$loop->count - 270); ?>deg) skew(<?php echo e(90-360/$loop->count); ?>deg);">
                                        <div style="transform: skew(-<?php echo e(90-360/$loop->count); ?>deg) rotate(-<?php echo e(90-180/$loop->count); ?>deg);-webkit-transform: skew(-<?php echo e(90-360/$loop->count); ?>deg) rotate(-<?php echo e(90-180/$loop->count); ?>deg);-ms-transform: skew(-<?php echo e(90-360/$loop->count); ?>deg) rotate(-<?php echo e(90-180/$loop->count); ?>deg);-o-transform: skew(-<?php echo e(90-360/$loop->count); ?>deg) rotate(-<?php echo e(90-180/$loop->count); ?>deg);">
                                            <span><?php echo e($value['title']); ?></span>
                                            <img src="<?php echo e($value['img']); ?>">
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <div class="pan-mask"></div>
                        </div>
                        <div class="btn-area btn-start">
                            <div class="go-arrow"><span></span></div>
                            <div class="go-back">
                                <span>开始</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="weui-btn-area">
                    <?php if($todaysign): ?>
                        <button name="applybtn" type="button" class="weui-btn weui-btn_primary bg-gray">今日已签到</button>
                    <?php else: ?>
                        <button name="applybtn" type="button" class="weui-btn weui-btn_primary btn-start">点击签到</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript" src="<?php echo e(asset('static/js/jquery.rotate.js')); ?>"></script>
    <script type="text/javascript">
        $(function() {
            $(document).on('click', '.btn-start', function() {
                $.ajax({
                    type:"POST",
                    url:"<?php echo e(route('mobile.user.sign.store')); ?>"
                }).success(function(data) {
                    if(data.status == 1){
                        var angle = 1800 + parseInt(data.angle);
                        $(".go-arrow").rotate({
                            angle:0,
                            animateTo:angle,
                            duration:8000,
                            callback:function (){
                                weui.alert(data.info, function(){
                                    if(data.url){
                                        window.location.href = data.url;
                                    } else {
                                        window.location.reload();
                                    }
                                }, {
                                    title: '签到成功'
                                });
                            }
                        })
                    } else {
                        weui.alert(data.info, { title: '签到失败' });
                    }
                }).error(function(data) {
                    if (!data) {
                        return true;
                    } else {
                        message = $.parseJSON(data.responseText);
                        $.each(message.errors, function (key, value) {
                            weui.alert(value, { title: '签到失败' });
                            return false;
                        });
                        return false;
                    }
                });
                return false;
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>