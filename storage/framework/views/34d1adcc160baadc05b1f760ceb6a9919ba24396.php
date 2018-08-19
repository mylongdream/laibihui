<?php $__env->startSection('content'); ?>
    <div class="crm-main">
        <div class="crm-infobox">
            <div class="hd">
                <h4>提交审核</h4>
            </div>
            <div class="bd crm-form">
                <form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('crm.customer.refer',$customer->id)); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="subtitle">基本信息</div>
                    <table>
                        <tr>
                            <td width="150" align="right">商户名称</td>
                            <td><?php echo e($customer->name); ?></td>
                        </tr>
                        <tr>
                            <td width="150" align="right">商户地址</td>
                            <td><?php echo e($customer->address); ?></td>
                        </tr>
                    </table>
                    <div class="subtitle">照片信息</div>
                    <table>
                        <tr>
                            <td width="150" align="right" valign="top">合同照片</td>
                            <td>
                                <?php if($customer->pic_hetong): ?>
                                    <div class="uploadbox">
                                        <ul>
                                            <?php $__currentLoopData = unserialize($customer->pic_hetong); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upphoto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <img src="<?php echo e(uploadImage($upphoto)); ?>" width="120" height="120">
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php else: ?>
                                    <div>暂无图片</div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="150" align="right" valign="top">商户资质照片</td>
                            <td>
                                <?php if($customer->pic_zizhi): ?>
                                    <div class="uploadbox">
                                        <ul>
                                            <?php $__currentLoopData = unserialize($customer->pic_zizhi); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upphoto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <img src="<?php echo e(uploadImage($upphoto)); ?>" width="120" height="120">
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php else: ?>
                                    <div>暂无图片</div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" valign="top">店铺门头照片</td>
                            <td>
                                <?php if($customer->pic_mentou): ?>
                                    <div class="uploadbox">
                                        <ul>
                                            <?php $__currentLoopData = unserialize($customer->pic_mentou); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upphoto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <img src="<?php echo e(uploadImage($upphoto)); ?>" width="120" height="120">
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php else: ?>
                                    <div>暂无图片</div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" valign="top">店铺内景照片</td>
                            <td>
                                <?php if($customer->pic_neijing): ?>
                                    <div class="uploadbox">
                                        <ul>
                                            <?php $__currentLoopData = unserialize($customer->pic_neijing); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upphoto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <img src="<?php echo e(uploadImage($upphoto)); ?>" width="120" height="120">
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php else: ?>
                                    <div>暂无图片</div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" valign="top">菜单价目照片</td>
                            <td>
                                <?php if($customer->pic_caidan): ?>
                                    <div class="uploadbox">
                                        <ul>
                                            <?php $__currentLoopData = unserialize($customer->pic_caidan); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upphoto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <img src="<?php echo e(uploadImage($upphoto)); ?>" width="120" height="120">
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php else: ?>
                                    <div>暂无图片</div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" valign="top">特色菜品照片</td>
                            <td>
                                <?php if($customer->pic_caipin): ?>
                                    <div class="uploadbox">
                                        <ul>
                                            <?php $__currentLoopData = unserialize($customer->pic_caipin); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upphoto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <img src="<?php echo e(uploadImage($upphoto)); ?>" width="120" height="120">
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php else: ?>
                                    <div>暂无图片</div>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td align="center"><button value="true" name="savesubmit" type="submit" class="button">提交审核</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.crm.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>