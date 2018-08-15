<?php $__env->startSection('content'); ?>
    <?php if(!request()->ajax()): ?>
        <div class="shop-body">
            <?php echo $__env->make('brand.shop.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="wp">
                <div class="cl ct_shop mtm">
                    <div class="side">
                        <div class="shop-info">
                            <div class="hd">
                                <span>店铺信息</span>
                            </div>
                            <div class="bd">
                                <dl>
                                    <dt><img width="120" height="120" border="0" src="<?php echo e(uploadImage($shop->upimage)); ?>"></dt>
                                    <dd><?php echo e($shop->name); ?></dd>
                                </dl>
                                <table>
                                    <tr>
                                        <th>分类： </th>
                                        <td><?php echo e($shop->category->name); ?></td>
                                    </tr>
                                    <tr>
                                        <th>电话： </th>
                                        <td><?php echo e($shop->phone); ?></td>
                                    </tr>
                                    <tr>
                                        <th>地址： </th>
                                        <td><?php echo e($shop->address); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="shop-sdlist mtm">
                            <div class="hd">
                                <span>最新店铺</span>
                            </div>
                            <div class="bd">
                                <ul>
                                    <?php $__currentLoopData = $newshops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newshop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <div class="s-pic"><a href="<?php echo e(route('brand.shop.show', $newshop->id)); ?>" target="_blank" title="<?php echo e($newshop->name); ?>"><img width="120" height="120" border="0" src="<?php echo e(uploadImage($newshop->upimage)); ?>"></a></div>
                                            <div class="s-info">
                                                <div class="s-name"><a href="<?php echo e(route('brand.shop.show', $newshop->id)); ?>" target="_blank" title="<?php echo e($newshop->name); ?>"><?php echo e($newshop->name); ?></a></div>
                                                <div class="s-address"><?php echo e($newshop->address); ?></div>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                        <div class="shop-sdlist mtm">
                            <div class="hd">
                                <span>热门店铺</span>
                            </div>
                            <div class="bd">
                                <ul>
                                    <?php $__currentLoopData = $hotshops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotshop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <div class="s-pic"><a href="<?php echo e(route('brand.shop.show', $hotshop->id)); ?>" target="_blank" title="<?php echo e($hotshop->name); ?>"><img width="120" height="120" border="0" src="<?php echo e(uploadImage($hotshop->upimage)); ?>"></a></div>
                                            <div class="s-info">
                                                <div class="s-name"><a href="<?php echo e(route('brand.shop.show', $hotshop->id)); ?>" target="_blank" title="<?php echo e($hotshop->name); ?>"><?php echo e($hotshop->name); ?></a></div>
                                                <div class="s-address"><?php echo e($hotshop->address); ?></div>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="main">
                        <div class="shop-tips">
                            <div class="shop-tips-text">
                                <p>亲爱的用户，本店已与知惠网签署合作协议，请您放心消费！</p>
                                <p>如遇商家不给折扣现象，请您当场拨打维权热线！</p>
                                <p>15162882535（小朱）或18862762696（小沈）会帮您及时解决哦~</p>
                            </div>
                        </div>
                        <div class="shop-comment mtm">
                            <div class="hd">
                                <span>顾客点评</span>
                            </div>
                            <div class="bd">
                                <div class="shop-comment-form">
                                    <form id="cpform" name="cpform" class="ajaxform" method="post" action="<?php echo e(route('brand.shop.comment', $shop->id)); ?>">
                                        <?php echo csrf_field(); ?>

                                        <div class="comment-score">
                                            <dl>
                                                <dt>服务</dt>
                                                <dd><div id="service" class="score-star"></div></dd>
                                            </dl>
                                            <dl>
                                                <dt>环境</dt>
                                                <dd><div id="environment" class="score-star"></div></dd>
                                            </dl>
                                            <dl>
                                                <dt>性价比</dt>
                                                <dd><div id="priceratio" class="score-star"></div></dd>
                                            </dl>
                                        </div>
                                        <div class="comment-box">
                                            <div class="comment-area">
                                                <textarea data-maxlength="300" name="message" placeholder="消费完，不吐不快！别憋着，马上说出来吧！"></textarea>
                                            </div>
                                            <?php if(auth()->guard()->check()): ?>
                                            <div class="uploadbox comment-photo">
                                                <ul></ul>
                                            </div>
                                            <?php endif; ?>
                                            <div class="comment-toolbar">
                                                <?php if(auth()->guard()->check()): ?>
                                                <a href="javascript:;" class="upbtn" id="upphoto">上传图片</a>
                                                <?php endif; ?>
                                                <button class="submitbtn" name="commentsubmit" value="yes" type="submit">发表评论</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="shop-comment-list"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="comment-list-head">
            <h3 class="title">最新评论</h3>
        </div>
        <div class="comment-list-body">
            <?php if(count($commentlist)): ?>
                <?php $__currentLoopData = $commentlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="comment-item">
                        <div class="comment-content">
                            <div class="comment-user-avatar">
                                <img src="<?php echo e($comment->user && $comment->user->headimgurl ? uploadImage($comment->user->headimgurl) : asset('static/image/common/getheadimg.jpg')); ?>" border="0">
                            </div>
                            <div class="comment-section">
                                <div class="comment-user-info">
                                    <div class="z">
                                        <span class="comment-user-name"><?php echo e($comment->user ? $comment->user->username : '匿名'); ?></span>
                                        <span class="comment-time"><?php echo e($comment->created_at->format('Y-m-d H:i')); ?></span>
                                    </div>
                                    <div class="y">
                                        <div class="comment-score">
                                            <span>服务：<?php echo e($comment->service); ?>分</span>
                                            <span>环境：<?php echo e($comment->environment); ?>分</span>
                                            <span>性价比：<?php echo e($comment->priceratio); ?>分</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-text">
                                    <?php echo e($comment->message); ?>

                                </div>
                                <?php if($comment->upphoto): ?>
                                    <div class="comment-photo">
                                        <ul>
                                            <?php $__currentLoopData = unserialize($comment->upphoto); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upphoto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <a href="<?php echo e(uploadImage($upphoto)); ?>" data-lightbox="comment-photo<?php echo e($comment->id); ?>"><img src="<?php echo e(uploadImage($upphoto, ['width'=>70,'height'=>70,'type'=>1])); ?>" width="70" height="70" /></a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="comment-nodata">
                    <span>暂无评论</span>
                </div>
            <?php endif; ?>
        </div>
        <?php echo $commentlist->links(); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <link href="<?php echo e(asset('static/js/lightbox2/css/lightbox.min.css')); ?>" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo e(asset('static/js/lightbox2/js/lightbox.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('static/js/jquery.raty.js')); ?>"></script>
    <script type="text/javascript">
        $(function(){
            $.fn.raty.defaults.path = "<?php echo e(asset('static/image/common')); ?>";
            $('#service').raty({
                scoreName: 'service',
                size     : 24,
                score: 3
            });
            $('#environment').raty({
                scoreName: 'environment',
                size     : 24,
                score: 3
            });
            $('#priceratio').raty({
                scoreName: 'priceratio',
                size     : 24,
                score: 3
            });
            $(".shop-comment-list").load("<?php echo e(route('brand.shop.comment', $shop->id)); ?>").on("click", ".pagination a", function(){
                var self = $(this);
                $(".shop-comment-list").load(self.attr("href"));
                return false;
            });
        });
    </script>
    <?php if(auth()->guard()->check()): ?>
    <script type="text/javascript" src="<?php echo e(asset('static/js/webuploader/webuploader.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('static/js/jquery.webuploader.js')); ?>"></script>
    <script type="text/javascript">
        $(function(){
            $("#upphoto").powerWebUpload({
                server: "<?php echo e(route('user.upload.image')); ?>",
                formData: {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                hiddenInputId: 'upphoto[]',
                fileNumLimit: 10,
                width: 120,
                height: 120
            });
        });
    </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common.simple', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>