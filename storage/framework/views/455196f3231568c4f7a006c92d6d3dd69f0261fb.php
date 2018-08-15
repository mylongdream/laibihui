<?php $__env->startSection('content'); ?>
            <div class="wp shop-map">
                    <?php if($shop->maplng && $shop->maplat): ?>
                            <div id="amapcontainer"></div>
                    <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <?php if($shop->maplng && $shop->maplat): ?>
        <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.4.3&key=da8ac8316273d87097ab56f3cb828a3d&plugin=AMap.Driving"></script>
        <script type="text/javascript">
            var map = new AMap.Map("amapcontainer", {
                resizeEnable: true,
                center: [<?php echo e($shop->maplng); ?>, <?php echo e($shop->maplat); ?>],//地图中心点
                zoom: 16 //地图显示的缩放级别
            });
            map.plugin(["AMap.ToolBar"], function() {
                map.addControl(new AMap.ToolBar());
            });
            new AMap.Marker({
                map: map,
                position: [<?php echo e($shop->maplng); ?>, <?php echo e($shop->maplat); ?>],
                icon: new AMap.Icon({
                    size: new AMap.Size(40, 50),  //图标大小
                    image: "<?php echo e(asset('static/image/common/way_btn.png')); ?>",
                    imageOffset: new AMap.Pixel(0, -60)
                })
            });
            map.plugin('AMap.Geolocation', function () {
                geolocation = new AMap.Geolocation({
                    enableHighAccuracy: true,//是否使用高精度定位，默认:true
                    timeout: 10000,          //超过10秒后停止定位，默认：无穷大
                    maximumAge: 0,           //定位结果缓存0毫秒，默认：0
                    convert: true,           //自动偏移坐标，偏移后的坐标为高德坐标，默认：true
                    showButton: true,        //显示定位按钮，默认：true
                    buttonPosition: 'LB',    //定位按钮停靠位置，默认：'LB'，左下角
                    buttonOffset: new AMap.Pixel(10, 20),//定位按钮与设置的停靠位置的偏移量，默认：Pixel(10, 20)
                    showMarker: true,        //定位成功后在定位到的位置显示点标记，默认：true
                    showCircle: false,        //定位成功后用圆圈表示定位精度范围，默认：true
                    panToLocation: true,     //定位成功后将定位到的位置作为地图中心点，默认：true
                    zoomToAccuracy:true      //定位成功后调整地图视野范围使定位位置及精度范围视野内可见，默认：false
                });
                map.addControl(geolocation);
                geolocation.getCurrentPosition();
                AMap.event.addListener(geolocation, 'complete', onComplete);//返回定位信息
            });
            function onComplete(data) {
                //构造路线导航类
                var driving = new AMap.Driving({
                    map: map
                });
                // 根据起终点经纬度规划驾车导航路线
                driving.search(new AMap.LngLat(data.position.getLng(), data.position.getLat()), new AMap.LngLat(<?php echo e($shop->maplng); ?>, <?php echo e($shop->maplat); ?>));
            }
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mobile.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>