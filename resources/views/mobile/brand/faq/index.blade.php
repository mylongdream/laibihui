@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="wp">
            <div class="pbw">
                <div class="topheader">
                    <div class="back"><a href="javascript:history.go(-1);"><span></span></a></div>
                    <div class="nav">常见问题</div>
                </div>
                @foreach ($faqcategory as $value)
                    <div class="">
                        <div class="weui-cells__title">{{ $value->name }}</div>
                        <div class="weui-cells">
                            @foreach ($value->faqs as $faq)
                                <a class="weui-cell weui-cell_access" href="{{ route('mobile.brand.faq.show', ['id' => $faq->id]) }}">
                                    <div class="weui-cell__bd">{{ $faq->title }}</div>
                                    <div class="weui-cell__ft"></div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection