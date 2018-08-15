<?php $__env->startSection('content'); ?>
    <div class="weui-tab">
        <div class="pay-main">
            <div class="main-body">
                <div class="wp">
                    <div class="pay-form">
                        <form class="ajaxform" name="myform" method="post" action="<?php echo e(route('mobile.brand.shop.pay', ['id' => $shop->id])); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="weui-cells">
                                <a href="<?php echo e(route('mobile.brand.shop.show', ['id' => $shop->id])); ?>" class="weui-cell weui-cell_access">
                                    <div class="weui-cell__hd" style="position: relative;margin-right: 10px;">
                                        <img src="<?php echo e(uploadImage($shop->upimage)); ?>" style="width: 50px;height: 50px;display: block">
                                    </div>
                                    <div class="weui-cell__bd">
                                        <p><?php echo e($shop->name); ?></p>
                                        <p style="font-size: 13px;color: #888888;">电话：<?php echo e($shop->phone); ?></p>
                                    </div>
                                    <div class="weui-cell__ft"></div>
                                </a>
                            </div>
                            <div class="weui-cells pay-discount">
                                <div class="weui-cell">
                                    <div class="weui-cell__hd"><label class="weui-label">店铺折扣</label></div>
                                    <div class="weui-cell__bd">
                                        <span id="amount-discount"><?php echo e($shop->discount); ?></span>
                                    </div>
                                    <div class="weui-cell__ft">折</div>
                                </div>
                            </div>
                            <div class="weui-cells pay-money">
                                <div class="weui-cell">
                                    <div class="weui-cell__hd"><label class="weui-label">消费金额</label></div>
                                    <div class="weui-cell__bd">
                                        <input class="weui-input" placeholder="0.00" type="text" name="amount" id="amount-input">
                                    </div>
                                    <div class="weui-cell__ft">元</div>
                                </div>
                            </div>
                            <div class="weui-cells__title">请选择支付方式</div>
                            <div class="weui-cells weui-cells_radio">
                                <label class="weui-cell weui-check__label" for="paytype1">
                                    <div class="weui-cell__bd">
                                        <p>支付宝支付</p>
                                    </div>
                                    <div class="weui-cell__ft">
                                        <input class="weui-check" name="paytype" id="paytype1" type="radio" value="alipay" checked="checked">
                                        <span class="weui-icon-checked"></span>
                                    </div>
                                </label>
                                <label class="weui-cell weui-check__label" for="paytype2">
                                    <div class="weui-cell__bd">
                                        <p>微信支付</p>
                                    </div>
                                    <div class="weui-cell__ft">
                                        <input class="weui-check" name="paytype" id="paytype2" type="radio" value="wechat">
                                        <span class="weui-icon-checked"></span>
                                    </div>
                                </label>
                                <?php if($shop->offline): ?>
                                <label class="weui-cell weui-check__label" for="paytype3">
                                    <div class="weui-cell__bd">
                                        <p>线下付款</p>
                                    </div>
                                    <div class="weui-cell__ft">
                                        <input class="weui-check" name="paytype" id="paytype3" type="radio" value="offline">
                                        <span class="weui-icon-checked"></span>
                                    </div>
                                </label>
                                <?php endif; ?>
                            </div>
                            <div class="pay-amount">
                                ￥<span id="amount-show">0.00</span>
                            </div>
                            <div class="pay-btn">
                                <button name="applybtn" type="submit" class="weui-btn weui-btn_primary">立即支付</button>
                            </div>
                            <div class="pay-tip">
                                本次消费可额外获得<span id="score-show">0</span>个积分
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="pay-number">
            <div class="weui-flex">
                <div class="weui-flex__item">
                    <div class="title">1</div>
                </div>
                <div class="weui-flex__item">
                    <div class="title">2</div>
                </div>
                <div class="weui-flex__item">
                    <div class="title">3</div>
                </div>
            </div>
            <div class="weui-flex">
                <div class="weui-flex__item">
                    <div class="title">4</div>
                </div>
                <div class="weui-flex__item">
                    <div class="title">5</div>
                </div>
                <div class="weui-flex__item">
                    <div class="title">6</div>
                </div>
            </div>
            <div class="weui-flex">
                <div class="weui-flex__item">
                    <div class="title">7</div>
                </div>
                <div class="weui-flex__item">
                    <div class="title">8</div>
                </div>
                <div class="weui-flex__item">
                    <div class="title">9</div>
                </div>
            </div>
            <div class="weui-flex">
                <div class="weui-flex__item">
                    <div class="title">·</div>
                </div>
                <div class="weui-flex__item">
                    <div class="title">0</div>
                </div>
                <div class="weui-flex__item">
                    <div class="title">X</div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        <?php if(count($errors) > 0): ?>
                            weui.alert("<?php echo e($errors->first()); ?>", {
            isAndroid: false
        });
            <?php endif; ?>
    <?php if(auth()->guard()->check()): ?>
    <?php if(!auth()->user()->card): ?>
weui.alert('你尚未绑定联名卡', {
            buttons: [{
                label: '前去绑定',
                onClick: function(){
                    window.location.href="<?php echo e(route('mobile.user.bindcard.index')); ?>";
                }
            }],
            isAndroid: false
        });
        <?php endif; ?>
    <?php else: ?>
weui.alert('你尚未登录', {
            buttons: [{
                label: '前去登录',
                onClick: function(){
                    window.location.href="<?php echo e(route('mobile.login', ['ReturnUrl'=> request()->getUri()])); ?>";
                }
            }],
            isAndroid: false
        });
        <?php endif; ?>
$(document).on("keyup cut paste", "#amount-input", function(){
            var self = $(this);
            var total = parseInt(self.attr("data-max"), 10) || 100;
            setTimeout(function() {
                var discount = parseFloat($("#amount-discount").text()) || 0;
                var value = self.val().replace(/[^\d.]/g,'');
                value = value.replace(/^\./g,'').replace(/\.{2,}/g,'.');
                value = value.replace('.','$#$').replace(/\./g,'').replace('$#$','.').replace(/^(\-)*(\d+)\.(\d\d).*$/, '$1$2.$3');
                self.val(value);
                value = value ? value : 0;
                value = parseFloat(value) * discount / 10;
                value = value.toFixed(2);
                $("#amount-show").text(value);
                $("#score-show").text(parseInt(value, 10));
            }, 100);
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>