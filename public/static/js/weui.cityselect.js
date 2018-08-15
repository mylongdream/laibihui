/*
 Ajax 三级省市联动

 settings 参数说明
 -----
 url:省市数据josn文件路径
 prov:默认省份
 city:默认城市
 dist:默认地区（县）
 nodata:无数据状态
 required:必选项
 ------------------------------ */
(function($){
    $.fn.citySelect=function(settings){
        if(this.length<1){return;}

        // 默认值
        settings=$.extend({
            url:"",
            prov:null,
            city:null,
            dist:null,
            street:null
        },settings);

        var box_obj=$(this);
        var prov_obj=box_obj.parent().find(".prov");
        var city_obj=box_obj.parent().find(".city");
        var dist_obj=box_obj.parent().find(".dist");
        var street_obj=box_obj.parent().find(".street");
        var box_val='';
        var prov_val='';
        var city_val='';
        var dist_val='';
        var street_val='';

        // 赋值省份函数
        var provStart=function(){
            var prov_id = parseInt(prov_obj.val());
            $.getJSON(settings.url,{type:'province'},function(json){
                var items = [];
                $.each(json,function(i,v){
                    items.push({label: v.name,value: v.id});
                });
                if(items.length === 0){
                    box_obj.val('');
                    prov_obj.val('');
                    city_obj.val('');
                    dist_obj.val('');
                    street_obj.val('');
                    return false;
                }
                weui.picker(items, {
                    id: 'prov_picker',
                    className: 'prov_picker',
                    defaultValue: [prov_id],
                    onConfirm: function(result){
                        box_val = result[0].label;
                        prov_val = result[0].value;
                        $('.prov_picker .weui-picker').on('animationend webkitAnimationEnd', function() {
                            cityStart();
                        });
                    }
                });
            });
        };

        // 赋值市级函数
        var cityStart=function(){
            var city_id = parseInt(city_obj.val());
            $.getJSON(settings.url,{type:'city', upid:prov_val},function(json){
                var items = [];
                $.each(json,function(i,v){
                    items.push({label: v.name,value: v.id});
                });
                if(items.length === 0){
                    box_obj.val(box_val);
                    prov_obj.val(prov_val);
                    city_obj.val('');
                    dist_obj.val('');
                    street_obj.val('');
                    return false;
                }
                weui.picker(items, {
                    id: 'city_picker',
                    className: 'city_picker',
                    defaultValue: [city_id],
                    onConfirm: function(result){
                        box_val = box_val+' '+result[0].label;
                        city_val = result[0].value;
                        $('.city_picker .weui-picker').on('animationend webkitAnimationEnd', function() {
                            distStart();
                        });
                    }
                });
            });
        };

        // 赋值地区（县）函数
        var distStart=function(){
            var dist_id = parseInt(dist_obj.val());
            $.getJSON(settings.url,{type:'area', upid:city_val},function(json){
                var items = [];
                $.each(json,function(i,v){
                    items.push({label: v.name,value: v.id});
                });
                if(items.length === 0){
                    box_obj.val(box_val);
                    prov_obj.val(prov_val);
                    city_obj.val(city_val);
                    dist_obj.val('');
                    street_obj.val('');
                    return false;
                }
                weui.picker(items, {
                    id: 'dist_picker',
                    className: 'dist_picker',
                    defaultValue: [dist_id],
                    onConfirm: function(result){
                        box_val = box_val+' '+result[0].label;
                        dist_val = result[0].value;
                        $('.dist_picker .weui-picker').on('animationend webkitAnimationEnd', function() {
                            streetStart();
                        });
                    }
                });
            });

        };

        // 赋值街道函数
        var streetStart=function(){
            var street_id = parseInt(street_obj.val());
            $.getJSON(settings.url,{type:'street', upid:dist_val},function(json){
                var items = [];
                $.each(json,function(i,v){
                    items.push({label: v.name,value: v.id});
                });
                if(items.length === 0){
                    box_obj.val(box_val);
                    prov_obj.val(prov_val);
                    city_obj.val(city_val);
                    dist_obj.val(dist_val);
                    street_obj.val('');
                    return false;
                }
                weui.picker(items, {
                    id: 'street_picker',
                    className: 'street_picker',
                    defaultValue: [street_id],
                    onConfirm: function(result){
                        box_val = box_val+' '+result[0].label;
                        street_val = result[0].value;
                        box_obj.val(box_val);
                        prov_obj.val(prov_val);
                        city_obj.val(city_val);
                        dist_obj.val(dist_val);
                        street_obj.val(street_val);
                    }
                });
            });
        };
        if(settings.url === ""){
            return false;
        }else{
            box_obj.click(function(){
                provStart();
            });
        }
    };
})(jQuery);