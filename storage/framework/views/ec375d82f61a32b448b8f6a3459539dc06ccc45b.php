<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.wechat.user')); ?></h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="<?php echo e(route('admin.wechat.user.index')); ?>">
		<div class="tbsearch">
			<dl>
				<dd>
					<select class="schselect" name="subscribe" onchange='this.form.submit()'>
						<option value="">全部用户</option>
						<option value="yes" <?php echo request('subscribe') == 'yes' ? 'selected="selected"' : ''; ?>>已关注用户</option>
						<option value="no" <?php echo request('subscribe') == 'no' ? 'selected="selected"' : ''; ?>>未关注用户</option>
					</select>
				</dd>
			</dl>
			<dl>
				<dt><?php echo e(trans('admin.wechat.user.nickname')); ?></dt>
				<dd><input type="text" name="nickname" class="schtxt" value="<?php echo e(request('nickname')); ?>"></dd>
			</dl>
			<dl>
				<dt><?php echo e(trans('admin.wechat.user.openid')); ?></dt>
				<dd><input type="text" name="openid" class="schtxt" value="<?php echo e(request('openid')); ?>"></dd>
			</dl>
			<div class="schbtn"><button name="" type="submit"><?php echo e(trans('admin.search')); ?></button></div>
		</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="<?php echo e(route('admin.wechat.user.index')); ?>">
		<?php echo csrf_field(); ?>

		<input type="hidden" id="operate" name="operate" value="" />
		<div class="tblist">
			<div class="tbhead cl">
				<div class="z"><h3><?php echo e(trans('admin.wechat.user.list')); ?></h3></div>
				<div class="y">
					<a href="<?php echo e(route('admin.wechat.user.import')); ?>" class="btn" title="<?php echo e(trans('admin.wechat.user.import')); ?>"><?php echo e(trans('admin.wechat.user.import')); ?></a>
					<a href="<?php echo e(route('admin.wechat.user.upall')); ?>" class="btn" title="<?php echo e(trans('admin.wechat.user.upall')); ?>"><?php echo e(trans('admin.wechat.user.upall')); ?></a>
				</div>
			</div>
			<table>
				<tr>
					<th width="24"><label><input class="checkall" type="checkbox"></label></th>
					<th width="60"><?php echo e(trans('admin.wechat.user.headimgurl')); ?></th>
					<th width="180"><?php echo e(trans('admin.wechat.user.nickname')); ?></th>
					<th><?php echo e(trans('admin.wechat.user.openid')); ?></th>
					<th width="70"><?php echo e(trans('admin.wechat.user.city')); ?></th>
					<th width="70"><?php echo e(trans('admin.wechat.user.sex')); ?></th>
					<th width="70"><?php echo e(trans('admin.wechat.user.subscribe')); ?></th>
					<th width="120"><?php echo e(trans('admin.created_at')); ?></th>
					<th width="60"><?php echo e(trans('admin.operation')); ?></th>
				</tr>
				<?php $__currentLoopData = $userlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><label><input class="ids" type="checkbox" value="<?php echo e($value->uid); ?>" name="ids[]"></label></td>
						<td><img class="block" width="48" height="48" src="<?php echo e($value->headimgurl ? $value->headimgurl : asset('static/image/common/getheadimg.jpg')); ?>"></td>
						<td><?php echo e($value->nickname); ?></td>
						<td><?php echo e($value->openid); ?></td>
						<td><?php echo e($value->city ? $value->city : '/'); ?></td>
						<td><?php echo e($value->sex ? $value->sex == 1 ? '男' : '女' : '保密'); ?></td>
						<td><?php echo e($value->subscribe ? '是' : '否'); ?></td>
						<td><?php echo e($value->created_at->format('Y-m-d H:i')); ?></td>
						<td>
							<a href="<?php echo e(route('admin.wechat.user.update',$value->uid)); ?>" class="ajaxbtn" title="<?php echo e(trans('admin.wechat.user.edit')); ?>"><?php echo e(trans('admin.edit')); ?></a>
						</td>
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table>
		</div>
		<?php if(count($userlist) > 0): ?>
			<div class="pgs cl">
				<div class="fixsel z">
					<button class="submitbtn" name="delsubmit" value="yes" type="submit"><?php echo e(trans('admin.destroy')); ?></button>
				</div>
				<div class="page y">
					<?php echo $userlist->appends(['subscribe' => request('subscribe')])->appends(['nickname' => request('nickname')])->appends(['openid' => request('openid')])->links(); ?>

				</div>
			</div>
		<?php endif; ?>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>