$(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
    $(document).on("mouseenter",".trigger-hover",function(){
        $(this).addClass("hover");
    }).on('mouseleave',".trigger-hover",function(){
        $(this).removeClass("hover");
    });
    //tab切换
	$(document).on("click", ".tb-tab li", function(){
		$(".tb-tab li").eq($(this).index()).addClass("current").siblings().removeClass("current");
		$(".tb-body").hide().eq($(this).index()).show();
	});
	//单选框全选
	$(document).on("click", ".checkall", function(){
		$(".ids").prop("checked", this.checked); 
	}); 
	$(document).on("click", ".ids", function(){
		$(".ids").each(function(i){ 
			if(!this.checked){ 
				$(".checkall").prop("checked", false); 
				return false; 
			}else{ 
				$(".checkall").prop("checked", true); 
			} 
		}); 
	});
	//菜单展开
	$(document).on("click", ".menu_title", function(){
	    $(this).toggleClass("a");
        $(this).nextAll("dd").slideToggle();
	});
	//刷新验证码
	$(document).on("click", ".verify-img", function(){
		if($(this).attr("src").indexOf('?') > 0){
			$(this).attr("src", $(this).attr("src") + '&random='+Math.random());
		}else{
			$(this).attr("src", $(this).attr("src").replace(/\?.*$/,'') + '?' + Math.random());
		}
	});
	$(document).on("click", ".submitbtn", function(){ 
		var self = $(this);
        var operation = self.attr("title") || '删除';
		if($('#operate').val() != 'delsubmit' && $(this).attr('name') == 'delsubmit'){
			if($('.ids:checked').size() == 0) {
				$.jBox.error('请先选中所要'+operation+'的记录', '提示');
				return false;
			}
			var submit = function (v, h, f) {
				if (v == 'ok') {
					$('#operate').val(self.attr('name'));
					self.trigger("click");
				}
				return true; //close
			};
			$.jBox.confirm("确定要"+operation+"吗？", "提示", submit);
			return false;
		}
		$('#operate').val($(this).attr('name'));
	});
    $(document).on("submit", ".ajaxform", function(){
        var self = $(this);
        if(self.hasClass('confirmpwd')){
            var html = "<div style='padding:10px;'>输入密码：<input class='txt' type='password' id='confirmpwd' name='confirmpwd' /></div>";
            var submit = function (v, h, f) {
                if (f.confirmpwd === '') {
                    $.jBox.tip("请输入密码", 'error', { focusId: "confirmpwd" });
                    return false;
                }
                if (f.confirmpwd === 'zhihui') {
                    ajax_form(self);
                    return true;
                }else{
                    $.jBox.tip("输入密码错误", 'error', { focusId: "confirmpwd" });
                    return false;
                }
            };
            $.jBox(html, { title: "输入密码", submit: submit });
        }else {
            ajax_form(self);
        }
        return false;
    });
    $(document).on("click", ".ajaxbtn", function(){
        var self = $(this);
        $.ajax({
            type: "GET",
            url: self.attr("href"),
            async:false,
            success: ajax_success,
            error: ajax_error
        });
        return false;
    });
	$(document).on("click", ".delbtn", function(){ 
		var self = $(this);
        var operation = self.attr("title") || '删除';
        if(self.hasClass('confirmpwd')){
            var html = "<div style='padding:10px;'>输入密码：<input class='txt' type='password' id='confirmpwd' name='confirmpwd' /></div>";
            var submit = function (v, h, f) {
                if (f.confirmpwd === '') {
                    $.jBox.tip("请输入密码", 'error', { focusId: "confirmpwd" });
                    return false;
                }
                if (f.confirmpwd === 'zhihui') {
                    $.jBox.confirm("确定要"+operation+"吗？", "提示", function (v, h, f) {
                        if (v == 'ok') {
                            $.ajax({
                                type: "POST",
                                url: self.attr("href"),
                                data: {_method: 'DELETE'},
                                async:false,
                                success: ajax_success,
                                error: ajax_error
                            });
                        }
                        return true; //close
                    });
                    return true;
                }else{
                    $.jBox.tip("输入密码错误", 'error', { focusId: "confirmpwd" });
                    return false;
                }
            };
            $.jBox(html, { title: "输入密码", submit: submit });
        }else {
            $.jBox.confirm("确定要"+operation+"吗？", "提示", function (v, h, f) {
                if (v == 'ok') {
                    $.ajax({
                        type: "POST",
                        url: self.attr("href"),
                        data: {_method: 'DELETE'},
                        async:false,
                        success: ajax_success,
                        error: ajax_error
                    });
                }
                return true; //close
            });
        }
		return false;
	});
	$(document).on("click", ".restorebtn", function(){ 
		var self = $(this);
		var submit = function (v, h, f) {
			if (v == 'ok') {
                $.ajax({
                    type: "GET",
                    url: self.attr("href"),
                    async:false,
                    success: ajax_success,
                    error: ajax_error
                });
			}
			return true; //close
		};
		$.jBox.confirm("确定要恢复吗？", "提示", submit);
		return false;
	});
	$(document).on("click", ".openwindow", function(){ 
		var self = $(this);
        if(self.hasClass('confirmpwd')){
            var html = "<div style='padding:10px;'>输入密码：<input class='txt' type='password' id='confirmpwd' name='confirmpwd' /></div>";
            var submit = function (v, h, f) {
                if (f.confirmpwd === '') {
                    $.jBox.tip("请输入密码", 'error', { focusId: "confirmpwd" });
                    return false;
                }
                if (f.confirmpwd === 'zhihui') {
                    $.get(self.attr("href"),function(data){
                        if(data.status == 0){
                            $.jBox.error(data.info, '提示');
                        }else{
                            $.jBox(data,{title:self.attr("title"),width: 800,buttons: ''});
                        }
                    });
                    return true;
                }else{
                    $.jBox.tip("输入密码错误", 'error', { focusId: "confirmpwd" });
                    return false;
                }
            };
            $.jBox(html, { title: "输入密码", submit: submit });
        }else {
            $.ajax({
                type: "GET",
                url: self.attr("href"),
                async:false
            }).success(function(data) {
                if(data.status == 0){
                    $.jBox.error(data.info, '提示');
                }else{
                    $.jBox(data,{title:self.attr("title"),width: 800,buttons: ''});
                }
            }).error(function(data) {
                if (!data) {
                    return true;
                } else {
                    message = $.parseJSON(data.responseText);
                    $.each(message.errors, function (key, value) {
                        $.jBox.tip(value, 'error');
                        return false;
                    });
                    return false;
                }
            });
        }
		return false;
	});
    function ajax_form(form){
        var formdata = form.serialize();
        $.ajax({
            type: form.attr("method"),
            url: form.attr("action"),
            data: formdata,
            async:false
        }).success(function(data) {
            if(data.status == 1){
                if(data.step){
                    $.jBox.tip(data.info, 'loading');
                    window.setTimeout(function () {
                        form.attr("action", data.url);
                        ajax_form(form);
                    }, 1000);
                }else{
                    $.jBox.tip(data.info+"，3秒后自动跳转……",'success',{ closed: function () {
                        if(data.url){
                            window.location.href = data.url;
                        } else {
                            location.reload();
                        }
                    }});
                }
            } else if(data.status == 0){
                $.jBox.tip(data.info, 'error');
                //$.jBox.error(data.info, '提示');
                //刷新验证码
                $(".verify-img").trigger("click");
            }
        }).error(function(data) {
            ajax_error(data);
        });
        return false;
    }
    function ajax_success(data){
        if(data.status == 1){
            $.jBox.tip(data.info+"，3秒后自动跳转……",'success',{ closed: function () {
                if(data.url){
                    window.location.href = data.url;
                } else {
                    location.reload();
                }
            }});
        } else {
            $.jBox.tip(data.info, 'error');
            //$.jBox.error(data.info, '提示');
            //刷新验证码
            $(".verify-img").trigger("click");
        }
        return false;
    }
    function ajax_error(data){
        if (!data) {
            return true;
        } else {
            message = $.parseJSON(data.responseText);
            $.each(message.errors, function (key, value) {
                $.jBox.tip(value, 'error');
                //刷新验证码
                $(".verify-img").trigger("click");
                return false;
            });
            return false;
        }
    }
});
