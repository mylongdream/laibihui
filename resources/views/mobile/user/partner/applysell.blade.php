@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <form method="post" action="{{ route('mobile.user.partner.apply') }}">
                    {!! csrf_field() !!}
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">姓名</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="realname" placeholder="请输入姓名" type="text">
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">手机号</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="mobile" placeholder="请输入手机号" type="text">
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">微信号</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="wechatid" placeholder="请输入微信号" type="text">
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">联系地址</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="address" placeholder="请输入联系地址" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="weui-cells__title">其他要求</div>
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <textarea name="message" class="weui-textarea" placeholder="请填写相关要求以便我们提供更好的帮助（选填）" rows="3"></textarea>
                                <div class="weui-textarea-counter"><span>0</span>/200</div>
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