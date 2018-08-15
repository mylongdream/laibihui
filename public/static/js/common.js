$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".cat_box").slide({
        type:"menu",
        titCell:".cat_item",
        targetCell:".cat_shop",
        delayTime:0,
        triggerTime:0,
        defaultPlay:false,
        returnDefault:true
    });
    $("#nv ul").slide({
        type:"menu",
        titCell:"li",
        targetCell:".sub",
        effect:"slideDown",
        titOnClassName:"on",
        delayTime:300,
        triggerTime:0,
        returnDefault:true
    });
    //聚焦
    $(document).on("mouseenter",".trigger-hover",function(){
        $(this).addClass("on");
    }).on('mouseleave',".trigger-hover",function(){
        $(this).removeClass("on");
    });
    //数量增减控制框
    $(document).on("click", ".choose-amount .cut_num", function(){
        var count = parseInt($(this).parent().find(".key_num").val(), 10) || 1;
        if(count - 1 < 1){
            count = 1;
            $(this).parent().find(".key_num").val(count);
        }else{
            count = count - 1;
            $(this).parent().find(".key_num").val(count).trigger("change");
        }
    }).on("click", ".choose-amount .add_num", function(){
        var count = parseInt($(this).parent().find(".key_num").val(), 10) || 1,
            total = parseInt($(this).parent().find(".key_num").attr("data-max"), 10) || 1;
        if(count + 1 > total){
            count = total;
            $(this).parent().find(".key_num").val(count);
        }else{
            count = count + 1;
            $(this).parent().find(".key_num").val(count).trigger("change");
        }
    }).on("keyup cut paste", ".choose-amount .key_num", function(){
        var self = $(this);
        var total = parseInt(self.attr("data-max"), 10) || 1;
        setTimeout(function() {
            var value = self.val().replace(/[^0-9]/g,'');
            value = parseInt(value, 10) || 1;
            value = value < 1 ? 1 : value;
            value = value > total ? total : value;
            self.val(value).trigger("change");
        }, 100);
    });
    //TAB切换
    $(".tb-tab").on("click", "li", function(){
        $(".tb-tab li").eq($(this).index()).addClass("on").siblings().removeClass("on");
        $(".tb-body").hide().eq($(this).index()).show();
    });
    //多选框全选
    $(document).on("click", ".checkall", function(){
        $(".ids").prop("checked", this.checked);
    }).on("click", ".ids", function(){
        $(".ids").each(function(){
            if(!this.checked){
                $(".checkall").prop("checked", false);
                return false;
            }else{
                $(".checkall").prop("checked", true);
            }
        });
    });
    //限制只能输入数字
    $(document).on("keyup paste", ".numeric", function(){
        var self = $(this);
        setTimeout(function() {
            self.val(self.val().replace(/[^0-9]/g,''));
        }, 100);
    });
    //限制只能输入大写字母和数字
    $(document).on("keyup paste", ".upper", function(){
        var self = $(this);
        setTimeout(function() {
            self.val(self.val().replace(/[^a-zA-Z0-9]/g,'').toUpperCase());
        }, 100);
    });
    //输完光标移到下个输入框
    $(document).on("keyup paste", ".skip", function(){
        var maxNum = 4;
        if(maxNum <= $(this).val().length){
            $(this).val(($(this).val().substr(0, maxNum)).toUpperCase());
            var next = $("input[tabindex=" + (parseInt($(this).attr("tabindex")) + 1) + "]");
            if(next){
                next.focus();
            }
        }
    });
    //刷新验证码
    $(document).on("click", ".verify-img", function(){
        if($(this).attr("src").indexOf('?') > 0){
            $(this).attr("src", $(this).attr("src") + '&random='+Math.random());
        }else{
            $(this).attr("src", $(this).attr("src").replace(/\?.*$/,'') + '?' + Math.random());
        }
    });
    //取消订单
    $(document).on("click", ".cancel-tip li", function(){
        if($(this).hasClass("on")){
            $(this).removeClass("on");
            $(".cancel-reason").val("");
        }else{
            $(".cancel-tip li").eq($(this).index()).addClass("on").siblings().removeClass("on");
            $(".cancel-reason").val($(this).text());
        }
    });
    $(document).on("click", ".openwindow", function(){
        var self = $(this);
        $.ajax({
            type: "GET",
            url: self.attr("href"),
            async:false
        }).success(function(data) {
            if(data.status == 0){
                $.jBox.error(data.info, '提示');
            }else{
                $.jBox(data,{title:self.attr("title"),width: 'auto',buttons: ''});
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
        return false;
    });
    $(document).on("click", ".ajaxget", function(){
        var self = $(this);
        if(self.hasClass('confirmbtn')){
            var submit = function (v, h, f) {
                if (v == 'ok') {
                    $.ajax({
                        type: "GET",
                        url: self.attr("href") || self.attr("data-url"),
                        async:false,
                        success: ajax_success,
                        error: ajax_error
                    });
                }
                return true; //close
            };
            var operation = self.attr("title") || '提交';
            $.jBox.confirm("确定要"+operation+"吗？", "提示", submit);
        }else {
            $.ajax({
                type: "GET",
                url: self.attr("href") || self.attr("data-url"),
                async:false,
                success: ajax_success,
                error: ajax_error
            });
        }
        return false;
    });
    $(document).on("click", ".ajaxpost", function(){
        var self = $(this);
        if(self.hasClass('confirmbtn')){
            var submit = function (v, h, f) {
                if (v == 'ok') {
                    $.ajax({
                        type: "POST",
                        url: self.attr("href") || self.attr("data-url"),
                        async:false,
                        success: ajax_success,
                        error: ajax_error
                    });
                }
                return true; //close
            };
            var operation = self.attr("title") || '提交';
            $.jBox.confirm("确定要"+operation+"吗？", "提示", submit);
        }else {
            $.ajax({
                type: "POST",
                url: self.attr("href") || self.attr("data-url"),
                async:false,
                success: ajax_success,
                error: ajax_error
            });
        }
        return false;
    });
    $(document).on("submit", ".ajaxform", function(){
        var self = $(this);
        $.ajax({
            type: self.attr("method"),
            url: self.attr("action"),
            data: self.serialize(),
            async:false,
            success: ajax_success,
            error: ajax_error
        });
        return false;
    });
    $(document).on("click", ".delbtn", function(){
        var self = $(this);
        var submit = function (v, h, f) {
            if (v == 'ok') {
                $.ajax({
                    type: "POST",
                    url: self.attr("href") || self.attr("data-url"),
                    data: {_method: 'DELETE'},
                    async:false,
                    success: ajax_success,
                    error: ajax_error
                });
            }
            return true; //close
        };
        var operation = self.attr("title") || '删除';
        $.jBox.confirm("确定要"+operation+"吗？", "提示", submit);
        return false;
    });
    function ajax_success(data){
        if(data.status == 0) {
            $.jBox.error(data.info, '提示');
            //刷新验证码
            $(".verify-img").trigger("click");
        }else if(data.status == 1){
            if (data.info) {
                $.jBox.tip(data.info + "，3秒后自动跳转……", 'success', {
                    closed: function () {
                        if (data.url) {
                            window.location.href = data.url;
                        } else {
                            location.reload();
                        }
                    }
                });
            } else {
                if (data.url) {
                    window.location.href = data.url;
                } else {
                    location.reload();
                }
            }
        } else {
            $.jBox(data,{title:"提示",width: 'auto',buttons: ''});
        }
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
