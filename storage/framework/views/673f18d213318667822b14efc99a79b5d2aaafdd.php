<?php $__env->startSection('content'); ?>
    <div class="content-body">
        <div class="wp">
            <div class="order-body">
                <div class="order-tip">
                    上门办卡仅限杭州地区用户受理，订单一旦发货后，概不能退款
                </div>
                <form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('brand.card.order')); ?>">
                    <?php echo csrf_field(); ?>

                    <input type="hidden" name="addressid" value="0" id="addressid">
                    <input type="hidden" name="ordertype" value="0" id="ordertype">
                    <input type="hidden" name="paytype" value="1" id="paytype">
                    <div class="order-address cl">
                        <div class="hd cl">
                            <h3>收货地址</h3>
                        </div>
                        <div class="bd cl">
                            <div class="address-list">
                            </div>
                            <div class="address-add">
                                <a href="<?php echo e(route('user.address.create')); ?>" class="openwindow" title="添加新地址"><span>添加新地址</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="order-options cl">
                        <div class="hd">
                            <h3>支付方式</h3>
                        </div>
                        <div class="bd">
                            <ul>
                                <li class="on">
                                    <span>在线支付 （支持微信支付、支付宝、银联在线支付等）</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="order-options order-shipment cl">
                        <div class="hd">
                            <h3>办卡方式</h3>
                        </div>
                        <div class="bd">
                            <ul>
                                <li id="ship-visit" class="on" data-id="0" data-freight="0">
                                    <span>上门办卡（免运费）</span>
                                </li>
                                <li id="ship-post" data-id="1" data-freight="10">
                                    <span>邮寄办卡（运费10元）</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="order-options order-reward cl">
                        <div class="hd">
                            <h3>绑卡获得</h3>
                        </div>
                        <div class="bd">
                            <ul>
                                <li class="on">
                                    <span>到店体验金10元 + 冻结余额90元</span>
                                </li>
                                <li>
                                    <span>到店体验金20元 + 冻结余额180元</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="order-options order-remark cl">
                        <div class="hd">
                            <h3>留言备注</h3>
                        </div>
                        <div class="bd">
                            <input style="width: 500px" class="input" type="text" size="50" value="" name="remark" placeholder="选填：填写您需要的留言备注信息">
                        </div>
                    </div>
                    <div class="order-options order-goods">
                        <table width="100%" class="cl">
                            <tr>
                                <td width="150">
                                    <a href="<?php echo e(route('brand.card.index')); ?>" title="我要办卡"><img height="60" src="<?php echo e(asset('static/image/common/card.jpg')); ?>"></a>
                                </td>
                                <td>
                                    <p><a href="<?php echo e(route('brand.card.index')); ?>" title="我要办卡"><span style="font-size: 14px;color: #333;">知惠网联名卡（一张能在几百家店打折的卡）</span></a></p>
                                </td>
                                <td width="100">
                                    <span style="font-size: 18px;color: #ac2600;">10.00 元</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="order-btn">
                        <span class="order-count">应付总额： <em>10.00</em> 元</span>
                        <button value="true" name="savesubmit" type="submit" class="button">提交订单</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $(function() {
            $(document).on("click", ".order-payment li", function(){
                var self = $(this);
                if(!self.hasClass("disabled")){
                    self.addClass("on").siblings().removeClass("on");
                    $("#paytype").val(self.attr('data-id'));
                }
            });
            $(document).on("click", ".order-shipment li", function(){
                var self = $(this);
                if(!self.hasClass("disabled")){
                    var account = 10;
                    self.addClass("on").siblings().removeClass("on");
                    $(".order-reward li").eq(self.index()).addClass("on").siblings().removeClass("on");
                    account += parseInt(self.attr("data-freight"));
                    $(".order-count em").html(account.toFixed(2));
                    $("#ordertype").val(self.attr('data-id'));
                }
            });
            $(document).on("click", ".address-item", function(){
                var self = $(this);
                $.ajax({
                    type: "GET",
                    url: "<?php echo e(route('brand.card.addressinfo')); ?>",
                    data: {id: self.attr('data-id')},
                    async:false
                }).success(function(data) {
                    if(data.status == 0){
                        $.jBox.error(data.info, '提示');
                    }else{
                        $("#addressid").val(self.attr('data-id'));
                        self.addClass("on").siblings().removeClass("on");
                        if(data.forbid == 1){
                            if($("#ship-visit").hasClass("on")){
                                $("#ship-visit").removeClass("on").addClass("disabled");
                                $("#ship-post").trigger("click");
                            }else{
                                $("#ship-visit").addClass("disabled");
                            }
                        }else{
                            $("#ship-visit").removeClass("disabled");
                        }
                    }
                }).error(function(data) {
                    if (!data) {
                        return true;
                    } else {
                        message = $.parseJSON(data.responseText);
                        $.each(message.errors, function (key, value) {
                            $.jBox.tip(value, 'error');
                            return false;
                        });
                        return false;
                    }
                });
            });
            $(document).on("submit", ".addressform", function(){
                var self = $(this);
                $.ajax({
                    type: self.attr("method"),
                    url: self.attr("action"),
                    data: self.serialize(),
                    async:false
                }).success(function(data) {
                    if(data.status == 0){
                        $.jBox.error(data.info, '提示');
                    }else{
                        if (data.info) {
                            $.jBox.tip(data.info, 'success', {
                                closed: function () {
                                    $.jBox.close();
                                    $(".address-list").load("<?php echo e(route('brand.card.addresslist')); ?>", function(){
                                            $(".address-item").each(function(){
                                                var self = $(this);
                                                if(self.hasClass("on")){
                                                    self.trigger("click");
                                                }
                                            });
                                        }
                                    );
                                }
                            });
                        } else {
                            $.jBox.close();
                            $(".address-list").load("<?php echo e(route('brand.card.addresslist')); ?>", function(){
                                    $(".address-item").each(function(){
                                        var self = $(this);
                                        if(self.hasClass("on")){
                                            self.trigger("click");
                                        }
                                    });
                                }
                            );
                        }
                    }
                }).error(function(data) {
                    if (!data) {
                        return true;
                    } else {
                        message = $.parseJSON(data.responseText);
                        $.each(message.errors, function (key, value) {
                            $.jBox.tip(value, 'error');
                            return false;
                        });
                        return false;
                    }
                });
                return false;
            });
            $(".address-list").load("<?php echo e(route('brand.card.addresslist')); ?>", function(){
                    $(".address-item").each(function(){
                        var self = $(this);
                        if(self.hasClass("on")){
                            self.trigger("click");
                        }
                    });
                }
            );
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.common.simple', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>