<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('admin.extend.card')); ?></h3></div>
	</div>
	<form id="schform" name="schform" class="formsearch" method="get" action="<?php echo e(route('admin.extend.card.index')); ?>">
	<div class="tbsearch">
		<dl>
			<dd>
				<select class="schselect" name="bind" onchange='this.form.submit()'>
					<option value="0">未绑定</option>
                    <option value="1" <?php echo request('bind') == 1 ? 'selected="selected"' : ''; ?>>已绑定</option>
					<option value="2" <?php echo request('bind') == 2 ? 'selected="selected"' : ''; ?>>被分配</option>
                </select>
			</dd>
		</dl>
		<dl>
			<dt><?php echo e(trans('admin.extend.card.prefix')); ?></dt>
			<dd><input type="text" name="prefix" class="schtxt" value="<?php echo e(request('prefix')); ?>"></dd>
		</dl>
		<div class="schbtn"><button name="" type="submit"><?php echo e(trans('admin.search')); ?></button></div>
	</div>
	</form>
	<form id="cpform" name="cpform" class="ajaxform confirmpwd" method="post" action="<?php echo e(route('admin.extend.card.batch')); ?>">
	<?php echo csrf_field(); ?>

	<input type="hidden" id="operate" name="operate" value="" />
	<div class="tblist">
		<div class="tbhead cl">
			<div class="z"><h3><?php echo e(trans('admin.extend.card.list')); ?>（共 <?php echo $cards->total(); ?> 条）</h3></div>
			<div class="y">
				<a href="<?php echo e(route('admin.extend.card.create')); ?>" class="btn openwindow confirmpwd" title="<?php echo e(trans('admin.extend.card.create')); ?>">+ <?php echo e(trans('admin.extend.card.create')); ?></a>
				<a href="<?php echo e(route('admin.extend.card.export')); ?>" class="btn openwindow confirmpwd" title="<?php echo e(trans('admin.extend.card.export')); ?>"><?php echo e(trans('admin.extend.card.export')); ?></a>
			</div>
		</div>
		<table>
			<tr>
				<th width="24"><input class="checkall" type="checkbox"></th>
				<th width="160"><?php echo e(trans('admin.extend.card.number')); ?></th>
				<th><?php echo e(trans('admin.extend.card.password')); ?></th>
				<th width="150"><?php echo e(trans('admin.extend.card.money')); ?></th>
				<th width="150"><?php echo e(trans('admin.created_at')); ?></th>
				<th width="70"><?php echo e(trans('admin.operation')); ?></th>
			</tr>
			<?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><input class="ids" type="checkbox" value="<?php echo e($card->id); ?>" name="ids[]"></td>
				<td><?php echo e(isset($card->number) ? $card->number : '/'); ?></td>
				<td><?php echo e(isset($card->password) ? $card->password : '/'); ?></td>
				<td><?php echo e($card->money); ?> 元</td>
				<td><?php echo e($card->created_at->format('Y-m-d H:i')); ?></td>
				<td>
					<a href="<?php echo e(route('admin.extend.card.destroy',$card->id)); ?>" class="delbtn confirmpwd"><?php echo e(trans('admin.destroy')); ?></a>
				</td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(count($cards) > 0): ?>
	<div class="pgs cl">
		<div class="fixsel z">
			<button class="submitbtn" name="delsubmit" value="yes" type="submit"><?php echo e(trans('admin.destroy')); ?></button>
		</div>
        <div class="page y">
            <?php echo $cards->appends(['bind' => request('bind')])->appends(['prefix' => request('prefix')])->links(); ?>

        </div>
    </div>
	<?php endif; ?>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>