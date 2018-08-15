<?php $__env->startSection('content'); ?>
	<div class="itemnav">
		<div class="title"><h3><?php echo e(trans('user.score')); ?></h3></div>
		<ul class="tab">
			<li><a href="<?php echo e(route('user.score.index')); ?>"><span><?php echo e(trans('user.score.list')); ?></span></a></li>
			<li class="on"><a href="<?php echo e(route('user.score.exchange')); ?>"><span><?php echo e(trans('user.score.exchange')); ?></span></a></li>
			<li><a href="<?php echo e(route('user.score.transfer')); ?>"><span><?php echo e(trans('user.score.transfer')); ?></span></a></li>
		</ul>
	</div>
	<div class="tbedit mtw">
		<form class="ajaxform" enctype="multipart/form-data" method="post" action="<?php echo e(route('user.score.exchange')); ?>">
			<?php echo csrf_field(); ?>

			<table>
				<tr>
					<td width="150" align="right">当前积分</td>
					<td><?php echo e(auth()->user()->score); ?> 个</td>
				</tr>
				<tr>
					<td align="right">兑换可用余额</td>
					<td>
						<div class="choose-amount">
							<span class="cut_num"></span>
							<input class="key_num" type="text" value="1" name="amount" size="6" maxlength="6" data-max="<?php echo e(auth()->user()->score >= 1000 ? floor(auth()->user()->score / 1000) : 1); ?>">
							<span class="add_num"></span>
						</div>
						<div class="choose-tip">元</div>
					</td>
				</tr>
				<tr>
					<td align="right">所需积分</td>
					<td class="text-red"><span id="needscore">1000</span> 个</td>
				</tr>
				<tr>
					<td align="right"></td>
					<td>
                        <?php if(auth()->user()->score >= 1000): ?>
                            <button value="true" name="savesubmit" type="submit" class="button">兑 换</button>
                        <?php else: ?>
                            <button value="false" name="savesubmit" type="button" class="button disabled">无法兑换</button>
                        <?php endif; ?>
					</td>
				</tr>
				<tr>
					<td align="right"></td>
					<td>注：<span>1000个积分可兑换1元可用余额</span></td>
				</tr>
			</table>
		</form>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $(function() {
            $(document).on("change", ".choose-amount .key_num", function(){
                var value = $(this).val();
                $("#needscore").text(value * 1000);
            })
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>