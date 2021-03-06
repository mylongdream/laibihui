@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">意见反馈</div>
                </div>
                <form class="ajaxform" name="myform" method="post" action="{{ route('mobile.user.feedback.store') }}">
                    {!! csrf_field() !!}
                    <div class="weui-cells__title">问题和意见</div>
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <textarea name="message" class="weui-textarea" placeholder="请填写10个字以上的问题描述以便我们提供更好的帮助" rows="3"></textarea>
                                <div class="weui-textarea-counter"><span>0</span>/200</div>
                            </div>
                        </div>
                    </div>
                    <div class="weui-cells weui-cells_form" id="uploader">
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <div class="weui-uploader">
                                    <div class="weui-uploader__hd">
                                        <p class="weui-uploader__title">图片（选填，提供问题截图）</p>
                                        <div class="weui-uploader__info"><span id="uploadCount">0</span>/5</div>
                                    </div>
                                    <div class="weui-uploader__bd">
                                        <ul class="weui-uploader__files" id="uploaderFiles"></ul>
                                        <div class="weui-uploader__input-box">
                                            <input id="uploaderInput" class="weui-uploader__input" type="file" accept="image/*" capture="camera" multiple="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="weui-cells__title">联系电话</div>
                    <div class="weui-cells">
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <input name="phone" class="weui-input" placeholder="选填，便于我们与你联系" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="weui-btn-area">
                        <button name="applybtn" type="button" class="weui-btn weui-btn_primary ajaxsubmit">提 交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var uploadCount = 0;
        weui.uploader('#uploader', {
            url: "{{ route('mobile.upload.image') }}",
            auto: true,
            type: 'file',
            fileVal: 'file',
            compress: {
                width: 1600,
                height: 1600,
                quality: .8
            },
            onBeforeQueued: function(files) {
                // `this` 是轮询到的文件, `files` 是所有文件

                if(["image/jpg", "image/jpeg", "image/png", "image/gif"].indexOf(this.type) < 0){
                    weui.alert('请上传图片');
                    return false; // 阻止文件添加
                }
                if(this.size > 10 * 1024 * 1024){
                    weui.alert('请上传不超过10M的图片');
                    return false;
                }
                if (files.length > 5) { // 防止一下子选择过多文件
                    weui.alert('最多只能上传5张图片，请重新选择');
                    return false;
                }
                if (uploadCount + 1 > 5) {
                    weui.alert('最多只能上传5张图片');
                    return false;
                }

                ++uploadCount;
                $('#uploadCount').html(uploadCount);
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
                $("#uploaderFiles li").each(function(){
                    if ($(this).attr("data-id") == uploadID) {
                        $(this).find('.weui-uploader__file-content').html(procent + '%');
                    }
                });
                console.log(this, procent);
                // return true; // 阻止默认行为，不使用默认的进度显示
            },
            onSuccess: function (ret) {
                var uploadID = this.id;
                $("#uploaderFiles li").each(function(){
                    if ($(this).attr("data-id") == uploadID) {
                        $(this).css("background-image","url(" + ret.url + ")");
                        $(this).append('<input name="image" value="' + ret.value + '" type="hidden">');
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
        $(document).on("click", "#uploaderFiles li", function(){
            var self = $(this);
            var url = $(this).css("backgroundImage").replace('url(','').replace(')','').replace(/\"/g, "");
            var gallery = weui.gallery(url, {
                className: 'custom-classname',
                onDelete: function(){
                    weui.confirm('确定删除该图片？', function(){
                        self.remove();
                        --uploadCount;
                        $('#uploadCount').html(uploadCount);
                        gallery.hide();
                    }, function(){
                        gallery.hide();
                    });
                }
            });
        });
    </script>
@endsection