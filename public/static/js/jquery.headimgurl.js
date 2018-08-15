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

        // 默认值
        var defaults = {
            auto: true,
            swf: getBasePath() + 'Uploader.swf',
            server: "",
            formData: {},
            fileSizeLimit : 200 * 1024 * 1024, // 200 M
            fileSingleSizeLimit: 50 * 1024 * 1024 // 50 M
        };
        var settings = $.extend(defaults, options);
        var box_obj = this;

        var init = function(){
            var uploader = WebUploader.create({
                auto: settings.auto,
                swf: settings.swf,
                server: settings.server,
                formData: settings.formData,
                pick: box_obj,
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/*'
                },
                duplicate: true,
                fileSizeLimit: settings.fileSizeLimit,
                fileSingleSizeLimit: settings.fileSingleSizeLimit
            });
            uploader.on('fileQueued', function( file ) {
                //
            });
            uploader.on('uploadProgress', function( file, percentage ) {
                //
            });
            uploader.on('uploadError', function( file ) {
                //
            });
            uploader.on('uploadSuccess', function( file, response ) {
                box_obj.find('img').attr('src', response.url);
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
        init();
    };
})(jQuery);