<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.farm.farm')); ?></h3></div>
		<ul class="tab">
			<li class="current"><a href="<?php echo e(route('admin.farm.farm.index')); ?>"><span><?php echo e(trans('admin.farm.farm.list')); ?></span></a></li>
			<li><a href="<?php echo e(route('admin.farm.farm.recycle')); ?>"><span><?php echo e(trans('admin.recycle')); ?></span></a></li>
		</ul>
	</div>
	<form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('admin.farm.farm.update', $farm->id)); ?>">
		<?php echo method_field('PUT'); ?>

		<?php echo csrf_field(); ?>

		<div class="tbedit">
			<div class="tbhead cl">
				<div class="z">
					<ul class="tb-tab">
						<li class="current"><span><?php echo e(trans('admin.info_base')); ?></span></li>
						<li><span><?php echo e(trans('admin.farm.farm.message')); ?></span></li>
						<li><span><?php echo e(trans('admin.info_seo')); ?></span></li>
					</ul>
				</div>
				<div class="y"><a href="<?php echo e(route('admin.farm.farm.index')); ?>" class="btn">< <?php echo e(trans('admin.farm.farm.list')); ?></a></div>
			</div>
			<table>
				<tbody class="tb-body">
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.farm.farm.subweb')); ?></td>
					<td>
						<select name="subweb_id" class="select select_subweb">
							<option value="0">请选择</option>
							<?php $__currentLoopData = $subwebs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subweb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($farm->subweb == $subweb): ?>
									<option value="<?php echo e($subweb->subweb_id); ?>" selected>[<?php echo e($subweb->firstletter); ?>]<?php echo e($subweb->name); ?></option>
								<?php else: ?>
									<option value="<?php echo e($subweb->subweb_id); ?>">[<?php echo e($subweb->firstletter); ?>]<?php echo e($subweb->name); ?></option>
								<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.farm.farm.name')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($farm->name); ?>" name="name"></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.farm.farm.upphoto')); ?></td>
					<td>
						<a href="javascript:;" class="upbtn" id="upphoto">上传图片</a><span class="tdtip">建议尺寸为 800 X 600 像素大小</span>
						<div class="uploadbox">
							<ul>
								<?php if($farm->upphoto): ?>
									<?php $__currentLoopData = unserialize($farm->upphoto); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upphoto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
					<td align="right"><?php echo e(trans('admin.farm.farm.address')); ?></td>
					<td><textarea class="textarea" name="address" cols="60" rows="4"><?php echo e($farm->address); ?></textarea></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.farm.farm.group')); ?></td>
					<td>
						<?php $__currentLoopData = config('farm.group'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<label class="checkbox" for="group_<?php echo e($key); ?>">
								<input id="group_<?php echo e($key); ?>" type="checkbox" name="group[]" value="<?php echo e($key); ?>" <?php echo e($farm->attrs->where('type', 'group')->contains('attr_id', $key) ? 'checked' : ''); ?>> <?php echo e($value); ?>

							</label>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.farm.farm.play')); ?></td>
					<td>
						<?php $__currentLoopData = config('farm.play'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<label class="checkbox" for="play_<?php echo e($key); ?>">
								<input id="play_<?php echo e($key); ?>" type="checkbox" name="play[]" value="<?php echo e($key); ?>" <?php echo e($farm->attrs->where('type', 'play')->contains('attr_id', $key) ? 'checked' : ''); ?>> <?php echo e($value); ?>

							</label>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.farm.farm.service')); ?></td>
					<td>
						<?php $__currentLoopData = config('farm.service'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<label class="checkbox" for="service_<?php echo e($key); ?>">
								<input id="service_<?php echo e($key); ?>" type="checkbox" name="service[]" value="<?php echo e($key); ?>" <?php echo e($farm->attrs->where('type', 'service')->contains('attr_id', $key) ? 'checked' : ''); ?>> <?php echo e($value); ?>

							</label>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.farm.farm.support')); ?></td>
					<td>
						<?php $__currentLoopData = config('farm.support'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<label class="checkbox" for="support_<?php echo e($key); ?>">
								<input id="support_<?php echo e($key); ?>" type="checkbox" name="support[]" value="<?php echo e($key); ?>" <?php echo e($farm->attrs->where('type', 'support')->contains('attr_id', $key) ? 'checked' : ''); ?>> <?php echo e($value); ?>

							</label>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.farm.farm.mappoint')); ?></td>
					<td><input class="txt" type="text" size="15" value="<?php echo e($farm->maplng); ?>" name="maplng" id="maplng"> X <input class="txt" type="text" size="15" value="<?php echo e($farm->maplat); ?>" name="maplat" id="maplat"><a href="javascript:;" class="mapmark" id="mapmark">点击标注</a></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.farm.farm.phone')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($farm->phone); ?>" name="phone"></td>
				</tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.farm.farm.mobile')); ?></td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($farm->mobile); ?>" name="mobile"><span class="tdtip">用于接收短信通知，前台不显示</span></td>
				</tr>
                <tr>
                    <td align="right"><?php echo e(trans('admin.farm.farm.price')); ?></td>
                    <td><input class="txt" type="text" size="20" value="<?php echo e($farm->price); ?>" name="price"> 元</td>
                </tr>
				<tr>
					<td align="right"><?php echo e(trans('admin.farm.farm.viewnum')); ?></td>
					<td><input class="txt" type="text" size="20" value="<?php echo e($farm->viewnum); ?>" name="viewnum"> 次<span class="tdtip">设置显示浏览的次数，以后在此基础上累加</span></td>
				</tr>
				</tbody>
				<tbody class="tb-body hidden">
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.farm.farm.message')); ?></td>
					<td><textarea class="textarea" name="message" id="message" style="width:100%;height:400px"><?php echo e($farm->message); ?></textarea></td>
				</tr>
				<tr>
					<td width="150" align="right"><?php echo e(trans('admin.farm.farm.environment')); ?></td>
					<td><textarea class="textarea" name="environment" id="environment" style="width:100%;height:400px"><?php echo e($farm->environment); ?></textarea></td>
				</tr>
				</tbody>
				<tbody class="tb-body hidden">
				<tr>
					<td width="150" align="right">seo_title</td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($farm->seo_title); ?>" name="seo_title"></td>
				</tr>
				<tr>
					<td align="right">seo_keywords</td>
					<td><input class="txt" type="text" size="50" value="<?php echo e($farm->seo_keywords); ?>" name="seo_keywords"></td>
				</tr>
				<tr>
					<td align="right">seo_description</td>
					<td><textarea class="textarea" name="seo_description" cols="60" rows="5"><?php echo e($farm->seo_description); ?></textarea></td>
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
            $("#mapmark").amap({
                AddressId: '#address',
                maplngId: '#maplng',
                maplatId: '#maplat',
                width: 800,
                height: 500
            });
        });
		KindEditor.ready(function(K) {
            var ItemEditor1 = K.create("#message", {
                uploadJson : "<?php echo e(route('admin.upload.editor')); ?>",
                extraFileUploadParams : {
                    _token : $('meta[name="csrf-token"]').attr('content')
                },
                afterBlur: function () { this.sync(); }
            });
            var ItemEditor2 = K.create("#environment", {
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