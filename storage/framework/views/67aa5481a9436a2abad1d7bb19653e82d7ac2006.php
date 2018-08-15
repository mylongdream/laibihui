<?php $__env->startSection('content'); ?>
    <div class="crm-main">
        <div class="crm-infobox">
            <div class="hd">
                <h4>编辑客户资料</h4>
            </div>
            <div class="bd crm-form">
                <form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('crm.shop.update', $shop->id)); ?>">
                    <?php echo method_field('PUT'); ?>

                    <?php echo csrf_field(); ?>

                    <div class="subtitle">基本信息</div>
                    <table>
                        <tr>
                            <td width="150" align="right">商户名称</td>
                            <td><?php echo e($shop->name); ?></td>
                        </tr>
                        <tr>
                            <td align="right" valign="top">展示图片</td>
                            <td>
                                <a href="javascript:;" class="upbtn" id="upphoto">上传图片</a><span class="tdtip mlw">建议尺寸为 800 X 800 像素大小</span>
                                <div class="uploadbox">
                                    <ul>
                                        <?php if($shop->upphoto): ?>
                                            <?php $__currentLoopData = unserialize($shop->upphoto); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upphoto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="trigger-hover">
                                                    <img src="<?php echo e(uploadImage($upphoto)); ?>" width="120" height="120">
                                                    <input name="upphoto[]" value="<?php echo e($upphoto); ?>" type="hidden">
                                                    <div class="handle"><span class="setup">前移</span><span class="setdown">后移</span><span class="setdel">删除</span></div>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="subtitle">店铺介绍</div>
                    <div class="">
                        <textarea class="textarea" name="message" id="message" style="width:100%;height:400px"><?php echo e($shop->message); ?></textarea>
                    </div>
                    <table>
                        <tr>
                            <td align="center"><button value="true" name="savesubmit" type="submit" class="button">提 交</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo e(asset('static/js/webuploader/webuploader.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('static/js/jquery.webuploader.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('static/js/kindeditor/kindeditor.js')); ?>"></script>
    <script type="text/javascript">
        $(function(){
            $("#upphoto").powerWebUpload({
                server: "<?php echo e(route('admin.upload.image')); ?>",
                formData: {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                hiddenInputId: 'upphoto[]',
                fileNumLimit: 10,
                width: 120,
                height: 120
            });
        });
        KindEditor.ready(function(K) {
            var ItemEditor = K.create("#message", {
                uploadJson : "<?php echo e(route('admin.upload.editor')); ?>",
                extraFileUploadParams : {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                afterBlur: function () { this.sync(); }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.crm.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>