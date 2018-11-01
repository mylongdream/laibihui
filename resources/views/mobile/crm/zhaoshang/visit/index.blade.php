@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="weui-tab__panel">
            <div class="main-body">
                <div class="wp">
                    <div class="pbw">
                        <div class="topheader">
                            <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                            <div class="nav">商户随访</div>
                        </div>
                        @foreach ($list as $value)
                            <div class="weui-panel">
                                <div class="weui-panel__bd">
                                    <div class="weui-media-box weui-media-box_text">
                                        <p class="weui-media-box__desc">{{ $value->message }}</p>
                                        <ul class="weui-media-box__info">
                                            <li class="weui-media-box__info__meta">时间：{{ $value->created_at->format('Y-m-d H:i') }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {!! $list->links() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="weui-tabbar">
            <a href="{{ route('mobile.crm.zhaoshang.visit.create') }}" class="weui-tabbar__item tabbar-btn">
                <span>新增随访记录</span>
            </a>
        </div>
    </div>
@endsection