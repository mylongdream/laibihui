@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">{{ trans('user.sellcard') }}</div>
                </div>
                <div class="weui-panel">
                    <div class="weui-panel__bd">
                        <img style="width:100%" src="{{ route('mobile.user.sellcard.index', ['getcode' => 1]) }}" alt="">
                    </div>
                </div>
                <div class="weui-btn-area">
                    <a href="{{ route('mobile.user.sellcard.order') }}" class="weui-btn weui-btn_primary">售卡记录</a>
                </div>
            </div>
        </div>
    </div>
@endsection