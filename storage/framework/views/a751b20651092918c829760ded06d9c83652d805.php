<?php $__env->startSection('content'); ?>
    <?php if(!request()->ajax()): ?>
    <div class="crm-main">
        <div class="crm-infobox">
            <div class="hd">
                <h4>新增卡号</h4>
            </div>
            <div class="bd crm-form">
                <form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('crm.shop.addcard', ['id' => $shop->id, 'allotid' => request('allotid')])); ?>">
                    <?php echo csrf_field(); ?>

                    <table>
                        <tr>
                            <td width="150" align="right">商户名称</td>
                            <td><?php echo e($shop->name); ?></td>
                        </tr>
                    <tr>
                        <td align="right">剩余分配</td>
                        <td><span class="cardsurplus"><?php echo e($allot->quantity - $allot->cardlist->count()); ?></span> 张</td>
                    </tr>
                        <tr>
                            <td align="right" valign="top">分配卡号</td>
                            <td>
                        <textarea class="textarea" name="number" cols="60" rows="6" id="cardnumber"></textarea>
						<div class="tdtip mtm">每行一个卡号</div>
						</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><button value="true" name="savesubmit" type="submit" class="button">提 交</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <?php else: ?>
        <div class="crm-form">
            <form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('crm.shop.addcard', ['id' => $shop->id, 'allotid' => request('allotid')])); ?>">
                <?php echo csrf_field(); ?>

                <table>
                    <tr>
                        <td width="150" align="right">商户名称</td>
                        <td width="450"><?php echo e($shop->name); ?></td>
                    </tr>
                    <tr>
                        <td align="right">剩余分配</td>
                        <td><span class="cardsurplus"><?php echo e($allot->quantity - $allot->cardlist->count()); ?></span> 张</td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">分配卡号</td>
                        <td>
                            <textarea class="textarea" name="number" cols="60" rows="6" id="cardnumber"></textarea>
                            <div class="tdtip mtm">每行一个卡号</div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button value="true" name="savesubmit" type="submit" class="button">提 交</button></td>
                    </tr>
                </table>
            </form>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $(function() {
            $("#cardnumber").keydown(function(event) {
                if (event.keyCode == "13") {
                    var text = $(this).val();
                    var arry = text.split("\n");
                    if (arry.length > parseInt($(".cardsurplus").text(), 10)) {
					    alert('超出剩余分配数量');
                    }
                    var number = arry[arry.length-1];
                    $.ajax({
                        type: "GET",
                        url: "<?php echo e(route('crm.shop.checkcard')); ?>",
                        data: {number: number},
                        async:false
                    }).success(function(data) {
                        if(data.status == 0){
                            alert(data.info);
                        }
                    }).error(function(data) {
                        if (!data) {
                            return true;
                        } else {
                            message = $.parseJSON(data.responseText);
                            $.each(message.errors, function (key, value) {
                                alert(value);
                                return false;
                            });
                            return false;
                        }
                    });
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.crm.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>