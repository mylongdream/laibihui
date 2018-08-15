
	<script type="text/javascript">
		var uploader_video = new plupload.Uploader({//创建实例的构造方法
			runtimes: 'html5,flash,silverlight,html4', //上传插件初始化选用那种方式的优先级顺序
			browse_button: "uploadbtn_video", // 上传按钮
			url: "{{ route('admin.upload.video') }}", //远程上传地址
			flash_swf_url: "{{ asset('static/js/plupload/Moxie.swf') }}", //flash文件地址
			silverlight_xap_url: "{{ asset('static/js/plupload/Moxie.xap') }}", //silverlight文件地址
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			filters: {
				prevent_duplicates : true, //不允许选取重复文件
				max_file_size: '2gb', //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）
				mime_types: [//允许文件上传类型
					{title: "Video files", extensions: "mp4,mpg,rmvb,avi,mkv"}
				]
			},
			multi_selection: false, //true:ctrl多文件上传, false 单文件上传
			init: {
                FilesAdded: function(up, files) { //文件上传前
                    var totalfile = 0;
                    var pluploadbox = '<div class="pluploadbox"><div class="main"><table>';
                    pluploadbox += '<tr><th>名称</th><th colspan="2">进度</th></tr>';
                    plupload.each(files, function(file) { //遍历文件
                        totalfile++;
                        pluploadbox += "<tr id='" + file['id'] + "'><td>" + file['name'] + "</td><td width='240'><div class='progress'><div class='bar'></div></div></td><td width='40'><div class='percent'>0%</div></td></tr>";
                    });
                    pluploadbox += '</table></div></div>';
                    if (totalfile > 30) {
                        $.jBox.error('上传的图片不能超过30张！', '提示');
                        uploader_video.destroy();
                    } else {
                        $.jBox.open(pluploadbox, '图片上传', 'auto', 'auto', { buttons: '' });
                        uploader_video.start();
                    }
                },
                UploadProgress: function(up, file) { //上传中，显示进度条
                    var percent = file.percent;
                    $("#" + file.id).find('.bar').css({"width": percent + "%"});
                    $("#" + file.id).find(".percent").text(percent + "%");
                },
				FileUploaded: function(up, file, info) { //文件上传成功的时候触发
                    var data = JSON.parse(info.response);
					$("#uploadipt_video").val(data.url);
				},
				UploadComplete: function(uploader,files) { //上传完成的时候触发
                    $.jBox.close();
					$.jBox.tip('视频上传成功', 'success');
				},
				Error: function(up, err) { //上传出错的时候触发
					$.jBox.tip(err.message, 'error');
				}
			}
		});
		uploader_video.init();
	</script>