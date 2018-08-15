<?php $__env->startSection('content'); ?>
    <div class="wp pbw ptm">
        <!--简介-->
        <div class="farm-show-inner">
            <div class="farm-show-top">
                <div class="title">
                    <h1><?php echo e($farm->name); ?></h1>
                </div>
                <div class="share">
                    <ul>
                        <li class="list">
                            <a href="javascript:void(0);"><em class="ico ico_2"></em>收藏TA</a>
                        </li>
                        <li class="list">
                            <a href="javascript:void(0);"><em class="ico ico_3"></em>分享</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="farm-show-infor">
                <div class="farm-show-picview">
                    <div id="preview" class="spec-preview cl">
                        <ul>
                            <?php if($farm->upphoto): ?>
                                <?php $__currentLoopData = unserialize($farm->upphoto); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upphoto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a hidefocus="true" href="javascript:;"><img src="<?php echo e(uploadImage($upphoto)); ?>" /></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <li><a hidefocus="true" href="javascript:;"><img src="<?php echo e(uploadImage($farm->upimage)); ?>" /></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="spec-scroll cl">
                        <a class="prev" hidefocus="true" href="javascript:;">&lt;</a>
                        <div class="items cl">
                            <ul>
                                <?php if($farm->upphoto): ?>
                                    <?php $__currentLoopData = unserialize($farm->upphoto); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upphoto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a hidefocus="true" href="javascript:;"><img src="<?php echo e(uploadImage($upphoto)); ?>" /></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <li><a hidefocus="true" href="javascript:;"><img src="<?php echo e(uploadImage($farm->upimage)); ?>" /></a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <a class="next" hidefocus="true" href="javascript:;">&gt;</a>
                    </div>
                </div>
                <div class="farm-show-detail">
                    <div class="addr">
                        <span class="text-gray">地址：</span><?php echo e($farm->address); ?>

                        <a href="javascript:void(0);" class="seemap" onclick="$('html,body').animate({scrollTop: $('#farmmap').offset().top}, 1000);">查看地图</a>
                    </div>
                    <div class="state"><span class="text-gray">人均消费：</span><b class="text-red" style="font-size: 24px"><?php echo e($farm->price); ?></b> 元</div>
                    <div class="state"><span class="text-gray">联系电话：</span><?php echo e($farm->phone); ?></div>
                    <div class="mtm">
                        <span class="text-gray">适合人群：</span>
                        <?php $__currentLoopData = $farm->attrs->where('type', 'group'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <em class="bq"><?php echo e(config('farm.group.'.$value['attr_id'])); ?></em>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="mtm">
                        <span class="text-gray">能玩什么：</span>
                        <?php $__currentLoopData = $farm->attrs->where('type', 'play'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <em class="bq"><?php echo e(config('farm.play.'.$value['attr_id'])); ?></em>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="mtm">
                        <span class="text-gray">特色服务：</span>
                        <?php $__currentLoopData = $farm->attrs->where('type', 'service'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <em class="bq2"><?php echo e(config('farm.service.'.$value['attr_id'])); ?></em>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="appoint">
                        <a href="<?php echo e(route('brand.farm.order', $farm->id)); ?>" class="button" title="立即预约">立即预约</a>
                    </div>
                </div>
            </div>
        </div>
        <!--简介结束-->
        <div class="farm-show-box mtw">
            <div class="bd">
                <div style="font-size:16px;color:#f00;">好消息：为让大家玩得开心点，吃的舒心，本网站推出优惠措施如下</div>
                <div style="font-size:14px;margin-top:10px;">1、凡是本网站会员并持有来必惠商家联名卡的用户都可以享受该农家乐特定的折扣价并回赠相应积分到你账户内（实际折扣价以页面显示为准）。</div>
                <div style="font-size:14px;margin-top:10px;">2、如未持有来必惠商家联名卡的用户下单该农家乐亦可享受此优惠，但没有对应积分回赠到你账户，建议立即办理来必惠商家联名卡。</div>
            </div>
        </div>
        <div class="farm-show-box mtw" id="farmmap">
            <div class="hd">商家位置</div>
            <div class="bd">
                <div class="bd-amap"><div id="amapcontainer" style="width:100%;height:350px;"></div></div>
            </div>
        </div>
        <div class="farm-show-box mtw">
            <div class="hd">商家简介</div>
            <div class="bd">
                <div style="font-size:14px;overflow: hidden"><?php echo $farm->message; ?></div>
            </div>
        </div>
        <div class="farm-show-box mtw">
            <div class="hd">店铺环境</div>
            <div class="bd">
                <div style="font-size:14px;overflow: hidden"><?php echo $farm->environment; ?></div>
            </div>
        </div>
        <div class="farm-show-box mtw">
            <div class="hd">配套设施</div>
            <div class="bd">
                <div class="farm-show-support">
                    <ul>
                        <?php $__currentLoopData = $farm->attrs->where('type', 'support'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <img src="<?php echo e(asset('static/image/brand/farm/supportIcon'.$value['attr_id'].'.png')); ?>">
                                <p><?php echo e(config('farm.support.'.$value['attr_id'])); ?></p>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.4.0&key=da8ac8316273d87097ab56f3cb828a3d&plugin=AMap.Autocomplete"></script>
    <script type="text/javascript">
        var map = new AMap.Map("amapcontainer", {
            resizeEnable: true,
            center: [<?php echo e($farm->maplng); ?>, <?php echo e($farm->maplat); ?>],//地图中心点
            zoom: 16 //地图显示的缩放级别
        });
        map.plugin(["AMap.ToolBar"], function() {
            map.addControl(new AMap.ToolBar());
        });
        new AMap.Marker({
            map: map,
            position: [<?php echo e($farm->maplng); ?>, <?php echo e($farm->maplat); ?>],
            icon: new AMap.Icon({
                size: new AMap.Size(40, 50),  //图标大小
                image: "<?php echo e(asset('static/image/common/way_btn.png')); ?>",
                imageOffset: new AMap.Pixel(0, -60)
            })
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $(".farm-show-picview").slide({ titCell:".spec-scroll li", mainCell:".spec-preview ul", effect:"fold", delayTime:200});
            $(".spec-scroll").slide({ mainCell:"ul",delayTime:100,vis:3,effect:"top",pnLoop:false,autoPage:true,prevCell:".prev",nextCell:".next" });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>