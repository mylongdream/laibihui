<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.extend.reward')); ?></h3></div>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('admin.extend.reward.update', $reward->id)); ?>">
		<?php echo method_field('PUT'); ?>

		<?php echo csrf_field(); ?>

		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z"><h3><?php echo e(trans('admin.extend.reward.edit')); ?></h3></div>
				<div class="y"><a href="<?php echo e(route('admin.extend.reward.index')); ?>" class="btn">< <?php echo e(trans('admin.extend.reward.list')); ?></a></div>
			</div>
			<table>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.extend.reward.name')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($reward->name); ?>" name="name"></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.extend.reward.upimage')); ?></td>
					<td>
						<a href="javascript:;" class="clickbtn" id="upimage">上传图片</a><span class="tdtip">建议尺寸为 800 X 800 像素大小</span>
						<div class="uploadbox">
							<ul>
								<?php if($reward->upimage): ?>
										<li class="trigger-hover">
											<img src="<?php echo e(uploadImage($reward->upimage)); ?>" width="120" height="120">
											<input name="upimage" value="<?php echo e($reward->upimage); ?>" type="hidden">
											<div class="handle"><span class="setup">前移</span><span class="setdown">后移</span><span class="setdel">删除</span></div>
										</li>
								<?php endif; ?>
							</ul>
						</div>
					</td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.extend.reward.cardnum')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($reward->cardnum); ?>" name="cardnum"></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.extend.reward.onsale')); ?></td>
					<td>
						<label class="radio" for="onsale_1">
							<input id="onsale_1" type="radio" name="onsale" value="1" <?php echo e($reward->onsale ? 'checked' : ''); ?>> <?php echo e(trans('admin.yes')); ?>

						</label>
						<label class="radio" for="onsale_0">
							<input id="onsale_0" type="radio" name="onsale" value="0" <?php echo e($reward->onsale ? '' : 'checked'); ?>> <?php echo e(trans('admin.no')); ?>

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
    <script type="text/javascript">
    $(function(){
            $("#upimage").powerWebUpload({
                server: "<?php echo e(route('admin.upload.image')); ?>",
                formData: {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                hiddenInputId: 'upimage',
                width: 120,
                height: 120
            });
    });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>