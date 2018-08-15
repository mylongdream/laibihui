<?php $__env->startSection('content'); ?>
    <div class="itemnav">
        <div class="title"><h3>业主评选</h3></div>
        <ul class="tab">
            <li class="current"><a href="<?php echo e(route('admin.wechat.ownervote.index')); ?>"><span>基本设置</span></a></li>
            <li><a href="<?php echo e(route('admin.wechat.ownervote.apply')); ?>"><span>参与用户</span></a></li>
            <li><a href="<?php echo e(route('admin.wechat.ownervote.vote')); ?>"><span>投票记录</span></a></li>
            <li><a href="<?php echo e(route('admin.wechat.ownervote.visit')); ?>"><span>访问记录</span></a></li>
            <li><a href="<?php echo e(route('admin.wechat.ownervote.share')); ?>"><span>分享记录</span></a></li>
        </ul>
    </div>
    <form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('admin.wechat.ownervote.index')); ?>">
        <?php echo csrf_field(); ?>

        <div class="tbedit">
            <table>
                <tr>
                    <td width="150" align="right">活动地址</td>
                    <td><?php echo e(route('wechat.ownervote.index')); ?></td>
                </tr>
                <tr>
                    <td align="right">分享标题</td>
                    <td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['sharetitle']) ? $setting['sharetitle'] : ''); ?>" name="setting[sharetitle]"></td>
                </tr>
                <tr>
                    <td align="right">分享描述</td>
                    <td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['sharedec']) ? $setting['sharedec'] : ''); ?>" name="setting[sharedec]"></td>
                </tr>
                <tr>
                    <td align="right">分享封面</td>
                    <td>
                        <a href="javascript:;" class="upbtn" id="banner">上传图片</a><span class="tdtip">建议尺寸为 320 X 320 像素大小</span>
                        <div class="uploadbox">
                            <ul>
                                <?php if($setting['sharepic']): ?>
                                    <li class="trigger-hover">
                                        <img src="<?php echo e(uploadImage($setting['sharepic'])); ?>" width="120" height="120">
                                        <input name="banner" value="<?php echo e($setting['sharepic']); ?>" type="hidden">
                                        <div class="handle"><span class="setdel">删除</span></div>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="right">活动时间</td>
                    <td><input class="txt" type="text" size="20" value="2018-03-01 00:00:00" id="starttime" name="setting[starttime]"> -- <input class="txt" type="text" size="20" value="2018-03-30 00:00:00" id="endtime" name="setting[endtime]"><span class="tdtip">该活动时间内生效</span></td>
                </tr>
                <tr>
                    <td align="right">活动规则</td>
                    <td><textarea class="textarea" name="setting[statcode]" cols="60" rows="5"><?php echo e(isset($setting['statcode']) ? $setting['statcode'] : ''); ?></textarea></td>
                </tr>
                <tr>
                    <td align="right">访问次数</td>
                    <td><input class="txt" type="text" size="50" value="<?php echo e(isset($setting['sharedec']) ? $setting['sharedec'] : ''); ?>" name="setting[sharedec]"></td>
                </tr>
                <tr>
                    <td align="right">是否需要关注</td>
                    <td>
                        <label class="radio" for="bbclosed_1">
                            <input id="bbclosed_1" type="radio" name="setting[bbclosed]" value="1" <?php echo e(isset($setting['bbclosed'])&&$setting['bbclosed'] ? 'checked' : ''); ?>> <?php echo e(trans('admin.yes')); ?>

                        </label>
                        <label class="radio" for="bbclosed_0">
                            <input id="bbclosed_0" type="radio" name="setting[bbclosed]" value="0" <?php echo e(isset($setting['bbclosed'])&&$setting['bbclosed'] ? '' : 'checked'); ?>> <?php echo e(trans('admin.no')); ?>

                        </label>
                    </td>
                </tr>
                <tr>
                    <td align="right"></td>
                    <td><input class="subtn" type="submit" value="提 交" name="submit"></td>
                </tr>
            </table>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript" src="<?php echo e(asset('static/js/webuploader/webuploader.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('static/js/jquery.webuploader.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('static/js/laydate/laydate.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('static/js/kindeditor/kindeditor.js')); ?>"></script>
    <script type="text/javascript">
        $(function(){
            $("#banner").powerWebUpload({
                server: "<?php echo e(route('admin.upload.image')); ?>",
                formData: {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                hiddenInputId: 'banner',
                width: 120,
                height: 120
            });
            laydate({
                elem: '#starttime',
                istime: true,
                format:'YYYY-MM-DD hh:mm'
            });
            laydate({
                elem: '#endtime',
                istime: true,
                format:'YYYY-MM-DD hh:mm'
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

<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>