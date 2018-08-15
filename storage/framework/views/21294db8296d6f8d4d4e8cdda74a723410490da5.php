<?php $__env->startSection('content'); ?>
    <div class="wp">
        <div class="filter-sort">
            <div class="mtm">
                <dl class="cl">
                    <dt>适合人群</dt>
                    <dd>
                        <a href="<?php echo e(route('brand.farm.lists', ['play' => request('play'), 'minprice' => request('minprice'), 'maxprice' => request('maxprice'), 'keyword' => request('keyword'), 'orderby' => request('orderby')])); ?>" <?php echo request('group') ? '' : 'class="a"'; ?>>不限</a>
                        <?php $__currentLoopData = config('farm.group'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('brand.farm.lists', ['group' => request('group') ? in_array($key, explode("-", request('group'))) ? implode("-",array_diff(explode("-", request('group')), array($key))) : request('group').'-'.$key : $key, 'play' => request('play'), 'minprice' => request('minprice'), 'maxprice' => request('maxprice'), 'keyword' => request('keyword'), 'orderby' => request('orderby')])); ?>" <?php echo in_array($key, explode("-", request('group'))) ? 'class="a"' : ''; ?>><span><?php echo e($value); ?></span></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </dd>
                </dl>
                <dl class="cl">
                    <dt>能玩什么</dt>
                    <dd>
                        <a href="<?php echo e(route('brand.farm.lists', ['group' => request('group'), 'minprice' => request('minprice'), 'maxprice' => request('maxprice'), 'keyword' => request('keyword'), 'orderby' => request('orderby')])); ?>" <?php echo request('play') ? '' : 'class="a"'; ?>>不限</a>
                        <?php $__currentLoopData = config('farm.play'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('brand.farm.lists', ['play' => request('play') ? in_array($key, explode("-", request('play'))) ? implode("-",array_diff(explode("-", request('play')), array($key))) : request('play').'-'.$key : $key, 'group' => request('group'), 'minprice' => request('minprice'), 'maxprice' => request('maxprice'), 'keyword' => request('keyword'), 'orderby' => request('orderby')])); ?>" <?php echo in_array($key, explode("-", request('play'))) ? 'class="a"' : ''; ?>><span><?php echo e($value); ?></span></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </dd>
                </dl>
                <dl class="cl">
                    <dt>价格范围</dt>
                    <dd>
                        <a href="<?php echo e(route('brand.farm.lists', ['group' => request('group'), 'play' => request('play'), 'keyword' => request('keyword'), 'orderby' => request('orderby')])); ?>" <?php echo request('minprice') || request('maxprice') ? '' : 'class="a"'; ?>>不限</a>
                        <a href="<?php echo e(route('brand.farm.lists', ['maxprice' => 200, 'group' => request('group'), 'play' => request('play'), 'keyword' => request('keyword'), 'orderby' => request('orderby')])); ?>" <?php echo !request('minprice') && request('maxprice') == 200 ? 'class="a"' : ''; ?>><span>￥200以下</span></a>
                        <a href="<?php echo e(route('brand.farm.lists', ['minprice' => 200, 'maxprice' => 300, 'group' => request('group'), 'play' => request('play'), 'keyword' => request('keyword'), 'orderby' => request('orderby')])); ?>" <?php echo request('minprice') == 200 && request('maxprice') == 300 ? 'class="a"' : ''; ?>><span>￥200-￥300</span></a>
                        <a href="<?php echo e(route('brand.farm.lists', ['minprice' => 300, 'maxprice' => 500, 'group' => request('group'), 'play' => request('play'), 'keyword' => request('keyword'), 'orderby' => request('orderby')])); ?>" <?php echo request('minprice') == 300 && request('maxprice') == 500 ? 'class="a"' : ''; ?>><span>￥300-￥500</span></a>
                        <a href="<?php echo e(route('brand.farm.lists', ['minprice' => 500, 'group' => request('group'), 'play' => request('play'), 'keyword' => request('keyword'), 'orderby' => request('orderby')])); ?>" <?php echo request('minprice') == 500 && !request('maxprice') ? 'class="a"' : ''; ?>><span>￥500以上</span></a>
                        <span class="f-price">
                            自定义 <input id="minprice" name="minprice" value="<?php echo e(request('minprice')); ?>" type="text"> ~ <input id="maxprice" name="maxprice" value="<?php echo e(request('maxprice')); ?>" type="text">
                            <button type="button" class="filter-price" rel="<?php echo e(route('brand.farm.lists', ['group' => request('group'), 'play' => request('play'), 'keyword' => request('keyword'), 'orderby' => request('orderby')])); ?>">确定</button>
                        </span>
                    </dd>
                </dl>
                <dl class="f-order cl">
                    <dt>排序</dt>
                    <dd>
                        <a href="<?php echo e(route('brand.farm.lists', ['group' => request('group'), 'play' => request('play'), 'minprice' => request('minprice'), 'maxprice' => request('maxprice'), 'keyword' => request('keyword')])); ?>" <?php echo request('orderby') ? '' : 'class="a"'; ?>><span>默认</span></a>
                        <a href="<?php echo e(route('brand.farm.lists', ['orderby' => 'price', 'group' => request('group'), 'play' => request('play'), 'minprice' => request('minprice'), 'maxprice' => request('maxprice'), 'keyword' => request('keyword')])); ?>" <?php echo request('orderby') == 'price' ? 'class="a"' : ''; ?>><span>价格</span></a>
                        <a href="<?php echo e(route('brand.farm.lists', ['orderby' => 'viewnum', 'group' => request('group'), 'play' => request('play'), 'minprice' => request('minprice'), 'maxprice' => request('maxprice'), 'keyword' => request('keyword')])); ?>" <?php echo request('orderby') == 'viewnum' ? 'class="a"' : ''; ?>><span>人气</span></a>
                        <a href="<?php echo e(route('brand.farm.lists', ['orderby' => 'addtime', 'group' => request('group'), 'play' => request('play'), 'minprice' => request('minprice'), 'maxprice' => request('maxprice'), 'keyword' => request('keyword')])); ?>" <?php echo request('orderby') == 'addtime' ? 'class="a"' : ''; ?>><span>入驻时间</span></a>
                    </dd>
                </dl>
            </div>
        </div>
        <?php if(count($farmlist)): ?>
                <div class="farm-interest mtm">
                    <ul class="cl">
                        <?php $__currentLoopData = $farmlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="trigger-hover">
                                <div class="f-pic"><a href="<?php echo e(route('brand.farm.show', $value->id)); ?>"><img src="<?php echo e(uploadImage($value->upimage)); ?>" width="285" height="200" /></a></div>
                                <div class="f-info">
                                    <div class="f-title"><a href="javascript:;"><b>[合肥]</b> <?php echo e($value->name); ?></a></div>
                                    <div class="f-address">地址：<?php echo e($value->address); ?></div>
                                    <div class="f-price">￥<span><?php echo e($value->price); ?></span>起</div>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php echo $farmlist->appends(['group' => request('group')])->appends(['play' => request('play')])->appends(['minprice' => request('minprice')])->appends(['maxprice' => request('maxprice')])->appends(['keyword' => request('keyword')])->appends(['orderby' => request('orderby')])->links(); ?>

        <?php else: ?>
            <div class="shop-nodata mtm">
                <p>暂无该农家乐的优惠信息！正在努力为您带来更多优惠！</p>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $(function(){
            $(document).on("click", ".filter-price", function(){
                var link = $(this).attr('rel');
                var minprice = $("#minprice").val();
                if(minprice){
                    link += link.indexOf('?') === -1 ? '?minprice=' + minprice : '&minprice=' + minprice;
                }
                var maxprice = $("#maxprice").val();
                if(maxprice){
                    link += link.indexOf('?') === -1 ? '?maxprice=' + maxprice : '&maxprice=' + maxprice;
                }
                window.location.href = link;
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>