/*
 ------------------------------ */
(function($){
    $.fn.sms = function(options){
        if(this.length<1){return;}

        // 默认值
        var defaults = {
            mobilerule: 'required',
            requestUrl: "",
            voice : false,
            calltip: function (data) {
                alert(data);
            },
            callerror: function (data) {
                alert(data);
            }
        };
        var settings = $.extend(defaults, options);
        var box_obj = this;
        var btnContent = box_obj.html();

        var timer = function(seconds){
            if (seconds >= 0) {
                setTimeout(function() {
                    box_obj.html(seconds+'秒后重发');
                    seconds -= 1;
                    timer(seconds);
                }, 1000);
            } else {
                //box_obj.html(btnContent);
                box_obj.html("重新发送");
                box_obj.removeClass("gray");
                box_obj.prop('disabled', false);
            }
        };

        var send = function(){
            var mobile = $.trim($('input[name=mobile]').val());
            if(mobile == ''){
                settings.callerror('手机号不能为空。');
                return false;
            }
            if(mobile.length != 11){
                settings.callerror('手机号格式不正确。');
                return false;
            }
            box_obj.html('短信发送中');
            box_obj.addClass("gray");
            box_obj.prop('disabled', true);
            $.ajax({
                url  : settings.requestUrl,
                type : 'post',
                data : box_obj.closest("form").serialize(),
                success : function (data) {
                    if(data.status == 1){
                        if(data.info){
                            settings.calltip(data.info);
                        }
                        timer(data.seconds);
                    } else {
                        box_obj.html(btnContent);
                        box_obj.removeClass("gray");
                        box_obj.prop('disabled', false);
                        settings.callerror(data.info);
                    }
                },
                error: function(data){
                    box_obj.html(btnContent);
                    box_obj.removeClass("gray");
                    box_obj.prop('disabled', false);
                    if (!data) {
                        return false;
                    } else {
                        message = $.parseJSON(data.responseText);
                        $.each(message.errors, function (key, value) {
                            settings.callerror(value);
                            return false;
                        });
                        return false;
                    }
                }
            });
        };
        box_obj.click(function(){
            send();
        });
    };
})(jQuery);