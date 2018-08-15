@extends('layouts.mobile.app')

@section('content')
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav">{{ trans('user.profile') }}</div>
				</div>
				<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('mobile.user.profile.update') }}">
					{!! method_field('PUT') !!}
					{!! csrf_field() !!}
					<div class="weui-cells weui-cells_form">
						<div class="weui-cell">
							<div class="weui-cell__hd"><label class="weui-label">{{ trans('user.profile.realname') }}</label></div>
							<div class="weui-cell__bd">
								<input class="weui-input" name="realname" placeholder="" type="text" value="{{$profile->realname}}">
							</div>
						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd"><label class="weui-label">{{ trans('user.profile.email') }}</label></div>
							<div class="weui-cell__bd">
								<input class="weui-input" name="email" placeholder="" type="text" value="{{$profile->email}}">
							</div>
						</div>
					</div>
					<div class="weui-cells__title">{{ trans('user.profile.gender') }}</div>
					<div class="weui-cells weui-cells_radio">
						<label class="weui-cell weui-check__label" for="gender1">
							<div class="weui-cell__bd">
								<p>男</p>
							</div>
							<div class="weui-cell__ft">
								<input class="weui-check" name="gender" id="gender1" type="radio" value="1" checked="checked">
								<span class="weui-icon-checked"></span>
							</div>
						</label>
						<label class="weui-cell weui-check__label" for="gender2">
							<div class="weui-cell__bd">
								<p>女</p>
							</div>
							<div class="weui-cell__ft">
								<input class="weui-check" name="gender" id="gender2" type="radio" value="2">
								<span class="weui-icon-checked"></span>
							</div>
						</label>
					</div>
					<div class="weui-cells__title">{{ trans('user.profile.marry') }}</div>
					<div class="weui-cells weui-cells_radio">
						<label class="weui-cell weui-check__label" for="marry1">
							<div class="weui-cell__bd">
								<p>单身</p>
							</div>
							<div class="weui-cell__ft">
								<input class="weui-check" name="marry" id="marry1" type="radio" value="单身" checked="checked">
								<span class="weui-icon-checked"></span>
							</div>
						</label>
						<label class="weui-cell weui-check__label" for="marry2">
							<div class="weui-cell__bd">
								<p>已婚</p>
							</div>
							<div class="weui-cell__ft">
								<input class="weui-check" name="marry" id="marry2" type="radio" value="已婚">
								<span class="weui-icon-checked"></span>
							</div>
						</label>
					</div>
					<div class="weui-cells__title">{{ trans('user.profile.workarea') }}</div>
					<div class="weui-cells weui-cells_form" id="workarea_city">
						<div class="weui-cell weui-cell_select weui-cell_select-after">
							<div class="weui-cell__hd"><label class="weui-label">所在省份</label></div>
							<div class="weui-cell__bd">
								<select class="weui-select prov" name="workprovince"></select>
							</div>
						</div>
						<div class="weui-cell weui-cell_select weui-cell_select-after">
							<div class="weui-cell__hd"><label class="weui-label">所在城市</label></div>
							<div class="weui-cell__bd">
								<select class="weui-select city" name="workcity"></select>
							</div>
						</div>
						<div class="weui-cell weui-cell_select weui-cell_select-after">
							<div class="weui-cell__hd"><label class="weui-label">所在区域</label></div>
							<div class="weui-cell__bd">
								<select class="weui-select dist" name="workarea"></select>
							</div>
						</div>
						<div class="weui-cell weui-cell_select weui-cell_select-after">
							<div class="weui-cell__hd"><label class="weui-label">所在街道</label></div>
							<div class="weui-cell__bd">
								<select class="weui-select street" name="workstreet"></select>
							</div>
						</div>
					</div>
					<div class="weui-cells weui-cells_form">
						<div class="weui-cell">
							<div class="weui-cell__hd"><label class="weui-label">{{ trans('user.profile.birthday') }}</label></div>
							<div class="weui-cell__bd">
								<input class="weui-input datePicker hidekeyboard" name="birthday" placeholder="" type="text" data-end="{{ date('Y-m-d', time()) }}" value="{{$profile->birthday ? $profile->birthday->format('Y-m-d') : ''}}" readonly>
							</div>
						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd"><label class="weui-label">{{ trans('user.profile.hobby') }}</label></div>
							<div class="weui-cell__bd">
								<input class="weui-input" name="hobby" placeholder="" type="text" value="{{$profile->hobby}}">
							</div>
						</div>
						<div class="weui-cell weui-cell_select weui-cell_select-after">
							<div class="weui-cell__hd"><label class="weui-label">{{ trans('user.profile.stage') }}</label></div>
							<div class="weui-cell__bd">
								<select class="weui-select" name="stage">
									<option value="少年" {{ $profile->stage == "少年" ? 'selected' : '' }}>少年</option>
									<option value="青年" {{ $profile->stage == "青年" ? 'selected' : '' }}>青年</option>
									<option value="中年" {{ $profile->stage == "中年" ? 'selected' : '' }}>中年</option>
									<option value="老年" {{ $profile->stage == "老年" ? 'selected' : '' }}>老年</option>
								</select>
							</div>
						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd"><label class="weui-label">{{ trans('user.profile.occupation') }}</label></div>
							<div class="weui-cell__bd">
								<input class="weui-input" name="occupation" placeholder="" type="text" value="{{$profile->occupation}}">
							</div>
						</div>
					</div>
					<div class="weui-btn-area">
						<button name="applybtn" type="button" class="weui-btn weui-btn_primary ajaxsubmit">修 改</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('static/js/jquery.cityselect.js') }}"></script>
	<script type="text/javascript">
        $("#workarea_city").citySelect({
            url:"{{ route('util.district') }}",
            required:false,
            prov:"{{ $profile->workprovince }}",
            city:"{{ $profile->workcity }}",
            dist:"{{ $profile->workarea }}",
            street:"{{ $profile->workstreet }}"
        });
	</script>
@endsection
