@extends('layouts.common.simple')

@section('content')
    <div class="content-body">
        <div class="wp">
            <div class="faq-container cl">
                <div class="faq-tab">
                    <ul>
                        @foreach ($faqcategory as $value)
                            <li><a href="#faq_{{ $value->id }}">{{ $value->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                @foreach ($faqcategory as $value)
                <div class="faq-box" id="faq_{{ $value->id }}">
                    <div class="hd">
                        <h3>{{ $value->name }}</h3>
                    </div>
                    <div class="bd">
                        @foreach ($value->faqs as $faq)
                            <dl id="faq_{{ $value->id }}_{{ $faq->id }}">
                                <dt><em>问：</em><span>{{ $faq->title }}</span></dt>
                                <dd><em>答：</em><span>{!! nl2br($faq->message) !!}</span></dd>
                            </dl>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection