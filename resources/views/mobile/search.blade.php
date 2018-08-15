@extends('layouts.mobile.app')

@section('content')
        <div class="weui-search-bar weui-search-bar_focusing">
            <form class="weui-search-bar__form" action="{{ route('mobile.brand.shop.index') }}">
                <div class="weui-search-bar__box">
                    <i class="weui-icon-search"></i>
                    <input type="search" class="weui-search-bar__input" name="keyword" placeholder="输入商户名、地点、商户搜索码" autofocus="autofocus">
                </div>
            </form>
            <a href="javascript:" class="weui-search-bar__cancel-btn close-popup" data-target="#searchBar">取消</a>
        </div>
@endsection

@section('script')
    <script type="text/javascript">
$(function() {
            $(".weui-search-bar__input").trigger( "focus" );
    });
    </script>
@endsection