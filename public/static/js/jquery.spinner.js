/*
 ------------------------------ */
(function($){
    $.fn.spinner = function(options){
        if(this.length<1){return;}

        // 默认值
        var defaults = {
            value: 1,
            min: 1,
            max: 1,
            step: 1,
            change: function () {}
        };
        var settings = $.extend(defaults, options);
		var keyCodes = {up:38, down:40}

		return this.each(function() {


			
		});
    };
})(jQuery);