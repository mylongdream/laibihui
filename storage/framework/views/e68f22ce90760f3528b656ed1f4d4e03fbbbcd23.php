<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3>业主评选</h3></div>
		<ul class="tab">
			<li><a href="<?php echo e(route('admin.wechat.ownervote.index')); ?>"><span>基本设置</span></a></li>
			<li><a href="<?php echo e(route('admin.wechat.ownervote.apply')); ?>"><span>参与用户</span></a></li>
			<li class="current"><a href="<?php echo e(route('admin.wechat.ownervote.vote')); ?>"><span>投票记录</span></a></li>
			<li><a href="<?php echo e(route('admin.wechat.ownervote.visit')); ?>"><span>访问记录</span></a></li>
			<li><a href="<?php echo e(route('admin.wechat.ownervote.share')); ?>"><span>分享记录</span></a></li>
		</ul>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="<?php echo e(route('admin.wechat.ownervote.vote')); ?>">
	<div class="tbsearch">
		<dl>
			<dt>用户昵称</dt>
			<dd><input type="text" name="nickname" class="schtxt" value="<?php echo e(request('nickname')); ?>"></dd>
		</dl>
		<dl>
			<dt>用户openid</dt>
			<dd><input type="text" name="openid" class="schtxt" value="<?php echo e(request('openid')); ?>"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit"><?php echo e(trans('admin.search')); ?></button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform" method="post" action="<?php echo e(route('admin.wechat.ownervote.vote')); ?>">
	<?php echo csrf_field(); ?>

	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3>投票记录</h3></div>
		</div>
		<table>
			<tr>
				<th width="24"><label><input class="checkall" type="checkbox"></label></th>
				<th width="70">用户头像</th>
				<th>用户昵称</th>
				<th width="100">用户openid</th>
				<th width="70">投票用户</th>
				<th width="70">发送时间</th>
				<th width="70">发送IP</th>
			</tr>
			<?php $__currentLoopData = $votelist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><label><input class="ids" type="checkbox" value="<?php echo e($value->id); ?>" name="ids[]"></label></td>
				<td><img class="block" width="48" height="48" src="<?php echo e($value->headimgurl ? uploadImage($value->headimgurl) : asset('static/image/common/getheadimg.jpg')); ?>"></td>
				<td><?php echo e($value->nickname); ?></td>
				<td><?php echo e($value->openid); ?></td>
				<td><?php echo e($value->user ? $value->user->realname : '/'); ?></td>
				<td><?php echo e($value->postip); ?></td>
				<td><?php echo e($value->created_at ? $value->created_at->format('Y-m-d H:i') : ''); ?></td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($votelist) > 0): ?>
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit"><?php echo e(trans('admin.destroy')); ?></button>
		</div>
		<div class="page y">
			<?php echo $votelist->appends(['nickname' => request('nickname')])->appends(['openid' => request('openid')])->links(); ?>

		</div>
    </div>
	<?php endif; ?>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>