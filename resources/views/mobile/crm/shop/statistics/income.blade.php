@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">收入统计</div>
                </div>
                <div class="weui-panel">
                    <div class="weui-panel__bd user-account">
                        <div class="weui-flex">
                            <div class="weui-flex__item">
                                <a href="javascript:;" class="">
                                    <div class="money">{{ $shop->money }} 元</div>
                                    <div class="name">今日收入</div>
                                </a>
                            </div>
                            <div class="weui-flex__item">
                                <a href="javascript:;" class="">
                                    <div class="money">{{ $shop->money }} 元</div>
                                    <div class="name">近7天收入</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="weui-panel">
                    <div class="weui-panel__bd user-account">
                        <div class="weui-flex">
                            <div class="weui-flex__item">
                                <a href="javascript:;" class="">
                                    <div class="money">{{ $shop->money }} 元</div>
                                    <div class="name">近30天收入</div>
                                </a>
                            </div>
                            <div class="weui-flex__item">
                                <a href="javascript:;" class="">
                                    <div class="money">{{ $shop->money }} 元</div>
                                    <div class="name">累计总收入</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
