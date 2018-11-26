@extends('layouts.mobile.app')

@section('content')
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav">申请授权办卡</div>
				</div>
				<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('mobile.crm.tuiguang.grantsell.apply') }}">
					{!! csrf_field() !!}
					<div class="weui-cells weui-cells_form">
						<div class="weui-cell">
							<div class="weui-cell__hd"><label class="weui-label">申请人姓名</label></div>
							<div class="weui-cell__bd">
								<input class="weui-input" name="realname" placeholder="请输入申请人姓名" type="text">
							</div>
						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd"><label class="weui-label">申请人年龄</label></div>
							<div class="weui-cell__bd">
								<input class="weui-input" name="email" placeholder="请输入申请人年龄" type="text">
							</div>
						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd"><label class="weui-label">身份证号码</label></div>
							<div class="weui-cell__bd">
								<input class="weui-input" name="email" placeholder="请输入身份证号码" type="text">
							</div>
						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd"><label class="weui-label">所在区域</label></div>
							<div class="weui-cell__bd">
								<input class="weui-input hidekeyboard" id="workarea" placeholder="请输入所在区域" type="text" value="" readonly>
								<input class="prov" type="hidden" name="workprovince" value="">
								<input class="city" type="hidden" name="workcity" value="">
							</div>
						</div>
					</div>
					<div class="weui-cells weui-cells_form">
						<div class="weui-cell">
							<div class="weui-cell__hd"><label class="weui-label">手机号</label></div>
							<div class="weui-cell__bd">
								<input class="weui-input" name="mobile" placeholder="请输入手机号" type="text">
							</div>
						</div>
						<div class="weui-cell weui-cell_vcode">
							<div class="weui-cell__hd">
								<label class="weui-label">验证码</label>
							</div>
							<div class="weui-cell__bd">
								<input class="weui-input" placeholder="请输入验证码" type="text" name="smscode">
								<input type="hidden" name="mobilerule" value="forgotpwd">
							</div>
							<div class="weui-cell__ft">
								<button id="getsmscode" class="weui-vcode-btn" type="button">获取验证码</button>
							</div>
						</div>
					</div>
					<div class="weui-cells weui-cells_form" id="pic_hetong">
						<div class="weui-cell">
							<div class="weui-cell__bd">
								<div class="weui-uploader">
									<div class="weui-uploader__hd">
										<p class="weui-uploader__title">身份证上传</p>
										<div class="weui-uploader__info"><span class="weui-uploader__count">0</span>/<span class="weui-uploader__limitnum">5</span></div>
									</div>
									<div class="weui-uploader__bd">
										<ul class="weui-uploader__files"></ul>
										<div class="weui-uploader__input-box">
											<input class="weui-uploader__input" type="file" accept="image/*" capture="camera" multiple="" />
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="weui-cells weui-cells_form" id="pic_zizhi">
						<div class="weui-cell">
							<div class="weui-cell__bd">
								<div class="weui-uploader">
									<div class="weui-uploader__hd">
										<p class="weui-uploader__title">授权函上传</p>
										<div class="weui-uploader__info"><span class="weui-uploader__count">0</span>/<span class="weui-uploader__limitnum">5</span></div>
									</div>
									<div class="weui-uploader__bd">
										<ul class="weui-uploader__files"></ul>
										<div class="weui-uploader__input-box">
											<input class="weui-uploader__input" type="file" accept="image/*" capture="camera" multiple="" />
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="weui-btn-area">
						<button name="applybtn" type="button" class="weui-btn weui-btn_primary ajaxsubmit">保 存</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('static/js/jquery.cityselect.js') }}"></script>
	<script type="text/javascript" src="{{ asset('static/js/jquery.weuiuploader.js') }}"></script>
	<script type="text/javascript">
        $(function(){
            $("#workarea").citySelect({
                url:"{{ route('util.district') }}"
            });
            $("#pic_mentou").WeuiUpload({
                url: "{{ route('mobile.upload.image') }}",
                hiddenInputId: 'pic_mentou[]'
            });
            $("#pic_neijing").WeuiUpload({
                url: "{{ route('mobile.upload.image') }}",
                hiddenInputId: 'pic_neijing[]'
            });
        });
	</script>
@endsection
