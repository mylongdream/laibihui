<script type="text/javascript">
    var {{ $uploadid }} = WebUploader.create({
        auto: true,// 选完文件后，是否自动上传。
        swf: "{{ asset('static/js/webuploader/Uploader.swf') }}",// swf文件路径
        server: "{{ route('admin.upload.image') }}",// 文件接收服务端。
        formData: {
            _token : $('meta[name="csrf-token"]').attr('content')
        },
        pick: {
            id : '#{{ $uploadid }}',
            multiple: {{ $multiple }}
        },
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        }
    });
    {{ $uploadid }}.on( 'fileQueued', function( file ) {
        $("#{{ $uploadid }}").parent().find(".tdtip").text('正在等待上传');
    });
    {{ $uploadid }}.on('uploadProgress', function( file, percentage ) {
        $("#{{ $uploadid }}").parent().find(".tdtip").text('已上传'+ percentage * 100 + '%');
    });
    {{ $uploadid }}.on('uploadSuccess', function( file, response ) {
        var data = response;
        var li = '<li class="pic" id="' + file.id + '"><img src="' + data.url + '"><input name="{{ $inputname }}" value="' + data.id + '" type="hidden"></li>';
        $("#{{ $uploadid }}").parent().find('.upbox').append(li);
    });
    {{ $uploadid }}.on( 'uploadError', function( file ) {
        $("#{{ $uploadid }}").parent().find(".tdtip").text('上传出错');
    });
</script>