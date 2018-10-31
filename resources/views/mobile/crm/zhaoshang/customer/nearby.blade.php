@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">附近店铺</div>
                </div>
                @foreach ($shops as $value)
                    <div class="weui-panel">
                        <div class="weui-panel__bd">
                            <div class="weui-media-box weui-media-box_appmsg">
                                <div class="weui-media-box__hd">
                                    <img class="weui-media-box__thumb" src="{{ uploadImage($value->upimage) }}" alt="">
                                </div>
                                <div class="weui-media-box__bd">
                                    <h4 class="weui-media-box__title">{{ $value->name }}</h4>
                                    <p class="weui-media-box__desc">地址：{{ $value->address }}</p>
                                    <p class="weui-media-box__desc">相距：{{ number_format($value->distance) }} 米</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection