@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">申请售卡推广员</div>
                </div>
                <div class="weui-panel">
                    <div class="weui-panel__bd">
                        <img src="{{ $qrcode }}" alt="" style="width:200px;margin:50px auto;">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection