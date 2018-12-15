@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                @if (auth()->user()->group->grantsellcard)
                    @if ($fromuser->card)
                        @if ($fromuser->personnel)
                            <div class="weui-msg">
                                <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
                                <div class="weui-msg__text-area">
                                    <h2 class="weui-msg__title">已开通卖卡</h2>
                                    <p class="weui-msg__desc">业务员 {{ $fromuser->personnel->topuser ? $fromuser->personnel->topuser->username : '' }} 已为他开通卖卡</p>
                                </div>
                            </div>
                        @else
                            <form method="post" action="{{ route('mobile.grantsell', ['fromuser' => request('fromuser')]) }}">
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
                                            <input class="weui-input" name="age" placeholder="请输入申请人年龄" type="text">
                                        </div>
                                    </div>
                                    <div class="weui-cell">
                                        <div class="weui-cell__hd"><label class="weui-label">身份证号码</label></div>
                                        <div class="weui-cell__bd">
                                            <input class="weui-input" name="idcard" placeholder="请输入身份证号码" type="text">
                                        </div>
                                    </div>
                                    <div class="weui-cell">
                                        <div class="weui-cell__hd"><label class="weui-label">所在区域</label></div>
                                        <div class="weui-cell__bd">
                                            <input class="weui-input hidekeyboard" id="location_input" placeholder="请输入所在区域" type="text" value="" readonly>
                                            <input class="prov" type="hidden" name="province" value="">
                                            <input class="city" type="hidden" name="city" value="">
                                            <input class="dist" type="hidden" name="area" value="">
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
                                        </div>
                                        <div class="weui-cell__ft">
                                            <button id="getsmscode" class="weui-vcode-btn" type="button">获取验证码</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="weui-cells weui-cells_form" id="idcardpic">
                                    <div class="weui-cell">
                                        <div class="weui-cell__bd">
                                            <div class="weui-uploader">
                                                <div class="weui-uploader__hd">
                                                    <p class="weui-uploader__title">身份证/学生证上传</p>
                                                    <div class="weui-uploader__info"><span class="weui-uploader__count">0</span>/<span class="weui-uploader__limitnum">1</span></div>
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
                                <div class="weui-cells weui-cells_form" id="grantpic">
                                    <div class="weui-cell">
                                        <div class="weui-cell__bd">
                                            <div class="weui-uploader">
                                                <div class="weui-uploader__hd">
                                                    <p class="weui-uploader__title">授权函上传</p>
                                                    <div class="weui-uploader__info"><span class="weui-uploader__count">0</span>/<span class="weui-uploader__limitnum">1</span></div>
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
                        @endif
                    @else
                        <div class="weui-msg">
                            <div class="weui-msg__icon-area"><i class="weui-icon-warn weui-icon_msg"></i></div>
                            <div class="weui-msg__text-area">
                                <h2 class="weui-msg__title">操作失败</h2>
                                <p class="weui-msg__desc">对方尚未绑卡，不能授权办卡</p>
                                <p class="weui-msg__desc">请先给对方面对面办卡</p>
                            </div>
                            <div class="weui-msg__opr-area">
                                <p class="weui-btn-area">
                                    <a href="{{ route('mobile.crm.tuiguang.sellcard.index') }}" class="weui-btn weui-btn_primary">立即开始办卡</a>
                                </p>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="weui-msg">
                        <div class="weui-msg__icon-area"><i class="weui-icon-info weui-icon_msg"></i></div>
                        <div class="weui-msg__text-area">
                            <h2 class="weui-msg__title">感谢你的支持</h2>
                            <p class="weui-msg__desc">请联系来必惠客户服务电话申请开通相关业务</p>
                            <p class="weui-msg__desc">24小时服务电话：<a href="tel:4006878917">400-6878-917</a></p>
                        </div>
                        <div class="weui-msg__opr-area">
                            <p class="weui-btn-area">
                                <a href="{{ route('mobile.user.index') }}" class="weui-btn weui-btn_default">返回个人中心</a>
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('static/js/weui.cityselect.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jquery.smscode.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/jquery.weuiuploader.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $("#location_input").citySelect({
                url:"{{ route('util.district') }}"
            });
            $("#getsmscode").sms({
                requestUrl: "{{ route('util.smscode') }}",
                calltip: function (data) {
                    weui.alert(data);
                },
                callerror: function (data) {
                    weui.alert(data);
                }
            });
            $("#idcardpic").WeuiUpload({
                url: "{{ route('mobile.upload.image') }}",
                hiddenInputId: 'idcardpic'
            });
            $("#grantpic").WeuiUpload({
                url: "{{ route('mobile.upload.image') }}",
                hiddenInputId: 'grantpic'
            });
        });
    </script>
@endsection