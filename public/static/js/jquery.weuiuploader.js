/*
 ------------------------------ */
(function($){
    $.fn.WeuiUpload = function(options){
        if(this.length<1){return;}

        var box_obj = this;
        // 默认值
        var defaults = {
            auto: true,
            url: "",
            limitnum: 1,
            formData: {},
            deleteServer: "",
            hiddenInputId: ""
        };
        var settings = $.extend(defaults, options);
        weui.uploader(box_obj, {
            url: settings.url,
            auto: settings.auto,
            type: 'file',
            fileVal: 'file',
            onBeforeQueued: function(files) {
                // `this` 是轮询到的文件, `files` 是所有文件
                var uploadCount = parseInt(box_obj.find('.weui-uploader__count').text(), 10) || 0;
                settings.limitnum = parseInt(box_obj.find('.weui-uploader__limitnum').text(), 10) || 1;
                if(["image/jpg", "image/jpeg", "image/png", "image/gif"].indexOf(this.type) < 0){
                    weui.alert('请上传图片');
                    return false; // 阻止文件添加
                }
                if(this.size > 10 * 1024 * 1024){
                    weui.alert('请上传不超过10M的图片');
                    return false;
                }
                if (files.length > settings.limitnum) { // 防止一下子选择过多文件
                    weui.alert('最多只能上传'+settings.limitnum+'张图片，请重新选择');
                    return false;
                }
                if (uploadCount + 1 > settings.limitnum) {
                    weui.alert('最多只能上传'+settings.limitnum+'张图片');
                    return false;
                }

                box_obj.find('.weui-uploader__count').html(++uploadCount);
                console.log(this);
                // return true; // 阻止默认行为，不插入预览图的框架
            },
            onQueued: function(){
                console.log(this);

                // console.log(this.status); // 文件的状态：'ready', 'progress', 'success', 'fail'
                // console.log(this.base64); // 如果是base64上传，file.base64可以获得文件的base64

                //this.upload(); // 如果是手动上传，这里可以通过调用upload来实现；也可以用它来实现重传。
                // this.stop(); // 中断上传

                // return true; // 阻止默认行为，不显示预览图的图像
            },
            onBeforeSend: function(data, headers){
                console.log(this, data, headers);
                $.extend(data, { _token : $('meta[name="csrf-token"]').attr('content') }); // 可以扩展此对象来控制上传参数
                // $.extend(headers, { Origin: 'http://127.0.0.1' }); // 可以扩展此对象来控制上传头部

                // return false; // 阻止文件上传
            },
            onProgress: function(procent){
                var uploadID = this.id;
                box_obj.find(".weui-uploader__files li").each(function(){
                    if ($(this).attr("data-id") == uploadID) {
                        $(this).find('.weui-uploader__file-content').html(procent + '%');
                    }
                });
                console.log(this, procent);
                // return true; // 阻止默认行为，不使用默认的进度显示
            },
            onSuccess: function (ret) {
                var uploadID = this.id;
                box_obj.find(".weui-uploader__files li").each(function(){
                    if ($(this).attr("data-id") == uploadID) {
                        $(this).css("background-image","url(" + ret.url + ")");
                        $(this).append('<input name="' + settings.hiddenInputId + '" value="' + ret.value + '" type="hidden">');
                        //alert($(this).attr("data-fid"));
                    }
                });
                console.log(this, ret);
                // return true; // 阻止默认行为，不使用默认的成功态
            },
            onError: function(err){
                console.log(this, err);
                // return true; // 阻止默认行为，不使用默认的失败态
            }
        });
        $(document).on("click", ".weui-uploader__files li", function(){
            var self = $(this);
            var url = $(this).css("backgroundImage").replace('url(','').replace(')','').replace(/\"/g, "");
            var gallery = weui.gallery(url, {
                className: 'custom-classname',
                onDelete: function(){
                    weui.confirm('确定删除该图片？', function(){
                        self.remove();
                        var uploadCount = parseInt(self.parents('.weui-uploader').find('.weui-uploader__count').text(), 10) || 0;
                        self.parents('.weui-uploader').find('.weui-uploader__count').html(--uploadCount);
                        gallery.hide();
                    }, function(){
                        gallery.hide();
                    });
                }
            });
        });
    };
})(jQuery);