@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">合伙人计划</div>
                </div>
                <div class="weui-panel">
                    <div class="weui-panel__bd">
                        <div class="weui-media-box weui-media-box_small-appmsg">
                            <div class="weui-cells">
                                <a class="weui-cell weui-cell_access" href="{{ route('mobile.user.partner.qrcode') }}">
                                    <div class="weui-cell__hd">
                                        <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-out.png') }}" alt="">
                                    </div>
                                    <div class="weui-cell__bd weui-cell_primary">
                                        <p class="user-menu-txt">申请售卡推广员</p>
                                    </div>
                                    <span class="weui-cell__ft"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection