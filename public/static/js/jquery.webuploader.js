/*
 ------------------------------ */
(function($){
    $.fn.powerWebUpload = function(options){
        if(this.length<1){return;}

        var getBasePath = function(){
            var els = document.getElementsByTagName('script'), src;
            for (var i = 0, len = els.length; i < len; i++) {
                src = els[i].src || '';
                if (/webuploader[\w\-\.]*\.js/.test(src)) {
                    return src.substring(0, src.lastIndexOf('/') + 1);
                }
            }
            return '';
        };

        var box_obj = this;
        // 默认值
        var defaults = {
            auto: true,
            swf: getBasePath() + 'Uploader.swf',
            server: "",
            formData: {},
            deleteServer: "",
            hiddenInputId: "",
            fileNumLimit: 1,
            fileSizeLimit : 200 * 1024 * 1024, // 200 M
            fileSingleSizeLimit: 50 * 1024 * 1024, // 50 M
            width: 120,
            height: 120,
            uploadbox: function () {
                return box_obj.parent().parent().find('.uploadbox');
            }
        };
        var settings = $.extend(defaults, options);
        var tdtip = box_obj.parent().find(".tdtip");
        var tdtiphtml = tdtip.length > 0 ? tdtip.html() : '';
        var uploadbox = box_obj.parent().parent().find('.uploadbox');

        var init = function(){
            var fileNumLimit = 1;
            if(settings.fileNumLimit > 1){
                fileNumLimit = settings.fileNumLimit - $(uploadbox).find('li').length;
                if(fileNumLimit <= 0){
                    fileNumLimit = -1;
                }
            }
            if($(uploadbox).find('li').length){
                $(uploadbox).show();
            }else{
                $(uploadbox).hide();
            }
            var uploader = WebUploader.create({
                auto: settings.auto,
                swf: settings.swf,
                server: settings.server,
                formData: settings.formData,
                pick: {
                    id : box_obj,
                    multiple: settings.fileNumLimit > 1
                },
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/*'
                },
                duplicate: true,
                fileNumLimit: fileNumLimit,
                fileSizeLimit: settings.fileSizeLimit,
                fileSingleSizeLimit: settings.fileSingleSizeLimit
            });
            uploader.on('fileQueued', function( file ) {
                $(uploadbox).show();
                if(settings.fileNumLimit > 1){
                    var li = '<li class="trigger-hover" id="' + file.id + '"><div class="text" style="width:'+settings.width+'px;height:'+settings.height+'px;line-height:'+settings.height+'px;">正在等待上传</div></li>';
                    $(uploadbox).find('ul').append(li);
                }else{
                    if (!tdtip.length) {
                        tdtip = $('<span class="tdtip"></span>').insertAfter(box_obj);
                    }
                    tdtip.html('正在等待上传');
                }
            });
            uploader.on('uploadProgress', function( file, percentage ) {
                if(settings.fileNumLimit > 1){
                    $( '#'+file.id ).find('.text').html('已上传'+ percentage * 100 + '%');
                }else{
                    box_obj.parent().find(".tdtip").html('已上传'+ percentage * 100 + '%');
                }
            });
            uploader.on('uploadError', function( file ) {
                if(settings.fileNumLimit > 1){
                    $( '#'+file.id ).find('.text').html('上传出错');
                }else{
                    box_obj.parent().find(".tdtip").html('上传出错');
                }
            });
            uploader.on('uploadSuccess', function( file, response ) {
                var data = response;
                var uploadli = '';
                if(settings.fileNumLimit > 1){
                    uploadli = '<img src="' + data.url + '" width="'+settings.width+'" height="'+settings.height+'">';
                    if(settings.hiddenInputId){
                        uploadli += '<input name="' + settings.hiddenInputId + '" value="' + data.value + '" type="hidden">';
                    }
                    uploadli += '<div class="handle"><span class="setup">前移</span><span class="setdown">后移</span><span class="setdel">删除</span></div>';
                    $( '#'+file.id ).html(uploadli);
                }else{
                    box_obj.parent().find(".tdtip").html('上传成功');
                    uploadli = '<li class="trigger-hover" id="' + file.id + '"><img src="' + data.url + '" width="'+settings.width+'" height="'+settings.height+'">';
                    if(settings.hiddenInputId){
                        uploadli += '<input name="' + settings.hiddenInputId + '" value="' + data.value + '" type="hidden">';
                    }
                    uploadli += '<div class="handle"><span class="setdel">删除</span></div></li>';
                    $(uploadbox).find('ul').html(uploadli);
                    setTimeout(function () {
                        box_obj.parent().find(".tdtip").html(tdtiphtml);
                    }, 3000);
                }
            });
            uploader.on('error', function (code) {
                var err = '';
                switch (code) {
                    case 'F_EXCEED_SIZE':
                        err += '单张图片大小不得超过' +  Base.formatSize(uploader.option('fileSingleSizeLimit')) + '！';
                        break;
                    case 'Q_EXCEED_NUM_LIMIT':
                        err += '最多只能上传' +  settings.fileNumLimit + '张！';
                        break;
                    case 'Q_EXCEED_SIZE_LIMIT':
                        err += '上传图片总大小超出' +  Base.formatSize(uploader.option('fileSizeLimit')) + '！';
                        break;
                    case 'Q_TYPE_DENIED':
                        err += '无效图片类型，请上传正确的图片格式！';
                        break;
                    case 'F_DUPLICATE':
                        err += '请不要重复上传相同图片！';
                        break;
                    default:
                        err += '上传错误，请刷新重试！'+code;
                        break;
                }
                alert(err);
                return false;
            });
        };
        $(uploadbox).on("click", ".setup", function(){
            var onthis = $(this).parent().parent("li");
            var getup = $(this).parent().parent("li").prev();
            if(getup.length) {
                $(getup).before(onthis);
                onthis.trigger("mouseleave");
            }
        });
        $(uploadbox).on("click", ".setdown", function(){
            var onthis = $(this).parent().parent("li");
            var getdown = $(this).parent().parent("li").next();
            if(getdown.length) {
                $(getdown).after(onthis);
                onthis.trigger("mouseleave");
            }
        });
        $(uploadbox).on("click", ".setdel", function(){
            if(settings.deleteServer){
                var value = box_obj.parent().find("input").val();
                $.post(settings.deleteServer, {'value':value});
            }
            $(this).parent().parent('li').remove();
            init();
        });
        init();
    };
})(jQuery);