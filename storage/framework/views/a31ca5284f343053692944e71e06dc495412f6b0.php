<?php $__env->startSection('content'); ?>
    <div class="itemnav">
        <div class="title"><h3><?php echo e(trans('admin.brand.allot')); ?></h3></div>
    </div>
    <form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('admin.brand.allot.update', ['shopid' => request('shopid'), 'id' => $allot->id])); ?>">
        <?php echo method_field('PUT'); ?>

        <?php echo csrf_field(); ?>

        <div class="tbedit">
            <div class="tbhead cl">
                <div class="z"><h3><?php echo e(trans('admin.brand.allot.edit', ['shopid' => request('shopid'), 'id' => $allot->id])); ?></h3></div>
                <div class="y"><a href="<?php echo e(route('admin.brand.allot.index', ['shopid' => request('shopid')])); ?>" class="btn">< <?php echo e(trans('admin.brand.allot.list')); ?></a></div>
            </div>
            <table>
                <tbody class="tb-body">
                <tr>
                    <td width="150" align="right"><?php echo e(trans('admin.brand.allot.shop')); ?></td>
                    <td>
                        <?php if(request('shopid')): ?>
                            <?php $__currentLoopData = $shoplist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(request('shopid') == $value->id): ?>
                                    <?php echo e($value->name); ?>

                                    <input type="hidden" name="shopid" value="<?php echo e(request('shopid')); ?>">
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <select name="shop_id" class="select select_shop">
                                <option value="0">请选择</option>
                                <?php $__currentLoopData = $shoplist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>" <?php echo e(request('shopid') == $value->id ? 'selected' : ''); ?>><?php echo e($value->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td align="right"><?php echo e(trans('admin.brand.allot.quantity')); ?></td>
                    <td><input class="txt" type="text" size="50" value="<?php echo e($allot->quantity); ?>" name="quantity"></td>
                </tr>
                <tr>
                    <td align="right"><?php echo e(trans('admin.brand.allot.price')); ?></td>
                    <td><input class="txt" type="text" size="30" value="<?php echo e($allot->price); ?>" name="price"> 元</td>
                </tr>
                <tr>
                    <td align="right"></td>
                    <td><input class="subtn" type="submit" value="提 交" name="submit"></td>
                </tr>
            </table>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>