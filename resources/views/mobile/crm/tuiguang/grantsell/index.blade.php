@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">授权办卡管理</div>
                </div>
                <div class="weui-panel">
                    <div class="weui-panel__bd">
                        <div class="weui-media-box weui-media-box_small-appmsg">
                            <div class="weui-cells">
                                <a class="weui-cell weui-cell_access" href="{{ route('mobile.crm.tuiguang.grantsell.manage') }}">
                                    <div class="weui-cell__hd">
                                        <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-dz.png') }}" alt="">
                                    </div>
                                    <div class="weui-cell__bd weui-cell_primary">
                                        <p class="user-menu-txt">下级授权办卡管理</p>
                                    </div>
                                    <span class="weui-cell__ft"></span>
                                </a>
                                <a class="weui-cell weui-cell_access" href="{{ route('mobile.crm.tuiguang.grantsell.subapply') }}">
                                    <div class="weui-cell__hd">
                                        <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-geren.png') }}" alt="">
                                    </div>
                                    <div class="weui-cell__bd weui-cell_primary">
                                        <p class="user-menu-txt">
                                            下级撤销授权办卡申请
                                            @if ($count)
                                            <span class="weui-badge" style="margin-left: 5px;">{{ $count }}</span>
                                            @endif
                                        </p>
                                    </div>
                                    <span class="weui-cell__ft"></span>
                                </a>
                                @if (auth('crm')->user()->personnel->topuid)
                                <a class="weui-cell weui-cell_access" href="{{ route('mobile.crm.tuiguang.grantsell.apply') }}">
                                    <div class="weui-cell__hd">
                                        <img class="user-menu-pic" src="{{ asset('static/image/mobile/center-icon-geren.png') }}" alt="">
                                    </div>
                                    <div class="weui-cell__bd weui-cell_primary">
                                        <p class="user-menu-txt">我要撤销授权办卡业务</p>
                                    </div>
                                    <span class="weui-cell__ft"></span>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection