$(function() {
    FastClick.attach(document.body);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //禁止手机自带键盘弹出
    $(document).on("focus", ".hidekeyboard", function(){
        document.activeElement.blur();
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
    //文本域字数限制
    $(document).on("keyup cut paste", ".weui-textarea", function(){
        var self = $(this);
        var counter = $(".weui-textarea-counter").text();
        var total = parseInt(counter.substr(counter.indexOf('/') + 1)	, 10) || 100;
        var length = parseInt(self.val().length, 10) || 0;
        setTimeout(function() {
            if(length > total){
                self.val(self.val().substr(0, total));
                length = total;
            }
            $(".weui-textarea-counter span").text(length);
        }, 100);
    });
    //限制只能输入数字
    $(document).on("keyup paste", ".numeric", function(){
        var self = $(this);
        setTimeout(function() {
            self.val(self.val().replace(/[^0-9]/g,''));
        }, 100);
    });
    //刷新验证码
    $(document).on("click", ".verify-img", function(){
        if($(this).attr("src").indexOf('?') > 0){
            $(this).attr("src", $(this).attr("src") + '&random='+Math.random());
        }else{
            $(this).attr("src", $(this).attr("src").replace(/\?.*$/,'') + '?' + Math.random());
        }
    });
    //覆盖式的弹出层
    $(document).on("click", ".open-popup", function(){
        var self = $(this);
        if(self.data("url")){
            var loading = weui.loading('loading');
            $.ajax({
                type:'GET',
                url:self.data("url"),
                data:self.closest("form").serialize(),
                async:false
            }).success(function(data) {
                loading.hide();
                if($(self.data("target")).length > 0){
                    $(self.data("target")).html(data).data('remove', 'true').fadeIn();
                }else{
                    $('<div>').addClass('popup-container').data('remove', 'true').html(data).appendTo('body').fadeIn();
                }
                $(self.data("target")).find(".back a").addClass("close-popup");
            }).error(function(data) {
                loading.hide();
                if (!data) {
                    return true;
                } else {
                    message = $.parseJSON(data.responseText);
                    $.each(message.errors, function (key, value) {
                        weui.alert(value, {
                            isAndroid: false
                        });
                        return false;
                    });
                    return false;
                }
            });
        }else{
            $(self.data("target")).show();
        }
    }).on("click", ".close-popup", function(){
        var self = $(this);
        if(self.data("target")){
            $(self.data("target")).fadeOut();
            if($(self.data("target")).data("remove")){
                $(self.data("target")).remove();
            }
        }else{
            $('.popup-container').each(function() {
                $(this).fadeOut();
                if($(this).data("remove")){
                    $(this).remove();
                }
            });
        }
        return false;
    });
    //删除按钮
    $(document).on("click", ".delbtn", function(){
        var self = $(this);
        var operation = self.attr("title") || '删除';
        var loading = weui.loading('loading');
        weui.confirm('确定要'+operation+'吗？', function(){
            $.ajax({
                type: "POST",
                url: self.attr("href") || self.attr("data-url"),
                data: {_method: 'DELETE'},
                async:false
            }).success(function(data) {
                loading.hide();
                if(data.status == 1){
                    if (data.info) {
                        weui.toast(data.info, {
                            duration: 3000,
                            className: 'toast-success',
                            callback: function(){
                                if(data.url){
                                    window.location.href = data.url;
                                } else {
                                    window.location.reload();
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
                    weui.alert(data.info, {
                        isAndroid: false
                    });
                }
            }).error(function() {
                loading.hide();
                if (!data) {
                    return true;
                } else {
                    message = $.parseJSON(data.responseText);
                    $.each(message.errors, function (key, value) {
                        weui.alert(value, {
                            isAndroid: false
                        });
                        return false;
                    });
                    return false;
                }
            });
        },{isAndroid: false});
        return false;
    });
    $(document).on("click", ".ajaxbutton", function(){
        var self = $(this);
        var loading = weui.loading('loading');
        if(self.hasClass('confirmbtn')){
            var operation = self.attr("title") || '删除';
            weui.confirm('确定要'+operation+'吗？', function(){
                $.ajax({
                    type:'GET',
                    url:self.attr("href") || self.attr("data-url"),
                    async:false
                }).success(function(data) {
                    loading.hide();
                    if(data.status == 1){
                        if (data.info) {
                            weui.toast(data.info, {
                                duration: 3000,
                                className: 'toast-success',
                                callback: function(){
                                    if(data.url){
                                        window.location.href = data.url;
                                    } else {
                                        window.location.reload();
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
                        weui.alert(data.info, {
                            isAndroid: false
                        });
                    }
                }).error(function() {
                    loading.hide();
                    if (!data) {
                        return true;
                    } else {
                        message = $.parseJSON(data.responseText);
                        $.each(message.errors, function (key, value) {
                            weui.alert(value, {
                                isAndroid: false
                            });
                            return false;
                        });
                        return false;
                    }
                });
            },{isAndroid: false});
        }else {
            $.ajax({
                type:'GET',
                url:self.attr("href") || self.attr("data-url"),
                async:false
            }).success(function(data) {
                loading.hide();
                if(data.status == 1){
                    if (data.info) {
                        weui.toast(data.info, {
                            duration: 3000,
                            className: 'toast-success',
                            callback: function(){
                                if(data.url){
                                    window.location.href = data.url;
                                } else {
                                    window.location.reload();
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
                    weui.alert(data.info, {
                        isAndroid: false
                    });
                }
            }).error(function() {
                loading.hide();
                if (!data) {
                    return true;
                } else {
                    message = $.parseJSON(data.responseText);
                    $.each(message.errors, function (key, value) {
                        weui.alert(value, {
                            isAndroid: false
                        });
                        return false;
                    });
                    return false;
                }
            });
        }
        return false;
    });
    var regexp = {
        regexp: {
            IDNUM: /(?:^\d{15}$)|(?:^\d{18}$)|^\d{17}[\dXx]$/,
            VCODE: /^.{4}$/
        }
    };
    $(document).on("click", ".ajaxsubmit1", function(){
        var self = $(this.form);
        var loading = weui.loading('loading');
        weui.form.validate(self, function (error) {
            if (!error) {
                $.ajax({
                    type:self.attr("method"),
                    url:self.attr('action'),
                    data:self.serialize(),
                    success: function(data) {
                        loading.hide();
                        if(data.status == 1){
                            if(self.find(".ajaxtip-success__content").length > 0) data.info = self.find(".ajaxtip-success__content").html();
                            if (data.info) {
                                weui.toast(data.info, {
                                    duration: 3000,
                                    className: 'toast-success',
                                    callback: function(){
                                        if(data.url){
                                            window.location.href = data.url;
                                        } else {
                                            window.location.reload();
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
                            if(self.find(".ajaxtip-error__content").length > 0) data.info = self.find(".ajaxtip-error__content").html();
                            weui.topTips(data.info);
                        }
                    },
                    error: function(data) {
                        loading.hide();
                        if (!data) {
                            return true;
                        } else {
                            message = $.parseJSON(data.responseText);
                            $.each(message.errors, function (key, value) {
                                weui.alert(value, {
                                    isAndroid: false
                                });
                                $(".verify-img").trigger("click");
                                return false;
                            });
                            return false;
                        }
                    }
                });
            }
        }, regexp);
    });
    $(document).on("click", ".ajaxsubmit2", function(){
        var self = $(this.form);
        var loading = weui.loading('loading');
        weui.form.validate(self, function (error) {
            if (!error) {
                $.ajax({
                    type:self.attr("method"),
                    url:self.attr('action'),
                    data:self.serialize(),
                    success: function(data) {
                        loading.hide();
                        if(data.status == 1){
                            if(self.find(".ajaxtip-success__content").length > 0) data.info = self.find(".ajaxtip-success__content").html();
                            if (data.info) {
                                if(self.find(".ajaxtip-success__title").length > 0){
                                    weui.alert(data.info, function(){
                                        if(data.url){
                                            window.location.href = data.url;
                                        } else {
                                            window.location.reload();
                                        }
                                    }, {
                                        title: self.find(".ajaxtip-success__title").html(),
                                        isAndroid: false
                                    });
                                } else {
                                    weui.alert(data.info, function(){
                                        if(data.url){
                                            window.location.href = data.url;
                                        } else {
                                            window.location.reload();
                                        }
                                    }, {
                                        isAndroid: false
                                    });
                                }
                            } else {
                                if (data.url) {
                                    window.location.href = data.url;
                                } else {
                                    location.reload();
                                }
                            }
                        } else {
                            if(self.find(".ajaxtip-error__content").length > 0) data.info = self.find(".ajaxtip-error__content").html();
                            weui.toast(data.info, {duration: 3000, className: 'toast-error'});
                        }
                    },
                    error: function(data) {
                        loading.hide();
                        if (!data) {
                            return true;
                        } else {
                            message = $.parseJSON(data.responseText);
                            $.each(message.errors, function (key, value) {
                                weui.toast(value, {duration: 3000, className: 'toast-error'});
                                $(".verify-img").trigger("click");
                                return false;
                            });
                            return false;
                        }
                    }
                });
            }else{
                var $ele = $(error.ele),
                    msg = error.msg,
                    tips = $ele.attr(msg + 'Tips') || $ele.attr('tips') || $ele.attr('placeholder');
                if (tips) weui.toast(tips, {duration: 3000, className: 'toast-error'});
            }
            return true;
        }, regexp);
    });
    $(document).on("click", ".ajaxsubmit", function(){
        var self = $(this.form);
        var loading = weui.loading('loading');
        weui.form.validate(self, function (error) {
            if (!error) {
                $.ajax({
                    type:self.attr("method"),
                    url:self.attr('action'),
                    data:self.serialize(),
                    success: function(data) {
                        loading.hide();
                        if(data.status == 1){
                            if(self.find(".ajaxtip-success__content").length > 0) data.info = self.find(".ajaxtip-success__content").html();
                            if (data.info) {
                                weui.toast(data.info, {
                                    duration: 3000,
                                    className: 'toast-success',
                                    callback: function(){
                                        if(data.url){
                                            window.location.href = data.url;
                                        } else {
                                            window.location.reload();
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
                            if(self.find(".ajaxtip-error__content").length > 0) data.info = self.find(".ajaxtip-error__content").html();
                            weui.alert(data.info, {
                                isAndroid: false
                            });
                        }
                    },
                    error: function(data) {
                        loading.hide();
                        if (!data) {
                            return true;
                        } else {
                            message = $.parseJSON(data.responseText);
                            $.each(message.errors, function (key, value) {
                                weui.alert(value, {
                                    isAndroid: false
                                });
                                $(".verify-img").trigger("click");
                                return false;
                            });
                            return false;
                        }
                    }
                });
            }else{
                var $ele = $(error.ele),
                    msg = error.msg,
                    tips = $ele.attr(msg + 'Tips') || $ele.attr('tips') || $ele.attr('placeholder');
                if (tips) weui.alert(tips, {
                    isAndroid: false
                });
            }
            return true;
        }, regexp);
    });
    $(document).on("click", ".selectBox button", function(){
        var self = $(this);
        var pickerlist = [];
        self.parents(".selectBox").find("li").each(function(){
            pickerlist.push({label: $(this).text(),value: $(this).text()});
        });
        weui.picker(pickerlist, {
            onConfirm: function (result) {
                self.parents(".selectBox").find("input").val(result);
            }
        });
    });
    $(document).on("click", ".operateBox", function(){
        var self = $(this);
        var menulist = [];
        self.find("li").each(function(){
            var href = $(this).find("a").attr("href");
            if(href.length == 0 || href.indexOf("javascript") > -1){
                return true;
            }else if (href.indexOf("?") > -1){
                href = href + "&rnd=" + Math.random();
            }else{
                href = href + "?rnd=" + Math.random();
            }
            menulist.push({label: $(this).text(),onClick: function () {window.location.href = href;}});
        });
        weui.actionSheet(menulist);
    });
    $(document).on("click", ".monthPicker", function(){
        var self = $(this);
        var defaultValue = [];
        if(self.val()!=''){
            var mydate = new Date(self.val());
            defaultValue.push(mydate.getFullYear());
            defaultValue.push(mydate.getMonth()+1);
        }
        var yearlist = [];
        for(i=1900;i<=2100;i++){
            yearlist.push({label: i,value: i});
        }
        var monthlist = [];
        for(i=1;i<=12;i++){
            monthlist.push({label: i,value: i});
        }
        weui.picker(yearlist, monthlist, {
            id: 'month_picker',
            defaultValue: defaultValue,
            onConfirm: function(result){
                self.val(result[0]+'-'+result[1]);
            }
        });
    });
    $(document).on("click", ".datePicker", function(){
        var self = $(this);
        var defaultValue = [];
        if(self.val()!=''){
            var mydate = new Date(self.val());
            defaultValue.push(mydate.getFullYear());
            defaultValue.push(mydate.getMonth()+1);
            defaultValue.push(mydate.getDate());
        }
        var start = self.attr('data-start') || 1900;
        var end = self.attr('data-end') || 2100;
        weui.datePicker({
            id: 'date_picker',
            start: start,
            end: end,
            defaultValue: defaultValue,
            onConfirm: function(result){
                self.val(result[0]+'-'+result[1]+'-'+result[2]);
            }
        });
    });
    $(document).on("click", ".timePicker", function(){
        var self = $(this);
        var defaultValue = [];
        if(self.val()!=''){
            var mydate = new Date(self.val());
            defaultValue.push(mydate.getFullYear());
            defaultValue.push(mydate.getMonth()+1);
            defaultValue.push(mydate.getDate());
        }
        var start = self.attr('data-start') || 1900;
        var end = self.attr('data-end') || 2100;
        weui.datePicker({
            id: 'm_date_picker',
            className: 'm_date_picker',
            start: start,
            end: end,
            defaultValue: defaultValue,
            onConfirm: function(result){
                $('.m_date_picker .weui-picker').on('animationend webkitAnimationEnd', function() {
                    var data = result[0]+'-'+result[1]+'-'+result[2];
                    var hourlist = [];
                    for(i=0;i<24;i++){
                        hourlist.push({label: i+'时',value: i});
                    }
                    var minutelist = [];
                    for(i=0;i<60;i++){
                        minutelist.push({label: i+'分',value: i});
                    }
                    weui.picker(hourlist, minutelist, {
                        id: 'm_time_picker',
                        onConfirm: function(result){
                            self.val(data+' '+result[0]+':'+result[1]);
                        }
                    });
                });
            }
        });
    });


});
