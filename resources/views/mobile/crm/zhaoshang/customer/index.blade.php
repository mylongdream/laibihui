@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">商户管理</div>
                </div>
                @foreach ($list as $value)
                    <div class="weui-panel">
                        <div class="weui-panel__bd">
                            <div class="weui-media-box weui-media-box_text">
                                <h4 class="weui-media-box__title">{{ $value->name }}</h4>
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
@endsection