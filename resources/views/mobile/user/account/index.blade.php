@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp account-container">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">我的钱包</div>
                </div>
                <div class="account-msg">
                    <div class="weui-msg">
                        <div class="weui-msg__icon-area"><i class="weui-icon-wallet weui-icon_msg"></i></div>
                        <div class="weui-msg__text-area">
                            <h2 class="weui-msg__title">可用余额</h2>
                            <p class="weui-msg__desc">￥{{ sprintf("%.2f",auth()->user()->user_money) }}</p>
                        </div>
                        <div class="weui-msg__opr-area">
                            <p class="weui-btn-area">
                                <a href="javascript:;" class="weui-btn weui-btn_primary">充值</a>
                                <a href="javascript:;" class="weui-btn weui-btn_default">提现</a>
                            </p>
                        </div>
                        <div class="weui-msg__extra-area">
                            <div class="weui-footer">
                                <p class="weui-footer__links">
                                    <a href="javascript:void(0);" class="weui-footer__link">常见问题</a>
                                </p>
                                <p class="weui-footer__text">本服务由{{ $setting['sitename'] }}提供</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
