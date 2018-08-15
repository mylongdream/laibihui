@extends('wechat.ownervote.app')

@section('style')
    <link href="{{ asset('static/css/swiper.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="weui-tab">
        <div class="weui-tab__panel">
            <div class="main-body">
                <div class="wp">


                </div>
            </div>
        </div>
        @include('wechat.ownervote.footer')
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('static/js/jquery.swiper.min.js') }}"></script>
    <script type="text/javascript">
        var Swiper1 = new Swiper ('.index-slide .swiper-container', {
            autoplay: 4000,
            loop:true,
            pagination:'.swiper-pagination'
        });
    </script>
@endsection