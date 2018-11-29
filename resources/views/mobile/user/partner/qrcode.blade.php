@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">申请售卡推广员</div>
                </div>
                <div class="weui-article">
                    <p style="text-align: center"><img src="{{ $qrcode }}" alt=""></p>
                    <p><strong>你尚未开通推广售卡服务，请按以下方式操作</strong></p>
                    <p>立即在线申请推广售卡服务</p>
                    <p>立即拨打客服电话申请推广售卡服务</p>
                    <h1><strong>奖励说明：</strong></h1>
                    <p>开通办卡功能后，每成功为一位普通会员面对面办卡，你将获得5元提成</p>
                </div>
            </div>
        </div>
    </div>
@endsection