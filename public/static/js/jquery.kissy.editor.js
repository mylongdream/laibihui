/*
 ------------------------------ */
(function($){
    $.fn.KissyEditor = function(options){
        if(this.length<1){return;}
        var box_obj = this;

        KISSY.use("editor,editor/theme/cool/base.css,editor/theme/cool/editor-min.css", function (S, Editor) {
            var cfg ={
                fromTextarea:'#'+box_obj.attr('id'),
                focused: true,
                attachForm: true,
                baseZIndex: 10000,
                height: "350px"
            };

            var plugins = ("source-area" +
            ",separator" +
            ",font-family" +
            ",font-size" +
            ",bold" +
            ",italic" +
            ",strike-through" +
            ",underline" +
            ",separator" +
            ",fore-color" +
            ",back-color" +
            ",draft" +
            ",undo" +
            ",indent" +
            ",outdent" +
            ",unordered-list" +
            ",ordered-list" +
            ",remove-format" +
            ",justify-left" +
            ",justify-center" +
            ",justify-right" +
            ",link" +
            ",image" +
            ",table" +
            ",flash" +
            ",video" +
            ",maximize" +
            ",drag-upload").split(",");

            var fullPlugins = [];

            S.each(plugins, function (p, i) {
                fullPlugins[i] = "editor/plugin/" + p;
            });

            var pluginConfig = {
                "link": {
                    target: "_blank"
                },
                "image": {
                    defaultMargin: 0,
                    //remote:false,
                    upload: {
                        serverUrl: options.serverUrl,
                        serverParams: options.serverParams,
                        suffix: "png,jpg,jpeg,gif,bmp",
                        fileInput: "imgFile",
                        sizeLimit: 1000
                    }
                },
                "flash": {
                    "defaultWidth": "300",
                    "defaultHeight": "300"
                },
                "video": {
                    urlCfg: [
                        {
                            reg: /tudou\.com/i,
                            url: "http://bangpai.taobao.com/json/getTudouVideo.htm",
                            paramName: "url"
                        }
                    ],
                    "urlTip": "请输入优酷网、土豆网、酷7网的视频播放页链接...",
                    "providers": [
                        {
                            // 允许白名单
                            reg: /taohua\.com/i,
                            //默认高宽
                            width: 480,
                            height: 400,
                            detect: function (url) {
                                return url;
                            }
                        },
                        {
                            reg: /youku\.com/i,
                            width: 480,
                            height: 400,
                            detect: function (url) {
                                var m = url.match(/id_([^.]+)\.html(\?[^?]+)?$/);
                                if (m) {
                                    return "http://player.youku.com/player.php/sid/" + m[1] + "/v.swf";
                                }
                                m = url.match(/v_playlist\/([^.]+)\.html$/);
                                if (m) {
                                    return;
                                    //return "http://player.youku.com/player.php/sid/" + m[1] + "/v.swf";
                                }
                                return url;
                            }
                        },
                        {
                            reg: /tudou\.com/i,
                            width: 480,
                            height: 400,
                            detect: function (url) {
                                return url;
                            }
                        },
                        {
                            reg: /ku6\.com/i,
                            width: 480,
                            height: 400,
                            detect: function (url) {
                                var m = url.match(/show[^\/]*\/([^\/]+)\.html(\?[^?]+)?$/);
                                if (m) {
                                    return "http://player.ku6.com/refer/" + m[1] + "/v.swf";
                                }
                                return url;
                            }
                        }/*,
                         {
                         reg:/taobaocdn\.com/i,
                         width:480,
                         height:400,
                         detect:function(url) {
                         return url;
                         }
                         }*/
                    ]
                },
                "draft": {
                    // 当前编辑器的历史是否要单独保存到一个键值而不是公用
                    // saveKey:"xxx",
                    interval: 5,
                    limit: 10,
                    "helpHtml": "<div " +
                    "style='width:200px;'>" +
                    "<div style='padding:5px;'>草稿箱能够自动保存您最新编辑的内容，" +
                    "如果发现内容丢失，" +
                    "请选择恢复编辑历史</div></div>"
                },
                "drag-upload": {
                    suffix: "png,jpg,jpeg,gif",
                    fileInput: "imgFile",
                    sizeLimit: 1000,
                    serverUrl: options.serverUrl,
                    serverParams: options.serverParams
                }
            };

            KISSY.use(fullPlugins, function (S) {
                var args = S.makeArray(arguments);

                args.shift();

                S.each(args, function (arg, i) {
                    var argStr = plugins[i], cfg;
                    if (cfg = pluginConfig[argStr]) {
                        args[i] = new arg(cfg);
                    }
                });

                cfg.plugins = args;
                var editor;
                if (cfg.fromTextarea) {
                    editor = Editor.decorate(cfg.fromTextarea, cfg);
                } else {
                    editor = new Editor(cfg);
                    editor.render();
                }
            });

        });
    };
})(jQuery);