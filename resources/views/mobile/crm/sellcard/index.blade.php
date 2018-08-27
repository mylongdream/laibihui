@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">授权卖卡</div>
                </div>
                <div class="weui-panel">
                    <div class="weui-panel__bd">
                        <img style="width:100%" src="{{ route('mobile.crm.sellcard.index', ['getcode' => 1]) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection