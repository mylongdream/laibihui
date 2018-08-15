<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.brand.shop')); ?></h3></div>
		<ul class="tab">
			<li class="current"><a href="<?php echo e(route('admin.brand.shop.index')); ?>"><span><?php echo e(trans('admin.brand.shop.list')); ?></span></a></li>
			<li><a href="<?php echo e(route('admin.brand.shop.recycle')); ?>"><span><?php echo e(trans('admin.recycle')); ?></span></a></li>
		</ul>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('admin.brand.shop.update', $shop->id)); ?>">
		<?php echo method_field('PUT'); ?>

		<?php echo csrf_field(); ?>

		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z">
					<ul class="tb-tab">
						<li class="current"><span><?php echo e(trans('admin.info_base')); ?></span></li>
						<li><span><?php echo e(trans('admin.brand.shop.message')); ?></span></li>
						<li><span><?php echo e(trans('admin.brand.shop.function')); ?></span></li>
						<li><span><?php echo e(trans('admin.info_seo')); ?></span></li>
					</ul>
				</div>
				<div class="y"><a href="<?php echo e(route('admin.brand.shop.index')); ?>" class="btn">< <?php echo e(trans('admin.brand.shop.list')); ?></a></div>
			</div>
			<table>
				<tbody class="tb-body">
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.brand.shop.subweb')); ?></td>
					<td>
						<select name="subweb_id" class="select select_subweb">
							<option value="0">请选择</option>
							<?php $__currentLoopData = $subwebs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subweb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($shop->subweb == $subweb): ?>
									<option value="<?php echo e($subweb->subweb_id); ?>" selected>[<?php echo e($subweb->firstletter); ?>]<?php echo e($subweb->name); ?></option>
								<?php else: ?>
									<option value="<?php echo e($subweb->subweb_id); ?>">[<?php echo e($subweb->firstletter); ?>]<?php echo e($subweb->name); ?></option>
								<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.brand.shop.category')); ?></td>
					<td>
						<select class="select" name="catid">
							<option value="">请选择</option>
							<?php $__currentLoopData = $categorylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($scategory->id); ?>" <?php echo $shop->catid == $scategory->id ? 'selected="selected"' : ''; ?>><?php echo e(str_repeat('->',$scategory->count-1)); ?><?php echo e($scategory->name); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.brand.shop.name')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($shop->name); ?>" name="name"></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.brand.shop.upphoto')); ?></td>
					<td>
						<a href="javascript:;" class="upbtn" id="upphoto">上传图片</a><span class="tdtip">建议尺寸为 800 X 800 像素大小</span>
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
				<tr>
					<td align="right"><?php echo e(trans('admin.brand.shop.banner')); ?></td>
					<td>
                        <a href="javascript:;" class="upbtn" id="banner">上传图片</a><span class="tdtip">建议尺寸为 1190 X 120 像素大小</span>
                        <div class="uploadbox">
                            <ul>
                                <?php if($shop->banner): ?>
                                    <li class="trigger-hover">
                                        <img src="<?php echo e(uploadImage($shop->banner)); ?>" width="595" height="60">
                                        <input name="banner" value="<?php echo e($shop->banner); ?>" type="hidden">
                                        <div class="handle"><span class="setdel">删除</span></div>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.brand.shop.address')); ?></td>
					<td><textarea class="textarea" name="address" cols="60" rows="4"><?php echo e($shop->address); ?></textarea></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.brand.shop.mappoint')); ?></td>
					<td><input class="txt" type="text" size="15" value="<?php echo e($shop->maplng); ?>" name="maplng" id="maplng"> X <input class="txt" type="text" size="15" value="<?php echo e($shop->maplat); ?>" name="maplat" id="maplat"><a href="javascript:;" class="mapmark" id="mapmark">点击标注</a></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.brand.shop.phone')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($shop->phone); ?>" name="phone"></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.brand.shop.mobile')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($shop->mobile); ?>" name="mobile"><span class="tdtip">用于接收短信通知，前台不显示</span></td>
				</tr>
                <tr>
                    <td align="right"><?php echo e(trans('admin.brand.shop.discount')); ?></td>
                    <td><input class="txt" type="text" size="20" value="<?php echo e($shop->discount); ?>" name="discount"> 折</td>
                </tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.brand.shop.indiscount')); ?></td>
					<td><input class="txt" type="text" size="20" value="<?php echo e($shop->indiscount); ?>" name="indiscount"> 折<span class="tdtip">公司与商家签订的合同折扣，前台不显示</span></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.brand.shop.expiry')); ?></td>
					<td><input id="starttime" class="txt" type="text" size="20" value="<?php echo e($shop->started_at ? $shop->started_at->format('Y-m-d H:i') : ''); ?>" name="started_at"> 至 <input id="endtime" class="txt" type="text" size="20" value="<?php echo e($shop->ended_at ? $shop->ended_at->format('Y-m-d H:i') : ''); ?>" name="ended_at"></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.brand.shop.viewnum')); ?></td>
					<td><input class="txt" type="text" size="20" value="<?php echo e($shop->viewnum); ?>" name="viewnum"> 次<span class="tdtip">设置显示浏览的次数，以后在此基础上累加</span></td>
				</tr>
				</tbody>
				<tbody class="tb-body hidden">
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.brand.shop.message')); ?></td>
					<td><textarea class="textarea" name="message" id="message" style="width:100%;height:400px"><?php echo e($shop->message); ?></textarea></td>
				</tr>
				</tbody>
				<tbody class="tb-body hidden">
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.brand.shop.offline')); ?></td>
					<td>
						<label class="radio" for="offline_1">
							<input id="offline_1" type="radio" name="offline" value="1" <?php echo e($shop->offline ? 'checked' : ''); ?>> <?php echo e(trans('admin.brand.shop.offline_1')); ?>

						</label>
						<label class="radio" for="offline_0">
							<input id="offline_0" type="radio" name="offline" value="0" <?php echo e($shop->offline ? '' : 'checked'); ?>> <?php echo e(trans('admin.brand.shop.offline_0')); ?>

						</label>
					</td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.brand.shop.appoint')); ?></td>
					<td>
						<label class="radio" for="appoint_1">
							<input id="appoint_1" type="radio" name="appoint" value="1" <?php echo e($shop->appoint ? 'checked' : ''); ?>> <?php echo e(trans('admin.brand.shop.appoint_1')); ?>

						</label>
						<label class="radio" for="appoint_0">
							<input id="appoint_0" type="radio" name="appoint" value="0" <?php echo e($shop->appoint ? '' : 'checked'); ?>> <?php echo e(trans('admin.brand.shop.appoint_0')); ?>

						</label>
					</td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.brand.shop.ordermeal')); ?></td>
					<td>
						<label class="radio" for="ordermeal_1">
							<input id="ordermeal_1" type="radio" name="ordermeal" value="1" <?php echo e($shop->ordermeal ? 'checked' : ''); ?>> <?php echo e(trans('admin.brand.shop.ordermeal_1')); ?>

						</label>
						<label class="radio" for="ordermeal_0">
							<input id="ordermeal_0" type="radio" name="ordermeal" value="0" <?php echo e($shop->ordermeal ? '' : 'checked'); ?>> <?php echo e(trans('admin.brand.shop.ordermeal_0')); ?>

						</label>
					</td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.brand.shop.ordercard')); ?></td>
					<td>
						<label class="radio" for="ordercard_1">
							<input id="ordercard_1" type="radio" name="ordercard" value="1" <?php echo e($shop->ordercard ? 'checked' : ''); ?>> <?php echo e(trans('admin.brand.shop.ordercard_1')); ?>

						</label>
						<label class="radio" for="ordercard_0">
							<input id="ordercard_0" type="radio" name="ordercard" value="0" <?php echo e($shop->ordercard ? '' : 'checked'); ?>> <?php echo e(trans('admin.brand.shop.ordercard_0')); ?>

						</label>
					</td>
				</tr>
				</tbody>
				<tbody class="tb-body hidden">
				<tr>
					<td width="150" align="right">seo_title</td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($shop->seo_title); ?>" name="seo_title"></td>
				</tr>
				<tr>
					<td align="right">seo_keywords</td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($shop->seo_keywords); ?>" name="seo_keywords"></td>
				</tr>
				<tr>
					<td align="right">seo_description</td>
					<td><textarea class="textarea" name="seo_description" cols="60" rows="5"><?php echo e($shop->seo_description); ?></textarea></td>
				</tr>
				</tbody>
				<tr>
					<td align="right"></td>
					<td><input class="subtn" type="submit" value="提 交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
	<script type="text/javascript" src="http://webapi.amap.com/maps?v=1.4.0&key=da8ac8316273d87097ab56f3cb828a3d&plugin=AMap.Autocomplete"></script>
	<script type="text/javascript" src="<?php echo e(asset('static/js/jquery.amap.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('static/js/webuploader/webuploader.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('static/js/jquery.webuploader.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('static/js/laydate/laydate.js')); ?>"></script>
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
            $("#banner").powerWebUpload({
                server: "<?php echo e(route('admin.upload.image')); ?>",
                formData: {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                hiddenInputId: 'banner',
                width: 595,
                height: 60
            });
            $("#mapmark").amap({
                AddressId: '#address',
                maplngId: '#maplng',
                maplatId: '#maplat',
                width: 800,
                height: 500
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