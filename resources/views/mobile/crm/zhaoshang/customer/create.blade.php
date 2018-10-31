@extends('layouts.mobile.app')

@section('content')
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav">新增商户</div>
				</div>
				<form class="ajaxform" name="myform" method="post" action="{{ route('mobile.crm.zhaoshang.customer.store') }}">
					{!! csrf_field() !!}
					<div class="weui-cells weui-cells_form">
						<div class="weui-cell weui-cell_select weui-cell_select-after">
							<div class="weui-cell__hd">
								<label for="" class="weui-label">经营类目</label>
							</div>
							<div class="weui-cell__bd">
								<select class="weui-select" name="catid">
									<option value="">请选择</option>
									@foreach ($categorylist as $scategory)
										<option value="{{ $scategory->id }}">{{ str_repeat('->',$scategory->count-1) }}{{ $scategory->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label">商户名称</label>
							</div>
							<div class="weui-cell__bd">
								<input class="weui-input" type="text" placeholder="请输入商户名称" name="name">
							</div>
						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label">商户地址</label>
							</div>
							<div class="weui-cell__bd">
								<input class="weui-input" type="text" placeholder="请输入商户地址" name="address">
							</div>
						</div>
						<div class="weui-cell weui-cell_vcode">
							<div class="weui-cell__hd">
								<label class="weui-label">地址坐标</label>
							</div>
							<div class="weui-cell__bd">
								<div class="weui-flex">
									<div class="weui-flex__item"><input class="weui-input" type="tel" placeholder="" name="maplng" id="maplng"></div>
									<div><div style="padding:0 5px">X</div></div>
									<div class="weui-flex__item"><input class="weui-input" type="tel" placeholder="" name="maplat" id="maplat"></div>
								</div>
							</div>
							<div class="weui-cell__ft">
								<button class="weui-vcode-btn" id="mapmark">获取坐标</button>
							</div>
						</div>
						<a href="javascript:void(0);" class="weui-cell weui-cell_link open-popup" data-url="{{ route('mobile.crm.zhaoshang.customer.nearby') }}">
							<div class="weui-cell__bd">查询附近店铺</div>
						</a>
						<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label">联系电话</label>
							</div>
							<div class="weui-cell__bd">
								<input class="weui-input" type="tel" placeholder="请输入联系电话" name="phone">
							</div>
						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label">营业时间</label>
							</div>
							<div class="weui-cell__bd">
								<input class="weui-input" type="text" placeholder="请输入营业时间" name="openhours">
							</div>
						</div>
						<div class="weui-cell weui-cell_select weui-cell_select-after">
							<div class="weui-cell__hd">
								<label for="" class="weui-label">跟进情况</label>
							</div>
							<div class="weui-cell__bd">
								<select class="weui-select" name="status">
									<option value="touch">初步接触</option>
									<option value="purpose">有意向</option>
									<option value="develop">开发中</option>
									<option value="giveup">已放弃</option>
									<option value="finish">已完成</option>
								</select>
							</div>
						</div>
					</div>

					<div class="weui-cells weui-cells_form" id="uploader">
						<div class="weui-cell">
							<div class="weui-cell__bd">
								<div class="weui-uploader">
									<div class="weui-uploader__hd">
										<p class="weui-uploader__title">合同照片</p>
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
					<div class="weui-cells weui-cells_form" id="uploader">
						<div class="weui-cell">
							<div class="weui-cell__bd">
								<div class="weui-uploader">
									<div class="weui-uploader__hd">
										<p class="weui-uploader__title">商户资质照片</p>
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
					<div class="weui-cells weui-cells_form" id="uploader">
						<div class="weui-cell">
							<div class="weui-cell__bd">
								<div class="weui-uploader">
									<div class="weui-uploader__hd">
										<p class="weui-uploader__title">店铺门头照片</p>
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
					<div class="weui-cells weui-cells_form" id="uploader">
						<div class="weui-cell">
							<div class="weui-cell__bd">
								<div class="weui-uploader">
									<div class="weui-uploader__hd">
										<p class="weui-uploader__title">店铺内景照片</p>
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
					<div class="weui-cells weui-cells_form" id="uploader">
						<div class="weui-cell">
							<div class="weui-cell__bd">
								<div class="weui-uploader">
									<div class="weui-uploader__hd">
										<p class="weui-uploader__title">菜单价目照片</p>
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
					<div class="weui-cells weui-cells_form" id="uploader">
						<div class="weui-cell">
							<div class="weui-cell__bd">
								<div class="weui-uploader">
									<div class="weui-uploader__hd">
										<p class="weui-uploader__title">特色菜品照片</p>
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
					<div class="weui-cells__title">备注其它（选填）</div>
					<div class="weui-cells weui-cells_form">
						<div class="weui-cell">
							<div class="weui-cell__bd">
								<textarea name="remark" class="weui-textarea" placeholder="" rows="3"></textarea>
								<div class="weui-textarea-counter"><span>0</span>/200</div>
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
	<script type="text/javascript" src="http://webapi.amap.com/maps?v=1.4.0&key=da8ac8316273d87097ab56f3cb828a3d&plugin=AMap.Autocomplete"></script>
	<script type="text/javascript" src="{{ asset('static/js/jquery.amap.js') }}"></script>
	<script type="text/javascript">
        $(function(){
            $("#mapmark").amap({
                AddressId: '#address',
                maplngId: '#maplng',
                maplatId: '#maplat',
                mobile: 1
            });
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
        });
	</script>
@endsection