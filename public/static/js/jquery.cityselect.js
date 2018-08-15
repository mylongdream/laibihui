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
		if(this.length<1){return;};

		// 默认值
		settings=$.extend({
			url:"",
			prov:null,
			city:null,
			dist:null,
			street:null,
			nodata:null,
			required:true
		},settings);

		var box_obj=this;
		var prov_obj=box_obj.find(".prov");
		var city_obj=box_obj.find(".city");
		var dist_obj=box_obj.find(".dist");
		var street_obj=box_obj.find(".street");
		var prov_val=settings.prov;
		var city_val=settings.city;
		var dist_val=settings.dist;
		var street_val=settings.street;
		var select_prehtml=(settings.required) ? "" : "<option value=''>请选择</option>";
		var prov_json;
		var city_json;
		var dist_json;
		var street_json;

		// 赋值市级函数
		var cityStart=function(){
			var prov_id=prov_obj.val();
			city_obj.empty().html(select_prehtml).attr("disabled",true);
			dist_obj.empty().html(select_prehtml).attr("disabled",true);
			street_obj.empty().html(select_prehtml).attr("disabled",true);

			if(prov_id < 0){
				if(settings.nodata=="none"){
					city_obj.css("display","none");
					dist_obj.css("display","none");
					street_obj.css("display","none");
				}else if(settings.nodata=="hidden"){
					city_obj.css("visibility","hidden");
					dist_obj.css("visibility","hidden");
					street_obj.css("visibility","hidden");
				};
				return;
			};

			$.getJSON(settings.url,{type:'city', upid:prov_id},function(json){
				city_json=json;
				// 遍历赋值市级下拉列表
				temp_html=select_prehtml;
				$.each(city_json,function(i,city){
					temp_html+="<option value='"+city.id+"'"+(city.id==city_val?" selected":"")+">"+city.name+"</option>";
				});
				city_obj.html(temp_html).attr("disabled",false).css({"display":"","visibility":""});
				distStart();
			});

		};

		// 赋值地区（县）函数
		var distStart=function(){
			var prov_id=prov_obj.val();
			var city_id=city_obj.val();
			dist_obj.empty().html(select_prehtml).attr("disabled",true);
			street_obj.empty().html(select_prehtml).attr("disabled",true);

			if(prov_id<0 || city_id<0){
				if(settings.nodata=="none"){
					dist_obj.css("display","none");
					street_obj.css("display","none");
				}else if(settings.nodata=="hidden"){
					dist_obj.css("visibility","hidden");
					street_obj.css("visibility","hidden");
				};
				return;
			};

			$.getJSON(settings.url,{type:'area', upid:city_id},function(json){
				dist_json=json;
				// 遍历赋值区级下拉列表
				temp_html=select_prehtml;
				$.each(dist_json,function(i,dist){
					temp_html+="<option value='"+dist.id+"'"+(dist.id==dist_val?" selected":"")+">"+dist.name+"</option>";
				});
				dist_obj.html(temp_html).attr("disabled",false).css({"display":"","visibility":""});
				streetStart();
			});
			
		};

		// 赋值街道函数
		var streetStart=function(){
			var prov_id=prov_obj.val();
			var city_id=city_obj.val();
			var dist_id=dist_obj.val();
			street_obj.empty().html(select_prehtml).attr("disabled",true);

			if(prov_id<0 || city_id<0 || dist_id<0){
				if(settings.nodata=="none"){
					street_obj.css("display","none");
				}else if(settings.nodata=="hidden"){
					street_obj.css("visibility","hidden");
				};
				return;
			};

			$.getJSON(settings.url,{type:'street', upid:dist_id},function(json){
				street_json=json;
				// 遍历赋值区级下拉列表
				temp_html=select_prehtml;
				$.each(street_json,function(i,street){
					temp_html+="<option value='"+street.id+"'"+(street.id==street_val?" selected":"")+">"+street.name+"</option>";
				});
				street_obj.html(temp_html).attr("disabled",false).css({"display":"","visibility":""});
			});
			
		};

		var init=function(){
			// 遍历赋值省份下拉列表
			temp_html=select_prehtml;
			$.each(prov_json,function(i,prov){
				temp_html+="<option value='"+prov.id+"'"+(prov.id==prov_val?" selected":"")+">"+prov.name+"</option>";
			});
			prov_obj.html(temp_html);
			city_obj.html(select_prehtml);
			dist_obj.html(select_prehtml);
			street_obj.html(select_prehtml);

			cityStart();

			// 选择省份时发生事件
			prov_obj.bind("change",function(){
				city_val="";
				dist_val="";
				street_val="";
				cityStart();
			});

			// 选择市级时发生事件
			city_obj.bind("change",function(){
				dist_val="";
				street_val="";
				distStart();
			});

			// 选择区级时发生事件
			dist_obj.bind("change",function(){
				street_val="";
				streetStart();
			});
		};

		var isExistOption=function(id,value){
			var isExist = false;  
			var count = $(id).find('option').length;     
			for(var i=0;i<count;i++) {     
				if($(id).get(0).options[i].value == value) {     
					isExist = true;     
					break;     
				}     
			}     
			return isExist;  
		};

		// 设置省市json数据
		if(settings.url!=null){
			$.getJSON(settings.url,{type:'province'},function(json){
				prov_json=json;
				init();
			});
		}else{
			return;
		};
	};
})(jQuery);