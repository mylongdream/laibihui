/*
 ------------------------------ */
(function($){
    $.fn.register = function(options){
        if(this.length<1){return;}

        // 默认值
        var defaults = {
            checkUsernameUrl: "",
            checkMobileUrl: ""
        };
        var settings = $.extend(defaults, options);
        var box_obj = this;

        var checkUsername = function(){
            var username = $.trim($('input[name=username]').val());

        };

        var checkMobile = function(){
            var mobile = $.trim($('input[name=mobile]').val());

        };

        var init = function(){

        };
            init();
    };
})(jQuery);