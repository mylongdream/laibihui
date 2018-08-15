@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">常见问题</div>
                </div>
                <div class="faq-box">
                <div class="weui-article">
                    <h1>{{ $faq->title }}</h1>
                    <section>{!! nl2br($faq->message) !!}</section>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection