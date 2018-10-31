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
								<input class="weui-input" type="text" placeholder="请输入商户地址" name="address" id="address">
							</div>
						</div>
						<div class="weui-cell weui-cell_vcode">
							<div class="weui-cell__bd">
								<div class="weui-flex">
									<div class="weui-flex__item"><input class="weui-input" type="tel" placeholder="" name="maplng" id="maplng"></div>
									<div><div style="padding:0 5px">X</div></div>
									<div class="weui-flex__item"><input class="weui-input" type="tel" placeholder="" name="maplat" id="maplat"></div>
								</div>
							</div>
							<div class="weui-cell__ft">
								<button class="weui-vcode-btn"  type="button" id="mapmark">获取坐标</button>
							</div>
						</div>
						<a href="javascript:void(0);" class="weui-cell weui-cell_link open-popup" data-url="{{ route('mobile.crm.zhaoshang.customer.nearby') }}" data-target="#nearbybox">
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

					<div class="weui-cells weui-cells_form" id="pic_hetong">
						<div class="weui-cell">
							<div class="weui-cell__bd">
								<div class="weui-uploader">
									<div class="weui-uploader__hd">
										<p class="weui-uploader__title">合同照片</p>
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
										<p class="weui-uploader__title">商户资质照片</p>
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
					<div class="weui-cells weui-cells_form" id="pic_mentou">
						<div class="weui-cell">
							<div class="weui-cell__bd">
								<div class="weui-uploader">
									<div class="weui-uploader__hd">
										<p class="weui-uploader__title">店铺门头照片</p>
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
					<div class="weui-cells weui-cells_form" id="pic_neijing">
						<div class="weui-cell">
							<div class="weui-cell__bd">
								<div class="weui-uploader">
									<div class="weui-uploader__hd">
										<p class="weui-uploader__title">店铺内景照片</p>
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
					<div class="weui-cells weui-cells_form" id="pic_caidan">
						<div class="weui-cell">
							<div class="weui-cell__bd">
								<div class="weui-uploader">
									<div class="weui-uploader__hd">
										<p class="weui-uploader__title">菜单价目照片</p>
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
					<div class="weui-cells weui-cells_form" id="pic_caipin">
						<div class="weui-cell">
							<div class="weui-cell__bd">
								<div class="weui-uploader">
									<div class="weui-uploader__hd">
										<p class="weui-uploader__title">特色菜品照片</p>
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
	<script type="text/javascript" src="{{ asset('static/js/jquery.weuiuploader.js') }}"></script>
	<script type="text/javascript">
        $(function(){
            $("#mapmark").amap({
                AddressId: '#address',
                maplngId: '#maplng',
                maplatId: '#maplat',
                mobile: 1
            });
            $("#pic_hetong").WeuiUpload({
                url: "{{ route('mobile.upload.image') }}",
                hiddenInputId: 'pic_hetong[]'
            });
            $("#pic_zizhi").WeuiUpload({
                url: "{{ route('mobile.upload.image') }}",
                hiddenInputId: 'pic_zizhi[]'
            });
            $("#pic_mentou").WeuiUpload({
                url: "{{ route('mobile.upload.image') }}",
                hiddenInputId: 'pic_mentou[]'
            });
            $("#pic_neijing").WeuiUpload({
                url: "{{ route('mobile.upload.image') }}",
                hiddenInputId: 'pic_neijing[]'
            });
            $("#pic_caidan").WeuiUpload({
                url: "{{ route('mobile.upload.image') }}",
                hiddenInputId: 'pic_caidan[]'
            });
            $("#pic_caipin").WeuiUpload({
                url: "{{ route('mobile.upload.image') }}",
                hiddenInputId: 'pic_caipin[]'
            });
        });
	</script>
@endsection