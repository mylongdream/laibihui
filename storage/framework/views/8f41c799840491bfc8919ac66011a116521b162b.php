

                                <ul class="cl">
                                    <?php $__currentLoopData = $shoplist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a href="<?php echo e(route('mobile.brand.shop.show', $value->id)); ?>" title="<?php echo e($value->name); ?>">
                                                <div class="s-pic"><img src="<?php echo e(uploadImage($value->upimage)); ?>"></div>
                                                <div class="s-info">
                                                    <div class="s-name"><?php echo e($value->name); ?></div>
                                                    <div class="s-address">地址：<?php echo e($value->address); ?></div>
                                                    <div class="s-discount">
                                                        <label>尊享标牌价：</label>
                                                        <span class="s-discount1"><em>￥</em><strong><?php echo e($value->discount); ?></strong>折</span>
                                                        <span class="s-discount2"><del>原价靠边站</del></span>
                                                    </div>
                                                    <?php if($value->offline || $value->appoint || $value->ordermeal || $value->ordercard): ?>
                                                        <div class="s-support">
                                                            本店支持：
                                                            <?php if($value->offline): ?>
                                                                <span>线下付款</span>
                                                            <?php endif; ?>
                                                            <?php if($value->appoint): ?>
                                                                <span>预约订座</span>
                                                            <?php endif; ?>
                                                            <?php if($value->ordermeal): ?>
                                                                <span>在线点餐</span>
                                                            <?php endif; ?>
                                                            <?php if($value->ordercard): ?>
                                                                <span>店内办卡</span>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
