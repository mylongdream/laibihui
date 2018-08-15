<?php $__env->startSection('content'); ?>
        <div class="weui-search-bar weui-search-bar_focusing">
            <form class="weui-search-bar__form" action="<?php echo e(route('mobile.brand.farm.lists')); ?>">
                <div class="weui-search-bar__box">
                    <i class="weui-icon-search"></i>
                    <input type="search" class="weui-search-bar__input" name="keyword" placeholder="输入农家乐名称、地点" autofocus="autofocus">
                </div>
            </form>
            <a href="javascript:" class="weui-search-bar__cancel-btn close-popup" data-target="#searchBar">取消</a>
        </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $(function() {
            $(".weui-search-bar__input").trigger( "focus" );
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>