//用户位置定位   使用geolocation定位
var mMap=function(){
    this.initMap = function(mapContainer, completFunc){
        if(typeof(AMap) === "object"){
            var map, geolocation;
            map = new AMap.Map(mapContainer, {
                resizeEnable: true
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
                    showCircle: true,        //定位成功后用圆圈表示定位精度范围，默认：true
                    panToLocation: true,     //定位成功后将定位到的位置作为地图中心点，默认：true
                    zoomToAccuracy:true      //定位成功后调整地图视野范围使定位位置及精度范围视野内可见，默认：false
                });
                map.addControl(geolocation);
                geolocation.getCurrentPosition();
                AMap.event.addListener(geolocation, 'complete', onComplete);//返回定位信息
                //AMap.event.addListener(geolocation, 'error', onError);      //返回定位出错信息
            });
            function onComplete(data){
                if(completFunc){
                    completFunc(data);
                }
            }
            function onError(data){
                var str = '定位失败,';
                str += '错误信息：';
                switch(data.info) {
                    case 'PERMISSION_DENIED':
                        str += '浏览器阻止了定位操作';
                        break;
                    case 'POSITION_UNAVAILBLE':
                        str += '无法获得当前位置';
                        break;
                    case 'TIMEOUT':
                        str += '定位超时';
                        break;
                    default:
                        str += '未知错误';
                        break;
                }
                alert(str);
            }
        }
    };
    return this;
}();
/*
 ------------------------------ */
(function($){
    $.fn.amap = function(options){
        if(this.length<1){return;}

        // 默认值
        var defaults = {
            title:"地图标注",
            AddressId: "",
            maplngId: "",
            maplatId: "",
            width: 800,
            height : 500
        };
        var settings = $.extend(defaults, options);
        var box_obj = this;

        var init = function(){
            var content = '<div class="amap_box"><div id="container"></div><div class="amap_search"><input type="text" placeholder="请输入关键字进行搜索" id="tipinput"></div></div>';
            $.jBox(content,{title:settings.title,width: settings.width,height: settings.height,buttons: ''});
            var map = new AMap.Map("container", {
                resizeEnable: true
            });
            map.plugin(["AMap.ToolBar"], function() {
                map.addControl(new AMap.ToolBar());
            });
            var clickEventListener = map.on('click', function(e) {
                $(settings.maplngId).val(e.lnglat.getLng());
                $(settings.maplatId).val(e.lnglat.getLat());
                $.jBox.close()
            });
            var auto = new AMap.Autocomplete({
                input: "tipinput"
            });
            AMap.event.addListener(auto, "select", select);
            function select(e) {
                if (e.poi && e.poi.location) {
                    map.setZoom(15);
                    map.setCenter(e.poi.location);
                }
            }
        };
        box_obj.click(function(){
            init();
        });
    };
})(jQuery);