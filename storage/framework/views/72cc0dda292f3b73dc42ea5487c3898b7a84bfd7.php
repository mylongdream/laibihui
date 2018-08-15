<?php $__env->startSection('content'); ?>
    <div class="weui-tab">
        <div class="weui-tab__panel">
            <div class="main-body">
                <div class="wp">
                    <div class="" style="overflow: hidden">
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
                        <?php if($meallist->count()): ?>
                            <div class="meal-select">
                                <div class="meal-sidebar">
                                    <ul>
                                        <?php if($meallist->where('catid', 0)->count()): ?>
                                            <li class="on">默认分类</li>
                                        <?php endif; ?>
                                        <?php $__currentLoopData = $shop->mealcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($meallist->where('catid', $value->id)->count()): ?>
                                                <li><?php echo e($value->name); ?></li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                <div class="meal-mainbar">
                                    <?php if($meallist->where('catid', 0)->count()): ?>
                                        <div class="weui-cells__title">默认分类</div>
                                        <div class="weui-cells weui-cells_checkbox">
                                            <?php $__currentLoopData = $meallist->where('catid', 0); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="weui-cell meal-item">
                                                    <div class="weui-cell__hd">
                                                        <label class="weui-check__label" for="meal<?php echo e($value->id); ?>" data-id="<?php echo e($value->id); ?>">
                                                            <input class="weui-check" name="meal[]" id="meal<?php echo e($value->id); ?>" type="checkbox" value="<?php echo e($value->id); ?>" <?php echo $value->cart ? 'checked="checked"' : ''; ?>>
                                                            <i class="weui-icon-checked"></i>
                                                        </label>
                                                    </div>
                                                    <div class="weui-cell__bd" data-id="<?php echo e($value->id); ?>">
                                                        <div class="m-pic">
                                                            <img src="<?php echo e(uploadImage($value->upimage)); ?>" alt="">
                                                        </div>
                                                        <div class="m-info">
                                                            <div class="m-name"><?php echo e($value->name); ?></div>
                                                            <div class="m-price">￥ <em><?php echo e($value->price); ?></em></div>
                                                        </div>
                                                    </div>
                                                    <div class="m-amount">
                                                        <div class="choose-amount">
                                                            <span class="cut_num"></span>
                                                            <input class="key_num" type="number" value="<?php echo e($value->cart ? $value->cart->number : '1'); ?>" name="number" size="3" maxlength="3" data-max="100" readonly>
                                                            <span class="add_num"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php $__currentLoopData = $shop->mealcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mealcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($meallist->where('catid', $mealcategory->id)->count()): ?>
                                            <div class="weui-cells__title"><?php echo e($mealcategory->name); ?></div>
                                            <div class="weui-cells weui-cells_checkbox">
                                                <?php $__currentLoopData = $meallist->where('catid', $mealcategory->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="weui-cell meal-item">
                                                        <div class="weui-cell__hd">
                                                            <label class="weui-check__label" for="meal<?php echo e($value->id); ?>" data-id="<?php echo e($value->id); ?>">
                                                                <input class="weui-check" name="meal[]" id="meal<?php echo e($value->id); ?>" type="checkbox" value="<?php echo e($value->id); ?>" <?php echo $value->cart ? 'checked="checked"' : ''; ?>>
                                                                <i class="weui-icon-checked"></i>
                                                            </label>
                                                        </div>
                                                        <div class="weui-cell__bd" data-id="<?php echo e($value->id); ?>">
                                                            <div class="m-pic">
                                                                <img src="<?php echo e(uploadImage($value->upimage)); ?>" alt="">
                                                            </div>
                                                            <div class="m-info">
                                                                <div class="m-name"><?php echo e($value->name); ?></div>
                                                                <div class="m-price">￥ <em><?php echo e($value->price); ?></em></div>
                                                            </div>
                                                        </div>
                                                        <div class="m-amount">
                                                            <div class="choose-amount">
                                                                <span class="cut_num"></span>
                                                                <input class="key_num" type="number" value="<?php echo e($value->cart ? $value->cart->number : '1'); ?>" name="number" size="3" maxlength="3" data-max="100" readonly>
                                                                <span class="add_num"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="weui-cells">
                                <div class="no-data">
                                    <span>暂无上架菜品</span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="weui-tabbar">
            <?php if(1): ?>
                <div class="order-totalprice">
                        总额：￥<span id="totalPrice"><?php echo e($total['price']); ?></span>
                </div>
            <?php else: ?>
            <dl class="order-amount">
                <dt>需付：￥<span id="totalMoney"><?php echo e($total['money']); ?></span></dt>
                <dd>
                    总额：￥<span id="totalPrice"><?php echo e($total['price']); ?></span>
                    <?php if(auth()->user()->card): ?>
                    <span class="mlm">折扣：<span id="amount-discount"><?php echo e($shop->discount); ?></span> 折</span>
                    <?php endif; ?>
                </dd>
            </dl>
            <?php endif; ?>
            <?php if($total['price'] > 0): ?>
                <a href="<?php echo e(route('mobile.brand.shop.meal.order', ['id' => $shop->id])); ?>" class="weui-tabbar__item tabbar-btn">
                    <span>立即点餐</span>
                </a>
            <?php else: ?>
                <a href="javascript:;" class="weui-tabbar__item tabbar-btn tabbar-btn_disabled">
                    <span>立即点餐</span>
                </a>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $(function(){
            <?php if($meallist->count()): ?>
            var offon = true;
            var sidebar = $(".meal-sidebar");
            var mealTop = $(".meal-select").offset().top;
            $(".main-body").scroll(function(){
                var _top = $(this).scrollTop();
                if(_top >= mealTop){
                    sidebar.css("position", "fixed");
                    if(offon){
                        $('.meal-mainbar .weui-cells__title').each(function(index){
                            if($(this).offset().top  <= 0){
                                $('.meal-sidebar li').eq(index).addClass('on').siblings().removeClass('on');
                                //return false;
                            }
                        });
                    }
                    sidebar.height($(".main-body").height());
                }else{
                    sidebar.css("position", "absolute");
                    sidebar.css('height', 'auto');
                }
            });
            <?php endif; ?>

            $(document).on("click", ".meal-sidebar li", function(){
                offon = false;
                var mainbody = $(".main-body");
                var _index = $(this).index();
                $(this).addClass("on").siblings().removeClass("on");
                var _top = $('.meal-mainbar .weui-cells__title').eq(_index).offset().top + mainbody.scrollTop();//获取上偏移值
                mainbody.animate({scrollTop:_top},1000,function(){
                    offon = true;
                });
            });
            $(document).on("change", ".weui-check", function(){
                var self = $(this);
                var loading = weui.loading('正在加载中', {
                    className: 'toast-loading'
                });
                if (self.is(':checked')) {
                    var num = self.parents('.meal-item').find("input[name=number]").val();
                    $.get("<?php echo e(route('mobile.brand.shop.meal.addcart', ['id' => $shop->id])); ?>", {meal_id: self.val(), num: num}, function(data){
                        loading.hide(function() {
                            updatecart(data.total);
                        });
                    });
                } else {
                    $.get("<?php echo e(route('mobile.brand.shop.meal.delcart', ['id' => $shop->id])); ?>", {meal_id: self.val()}, function(data){
                        loading.hide(function() {
                            updatecart(data.total);
                        });
                    });
                }
            });
            $(document).on("click", ".meal-item .weui-cell__bd", function(){
                var self = $(this);
                var loading = weui.loading('正在加载中', {
                    className: 'toast-loading'
                });
                $.ajax({
                    type:'GET',
                    url:"<?php echo e(route('mobile.brand.shop.meal.show', ['id' => $shop->id])); ?>",
                    data: {meal_id: self.data('id')},
                    async:false
                }).success(function(data) {
                    if(data.status == 0){
                        weui.alert(data.info, function(){
                            window.location.reload();
                        });
                    }else{
                        loading.hide(function() {
                            var alert = weui.alert(data, {
                                className: 'pop-window',
                                isAndroid: false
                            });
                            $(".pop-window .weui-mask").click(function(){
                                alert.hide();
                            });
                            $(".pop-window .meal-order-btn").click(function(){
                                alert.hide(function(){
                                    $("#meal"+self.data('id')).parent().trigger("click");
                                });
                            });
                        });
                    }
                }).error(function() {
                    if (!data) {
                        return true;
                    } else {
                        message = $.parseJSON(data.responseText);
                        $.each(message.errors, function (key, value) {
                            weui.alert(value);
                            return false;
                        });
                        return false;
                    }
                });
            });
            $(document).on("change", ".choose-amount .key_num", function(){
                if ($(this).parents('.meal-item').find(".weui-check").prop("checked")) {
                    var num = $(this).val();
                    if(num > 0) {
                        var loading = weui.loading('正在加载中', {
                            className: 'toast-loading'
                        });
                        var meal_id = $(this).parents('.meal-item').find(".weui-check__label").data('id');
                        $.ajax({
                            type:'GET',
                            url:"<?php echo e(route('mobile.brand.shop.meal.updatecart', ['id' => $shop->id])); ?>",
                            data: {meal_id: meal_id, num: num},
                            async:false
                        }).success(function(data) {
                            if(data.status == 0){
                                weui.alert(data.info, function(){
                                    window.location.reload();
                                });
                            }else{
                                loading.hide(function() {
                                    updatecart(data.total);
                                });
                            }
                        }).error(function() {
                            if (!data) {
                                return true;
                            } else {
                                message = $.parseJSON(data.responseText);
                                $.each(message.errors, function (key, value) {
                                    weui.alert(value);
                                    return false;
                                });
                                return false;
                            }
                        });
                    }else{
                        weui.alert('数量不正确！');
                    }
                }
            });
            function updatecart(data){
                $("#totalPrice").text(parseFloat(data.price).toFixed(2));
                $("#totalMoney").text(parseFloat(data.money).toFixed(2));
                if(parseFloat(data.price) > 0){
                    $(".weui-tabbar .tabbar-btn").removeClass("tabbar-btn_disabled").attr("href", "<?php echo e(route('mobile.brand.shop.meal.order', ['id' => $shop->id])); ?>");
                }else{
                    $(".weui-tabbar .tabbar-btn").addClass("tabbar-btn_disabled").attr("href", "javascript:;");
                }
            }

        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>