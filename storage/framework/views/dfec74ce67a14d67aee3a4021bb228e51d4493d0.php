<?php $__env->startSection('content'); ?>
    <div class="user-info">
        <div class="pic">
            <a href="javascript:;" class="user-face trigger-hover">
                <img id="avatarImg" src="<?php echo e(auth()->user()->headimgurl ? uploadImage(auth()->user()->headimgurl) : asset('static/image/common/getheadimg.jpg')); ?>" width="100" height="100">
                <div class="change-btn hidden"><span>更换头像</span></div>
            </a>
        </div>
        <div class="info">
            <div class="user-stuff">
                <span class="user-username">您好，<strong><?php echo e(auth()->user()->username); ?></strong></span>
                <span class="user-adjust">
                    <a href="<?php echo e(route('user.score.exchange')); ?>" class="">积分换钱</a>
                    <a href="javascript:;" class="">余额充值</a>
                    <a href="javascript:;" class="">余额提现</a>
                </span>
            </div>
            <div class="user-assets">
                <ul>
                    <li><em><?php echo e(auth()->user()->score); ?> 个</em><span>账户积分</span></li>
                    <li><em><?php echo e(auth()->user()->tiyan_money); ?> 元</em><span>到店体验金</span></li>
                    <li><em><?php echo e(auth()->user()->frozen_money); ?> 元</em><span>冻结余额</span></li>
                    <li><em><?php echo e(auth()->user()->user_money); ?> 元</em><span>可用余额</span></li>
                    <li><em><?php echo e(auth()->user()->consume_money); ?> 元</em><span>消费总额</span></li>
                </ul>
            </div>
            <div class="user-sign">
                <div class="user-sign-box">
                <?php if($todaysign): ?>
                    <a href="javascript:;" class="user-sign-btn disabled">今日已签到</a>
                <?php else: ?>
                    <a href="<?php echo e(route('user.sign.store')); ?>" class="user-sign-btn ajaxpost">签到领积分</a>
                <?php endif; ?>
                </div>
                <div class="user-sign-tip">
                    成功签到可<br>随机获得1-10个积分
                </div>
            </div>
        </div>
    </div>
    <?php if(!auth()->user()->profile): ?>
    <div class="extra-info mtw">
        <a href="<?php echo e(route('user.profile.index')); ?>">首次进入修改个人资料，补充完整送您20积分哦</a>
    </div>
    <?php endif; ?>
    <?php if(count($index->announces)): ?>
        <div class="announce-list mtw">
            <div class="hd">
                <div class="z"><h3>系统公告</h3></div>
                <div class="y"><a href="<?php echo e(route('announce.index')); ?>" target="_blank">查看更多</a></div>
            </div>
            <div class="bd">
                <ul>
                    <?php $__currentLoopData = $index->announces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(route('announce.show', ['id'=>$value->id])); ?>" target="_blank">
                                <strong><?php echo e($value->title); ?></strong><span><?php echo e($value->created_at->format('Y-m-d H:i')); ?></span>
                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
    <div class="mtw">
        <div class="tblist order-list">
            <table>
                <tr>
                    <th align="left"><?php echo e(trans('user.consume.shop')); ?></th>
                    <th align="center"><?php echo e(trans('user.consume.money')); ?></th>
                    <th align="center"><?php echo e(trans('user.consume.status')); ?></th>
                    <th align="center" width="120"><?php echo e(trans('user.operation')); ?></th>
                </tr>
                <?php if(count($index->consumes)): ?>
                    <?php $__currentLoopData = $index->consumes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="tr-bd">
                            <td width="66%" valign="top">
                                <?php if($value->shop): ?>
                                    <div class="s-item">
                                        <div class="s-pic">
                                            <a href="<?php echo e(route('brand.shop.show', $value->shop->id)); ?>" target="_blank" title="<?php echo e($value->shop->name); ?>">
                                                <img src="<?php echo e(uploadImage($value->shop->upimage)); ?>" width="150" height="150">
                                            </a>
                                        </div>
                                        <div class="s-info">
                                            <div class="s-name">
                                                <a href="<?php echo e(route('brand.shop.show', $value->shop->id)); ?>" target="_blank" title="<?php echo e($value->shop->name); ?>"><?php echo e($value->shop->name); ?></a>
                                            </div>
                                            <div class="s-extra">
                                                电话：<?php echo e($value->shop->phone); ?>

                                            </div>
                                            <div class="s-extra">
                                                地址：<?php echo e($value->shop->address); ?>

                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    /
                                <?php endif; ?>
                            </td>
                            <td width="10%" align="center"><?php echo e($value->money); ?> 元</td>
                            <td width="12%" align="center">
                                <p class="order-status"><?php echo e(trans('user.consume.status_'.$value->ifpay)); ?></p>
                                <p><a href="<?php echo e(route('user.consume.show', $value->id)); ?>" title="订单详情" class="openwindow">订单详情</a></p>
                            </td>
                            <td width="12%" align="center">
                                <?php if($value->ifpay == 0): ?>
                                    <a href="<?php echo e(route('user.consume.pay', $value->id)); ?>" target="_blank" title="立即付款" class="btn-pay">立即付款</a>
                                <?php else: ?>
                                    <?php if($value->shop): ?>
                                        <a href="<?php echo e(route('brand.shop.show', $value->shop->id)); ?>" target="_blank" title="<?php echo e($value->shop->name); ?>" class="btn-again">再次消费</a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" align="center" class="nodata">暂无数据</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
    <?php if(count($index->faqs)): ?>
    <div class="user-faq mtw">
        <div class="hd">
            <h3>常见问题</h3>
        </div>
        <div class="bd">
            <ul>
                <?php $__currentLoopData = $index->faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e(route('about.faq')); ?>#faq_<?php echo e($value->catid); ?>_<?php echo e($value->id); ?>" target="_blank"><?php echo e($value->title); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript" src="<?php echo e(asset('static/js/webuploader/webuploader.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('static/js/jquery.headimgurl.js')); ?>"></script>
    <script type="text/javascript">
        $(function(){
            $(".user-face").powerWebUpload({
                server: "<?php echo e(route('user.profile.face')); ?>",
                formData: {
                    _token : $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>