@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">重置密码</div>
                </div>
                <form class="ajaxform" name="myform" method="post" action="{{ route('mobile.forgotpwd.reset') }}">
                    {!! csrf_field() !!}
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">新密码</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="password" placeholder="密码至少6~14位，含数字、英文、符号两种" type="password">
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">确认密码</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="password_confirmation" placeholder="密码至少6~14位，含数字、英文、符号两种" type="password">
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

