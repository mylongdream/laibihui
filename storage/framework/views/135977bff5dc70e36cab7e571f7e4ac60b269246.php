<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.mall.product')); ?></h3></div>
		<ul class="tab">
			<li class="current"><a href="<?php echo e(route('admin.mall.product.index')); ?>"><span><?php echo e(trans('admin.mall.product.list')); ?></span></a></li>
			<li><a href="<?php echo e(route('admin.mall.product.recycle')); ?>"><span><?php echo e(trans('admin.recycle')); ?></span></a></li>
		</ul>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('admin.mall.product.store')); ?>">
		<?php echo csrf_field(); ?>

		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z">
					<ul class="tb-tab">
						<li class="current"><span><?php echo e(trans('admin.info_base')); ?></span></li>
						<li><span><?php echo e(trans('admin.mall.product.message')); ?></span></li>
						<li><span><?php echo e(trans('admin.info_seo')); ?></span></li>
					</ul>
				</div>
				<div class="y"><a href="<?php echo e(route('admin.mall.product.index')); ?>" class="btn">< <?php echo e(trans('admin.mall.product.list')); ?></a></div>
			</div>
			<table>
				<tbody class="tb-body">
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.mall.product.category')); ?></td>
					<td>
						<select class="select" name="catid">
							<option value="">请选择</option>
							<?php $__currentLoopData = $categorylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($scategory->id); ?>"><?php echo e(str_repeat('->',$scategory->count-1)); ?><?php echo e($scategory->name); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.mall.product.name')); ?></td>
					<td><input class="txt" type="text" size="50" value="" name="name"></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.mall.product.upimage')); ?></td>
					<td>
                        <a href="javascript:;" class="upbtn" id="upimage">上传图片</a><span class="tdtip"></span>
                        <div class="uploadbox"><ul></ul></div>
                    </td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.mall.product.upphoto')); ?></td>
					<td>
                        <a href="javascript:;" class="upbtn" id="upphoto">上传图片</a><span class="tdtip"></span>
                        <div class="uploadbox"><ul></ul></div>
                    </td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.mall.product.price')); ?></td>
					<td><input class="txt" type="text" size="20" value="0" name="price"> 元<span class="tdtip"></span></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.mall.product.score')); ?></td>
					<td><input class="txt" type="text" size="20" value="0" name="score"> 个<span class="tdtip"></span></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.mall.product.stock')); ?></td>
					<td><input class="txt" type="text" size="20" value="0" name="stock"><span class="tdtip"></span></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.mall.product.sellnum')); ?></td>
					<td><input class="txt" type="text" size="20" value="0" name="sellnum"><span class="tdtip"></span></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.mall.product.viewnum')); ?></td>
					<td><input class="txt" type="text" size="20" value="0" name="viewnum"> 次<span class="tdtip"></span></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.mall.product.onsale')); ?></td>
					<td>
						<label class="radio" for="onsale_1">
							<input id="onsale_1" type="radio" name="onsale" value="1" checked> <?php echo e(trans('admin.yes')); ?>

						</label>
						<label class="radio" for="onsale_0">
							<input id="onsale_0" type="radio" name="onsale" value="0"> <?php echo e(trans('admin.no')); ?>

						</label>
					</td>
				</tr>
				</tbody>
				<tbody class="tb-body hidden">
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.mall.product.message')); ?></td>
					<td><textarea class="textarea" name="message" id="message" style="width:100%;height:400px"></textarea></td>
				</tr>
				</tbody>
				<tbody class="tb-body hidden">
				<tr>
					<td width="150" align="right">seo_title</td>
					<td><input class="txt" type="text" size="50" value="" name="seo_title"></td>
				</tr>
				<tr>
					<td align="right">seo_keywords</td>
					<td><input class="txt" type="text" size="50" value="" name="seo_keywords"></td>
				</tr>
				<tr>
					<td align="right">seo_description</td>
					<td><textarea class="textarea" name="seo_description" cols="60" rows="5"></textarea></td>
				</tr>
				</tbody>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
	<script type="text/javascript" src="<?php echo e(asset('static/js/webuploader/webuploader.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('static/js/jquery.webuploader.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('static/js/kindeditor/kindeditor.js')); ?>"></script>
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
            $("#upphoto").powerWebUpload({
                server: "<?php echo e(route('admin.upload.image')); ?>",
                formData: {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                hiddenInputId: 'upphoto[]',
                fileNumLimit: 5,
                width: 120,
                height: 120
            });
        });
        KindEditor.ready(function(K) {
            var ItemEditor = K.create("#message", {
                resizeType : 1,
                urlType : "absolute",
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