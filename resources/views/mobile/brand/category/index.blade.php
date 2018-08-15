@extends('layouts.mobile.app')

@section('content')
    <div class="weui-tab">
        <div class="weui-tab__panel">
            <div class="main-body">
                <div class="wp">
                    <div class="pbw">
                        @foreach ($categorylist as $category)
                            <div class="">
                                <div class="weui-cells__title">{{ $category->name }}</div>
                                <div class="weui-cells">
                                    @foreach ($category->children as $scate)
                                        <a class="weui-cell weui-cell_access" href="{{ route('mobile.brand.shop.index', ['catid' => $scate->id]) }}" target="_blank" title="{{ $scate->name }}">
                                            <div class="weui-cell__bd">{{ $scate->name }}</div>
                                            <div class="weui-cell__ft"></div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.mobile.footer')
    </div>
@endsection