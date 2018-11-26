@extends('layouts.mobile.app')

@section('content')
	<div class="weui-tab">
		<div class="wp">
			<div class="pbw">
				<div class="topheader">
					<div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
					<div class="nav">{{ trans('user.profile') }}</div>
				</div>
				<form class="ajaxform" enctype="multipart/form-data" method="post" action="{{ route('mobile.user.profile.store') }}">
					{!! csrf_field() !!}
					<div class="weui-cells weui-cells_form">
						<div class="weui-cell">
							<div class="weui-cell__hd"><label class="weui-label">{{ trans('user.profile.realname') }}</label></div>
							<div class="weui-cell__bd">
								<input class="weui-input" name="realname" placeholder="请输入{{ trans('user.profile.realname') }}" type="text">
							</div>
						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd"><label class="weui-label">{{ trans('user.profile.email') }}</label></div>
							<div class="weui-cell__bd">
								<input class="weui-input" name="email" placeholder="请输入{{ trans('user.profile.email') }}" type="text">
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
					<div class="weui-cells weui-cells_form">
						<div class="weui-cell">
							<div class="weui-cell__hd"><label class="weui-label">{{ trans('user.profile.workarea') }}</label></div>
							<div class="weui-cell__bd">
								<input class="weui-input hidekeyboard" id="workarea" placeholder="请输入{{ trans('user.profile.workarea') }}" type="text" value="" readonly>
								<input class="prov" type="hidden" name="workprovince" value="">
								<input class="city" type="hidden" name="workcity" value="">
								<input class="dist" type="hidden" name="workarea" value="">
								<input class="street" type="hidden" name="workstreet" value="">
							</div>
						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd"><label class="weui-label">{{ trans('user.profile.birthday') }}</label></div>
							<div class="weui-cell__bd">
								<input class="weui-input datePicker hidekeyboard" name="birthday" placeholder="请输入{{ trans('user.profile.birthday') }}" type="text" readonly>
							</div>
						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd"><label class="weui-label">{{ trans('user.profile.hobby') }}</label></div>
							<div class="weui-cell__bd">
								<input class="weui-input" name="hobby" placeholder="请输入{{ trans('user.profile.hobby') }}" type="text">
							</div>
						</div>
						<div class="weui-cell weui-cell_select weui-cell_select-after">
							<div class="weui-cell__hd"><label class="weui-label">{{ trans('user.profile.stage') }}</label></div>
							<div class="weui-cell__bd">
								<select class="weui-select" name="stage">
									<option value="少年">少年</option>
									<option value="青年">青年</option>
									<option value="中年">中年</option>
                                    <option value="老年">老年</option>
								</select>
							</div>
						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd"><label class="weui-label">{{ trans('user.profile.occupation') }}</label></div>
							<div class="weui-cell__bd">
								<input class="weui-input" name="occupation" placeholder="请输入{{ trans('user.profile.occupation') }}" type="text">
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
	<script type="text/javascript">
        $(function(){
            $("#workarea").citySelect({
                url:"{{ route('util.district') }}"
            });
        });
	</script>
@endsection
